/**
 * Hero point-light shadow effect (three.js).
 *
 * Two animated point lights, each wrapped in a striped shell, sweep across the
 * whole hero. The profile photo is a texture on a plane inside the scene, so
 * the light and the moving shadows really fall on it.
 *
 * Progressive enhancement: the DOM photo card stays in place and is only faded
 * out once the scene is ready. If WebGL or the CDN is unavailable, the page
 * keeps the plain card.
 */
const THREE_URL = 'https://cdn.jsdelivr.net/npm/three@0.170.0/build/three.module.js';

const wrap = document.getElementById('hero-lights');
const canvas = wrap?.querySelector('canvas');
const card = document.getElementById('hero-profile-card');
const domImg = document.getElementById('hero-profile-img');
const hero = wrap?.closest('main');

const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
const isSmall = window.matchMedia('(max-width: 767px)').matches;
const canHover = window.matchMedia('(hover: hover)').matches;

const VIEW_H = 10; // world units visible at z = 0
const FOV = 35;
const MAX_PIXELS = 2.5e6;

async function start() {
    if (!wrap || !canvas || !card || !domImg || !hero) return;

    const THREE = await import(THREE_URL);
    const photo = await loadPhotoTexture(THREE, domImg.currentSrc || domImg.src, card);

    let renderer;
    try {
        renderer = new THREE.WebGLRenderer({ canvas, antialias: true, alpha: false, powerPreference: 'high-performance' });
    } catch (e) {
        return;
    }
    renderer.setClearColor(0x000000, 1);
    renderer.shadowMap.enabled = true;
    renderer.shadowMap.type = THREE.PCFSoftShadowMap;

    const scene = new THREE.Scene();
    const camera = new THREE.PerspectiveCamera(FOV, 1, 0.1, 100);
    camera.position.z = VIEW_H / 2 / Math.tan((FOV / 2) * Math.PI / 180);

    scene.add(new THREE.AmbientLight(0x101830, 1.5));

    // --- back wall: receives the light + shadows -------------------------
    const wall = new THREE.Mesh(
        new THREE.PlaneGeometry(1, 1),
        new THREE.MeshStandardMaterial({ color: 0x5f687c, roughness: 0.9, metalness: 0 })
    );
    wall.receiveShadow = true;
    scene.add(wall);

    // --- profile photo plane ---------------------------------------------
    const photoMat = new THREE.MeshStandardMaterial({
        map: photo.texture,
        emissive: 0xffffff,
        emissiveMap: photo.texture,
        emissiveIntensity: 0.26, // keeps the face readable between light passes
        roughness: 0.85,
        metalness: 0,
        transparent: true,
        opacity: 0,
    });
    const plane = new THREE.Mesh(new THREE.PlaneGeometry(1, 1), photoMat);
    plane.position.z = 0.12;
    plane.receiveShadow = true;
    scene.add(plane);

    // --- lights ------------------------------------------------------------
    const stripes = makeStripeTexture(THREE);
    const lights = [createLight(THREE, 0x0088ff, stripes), createLight(THREE, 0xff6f91, stripes)];
    const activeLights = isSmall ? lights.slice(0, 1) : lights;
    activeLights.forEach((l) => scene.add(l));

    // --- layout --------------------------------------------------------------
    const view = { w: 10, h: VIEW_H };
    let size = { w: 0, h: 0 };

    function resize() {
        const w = wrap.clientWidth;
        const h = wrap.clientHeight;
        if (!w || !h) return;

        if (w !== size.w || h !== size.h) {
            size = { w, h };
            const ratio = Math.min(window.devicePixelRatio || 1, 1.5, Math.sqrt(MAX_PIXELS / (w * h)));
            renderer.setPixelRatio(ratio);
            renderer.setSize(w, h, false);
            camera.aspect = w / h;
            camera.updateProjectionMatrix();
            view.w = VIEW_H * camera.aspect;
            wall.scale.set(view.w * 1.3, view.h * 1.3, 1);
        }
        placePhoto();
    }

    function placePhoto() {
        if (!size.w) return;
        const u = VIEW_H / size.h; // world units per CSS px
        const wr = wrap.getBoundingClientRect();
        const cr = card.getBoundingClientRect();
        const cx = cr.left + cr.width / 2 - wr.left;
        const cy = cr.top + cr.height / 2 - wr.top;
        plane.scale.set(card.offsetWidth * u, card.offsetHeight * u, 1);
        base.x = (cx - size.w / 2) * u;
        base.y = -(cy - size.h / 2) * u;
    }
    const base = { x: 0, y: 0 };

    // --- interaction (subtle tilt of the photo plane) -----------------------
    const tilt = { x: 0, y: 0, tx: 0, ty: 0 };
    if (canHover && !reducedMotion) {
        hero.addEventListener('mousemove', (e) => {
            tilt.ty = (e.clientX / window.innerWidth - 0.5) * 0.18;
            tilt.tx = -(e.clientY / window.innerHeight - 0.5) * 0.18;
        });
        hero.addEventListener('mouseleave', () => { tilt.tx = 0; tilt.ty = 0; });
    }

    // --- animation -------------------------------------------------------------
    const t0 = performance.now();
    let visible = true;
    let rafId = 0;
    let introStart = null;

    function update(now) {
        const t = reducedMotion ? 4 : (now - t0) / 1000;

        activeLights.forEach((light, i) => {
            const s = t + (i ? 37 : 0);
            light.position.x = Math.sin(s * 0.42) * view.w * 0.42;
            light.position.y = Math.sin(s * 0.55) * view.h * 0.36;
            light.position.z = 3 + Math.sin(s * 0.7) * 0.9;
            light.rotation.x = s * 0.8;
            light.rotation.z = s * 0.8;
        });

        tilt.x += (tilt.tx - tilt.x) * 0.06;
        tilt.y += (tilt.ty - tilt.y) * 0.06;
        plane.rotation.set(tilt.x, tilt.y, 0);

        // fade the photo in and swap out the DOM card once
        if (introStart === null) introStart = now;
        const p = reducedMotion ? 1 : Math.min(1, (now - introStart) / 1100);
        const eased = 1 - Math.pow(1 - p, 3);
        photoMat.opacity = eased;
        plane.position.set(base.x, base.y - (1 - eased) * 0.35, 0.12);
    }

    function frame(now) {
        rafId = requestAnimationFrame(frame);
        // card can still be moving during the page entrance animation
        if (now - t0 < 2500) placePhoto();
        update(now);
        renderer.render(scene, camera);
    }

    function startLoop() {
        if (reducedMotion || rafId || !visible || document.hidden) return;
        rafId = requestAnimationFrame(frame);
    }
    function stopLoop() {
        cancelAnimationFrame(rafId);
        rafId = 0;
    }

    resize();
    update(performance.now());
    renderer.render(scene, camera); // first frame before revealing the canvas

    wrap.style.opacity = '1';
    domImg.style.opacity = '0';
    card.style.boxShadow = 'none';

    if (reducedMotion) {
        window.addEventListener('resize', () => { resize(); update(performance.now()); renderer.render(scene, camera); }, { passive: true });
        return;
    }

    new ResizeObserver(resize).observe(wrap);
    new ResizeObserver(placePhoto).observe(card);
    window.addEventListener('resize', resize, { passive: true });

    new IntersectionObserver(([entry]) => {
        visible = entry.isIntersecting;
        visible ? startLoop() : stopLoop();
    }, { threshold: 0 }).observe(wrap);
    document.addEventListener('visibilitychange', () => (document.hidden ? stopLoop() : startLoop()));

    canvas.addEventListener('webglcontextlost', (e) => { e.preventDefault(); stopLoop(); });
    canvas.addEventListener('webglcontextrestored', startLoop);

    startLoop();
}

/** Light = point light + glowing core + striped shell that casts the shadow pattern. */
function createLight(THREE, color, stripes) {
    const light = new THREE.PointLight(color, 30, 16, 2);
    light.castShadow = true;
    light.shadow.mapSize.set(isSmall ? 256 : 512, isSmall ? 256 : 512);
    light.shadow.bias = -0.004; // limits self-shadowing on the double-sided shell
    light.shadow.radius = 6;
    light.shadow.camera.near = 0.2;
    light.shadow.camera.far = 16;

    const core = new THREE.Mesh(
        new THREE.SphereGeometry(0.1, 12, 6),
        new THREE.MeshBasicMaterial({ color: new THREE.Color(color).lerp(new THREE.Color(0xffffff), 0.6) })
    );
    light.add(core);

    const shell = new THREE.Mesh(
        new THREE.SphereGeometry(0.4, 32, 8),
        new THREE.MeshBasicMaterial({
            color,
            side: THREE.DoubleSide,
            alphaMap: stripes,
            alphaTest: 0.5,
        })
    );
    shell.castShadow = true;
    light.add(shell);

    return light;
}

function makeStripeTexture(THREE) {
    const c = document.createElement('canvas');
    c.width = 2;
    c.height = 2;
    const ctx = c.getContext('2d');
    ctx.fillStyle = 'white';
    ctx.fillRect(0, 1, 2, 1);

    const tex = new THREE.CanvasTexture(c);
    tex.magFilter = THREE.NearestFilter;
    tex.wrapS = tex.wrapT = THREE.RepeatWrapping;
    tex.repeat.set(1, 4.5);
    return tex;
}

/**
 * Draws the profile photo like the DOM card did: object-cover, grayscale,
 * rounded corners and a fade to transparent along the bottom.
 */
function loadPhotoTexture(THREE, src, cardEl) {
    return new Promise((resolve, reject) => {
        const img = new Image();
        img.crossOrigin = 'anonymous';
        img.decoding = 'async';
        img.onerror = () => reject(new Error('hero photo failed to load'));
        img.onload = () => {
            const W = 660;
            const H = Math.round(W * (cardEl.offsetHeight / cardEl.offsetWidth || 1.25));
            const c = document.createElement('canvas');
            c.width = W;
            c.height = H;
            const ctx = c.getContext('2d');

            const s = Math.max(W / img.naturalWidth, H / img.naturalHeight);
            const dw = img.naturalWidth * s;
            const dh = img.naturalHeight * s;
            ctx.drawImage(img, (W - dw) / 2, (H - dh) / 2, dw, dh);

            // grayscale (ctx.filter is not supported on Safari)
            const data = ctx.getImageData(0, 0, W, H);
            const px = data.data;
            for (let i = 0; i < px.length; i += 4) {
                const g = px[i] * 0.299 + px[i + 1] * 0.587 + px[i + 2] * 0.114;
                px[i] = px[i + 1] = px[i + 2] = g;
            }
            ctx.putImageData(data, 0, 0);

            // rounded corners
            const r = 32;
            ctx.globalCompositeOperation = 'destination-in';
            ctx.beginPath();
            ctx.moveTo(r, 0);
            ctx.arcTo(W, 0, W, H, r);
            ctx.arcTo(W, H, 0, H, r);
            ctx.arcTo(0, H, 0, 0, r);
            ctx.arcTo(0, 0, W, 0, r);
            ctx.closePath();
            ctx.fill();

            // bottom fade (same as the CSS mask: transparent 0% -> opaque 35%)
            const g = ctx.createLinearGradient(0, H * 0.65, 0, H);
            g.addColorStop(0, 'rgba(0,0,0,1)');
            g.addColorStop(1, 'rgba(0,0,0,0)');
            ctx.fillStyle = g;
            ctx.fillRect(0, 0, W, H);

            const texture = new THREE.CanvasTexture(c);
            texture.colorSpace = THREE.SRGBColorSpace;
            texture.anisotropy = 4;
            resolve({ texture });
        };
        img.src = src;
    });
}

function boot() {
    const run = () => start().catch(() => { /* keep the plain DOM card */ });
    if ('requestIdleCallback' in window) requestIdleCallback(run, { timeout: 2000 });
    else setTimeout(run, 300);
}

if (document.readyState === 'complete') boot();
else window.addEventListener('load', boot, { once: true });

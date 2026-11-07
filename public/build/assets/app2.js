var e=Object.create,t=Object.defineProperty,n=Object.getOwnPropertyDescriptor,r=Object.getOwnPropertyNames,i=Object.getPrototypeOf,a=Object.prototype.hasOwnProperty,o=(e,t)=>()=>(t||e((t={exports:{}}).exports,t),t.exports),s=(e,i,o,s)=>{if(i&&typeof i==`object`||typeof i==`function`)for(var c=r(i),l=0,u=c.length,d;l<u;l++)d=c[l],!a.call(e,d)&&d!==o&&t(e,d,{get:(e=>i[e]).bind(null,d),enumerable:!(s=n(i,d))||s.enumerable});return e},c=(n,r,a)=>(a=n==null?{}:e(i(n)),s(r||!n||!n.__esModule?t(a,`default`,{value:n,enumerable:!0}):a,n)),l=!1,u=!1,d=[],f=-1,p=!1;function m(e){_(e)}function h(){p=!0}function g(){p=!1,y()}function _(e){d.includes(e)||d.push(e),y()}function v(e){let t=d.indexOf(e);t!==-1&&t>f&&d.splice(t,1)}function y(){if(!u&&!l){if(p)return;l=!0,queueMicrotask(b)}}function b(){l=!1,u=!0;for(let e=0;e<d.length;e++)d[e](),f=e;d.length=0,f=-1,u=!1}var x,S,C,w,T=!0;function E(e){T=!1,e(),T=!0}function D(e){x=e.reactive,C=e.release,S=t=>e.effect(t,{scheduler:e=>{T?m(e):e()}}),w=e.raw}function O(e){S=e}function ee(e){let t=()=>{};return[n=>{let r=S(n);return e._x_effects||(e._x_effects=new Set,e._x_runEffects=()=>{e._x_effects.forEach(e=>e())}),e._x_effects.add(r),t=()=>{r!==void 0&&(e._x_effects.delete(r),C(r))},r},()=>{t()}]}function te(e,t){let n=!0,r,i,a=S(()=>{let a=e(),o=JSON.stringify(a);if(!n&&(typeof a==`object`||a!==r)){let e=typeof r==`object`?JSON.parse(i):r;queueMicrotask(()=>{t(a,e)})}r=a,i=o,n=!1});return()=>C(a)}async function ne(e){h();try{await e(),await Promise.resolve()}finally{g()}}var k=[],re=[],ie=[];function ae(e){ie.push(e)}function oe(e,t){typeof t==`function`?(e._x_cleanups||=[],e._x_cleanups.push(t)):(t=e,re.push(t))}function se(e){k.push(e)}function ce(e,t,n){e._x_attributeCleanups||={},e._x_attributeCleanups[t]||(e._x_attributeCleanups[t]=[]),e._x_attributeCleanups[t].push(n)}function le(e,t){e._x_attributeCleanups&&Object.entries(e._x_attributeCleanups).forEach(([n,r])=>{(t===void 0||t.includes(n))&&(r.forEach(e=>e()),delete e._x_attributeCleanups[n])})}function ue(e){for(e._x_effects?.forEach(v);e._x_cleanups?.length;)e._x_cleanups.pop()()}var de=new MutationObserver(ye),fe=!1;function pe(){de.observe(document,{subtree:!0,childList:!0,attributes:!0,attributeOldValue:!0}),fe=!0}function me(){ge(),de.disconnect(),fe=!1}var he=[];function ge(){let e=de.takeRecords();he.push(()=>e.length>0&&ye(e));let t=he.length;queueMicrotask(()=>{if(he.length===t)for(;he.length>0;)he.shift()()})}function A(e){if(!fe)return e();me();let t=e();return pe(),t}var j=!1,M=[];function _e(){j=!0}function ve(){j=!1,ye(M),M=[]}function ye(e){if(j){M=M.concat(e);return}let t=[],n=new Set,r=new Map,i=new Map;for(let a=0;a<e.length;a++)if(!e[a].target._x_ignoreMutationObserver&&(e[a].type===`childList`&&(e[a].removedNodes.forEach(e=>{e.nodeType===1&&e._x_marker&&n.add(e)}),e[a].addedNodes.forEach(e=>{if(e.nodeType===1){if(n.has(e)){n.delete(e);return}e._x_marker||t.push(e)}})),e[a].type===`attributes`)){let t=e[a].target,n=e[a].attributeName,o=e[a].oldValue,s=()=>{r.has(t)||r.set(t,[]),r.get(t).push({name:n,value:t.getAttribute(n)})},c=()=>{i.has(t)||i.set(t,[]),i.get(t).push(n)};t.hasAttribute(n)&&o===null?s():t.hasAttribute(n)?(c(),s()):c()}i.forEach((e,t)=>{le(t,e)}),r.forEach((e,t)=>{k.forEach(n=>n(t,e))});for(let e of n)t.some(t=>t.contains(e))||re.forEach(t=>t(e));for(let e of t)e.isConnected&&ie.forEach(t=>t(e));t=null,n=null,r=null,i=null}function be(e){return Se(N(e))}function xe(e,t,n){return e._x_dataStack=[t,...N(n||e)],()=>{e._x_dataStack=e._x_dataStack.filter(e=>e!==t)}}function N(e){return e._x_dataStack?e._x_dataStack:typeof ShadowRoot==`function`&&e instanceof ShadowRoot?N(e.host):e.parentNode?N(e.parentNode):[]}function Se(e){return new Proxy({objects:e},we)}function Ce(e,t){return e===null||e===Object.prototype?null:Object.prototype.hasOwnProperty.call(e,t)?e:Ce(Object.getPrototypeOf(e),t)}var we={ownKeys({objects:e}){return Array.from(new Set(e.flatMap(e=>Object.keys(e))))},has({objects:e},t){return t==Symbol.unscopables?!1:e.some(e=>Object.prototype.hasOwnProperty.call(e,t)||Reflect.has(e,t))},get({objects:e},t,n){return t==`toJSON`?Te:Reflect.get(e.find(e=>Reflect.has(e,t))||{},t,n)},set({objects:e},t,n,r){let i;for(let n of e)if(i=Ce(n,t),i)break;i||=e[e.length-1];let a=Object.getOwnPropertyDescriptor(i,t);return a?.set&&a?.get?a.set.call(r,n)||!0:Reflect.set(i,t,n)}};function Te(){return Reflect.ownKeys(this).reduce((e,t)=>(e[t]=Reflect.get(this,t),e),{})}function Ee(e){let t=e=>typeof e==`object`&&!Array.isArray(e)&&e!==null,n=(r,i=``)=>{Object.entries(Object.getOwnPropertyDescriptors(r)).forEach(([a,{value:o,enumerable:s}])=>{if(s===!1||o===void 0||typeof o==`object`&&o&&o.__v_skip)return;let c=i===``?a:`${i}.${a}`;typeof o==`object`&&o&&o._x_interceptor?r[a]=o.initialize(e,c,a):t(o)&&o!==r&&!(o instanceof Element)&&n(o,c)})};return n(e)}function De(e,t=()=>{}){let n={initialValue:void 0,_x_interceptor:!0,initialize(t,n,r){return e(this.initialValue,()=>Oe(t,n),e=>ke(t,n,e),n,r)}};return t(n),e=>{if(typeof e==`object`&&e&&e._x_interceptor){let t=n.initialize.bind(n);n.initialize=(r,i,a)=>(n.initialValue=e.initialize(r,i,a),t(r,i,a))}else n.initialValue=e;return n}}function Oe(e,t){return t.split(`.`).reduce((e,t)=>e[t],e)}function ke(e,t,n){if(typeof t==`string`&&(t=t.split(`.`)),t.length===1)e[t[0]]=n;else if(t.length===0)throw error;else if(e[t[0]])return ke(e[t[0]],t.slice(1),n);else return e[t[0]]={},ke(e[t[0]],t.slice(1),n)}var Ae={};function je(e,t){Ae[e]=t}function Me(e,t){let n=Ne(t);return Object.entries(Ae).forEach(([r,i])=>{Object.defineProperty(e,`$${r}`,{get(){return i(t,n)},enumerable:!1})}),e}function Ne(e){let[t,n]=pt(e),r={interceptor:De,...t};return oe(e,n),r}function Pe(e,t,n,...r){try{return n(...r)}catch(n){Fe(n,e,t)}}function Fe(...e){return Ie(...e)}var Ie=Re;function Le(e){Ie=e}function Re(e,t,n=void 0){e=Object.assign(e??{message:`No error message given.`},{el:t,expression:n}),console.warn(`Alpine Expression Error: ${e.message}

${n?`Expression: "`+n+`"

`:``}`,t),setTimeout(()=>{throw e},0)}var ze=!0;function Be(e){let t=ze;ze=!1;let n=e();return ze=t,n}function Ve(e,t,n={}){let r;return He(e,t)(e=>r=e,n),r}function He(...e){return Ue(...e)}var Ue=()=>{};function We(e){Ue=e}var Ge;function Ke(e){Ge=e}function qe(e,t){let n={};Me(n,e);let r=[n,...N(e)],i=typeof t==`function`?Je(r,t):Ze(r,t,e);return Pe.bind(null,e,t,i)}function Je(e,t){return(n=()=>{},{scope:r={},params:i=[],context:a}={})=>{if(!ze){Qe(n,t,Se([r,...e]),i);return}Qe(n,t.apply(Se([r,...e]),i))}}var Ye={};function Xe(e,t){if(Ye[e])return Ye[e];let n=Object.getPrototypeOf(async function(){}).constructor,r=/^[\n\s]*if.*\(.*\)/.test(e.trim())||/^(let|const)\s/.test(e.trim())?`(async()=>{ ${e} })()`:e,i=(()=>{try{let t=new n([`__self`,`scope`],`with (scope) { __self.result = ${r} }; __self.finished = true; return __self.result;`);return Object.defineProperty(t,`name`,{value:`[Alpine] ${e}`}),t}catch(n){return Fe(n,t,e),Promise.resolve()}})();return Ye[e]=i,i}function Ze(e,t,n){let r=Xe(t,n);return(i=()=>{},{scope:a={},params:o=[],context:s}={})=>{r.result=void 0,r.finished=!1;let c=Se([a,...e]);if(typeof r==`function`){let e=r.call(s,r,c).catch(e=>Fe(e,n,t));r.finished?(Qe(i,r.result,c,o,n),r.result=void 0):e.then(e=>{Qe(i,e,c,o,n)}).catch(e=>Fe(e,n,t)).finally(()=>r.result=void 0)}}}function Qe(e,t,n,r,i){if(ze&&typeof t==`function`){let a=t.apply(n,r);a instanceof Promise?a.then(t=>Qe(e,t,n,r)).catch(e=>Fe(e,i,t)):e(a)}else typeof t==`object`&&t instanceof Promise?t.then(t=>e(t)):e(t)}function $e(...e){return Ge(...e)}function et(e,t,n={}){let r={};Me(r,e);let i=[r,...N(e)],a=Se([n.scope??{},...i]),o=n.params??[];if(t.includes(`await`)){let e=Object.getPrototypeOf(async function(){}).constructor;return new e([`scope`],`with (scope) { let __result = ${/^[\n\s]*if.*\(.*\)/.test(t.trim())||/^(let|const)\s/.test(t.trim())?`(async()=>{ ${t} })()`:t}; return __result }`).call(n.context,a)}else{let e=/^[\n\s]*if.*\(.*\)/.test(t.trim())||/^(let|const)\s/.test(t.trim())?`(()=>{ ${t} })()`:t,r=Function([`scope`],`with (scope) { let __result = ${e}; return __result }`).call(n.context,a);return typeof r==`function`&&ze?r.apply(a,o):r}}var tt=`x-`;function nt(e=``){return tt+e}function rt(e){tt=e}var it={};function at(e,t){return it[e]=t,{before(t){if(!it[t]){console.warn(String.raw`Cannot find directive \`${t}\`. \`${e}\` will use the default order of execution`);return}let n=wt.indexOf(t);wt.splice(n>=0?n:wt.indexOf(`DEFAULT`),0,e)}}}function ot(e){return Object.keys(it).includes(e)}function st(e,t,n){if(t=Array.from(t),e._x_virtualDirectives){let n=Object.entries(e._x_virtualDirectives).map(([e,t])=>({name:e,value:t})),r=ct(n);n=n.map(e=>r.find(t=>t.name===e.name)?{name:`x-bind:${e.name}`,value:`"${e.value}"`}:e),t=t.concat(n)}let r={};return t.map(_t((e,t)=>r[e]=t)).filter(bt).map(St(r,n)).sort(Tt).map(t=>mt(e,t))}function ct(e){return Array.from(e).map(_t()).filter(e=>!bt(e))}var lt=!1,ut=new Map,dt=Symbol();function ft(e){lt=!0;let t=Symbol();dt=t,ut.set(t,[]);let n=()=>{for(;ut.get(t).length;)ut.get(t).shift()();ut.delete(t)};e(n),lt=!1,n()}function pt(e){let t=[],n=e=>t.push(e),[r,i]=ee(e);return t.push(i),[{Alpine:ar,effect:r,cleanup:n,evaluateLater:He.bind(He,e),evaluate:Ve.bind(Ve,e)},()=>t.forEach(e=>e())]}function mt(e,t){let n=it[t.type]||(()=>{}),[r,i]=pt(e);ce(e,t.original,i);let a=()=>{e._x_ignore||e._x_ignoreSelf||(n.inline&&n.inline(e,t,r),n=n.bind(n,e,t,r),lt?ut.get(dt).push(n):n())};return a.runCleanups=i,a}var ht=(e,t)=>({name:n,value:r})=>(n.startsWith(e)&&(n=n.replace(e,t)),{name:n,value:r}),gt=e=>e;function _t(e=()=>{}){return({name:t,value:n})=>{let{name:r,value:i}=vt.reduce((e,t)=>t(e),{name:t,value:n});return r!==t&&e(r,t),{name:r,value:i}}}var vt=[];function yt(e){vt.push(e)}function bt({name:e}){return xt().test(e)}var xt=()=>RegExp(`^${tt}([^:^.]+)\\b`);function St(e,t){return({name:n,value:r})=>{n===r&&(r=``);let i=n.match(xt()),a=n.match(/:([a-zA-Z0-9\-_:]+)/),o=n.match(/\.[^.\]]+(?=[^\]]*$)/g)||[],s=t||e[n]||n;return{type:i?i[1]:null,value:a?a[1]:null,modifiers:o.map(e=>e.replace(`.`,``)),expression:r,original:s}}}var Ct=`DEFAULT`,wt=[`ignore`,`ref`,`id`,`data`,`anchor`,`bind`,`init`,`for`,`model`,`modelable`,`transition`,`show`,`if`,Ct,`teleport`];function Tt(e,t){let n=wt.indexOf(e.type)===-1?Ct:e.type,r=wt.indexOf(t.type)===-1?Ct:t.type;return wt.indexOf(n)-wt.indexOf(r)}function Et(e,t,n={},r={}){return e.dispatchEvent(new CustomEvent(t,{detail:n,bubbles:!0,composed:!0,cancelable:!0,...r}))}function Dt(e,t){if(typeof ShadowRoot==`function`&&e instanceof ShadowRoot){Array.from(e.children).forEach(e=>Dt(e,t));return}let n=!1;if(t(e,()=>n=!0),n)return;let r=e.firstElementChild;for(;r;)Dt(r,t,!1),r=r.nextElementSibling}function Ot(e,...t){console.warn(`Alpine Warning: ${e}`,...t)}var kt=!1;function At(){kt&&Ot(`Alpine has already been initialized on this page. Calling Alpine.start() more than once can cause problems.`),kt=!0,document.body||Ot("Unable to initialize. Trying to load Alpine before `<body>` is available. Did you forget to add `defer` in Alpine's `<script>` tag?"),Et(document,`alpine:init`),Et(document,`alpine:initializing`),pe(),ae(e=>Ut(e,Dt)),oe(e=>Wt(e)),se((e,t)=>{st(e,t).forEach(e=>e())}),Array.from(document.querySelectorAll(Pt().join(`,`))).filter(e=>!Lt(e.parentElement,!0)).forEach(e=>{Ut(e)}),Et(document,`alpine:initialized`),setTimeout(()=>{Gt()})}var jt=[],Mt=[];function Nt(){return jt.map(e=>e())}function Pt(){return jt.concat(Mt).map(e=>e())}function Ft(e){jt.push(e)}function It(e){Mt.push(e)}function Lt(e,t=!1){return Rt(e,e=>{if((t?Pt():Nt()).some(t=>e.matches(t)))return!0})}function Rt(e,t){if(e){if(t(e))return e;if(e._x_teleportBack)return Rt(e._x_teleportBack,t);if(e.parentNode instanceof ShadowRoot)return Rt(e.parentNode.host,t);if(e.parentElement)return Rt(e.parentElement,t)}}function zt(e){return Nt().some(t=>e.matches(t))}var Bt=[];function Vt(e){Bt.push(e)}var Ht=1;function Ut(e,t=Dt,n=()=>{}){Rt(e,e=>e._x_ignore)||ft(()=>{t(e,(e,t)=>{e._x_marker||(n(e,t),Bt.forEach(n=>n(e,t)),st(e,e.attributes).forEach(e=>e()),e._x_ignore||(e._x_marker=Ht++),e._x_ignore&&t())})})}function Wt(e,t=Dt){t(e,e=>{ue(e),le(e),delete e._x_marker})}function Gt(){[[`ui`,`dialog`,[`[x-dialog], [x-popover]`]],[`anchor`,`anchor`,[`[x-anchor]`]],[`sort`,`sort`,[`[x-sort]`]]].forEach(([e,t,n])=>{ot(t)||n.some(t=>{if(document.querySelector(t))return Ot(`found "${t}", but missing ${e} plugin`),!0})})}var Kt=[],qt=!1;function P(e=()=>{}){return queueMicrotask(()=>{qt||setTimeout(()=>{Jt()})}),new Promise(t=>{Kt.push(()=>{e(),t()})})}function Jt(){for(qt=!1;Kt.length;)Kt.shift()()}function Yt(){qt=!0}function Xt(e,t){return Array.isArray(t)?Qt(e,t.join(` `)):typeof t==`object`&&t?$t(e,t):typeof t==`function`?Xt(e,t()):Qt(e,t)}function Zt(e){return e.split(/\s/).filter(Boolean)}function Qt(e,t){return t=t===!0?t=``:t||``,(t=>(e.classList.add(...t),()=>{e.classList.remove(...t)}))((t=>Zt(t).filter(t=>!e.classList.contains(t)).filter(Boolean))(t))}function $t(e,t){let n=Object.entries(t).flatMap(([e,t])=>t?Zt(e):!1).filter(Boolean),r=Object.entries(t).flatMap(([e,t])=>t?!1:Zt(e)).filter(Boolean),i=[],a=[];return r.forEach(t=>{e.classList.contains(t)&&(e.classList.remove(t),a.push(t))}),n.forEach(t=>{e.classList.contains(t)||(e.classList.add(t),i.push(t))}),()=>{a.forEach(t=>e.classList.add(t)),i.forEach(t=>e.classList.remove(t))}}function en(e,t){return typeof t==`object`&&t?tn(e,t):nn(e,t)}function tn(e,t){let n={};return Object.entries(t).forEach(([t,r])=>{n[t]=e.style[t],t.startsWith(`--`)||(t=rn(t)),e.style.setProperty(t,r)}),setTimeout(()=>{e.style.length===0&&e.removeAttribute(`style`)}),()=>{en(e,n)}}function nn(e,t){let n=e.getAttribute(`style`,t);return e.setAttribute(`style`,t),()=>{e.setAttribute(`style`,n||``)}}function rn(e){return e.replace(/([a-z])([A-Z])/g,`$1-$2`).toLowerCase()}function an(e,t=()=>{}){let n=!1;return function(){n?t.apply(this,arguments):(n=!0,e.apply(this,arguments))}}at(`transition`,(e,{value:t,modifiers:n,expression:r},{evaluate:i})=>{typeof r==`function`&&(r=i(r)),r!==!1&&(!r||typeof r==`boolean`?sn(e,n,t):on(e,r,t))});function on(e,t,n){cn(e,Xt,``),{enter:t=>{e._x_transition.enter.during=t},"enter-start":t=>{e._x_transition.enter.start=t},"enter-end":t=>{e._x_transition.enter.end=t},leave:t=>{e._x_transition.leave.during=t},"leave-start":t=>{e._x_transition.leave.start=t},"leave-end":t=>{e._x_transition.leave.end=t}}[n](t)}function sn(e,t,n){cn(e,en);let r=!t.includes(`in`)&&!t.includes(`out`)&&!n,i=r||t.includes(`in`)||[`enter`].includes(n),a=r||t.includes(`out`)||[`leave`].includes(n);t.includes(`in`)&&!r&&(t=t.filter((e,n)=>n<t.indexOf(`out`))),t.includes(`out`)&&!r&&(t=t.filter((e,n)=>n>t.indexOf(`out`)));let o=!t.includes(`opacity`)&&!t.includes(`scale`),s=o||t.includes(`opacity`),c=o||t.includes(`scale`),l=+!s,u=c?fn(t,`scale`,95)/100:1,d=fn(t,`delay`,0)/1e3,f=fn(t,`origin`,`center`),p=`opacity, transform`,m=fn(t,`duration`,150)/1e3,h=fn(t,`duration`,75)/1e3,g=`cubic-bezier(0.4, 0.0, 0.2, 1)`;i&&(e._x_transition.enter.during={transformOrigin:f,transitionDelay:`${d}s`,transitionProperty:p,transitionDuration:`${m}s`,transitionTimingFunction:g},e._x_transition.enter.start={opacity:l,transform:`scale(${u})`},e._x_transition.enter.end={opacity:1,transform:`scale(1)`}),a&&(e._x_transition.leave.during={transformOrigin:f,transitionDelay:`${d}s`,transitionProperty:p,transitionDuration:`${h}s`,transitionTimingFunction:g},e._x_transition.leave.start={opacity:1,transform:`scale(1)`},e._x_transition.leave.end={opacity:l,transform:`scale(${u})`})}function cn(e,t,n={}){e._x_transition||={enter:{during:n,start:n,end:n},leave:{during:n,start:n,end:n},in(n=()=>{},r=()=>{}){un(e,t,{during:this.enter.during,start:this.enter.start,end:this.enter.end},n,r)},out(n=()=>{},r=()=>{}){un(e,t,{during:this.leave.during,start:this.leave.start,end:this.leave.end},n,r)}}}window.Element.prototype._x_toggleAndCascadeWithTransitions=function(e,t,n,r){let i=document.visibilityState===`visible`?requestAnimationFrame:setTimeout,a=()=>i(n);if(t){e._x_transition&&(e._x_transition.enter||e._x_transition.leave)?e._x_transition.enter&&(Object.entries(e._x_transition.enter.during).length||Object.entries(e._x_transition.enter.start).length||Object.entries(e._x_transition.enter.end).length)?e._x_transition.in(n):a():e._x_transition?e._x_transition.in(n):a();return}e._x_hidePromise=e._x_transition?new Promise((t,n)=>{e._x_transition.out(()=>{},()=>t(r)),e._x_transitioning&&e._x_transitioning.beforeCancel(()=>n({isFromCancelledTransition:!0}))}):Promise.resolve(r),queueMicrotask(()=>{let t=ln(e);t?(t._x_hideChildren||=[],t._x_hideChildren.push(e)):i(()=>{let t=e=>{let n=Promise.all([e._x_hidePromise,...(e._x_hideChildren||[]).map(t)]).then(([e])=>e?.());return delete e._x_hidePromise,delete e._x_hideChildren,n};t(e).catch(e=>{if(!e.isFromCancelledTransition)throw e})})})};function ln(e){let t=e.parentNode;if(t)return t._x_hidePromise?t:ln(t)}function un(e,t,{during:n,start:r,end:i}={},a=()=>{},o=()=>{}){if(e._x_transitioning&&e._x_transitioning.cancel(),Object.keys(n).length===0&&Object.keys(r).length===0&&Object.keys(i).length===0){a(),o();return}let s,c,l;dn(e,{start(){s=t(e,r)},during(){c=t(e,n)},before:a,end(){s(),l=t(e,i)},after:o,cleanup(){c(),l()}})}function dn(e,t){let n,r,i,a=an(()=>{A(()=>{n=!0,r||t.before(),i||(t.end(),Jt()),t.after(),e.isConnected&&t.cleanup(),delete e._x_transitioning})});e._x_transitioning={beforeCancels:[],beforeCancel(e){this.beforeCancels.push(e)},cancel:an(function(){for(;this.beforeCancels.length;)this.beforeCancels.shift()();a()}),finish:a},A(()=>{t.start(),t.during()}),Yt(),requestAnimationFrame(()=>{if(n)return;let a=Number(getComputedStyle(e).transitionDuration.replace(/,.*/,``).replace(`s`,``))*1e3,o=Number(getComputedStyle(e).transitionDelay.replace(/,.*/,``).replace(`s`,``))*1e3;a===0&&(a=Number(getComputedStyle(e).animationDuration.replace(`s`,``))*1e3),A(()=>{t.before()}),r=!0,requestAnimationFrame(()=>{n||(A(()=>{t.end()}),Jt(),setTimeout(e._x_transitioning.finish,a+o),i=!0)})})}function fn(e,t,n){if(e.indexOf(t)===-1)return n;let r=e[e.indexOf(t)+1];if(!r||t===`scale`&&isNaN(r))return n;if(t===`duration`||t===`delay`){let e=r.match(/([0-9]+)ms/);if(e)return e[1]}return t===`origin`&&[`top`,`right`,`left`,`center`,`bottom`].includes(e[e.indexOf(t)+2])?[r,e[e.indexOf(t)+2]].join(` `):r}var pn=!1;function mn(e,t=()=>{}){return(...n)=>pn?t(...n):e(...n)}function hn(e){return(...t)=>pn&&e(...t)}var gn=[];function _n(e){gn.push(e)}function vn(e,t){gn.forEach(n=>n(e,t)),pn=!0,Sn(()=>{Ut(t,(e,t)=>{t(e,()=>{})})}),pn=!1}var yn=!1;function bn(e,t){t._x_dataStack||=e._x_dataStack,pn=!0,yn=!0,Sn(()=>{xn(t)}),pn=!1,yn=!1}function xn(e){let t=!1;Ut(e,(e,n)=>{Dt(e,(e,r)=>{if(t&&zt(e))return r();t=!0,n(e,r)})})}function Sn(e){let t=S;O((e,n)=>{let r=t(e);return C(r),()=>{}}),e(),O(t)}function Cn(e,t,n,r=[]){switch(e._x_bindings||=x({}),e._x_bindings[t]=n,t=r.includes(`camel`)?Mn(t):t,t){case`value`:wn(e,n);break;case`style`:En(e,n);break;case`class`:Tn(e,n);break;case`selected`:case`checked`:Dn(e,t,n);break;default:On(e,t,n);break}}function wn(e,t){if(Hn(e))e.attributes.value===void 0&&(e.value=t);else if(Vn(e))Number.isInteger(t)?e.value=t:!Array.isArray(t)&&typeof t!=`boolean`&&![null,void 0].includes(t)?e.value=String(t):Array.isArray(t)?e.checked=t.some(t=>Nn(t,e.value)):e.checked=!!t;else if(e.tagName===`SELECT`)jn(e,t);else{if(e.value===t)return;e.value=t===void 0?``:t}}function Tn(e,t){e._x_undoAddedClasses&&e._x_undoAddedClasses(),e._x_undoAddedClasses=Xt(e,t)}function En(e,t){e._x_undoAddedStyles&&e._x_undoAddedStyles(),e._x_undoAddedStyles=en(e,t)}function Dn(e,t,n){On(e,t,n),An(e,t,n)}function On(e,t,n){[null,void 0,!1].includes(n)&&Ln(t)?e.removeAttribute(t):(In(t)&&(n=t),kn(e,t,n))}function kn(e,t,n){e.getAttribute(t)!=n&&e.setAttribute(t,n)}function An(e,t,n){e[t]!==n&&(e[t]=n)}function jn(e,t){let n=[].concat(t).map(e=>e+``);Array.from(e.options).forEach(e=>{e.selected=n.includes(e.value)})}function Mn(e){return e.toLowerCase().replace(/-(\w)/g,(e,t)=>t.toUpperCase())}function Nn(e,t){return e==t}function Pn(e){return[1,`1`,`true`,`on`,`yes`,!0].includes(e)?!0:[0,`0`,`false`,`off`,`no`,!1].includes(e)?!1:e?!!e:null}var Fn=new Set(`allowfullscreen.async.autofocus.autoplay.checked.controls.default.defer.disabled.formnovalidate.inert.ismap.itemscope.loop.multiple.muted.nomodule.novalidate.open.playsinline.readonly.required.reversed.selected.shadowrootclonable.shadowrootdelegatesfocus.shadowrootserializable`.split(`.`));function In(e){return Fn.has(e)}function Ln(e){return![`aria-pressed`,`aria-checked`,`aria-expanded`,`aria-selected`].includes(e)}function Rn(e,t,n){return e._x_bindings&&e._x_bindings[t]!==void 0?e._x_bindings[t]:Bn(e,t,n)}function zn(e,t,n,r=!0){if(e._x_bindings&&e._x_bindings[t]!==void 0)return e._x_bindings[t];if(e._x_inlineBindings&&e._x_inlineBindings[t]!==void 0){let n=e._x_inlineBindings[t];return n.extract=r,Be(()=>Ve(e,n.expression))}return Bn(e,t,n)}function Bn(e,t,n){let r=e.getAttribute(t);return r===null?typeof n==`function`?n():n:r===``?!0:In(t)?!![t,`true`].includes(r):r}function Vn(e){return e.type===`checkbox`||e.localName===`ui-checkbox`||e.localName===`ui-switch`}function Hn(e){return e.type===`radio`||e.localName===`ui-radio`}function Un(e,t){let n;return function(){let r=this,i=arguments;clearTimeout(n),n=setTimeout(function(){n=null,e.apply(r,i)},t)}}function Wn(e,t){let n;return function(){let r=this,i=arguments;n||(e.apply(r,i),n=!0,setTimeout(()=>n=!1,t))}}function Gn({get:e,set:t},{get:n,set:r}){let i=!0,a,o=S(()=>{let o=e(),s=n();if(i)r(Kn(o)),i=!1;else{let e=JSON.stringify(o),n=JSON.stringify(s);e===a?e!==n&&t(Kn(s)):r(Kn(o))}a=JSON.stringify(e()),JSON.stringify(n())});return()=>{C(o)}}function Kn(e){return typeof e==`object`?JSON.parse(JSON.stringify(e)):e}function qn(e){(Array.isArray(e)?e:[e]).forEach(e=>e(ar))}var Jn={},Yn=!1;function Xn(e,t){if(Yn||=(Jn=x(Jn),!0),t===void 0)return Jn[e];Jn[e]=t,Ee(Jn[e]),typeof t==`object`&&t&&t.hasOwnProperty(`init`)&&typeof t.init==`function`&&Jn[e].init()}function Zn(){return Jn}var Qn={};function $n(e,t){let n=typeof t==`function`?t:()=>t;return e instanceof Element?tr(e,n()):(Qn[e]=n,()=>{})}function er(e){return Object.entries(Qn).forEach(([t,n])=>{Object.defineProperty(e,t,{get(){return(...e)=>n(...e)}})}),e}function tr(e,t,n){let r=[];for(;r.length;)r.pop()();let i=Object.entries(t).map(([e,t])=>({name:e,value:t})),a=ct(i);return i=i.map(e=>a.find(t=>t.name===e.name)?{name:`x-bind:${e.name}`,value:`"${e.value}"`}:e),st(e,i,n).map(e=>{r.push(e.runCleanups),e()}),()=>{for(;r.length;)r.pop()()}}var nr={};function rr(e,t){nr[e]=t}function ir(e,t){return Object.entries(nr).forEach(([n,r])=>{Object.defineProperty(e,n,{get(){return(...e)=>r.bind(t)(...e)},enumerable:!1})}),e}var ar={get reactive(){return x},get release(){return C},get effect(){return S},get raw(){return w},get transaction(){return ne},version:`3.15.12`,flushAndStopDeferringMutations:ve,dontAutoEvaluateFunctions:Be,disableEffectScheduling:E,startObservingMutations:pe,stopObservingMutations:me,setReactivityEngine:D,onAttributeRemoved:ce,onAttributesAdded:se,closestDataStack:N,skipDuringClone:mn,onlyDuringClone:hn,addRootSelector:Ft,addInitSelector:It,setErrorHandler:Le,interceptClone:_n,addScopeToNode:xe,deferMutations:_e,mapAttributes:yt,evaluateLater:He,interceptInit:Vt,initInterceptors:Ee,injectMagics:Me,setEvaluator:We,setRawEvaluator:Ke,mergeProxies:Se,extractProp:zn,findClosest:Rt,onElRemoved:oe,closestRoot:Lt,destroyTree:Wt,interceptor:De,transition:un,setStyles:en,mutateDom:A,directive:at,entangle:Gn,throttle:Wn,debounce:Un,evaluate:Ve,evaluateRaw:$e,initTree:Ut,nextTick:P,prefixed:nt,prefix:rt,plugin:qn,magic:je,store:Xn,start:At,clone:bn,cloneNode:vn,bound:Rn,$data:be,watch:te,walk:Dt,data:rr,bind:$n};function or(e,t){let n=Object.create(null),r=e.split(`,`);for(let e=0;e<r.length;e++)n[r[e]]=!0;return t?e=>!!n[e.toLowerCase()]:e=>!!n[e]}var sr=Object.freeze({});Object.freeze([]);var cr=Object.prototype.hasOwnProperty,lr=(e,t)=>cr.call(e,t),ur=Array.isArray,dr=e=>gr(e)===`[object Map]`,fr=e=>typeof e==`string`,pr=e=>typeof e==`symbol`,mr=e=>typeof e==`object`&&!!e,hr=Object.prototype.toString,gr=e=>hr.call(e),_r=e=>gr(e).slice(8,-1),vr=e=>fr(e)&&e!==`NaN`&&e[0]!==`-`&&``+parseInt(e,10)===e,yr=(e=>{let t=Object.create(null);return n=>t[n]||(t[n]=e(n))})(e=>e.charAt(0).toUpperCase()+e.slice(1)),br=(e,t)=>e!==t&&(e===e||t===t),xr=new WeakMap,Sr=[],Cr,wr=Symbol(`iterate`),Tr=Symbol(`Map key iterate`);function Er(e){return e&&e._isEffect===!0}function Dr(e,t=sr){Er(e)&&(e=e.raw);let n=Ar(e,t);return t.lazy||n(),n}function Or(e){e.active&&=(jr(e),e.options.onStop&&e.options.onStop(),!1)}var kr=0;function Ar(e,t){let n=function(){if(!n.active)return e();if(!Sr.includes(n)){jr(n);try{return Fr(),Sr.push(n),Cr=n,e()}finally{Sr.pop(),Ir(),Cr=Sr[Sr.length-1]}}};return n.id=kr++,n.allowRecurse=!!t.allowRecurse,n._isEffect=!0,n.active=!0,n.raw=e,n.deps=[],n.options=t,n}function jr(e){let{deps:t}=e;if(t.length){for(let n=0;n<t.length;n++)t[n].delete(e);t.length=0}}var Mr=!0,Nr=[];function Pr(){Nr.push(Mr),Mr=!1}function Fr(){Nr.push(Mr),Mr=!0}function Ir(){let e=Nr.pop();Mr=e===void 0?!0:e}function Lr(e,t,n){if(!Mr||Cr===void 0)return;let r=xr.get(e);r||xr.set(e,r=new Map);let i=r.get(n);i||r.set(n,i=new Set),i.has(Cr)||(i.add(Cr),Cr.deps.push(i),Cr.options.onTrack&&Cr.options.onTrack({effect:Cr,target:e,type:t,key:n}))}function Rr(e,t,n,r,i,a){let o=xr.get(e);if(!o)return;let s=new Set,c=e=>{e&&e.forEach(e=>{(e!==Cr||e.allowRecurse)&&s.add(e)})};if(t===`clear`)o.forEach(c);else if(n===`length`&&ur(e))o.forEach((e,t)=>{(t===`length`||t>=r)&&c(e)});else switch(n!==void 0&&c(o.get(n)),t){case`add`:ur(e)?vr(n)&&c(o.get(`length`)):(c(o.get(wr)),dr(e)&&c(o.get(Tr)));break;case`delete`:ur(e)||(c(o.get(wr)),dr(e)&&c(o.get(Tr)));break;case`set`:dr(e)&&c(o.get(wr));break}s.forEach(o=>{o.options.onTrigger&&o.options.onTrigger({effect:o,target:e,key:n,type:t,newValue:r,oldValue:i,oldTarget:a}),o.options.scheduler?o.options.scheduler(o):o()})}var zr=or(`__proto__,__v_isRef,__isVue`),Br=new Set(Object.getOwnPropertyNames(Symbol).map(e=>Symbol[e]).filter(pr)),Vr=Gr(),Hr=Gr(!0),Ur=Wr();function Wr(){let e={};return[`includes`,`indexOf`,`lastIndexOf`].forEach(t=>{e[t]=function(...e){let n=F(this);for(let e=0,t=this.length;e<t;e++)Lr(n,`get`,e+``);let r=n[t](...e);return r===-1||r===!1?n[t](...e.map(F)):r}}),[`push`,`pop`,`shift`,`unshift`,`splice`].forEach(t=>{e[t]=function(...e){Pr();let n=F(this)[t].apply(this,e);return Ir(),n}}),e}function Gr(e=!1,t=!1){return function(n,r,i){if(r===`__v_isReactive`)return!e;if(r===`__v_isReadonly`)return e;if(r===`__v_raw`&&i===(e?t?Ti:wi:t?Ci:Si).get(n))return n;let a=ur(n);if(!e&&a&&lr(Ur,r))return Reflect.get(Ur,r,i);let o=Reflect.get(n,r,i);return(pr(r)?Br.has(r):zr(r))||(e||Lr(n,`get`,r),t)?o:ji(o)?!a||!vr(r)?o.value:o:mr(o)?e?ki(o):Oi(o):o}}var Kr=qr();function qr(e=!1){return function(t,n,r,i){let a=t[n];if(!e&&(r=F(r),a=F(a),!ur(t)&&ji(a)&&!ji(r)))return a.value=r,!0;let o=ur(t)&&vr(n)?Number(n)<t.length:lr(t,n),s=Reflect.set(t,n,r,i);return t===F(i)&&(o?br(r,a)&&Rr(t,`set`,n,r,a):Rr(t,`add`,n,r)),s}}function Jr(e,t){let n=lr(e,t),r=e[t],i=Reflect.deleteProperty(e,t);return i&&n&&Rr(e,`delete`,t,void 0,r),i}function Yr(e,t){let n=Reflect.has(e,t);return(!pr(t)||!Br.has(t))&&Lr(e,`has`,t),n}function Xr(e){return Lr(e,`iterate`,ur(e)?`length`:wr),Reflect.ownKeys(e)}var Zr={get:Vr,set:Kr,deleteProperty:Jr,has:Yr,ownKeys:Xr},Qr={get:Hr,set(e,t){return console.warn(`Set operation on key "${String(t)}" failed: target is readonly.`,e),!0},deleteProperty(e,t){return console.warn(`Delete operation on key "${String(t)}" failed: target is readonly.`,e),!0}},$r=e=>mr(e)?Oi(e):e,ei=e=>mr(e)?ki(e):e,ti=e=>e,ni=e=>Reflect.getPrototypeOf(e);function ri(e,t,n=!1,r=!1){e=e.__v_raw;let i=F(e),a=F(t);t!==a&&!n&&Lr(i,`get`,t),!n&&Lr(i,`get`,a);let{has:o}=ni(i),s=r?ti:n?ei:$r;if(o.call(i,t))return s(e.get(t));if(o.call(i,a))return s(e.get(a));e!==i&&e.get(t)}function ii(e,t=!1){let n=this.__v_raw,r=F(n),i=F(e);return e!==i&&!t&&Lr(r,`has`,e),!t&&Lr(r,`has`,i),e===i?n.has(e):n.has(e)||n.has(i)}function ai(e,t=!1){return e=e.__v_raw,!t&&Lr(F(e),`iterate`,wr),Reflect.get(e,`size`,e)}function oi(e){e=F(e);let t=F(this);return ni(t).has.call(t,e)||(t.add(e),Rr(t,`add`,e,e)),this}function si(e,t){t=F(t);let n=F(this),{has:r,get:i}=ni(n),a=r.call(n,e);a?xi(n,r,e):(e=F(e),a=r.call(n,e));let o=i.call(n,e);return n.set(e,t),a?br(t,o)&&Rr(n,`set`,e,t,o):Rr(n,`add`,e,t),this}function ci(e){let t=F(this),{has:n,get:r}=ni(t),i=n.call(t,e);i?xi(t,n,e):(e=F(e),i=n.call(t,e));let a=r?r.call(t,e):void 0,o=t.delete(e);return i&&Rr(t,`delete`,e,void 0,a),o}function li(){let e=F(this),t=e.size!==0,n=dr(e)?new Map(e):new Set(e),r=e.clear();return t&&Rr(e,`clear`,void 0,void 0,n),r}function ui(e,t){return function(n,r){let i=this,a=i.__v_raw,o=F(a),s=t?ti:e?ei:$r;return!e&&Lr(o,`iterate`,wr),a.forEach((e,t)=>n.call(r,s(e),s(t),i))}}function di(e,t,n){return function(...r){let i=this.__v_raw,a=F(i),o=dr(a),s=e===`entries`||e===Symbol.iterator&&o,c=e===`keys`&&o,l=i[e](...r),u=n?ti:t?ei:$r;return!t&&Lr(a,`iterate`,c?Tr:wr),{next(){let{value:e,done:t}=l.next();return t?{value:e,done:t}:{value:s?[u(e[0]),u(e[1])]:u(e),done:t}},[Symbol.iterator](){return this}}}}function fi(e){return function(...t){{let n=t[0]?`on key "${t[0]}" `:``;console.warn(`${yr(e)} operation ${n}failed: target is readonly.`,F(this))}return e===`delete`?!1:this}}function pi(){let e={get(e){return ri(this,e)},get size(){return ai(this)},has:ii,add:oi,set:si,delete:ci,clear:li,forEach:ui(!1,!1)},t={get(e){return ri(this,e,!1,!0)},get size(){return ai(this)},has:ii,add:oi,set:si,delete:ci,clear:li,forEach:ui(!1,!0)},n={get(e){return ri(this,e,!0)},get size(){return ai(this,!0)},has(e){return ii.call(this,e,!0)},add:fi(`add`),set:fi(`set`),delete:fi(`delete`),clear:fi(`clear`),forEach:ui(!0,!1)},r={get(e){return ri(this,e,!0,!0)},get size(){return ai(this,!0)},has(e){return ii.call(this,e,!0)},add:fi(`add`),set:fi(`set`),delete:fi(`delete`),clear:fi(`clear`),forEach:ui(!0,!0)};return[`keys`,`values`,`entries`,Symbol.iterator].forEach(i=>{e[i]=di(i,!1,!1),n[i]=di(i,!0,!1),t[i]=di(i,!1,!0),r[i]=di(i,!0,!0)}),[e,n,t,r]}var[mi,hi,gi,_i]=pi();function vi(e,t){let n=t?e?_i:gi:e?hi:mi;return(t,r,i)=>r===`__v_isReactive`?!e:r===`__v_isReadonly`?e:r===`__v_raw`?t:Reflect.get(lr(n,r)&&r in t?n:t,r,i)}var yi={get:vi(!1,!1)},bi={get:vi(!0,!1)};function xi(e,t,n){let r=F(n);if(r!==n&&t.call(e,r)){let t=_r(e);console.warn(`Reactive ${t} contains both the raw and reactive versions of the same object${t===`Map`?` as keys`:``}, which can lead to inconsistencies. Avoid differentiating between the raw and reactive versions of an object and only use the reactive version if possible.`)}}var Si=new WeakMap,Ci=new WeakMap,wi=new WeakMap,Ti=new WeakMap;function Ei(e){switch(e){case`Object`:case`Array`:return 1;case`Map`:case`Set`:case`WeakMap`:case`WeakSet`:return 2;default:return 0}}function Di(e){return e.__v_skip||!Object.isExtensible(e)?0:Ei(_r(e))}function Oi(e){return e&&e.__v_isReadonly?e:Ai(e,!1,Zr,yi,Si)}function ki(e){return Ai(e,!0,Qr,bi,wi)}function Ai(e,t,n,r,i){if(!mr(e))return console.warn(`value cannot be made reactive: ${String(e)}`),e;if(e.__v_raw&&!(t&&e.__v_isReactive))return e;let a=i.get(e);if(a)return a;let o=Di(e);if(o===0)return e;let s=new Proxy(e,o===2?r:n);return i.set(e,s),s}function F(e){return e&&F(e.__v_raw)||e}function ji(e){return!!(e&&e.__v_isRef===!0)}je(`nextTick`,()=>P),je(`dispatch`,e=>Et.bind(Et,e)),je(`watch`,(e,{evaluateLater:t,cleanup:n})=>(e,r)=>{let i=t(e);n(te(()=>{let e;return i(t=>e=t),e},r))}),je(`store`,Zn),je(`data`,e=>be(e)),je(`root`,e=>Lt(e)),je(`refs`,e=>(e._x_refs_proxy||=Se(Mi(e)),e._x_refs_proxy));function Mi(e){let t=[];return Rt(e,e=>{e._x_refs&&t.push(e._x_refs)}),t}var Ni={};function Pi(e){return Ni[e]||(Ni[e]=0),++Ni[e]}function Fi(e,t){return Rt(e,e=>{if(e._x_ids&&e._x_ids[t])return!0})}function Ii(e,t){e._x_ids||={},e._x_ids[t]||(e._x_ids[t]=Pi(t))}je(`id`,(e,{cleanup:t})=>(n,r=null)=>Li(e,`${n}${r?`-${r}`:``}`,t,()=>{let t=Fi(e,n),i=t?t._x_ids[n]:Pi(n);return r?`${n}-${i}-${r}`:`${n}-${i}`})),_n((e,t)=>{e._x_id&&(t._x_id=e._x_id)});function Li(e,t,n,r){if(e._x_id||={},e._x_id[t])return e._x_id[t];let i=r();return e._x_id[t]=i,n(()=>{delete e._x_id[t]}),i}je(`el`,e=>e),Ri(`Focus`,`focus`,`focus`),Ri(`Persist`,`persist`,`persist`);function Ri(e,t,n){je(t,r=>Ot(`You can't use [$${t}] without first installing the "${e}" plugin here: https://alpinejs.dev/plugins/${n}`,r))}at(`modelable`,(e,{expression:t},{effect:n,evaluateLater:r,cleanup:i})=>{let a=r(t),o=()=>{let e;return a(t=>e=t),e},s=r(`${t} = __placeholder`),c=e=>s(()=>{},{scope:{__placeholder:e}});c(o()),queueMicrotask(()=>{if(!e._x_model)return;e._x_removeModelListeners.default();let t=e._x_model.get,n=e._x_model.setWithModifiers;i(Gn({get(){return t()},set(e){n(e)}},{get(){return o()},set(e){c(e)}}))})}),at(`teleport`,(e,{modifiers:t,expression:n},{cleanup:r})=>{e.tagName.toLowerCase()!==`template`&&Ot(`x-teleport can only be used on a <template> tag`,e);let i=Bi(n),a=e.content.cloneNode(!0).firstElementChild;e._x_teleport=a,a._x_teleportBack=e,e.setAttribute(`data-teleport-template`,!0),a.setAttribute(`data-teleport-target`,!0),e._x_forwardEvents&&e._x_forwardEvents.forEach(t=>{a.addEventListener(t,t=>{t.stopPropagation(),e.dispatchEvent(new t.constructor(t.type,t))})}),xe(a,{},e);let o=(e,t,n)=>{n.includes(`prepend`)?t.parentNode.insertBefore(e,t):n.includes(`append`)?t.parentNode.insertBefore(e,t.nextSibling):t.appendChild(e)};A(()=>{mn(()=>{o(a,i,t),Ut(a)})()}),e._x_teleportPutBack=()=>{let r=Bi(n);A(()=>{o(e._x_teleport,r,t)})},r(()=>A(()=>{a.remove(),Wt(a)}))});var zi=document.createElement(`div`);function Bi(e){let t=mn(()=>document.querySelector(e),()=>zi)();return t||Ot(`Cannot find x-teleport element for selector: "${e}"`),t}var Vi=()=>{};Vi.inline=(e,{modifiers:t},{cleanup:n})=>{t.includes(`self`)?e._x_ignoreSelf=!0:e._x_ignore=!0,n(()=>{t.includes(`self`)?delete e._x_ignoreSelf:delete e._x_ignore})},at(`ignore`,Vi),at(`effect`,mn((e,{expression:t},{effect:n})=>{n(He(e,t))}));function Hi(e,t,n,r){let i=e,a=e=>r(e),o={},s=(e,t)=>n=>t(e,n);return n.includes(`dot`)&&(t=Wi(t)),n.includes(`camel`)&&(t=Gi(t)),n.includes(`capture`)&&(o.capture=!0),n.includes(`window`)&&(i=window),n.includes(`document`)&&(i=document),n.includes(`passive`)&&(o.passive=n[n.indexOf(`passive`)+1]!==`false`),a=Ui(n,a),n.includes(`prevent`)&&(a=s(a,(e,t)=>{t.preventDefault(),e(t)})),n.includes(`stop`)&&(a=s(a,(e,t)=>{t.stopPropagation(),e(t)})),n.includes(`once`)&&(a=s(a,(e,n)=>{e(n),i.removeEventListener(t,a,o)})),(n.includes(`away`)||n.includes(`outside`))&&(i=document,a=s(a,(t,n)=>{e.contains(n.target)||n.target.isConnected!==!1&&(e.offsetWidth<1&&e.offsetHeight<1||e._x_isShown!==!1&&t(n))})),n.includes(`self`)&&(a=s(a,(t,n)=>{n.target===e&&t(n)})),t===`submit`&&(a=s(a,(e,t)=>{t.target._x_pendingModelUpdates&&t.target._x_pendingModelUpdates.forEach(e=>e()),e(t)})),(Ji(t)||Yi(t))&&(a=s(a,(e,t)=>{Xi(t,n)||e(t)})),i.addEventListener(t,a,o),()=>{i.removeEventListener(t,a,o)}}function Ui(e,t){if(e.includes(`debounce`)){let n=e[e.indexOf(`debounce`)+1]||`invalid-wait`,r=Ki(n.split(`ms`)[0])?Number(n.split(`ms`)[0]):250;t=Un(t,r)}if(e.includes(`throttle`)){let n=e[e.indexOf(`throttle`)+1]||`invalid-wait`,r=Ki(n.split(`ms`)[0])?Number(n.split(`ms`)[0]):250;t=Wn(t,r)}return t}function Wi(e){return e.replace(/-/g,`.`)}function Gi(e){return e.toLowerCase().replace(/-(\w)/g,(e,t)=>t.toUpperCase())}function Ki(e){return!Array.isArray(e)&&!isNaN(e)}function qi(e){return[` `,`_`].includes(e)?e:e.replace(/([a-z])([A-Z])/g,`$1-$2`).replace(/[_\s]/,`-`).toLowerCase()}function Ji(e){return[`keydown`,`keyup`].includes(e)}function Yi(e){return[`contextmenu`,`click`,`mouse`].some(t=>e.includes(t))}function Xi(e,t){let n=t.filter(e=>![`window`,`document`,`prevent`,`stop`,`once`,`capture`,`self`,`away`,`outside`,`passive`,`preserve-scroll`,`blur`,`change`,`lazy`].includes(e));if(n.includes(`debounce`)){let e=n.indexOf(`debounce`);n.splice(e,Ki((n[e+1]||`invalid-wait`).split(`ms`)[0])?2:1)}if(n.includes(`throttle`)){let e=n.indexOf(`throttle`);n.splice(e,Ki((n[e+1]||`invalid-wait`).split(`ms`)[0])?2:1)}if(n.length===0||n.length===1&&Zi(e.key).includes(n[0]))return!1;let r=[`ctrl`,`shift`,`alt`,`meta`,`cmd`,`super`].filter(e=>n.includes(e));return n=n.filter(e=>!r.includes(e)),!(r.length>0&&r.filter(t=>((t===`cmd`||t===`super`)&&(t=`meta`),e[`${t}Key`])).length===r.length&&(Yi(e.type)||Zi(e.key).includes(n[0])))}function Zi(e){if(!e)return[];e=qi(e);let t={ctrl:`control`,slash:`/`,space:` `,spacebar:` `,cmd:`meta`,esc:`escape`,up:`arrow-up`,down:`arrow-down`,left:`arrow-left`,right:`arrow-right`,period:`.`,comma:`,`,equal:`=`,minus:`-`,underscore:`_`};return t[e]=e,Object.keys(t).map(n=>{if(t[n]===e)return n}).filter(e=>e)}at(`model`,(e,{modifiers:t,expression:n},{effect:r,cleanup:i})=>{let a=e;t.includes(`parent`)&&(a=Rt(e,t=>t!==e));let o=He(a,n),s;s=typeof n==`string`?He(a,`${n} = __placeholder`):typeof n==`function`&&typeof n()==`string`?He(a,`${n()} = __placeholder`):()=>{};let c=()=>{let e;return o(t=>e=t),na(e)?e.get():e},l=e=>{let t;o(e=>t=e),na(t)?t.set(e):s(()=>{},{scope:{__placeholder:e}})};typeof n==`string`&&e.type===`radio`&&A(()=>{e.hasAttribute(`name`)||e.setAttribute(`name`,n)});let u=t.includes(`change`)||t.includes(`lazy`),d=t.includes(`blur`),f=t.includes(`enter`),p=u||d||f,m;if(pn)m=()=>{};else if(p){let n=[],r=n=>l(Qi(e,t,n,c()));if(u&&n.push(Hi(e,`change`,t,r)),d&&(n.push(Hi(e,`blur`,t,r)),e.form)){let t=e.form,n=()=>r({target:e});t._x_pendingModelUpdates||=[],t._x_pendingModelUpdates.push(n),i(()=>{t._x_pendingModelUpdates&&t._x_pendingModelUpdates.splice(t._x_pendingModelUpdates.indexOf(n),1)})}f&&n.push(Hi(e,`keydown`,t,e=>{e.key===`Enter`&&r(e)})),m=()=>n.forEach(e=>e())}else m=Hi(e,e.tagName.toLowerCase()===`select`||[`checkbox`,`radio`].includes(e.type)?`change`:`input`,t,n=>{l(Qi(e,t,n,c()))});if(t.includes(`fill`)&&([void 0,null,``].includes(c())||Vn(e)&&Array.isArray(c())||e.tagName.toLowerCase()===`select`&&e.multiple)&&l(Qi(e,t,{target:e},c())),e._x_removeModelListeners||={},e._x_removeModelListeners.default=m,i(()=>e._x_removeModelListeners.default()),e.form){let n=Hi(e.form,`reset`,[],n=>{P(()=>e._x_model&&e._x_model.set(Qi(e,t,{target:e},c())))});i(()=>n())}e._x_model={get(){return c()},set(e){l(e)},setWithModifiers:Ui(t,l)},e._x_forceModelUpdate=t=>{t===void 0&&typeof n==`string`&&n.match(/\./)&&(t=``),A(()=>{Vn(e)?Array.isArray(t)?e.checked=t.some(t=>t==e.value):e.checked=!!t:Hn(e)?typeof t==`boolean`?e.checked=Pn(e.value)===t:e.checked=e.value==t:Cn(e,`value`,t)})},r(()=>{let n=c();t.includes(`unintrusive`)&&document.activeElement.isSameNode(e)||e._x_forceModelUpdate(n)})});function Qi(e,t,n,r){return A(()=>{if(n instanceof CustomEvent&&n.detail!==void 0)return n.detail!==null&&n.detail!==void 0?n.detail:n.target.value;if(Vn(e))if(Array.isArray(r)){let e=null;return e=t.includes(`number`)?$i(n.target.value):t.includes(`boolean`)?Pn(n.target.value):n.target.value,n.target.checked?r.includes(e)?r:r.concat([e]):r.filter(t=>!ea(t,e))}else return n.target.checked;else if(e.tagName.toLowerCase()===`select`&&e.multiple)return t.includes(`number`)?Array.from(n.target.selectedOptions).map(e=>$i(e.value||e.text)):t.includes(`boolean`)?Array.from(n.target.selectedOptions).map(e=>Pn(e.value||e.text)):Array.from(n.target.selectedOptions).map(e=>e.value||e.text);else{let i;return i=Hn(e)?n.target.checked?n.target.value:r:n.target.value,t.includes(`number`)?$i(i):t.includes(`boolean`)?Pn(i):t.includes(`trim`)?i.trim():i}})}function $i(e){let t=e?parseFloat(e):null;return ta(t)?t:e}function ea(e,t){return e==t}function ta(e){return!Array.isArray(e)&&!isNaN(e)}function na(e){return typeof e==`object`&&!!e&&typeof e.get==`function`&&typeof e.set==`function`}at(`cloak`,e=>queueMicrotask(()=>A(()=>e.removeAttribute(nt(`cloak`))))),It(()=>`[${nt(`init`)}]`),at(`init`,mn((e,{expression:t},{evaluate:n})=>typeof t==`string`?!!t.trim()&&n(t,{},!1):n(t,{},!1))),at(`text`,(e,{expression:t},{effect:n,evaluateLater:r})=>{let i=r(t);n(()=>{i(t=>{A(()=>{e.textContent=t})})})}),at(`html`,(e,{expression:t},{effect:n,evaluateLater:r})=>{let i=r(t);n(()=>{i(t=>{A(()=>{e.innerHTML=t??``,e._x_ignoreSelf=!0,Ut(e),delete e._x_ignoreSelf})})})}),yt(ht(`:`,gt(nt(`bind:`))));var ra=(e,{value:t,modifiers:n,expression:r,original:i},{effect:a,cleanup:o})=>{if(!t){let t={};er(t),He(e,r)(t=>{tr(e,t,i)},{scope:t});return}if(t===`key`)return ia(e,r);if(e._x_inlineBindings&&e._x_inlineBindings[t]&&e._x_inlineBindings[t].extract)return;let s=He(e,r);a(()=>s(i=>{i===void 0&&typeof r==`string`&&r.match(/\./)&&(i=``),A(()=>Cn(e,t,i,n))})),o(()=>{e._x_undoAddedClasses&&e._x_undoAddedClasses(),e._x_undoAddedStyles&&e._x_undoAddedStyles()})};ra.inline=(e,{value:t,modifiers:n,expression:r})=>{t&&(e._x_inlineBindings||={},e._x_inlineBindings[t]={expression:r,extract:!1})},at(`bind`,ra);function ia(e,t){e._x_keyExpression=t}Ft(()=>`[${nt(`data`)}]`),at(`data`,(e,{expression:t},{cleanup:n})=>{if(aa(e))return;t=t===``?`{}`:t;let r={};Me(r,e);let i={};ir(i,r);let a=Ve(e,t,{scope:i});(a===void 0||a===!0)&&(a={}),Me(a,e);let o=x(a);Ee(o);let s=xe(e,o);o.init&&Ve(e,o.init),n(()=>{o.destroy&&Ve(e,o.destroy),s()})}),_n((e,t)=>{e._x_dataStack&&(t._x_dataStack=e._x_dataStack,t.setAttribute(`data-has-alpine-state`,!0))});function aa(e){return pn?yn?!0:e.hasAttribute(`data-has-alpine-state`):!1}at(`show`,(e,{modifiers:t,expression:n},{effect:r})=>{let i=He(e,n);e._x_doHide||=()=>{A(()=>{e.style.setProperty(`display`,`none`,t.includes(`important`)?`important`:void 0)})},e._x_doShow||=()=>{A(()=>{e.style.length===1&&e.style.display===`none`?e.removeAttribute(`style`):e.style.removeProperty(`display`)})};let a=()=>{e._x_doHide(),e._x_isShown=!1},o=()=>{e._x_doShow(),e._x_isShown=!0},s=()=>setTimeout(o),c=an(e=>e?o():a(),t=>{typeof e._x_toggleAndCascadeWithTransitions==`function`?e._x_toggleAndCascadeWithTransitions(e,t,o,a):t?s():a()}),l,u=!0;r(()=>i(e=>{!u&&e===l||(t.includes(`immediate`)&&(e?s():a()),c(e),l=e,u=!1)}))}),at(`for`,(e,{expression:t},{effect:n,cleanup:r})=>{let i=sa(t),a=He(e,i.items),o=He(e,e._x_keyExpression||`index`);e._x_lookup=new Map,n(()=>oa(e,i,a,o)),r(()=>{e._x_lookup.forEach(e=>A(()=>{Wt(e),e.remove()})),delete e._x_lookup})});function I(e){return t=>{Object.entries(t).forEach(([t,n])=>{e[t]=n})}}function oa(e,t,n,r){n(n=>{la(n)&&(n=Array.from({length:n},(e,t)=>t+1)),n??=[],n instanceof Set&&(n=Array.from(n)),n instanceof Map&&(n=Array.from(n));let i=e._x_lookup,a=new Map;e._x_lookup=a;let o=ua(n),s=Object.entries(n).map(([s,c])=>{o||(s=parseInt(s));let l=ca(t,c,s,n),u;return r(t=>{typeof t==`object`&&Ot(`x-for key cannot be an object, it must be a string or an integer`,e),i.has(t)&&(a.set(t,i.get(t)),i.delete(t)),u=t},{scope:{index:s,...l}}),[u,l]});A(()=>{i.forEach(e=>{Wt(e),e.remove()});let t=new Set,n=e;s.forEach(([r,i])=>{if(a.has(r)){let e=a.get(r);e._x_refreshXForScope(i),n.nextElementSibling!==e&&(n.nextElementSibling&&e.replaceWith(n.nextElementSibling),n.after(e)),n=e,e._x_currentIfEl&&(e.nextElementSibling!==e._x_currentIfEl&&n.after(e._x_currentIfEl),n=e._x_currentIfEl);return}e.content.children.length>1&&Ot(`x-for templates require a single root element, additional elements will be ignored.`,e);let o=document.importNode(e.content,!0).firstElementChild,s=x(i);xe(o,s,e),o._x_refreshXForScope=I(s),a.set(r,o),t.add(o),n.after(o),n=o}),mn(()=>t.forEach(e=>Ut(e)))()})})}function sa(e){let t=/,([^,\}\]]*)(?:,([^,\}\]]*))?$/,n=/^\s*\(|\)\s*$/g,r=e.match(/([\s\S]*?)\s+(?:in|of)\s+([\s\S]*)/);if(!r)return;let i={};i.items=r[2].trim();let a=r[1].replace(n,``).trim(),o=a.match(t);return o?(i.item=a.replace(t,``).trim(),i.index=o[1].trim(),o[2]&&(i.collection=o[2].trim())):i.item=a,i}function ca(e,t,n,r){let i={};return/^\[.*\]$/.test(e.item)&&Array.isArray(t)?e.item.replace(`[`,``).replace(`]`,``).split(`,`).map(e=>e.trim()).forEach((e,n)=>{i[e]=t[n]}):/^\{.*\}$/.test(e.item)&&!Array.isArray(t)&&typeof t==`object`?e.item.replace(`{`,``).replace(`}`,``).split(`,`).map(e=>e.trim()).forEach(e=>{i[e]=t[e]}):i[e.item]=t,e.index&&(i[e.index]=n),e.collection&&(i[e.collection]=r),i}function la(e){return typeof e!=`object`&&!isNaN(e)}function ua(e){return typeof e==`object`&&!Array.isArray(e)}function da(){}da.inline=(e,{expression:t},{cleanup:n})=>{let r=Lt(e);r&&(r._x_refs||={},r._x_refs[t]=e,n(()=>delete r._x_refs[t]))},at(`ref`,da),at(`if`,(e,{expression:t},{effect:n,cleanup:r})=>{e.tagName.toLowerCase()!==`template`&&Ot(`x-if can only be used on a <template> tag`,e);let i=He(e,t),a=()=>{if(e._x_currentIfEl)return e._x_currentIfEl;let t=e.content.cloneNode(!0).firstElementChild;return xe(t,{},e),A(()=>{e.after(t),mn(()=>Ut(t))()}),e._x_currentIfEl=t,e._x_undoIf=()=>{A(()=>{Wt(t),t.remove()}),delete e._x_currentIfEl},t},o=()=>{e._x_undoIf&&(e._x_undoIf(),delete e._x_undoIf)};n(()=>i(e=>{e?a():o()})),r(()=>e._x_undoIf&&e._x_undoIf())}),at(`id`,(e,{expression:t},{evaluate:n})=>{n(t).forEach(t=>Ii(e,t))}),_n((e,t)=>{e._x_ids&&(t._x_ids=e._x_ids)}),yt(ht(`@`,gt(nt(`on:`)))),at(`on`,mn((e,{value:t,modifiers:n,expression:r},{cleanup:i})=>{let a=r?He(e,r):()=>{};e.tagName.toLowerCase()===`template`&&(e._x_forwardEvents||=[],e._x_forwardEvents.includes(t)||e._x_forwardEvents.push(t));let o=Hi(e,t,n,e=>{a(()=>{},{scope:{$event:e},params:[e]})});i(()=>o())})),fa(`Collapse`,`collapse`,`collapse`),fa(`Intersect`,`intersect`,`intersect`),fa(`Focus`,`trap`,`focus`),fa(`Mask`,`mask`,`mask`);function fa(e,t,n){at(t,r=>Ot(`You can't use [x-${t}] without first installing the "${e}" plugin here: https://alpinejs.dev/plugins/${n}`,r))}ar.setEvaluator(qe),ar.setRawEvaluator(et),ar.setReactivityEngine({reactive:Oi,effect:Dr,release:Or,raw:F});var pa=ar,ma=o((e=>{var t=Symbol.for(`react.transitional.element`),n=Symbol.for(`react.portal`),r=Symbol.for(`react.fragment`),i=Symbol.for(`react.strict_mode`),a=Symbol.for(`react.profiler`),o=Symbol.for(`react.consumer`),s=Symbol.for(`react.context`),c=Symbol.for(`react.forward_ref`),l=Symbol.for(`react.suspense`),u=Symbol.for(`react.memo`),d=Symbol.for(`react.lazy`),f=Symbol.for(`react.activity`),p=Symbol.for(`react.view_transition`),m=Symbol.iterator;function h(e){return typeof e!=`object`||!e?null:(e=m&&e[m]||e[`@@iterator`],typeof e==`function`?e:null)}var g={isMounted:function(){return!1},enqueueForceUpdate:function(){},enqueueReplaceState:function(){},enqueueSetState:function(){}},_=Object.assign,v={};function y(e,t,n){this.props=e,this.context=t,this.refs=v,this.updater=n||g}y.prototype.isReactComponent={},y.prototype.setState=function(e,t){if(typeof e!=`object`&&typeof e!=`function`&&e!=null)throw Error(`takes an object of state variables to update or a function which returns an object of state variables.`);this.updater.enqueueSetState(this,e,t,`setState`)},y.prototype.forceUpdate=function(e){this.updater.enqueueForceUpdate(this,e,`forceUpdate`)};function b(){}b.prototype=y.prototype;function x(e,t,n){this.props=e,this.context=t,this.refs=v,this.updater=n||g}var S=x.prototype=new b;S.constructor=x,_(S,y.prototype),S.isPureReactComponent=!0;var C=Array.isArray;function w(){}var T={H:null,A:null,T:null,S:null},E=Object.prototype.hasOwnProperty;function D(e,n,r){var i=r.ref;return{$$typeof:t,type:e,key:n,ref:i===void 0?null:i,props:r}}function O(e,t){return D(e.type,t,e.props)}function ee(e){return typeof e==`object`&&!!e&&e.$$typeof===t}function te(e){var t={"=":`=0`,":":`=2`};return`$`+e.replace(/[=:]/g,function(e){return t[e]})}var ne=/\/+/g;function k(e,t){return typeof e==`object`&&e&&e.key!=null?te(``+e.key):t.toString(36)}function re(e){switch(e.status){case`fulfilled`:return e.value;case`rejected`:throw e.reason;default:switch(typeof e.status==`string`?e.then(w,w):(e.status=`pending`,e.then(function(t){e.status===`pending`&&(e.status=`fulfilled`,e.value=t)},function(t){e.status===`pending`&&(e.status=`rejected`,e.reason=t)})),e.status){case`fulfilled`:return e.value;case`rejected`:throw e.reason}}throw e}function ie(e,r,i,a,o){var s=typeof e;(s===`undefined`||s===`boolean`)&&(e=null);var c=!1;if(e===null)c=!0;else switch(s){case`bigint`:case`string`:case`number`:c=!0;break;case`object`:switch(e.$$typeof){case t:case n:c=!0;break;case d:return c=e._init,ie(c(e._payload),r,i,a,o)}}if(c)return o=o(e),c=a===``?`.`+k(e,0):a,C(o)?(i=``,c!=null&&(i=c.replace(ne,`$&/`)+`/`),ie(o,r,i,``,function(e){return e})):o!=null&&(ee(o)&&(o=O(o,i+(o.key==null||e&&e.key===o.key?``:(``+o.key).replace(ne,`$&/`)+`/`)+c)),r.push(o)),1;c=0;var l=a===``?`.`:a+`:`;if(C(e))for(var u=0;u<e.length;u++)a=e[u],s=l+k(a,u),c+=ie(a,r,i,s,o);else if(u=h(e),typeof u==`function`)for(e=u.call(e),u=0;!(a=e.next()).done;)a=a.value,s=l+k(a,u++),c+=ie(a,r,i,s,o);else if(s===`object`){if(typeof e.then==`function`)return ie(re(e),r,i,a,o);throw r=String(e),Error(`Objects are not valid as a React child (found: `+(r===`[object Object]`?`object with keys {`+Object.keys(e).join(`, `)+`}`:r)+`). If you meant to render a collection of children, use an array instead.`)}return c}function ae(e,t,n){if(e==null)return e;var r=[],i=0;return ie(e,r,``,``,function(e){return t.call(n,e,i++)}),r}function oe(e){if(e._status===-1){var t=e._result,n=t();n.then(function(t){(e._status===0||e._status===-1)&&(e._status=1,e._result=t,n.status===void 0&&(n.status=`fulfilled`,n.value=t))},function(t){(e._status===0||e._status===-1)&&(e._status=2,e._result=t,n.status===void 0&&(n.status=`rejected`,n.reason=t))}),e._status===-1&&(e._status=0,e._result=n)}if(e._status===1)return e._result.default;throw e._result}var se=typeof reportError==`function`?reportError:function(e){if(typeof window==`object`&&typeof window.ErrorEvent==`function`){var t=new window.ErrorEvent(`error`,{bubbles:!0,cancelable:!0,message:typeof e==`object`&&e&&typeof e.message==`string`?String(e.message):String(e),error:e});if(!window.dispatchEvent(t))return}else if(typeof process==`object`&&typeof process.emit==`function`){process.emit(`uncaughtException`,e);return}console.error(e)};function ce(e){var t=T.T,n={};n.types=t===null?null:t.types,T.T=n;try{var r=e(),i=T.S;i!==null&&i(n,r),typeof r==`object`&&r&&typeof r.then==`function`&&r.then(w,se)}catch(e){se(e)}finally{t!==null&&n.types!==null&&(t.types=n.types),T.T=t}}function le(e){var t=T.T;if(t!==null){var n=t.types;n===null?t.types=[e]:n.indexOf(e)===-1&&n.push(e)}else ce(le.bind(null,e))}var ue={map:ae,forEach:function(e,t,n){ae(e,function(){t.apply(this,arguments)},n)},count:function(e){var t=0;return ae(e,function(){t++}),t},toArray:function(e){return ae(e,function(e){return e})||[]},only:function(e){if(!ee(e))throw Error(`React.Children.only expected to receive a single React element child.`);return e}};e.Activity=f,e.Children=ue,e.Component=y,e.Fragment=r,e.Profiler=a,e.PureComponent=x,e.StrictMode=i,e.Suspense=l,e.ViewTransition=p,e.__CLIENT_INTERNALS_DO_NOT_USE_OR_WARN_USERS_THEY_CANNOT_UPGRADE=T,e.__COMPILER_RUNTIME={__proto__:null,c:function(e){return T.H.useMemoCache(e)}},e.addTransitionType=le,e.cache=function(e){return function(){return e.apply(null,arguments)}},e.cacheSignal=function(){return null},e.cloneElement=function(e,t,n){if(e==null)throw Error(`The argument must be a React element, but you passed `+e+`.`);var r=_({},e.props),i=e.key;if(t!=null)for(a in t.key!==void 0&&(i=``+t.key),t)!E.call(t,a)||a===`key`||a===`__self`||a===`__source`||a===`ref`&&t.ref===void 0||(r[a]=t[a]);var a=arguments.length-2;if(a===1)r.children=n;else if(1<a){for(var o=Array(a),s=0;s<a;s++)o[s]=arguments[s+2];r.children=o}return D(e.type,i,r)},e.createContext=function(e){return e={$$typeof:s,_currentValue:e,_currentValue2:e,_threadCount:0,Provider:null,Consumer:null},e.Provider=e,e.Consumer={$$typeof:o,_context:e},e},e.createElement=function(e,t,n){var r,i={},a=null;if(t!=null)for(r in t.key!==void 0&&(a=``+t.key),t)E.call(t,r)&&r!==`key`&&r!==`__self`&&r!==`__source`&&(i[r]=t[r]);var o=arguments.length-2;if(o===1)i.children=n;else if(1<o){for(var s=Array(o),c=0;c<o;c++)s[c]=arguments[c+2];i.children=s}if(e&&e.defaultProps)for(r in o=e.defaultProps,o)i[r]===void 0&&(i[r]=o[r]);return D(e,a,i)},e.createRef=function(){return{current:null}},e.forwardRef=function(e){return{$$typeof:c,render:e}},e.isValidElement=ee,e.lazy=function(e){return{$$typeof:d,_payload:{_status:-1,_result:e},_init:oe}},e.memo=function(e,t){return{$$typeof:u,type:e,compare:t===void 0?null:t}},e.startTransition=ce,e.unstable_useCacheRefresh=function(){return T.H.useCacheRefresh()},e.use=function(e){return T.H.use(e)},e.useActionState=function(e,t,n){return T.H.useActionState(e,t,n)},e.useCallback=function(e,t){return T.H.useCallback(e,t)},e.useContext=function(e){return T.H.useContext(e)},e.useDebugValue=function(){},e.useDeferredValue=function(e,t){return T.H.useDeferredValue(e,t)},e.useEffect=function(e,t){return T.H.useEffect(e,t)},e.useEffectEvent=function(e){return T.H.useEffectEvent(e)},e.useId=function(){return T.H.useId()},e.useImperativeHandle=function(e,t,n){return T.H.useImperativeHandle(e,t,n)},e.useInsertionEffect=function(e,t){return T.H.useInsertionEffect(e,t)},e.useLayoutEffect=function(e,t){return T.H.useLayoutEffect(e,t)},e.useMemo=function(e,t){return T.H.useMemo(e,t)},e.useOptimistic=function(e,t){return T.H.useOptimistic(e,t)},e.useReducer=function(e,t,n){return T.H.useReducer(e,t,n)},e.useRef=function(e){return T.H.useRef(e)},e.useState=function(e){return T.H.useState(e)},e.useSyncExternalStore=function(e,t,n){return T.H.useSyncExternalStore(e,t,n)},e.useTransition=function(){return T.H.useTransition()},e.version=`19.3.1`})),ha=o(((e,t)=>{t.exports=ma()})),ga=o((e=>{function t(e,t){var n=e.length;e.push(t);a:for(;0<n;){var r=n-1>>>1,a=e[r];if(0<i(a,t))e[r]=t,e[n]=a,n=r;else break a}}function n(e){return e.length===0?null:e[0]}function r(e){if(e.length===0)return null;var t=e[0],n=e.pop();if(n!==t){e[0]=n;a:for(var r=0,a=e.length,o=a>>>1;r<o;){var s=2*(r+1)-1,c=e[s],l=s+1,u=e[l];if(0>i(c,n))l<a&&0>i(u,c)?(e[r]=u,e[l]=n,r=l):(e[r]=c,e[s]=n,r=s);else if(l<a&&0>i(u,n))e[r]=u,e[l]=n,r=l;else break a}}return t}function i(e,t){var n=e.sortIndex-t.sortIndex;return n===0?e.id-t.id:n}if(e.unstable_now=void 0,typeof performance==`object`&&typeof performance.now==`function`){var a=performance;e.unstable_now=function(){return a.now()}}else{var o=Date,s=o.now();e.unstable_now=function(){return o.now()-s}}var c=[],l=[],u=1,d=null,f=3,p=!1,m=!1,h=!1,g=!1,_=typeof setTimeout==`function`?setTimeout:null,v=typeof clearTimeout==`function`?clearTimeout:null,y=typeof setImmediate<`u`?setImmediate:null;function b(e){for(var i=n(l);i!==null;){if(i.callback===null)r(l);else if(i.startTime<=e)r(l),i.sortIndex=i.expirationTime,t(c,i);else break;i=n(l)}}function x(e){if(h=!1,b(e),!m)if(n(c)!==null)m=!0,S||(S=!0,O());else{var t=n(l);t!==null&&ne(x,t.startTime-e)}}var S=!1,C=-1,w=5,T=-1;function E(){return g?!0:!(e.unstable_now()-T<w)}function D(){if(g=!1,S){var t=e.unstable_now();T=t;var i=!0;try{a:{m=!1,h&&(h=!1,v(C),C=-1),p=!0;var a=f;try{b:{for(b(t),d=n(c);d!==null&&!(d.expirationTime>t&&E());){var o=d.callback;if(typeof o==`function`){d.callback=null,f=d.priorityLevel;var s=o(d.expirationTime<=t);if(t=e.unstable_now(),typeof s==`function`){d.callback=s,b(t),i=!0;break b}d===n(c)&&r(c),b(t)}else r(c);d=n(c)}if(d!==null)i=!0;else{var u=n(l);u!==null&&ne(x,u.startTime-t),i=!1}}break a}finally{d=null,f=a,p=!1}i=void 0}}finally{i?O():S=!1}}}var O;if(typeof y==`function`)O=function(){y(D)};else if(typeof MessageChannel<`u`){var ee=new MessageChannel,te=ee.port2;ee.port1.onmessage=D,O=function(){te.postMessage(null)}}else O=function(){_(D,0)};function ne(t,n){C=_(function(){t(e.unstable_now())},n)}e.unstable_IdlePriority=5,e.unstable_ImmediatePriority=1,e.unstable_LowPriority=4,e.unstable_NormalPriority=3,e.unstable_Profiling=null,e.unstable_UserBlockingPriority=2,e.unstable_cancelCallback=function(e){e.callback=null},e.unstable_forceFrameRate=function(e){0>e||125<e?console.error(`forceFrameRate takes a positive int between 0 and 125, forcing frame rates higher than 125 fps is not supported`):w=0<e?Math.floor(1e3/e):5},e.unstable_getCurrentPriorityLevel=function(){return f},e.unstable_next=function(e){switch(f){case 1:case 2:case 3:var t=3;break;default:t=f}var n=f;f=t;try{return e()}finally{f=n}},e.unstable_requestPaint=function(){g=!0},e.unstable_runWithPriority=function(e,t){switch(e){case 1:case 2:case 3:case 4:case 5:break;default:e=3}var n=f;f=e;try{return t()}finally{f=n}},e.unstable_scheduleCallback=function(r,i,a){var o=e.unstable_now();switch(typeof a==`object`&&a?(a=a.delay,a=typeof a==`number`&&0<a?o+a:o):a=o,r){case 1:var s=-1;break;case 2:s=250;break;case 5:s=1073741823;break;case 4:s=1e4;break;default:s=5e3}return s=a+s,r={id:u++,callback:i,priorityLevel:r,startTime:a,expirationTime:s,sortIndex:-1},a>o?(r.sortIndex=a,t(l,r),n(c)===null&&r===n(l)&&(h?(v(C),C=-1):h=!0,ne(x,a-o))):(r.sortIndex=s,t(c,r),m||p||(m=!0,S||(S=!0,O()))),r},e.unstable_shouldYield=E,e.unstable_wrapCallback=function(e){var t=f;return function(){var n=f;f=t;try{return e.apply(this,arguments)}finally{f=n}}}})),_a=o(((e,t)=>{t.exports=ga()})),va=o((e=>{var t=ha();function n(e){var t=`https://react.dev/errors/`+e;if(1<arguments.length){t+=`?args[]=`+encodeURIComponent(arguments[1]);for(var n=2;n<arguments.length;n++)t+=`&args[]=`+encodeURIComponent(arguments[n])}return`Minified React error #`+e+`; visit `+t+` for the full message or use the non-minified dev environment for full errors and additional helpful warnings.`}function r(){}var i={d:{f:r,r:function(){throw Error(n(522))},D:r,C:r,L:r,m:r,X:r,S:r,M:r},p:0,findDOMNode:null},a=Symbol.for(`react.portal`),o=Symbol.for(`react.recoverable`),s=Symbol.for(`react.optimistic_key`);function c(e,t,n){var r=3<arguments.length&&arguments[3]!==void 0?arguments[3]:null;return{$$typeof:a,key:r==null?null:r===s?s:``+r,children:e,containerInfo:t,implementation:n}}var l=t.__CLIENT_INTERNALS_DO_NOT_USE_OR_WARN_USERS_THEY_CANNOT_UPGRADE;function u(e,t){if(e===`font`)return``;if(typeof t==`string`)return t===`use-credentials`?t:``}e.__DOM_INTERNALS_DO_NOT_USE_OR_WARN_USERS_THEY_CANNOT_UPGRADE=i,e.browser=function(e){return{$$typeof:o,_reason:e}},e.createPortal=function(e,t){var r=2<arguments.length&&arguments[2]!==void 0?arguments[2]:null;if(!t||t.nodeType!==1&&t.nodeType!==9&&t.nodeType!==11)throw Error(n(299));return c(e,t,null,r)},e.flushSync=function(e){var t=l.T,n=i.p;try{if(l.T=null,i.p=2,e)return e()}finally{l.T=t,i.p=n,i.d.f()}},e.preconnect=function(e,t){typeof e==`string`&&(t?(t=t.crossOrigin,t=typeof t==`string`?t===`use-credentials`?t:``:void 0):t=null,i.d.C(e,t))},e.prefetchDNS=function(e){typeof e==`string`&&i.d.D(e)},e.preinit=function(e,t){if(typeof e==`string`&&t&&typeof t.as==`string`){var n=t.as,r=u(n,t.crossOrigin),a=typeof t.integrity==`string`?t.integrity:void 0,o=typeof t.fetchPriority==`string`?t.fetchPriority:void 0;n===`style`?i.d.S(e,typeof t.precedence==`string`?t.precedence:void 0,{crossOrigin:r,integrity:a,fetchPriority:o}):n===`script`&&i.d.X(e,{crossOrigin:r,integrity:a,fetchPriority:o,nonce:typeof t.nonce==`string`?t.nonce:void 0})}},e.preinitModule=function(e,t){if(typeof e==`string`)if(typeof t==`object`&&t){if(t.as==null||t.as===`script`){var n=u(t.as,t.crossOrigin);i.d.M(e,{crossOrigin:n,integrity:typeof t.integrity==`string`?t.integrity:void 0,nonce:typeof t.nonce==`string`?t.nonce:void 0,fetchPriority:typeof t.fetchPriority==`string`?t.fetchPriority:void 0})}}else t??i.d.M(e)},e.preload=function(e,t){if(typeof e==`string`&&typeof t==`object`&&t&&typeof t.as==`string`){var n=t.as,r=u(n,t.crossOrigin);i.d.L(e,n,{crossOrigin:r,integrity:typeof t.integrity==`string`?t.integrity:void 0,nonce:typeof t.nonce==`string`?t.nonce:void 0,type:typeof t.type==`string`?t.type:void 0,fetchPriority:typeof t.fetchPriority==`string`?t.fetchPriority:void 0,referrerPolicy:typeof t.referrerPolicy==`string`?t.referrerPolicy:void 0,imageSrcSet:typeof t.imageSrcSet==`string`?t.imageSrcSet:void 0,imageSizes:typeof t.imageSizes==`string`?t.imageSizes:void 0,media:typeof t.media==`string`?t.media:void 0})}},e.preloadModule=function(e,t){if(typeof e==`string`)if(t){var n=u(t.as,t.crossOrigin);i.d.m(e,{as:typeof t.as==`string`&&t.as!==`script`?t.as:void 0,crossOrigin:n,integrity:typeof t.integrity==`string`?t.integrity:void 0,nonce:typeof t.nonce==`string`?t.nonce:void 0,fetchPriority:typeof t.fetchPriority==`string`?t.fetchPriority:void 0})}else i.d.m(e)},e.requestFormReset=function(e){i.d.r(e)},e.unstable_batchedUpdates=function(e,t){return e(t)},e.useFormState=function(e,t,n){return l.H.useFormState(e,t,n)},e.useFormStatus=function(){return l.H.useHostTransitionStatus()},e.version=`19.3.1`})),ya=o(((e,t)=>{function n(){if(!(typeof __REACT_DEVTOOLS_GLOBAL_HOOK__>`u`||typeof __REACT_DEVTOOLS_GLOBAL_HOOK__.checkDCE!=`function`))try{__REACT_DEVTOOLS_GLOBAL_HOOK__.checkDCE(n)}catch(e){console.error(e)}}n(),t.exports=va()})),ba=o((e=>{var t=_a(),n=ha(),r=ya();function i(e){var t=`https://react.dev/errors/`+e;if(1<arguments.length){t+=`?args[]=`+encodeURIComponent(arguments[1]);for(var n=2;n<arguments.length;n++)t+=`&args[]=`+encodeURIComponent(arguments[n])}return`Minified React error #`+e+`; visit `+t+` for the full message or use the non-minified dev environment for full errors and additional helpful warnings.`}function a(e){return!(!e||e.nodeType!==1&&e.nodeType!==9&&e.nodeType!==11)}function o(e){for(var t=e,n=t;n&&!n.alternate;)t=n,t.flags&4098&&(e=t.return),n=t.return;for(;t.return;)t=t.return;return t.tag===3?e:null}function s(e){if(e.tag===13){var t=e.memoizedState;if(t===null&&(e=e.alternate,e!==null&&(t=e.memoizedState)),t!==null)return t.dehydrated}return null}function c(e){if(e.tag===31){var t=e.memoizedState;if(t===null&&(e=e.alternate,e!==null&&(t=e.memoizedState)),t!==null)return t.dehydrated}return null}function l(e){if(o(e)!==e)throw Error(i(188))}function u(e){var t=e.alternate;if(!t){if(t=o(e),t===null)throw Error(i(188));return t===e?e:null}for(var n=e,r=t;;){var a=n.return;if(a===null)break;var s=a.alternate;if(s===null){if(r=a.return,r!==null){n=r;continue}break}if(a.child===s.child){for(s=a.child;s;){if(s===n)return l(a),e;if(s===r)return l(a),t;s=s.sibling}throw Error(i(188))}if(n.return!==r.return)n=a,r=s;else{for(var c=!1,u=a.child;u;){if(u===n){c=!0,n=a,r=s;break}if(u===r){c=!0,r=a,n=s;break}u=u.sibling}if(!c){for(u=s.child;u;){if(u===n){c=!0,n=s,r=a;break}if(u===r){c=!0,r=s,n=a;break}u=u.sibling}if(!c)throw Error(i(189))}}if(n.alternate!==r)throw Error(i(190))}if(n.tag!==3)throw Error(i(188));return n.stateNode.current===n?e:t}function d(e){var t=e.tag;if(t===5||t===26||t===27||t===6)return e;for(e=e.child;e!==null;){if(t=d(e),t!==null)return t;e=e.sibling}return null}function f(e,t,n,r,i,a){for(;e!==null;){if((e.tag===5||e.tag===27||e.tag===6)&&n(e,r,i,a)||(e.tag!==22||e.memoizedState===null)&&(t||e.tag!==5&&e.tag!==27)&&f(e.child,t,n,r,i,a))return!0;e=e.sibling}return!1}function p(e){for(e=e.return;e!==null;){if(e.tag===3||e.tag===5||e.tag===27)return e;e=e.return}return null}function m(e){var t=!1;for(e=e.return;e!==null&&(e.tag===4&&(t=!0),!(e.tag===3||e.tag===5||e.tag===27));)e=e.return;return t}function h(e){var t=[null,null],n=p(e);return n===null||g(t,e,n.child,{foundSelf:!1}),t}function g(e,t,n,r){for(;n!==null;){if(n===t)r.foundSelf=!0;else if(n.tag===5||n.tag===27||n.tag===6){if(r.foundSelf)return e[1]=n,!0;e[0]=n}else if((n.tag!==22||n.memoizedState===null)&&g(e,t,n.child,r))return!0;n=n.sibling}return!1}function _(e){switch(e.tag){case 5:case 27:case 6:return e.stateNode;case 3:return e.stateNode.containerInfo;default:throw Error(i(559))}}var v=null,y=null;function b(e,t,n){return e===n?!0:e===t?(v=e,!0):!1}function x(e,t,n){return e===n?(y=e,!1):e===t?(y!==null&&(v=e),!0):!1}function S(e){if(e===null)return null;do e=e===null?null:e.return;while(e&&e.tag!==5&&e.tag!==27&&e.tag!==3);return e||null}function C(e,t,n){for(var r=0,i=e;i;i=n(i))r++;i=0;for(var a=t;a;a=n(a))i++;for(;0<r-i;)e=n(e),r--;for(;0<i-r;)t=n(t),i--;for(;r--;){if(e===t||t!==null&&e===t.alternate)return e;e=n(e),t=n(t)}return null}var w=Object.assign,T=Symbol.for(`react.element`),E=Symbol.for(`react.transitional.element`),D=Symbol.for(`react.portal`),O=Symbol.for(`react.fragment`),ee=Symbol.for(`react.strict_mode`),te=Symbol.for(`react.profiler`),ne=Symbol.for(`react.consumer`),k=Symbol.for(`react.context`),re=Symbol.for(`react.forward_ref`),ie=Symbol.for(`react.suspense`),ae=Symbol.for(`react.suspense_list`),oe=Symbol.for(`react.memo`),se=Symbol.for(`react.lazy`),ce=Symbol.for(`react.activity`),le=Symbol.for(`react.legacy_hidden`),ue=Symbol.for(`react.memo_cache_sentinel`),de=Symbol.for(`react.view_transition`),fe=Symbol.for(`react.recoverable`),pe=Symbol.iterator;function me(e){return typeof e!=`object`||!e?null:(e=pe&&e[pe]||e[`@@iterator`],typeof e==`function`?e:null)}var he=Symbol.for(`react.client.reference`);function ge(e){if(e==null)return null;if(typeof e==`function`)return e.$$typeof===he?null:e.displayName||e.name||null;if(typeof e==`string`)return e;switch(e){case O:return`Fragment`;case te:return`Profiler`;case ee:return`StrictMode`;case ie:return`Suspense`;case ae:return`SuspenseList`;case ce:return`Activity`;case de:return`ViewTransition`}if(typeof e==`object`)switch(e.$$typeof){case D:return`Portal`;case k:return e.displayName||`Context`;case ne:return(e._context.displayName||`Context`)+`.Consumer`;case re:var t=e.render;return e=e.displayName,e||=(e=t.displayName||t.name||``,e===``?`ForwardRef`:`ForwardRef(`+e+`)`),e;case oe:return t=e.displayName||null,t===null?ge(e.type)||`Memo`:t;case se:t=e._payload,e=e._init;try{return ge(e(t))}catch{}}return null}var A=Array.isArray,j=n.__CLIENT_INTERNALS_DO_NOT_USE_OR_WARN_USERS_THEY_CANNOT_UPGRADE,M=r.__DOM_INTERNALS_DO_NOT_USE_OR_WARN_USERS_THEY_CANNOT_UPGRADE,_e={pending:!1,data:null,method:null,action:null},ve=[],ye=-1;function be(e){return{current:e}}function xe(e){0>ye||(e.current=ve[ye],ve[ye]=null,ye--)}function N(e,t){ye++,ve[ye]=e.current,e.current=t}var Se=be(null),Ce=be(null),we=be(null),Te=be(null);function Ee(e,t){switch(N(we,t),N(Ce,e),N(Se,null),t.nodeType){case 9:case 11:e=(e=t.documentElement)&&(e=e.namespaceURI)?up(e):0;break;default:if(e=t.tagName,t=t.namespaceURI)t=up(t),e=dp(t,e);else switch(e){case`svg`:e=1;break;case`math`:e=2;break;default:e=0}}xe(Se),N(Se,e)}function De(){xe(Se),xe(Ce),xe(we)}function Oe(e){var t=e.memoizedState;t!==null&&(sh._currentValue=t.memoizedState,N(Te,e)),t=Se.current;var n=dp(t,e.type);t!==n&&(N(Ce,e),N(Se,n))}function ke(e){Ce.current===e&&(xe(Se),xe(Ce)),Te.current===e&&(xe(Te),sh._currentValue=_e)}var Ae,je;function Me(e){if(Ae===void 0)try{throw Error()}catch(e){var t=e.stack.trim().match(/\n( *(at )?)/);Ae=t&&t[1]||``,je=-1<e.stack.indexOf(`
    at`)?` (<anonymous>)`:-1<e.stack.indexOf(`@`)?`@unknown:0:0`:``}return`
`+Ae+e+je}var Ne=!1;function Pe(e,t){if(!e||Ne)return``;Ne=!0;var n=Error.prepareStackTrace;Error.prepareStackTrace=void 0;try{var r={DetermineComponentFrameRoot:function(){try{if(t){var n=function(){throw Error()};if(Object.defineProperty(n.prototype,`props`,{set:function(){throw Error()}}),typeof Reflect==`object`&&Reflect.construct){try{Reflect.construct(n,[])}catch(e){var r=e}Reflect.construct(e,[],n)}else{try{n.call()}catch(e){r=e}n=!1;try{var i=Object.getOwnPropertyDescriptor(e.prototype,`props`);Object.defineProperty(e.prototype,`props`,{configurable:!0,set:function(){throw Error()}}),n=!0,new e}finally{n&&(i===void 0?delete e.prototype.props:Object.defineProperty(e.prototype,`props`,i))}}}else{try{throw Error()}catch(e){r=e}(n=e())&&typeof n.catch==`function`&&n.catch(function(){})}}catch(e){if(e&&r&&typeof e.stack==`string`)return[e.stack,r.stack]}return[null,null]}};r.DetermineComponentFrameRoot.displayName=`DetermineComponentFrameRoot`;var i=Object.getOwnPropertyDescriptor(r.DetermineComponentFrameRoot,`name`);i&&i.configurable&&Object.defineProperty(r.DetermineComponentFrameRoot,`name`,{value:`DetermineComponentFrameRoot`});var a=r.DetermineComponentFrameRoot(),o=a[0],s=a[1];if(o&&s){var c=o.split(`
`),l=s.split(`
`);for(i=r=0;r<c.length&&!c[r].includes(`DetermineComponentFrameRoot`);)r++;for(;i<l.length&&!l[i].includes(`DetermineComponentFrameRoot`);)i++;if(r===c.length||i===l.length)for(r=c.length-1,i=l.length-1;1<=r&&0<=i&&c[r]!==l[i];)i--;for(;1<=r&&0<=i;r--,i--)if(c[r]!==l[i]){if(r!==1||i!==1)do if(r--,i--,0>i||c[r]!==l[i]){var u=`
`+c[r].replace(` at new `,` at `);return e.displayName&&u.includes(`<anonymous>`)&&(u=u.replace(`<anonymous>`,e.displayName)),u}while(1<=r&&0<=i);break}}}finally{Ne=!1,Error.prepareStackTrace=n}return(n=e?e.displayName||e.name:``)?Me(n):``}function Fe(e,t){switch(e.tag){case 26:case 27:case 5:return Me(e.type);case 16:return Me(`Lazy`);case 13:return e.child!==t&&t!==null?Me(`Suspense Fallback`):Me(`Suspense`);case 19:return Me(`SuspenseList`);case 0:case 15:return Pe(e.type,!1);case 11:return Pe(e.type.render,!1);case 1:return Pe(e.type,!0);case 31:return Me(`Activity`);case 30:return Me(`ViewTransition`);default:return``}}function Ie(e){try{var t=``,n=null;do t+=Fe(e,n),n=e,e=e.return;while(e);return t}catch(e){return`
Error generating stack: `+e.message+`
`+e.stack}}var Le=Object.prototype.hasOwnProperty,Re=t.unstable_scheduleCallback,ze=t.unstable_cancelCallback,Be=t.unstable_shouldYield,Ve=t.unstable_requestPaint,He=t.unstable_now,Ue=t.unstable_getCurrentPriorityLevel,We=t.unstable_ImmediatePriority,Ge=t.unstable_UserBlockingPriority,Ke=t.unstable_NormalPriority,qe=t.unstable_LowPriority,Je=t.unstable_IdlePriority,Ye=t.log,Xe=t.unstable_setDisableYieldValue,Ze=null,Qe=null;function $e(e){if(typeof Ye==`function`&&Xe(e),Qe&&typeof Qe.setStrictMode==`function`)try{Qe.setStrictMode(Ze,e)}catch{}}var et=Math.clz32?Math.clz32:rt,tt=Math.log,nt=Math.LN2;function rt(e){return e>>>=0,e===0?32:31-(tt(e)/nt|0)|0}var it=256,at=262144,ot=4194304;function st(e){var t=e&42;if(t!==0)return t;switch(e&-e){case 1:return 1;case 2:return 2;case 4:return 4;case 8:return 8;case 16:return 16;case 32:return 32;case 64:return 64;case 128:return 128;case 256:case 512:case 1024:case 2048:case 4096:case 8192:case 16384:case 32768:case 65536:case 131072:return e&-e;case 262144:case 524288:case 1048576:case 2097152:return e&3932160;case 4194304:case 8388608:case 16777216:case 33554432:return e&62914560;case 67108864:return 67108864;case 134217728:return 134217728;case 268435456:return 268435456;case 536870912:return 536870912;case 1073741824:return 0;default:return e}}function ct(e,t,n){var r=e.pendingLanes;if(r===0)return 0;var i=0,a=e.suspendedLanes,o=e.pingedLanes;e=e.warmLanes;var s=r&134217727;return s===0?(s=r&~a,s===0?o===0?n||(n=r&~e,n!==0&&(i=st(n))):i=st(o):i=st(s)):(r=s&~a,r===0?(o&=s,o===0?n||(n=s&~e,n!==0&&(i=st(n))):i=st(o)):i=st(r)),i===0?0:t!==0&&t!==i&&(t&a)===0&&(a=i&-i,n=t&-t,a>=n||a===32&&n&4194048)?t:i}function lt(e,t){return(e.pendingLanes&~(e.suspendedLanes&~e.pingedLanes)&t)===0}function ut(e,t){t&8&&(t|=t&32);var n=e.entangledLanes;if(n!==0)for(e=e.entanglements,n&=t;0<n;){var r=31-et(n),i=1<<r;t|=e[r],n&=~i}return t}function dt(e,t){switch(e){case 1:case 2:case 4:case 8:case 64:return t+250;case 16:case 32:case 128:case 256:case 512:case 1024:case 2048:case 4096:case 8192:case 16384:case 32768:case 65536:case 131072:case 262144:case 524288:case 1048576:case 2097152:return t+5e3;case 4194304:case 8388608:case 16777216:case 33554432:return-1;case 67108864:case 134217728:case 268435456:case 536870912:case 1073741824:return-1;default:return-1}}function ft(){var e=ot;return ot<<=1,!(ot&62914560)&&(ot=4194304),e}function pt(e){for(var t=[],n=0;31>n;n++)t.push(e);return t}function mt(e,t){e.pendingLanes|=t,t!==268435456&&(e.suspendedLanes=0,e.pingedLanes=0,e.warmLanes=0)}function ht(e,t,n,r,i,a){var o=e.pendingLanes;e.pendingLanes=n,e.suspendedLanes=0,e.pingedLanes=0,e.warmLanes=0,e.expiredLanes&=n,e.entangledLanes&=n,e.errorRecoveryDisabledLanes&=n,e.shellSuspendCounter=0;var s=e.entanglements,c=e.expirationTimes,l=e.hiddenUpdates;for(n=o&~n;0<n;){var u=31-et(n),d=1<<u;s[u]=0,c[u]=-1;var f=l[u];if(f!==null)for(l[u]=null,u=0;u<f.length;u++){var p=f[u];p!==null&&(p.lane&=-536870913)}n&=~d}r!==0&&gt(e,r,0),a!==0&&i===0&&e.tag!==0&&(e.suspendedLanes|=a&~(o&~t))}function gt(e,t,n){e.pendingLanes|=t,e.suspendedLanes&=~t;var r=31-et(t);e.entangledLanes|=t,e.entanglements[r]=e.entanglements[r]|1073741824|n&261930}function _t(e,t){var n=e.entangledLanes|=t;for(e=e.entanglements;n;){var r=31-et(n),i=1<<r;i&t|e[r]&t&&(e[r]|=t),n&=~i}}function vt(e,t){var n=t&-t;return n=n&42?1:yt(n),(n&(e.suspendedLanes|t))===0?n:0}function yt(e){switch(e){case 2:e=1;break;case 8:e=4;break;case 32:e=16;break;case 256:case 512:case 1024:case 2048:case 4096:case 8192:case 16384:case 32768:case 65536:case 131072:case 262144:case 524288:case 1048576:case 2097152:case 4194304:case 8388608:case 16777216:case 33554432:e=128;break;case 268435456:e=134217728;break;default:e=0}return e}function bt(e){return e&=-e,2<e?8<e?e&134217727?32:268435456:8:2}function xt(){var e=M.p;return e===0?(e=window.event,e===void 0?32:Ch(e.type)):e}function St(e,t){var n=M.p;try{return M.p=e,t()}finally{M.p=n}}var Ct=Math.random().toString(36).slice(2),wt=`__reactFiber$`+Ct,Tt=`__reactProps$`+Ct,Et=`__reactContainer$`+Ct,Dt=`__reactEvents$`+Ct,Ot=`__reactListeners$`+Ct,kt=`__reactHandles$`+Ct,At=`__reactResources$`+Ct,jt=`__reactMarker$`+Ct,Mt=`__reactLoad$`+Ct;function Nt(e){delete e[wt],delete e[Tt],delete e[Ot],delete e[kt]}function Pt(e){var t;if(t=e[wt])return t;for(var n=e.parentNode;n;){if(t=n[Et]||n[wt]){if(n=t.alternate,t.child!==null||n!==null&&n.child!==null)for(e=fm(e);e!==null;){if(n=e[wt])return n;e=fm(e)}return t}e=n,n=e.parentNode}return null}function Ft(e){if(e=e[wt]||e[Et]){var t=e.tag;if(t===5||t===6||t===13||t===31||t===26||t===27||t===3)return e}return null}function It(e){var t=e.tag;if(t===5||t===26||t===27||t===6)return e.stateNode;throw Error(i(33))}function Lt(e){var t=e[At];return t||=e[At]={hoistableStyles:new Map,hoistableScripts:new Map},t}function Rt(e){e[jt]=!0}function zt(e){e[Mt]=void 0}var Bt=new Set,Vt={};function Ht(e,t){Ut(e,t),Ut(e+`Capture`,t)}function Ut(e,t){for(Vt[e]=t,e=0;e<t.length;e++)Bt.add(t[e])}var Wt=RegExp(`^[:A-Z_a-z\\u00C0-\\u00D6\\u00D8-\\u00F6\\u00F8-\\u02FF\\u0370-\\u037D\\u037F-\\u1FFF\\u200C-\\u200D\\u2070-\\u218F\\u2C00-\\u2FEF\\u3001-\\uD7FF\\uF900-\\uFDCF\\uFDF0-\\uFFFD][:A-Z_a-z\\u00C0-\\u00D6\\u00D8-\\u00F6\\u00F8-\\u02FF\\u0370-\\u037D\\u037F-\\u1FFF\\u200C-\\u200D\\u2070-\\u218F\\u2C00-\\u2FEF\\u3001-\\uD7FF\\uF900-\\uFDCF\\uFDF0-\\uFFFD\\-.0-9\\u00B7\\u0300-\\u036F\\u203F-\\u2040]*$`),Gt={},Kt={};function qt(e){return Le.call(Kt,e)?!0:Le.call(Gt,e)?!1:Wt.test(e)?Kt[e]=!0:(Gt[e]=!0,!1)}var P=!1;function Jt(){var e=P;return P=!1,e}function Yt(e,t,n){if(qt(t))if(n===null)e.removeAttribute(t);else{switch(typeof n){case`undefined`:case`function`:case`symbol`:e.removeAttribute(t);return;case`boolean`:var r=t.toLowerCase().slice(0,5);if(r!==`data-`&&r!==`aria-`){e.removeAttribute(t);return}}e.setAttribute(t,n)}}function Xt(e,t,n){if(n===null)e.removeAttribute(t);else{switch(typeof n){case`undefined`:case`function`:case`symbol`:case`boolean`:e.removeAttribute(t);return}e.setAttribute(t,n)}}function Zt(e,t,n,r){if(r===null)e.removeAttribute(n);else{switch(typeof r){case`undefined`:case`function`:case`symbol`:case`boolean`:e.removeAttribute(n);return}e.setAttributeNS(t,n,r)}}function Qt(e){switch(typeof e){case`bigint`:case`boolean`:case`number`:case`string`:case`undefined`:return e;case`object`:return e;default:return``}}function $t(e){var t=e.type;return(e=e.nodeName)&&e.toLowerCase()===`input`&&(t===`checkbox`||t===`radio`)}function en(e,t,n){var r=Object.getOwnPropertyDescriptor(e.constructor.prototype,t);if(!e.hasOwnProperty(t)&&r!==void 0&&typeof r.get==`function`&&typeof r.set==`function`){var i=r.get,a=r.set;return Object.defineProperty(e,t,{configurable:!0,get:function(){return i.call(this)},set:function(e){n=``+e,a.call(this,e)}}),Object.defineProperty(e,t,{enumerable:r.enumerable}),{getValue:function(){return n},setValue:function(e){n=``+e},stopTracking:function(){e._valueTracker=null,delete e[t]}}}}function tn(e){if(!e._valueTracker){var t=$t(e)?`checked`:`value`;e._valueTracker=en(e,t,``+e[t])}}function nn(e){if(!e)return!1;var t=e._valueTracker;if(!t)return!0;var n=t.getValue(),r=``;return e&&(r=$t(e)?e.checked?`true`:`false`:e.value),e=r,e===n?!1:(t.setValue(e),!0)}var rn=/[\n"\\]/g;function an(e){return e.replace(rn,function(e){return`\\`+e.charCodeAt(0).toString(16)+` `})}function on(e,t,n,r,i,a,o,s){e.name=``,o!=null&&typeof o!=`function`&&typeof o!=`symbol`&&typeof o!=`boolean`?e.type=o:e.removeAttribute(`type`),t==null?o!==`submit`&&o!==`reset`||e.removeAttribute(`value`):o===`number`?(t===0&&e.value===``||e.value!=t)&&(e.value=``+Qt(t)):e.value!==``+Qt(t)&&(e.value=``+Qt(t)),t==null?n==null?r!=null&&e.removeAttribute(`value`):cn(e,Qt(n)):o===`number`&&e.value==t?cn(e,Qt(e.value)):cn(e,Qt(t)),i==null&&a!=null&&(e.defaultChecked=!!a),i!=null&&(e.checked=i&&typeof i!=`function`&&typeof i!=`symbol`),s!=null&&typeof s!=`function`&&typeof s!=`symbol`&&typeof s!=`boolean`?e.name=``+Qt(s):e.removeAttribute(`name`)}function sn(e,t,n,r,i,a,o,s){if(a!=null&&typeof a!=`function`&&typeof a!=`symbol`&&typeof a!=`boolean`&&(e.type=a),t!=null||n!=null){if(!(a!==`submit`&&a!==`reset`||t!=null)){tn(e);return}n=n==null?``:``+Qt(n),t=t==null?n:``+Qt(t),s||t===e.value||(e.value=t),e.defaultValue=t}r??=i,r=typeof r!=`function`&&typeof r!=`symbol`&&!!r,e.checked=s?e.checked:!!r,e.defaultChecked=!!r,o!=null&&typeof o!=`function`&&typeof o!=`symbol`&&typeof o!=`boolean`&&(e.name=o),tn(e)}function cn(e,t){e.defaultValue!==``+t&&(e.defaultValue=``+t)}function ln(e,t,n,r){if(e=e.options,t){t={};for(var i=0;i<n.length;i++)t[`$`+n[i]]=!0;for(n=0;n<e.length;n++)i=t.hasOwnProperty(`$`+e[n].value),e[n].selected!==i&&(e[n].selected=i),i&&r&&(e[n].defaultSelected=!0)}else{for(n=``+Qt(n),t=null,i=0;i<e.length;i++){if(e[i].value===n){e[i].selected=!0,r&&(e[i].defaultSelected=!0);return}t!==null||e[i].disabled||(t=e[i])}t!==null&&(t.selected=!0)}}function un(e,t,n){if(t!=null&&(t=``+Qt(t),t!==e.value&&(e.value=t),n==null)){e.defaultValue!==t&&(e.defaultValue=t);return}e.defaultValue=n==null?``:``+Qt(n)}function dn(e,t,n,r){if(t==null){if(r!=null){if(n!=null)throw Error(i(92));if(A(r)){if(1<r.length)throw Error(i(93));r=r[0]}n=r}n??=``,t=n}n=Qt(t),e.defaultValue=n,r=e.textContent,r===n&&r!==``&&r!==null&&(e.value=r),tn(e)}function fn(e,t){if(t){var n=e.firstChild;if(n&&n===e.lastChild&&n.nodeType===3){n.nodeValue=t;return}}e.textContent=t}var pn=new Set(`animationIterationCount aspectRatio borderImageOutset borderImageSlice borderImageWidth boxFlex boxFlexGroup boxOrdinalGroup columnCount columns flex flexGrow flexPositive flexShrink flexNegative flexOrder gridArea gridRow gridRowEnd gridRowSpan gridRowStart gridColumn gridColumnEnd gridColumnSpan gridColumnStart fontWeight lineClamp lineHeight opacity order orphans scale tabSize widows zIndex zoom fillOpacity floodOpacity stopOpacity strokeDasharray strokeDashoffset strokeMiterlimit strokeOpacity strokeWidth MozAnimationIterationCount MozBoxFlex MozBoxFlexGroup MozLineClamp msAnimationIterationCount msFlex msZoom msFlexGrow msFlexNegative msFlexOrder msFlexPositive msFlexShrink msGridColumn msGridColumnSpan msGridRow msGridRowSpan WebkitAnimationIterationCount WebkitBoxFlex WebKitBoxFlexGroup WebkitBoxOrdinalGroup WebkitColumnCount WebkitColumns WebkitFlex WebkitFlexGrow WebkitFlexPositive WebkitFlexShrink WebkitLineClamp`.split(` `));function mn(e,t,n){var r=t.indexOf(`--`)===0;n==null||typeof n==`boolean`||n===``?r?e.setProperty(t,``):t===`float`?e.cssFloat=``:e[t]=``:r?e.setProperty(t,n):typeof n!=`number`||n===0||pn.has(t)?t===`float`?e.cssFloat=n:e[t]=(``+n).trim():e[t]=n+`px`}function hn(e,t,n){if(t!=null&&typeof t!=`object`)throw Error(i(62));if(e=e.style,n!=null){for(var r in n)!n.hasOwnProperty(r)||t!=null&&t.hasOwnProperty(r)||(r.indexOf(`--`)===0?e.setProperty(r,``):r===`float`?e.cssFloat=``:e[r]=``,P=!0);for(var a in t)r=t[a],t.hasOwnProperty(a)&&n[a]!==r&&(mn(e,a,r),P=!0)}else for(var o in t)t.hasOwnProperty(o)&&mn(e,o,t[o])}function gn(e){if(e.indexOf(`-`)===-1)return!1;switch(e){case`annotation-xml`:case`color-profile`:case`font-face`:case`font-face-src`:case`font-face-uri`:case`font-face-format`:case`font-face-name`:case`missing-glyph`:return!1;default:return!0}}var _n=new Map([[`acceptCharset`,`accept-charset`],[`htmlFor`,`for`],[`httpEquiv`,`http-equiv`],[`crossOrigin`,`crossorigin`],[`accentHeight`,`accent-height`],[`alignmentBaseline`,`alignment-baseline`],[`arabicForm`,`arabic-form`],[`baselineShift`,`baseline-shift`],[`capHeight`,`cap-height`],[`clipPath`,`clip-path`],[`clipRule`,`clip-rule`],[`colorInterpolation`,`color-interpolation`],[`colorInterpolationFilters`,`color-interpolation-filters`],[`colorProfile`,`color-profile`],[`colorRendering`,`color-rendering`],[`dominantBaseline`,`dominant-baseline`],[`enableBackground`,`enable-background`],[`fillOpacity`,`fill-opacity`],[`fillRule`,`fill-rule`],[`floodColor`,`flood-color`],[`floodOpacity`,`flood-opacity`],[`fontFamily`,`font-family`],[`fontSize`,`font-size`],[`fontSizeAdjust`,`font-size-adjust`],[`fontStretch`,`font-stretch`],[`fontStyle`,`font-style`],[`fontVariant`,`font-variant`],[`fontWeight`,`font-weight`],[`glyphName`,`glyph-name`],[`glyphOrientationHorizontal`,`glyph-orientation-horizontal`],[`glyphOrientationVertical`,`glyph-orientation-vertical`],[`horizAdvX`,`horiz-adv-x`],[`horizOriginX`,`horiz-origin-x`],[`imageRendering`,`image-rendering`],[`letterSpacing`,`letter-spacing`],[`lightingColor`,`lighting-color`],[`markerEnd`,`marker-end`],[`markerMid`,`marker-mid`],[`markerStart`,`marker-start`],[`maskType`,`mask-type`],[`overlinePosition`,`overline-position`],[`overlineThickness`,`overline-thickness`],[`paintOrder`,`paint-order`],[`panose-1`,`panose-1`],[`pointerEvents`,`pointer-events`],[`renderingIntent`,`rendering-intent`],[`shapeRendering`,`shape-rendering`],[`stopColor`,`stop-color`],[`stopOpacity`,`stop-opacity`],[`strikethroughPosition`,`strikethrough-position`],[`strikethroughThickness`,`strikethrough-thickness`],[`strokeDasharray`,`stroke-dasharray`],[`strokeDashoffset`,`stroke-dashoffset`],[`strokeLinecap`,`stroke-linecap`],[`strokeLinejoin`,`stroke-linejoin`],[`strokeMiterlimit`,`stroke-miterlimit`],[`strokeOpacity`,`stroke-opacity`],[`strokeWidth`,`stroke-width`],[`textAnchor`,`text-anchor`],[`textDecoration`,`text-decoration`],[`textRendering`,`text-rendering`],[`transformOrigin`,`transform-origin`],[`underlinePosition`,`underline-position`],[`underlineThickness`,`underline-thickness`],[`unicodeBidi`,`unicode-bidi`],[`unicodeRange`,`unicode-range`],[`unitsPerEm`,`units-per-em`],[`vAlphabetic`,`v-alphabetic`],[`vHanging`,`v-hanging`],[`vIdeographic`,`v-ideographic`],[`vMathematical`,`v-mathematical`],[`vectorEffect`,`vector-effect`],[`vertAdvY`,`vert-adv-y`],[`vertOriginX`,`vert-origin-x`],[`vertOriginY`,`vert-origin-y`],[`wordSpacing`,`word-spacing`],[`writingMode`,`writing-mode`],[`xmlnsXlink`,`xmlns:xlink`],[`xHeight`,`x-height`]]),vn=/^[\u0000-\u001F ]*j[\r\n\t]*a[\r\n\t]*v[\r\n\t]*a[\r\n\t]*s[\r\n\t]*c[\r\n\t]*r[\r\n\t]*i[\r\n\t]*p[\r\n\t]*t[\r\n\t]*:/i;function yn(e){return vn.test(``+e)?`javascript:throw new Error('React has blocked a javascript: URL as a security precaution.')`:e}function bn(){}var xn=null;function Sn(e){return e=e.target||e.srcElement||window,e.correspondingUseElement&&(e=e.correspondingUseElement),e.nodeType===3?e.parentNode:e}var Cn=null,wn=null;function Tn(e){var t=Ft(e);if(t&&(e=t.stateNode)){var n=e[Tt]||null;a:switch(e=t.stateNode,t.type){case`input`:if(on(e,n.value,n.defaultValue,n.defaultValue,n.checked,n.defaultChecked,n.type,n.name),t=n.name,n.type===`radio`&&t!=null){for(n=e;n.parentNode;)n=n.parentNode;for(n=n.querySelectorAll(`input[name="`+an(``+t)+`"][type="radio"]`),t=0;t<n.length;t++){var r=n[t];if(r!==e&&r.form===e.form){var a=r[Tt]||null;if(!a)throw Error(i(90));on(r,a.value,a.defaultValue,a.defaultValue,a.checked,a.defaultChecked,a.type,a.name)}}for(t=0;t<n.length;t++)r=n[t],r.form===e.form&&nn(r)}break a;case`textarea`:un(e,n.value,n.defaultValue);break a;case`select`:t=n.value,t!=null&&ln(e,!!n.multiple,t,!1)}}}var En=!1;function Dn(e,t,n){if(En)return e(t,n);En=!0;try{return e(t)}finally{if(En=!1,(Cn!==null||wn!==null)&&(Bd(),Cn&&(t=Cn,e=wn,wn=Cn=null,Tn(t),e)))for(t=0;t<e.length;t++)Tn(e[t])}}function On(e,t){var n=e.stateNode;if(n===null)return null;var r=n[Tt]||null;if(r===null)return null;n=r[t];a:switch(t){case`onClick`:case`onClickCapture`:case`onDoubleClick`:case`onDoubleClickCapture`:case`onMouseDown`:case`onMouseDownCapture`:case`onMouseMove`:case`onMouseMoveCapture`:case`onMouseUp`:case`onMouseUpCapture`:case`onMouseEnter`:(r=!r.disabled)||(e=e.type,r=!(e===`button`||e===`input`||e===`select`||e===`textarea`)),e=!r;break a;default:e=!1}if(e)return null;if(n&&typeof n!=`function`)throw Error(i(231,t,typeof n));return n}var kn=!(typeof window>`u`||window.document===void 0||window.document.createElement===void 0),An=!1;if(kn)try{var jn={};Object.defineProperty(jn,`passive`,{get:function(){An=!0}}),window.addEventListener(`test`,jn,jn),window.removeEventListener(`test`,jn,jn)}catch{An=!1}var Mn=null,Nn=null,Pn=null;function Fn(){if(Pn)return Pn;var e,t=Nn,n=t.length,r,i=`value`in Mn?Mn.value:Mn.textContent,a=i.length;for(e=0;e<n&&t[e]===i[e];e++);var o=n-e;for(r=1;r<=o&&t[n-r]===i[a-r];r++);return Pn=i.slice(e,1<r?1-r:void 0)}function In(e){var t=e.keyCode;return`charCode`in e?(e=e.charCode,e===0&&t===13&&(e=13)):e=t,e===10&&(e=13),32<=e||e===13?e:0}function Ln(){return!0}function Rn(){return!1}function zn(e){function t(t,n,r,i,a){for(var o in this._reactName=t,this._targetInst=r,this.type=n,this.nativeEvent=i,this.target=a,this.currentTarget=null,e)e.hasOwnProperty(o)&&(t=e[o],this[o]=t?t(i):i[o]);return this.isDefaultPrevented=(i.defaultPrevented==null?!1===i.returnValue:i.defaultPrevented)?Ln:Rn,this.isPropagationStopped=Rn,this}return w(t.prototype,{preventDefault:function(){this.defaultPrevented=!0;var e=this.nativeEvent;e&&(e.preventDefault?e.preventDefault():typeof e.returnValue!=`unknown`&&(e.returnValue=!1),this.isDefaultPrevented=Ln)},stopPropagation:function(){var e=this.nativeEvent;e&&(e.stopPropagation?e.stopPropagation():typeof e.cancelBubble!=`unknown`&&(e.cancelBubble=!0),this.isPropagationStopped=Ln)},persist:function(){},isPersistent:Ln}),t}var Bn={eventPhase:0,bubbles:0,cancelable:0,timeStamp:function(e){return e.timeStamp||Date.now()},defaultPrevented:0,isTrusted:0},Vn=zn(Bn),Hn=w({},Bn,{view:0,detail:0}),Un=zn(Hn),Wn,Gn,Kn,qn=w({},Hn,{screenX:0,screenY:0,clientX:0,clientY:0,pageX:0,pageY:0,ctrlKey:0,shiftKey:0,altKey:0,metaKey:0,getModifierState:ir,button:0,buttons:0,relatedTarget:function(e){return e.relatedTarget===void 0?e.fromElement===e.srcElement?e.toElement:e.fromElement:e.relatedTarget},movementX:function(e){return`movementX`in e?e.movementX:(e!==Kn&&(Kn&&e.type===`mousemove`?(Wn=e.screenX-Kn.screenX,Gn=e.screenY-Kn.screenY):Gn=Wn=0,Kn=e),Wn)},movementY:function(e){return`movementY`in e?e.movementY:Gn}}),Jn=zn(qn),Yn=zn(w({},qn,{dataTransfer:0})),Xn=zn(w({},Hn,{relatedTarget:0})),Zn=zn(w({},Bn,{animationName:0,elapsedTime:0,pseudoElement:0})),Qn=zn(w({},Bn,{clipboardData:function(e){return`clipboardData`in e?e.clipboardData:window.clipboardData}})),$n=zn(w({},Bn,{data:0})),er={Esc:`Escape`,Spacebar:` `,Left:`ArrowLeft`,Up:`ArrowUp`,Right:`ArrowRight`,Down:`ArrowDown`,Del:`Delete`,Win:`OS`,Menu:`ContextMenu`,Apps:`ContextMenu`,Scroll:`ScrollLock`,MozPrintableKey:`Unidentified`},tr={8:`Backspace`,9:`Tab`,12:`Clear`,13:`Enter`,16:`Shift`,17:`Control`,18:`Alt`,19:`Pause`,20:`CapsLock`,27:`Escape`,32:` `,33:`PageUp`,34:`PageDown`,35:`End`,36:`Home`,37:`ArrowLeft`,38:`ArrowUp`,39:`ArrowRight`,40:`ArrowDown`,45:`Insert`,46:`Delete`,112:`F1`,113:`F2`,114:`F3`,115:`F4`,116:`F5`,117:`F6`,118:`F7`,119:`F8`,120:`F9`,121:`F10`,122:`F11`,123:`F12`,144:`NumLock`,145:`ScrollLock`,224:`Meta`},nr={Alt:`altKey`,Control:`ctrlKey`,Meta:`metaKey`,Shift:`shiftKey`};function rr(e){var t=this.nativeEvent;return t.getModifierState?t.getModifierState(e):(e=nr[e])?!!t[e]:!1}function ir(){return rr}var ar=zn(w({},Hn,{key:function(e){if(e.key){var t=er[e.key]||e.key;if(t!==`Unidentified`)return t}return e.type===`keypress`?(e=In(e),e===13?`Enter`:String.fromCharCode(e)):e.type===`keydown`||e.type===`keyup`?tr[e.keyCode]||`Unidentified`:``},code:0,location:0,ctrlKey:0,shiftKey:0,altKey:0,metaKey:0,repeat:0,locale:0,getModifierState:ir,charCode:function(e){return e.type===`keypress`?In(e):0},keyCode:function(e){return e.type===`keydown`||e.type===`keyup`?e.keyCode:0},which:function(e){return e.type===`keypress`?In(e):e.type===`keydown`||e.type===`keyup`?e.keyCode:0}})),or=zn(w({},qn,{pointerId:0,width:0,height:0,pressure:0,tangentialPressure:0,tiltX:0,tiltY:0,twist:0,pointerType:0,isPrimary:0})),sr=zn(w({},Bn,{submitter:0})),cr=zn(w({},Hn,{touches:0,targetTouches:0,changedTouches:0,altKey:0,metaKey:0,ctrlKey:0,shiftKey:0,getModifierState:ir})),lr=zn(w({},Bn,{propertyName:0,elapsedTime:0,pseudoElement:0})),ur=zn(w({},qn,{deltaX:function(e){return`deltaX`in e?e.deltaX:`wheelDeltaX`in e?-e.wheelDeltaX:0},deltaY:function(e){return`deltaY`in e?e.deltaY:`wheelDeltaY`in e?-e.wheelDeltaY:`wheelDelta`in e?-e.wheelDelta:0},deltaZ:0,deltaMode:0})),dr=zn(w({},Bn,{newState:0,oldState:0,source:0})),fr=[9,13,27,32],pr=kn&&`CompositionEvent`in window,mr=null;kn&&`documentMode`in document&&(mr=document.documentMode);var hr=kn&&`TextEvent`in window&&!mr,gr=kn&&(!pr||mr&&8<mr&&11>=mr),_r=` `,vr=!1;function yr(e,t){switch(e){case`keyup`:return fr.indexOf(t.keyCode)!==-1;case`keydown`:return t.keyCode!==229;case`keypress`:case`mousedown`:case`focusout`:return!0;default:return!1}}function br(e){return e=e.detail,typeof e==`object`&&`data`in e?e.data:null}var xr=!1;function Sr(e,t){switch(e){case`compositionend`:return br(t);case`keypress`:return t.which===32?(vr=!0,_r):null;case`textInput`:return e=t.data,e===_r&&vr?null:e;default:return null}}function Cr(e,t){if(xr)return e===`compositionend`||!pr&&yr(e,t)?(e=Fn(),Pn=Nn=Mn=null,xr=!1,e):null;switch(e){case`paste`:return null;case`keypress`:if(!(t.ctrlKey||t.altKey||t.metaKey)||t.ctrlKey&&t.altKey){if(t.char&&1<t.char.length)return t.char;if(t.which)return String.fromCharCode(t.which)}return null;case`compositionend`:return gr&&t.locale!==`ko`?null:t.data;default:return null}}var wr={color:!0,date:!0,datetime:!0,"datetime-local":!0,email:!0,month:!0,number:!0,password:!0,range:!0,search:!0,tel:!0,text:!0,time:!0,url:!0,week:!0};function Tr(e){var t=e&&e.nodeName&&e.nodeName.toLowerCase();return t===`input`?!!wr[e.type]:t===`textarea`}function Er(e,t,n,r){Cn?wn?wn.push(r):wn=[r]:Cn=r,t=Jf(t,`onChange`),0<t.length&&(n=new Vn(`onChange`,`change`,null,n,r),e.push({event:n,listeners:t}))}var Dr=null,Or=null;function kr(e){Vf(e,0)}function Ar(e){if(nn(It(e)))return e}function jr(e,t){if(e===`change`)return t}var Mr=!1;if(kn){var Nr;if(kn){var Pr=`oninput`in document;if(!Pr){var Fr=document.createElement(`div`);Fr.setAttribute(`oninput`,`return;`),Pr=typeof Fr.oninput==`function`}Nr=Pr}else Nr=!1;Mr=Nr&&(!document.documentMode||9<document.documentMode)}function Ir(){Dr&&(Dr.detachEvent(`onpropertychange`,Lr),Or=Dr=null)}function Lr(e){if(e.propertyName===`value`&&Ar(Or)){var t=[];Er(t,Or,e,Sn(e)),Dn(kr,t)}}function Rr(e,t,n){e===`focusin`?(Ir(),Dr=t,Or=n,Dr.attachEvent(`onpropertychange`,Lr)):e===`focusout`&&Ir()}function zr(e){if(e===`selectionchange`||e===`keyup`||e===`keydown`)return Ar(Or)}function Br(e,t){if(e===`click`)return Ar(t)}function Vr(e,t){if(e===`input`||e===`change`)return Ar(t)}function Hr(e,t){return e===t&&(e!==0||1/e==1/t)||e!==e&&t!==t}var Ur=typeof Object.is==`function`?Object.is:Hr;function Wr(e,t){if(Ur(e,t))return!0;if(typeof e!=`object`||!e||typeof t!=`object`||!t)return!1;var n=Object.keys(e),r=Object.keys(t);if(n.length!==r.length)return!1;for(r=0;r<n.length;r++){var i=n[r];if(!Le.call(t,i)||!Ur(e[i],t[i]))return!1}return!0}function Gr(e){if(e||=typeof document<`u`?document:void 0,e===void 0)return null;try{return e.activeElement||e.body}catch{return e.body}}function Kr(e){for(;e&&e.firstChild;)e=e.firstChild;return e}function qr(e,t){var n=Kr(e);e=0;for(var r;n;){if(n.nodeType===3){if(r=e+n.textContent.length,e<=t&&r>=t)return{node:n,offset:t-e};e=r}a:{for(;n;){if(n.nextSibling){n=n.nextSibling;break a}n=n.parentNode}n=void 0}n=Kr(n)}}function Jr(e,t){return e&&t?e===t?!0:e&&e.nodeType===3?!1:t&&t.nodeType===3?Jr(e,t.parentNode):`contains`in e?e.contains(t):e.compareDocumentPosition?!!(e.compareDocumentPosition(t)&16):!1:!1}function Yr(e){e=e!=null&&e.ownerDocument!=null&&e.ownerDocument.defaultView!=null?e.ownerDocument.defaultView:window;for(var t=Gr(e.document);t instanceof e.HTMLIFrameElement;){try{var n=typeof t.contentWindow.location.href==`string`}catch{n=!1}if(n)e=t.contentWindow;else break;t=Gr(e.document)}return t}function Xr(e){var t=e&&e.nodeName&&e.nodeName.toLowerCase();return t&&(t===`input`&&(e.type===`text`||e.type===`search`||e.type===`tel`||e.type===`url`||e.type===`password`)||t===`textarea`||e.contentEditable===`true`)}var Zr=kn&&`documentMode`in document&&11>=document.documentMode,Qr=null,$r=null,ei=null,ti=!1;function ni(e,t,n){var r=n.window===n?n.document:n.nodeType===9?n:n.ownerDocument;ti||Qr==null||Qr!==Gr(r)||(r=Qr,`selectionStart`in r&&Xr(r)?r={start:r.selectionStart,end:r.selectionEnd}:(r=(r.ownerDocument&&r.ownerDocument.defaultView||window).getSelection(),r={anchorNode:r.anchorNode,anchorOffset:r.anchorOffset,focusNode:r.focusNode,focusOffset:r.focusOffset}),ei&&Wr(ei,r)||(ei=r,r=Jf($r,`onSelect`),0<r.length&&(t=new Vn(`onSelect`,`select`,null,t,n),e.push({event:t,listeners:r}),t.target=Qr)))}function ri(e,t){var n={};return n[e.toLowerCase()]=t.toLowerCase(),n[`Webkit`+e]=`webkit`+t,n[`Moz`+e]=`moz`+t,n}var ii={animationend:ri(`Animation`,`AnimationEnd`),animationiteration:ri(`Animation`,`AnimationIteration`),animationstart:ri(`Animation`,`AnimationStart`),transitionrun:ri(`Transition`,`TransitionRun`),transitionstart:ri(`Transition`,`TransitionStart`),transitioncancel:ri(`Transition`,`TransitionCancel`),transitionend:ri(`Transition`,`TransitionEnd`)},ai={},oi={};kn&&(oi=document.createElement(`div`).style,`AnimationEvent`in window||(delete ii.animationend.animation,delete ii.animationiteration.animation,delete ii.animationstart.animation),`TransitionEvent`in window||delete ii.transitionend.transition);function si(e){if(ai[e])return ai[e];if(!ii[e])return e;var t=ii[e],n;for(n in t)if(t.hasOwnProperty(n)&&n in oi)return ai[e]=t[n];return e}var ci=si(`animationend`),li=si(`animationiteration`),ui=si(`animationstart`),di=si(`transitionrun`),fi=si(`transitionstart`),pi=si(`transitioncancel`),mi=si(`transitionend`),hi=new Map,gi=`abort auxClick beforeToggle cancel canPlay canPlayThrough click close contextMenu copy cut drag dragEnd dragEnter dragExit dragLeave dragOver dragStart drop durationChange emptied encrypted ended error fullscreenChange fullscreenError gotPointerCapture input invalid keyDown keyPress keyUp load loadedData loadedMetadata loadStart lostPointerCapture mouseDown mouseMove mouseOut mouseOver mouseUp paste pause play playing pointerCancel pointerDown pointerMove pointerOut pointerOver pointerUp progress rateChange reset resize seeked seeking stalled submit suspend timeUpdate touchCancel touchEnd touchStart volumeChange scroll toggle touchMove waiting wheel`.split(` `);gi.push(`scrollEnd`);function _i(e,t){hi.set(e,t),Ht(t,[e])}var vi=0;function yi(e,t){if(e.name!=null&&e.name!==`auto`)return e.name;if(t.autoName!==null)return t.autoName;e=xd.identifierPrefix;var n=vi++;return e=`_`+e+`t_`+n.toString(32)+`_`,t.autoName=e}function bi(e){if(e==null||typeof e==`string`)return e;var t=null,n=kd;if(n!==null)for(var r=0;r<n.length;r++){var i=e[n[r]];if(i!=null){if(i===`none`)return`none`;t=t==null?i:t+(` `+i)}}return t??e.default}function xi(e,t){return e=bi(e),t=bi(t),t==null?e===`auto`?null:e:t===`auto`?null:t}var Si=typeof reportError==`function`?reportError:function(e){if(typeof window==`object`&&typeof window.ErrorEvent==`function`){var t=new window.ErrorEvent(`error`,{bubbles:!0,cancelable:!0,message:typeof e==`object`&&e&&typeof e.message==`string`?String(e.message):String(e),error:e});if(!window.dispatchEvent(t))return}else if(typeof process==`object`&&typeof process.emit==`function`){process.emit(`uncaughtException`,e);return}console.error(e)},Ci=[],wi=0,Ti=0;function Ei(){for(var e=wi,t=Ti=wi=0;t<e;){var n=Ci[t];Ci[t++]=null;var r=Ci[t];Ci[t++]=null;var i=Ci[t];Ci[t++]=null;var a=Ci[t];if(Ci[t++]=null,r!==null&&i!==null){var o=r.pending;o===null?i.next=i:(i.next=o.next,o.next=i),r.pending=i}a!==0&&Ai(n,i,a)}}function Di(e,t,n,r){Ci[wi++]=e,Ci[wi++]=t,Ci[wi++]=n,Ci[wi++]=r,Ti|=r,e.lanes|=r,e=e.alternate,e!==null&&(e.lanes|=r)}function Oi(e,t,n,r){return Di(e,t,n,r),F(e)}function ki(e,t){return Di(e,null,null,t),F(e)}function Ai(e,t,n){e.lanes|=n;var r=e.alternate;r!==null&&(r.lanes|=n);for(var i=!1,a=e.return;a!==null;)a.childLanes|=n,r=a.alternate,r!==null&&(r.childLanes|=n),a.tag===22&&(e=a.stateNode,e===null||e._visibility&1||(i=!0)),e=a,a=a.return;return e.tag===3?(a=e.stateNode,i&&t!==null&&(i=31-et(n),e=a.hiddenUpdates,r=e[i],r===null?e[i]=[t]:r.push(t),t.lane=n|536870912),a):null}function F(e){if(50<Ad)throw Ad=0,jd=null,Error(i(185));for(var t=e.return;t!==null;)e=t,t=e.return;return e.tag===3?e.stateNode:null}var ji={};function Mi(e,t,n,r){this.tag=e,this.key=n,this.sibling=this.child=this.return=this.stateNode=this.type=this.elementType=null,this.index=0,this.refCleanup=this.ref=null,this.pendingProps=t,this.dependencies=this.memoizedState=this.updateQueue=this.memoizedProps=null,this.mode=r,this.subtreeFlags=this.flags=0,this.deletions=null,this.childLanes=this.lanes=0,this.alternate=null}function Ni(e,t,n,r){return new Mi(e,t,n,r)}function Pi(e){return e=e.prototype,!(!e||!e.isReactComponent)}function Fi(e,t){var n=e.alternate;return n===null?(n=Ni(e.tag,t,e.key,e.mode),n.elementType=e.elementType,n.type=e.type,n.stateNode=e.stateNode,n.alternate=e,e.alternate=n):(n.pendingProps=t,n.type=e.type,n.flags=0,n.subtreeFlags=0,n.deletions=null),n.flags=e.flags&1206910976,n.childLanes=e.childLanes,n.lanes=e.lanes,n.child=e.child,n.memoizedProps=e.memoizedProps,n.memoizedState=e.memoizedState,n.updateQueue=e.updateQueue,t=e.dependencies,n.dependencies=t===null?null:{lanes:t.lanes,firstContext:t.firstContext},n.sibling=e.sibling,n.index=e.index,n.ref=e.ref,n.refCleanup=e.refCleanup,n}function Ii(e,t){e.flags&=1206910978;var n=e.alternate;return n===null?(e.childLanes=0,e.lanes=t,e.child=null,e.subtreeFlags=0,e.memoizedProps=null,e.memoizedState=null,e.updateQueue=null,e.dependencies=null,e.stateNode=null):(e.childLanes=n.childLanes,e.lanes=n.lanes,e.child=n.child,e.subtreeFlags=0,e.deletions=null,e.memoizedProps=n.memoizedProps,e.memoizedState=n.memoizedState,e.updateQueue=n.updateQueue,e.type=n.type,t=n.dependencies,e.dependencies=t===null?null:{lanes:t.lanes,firstContext:t.firstContext}),e}function Li(e,t,n,r,a,o){var s=0;if(r=e,typeof r==`function`)Pi(r)&&(s=1);else if(typeof r==`string`)s=qm(e,n,Se.current)?26:e===`html`||e===`head`||e===`body`?27:5;else a:switch(r){case ce:return e=Ni(31,n,t,a),e.elementType=ce,e.lanes=o,e;case O:return Ri(n.children,a,o,t);case ee:s=8,a|=24;break;case te:return e=Ni(12,n,t,a|2),e.elementType=te,e.lanes=o,e;case ie:return e=Ni(13,n,t,a),e.elementType=ie,e.lanes=o,e;case ae:return e=Ni(19,n,t,a),e.elementType=ae,e.lanes=o,e;case le:case de:return e=a|32,e=Ni(30,n,t,e),e.elementType=de,e.lanes=o,e.stateNode={autoName:null,paired:null,clones:null,ref:null},e;default:if(typeof r==`object`&&r)switch(r.$$typeof){case k:s=10;break a;case ne:s=9;break a;case re:s=11;break a;case oe:s=14;break a;case se:s=16,r=null;break a}s=29,n=Error(i(130,e===null?`null`:typeof e,``)),r=null}return t=Ni(s,n,t,a),t.elementType=e,t.type=r,t.lanes=o,t}function Ri(e,t,n,r){return e=Ni(7,e,r,t),e.lanes=n,e}function zi(e,t,n){return e=Ni(6,e,null,t),e.lanes=n,e}function Bi(e){var t=Ni(18,null,null,0);return t.stateNode=e,t}function Vi(e,t,n){return t=Ni(4,e.children===null?[]:e.children,e.key,t),t.lanes=n,t.stateNode={containerInfo:e.containerInfo,pendingChildren:null,implementation:e.implementation},t}var Hi=new WeakMap;function Ui(e,t){if(typeof e==`object`&&e){var n=Hi.get(e);return n===void 0?(t={value:e,source:t,stack:Ie(t)},Hi.set(e,t),t):n}return{value:e,source:t,stack:Ie(t)}}var Wi=[],Gi=0,Ki=null,qi=0,Ji=[],Yi=0,Xi=null,Zi=1,Qi=``;function $i(e,t){Wi[Gi++]=qi,Wi[Gi++]=Ki,Ki=e,qi=t}function ea(e,t,n){Ji[Yi++]=Zi,Ji[Yi++]=Qi,Ji[Yi++]=Xi,Xi=e;var r=Zi;e=Qi;var i=32-et(r)-1;r&=~(1<<i),n+=1;var a=32-et(t)+i;if(30<a){var o=i-i%5;a=(r&(1<<o)-1).toString(32),r>>=o,i-=o,Zi=1<<32-et(t)+i|n<<i|r,Qi=a+e}else Zi=1<<a|n<<i|r,Qi=e}function ta(e){e.return!==null&&($i(e,1),ea(e,1,0))}function na(e){for(;e===Ki;)Ki=Wi[--Gi],Wi[Gi]=null,qi=Wi[--Gi],Wi[Gi]=null;for(;e===Xi;)Xi=Ji[--Yi],Ji[Yi]=null,Qi=Ji[--Yi],Ji[Yi]=null,Zi=Ji[--Yi],Ji[Yi]=null}function ra(e,t){Ji[Yi++]=Zi,Ji[Yi++]=Qi,Ji[Yi++]=Xi,Zi=t.id,Qi=t.overflow,Xi=e}var ia=null,aa=null,I=!1,oa=null,sa=!1,ca=Error(i(519));function la(e){throw ga(Ui(Error(i(418,1<arguments.length&&arguments[1]!==void 0&&arguments[1]?`text`:`HTML`,``)),e)),ca}function ua(e){var t=e.stateNode,n=e.type,r=e.memoizedProps;switch(t[wt]=e,t[Tt]=r,n){case`dialog`:Q(`cancel`,t),Q(`close`,t);break;case`iframe`:case`object`:case`embed`:Q(`load`,t);break;case`video`:case`audio`:for(n=0;n<zf.length;n++)Q(zf[n],t);break;case`source`:Q(`error`,t);break;case`img`:case`image`:case`link`:Q(`error`,t),Q(`load`,t);break;case`details`:Q(`toggle`,t);break;case`input`:Q(`invalid`,t),sn(t,r.value,r.defaultValue,r.checked,r.defaultChecked,r.type,r.name,!0);break;case`select`:Q(`invalid`,t);break;case`textarea`:Q(`invalid`,t),dn(t,r.value,r.defaultValue,r.children)}n=r.children,typeof n!=`string`&&typeof n!=`number`&&typeof n!=`bigint`||t.textContent===``+n||!0===r.suppressHydrationWarning||ep(t.textContent,n)?(r.popover!=null&&(Q(`beforetoggle`,t),Q(`toggle`,t)),r.onScroll!=null&&Q(`scroll`,t),r.onScrollEnd!=null&&Q(`scrollend`,t),r.onClick!=null&&(t.onclick=bn),t=!0):t=!1,t||la(e,!0)}function da(e){for(ia=e.return;ia;)switch(ia.tag){case 5:case 31:case 13:sa=!1;return;case 27:case 3:sa=!0;return;default:ia=ia.return}}function fa(e){if(e!==ia)return!1;if(!I)return da(e),I=!0,!1;var t=e.tag,n;if((n=t!==3&&t!==27)&&((n=t===5)&&(n=e.type,n=!(n!==`form`&&n!==`button`)||pp(e.type,e.memoizedProps)),n=!n),n&&aa&&la(e),da(e),t===13){if(e=e.memoizedState,e=e===null?null:e.dehydrated,!e)throw Error(i(317));aa=dm(e)}else if(t===31){if(e=e.memoizedState,e=e===null?null:e.dehydrated,!e)throw Error(i(317));aa=dm(e)}else t===27?(t=aa,Sp(e.type)?(e=um,um=null,aa=e):aa=t):aa=ia?lm(e.stateNode.nextSibling):null;return!0}function pa(){aa=ia=null,I=!1}function ma(){var e=oa;return e!==null&&(pd===null?pd=e:pd.push.apply(pd,e),oa=null),e}function ga(e){oa===null?oa=[e]:oa.push(e)}var va=be(null),ba=null,xa=null;function L(e,t,n){N(va,t._currentValue),t._currentValue=n}function Sa(e){e._currentValue=va.current,xe(va)}function Ca(e,t,n){for(;e!==null;){var r=e.alternate;if((e.childLanes&t)===t?r!==null&&(r.childLanes&t)!==t&&(r.childLanes|=t):(e.childLanes|=t,r!==null&&(r.childLanes|=t)),e===n)break;e=e.return}}function wa(e,t,n,r){var a=e.child;for(a!==null&&(a.return=e);a!==null;){var o=a.dependencies;if(o!==null){var s=a.child;o=o.firstContext;a:for(;o!==null;){var c=o;o=a;for(var l=0;l<t.length;l++)if(c.context===t[l]){o.lanes|=n,c=o.alternate,c!==null&&(c.lanes|=n),Ca(o.return,n,e),r||(s=null);break a}o=c.next}}else if(a.tag===18){if(s=a.return,s===null)throw Error(i(341));s.lanes|=n,o=s.alternate,o!==null&&(o.lanes|=n),Ca(s,n,e),s=null}else a.tag===13&&a.memoizedState!==null&&a.memoizedState.dehydrated===null?(a.lanes|=n,s=a.alternate,s!==null&&(s.lanes|=n),Ca(a.return,n,e),s=a.child,s=s===null?null:s.sibling):s=a.child;if(s!==null)s.return=a;else for(s=a;s!==null;){if(s===e){s=null;break}if(a=s.sibling,a!==null){a.return=s.return,s=a;break}s=s.return}a=s}}function Ta(e,t,n,r){e=null;for(var a=t,o=!1;a!==null;){if(!o){if(a.flags&524288)o=!0;else if(a.flags&262144)break}if(a.tag===10){var s=a.alternate;if(s===null)throw Error(i(387));if(s=s.memoizedProps,s!==null){var c=a.type;Ur(a.pendingProps.value,s.value)||(e===null?e=[c]:e.push(c))}}else if(a===Te.current){if(s=a.alternate,s===null)throw Error(i(387));s.memoizedState.memoizedState!==a.memoizedState.memoizedState&&(e===null?e=[sh]:e.push(sh))}a=a.return}return e!==null&&wa(t,e,n,r),t.flags|=262144,e!==null}function Ea(e){for(e=e.firstContext;e!==null;){if(!Ur(e.context._currentValue,e.memoizedValue))return!0;e=e.next}return!1}function Da(e){ba=e,xa=null,e=e.dependencies,e!==null&&(e.firstContext=null)}function R(e){return ka(ba,e)}function Oa(e,t){return ba===null&&Da(e),ka(e,t)}function ka(e,t){var n=t._currentValue;if(t={context:t,memoizedValue:n,next:null},xa===null){if(e===null)throw Error(i(308));xa=t,e.dependencies={lanes:0,firstContext:t},e.flags|=524288}else xa=xa.next=t;return n}var z=typeof AbortController<`u`?AbortController:function(){var e=[],t=this.signal={aborted:!1,addEventListener:function(t,n){e.push(n)}};this.abort=function(){t.aborted=!0,e.forEach(function(e){return e()})}},Aa=t.unstable_scheduleCallback,ja=t.unstable_NormalPriority,Ma={$$typeof:k,Consumer:null,Provider:null,_currentValue:null,_currentValue2:null,_threadCount:0};function Na(){return{controller:new z,data:new Map,refCount:0}}function Pa(e){e.refCount--,e.refCount===0&&Aa(ja,function(){e.controller.abort()})}function Fa(e,t){if(e.pendingLanes&4194048){var n=e.transitionTypes;for(n===null&&(n=e.transitionTypes=[]),e=0;e<t.length;e++){var r=t[e];n.indexOf(r)===-1&&n.push(r)}}}var Ia=null;function La(e){var t=e.transitionTypes;return e.transitionTypes=null,t}var Ra=null,za=0,Ba=0,Va=null;function Ha(e,t){if(Ra===null){var n=Ra=[];za=0,Ba=Pf(),Va={status:`pending`,value:void 0,then:function(e){n.push(e)}}}return za++,t.then(Ua,Ua),t}function Ua(){if(--za===0&&(Ia=null,Ra!==null)){Va!==null&&(Va.status=`fulfilled`);var e=Ra;Ra=null,Ba=0,Va=null;for(var t=0;t<e.length;t++)(0,e[t])()}}function Wa(e,t){var n=[],r={status:`pending`,value:null,reason:null,then:function(e){n.push(e)}};return e.then(function(){r.status=`fulfilled`,r.value=t;for(var e=0;e<n.length;e++)(0,n[e])(t)},function(e){for(r.status=`rejected`,r.reason=e,e=0;e<n.length;e++)(0,n[e])(void 0)}),r}var Ga=j.S;j.S=function(e,t){if(gd=He(),typeof t==`object`&&t&&typeof t.then==`function`&&Ha(e,t),Ia!==null)for(var n=bf;n!==null;)Fa(n,Ia),n=n.next;if(n=e.types,n!==null){for(var r=bf;r!==null;)Fa(r,n),r=r.next;if(Ba!==0){r=Ia,r===null&&(r=Ia=[]);for(var i=0;i<n.length;i++){var a=n[i];r.indexOf(a)===-1&&r.push(a)}}}Ga!==null&&Ga(e,t)};var Ka=be(null);function qa(){var e=Ka.current;return e===null?ed.pooledCache:e}function Ja(e,t){t===null?N(Ka,Ka.current):N(Ka,t.pool)}function Ya(){var e=qa();return e===null?null:{parent:Ma._currentValue,pool:e}}var Xa=Error(i(460)),Za=Error(i(474)),Qa=Error(i(542)),$a={then:function(){}};function eo(e){return e=e.status,e===`fulfilled`||e===`rejected`}function to(e,t,n){switch(n=e[n],n===void 0?e.push(t):n!==t&&(t.then(bn,bn),t=n),t.status){case`fulfilled`:return t.value;case`rejected`:throw e=t.reason,ao(e),e===void 0&&!(`reason`in t)?Error(i(600)):e;default:if(typeof t.status==`string`)t.then(bn,bn);else{if(e=ed,e!==null&&100<e.shellSuspendCounter)throw Error(i(482));e=t,e.status=`pending`,e.then(function(e){if(t.status===`pending`){var n=t;n.status=`fulfilled`,n.value=e}},function(e){if(t.status===`pending`){var n=t;n.status=`rejected`,n.reason=e}})}switch(t.status){case`fulfilled`:return t.value;case`rejected`:throw e=t.reason,ao(e),e}throw ro=t,Xa}}function no(e){try{var t=e._init;return t(e._payload)}catch(e){throw typeof e==`object`&&e&&typeof e.then==`function`?(ro=e,Xa):e}}var ro=null;function io(){if(ro===null)throw Error(i(459));var e=ro;return ro=null,e}function ao(e){if(e===Xa||e===Qa)throw Error(i(483))}var oo=null,so=0;function co(e){var t=so;return so+=1,oo===null&&(oo=[]),to(oo,e,t)}function lo(e,t){t=t.props.ref,e.ref=t===void 0?null:t}function uo(e,t){throw t.$$typeof===T?Error(i(525)):(e=Object.prototype.toString.call(t),Error(i(31,e===`[object Object]`?`object with keys {`+Object.keys(t).join(`, `)+`}`:e)))}function fo(e){function t(t,n){if(e){var r=t.deletions;r===null?(t.deletions=[n],t.flags|=16):r.push(n)}}function n(n,r){if(!e)return null;for(;r!==null;)t(n,r),r=r.sibling;return null}function r(e){for(var t=new Map;e!==null;)e.key===null?t.set(e.index,e):t.set(e.key,e),e=e.sibling;return t}function a(e,t){return e=Fi(e,t),e.index=0,e.sibling=null,e}function o(t,n,r){return t.index=r,e?(r=t.alternate,r===null?(t.flags|=134217730,n):(r=r.index,r<n?(t.flags|=2,n):r)):(t.flags|=1048576,n)}function s(t){return e&&t.alternate===null&&(t.flags|=134217730),t}function c(e,t,n,r){return t===null||t.tag!==6?(t=zi(n,e.mode,r),t.return=e,t):(t=a(t,n),t.return=e,t)}function l(e,t,n,r){var i=n.type;return i===O?(e=d(e,t,n.props.children,r,n.key),lo(e,n),e):t!==null&&(t.elementType===i||typeof i==`object`&&i&&i.$$typeof===se&&no(i)===t.type)?(t=a(t,n.props),lo(t,n),t.return=e,t):(t=Li(n.type,n.key,n.props,null,e.mode,r),lo(t,n),t.return=e,t)}function u(e,t,n,r){return t===null||t.tag!==4||t.stateNode.containerInfo!==n.containerInfo||t.stateNode.implementation!==n.implementation?(t=Vi(n,e.mode,r),t.return=e,t):(t=a(t,n.children||[]),t.return=e,t)}function d(e,t,n,r,i){return t===null||t.tag!==7?(t=Ri(n,e.mode,r,i),t.return=e,t):(t=a(t,n),t.return=e,t)}function f(e,t,n){if(typeof t==`string`&&t!==``||typeof t==`number`||typeof t==`bigint`)return t=zi(``+t,e.mode,n),t.return=e,t;if(typeof t==`object`&&t){switch(t.$$typeof){case E:return n=Li(t.type,t.key,t.props,null,e.mode,n),lo(n,t),n.return=e,n;case D:return t=Vi(t,e.mode,n),t.return=e,t;case se:return t=no(t),f(e,t,n)}if(A(t)||me(t))return t=Ri(t,e.mode,n,null),t.return=e,t;if(typeof t.then==`function`)return f(e,co(t),n);if(t.$$typeof===k)return f(e,Oa(e,t),n);uo(e,t)}return null}function p(e,t,n,r){var i=t===null?null:t.key;if(typeof n==`string`&&n!==``||typeof n==`number`||typeof n==`bigint`)return i===null?c(e,t,``+n,r):null;if(typeof n==`object`&&n){switch(n.$$typeof){case E:return n.key===i?l(e,t,n,r):null;case D:return n.key===i?u(e,t,n,r):null;case se:return n=no(n),p(e,t,n,r)}if(A(n)||me(n))return i===null?d(e,t,n,r,null):null;if(typeof n.then==`function`)return p(e,t,co(n),r);if(n.$$typeof===k)return p(e,t,Oa(e,n),r);uo(e,n)}return null}function m(e,t,n,r,i){if(typeof r==`string`&&r!==``||typeof r==`number`||typeof r==`bigint`)return e=e.get(n)||null,c(t,e,``+r,i);if(typeof r==`object`&&r){switch(r.$$typeof){case E:return e=e.get(r.key===null?n:r.key)||null,l(t,e,r,i);case D:return e=e.get(r.key===null?n:r.key)||null,u(t,e,r,i);case se:return r=no(r),m(e,t,n,r,i)}if(A(r)||me(r))return e=e.get(n)||null,d(t,e,r,i,null);if(typeof r.then==`function`)return m(e,t,n,co(r),i);if(r.$$typeof===k)return m(e,t,n,Oa(t,r),i);uo(t,r)}return null}function h(i,a,s,c){for(var l=null,u=null,d=a,h=a=0,g=null;d!==null&&h<s.length;h++){d.index>h?(g=d,d=null):g=d.sibling;var _=p(i,d,s[h],c);if(_===null){d===null&&(d=g);break}e&&d&&_.alternate===null&&t(i,d),a=o(_,a,h),u===null?l=_:u.sibling=_,u=_,d=g}if(h===s.length)return n(i,d),I&&$i(i,h),l;if(d===null){for(;h<s.length;h++)d=f(i,s[h],c),d!==null&&(a=o(d,a,h),u===null?l=d:u.sibling=d,u=d);return I&&$i(i,h),l}for(d=r(d);h<s.length;h++)g=m(d,i,h,s[h],c),g!==null&&(e&&(_=g.alternate,_!==null&&d.delete(_.key===null?h:_.key)),a=o(g,a,h),u===null?l=g:u.sibling=g,u=g);return e&&d.forEach(function(e){return t(i,e)}),I&&$i(i,h),l}function g(a,s,c,l){if(c==null)throw Error(i(151));for(var u=null,d=null,h=s,g=s=0,_=null,v=c.next();h!==null&&!v.done;g++,v=c.next()){h.index>g?(_=h,h=null):_=h.sibling;var y=p(a,h,v.value,l);if(y===null){h===null&&(h=_);break}e&&h&&y.alternate===null&&t(a,h),s=o(y,s,g),d===null?u=y:d.sibling=y,d=y,h=_}if(v.done)return n(a,h),I&&$i(a,g),u;if(h===null){for(;!v.done;g++,v=c.next())v=f(a,v.value,l),v!==null&&(s=o(v,s,g),d===null?u=v:d.sibling=v,d=v);return I&&$i(a,g),u}for(h=r(h);!v.done;g++,v=c.next())v=m(h,a,g,v.value,l),v!==null&&(e&&(_=v.alternate,_!==null&&h.delete(_.key===null?g:_.key)),s=o(v,s,g),d===null?u=v:d.sibling=v,d=v);return e&&h.forEach(function(e){return t(a,e)}),I&&$i(a,g),u}function _(e,r,o,c){if(typeof o==`object`&&o&&o.type===O&&o.key===null&&o.props.ref===void 0&&(o=o.props.children),typeof o==`object`&&o){switch(o.$$typeof){case E:a:{for(var l=o.key;r!==null;){if(r.key===l){if(l=o.type,l===O){if(r.tag===7){n(e,r.sibling),c=a(r,o.props.children),lo(c,o),c.return=e,e=c;break a}}else if(r.elementType===l||typeof l==`object`&&l&&l.$$typeof===se&&no(l)===r.type){n(e,r.sibling),c=a(r,o.props),lo(c,o),c.return=e,e=c;break a}n(e,r);break}else t(e,r);r=r.sibling}o.type===O?(c=Ri(o.props.children,e.mode,c,o.key),lo(c,o),c.return=e,e=c):(c=Li(o.type,o.key,o.props,null,e.mode,c),lo(c,o),c.return=e,e=c)}return s(e);case D:a:{for(l=o.key;r!==null;){if(r.key===l)if(r.tag===4&&r.stateNode.containerInfo===o.containerInfo&&r.stateNode.implementation===o.implementation){n(e,r.sibling),c=a(r,o.children||[]),c.return=e,e=c;break a}else{n(e,r);break}else t(e,r);r=r.sibling}c=Vi(o,e.mode,c),c.return=e,e=c}return s(e);case se:return o=no(o),_(e,r,o,c)}if(A(o))return h(e,r,o,c);if(me(o)){if(l=me(o),typeof l!=`function`)throw Error(i(150));return o=l.call(o),g(e,r,o,c)}if(typeof o.then==`function`)return _(e,r,co(o),c);if(o.$$typeof===k)return _(e,r,Oa(e,o),c);uo(e,o)}return typeof o==`string`&&o!==``||typeof o==`number`||typeof o==`bigint`?(o=``+o,r!==null&&r.tag===6?(n(e,r.sibling),c=a(r,o),c.return=e,e=c):(n(e,r),c=zi(o,e.mode,c),c.return=e,e=c),s(e)):n(e,r)}return function(e,t,n,r){try{so=0;var i=_(e,t,n,r);return oo=null,i}catch(t){if(t===Xa||t===Qa)throw t;var a=Ni(29,t,null,e.mode);return a.lanes=r,a.return=e,a}}}var po=fo(!0),mo=fo(!1),ho=!1;function go(e){e.updateQueue={baseState:e.memoizedState,firstBaseUpdate:null,lastBaseUpdate:null,shared:{pending:null,lanes:0,hiddenCallbacks:null},callbacks:null}}function _o(e,t){e=e.updateQueue,t.updateQueue===e&&(t.updateQueue={baseState:e.baseState,firstBaseUpdate:e.firstBaseUpdate,lastBaseUpdate:e.lastBaseUpdate,shared:e.shared,callbacks:null})}function vo(e){return{lane:e,tag:0,payload:null,callback:null,next:null}}function yo(e,t,n){var r=e.updateQueue;if(r===null)return null;if(r=r.shared,K&2){var i=r.pending;return i===null?t.next=t:(t.next=i.next,i.next=t),r.pending=t,t=F(e),Ai(e,null,n),t}return Di(e,r,t,n),F(e)}function bo(e,t,n){if(t=t.updateQueue,t!==null&&(t=t.shared,n&4194048)){var r=t.lanes;r&=e.pendingLanes,n|=r,t.lanes=n,_t(e,n)}}function xo(e,t){var n=e.updateQueue,r=e.alternate;if(r!==null&&(r=r.updateQueue,n===r)){var i=null,a=null;if(n=n.firstBaseUpdate,n!==null){do{var o={lane:n.lane,tag:n.tag,payload:n.payload,callback:null,next:null};a===null?i=a=o:a=a.next=o,n=n.next}while(n!==null);a===null?i=a=t:a=a.next=t}else i=a=t;n={baseState:r.baseState,firstBaseUpdate:i,lastBaseUpdate:a,shared:r.shared,callbacks:r.callbacks},e.updateQueue=n;return}e=n.lastBaseUpdate,e===null?n.firstBaseUpdate=t:e.next=t,n.lastBaseUpdate=t}var So=!1;function Co(){if(So){var e=Va;if(e!==null)throw e}}function wo(e,t,n,r){So=!1;var i=e.updateQueue;ho=!1;var a=i.firstBaseUpdate,o=i.lastBaseUpdate,s=i.shared.pending;if(s!==null){i.shared.pending=null;var c=s,l=c.next;c.next=null,o===null?a=l:o.next=l,o=c;var u=e.alternate;u!==null&&(u=u.updateQueue,s=u.lastBaseUpdate,s!==o&&(s===null?u.firstBaseUpdate=l:s.next=l,u.lastBaseUpdate=c))}if(a!==null){var d=i.baseState;o=0,u=l=c=null,s=a;do{var f=s.lane&-536870913,p=f!==s.lane;if(p?(J&f)===f:(r&f)===f){f!==0&&f===Ba&&(So=!0),u!==null&&(u=u.next={lane:0,tag:s.tag,payload:s.payload,callback:null,next:null});a:{var m=e,h=s;f=t;var g=n;switch(h.tag){case 1:if(m=h.payload,typeof m==`function`){d=m.call(g,d,f);break a}d=m;break a;case 3:m.flags=m.flags&-65537|128;case 0:if(m=h.payload,f=typeof m==`function`?m.call(g,d,f):m,f==null)break a;d=w({},d,f);break a;case 2:ho=!0}}f=s.callback,f!==null&&(e.flags|=64,p&&(e.flags|=8192),p=i.callbacks,p===null?i.callbacks=[f]:p.push(f))}else p={lane:f,tag:s.tag,payload:s.payload,callback:s.callback,next:null},u===null?(l=u=p,c=d):u=u.next=p,o|=f;if(s=s.next,s===null){if(s=i.shared.pending,s===null)break;p=s,s=p.next,p.next=null,i.lastBaseUpdate=p,i.shared.pending=null}}while(1);u===null&&(c=d),i.baseState=c,i.firstBaseUpdate=l,i.lastBaseUpdate=u,a===null&&(i.shared.lanes=0),sd|=o,e.lanes=o,e.memoizedState=d}}function To(e,t){if(typeof e!=`function`)throw Error(i(191,e));e.call(t)}function Eo(e,t){var n=e.callbacks;if(n!==null)for(e.callbacks=null,e=0;e<n.length;e++)To(n[e],t)}var Do=be(null),Oo=be(0);function ko(e,t){e=ad,N(Oo,e),N(Do,t),ad=e|t.baseLanes}function Ao(){N(Oo,ad),N(Do,Do.current)}function jo(){ad=Oo.current,xe(Do),xe(Oo)}var Mo=be(null),No=null;function Po(e){var t=e.alternate;N(B,B.current&1),N(Mo,e),No===null&&(t===null||Do.current!==null||t.memoizedState!==null)&&(No=e)}function Fo(e){N(B,B.current),N(Mo,e),No===null&&(No=e)}function Io(e){e.tag===22?(N(B,B.current),N(Mo,e),No===null&&(No=e)):Lo()}function Lo(){N(B,B.current),N(Mo,Mo.current)}function Ro(e){xe(Mo),No===e&&(No=null),xe(B)}var B=be(0);function zo(e,t){N(Mo,Mo.current),N(B,t)}function Bo(e){xe(B),xe(Mo),No===e&&(No=null)}function Vo(e){for(var t=e;t!==null;){if(t.tag===13){var n=t.memoizedState;if(n!==null&&(n=n.dehydrated,n===null||om(n)||sm(n)))return t}else if(t.tag===19&&t.memoizedProps.revealOrder!==`independent`){if(t.flags&128)return t}else if(t.child!==null){t.child.return=t,t=t.child;continue}if(t===e)break;for(;t.sibling===null;){if(t.return===null||t.return===e)return null;t=t.return}t.sibling.return=t.return,t=t.sibling}return null}var Ho=0,V=null,H=null,Uo=null,Wo=!1,Go=!1,Ko=!1,qo=0,Jo=0,Yo=null,Xo=0;function Zo(){throw Error(i(321))}function Qo(e,t){if(t===null)return!1;for(var n=0;n<t.length&&n<e.length;n++)if(!Ur(e[n],t[n]))return!1;return!0}function $o(e,t,n,r,i,a){return Ho=a,V=t,t.memoizedState=null,t.updateQueue=null,t.lanes=0,j.H=e===null||e.memoizedState===null?hc:gc,Ko=!1,a=n(r,i),Ko=!1,Go&&(a=ts(t,n,r,i)),es(e),a}function es(e){j.H=mc;var t=H!==null&&H.next!==null;if(Ho=0,Uo=H=V=null,Wo=!1,Jo=0,Yo=null,t)throw Error(i(300));e===null||Nc||(e=e.dependencies,e!==null&&Ea(e)&&(Nc=!0))}function ts(e,t,n,r){V=e;var a=0;do{if(Go&&(Yo=null),Jo=0,Go=!1,25<=a)throw Error(i(301));if(a+=1,Uo=H=null,e.updateQueue!=null){var o=e.updateQueue;o.lastEffect=null,o.events=null,o.stores=null,o.memoCache!=null&&(o.memoCache.index=0)}j.H=_c,o=t(n,r)}while(Go);return o}function ns(){var e=j.H,t=e.useState()[0];return t=typeof t.then==`function`?ls(t):t,e=e.useState()[0],(H===null?null:H.memoizedState)!==e&&(V.flags|=1024),t}function rs(){var e=qo!==0;return qo=0,e}function is(e,t,n){t.updateQueue=e.updateQueue,t.flags&=-2053,e.lanes&=~n}function as(e){if(Wo){for(e=e.memoizedState;e!==null;){var t=e.queue;t!==null&&(t.pending=null),e=e.next}Wo=!1}Ho=0,Uo=H=V=null,Go=!1,Jo=qo=0,Yo=null}function os(){var e={memoizedState:null,baseState:null,baseQueue:null,queue:null,next:null};return Uo===null?V.memoizedState=Uo=e:Uo=Uo.next=e,Uo}function ss(){if(H===null){var e=V.alternate;e=e===null?null:e.memoizedState}else e=H.next;var t=Uo===null?V.memoizedState:Uo.next;if(t!==null)Uo=t,H=e;else{if(e===null)throw V.alternate===null?Error(i(467)):Error(i(310));H=e,e={memoizedState:H.memoizedState,baseState:H.baseState,baseQueue:H.baseQueue,queue:H.queue,next:null},Uo===null?V.memoizedState=Uo=e:Uo=Uo.next=e}return Uo}function cs(){return{lastEffect:null,events:null,stores:null,memoCache:null}}function ls(e){var t=Jo;return Jo+=1,Yo===null&&(Yo=[]),e=to(Yo,e,t),t=V,(Uo===null?t.memoizedState:Uo.next)===null&&(t=t.alternate,j.H=t===null||t.memoizedState===null?hc:gc),e}function us(e){if(typeof e==`object`&&e){if(typeof e.then==`function`)return ls(e);if(e.$$typeof===fe)return;if(e.$$typeof===k)return R(e)}throw Error(i(438,String(e)))}function ds(e){var t=null,n=V.updateQueue;if(n!==null&&(t=n.memoCache),t==null){var r=V.alternate;r!==null&&(r=r.updateQueue,r!==null&&(r=r.memoCache,r!=null&&(t={data:r.data.map(function(e){return e.slice()}),index:0})))}if(t??={data:[],index:0},n===null&&(n=cs(),V.updateQueue=n),n.memoCache=t,n=t.data[t.index],n===void 0)for(n=t.data[t.index]=Array(e),r=0;r<e;r++)n[r]=ue;return t.index++,n}function fs(e,t){return typeof t==`function`?t(e):t}function ps(e){return ms(ss(),H,e)}function ms(e,t,n){var r=e.queue;if(r===null)throw Error(i(311));r.lastRenderedReducer=n;var a=e.baseQueue,o=r.pending;if(o!==null){if(a!==null){var s=a.next;a.next=o.next,o.next=s}t.baseQueue=a=o,r.pending=null}if(o=e.baseState,a===null)e.memoizedState=o;else{t=a.next;var c=s=null,l=null,u=t,d=!1;do{var f=u.lane&-536870913;if(f===u.lane?(Ho&f)===f:(J&f)===f){var p=u.revertLane;if(p===0)l!==null&&(l=l.next={lane:0,revertLane:0,gesture:null,action:u.action,hasEagerState:u.hasEagerState,eagerState:u.eagerState,next:null}),f===Ba&&(d=!0);else if((Ho&p)===p){u=u.next,p===Ba&&(d=!0);continue}else f={lane:0,revertLane:u.revertLane,gesture:null,action:u.action,hasEagerState:u.hasEagerState,eagerState:u.eagerState,next:null},l===null?(c=l=f,s=o):l=l.next=f,V.lanes|=p,sd|=p;f=u.action,Ko&&n(o,f),o=u.hasEagerState?u.eagerState:n(o,f)}else p={lane:f,revertLane:u.revertLane,gesture:u.gesture,action:u.action,hasEagerState:u.hasEagerState,eagerState:u.eagerState,next:null},l===null?(c=l=p,s=o):l=l.next=p,V.lanes|=f,sd|=f;u=u.next}while(u!==null&&u!==t);if(l===null?s=o:l.next=c,!Ur(o,e.memoizedState)&&(Nc=!0,d&&(n=Va,n!==null)))throw n;e.memoizedState=o,e.baseState=s,e.baseQueue=l,r.lastRenderedState=o}return a===null&&(r.lanes=0),[e.memoizedState,r.dispatch]}function hs(e){var t=ss(),n=t.queue;if(n===null)throw Error(i(311));n.lastRenderedReducer=e;var r=n.dispatch,a=n.pending,o=t.memoizedState;if(a!==null){n.pending=null;var s=a=a.next;do o=e(o,s.action),s=s.next;while(s!==a);Ur(o,t.memoizedState)||(Nc=!0),t.memoizedState=o,t.baseQueue===null&&(t.baseState=o),n.lastRenderedState=o}return[o,r]}function gs(e,t,n){var r=V,a=ss(),o=I;if(o){if(n===void 0)throw Error(i(407));n=n()}else n=t();var s=!Ur((H||a).memoizedState,n);if(s&&(a.memoizedState=n,Nc=!0),a=a.queue,Vs(ys.bind(null,r,a,e),[e]),e=a.getSnapshot!==t||s||Uo!==null&&(Uo.memoizedState.tag&1)!=0,Is(e?9:8,{destroy:void 0},vs.bind(null,r,a,n,t),null),e){if(r.flags|=2048,ed===null)throw Error(i(349));o||Ho&127||_s(r,t,n)}return n}function _s(e,t,n){e.flags|=16384,e={getSnapshot:t,value:n},t=V.updateQueue,t===null?(t=cs(),V.updateQueue=t,t.stores=[e]):(n=t.stores,n===null?t.stores=[e]:n.push(e))}function vs(e,t,n,r){t.value=n,t.getSnapshot=r,bs(t)&&xs(e)}function ys(e,t,n){return n(function(){bs(t)&&xs(e)})}function bs(e){var t=e.getSnapshot;e=e.value;try{var n=t();return!Ur(e,n)}catch{return!0}}function xs(e){var t=ki(e,2);t!==null&&Fd(t,e,2)}function Ss(e){var t=os();if(typeof e==`function`){var n=e;if(e=n(),Ko){$e(!0);try{n()}finally{$e(!1)}}}return t.memoizedState=t.baseState=e,t.queue={pending:null,lanes:0,dispatch:null,lastRenderedReducer:fs,lastRenderedState:e},t}function Cs(e,t,n,r){return e.baseState=n,ms(e,H,typeof r==`function`?r:fs)}function ws(e,t,n,r,a){if(dc(e))throw Error(i(485));if(e=t.action,e!==null){var o={payload:a,action:e,next:null,isTransition:!0,status:`pending`,value:null,reason:null,listeners:[],then:function(e){o.listeners.push(e)}};j.T===null?o.isTransition=!1:n(!0),r(o),n=t.pending,n===null?(o.next=t.pending=o,Ts(t,o)):(o.next=n.next,t.pending=n.next=o)}}function Ts(e,t){var n=t.action,r=t.payload,i=e.state;if(t.isTransition){var a=j.T,o={};o.types=a===null?null:a.types,j.T=o;try{var s=n(i,r),c=j.S;c!==null&&c(o,s),Es(e,t,s)}catch(n){Os(e,t,n)}finally{a!==null&&o.types!==null&&(a.types=o.types),j.T=a}}else try{a=n(i,r),Es(e,t,a)}catch(n){Os(e,t,n)}}function Es(e,t,n){typeof n==`object`&&n&&typeof n.then==`function`?n.then(function(n){Ds(e,t,n)},function(n){return Os(e,t,n)}):Ds(e,t,n)}function Ds(e,t,n){t.status=`fulfilled`,t.value=n,ks(t),e.state=n,t=e.pending,t!==null&&(n=t.next,n===t?e.pending=null:(n=n.next,t.next=n,Ts(e,n)))}function Os(e,t,n){var r=e.pending;if(e.pending=null,r!==null){r=r.next;do t.status=`rejected`,t.reason=n,ks(t),t=t.next;while(t!==r)}e.action=null}function ks(e){e=e.listeners;for(var t=0;t<e.length;t++)(0,e[t])()}function As(e,t){return t}function js(e,t){if(I){var n=ed.formState;if(n!==null){a:{var r=V;if(I){if(aa){b:{for(var i=aa,a=sa;i.nodeType!==8;){if(!a){i=null;break b}if(i=lm(i.nextSibling),i===null){i=null;break b}}a=i.data,i=a===`F!`||a===`F`?i:null}if(i){aa=lm(i.nextSibling),r=i.data===`F!`;break a}}la(r)}r=!1}r&&(t=n[0])}}return n=os(),n.memoizedState=n.baseState=t,r={pending:null,lanes:0,dispatch:null,lastRenderedReducer:As,lastRenderedState:t},n.queue=r,n=cc.bind(null,V,r),r.dispatch=n,r=Ss(!1),a=uc.bind(null,V,!1,r.queue),r=os(),i={state:t,dispatch:null,action:e,pending:null},r.queue=i,n=ws.bind(null,V,i,a,n),i.dispatch=n,r.memoizedState=e,[t,n,!1]}function Ms(e){return Ns(ss(),H,e)}function Ns(e,t,n){if(t=ms(e,t,As)[0],e=ps(fs)[0],typeof t==`object`&&t&&typeof t.then==`function`)try{var r=ls(t)}catch(e){throw e===Xa?Qa:e}else r=t;t=ss();var i=t.queue,a=i.dispatch;return n!==t.memoizedState&&(V.flags|=2048,Is(9,{destroy:void 0},Ps.bind(null,i,n),null)),[r,a,e]}function Ps(e,t){e.action=t}function Fs(e){var t=ss(),n=H;if(n!==null)return Ns(t,n,e);ss(),t=t.memoizedState,n=ss();var r=n.queue.dispatch;return n.memoizedState=e,[t,r,!1]}function Is(e,t,n,r){return e={tag:e,create:n,deps:r,inst:t,next:null},t=V.updateQueue,t===null&&(t=cs(),V.updateQueue=t),n=t.lastEffect,n===null?t.lastEffect=e.next=e:(r=n.next,n.next=e,e.next=r,t.lastEffect=e),e}function Ls(){return ss().memoizedState}function Rs(e,t,n,r){var i=os();V.flags|=e,i.memoizedState=Is(1|t,{destroy:void 0},n,r===void 0?null:r)}function zs(e,t,n,r){var i=ss();r=r===void 0?null:r;var a=i.memoizedState.inst;H!==null&&r!==null&&Qo(r,H.memoizedState.deps)?i.memoizedState=Is(t,a,n,r):(V.flags|=e,i.memoizedState=Is(1|t,a,n,r))}function Bs(e,t){Rs(8390656,8,e,t)}function Vs(e,t){zs(2048,8,e,t)}function Hs(e){V.flags|=4;var t=V.updateQueue;if(t===null)t=cs(),V.updateQueue=t,t.events=[e];else{var n=t.events;n===null?t.events=[e]:n.push(e)}}function Us(e){var t=ss().memoizedState;return Hs({ref:t,nextImpl:e}),function(){if(K&2)throw Error(i(440));return t.impl.apply(void 0,arguments)}}function Ws(e,t){return zs(4,2,e,t)}function Gs(e,t){return zs(4,4,e,t)}function Ks(e,t){if(typeof t==`function`){e=e();var n=t(e);return function(){typeof n==`function`?n():t(null)}}if(t!=null)return e=e(),t.current=e,function(){t.current=null}}function qs(e,t,n){n=n==null?null:n.concat([e]),zs(4,4,Ks.bind(null,t,e),n)}function Js(){}function Ys(e,t){var n=ss();t=t===void 0?null:t;var r=n.memoizedState;return t!==null&&Qo(t,r[1])?r[0]:(n.memoizedState=[e,t],e)}function Xs(e,t){var n=ss();t=t===void 0?null:t;var r=n.memoizedState;if(t!==null&&Qo(t,r[1]))return r[0];if(r=e(),Ko){$e(!0);try{e()}finally{$e(!1)}}return n.memoizedState=[r,t],r}function Zs(e,t,n){return n===void 0||Ho&1073741824&&!(J&261930)?e.memoizedState=t:(e.memoizedState=n,e=Nd(),V.lanes|=e,sd|=e,n)}function Qs(e,t,n,r){return Ur(n,t)?n:Do.current===null?!(Ho&106)||Ho&1073741824&&!(J&261930)?(Nc=!0,e.memoizedState=n):(e=Nd(),V.lanes|=e,sd|=e,t):(e=Zs(e,n,r),Ur(e,t)||(Nc=!0),e)}function $s(e,t,n,r,i){var a=M.p;M.p=a!==0&&8>a?a:8;var o=j.T,s={};s.types=o===null?null:o.types,j.T=s,uc(e,!1,t,n);try{var c=i(),l=j.S;l!==null&&l(s,c),typeof c==`object`&&c&&typeof c.then==`function`?lc(e,t,Wa(c,r),Md(e)):lc(e,t,r,Md(e))}catch(n){lc(e,t,{then:function(){},status:`rejected`,reason:n},Md())}finally{M.p=a,o!==null&&s.types!==null&&(o.types=s.types),j.T=o}}function ec(){}function U(e,t,n,r){if(e.tag!==5)throw Error(i(476));var a=tc(e).queue;$s(e,a,t,_e,n===null?ec:function(){return nc(e),n(r)})}function tc(e){var t=e.memoizedState;if(t!==null)return t;t={memoizedState:_e,baseState:_e,baseQueue:null,queue:{pending:null,lanes:0,dispatch:null,lastRenderedReducer:fs,lastRenderedState:_e},next:null};var n={};return t.next={memoizedState:n,baseState:n,baseQueue:null,queue:{pending:null,lanes:0,dispatch:null,lastRenderedReducer:fs,lastRenderedState:n},next:null},e.memoizedState=t,e=e.alternate,e!==null&&(e.memoizedState=t),t}function nc(e){var t=tc(e);t.next===null&&(t=e.alternate.memoizedState),lc(e,t.next.queue,{},Md())}function rc(){return R(sh)}function ic(){return ss().memoizedState}function ac(){return ss().memoizedState}function oc(e){for(var t=e.return;t!==null;){switch(t.tag){case 24:case 3:var n=Md();e=vo(n);var r=yo(t,e,n);r!==null&&(Fd(r,t,n),bo(r,t,n)),t={cache:Na()},e.payload=t;return}t=t.return}}function sc(e,t,n){var r=Md();n={lane:r,revertLane:0,gesture:null,action:n,hasEagerState:!1,eagerState:null,next:null},dc(e)?fc(t,n):(n=Oi(e,t,n,r),n!==null&&(Fd(n,e,r),pc(n,t,r)))}function cc(e,t,n){lc(e,t,n,Md())}function lc(e,t,n,r){var i={lane:r,revertLane:0,gesture:null,action:n,hasEagerState:!1,eagerState:null,next:null};if(dc(e))fc(t,i);else{var a=e.alternate;if(e.lanes===0&&(a===null||a.lanes===0)&&(a=t.lastRenderedReducer,a!==null))try{var o=t.lastRenderedState,s=a(o,n);if(i.hasEagerState=!0,i.eagerState=s,Ur(s,o))return Di(e,t,i,0),ed===null&&Ei(),!1}catch{}if(n=Oi(e,t,i,r),n!==null)return Fd(n,e,r),pc(n,t,r),!0}return!1}function uc(e,t,n,r){if(r={lane:2,revertLane:Pf(),gesture:null,action:r,hasEagerState:!1,eagerState:null,next:null},dc(e)){if(t)throw Error(i(479))}else t=Oi(e,n,r,2),t!==null&&Fd(t,e,2)}function dc(e){var t=e.alternate;return e===V||t!==null&&t===V}function fc(e,t){Go=Wo=!0;var n=e.pending;n===null?t.next=t:(t.next=n.next,n.next=t),e.pending=t}function pc(e,t,n){if(n&4194048){var r=t.lanes;r&=e.pendingLanes,n|=r,t.lanes=n,_t(e,n)}}var mc={readContext:R,use:us,useCallback:Zo,useContext:Zo,useEffect:Zo,useImperativeHandle:Zo,useLayoutEffect:Zo,useInsertionEffect:Zo,useMemo:Zo,useReducer:Zo,useRef:Zo,useState:Zo,useDebugValue:Zo,useDeferredValue:Zo,useTransition:Zo,useSyncExternalStore:Zo,useId:Zo,useHostTransitionStatus:Zo,useFormState:Zo,useActionState:Zo,useOptimistic:Zo,useMemoCache:Zo,useCacheRefresh:Zo,useEffectEvent:Zo},hc={readContext:R,use:us,useCallback:function(e,t){return os().memoizedState=[e,t===void 0?null:t],e},useContext:R,useEffect:Bs,useImperativeHandle:function(e,t,n){n=n==null?null:n.concat([e]),Rs(4194308,4,Ks.bind(null,t,e),n)},useLayoutEffect:function(e,t){return Rs(4194308,4,e,t)},useInsertionEffect:function(e,t){Rs(4,2,e,t)},useMemo:function(e,t){var n=os();t=t===void 0?null:t;var r=e();if(Ko){$e(!0);try{e()}finally{$e(!1)}}return n.memoizedState=[r,t],r},useReducer:function(e,t,n){var r=os();if(n!==void 0){var i=n(t);if(Ko){$e(!0);try{n(t)}finally{$e(!1)}}}else i=t;return r.memoizedState=r.baseState=i,e={pending:null,lanes:0,dispatch:null,lastRenderedReducer:e,lastRenderedState:i},r.queue=e,e=e.dispatch=sc.bind(null,V,e),[r.memoizedState,e]},useRef:function(e){var t=os();return e={current:e},t.memoizedState=e},useState:function(e){e=Ss(e);var t=e.queue,n=cc.bind(null,V,t);return t.dispatch=n,[e.memoizedState,n]},useDebugValue:Js,useDeferredValue:function(e,t){return Zs(os(),e,t)},useTransition:function(){var e=Ss(!1);return e=$s.bind(null,V,e.queue,!0,!1),os().memoizedState=e,[!1,e]},useSyncExternalStore:function(e,t,n){var r=V,a=os();if(I){if(n===void 0)throw Error(i(407));n=n()}else{if(n=t(),ed===null)throw Error(i(349));J&127||_s(r,t,n)}a.memoizedState=n;var o={value:n,getSnapshot:t};return a.queue=o,Bs(ys.bind(null,r,o,e),[e]),r.flags|=2048,Is(9,{destroy:void 0},vs.bind(null,r,o,n,t),null),n},useId:function(){var e=os(),t=ed.identifierPrefix;if(I){var n=Qi,r=Zi;n=(r&~(1<<32-et(r)-1)).toString(32)+n,t=`_`+t+`R_`+n,n=qo++,0<n&&(t+=`H`+n.toString(32)),t+=`_`}else n=Xo++,t=`_`+t+`r_`+n.toString(32)+`_`;return e.memoizedState=t},useHostTransitionStatus:rc,useFormState:js,useActionState:js,useOptimistic:function(e){var t=os();t.memoizedState=t.baseState=e;var n={pending:null,lanes:0,dispatch:null,lastRenderedReducer:null,lastRenderedState:null};return t.queue=n,t=uc.bind(null,V,!0,n),n.dispatch=t,[e,t]},useMemoCache:ds,useCacheRefresh:function(){return os().memoizedState=oc.bind(null,V)},useEffectEvent:function(e){var t=os(),n={impl:e};return t.memoizedState=n,function(){if(K&2)throw Error(i(440));return n.impl.apply(void 0,arguments)}}},gc={readContext:R,use:us,useCallback:Ys,useContext:R,useEffect:Vs,useImperativeHandle:qs,useInsertionEffect:Ws,useLayoutEffect:Gs,useMemo:Xs,useReducer:ps,useRef:Ls,useState:function(){return ps(fs)},useDebugValue:Js,useDeferredValue:function(e,t){return Qs(ss(),H.memoizedState,e,t)},useTransition:function(){var e=ps(fs)[0],t=ss().memoizedState;return[typeof e==`boolean`?e:ls(e),t]},useSyncExternalStore:gs,useId:ic,useHostTransitionStatus:rc,useFormState:Ms,useActionState:Ms,useOptimistic:function(e,t){return Cs(ss(),H,e,t)},useMemoCache:ds,useCacheRefresh:ac,useEffectEvent:Us},_c={readContext:R,use:us,useCallback:Ys,useContext:R,useEffect:Vs,useImperativeHandle:qs,useInsertionEffect:Ws,useLayoutEffect:Gs,useMemo:Xs,useReducer:hs,useRef:Ls,useState:function(){return hs(fs)},useDebugValue:Js,useDeferredValue:function(e,t){var n=ss();return H===null?Zs(n,e,t):Qs(n,H.memoizedState,e,t)},useTransition:function(){var e=hs(fs)[0],t=ss().memoizedState;return[typeof e==`boolean`?e:ls(e),t]},useSyncExternalStore:gs,useId:ic,useHostTransitionStatus:rc,useFormState:Fs,useActionState:Fs,useOptimistic:function(e,t){var n=ss();return H===null?(n.baseState=e,[e,n.queue.dispatch]):Cs(n,H,e,t)},useMemoCache:ds,useCacheRefresh:ac,useEffectEvent:Us};function vc(e,t,n,r){t=e.memoizedState,n=n(r,t),n=n==null?t:w({},t,n),e.memoizedState=n,e.lanes===0&&(e.updateQueue.baseState=n)}var yc={enqueueSetState:function(e,t,n){e=e._reactInternals;var r=Md(),i=vo(r);i.payload=t,n!=null&&(i.callback=n),t=yo(e,i,r),t!==null&&(Fd(t,e,r),bo(t,e,r))},enqueueReplaceState:function(e,t,n){e=e._reactInternals;var r=Md(),i=vo(r);i.tag=1,i.payload=t,n!=null&&(i.callback=n),t=yo(e,i,r),t!==null&&(Fd(t,e,r),bo(t,e,r))},enqueueForceUpdate:function(e,t){e=e._reactInternals;var n=Md(),r=vo(n);r.tag=2,t!=null&&(r.callback=t),t=yo(e,r,n),t!==null&&(Fd(t,e,n),bo(t,e,n))}};function bc(e,t,n,r,i,a,o){return e=e.stateNode,typeof e.shouldComponentUpdate==`function`?e.shouldComponentUpdate(r,a,o):t.prototype&&t.prototype.isPureReactComponent?!Wr(n,r)||!Wr(i,a):!0}function xc(e,t,n,r){e=t.state,typeof t.componentWillReceiveProps==`function`&&t.componentWillReceiveProps(n,r),typeof t.UNSAFE_componentWillReceiveProps==`function`&&t.UNSAFE_componentWillReceiveProps(n,r),t.state!==e&&yc.enqueueReplaceState(t,t.state,null)}function Sc(e,t){var n=t;if(`ref`in t)for(var r in n={},t)r!==`ref`&&(n[r]=t[r]);if(e=e.defaultProps)for(var i in n===t&&(n=w({},n)),e)n[i]===void 0&&(n[i]=e[i]);return n}function Cc(e){Si(e)}function wc(e){console.error(e)}function Tc(e){Si(e)}function Ec(e,t){try{var n=e.onUncaughtError;n(t.value,{componentStack:t.stack})}catch(e){setTimeout(function(){throw e})}}function Dc(e,t,n){try{var r=e.onCaughtError;r(n.value,{componentStack:n.stack,errorBoundary:t.tag===1?t.stateNode:null})}catch(e){setTimeout(function(){throw e})}}function Oc(e,t,n){return n=vo(n),n.tag=3,n.payload={element:null},n.callback=function(){Ec(e,t)},n}function kc(e){return e=vo(e),e.tag=3,e}function Ac(e,t,n,r){var i=n.type.getDerivedStateFromError;if(typeof i==`function`){var a=r.value;e.payload=function(){return i(a)},e.callback=function(){Dc(t,n,r)}}var o=n.stateNode;o!==null&&typeof o.componentDidCatch==`function`&&(e.callback=function(){Dc(t,n,r),typeof i!=`function`&&(yd===null?yd=new Set([this]):yd.add(this));var e=r.stack;this.componentDidCatch(r.value,{componentStack:e===null?``:e})})}function jc(e,t,n,r,a){if(n.flags|=32768,typeof r==`object`&&r&&typeof r.then==`function`){if(t=n.alternate,t!==null&&Ta(t,n,a,!0),n=Mo.current,n!==null){switch(n.tag){case 31:case 13:case 19:return No===null?qd():n.alternate===null&&od===0&&(od=3),n.flags&=-257,n.flags|=65536,n.lanes=a,r===$a?n.flags|=16384:(t=n.updateQueue,t===null?n.updateQueue=new Set([r]):t.add(r),mf(e,r,a)),!1;case 22:return n.flags|=65536,r===$a?n.flags|=16384:(t=n.updateQueue,t===null?(t={transitions:null,markerInstances:null,retryQueue:new Set([r])},n.updateQueue=t):(n=t.retryQueue,n===null?t.retryQueue=new Set([r]):n.add(r)),mf(e,r,a)),!1}throw Error(i(435,n.tag))}return mf(e,r,a),qd(),!1}if(I)return t=Mo.current,t===null?(r!==ca&&(t=Error(i(423),{cause:r}),ga(Ui(t,n))),e=e.current.alternate,e.flags|=65536,a&=-a,e.lanes|=a,r=Ui(r,n),a=Oc(e.stateNode,r,a),xo(e,a),od!==4&&(od=2)):(!(t.flags&65536)&&(t.flags|=256),t.flags|=65536,t.lanes=a,r!==ca&&(e=Error(i(422),{cause:r}),ga(Ui(e,n)))),!1;var o=Error(i(520),{cause:r});if(o=Ui(o,n),fd===null?fd=[o]:fd.push(o),od!==4&&(od=2),t===null)return!0;r=Ui(r,n),n=t;do{switch(n.tag){case 3:return n.flags|=65536,e=a&-a,n.lanes|=e,e=Oc(n.stateNode,r,e),xo(n,e),!1;case 1:if(t=n.type,o=n.stateNode,!(n.flags&128)&&(typeof t.getDerivedStateFromError==`function`||o!==null&&typeof o.componentDidCatch==`function`&&(yd===null||!yd.has(o))))return n.flags|=65536,a&=-a,n.lanes|=a,a=kc(a),Ac(a,e,n,r),xo(n,a),!1;break;case 22:if(n.memoizedState!==null)return n.flags|=65536,!1}n=n.return}while(n!==null);return!1}var Mc=Error(i(461)),Nc=!1;function Pc(e,t,n,r){t.child=e===null?mo(t,null,n,r):po(t,e.child,n,r)}function Fc(e,t,n,r,i){n=n.render;var a=t.ref;if(`ref`in r){var o={};for(var s in r)s!==`ref`&&(o[s]=r[s])}else o=r;return Da(t),r=$o(e,t,n,o,a,i),s=rs(),e!==null&&!Nc?(is(e,t,i),ll(e,t,i)):(I&&s&&ta(t),t.flags|=1,Pc(e,t,r,i),t.child)}function Ic(e,t,n,r,i){if(e===null){var a=n.type;return typeof a==`function`&&!Pi(a)&&a.defaultProps===void 0&&n.compare===null?(t.tag=15,t.type=a,Lc(e,t,a,r,i)):(e=Li(n.type,null,r,t,t.mode,i),e.ref=t.ref,e.return=t,t.child=e)}if(a=e.child,!ul(e,i)){var o=a.memoizedProps;if(n=n.compare,n=n===null?Wr:n,n(o,r)&&e.ref===t.ref)return ll(e,t,i)}return t.flags|=1,e=Fi(a,r),e.ref=t.ref,e.return=t,t.child=e}function Lc(e,t,n,r,i){if(e!==null){var a=e.memoizedProps;if(Wr(a,r)&&e.ref===t.ref)if(Nc=!1,t.pendingProps=r=a,ul(e,i))e.flags&131072&&(Nc=!0);else return t.lanes=e.lanes,ll(e,t,i)}return Gc(e,t,n,r,i)}function Rc(e,t,n,r){var i=r.children,a=e===null?null:e.memoizedState;if(e===null&&t.stateNode===null&&(t.stateNode={_visibility:1,_pendingMarkers:null,_retryCache:null,_transitions:null}),r.mode===`hidden`){if(t.flags&128){if(a=a===null?n:a.baseLanes|n,e!==null){for(r=t.child=e.child,i=0;r!==null;)i=i|r.lanes|r.childLanes,r=r.sibling;r=i&~a}else r=0,t.child=null;return Bc(e,t,a,n,r)}if(n&536870912)t.memoizedState={baseLanes:0,cachePool:null},e!==null&&Ja(t,a===null?null:a.cachePool),a===null?Ao():ko(t,a),Io(t);else return r=t.lanes=536870912,Bc(e,t,a===null?n:a.baseLanes|n,n,r)}else a===null?(e!==null&&Ja(t,null),Ao(),Lo()):(Ja(t,a.cachePool),ko(t,a),Lo(),t.memoizedState=null);return Pc(e,t,i,n),t.child}function zc(e,t){return e!==null&&e.tag===22||t.stateNode!==null||(t.stateNode={_visibility:1,_pendingMarkers:null,_retryCache:null,_transitions:null}),t.sibling}function Bc(e,t,n,r,i){var a=qa();return a=a===null?null:{parent:Ma._currentValue,pool:a},t.memoizedState={baseLanes:n,cachePool:a},e!==null&&Ja(t,null),Ao(),Io(t),e!==null&&Ta(e,t,r,!0),t.childLanes=i,null}function Vc(e,t){return t=el({mode:t.mode,children:t.children},e.mode),t.ref=e.ref,e.child=t,t.return=e,t}function Hc(e,t,n){return po(t,e.child,null,n),e=Vc(t,t.pendingProps),e.flags|=2,Ro(t),t.memoizedState=null,e}function Uc(e,t,n){var r=t.pendingProps,a=(t.flags&128)!=0;if(t.flags&=-129,e===null){if(I){if(r.mode===`hidden`)return e=Vc(t,r),t.lanes=536870912,e.memoizedState={baseLanes:0,cachePool:null},zc(null,e);if(Fo(t),(e=aa)?(e=am(e,sa),e=e!==null&&e.data===`&`?e:null,e!==null&&(t.memoizedState={dehydrated:e,treeContext:Xi===null?null:{id:Zi,overflow:Qi},retryLane:536870912,hydrationErrors:null},n=Bi(e),n.return=t,t.child=n,ia=t,aa=null)):e=null,e===null)throw la(t);return t.lanes=536870912,null}return Vc(t,r)}var o=e.memoizedState;if(o!==null){var s=o.dehydrated;if(Fo(t),a)if(t.flags&256)t.flags&=-257,t=Hc(e,t,n);else if(t.memoizedState!==null)t.child=e.child,t.flags|=128,t=null;else throw Error(i(558));else if(Nc||Ta(e,t,n,!1),a=(n&e.childLanes)!==0,Nc||a){if(Do.current===null){if(r=ed,r!==null&&(s=vt(r,n),s!==0&&s!==o.retryLane))throw o.retryLane=s,ki(e,s),Fd(r,e,s),Mc;qd()}t=Hc(e,t,n)}else e=o.treeContext,aa=lm(s.nextSibling),ia=t,I=!0,oa=null,sa=!1,e!==null&&ra(t,e),t=Vc(t,r),t.flags|=134221824;return t}return e=Fi(e.child,{mode:r.mode,children:r.children}),e.ref=t.ref,t.child=e,e.return=t,e}function Wc(e,t){var n=t.ref;if(n===null)e!==null&&e.ref!==null&&(t.flags|=4194816);else{if(typeof n!=`function`&&typeof n!=`object`)throw Error(i(284));(e===null||e.ref!==n)&&(t.flags|=4194816)}}function Gc(e,t,n,r,i){return Da(t),n=$o(e,t,n,r,void 0,i),r=rs(),e!==null&&!Nc?(is(e,t,i),ll(e,t,i)):(I&&r&&ta(t),t.flags|=1,Pc(e,t,n,i),t.child)}function Kc(e,t,n,r,i,a){return Da(t),t.updateQueue=null,n=ts(t,r,n,i),es(e),r=rs(),e!==null&&!Nc?(is(e,t,a),ll(e,t,a)):(I&&r&&ta(t),t.flags|=1,Pc(e,t,n,a),t.child)}function qc(e,t,n,r,i){if(Da(t),t.stateNode===null){var a=ji,o=n.contextType;typeof o==`object`&&o&&(a=R(o)),a=new n(r,a),t.memoizedState=a.state!==null&&a.state!==void 0?a.state:null,a.updater=yc,t.stateNode=a,a._reactInternals=t,a=t.stateNode,a.props=r,a.state=t.memoizedState,a.refs={},go(t),o=n.contextType,a.context=typeof o==`object`&&o?R(o):ji,a.state=t.memoizedState,o=n.getDerivedStateFromProps,typeof o==`function`&&(vc(t,n,o,r),a.state=t.memoizedState),typeof n.getDerivedStateFromProps==`function`||typeof a.getSnapshotBeforeUpdate==`function`||typeof a.UNSAFE_componentWillMount!=`function`&&typeof a.componentWillMount!=`function`||(o=a.state,typeof a.componentWillMount==`function`&&a.componentWillMount(),typeof a.UNSAFE_componentWillMount==`function`&&a.UNSAFE_componentWillMount(),o!==a.state&&yc.enqueueReplaceState(a,a.state,null),wo(t,r,a,i),Co(),a.state=t.memoizedState),typeof a.componentDidMount==`function`&&(t.flags|=4194308),r=!0}else if(e===null){a=t.stateNode;var s=t.memoizedProps,c=Sc(n,s);a.props=c;var l=a.context,u=n.contextType;o=ji,typeof u==`object`&&u&&(o=R(u));var d=n.getDerivedStateFromProps;u=typeof d==`function`||typeof a.getSnapshotBeforeUpdate==`function`,s=t.pendingProps!==s,u||typeof a.UNSAFE_componentWillReceiveProps!=`function`&&typeof a.componentWillReceiveProps!=`function`||(s||l!==o)&&xc(t,a,r,o),ho=!1;var f=t.memoizedState;a.state=f,wo(t,r,a,i),Co(),l=t.memoizedState,s||f!==l||ho?(typeof d==`function`&&(vc(t,n,d,r),l=t.memoizedState),(c=ho||bc(t,n,c,r,f,l,o))?(u||typeof a.UNSAFE_componentWillMount!=`function`&&typeof a.componentWillMount!=`function`||(typeof a.componentWillMount==`function`&&a.componentWillMount(),typeof a.UNSAFE_componentWillMount==`function`&&a.UNSAFE_componentWillMount()),typeof a.componentDidMount==`function`&&(t.flags|=4194308)):(typeof a.componentDidMount==`function`&&(t.flags|=4194308),t.memoizedProps=r,t.memoizedState=l),a.props=r,a.state=l,a.context=o,r=c):(typeof a.componentDidMount==`function`&&(t.flags|=4194308),r=!1)}else{a=t.stateNode,_o(e,t),o=t.memoizedProps,u=Sc(n,o),a.props=u,d=t.pendingProps,f=a.context,l=n.contextType,c=ji,typeof l==`object`&&l&&(c=R(l)),s=n.getDerivedStateFromProps,(l=typeof s==`function`||typeof a.getSnapshotBeforeUpdate==`function`)||typeof a.UNSAFE_componentWillReceiveProps!=`function`&&typeof a.componentWillReceiveProps!=`function`||(o!==d||f!==c)&&xc(t,a,r,c),ho=!1,f=t.memoizedState,a.state=f,wo(t,r,a,i),Co();var p=t.memoizedState;o!==d||f!==p||ho||e!==null&&e.dependencies!==null&&Ea(e.dependencies)?(typeof s==`function`&&(vc(t,n,s,r),p=t.memoizedState),(u=ho||bc(t,n,u,r,f,p,c)||e!==null&&e.dependencies!==null&&Ea(e.dependencies))?(l||typeof a.UNSAFE_componentWillUpdate!=`function`&&typeof a.componentWillUpdate!=`function`||(typeof a.componentWillUpdate==`function`&&a.componentWillUpdate(r,p,c),typeof a.UNSAFE_componentWillUpdate==`function`&&a.UNSAFE_componentWillUpdate(r,p,c)),typeof a.componentDidUpdate==`function`&&(t.flags|=4),typeof a.getSnapshotBeforeUpdate==`function`&&(t.flags|=1024)):(typeof a.componentDidUpdate!=`function`||o===e.memoizedProps&&f===e.memoizedState||(t.flags|=4),typeof a.getSnapshotBeforeUpdate!=`function`||o===e.memoizedProps&&f===e.memoizedState||(t.flags|=1024),t.memoizedProps=r,t.memoizedState=p),a.props=r,a.state=p,a.context=c,r=u):(typeof a.componentDidUpdate!=`function`||o===e.memoizedProps&&f===e.memoizedState||(t.flags|=4),typeof a.getSnapshotBeforeUpdate!=`function`||o===e.memoizedProps&&f===e.memoizedState||(t.flags|=1024),r=!1)}return a=r,Wc(e,t),r=(t.flags&128)!=0,a||r?(a=t.stateNode,n=r&&typeof n.getDerivedStateFromError!=`function`?null:a.render(),t.flags|=1,e!==null&&r?(t.child=po(t,e.child,null,i),t.child=po(t,null,n,i)):Pc(e,t,n,i),t.memoizedState=a.state,e=t.child):e=ll(e,t,i),e}function Jc(e,t,n,r){return pa(),t.flags|=256,Pc(e,t,n,r),t.child}var Yc={dehydrated:null,treeContext:null,retryLane:0,hydrationErrors:null};function Xc(e){return{baseLanes:e,cachePool:Ya()}}function Zc(e,t,n){return e=e===null?0:e.childLanes&~n,t&&(e|=ud),e}function Qc(e,t,n){var r=t.pendingProps,i=!1,a=(t.flags&128)!=0,o;if((o=a)||(o=e!==null&&e.memoizedState===null?!1:(B.current&2)!=0),o&&(i=!0,t.flags&=-129),o=(t.flags&32)!=0,t.flags&=-33,e===null){if(I){if(i?Po(t):Lo(),(e=aa)?(e=am(e,sa),e=e!==null&&e.data!==`&`?e:null,e!==null&&(t.memoizedState={dehydrated:e,treeContext:Xi===null?null:{id:Zi,overflow:Qi},retryLane:536870912,hydrationErrors:null},n=Bi(e),n.return=t,t.child=n,ia=t,aa=null)):e=null,e===null)throw la(t);return sm(e)?t.lanes=32:t.lanes=536870912,null}return a=r.children,r=r.fallback,i?(Lo(),i=t.mode,a=el({mode:`hidden`,children:a},i),r=Ri(r,i,n,null),a.return=t,r.return=t,a.sibling=r,t.child=a,r=t.child,r.memoizedState=Xc(n),r.childLanes=Zc(e,o,n),t.memoizedState=Yc,zc(null,r)):(Po(t),$c(t,a))}var s=e.memoizedState;if(s!==null){var c=s.dehydrated;if(c!==null)return nl(e,t,a,o,r,c,s,n)}return i?(Lo(),i=r.fallback,a=t.mode,s=e.child,c=s.sibling,r=Fi(s,{mode:`hidden`,children:r.children}),r.subtreeFlags=s.subtreeFlags&1206910976,c===null?(i=Ri(i,a,n,null),i.flags|=2):i=Fi(c,i),i.return=t,r.return=t,r.sibling=i,t.child=r,zc(null,r),r=t.child,i=e.child.memoizedState,i===null?i=Xc(n):(a=i.cachePool,a===null?a=Ya():(s=Ma._currentValue,a=a.parent===s?a:{parent:s,pool:s}),i={baseLanes:i.baseLanes|n,cachePool:a}),r.memoizedState=i,r.childLanes=Zc(e,o,n),t.memoizedState=Yc,zc(e.child,r)):(Po(t),n=e.child,e=n.sibling,n=Fi(n,{mode:`visible`,children:r.children}),n.return=t,n.sibling=null,e!==null&&(o=t.deletions,o===null?(t.deletions=[e],t.flags|=16):o.push(e)),t.child=n,t.memoizedState=null,n)}function $c(e,t){return t=el({mode:`visible`,children:t},e.mode),t.return=e,e.child=t}function el(e,t){return e=Ni(22,e,null,t),e.lanes=0,e}function tl(e,t,n){return po(t,e.child,null,n),e=$c(t,t.pendingProps.children),e.flags|=2,t.memoizedState=null,e}function nl(e,t,n,r,a,o,s,c){if(n)return t.flags&256?(Po(t),t.flags&=-257,tl(e,t,c)):t.memoizedState===null?(Lo(),o=a.fallback,s=t.mode,a=el({mode:`visible`,children:a.children},s),o=Ri(o,s,c,null),o.flags|=2,a.return=t,o.return=t,a.sibling=o,t.child=a,po(t,e.child,null,c),a=t.child,a.memoizedState=Xc(c),a.childLanes=Zc(e,r,c),t.memoizedState=Yc,zc(null,a)):(Lo(),t.child=e.child,t.flags|=128,null);if(Po(t),sm(o)){if(r=o.nextSibling&&o.nextSibling.dataset,r)var l=r.dgst;return r=l,r!==``&&(a=Error(i(419)),a.stack=``,a.digest=r,ga({value:a,source:null,stack:null})),tl(e,t,c)}if(Nc||Ta(e,t,c,!1),r=(c&e.childLanes)!==0,Nc||r){if(Do.current!==null)return tl(e,t,c);if(r=ed,r!==null&&(a=vt(r,c),a!==0&&a!==s.retryLane))throw s.retryLane=a,ki(e,a),Fd(r,e,a),Mc;return om(o)||qd(),tl(e,t,c)}return om(o)?(t.flags|=192,t.child=e.child,null):(e=s.treeContext,aa=lm(o.nextSibling),ia=t,I=!0,oa=null,sa=!1,e!==null&&ra(t,e),t=$c(t,a.children),t.flags|=134221824,t)}function rl(e,t,n){e.lanes|=t;var r=e.alternate;r!==null&&(r.lanes|=t),Ca(e.return,t,n)}function il(e){for(var t=null;e!==null;){var n=e.alternate;n!==null&&Vo(n)===null&&(t=e),e=e.sibling}return t}function al(e,t,n,r,i,a){var o=e.memoizedState;o===null?e.memoizedState={isBackwards:t,rendering:null,renderingStartTime:0,last:r,tail:n,tailMode:i,treeForkCount:a}:(o.isBackwards=t,o.rendering=null,o.renderingStartTime=0,o.last=r,o.tail=n,o.tailMode=i,o.treeForkCount=a)}function ol(e){var t=e.child;for(e.child=null;t!==null;){var n=t.sibling;t.sibling=e.child,e.child=t,t=n}}function sl(e,t,n){var r=t.pendingProps,i=r.revealOrder,a=r.tail;r=r.children;var o=B.current;if(t.flags&128)return zo(t,o),null;var s=(o&2)!=0;if(s?(o=o&1|2,t.flags|=128):o&=1,zo(t,o),i===`backwards`&&e!==null?(ol(e),Pc(e,t,r,n),ol(e)):Pc(e,t,r,n),r=I?qi:0,!s&&e!==null&&e.flags&128)a:for(e=t.child;e!==null;){if(e.tag===13)e.memoizedState!==null&&rl(e,n,t);else if(e.tag===19)rl(e,n,t);else if(e.child!==null){e.child.return=e,e=e.child;continue}if(e===t)break a;for(;e.sibling===null;){if(e.return===null||e.return===t)break a;e=e.return}e.sibling.return=e.return,e=e.sibling}switch(i){case`backwards`:n=il(t.child),n===null?(i=t.child,t.child=null):(i=n.sibling,n.sibling=null,ol(t)),al(t,!0,i,null,a,r);break;case`unstable_legacy-backwards`:for(n=null,i=t.child,t.child=null;i!==null;){if(e=i.alternate,e!==null&&Vo(e)===null){t.child=i;break}e=i.sibling,i.sibling=n,n=i,i=e}al(t,!0,n,null,a,r);break;case`together`:al(t,!1,null,null,void 0,r);break;case`independent`:t.memoizedState=null;break;default:n=il(t.child),n===null?(i=t.child,t.child=null):(i=n.sibling,n.sibling=null),al(t,!1,i,n,a,r)}return t.child}function cl(e,t,n){var r=t.pendingProps;return L(t,t.type,r.value),Pc(e,t,r.children,n),t.child}function ll(e,t,n){if(e!==null&&(t.dependencies=e.dependencies),sd|=t.lanes,(n&t.childLanes)===0)if(e!==null){if(Ta(e,t,n,!1),(n&t.childLanes)===0)return null}else return null;if(e!==null&&t.child!==e.child)throw Error(i(153));if(t.child!==null){for(e=t.child,n=Fi(e,e.pendingProps),t.child=n,n.return=t;e.sibling!==null;)e=e.sibling,n=n.sibling=Fi(e,e.pendingProps),n.return=t;n.sibling=null}return t.child}function ul(e,t){return(e.lanes&t)===0?(e=e.dependencies,!!(e!==null&&Ea(e))):!0}function dl(e,t,n){switch(t.tag){case 3:Ee(t,t.stateNode.containerInfo),L(t,Ma,e.memoizedState.cache),pa();break;case 27:case 5:Oe(t);break;case 4:Ee(t,t.stateNode.containerInfo);break;case 10:L(t,t.type,t.memoizedProps.value);break;case 31:if(t.memoizedState!==null)return t.flags|=128,Fo(t),null;break;case 13:var r=t.memoizedState;if(r!==null){if(r.dehydrated!==null)return Po(t),t.flags|=128,null;r=Ta(e,t,n,!1);var i=t.child.childLanes;return r||(n&i)!==0?Qc(e,t,n):(Po(t),e=ll(e,t,n),e===null?null:e.sibling)}Po(t);break;case 19:if(t.flags&128)return sl(e,t,n);if(i=(e.flags&128)!=0,r=(n&t.childLanes)!==0,r||=(Ta(e,t,n,!1),(n&t.childLanes)!==0),i){if(r)return sl(e,t,n);t.flags|=128}if(i=t.memoizedState,i!==null&&(i.rendering=null,i.tail=null,i.lastEffect=null),zo(t,B.current),r)break;return null;case 22:return t.lanes=0,Rc(e,t,n,t.pendingProps);case 24:L(t,Ma,e.memoizedState.cache)}return ll(e,t,n)}function fl(e,t,n){if(e!==null)if(e.memoizedProps!==t.pendingProps)Nc=!0;else{if(!ul(e,n)&&!(t.flags&128))return Nc=!1,dl(e,t,n);Nc=!!(e.flags&131072)}else Nc=!1,I&&t.flags&1048576&&ea(t,qi,t.index);switch(t.lanes=0,t.tag){case 16:a:{var r=t.pendingProps;if(e=no(t.elementType),t.type=e,typeof e==`function`)Pi(e)?(r=Sc(e,r),t.tag=1,t=qc(null,t,e,r,n)):(t.tag=0,t=Gc(null,t,e,r,n));else{if(e!=null){var a=e.$$typeof;if(a===re){t.tag=11,t=Fc(null,t,e,r,n);break a}else if(a===oe){t.tag=14,t=Ic(null,t,e,r,n);break a}else if(a===k){t.tag=10,t.type=e,t=cl(null,t,n);break a}}throw t=ge(e)||e,Error(i(306,t,``))}}return t;case 0:return Gc(e,t,t.type,t.pendingProps,n);case 1:return r=t.type,a=Sc(r,t.pendingProps),qc(e,t,r,a,n);case 3:a:{if(Ee(t,t.stateNode.containerInfo),e===null)throw Error(i(387));r=t.pendingProps;var o=t.memoizedState;a=o.element,_o(e,t),wo(t,r,null,n);var s=t.memoizedState;if(r=s.cache,L(t,Ma,r),r!==o.cache&&wa(t,[Ma],n,!0),Co(),r=s.element,o.isDehydrated)if(o={element:r,isDehydrated:!1,cache:s.cache},t.updateQueue.baseState=o,t.memoizedState=o,t.flags&256){t=Jc(e,t,r,n);break a}else if(r!==a){a=Ui(Error(i(424)),t),ga(a),t=Jc(e,t,r,n);break a}else{switch(e=t.stateNode.containerInfo,e.nodeType){case 9:e=e.body;break;default:e=e.nodeName===`HTML`?e.ownerDocument.body:e}for(aa=lm(e.firstChild),ia=t,I=!0,oa=null,sa=!0,n=mo(t,null,r,n),t.child=n;n;)n.flags=n.flags&-3|134221824,n=n.sibling}else{if(pa(),r===a){t=ll(e,t,n);break a}Pc(e,t,r,n)}t=t.child}return t;case 26:return Wc(e,t),e===null?(n=Nm(t.type,null,t.pendingProps,null))?t.memoizedState=n:I||(t.stateNode=fp(t.type,t.pendingProps,we.current,t)):t.memoizedState=Nm(t.type,e.memoizedProps,t.pendingProps,e.memoizedState),null;case 27:return Oe(t),e===null&&I&&(r=t.stateNode=hm(t.type,t.pendingProps,we.current),ia=t,sa=!0,a=aa,Sp(t.type)?(um=a,aa=lm(r.firstChild)):aa=a),Pc(e,t,t.pendingProps.children,n),Wc(e,t),e===null&&(t.flags|=4194304),t.child;case 5:return e===null&&I&&((a=r=aa)&&(r=rm(r,t.type,t.pendingProps,sa),r===null?a=!1:(t.stateNode=r,ia=t,aa=lm(r.firstChild),sa=!1,a=!0)),a||la(t)),Oe(t),a=t.type,o=t.pendingProps,s=e===null?null:e.memoizedProps,r=o.children,pp(a,o)?r=null:s!==null&&pp(a,s)&&(t.flags|=32),t.memoizedState!==null&&(a=$o(e,t,ns,null,null,n),sh._currentValue=a),Wc(e,t),Pc(e,t,r,n),t.child;case 6:return e===null&&I&&((e=n=aa)&&(n=im(n,t.pendingProps,sa),n===null?e=!1:(t.stateNode=n,ia=t,aa=null,e=!0)),e||la(t)),null;case 13:return Qc(e,t,n);case 4:return Ee(t,t.stateNode.containerInfo),r=t.pendingProps,e===null?t.child=po(t,null,r,n):Pc(e,t,r,n),t.child;case 11:return Fc(e,t,t.type,t.pendingProps,n);case 7:return r=t.pendingProps,Wc(e,t),Pc(e,t,r,n),t.child;case 8:return Pc(e,t,t.pendingProps.children,n),t.child;case 12:return Pc(e,t,t.pendingProps.children,n),t.child;case 10:return cl(e,t,n);case 9:return a=t.type._context,r=t.pendingProps.children,Da(t),a=R(a),r=r(a),t.flags|=1,Pc(e,t,r,n),t.child;case 14:return Ic(e,t,t.type,t.pendingProps,n);case 15:return Lc(e,t,t.type,t.pendingProps,n);case 19:return sl(e,t,n);case 31:return Uc(e,t,n);case 22:return Rc(e,t,n,t.pendingProps);case 24:return Da(t),r=R(Ma),e===null?(a=qa(),a===null&&(a=ed,o=Na(),a.pooledCache=o,o.refCount++,o!==null&&(a.pooledCacheLanes|=n),a=o),t.memoizedState={parent:r,cache:a},go(t),L(t,Ma,a)):((e.lanes&n)!==0&&(_o(e,t),wo(t,null,null,n),Co()),a=e.memoizedState,o=t.memoizedState,a.parent===r?(r=o.cache,L(t,Ma,r),r!==a.cache&&wa(t,[Ma],n,!0)):(a={parent:r,cache:r},t.memoizedState=a,t.lanes===0&&(t.memoizedState=t.updateQueue.baseState=a),L(t,Ma,r))),Pc(e,t,t.pendingProps.children,n),t.child;case 30:return t.stateNode===null&&(t.stateNode={autoName:null,paired:null,clones:null,ref:null}),r=t.pendingProps,r.name!=null&&r.name!==`auto`?t.flags|=e===null?18882560:18874368:I&&ta(t),e!==null&&e.memoizedProps.name!==r.name?t.flags|=4194816:Wc(e,t),Pc(e,t,r.children,n),t.child;case 29:throw t.pendingProps}throw Error(i(156,t.tag))}function pl(e){e.flags|=4}function ml(e,t,n,r,i){var a;if((a=(e.mode&32)!=0)&&(a=n===null?Jm(t,r):Jm(t,r)&&(r.src!==n.src||r.srcSet!==n.srcSet)),a){if(e.flags|=16777216,(i&335544128)===i)if(e.stateNode.complete)e.flags|=8192;else if(Wd())e.flags|=8192;else throw ro=$a,Za}else e.flags&=-16777217}function hl(e,t){if(t.type!==`stylesheet`||t.state.loading&4)e.flags&=-16777217;else if(e.flags|=16777216,!Ym(t))if(Wd())e.flags|=8192;else throw ro=$a,Za}function gl(e,t){t!==null&&(e.flags|=4),e.flags&16384&&(t=e.tag===22?536870912:ft(),e.lanes|=t,dd|=t)}function _l(e,t){if(!I)switch(e.tailMode){case`visible`:break;case`collapsed`:for(var n=e.tail,r=null;n!==null;)n.alternate!==null&&(r=n),n=n.sibling;r===null?t||e.tail===null?e.tail=null:e.tail.sibling=null:r.sibling=null;break;default:for(t=e.tail,n=null;t!==null;)t.alternate!==null&&(n=t),t=t.sibling;n===null?e.tail=null:n.sibling=null}}function vl(e){var t=e.alternate!==null&&e.alternate.child===e.child,n=0,r=0;if(t)for(var i=e.child;i!==null;)n|=i.lanes|i.childLanes,r|=i.subtreeFlags&1206910976,r|=i.flags&1206910976,i.return=e,i=i.sibling;else for(i=e.child;i!==null;)n|=i.lanes|i.childLanes,r|=i.subtreeFlags,r|=i.flags,i.return=e,i=i.sibling;return e.subtreeFlags|=r,e.childLanes=n,t}function yl(e,t,n){var r=t.pendingProps;switch(na(t),t.tag){case 16:case 15:case 0:case 11:case 7:case 8:case 12:case 9:case 14:return vl(t),null;case 1:return vl(t),null;case 3:return n=t.stateNode,r=null,e!==null&&(r=e.memoizedState.cache),t.memoizedState.cache!==r&&(t.flags|=2048),Sa(Ma),De(),n.pendingContext&&(n.context=n.pendingContext,n.pendingContext=null),(e===null||e.child===null)&&(fa(t)?pl(t):e===null||e.memoizedState.isDehydrated&&!(t.flags&256)||(t.flags|=1024,ma())),vl(t),null;case 26:var a=t.type,o=t.memoizedState;return e===null?(pl(t),o===null?(vl(t),ml(t,a,null,r,n)):(vl(t),hl(t,o))):o?o===e.memoizedState?(vl(t),t.flags&=-16777217):(pl(t),vl(t),hl(t,o)):(e=e.memoizedProps,e!==r&&pl(t),vl(t),ml(t,a,e,r,n)),null;case 27:if(ke(t),n=we.current,a=t.type,e!==null&&t.stateNode!=null)e.memoizedProps!==r&&pl(t);else{if(!r){if(t.stateNode===null)throw Error(i(166));return vl(t),t.subtreeFlags&=-33554433,null}e=Se.current,fa(t)?ua(t,e):(e=hm(a,r,n),t.stateNode=e,pl(t))}return vl(t),t.subtreeFlags&=-33554433,null;case 5:if(ke(t),a=t.type,e!==null&&t.stateNode!=null)e.memoizedProps!==r&&pl(t);else{if(!r){if(t.stateNode===null)throw Error(i(166));return vl(t),t.subtreeFlags&=-33554433,null}if(o=Se.current,fa(t))ua(t,o);else{var s=lp(we.current);switch(o){case 1:o=s.createElementNS(`http://www.w3.org/2000/svg`,a);break;case 2:o=s.createElementNS(`http://www.w3.org/1998/Math/MathML`,a);break;default:switch(a){case`svg`:o=s.createElementNS(`http://www.w3.org/2000/svg`,a);break;case`math`:o=s.createElementNS(`http://www.w3.org/1998/Math/MathML`,a);break;case`script`:o=s.createElement(`div`),o.innerHTML=`<script><\/script>`,o=o.removeChild(o.firstChild);break;case`select`:o=typeof r.is==`string`?s.createElement(`select`,{is:r.is}):s.createElement(`select`),r.multiple?o.multiple=!0:r.size&&(o.size=r.size);break;default:o=typeof r.is==`string`?s.createElement(a,{is:r.is}):s.createElement(a)}}o[wt]=t,o[Tt]=r;a:for(s=t.child;s!==null;){if(s.tag===5||s.tag===6)o.appendChild(s.stateNode);else if(s.tag!==4&&s.tag!==27&&s.child!==null){s.child.return=s,s=s.child;continue}if(s===t)break a;for(;s.sibling===null;){if(s.return===null||s.return===t)break a;s=s.return}s.sibling.return=s.return,s=s.sibling}t.stateNode=o;a:switch(np(o,a,r),a){case`button`:case`input`:case`select`:case`textarea`:r=!!r.autoFocus;break a;case`img`:r=!0;break a;default:r=!1}r&&pl(t)}}return vl(t),t.subtreeFlags&=-33554433,ml(t,t.type,e===null?null:e.memoizedProps,t.pendingProps,n),null;case 6:if(e&&t.stateNode!=null)e.memoizedProps!==r&&pl(t);else{if(typeof r!=`string`&&t.stateNode===null)throw Error(i(166));if(e=we.current,fa(t)){if(e=t.stateNode,n=t.memoizedProps,r=null,a=ia,a!==null)switch(a.tag){case 27:case 5:r=a.memoizedProps}e[wt]=t,e=!!(e.nodeValue===n||r!==null&&!0===r.suppressHydrationWarning||ep(e.nodeValue,n)),e||la(t,!0)}else e=lp(e).createTextNode(r),e[wt]=t,t.stateNode=e}return vl(t),null;case 31:if(n=t.memoizedState,e===null||e.memoizedState!==null){if(r=fa(t),n!==null){if(e===null){if(!r)throw Error(i(318));if(e=t.memoizedState,e=e===null?null:e.dehydrated,!e)throw Error(i(557));e[wt]=t}else pa(),!(t.flags&128)&&(t.memoizedState=null),t.flags|=4;vl(t),e=!1}else n=ma(),e!==null&&e.memoizedState!==null&&(e.memoizedState.hydrationErrors=n),e=!0;if(!e)return t.flags&256?(Ro(t),t):(Ro(t),null);if(t.flags&128)throw Error(i(558))}return vl(t),null;case 13:if(r=t.memoizedState,e===null||e.memoizedState!==null&&e.memoizedState.dehydrated!==null){if(a=fa(t),r!==null&&r.dehydrated!==null){if(e===null){if(!a)throw Error(i(318));if(a=t.memoizedState,a=a===null?null:a.dehydrated,!a)throw Error(i(317));a[wt]=t}else pa(),!(t.flags&128)&&(t.memoizedState=null),t.flags|=4;vl(t),a=!1}else a=ma(),e!==null&&e.memoizedState!==null&&(e.memoizedState.hydrationErrors=a),a=!0;if(!a)return t.flags&256?(Ro(t),t):(Ro(t),null)}return Ro(t),t.flags&128?(t.lanes=n,t):(n=r!==null,e=e!==null&&e.memoizedState!==null,n&&(r=t.child,a=null,r.alternate!==null&&r.alternate.memoizedState!==null&&r.alternate.memoizedState.cachePool!==null&&(a=r.alternate.memoizedState.cachePool.pool),o=null,r.memoizedState!==null&&r.memoizedState.cachePool!==null&&(o=r.memoizedState.cachePool.pool),o!==a&&(r.flags|=2048)),n!==e&&n&&(t.child.flags|=8192),gl(t,t.updateQueue),vl(t),null);case 4:return De(),e===null&&Wf(t.stateNode.containerInfo),t.flags|=67108864,vl(t),null;case 10:return Sa(t.type),vl(t),null;case 19:if(Bo(t),r=t.memoizedState,r===null)return vl(t),null;if(a=(t.flags&128)!=0,o=r.rendering,o===null)if(a)_l(r,!1);else{if(od!==0||e!==null&&e.flags&128)for(e=t.child;e!==null;){if(o=Vo(e),o!==null){for(t.flags|=128,_l(r,!1),e=o.updateQueue,t.updateQueue=e,gl(t,e),t.subtreeFlags=0,e=n,n=t.child;n!==null;)Ii(n,e),n=n.sibling;return zo(t,B.current&1|2),I&&$i(t,r.treeForkCount),t.child}e=e.sibling}r.tail!==null&&He()>_d&&(t.flags|=128,a=!0,_l(r,!1),t.lanes=4194304)}else{if(!a)if(e=Vo(o),e!==null){if(t.flags|=128,a=!0,e=e.updateQueue,t.updateQueue=e,gl(t,e),_l(r,!0),r.tail===null&&r.tailMode!==`collapsed`&&r.tailMode!==`visible`&&!o.alternate&&!I)return vl(t),null}else 2*He()-r.renderingStartTime>_d&&n!==536870912&&(t.flags|=128,a=!0,_l(r,!1),t.lanes=4194304);r.isBackwards?(o.sibling=t.child,t.child=o):(e=r.last,e===null?t.child=o:e.sibling=o,r.last=o)}if(r.tail!==null){e=r.tail;a:{for(n=e;n!==null;){if(n.alternate!==null){n=!1;break a}n=n.sibling}n=!0}return r.rendering=e,r.tail=e.sibling,r.renderingStartTime=He(),e.sibling=null,o=B.current,o=a?o&1|2:o&1,r.tailMode===`visible`||r.tailMode===`collapsed`||!n||I?zo(t,o):(n=o,N(Mo,t),N(B,n),No===null&&(No=t)),I&&$i(t,r.treeForkCount),e}return vl(t),null;case 22:case 23:return Ro(t),jo(),r=t.memoizedState!==null,e===null?r&&(t.flags|=8192):e.memoizedState!==null!==r&&(t.flags|=8192),r?n&536870912&&!(t.flags&128)&&(vl(t),t.subtreeFlags&6&&(t.flags|=8192)):vl(t),n=t.updateQueue,n!==null&&gl(t,n.retryQueue),n=null,e!==null&&e.memoizedState!==null&&e.memoizedState.cachePool!==null&&(n=e.memoizedState.cachePool.pool),r=null,t.memoizedState!==null&&t.memoizedState.cachePool!==null&&(r=t.memoizedState.cachePool.pool),r!==n&&(t.flags|=2048),e!==null&&xe(Ka),null;case 24:return n=null,e!==null&&(n=e.memoizedState.cache),t.memoizedState.cache!==n&&(t.flags|=2048),Sa(Ma),vl(t),null;case 25:return null;case 30:return t.flags|=33554432,vl(t),null}throw Error(i(156,t.tag))}function bl(e,t){switch(na(t),t.tag){case 1:return e=t.flags,e&65536?(t.flags=e&-65537|128,t):null;case 3:return Sa(Ma),De(),e=t.flags,e&65536&&!(e&128)?(t.flags=e&-65537|128,t):null;case 26:case 27:case 5:return ke(t),null;case 31:if(t.memoizedState!==null){if(Ro(t),t.alternate===null)throw Error(i(340));pa()}return e=t.flags,e&65536?(t.flags=e&-65537|128,t):null;case 13:if(Ro(t),e=t.memoizedState,e!==null&&e.dehydrated!==null){if(t.alternate===null)throw Error(i(340));pa()}return e=t.flags,e&65536?(t.flags=e&-65537|128,t):null;case 19:return Bo(t),e=t.flags,e&65536?(t.flags=e&-65537|128,e=t.memoizedState,e!==null&&(e.rendering=null,e.tail=null),t.flags|=4,t):null;case 4:return De(),null;case 10:return Sa(t.type),null;case 22:case 23:return Ro(t),jo(),e!==null&&xe(Ka),e=t.flags,e&65536?(t.flags=e&-65537|128,t):null;case 24:return Sa(Ma),null;case 25:return null;default:return null}}function xl(e,t){switch(na(t),t.tag){case 3:Sa(Ma),De();break;case 26:case 27:case 5:ke(t);break;case 4:De();break;case 31:t.memoizedState!==null&&Ro(t);break;case 13:Ro(t);break;case 19:Bo(t);break;case 10:Sa(t.type);break;case 22:case 23:Ro(t),jo(),e!==null&&xe(Ka);break;case 24:Sa(Ma)}}function Sl(e,t){try{var n=t.updateQueue,r=n===null?null:n.lastEffect;if(r!==null){var i=r.next;n=i;do{if((n.tag&e)===e){r=void 0;var a=n.create,o=n.inst;r=a(),o.destroy=r}n=n.next}while(n!==i)}}catch(e){Z(t,t.return,e)}}function Cl(e,t,n){try{var r=t.updateQueue,i=r===null?null:r.lastEffect;if(i!==null){var a=i.next;r=a;do{if((r.tag&e)===e){var o=r.inst,s=o.destroy;if(s!==void 0){o.destroy=void 0,i=t;var c=n,l=s;try{l()}catch(e){Z(i,c,e)}}}r=r.next}while(r!==a)}}catch(e){Z(t,t.return,e)}}function wl(e){var t=e.updateQueue;if(t!==null){var n=e.stateNode;try{Eo(t,n)}catch(t){Z(e,e.return,t)}}}function Tl(e,t,n){n.props=Sc(e.type,e.memoizedProps),n.state=e.memoizedState;try{n.componentWillUnmount()}catch(n){Z(e,t,n)}}function El(e,t){try{var n=e.ref;if(n!==null){switch(e.tag){case 26:case 27:case 5:var r=e.stateNode;break;case 30:var i=e.stateNode,a=yi(e.memoizedProps,i);(i.ref===null||i.ref.name!==a)&&(i.ref=Pp(a)),r=i.ref;break;case 7:if(e.stateNode===null){var o=new Fp(e);f(e.child,!1,Qp,o,void 0,void 0),e.stateNode=o}r=e.stateNode;break;default:r=e.stateNode}typeof n==`function`?e.refCleanup=n(r):n.current=r}}catch(n){Z(e,t,n)}}function Dl(e,t){var n=e.ref,r=e.refCleanup;if(n!==null)if(typeof r==`function`)try{r()}catch(n){Z(e,t,n)}finally{e.refCleanup=null,e=e.alternate,e!=null&&(e.refCleanup=null)}else if(typeof n==`function`)try{n(null)}catch(n){Z(e,t,n)}else n.current=null}function Ol(e,t){if((e.tag===5||e.tag===27||e.tag===6)&&e.alternate===null&&t!==null)for(var n=0;n<t.length;n++)em(e.stateNode,t[n])}function kl(e){for(var t=e.return;t!==null&&(Ml(t)&&em(e.stateNode,t.stateNode),!jl(t));)t=t.return}function Al(e){for(var t=e.return;t!==null&&(Ml(t)&&tm(e.stateNode,t.stateNode),!jl(t));)t=t.return}function jl(e){return e.tag===5||e.tag===3||e.tag===27}function Ml(e){return e&&e.tag===7&&e.stateNode!==null}function Nl(e){var t=e.type,n=e.memoizedProps,r=e.stateNode;try{a:switch(t){case`button`:case`input`:case`select`:case`textarea`:n.autoFocus&&r.focus();break a;case`img`:n.src?r.src=n.src:n.srcSet&&(r.srcset=n.srcSet)}}catch(t){Z(e,e.return,t)}}function Pl(e,t,n){try{var r=e.stateNode;ip(r,e.type,n,t),r[Tt]=t}catch(t){Z(e,e.return,t)}}function Fl(e){return e.tag===5||e.tag===3||e.tag===26||e.tag===27&&Sp(e.type)||e.tag===4}function Il(e){a:for(;;){for(;e.sibling===null;){if(e.return===null||Fl(e.return))return null;e=e.return}for(e.sibling.return=e.return,e=e.sibling;e.tag!==5&&e.tag!==6&&e.tag!==18;){if(e.tag===27&&Sp(e.type)||e.flags&2||e.child===null||e.tag===4)continue a;e.child.return=e,e=e.child}if(!(e.flags&2))return e.stateNode}}function Ll(e,t,n,r){var i=e.tag;if(i===5||i===6)i=e.stateNode,t?(n.nodeType===9?n.body:n.nodeName===`HTML`?n.ownerDocument.body:n).insertBefore(i,t):(t=n.nodeType===9?n.body:n.nodeName===`HTML`?n.ownerDocument.body:n,t.appendChild(i),n=n._reactRootContainer,n!=null||t.onclick!==null||(t.onclick=bn)),Ol(e,r),P=!0;else if(i!==4&&(i===27&&(Ol(e,r),r=null,Sp(e.type)&&(n=e.stateNode,t=null)),e=e.child,e!==null))for(Ll(e,t,n,r),e=e.sibling;e!==null;)Ll(e,t,n,r),e=e.sibling}function Rl(e,t,n,r){var i=e.tag;if(i===5||i===6)i=e.stateNode,t?n.insertBefore(i,t):n.appendChild(i),Ol(e,r),P=!0;else if(i!==4&&(i===27&&(Ol(e,r),r=null,Sp(e.type)&&(n=e.stateNode)),e=e.child,e!==null))for(Rl(e,t,n,r),e=e.sibling;e!==null;)Rl(e,t,n,r),e=e.sibling}function zl(e){var t=e.stateNode,n=e.memoizedProps;try{for(var r=e.type,i=t.attributes;i.length;)t.removeAttributeNode(i[0]);np(t,r,n),t[wt]=e,t[Tt]=n}catch(t){Z(e,e.return,t)}}var Bl=!1,Vl=null;function Hl(e){(e.tag===30||e.subtreeFlags&33554432)&&(Bl=!0)}var Ul=null;function Wl(){var e=Ul;return Ul=null,e}var Gl=0;function Kl(e,t,n,r,i){return Gl=0,ql(e.child,t,n,r,i)}function ql(e,t,n,r,i){for(var a=!1;e!==null;){if(e.tag===5){var o=e.stateNode;if(r!==null){var s=Op(o);r.push(s),s.view&&(a=!0)}else a||Op(o).view&&(a=!0);Bl=!0,Tp(o,Gl===0?t:t+`_`+Gl,n),Gl++}else (e.tag!==22||e.memoizedState===null)&&(e.tag===30&&i||ql(e.child,t,n,r,i)&&(a=!0));e=e.sibling}return a}function Jl(e,t){for(;e!==null;)e.tag===5?Ep(e.stateNode,e.memoizedProps):(e.tag!==22||e.memoizedState===null)&&(e.tag===30&&t||Jl(e.child,t)),e=e.sibling}function Yl(e){if(e.subtreeFlags&18874368)for(e=e.child;e!==null;){if((e.tag!==22||e.memoizedState===null)&&(Yl(e),e.tag===30&&e.flags&18874368&&e.stateNode.paired)){var t=e.memoizedProps;if(t.name==null||t.name===`auto`)throw Error(i(544));var n=t.name;t=xi(t.default,t.share),t!==`none`&&(Kl(e,n,t,null,!1)||Jl(e.child,!1))}e=e.sibling}}function Xl(e,t){if(e.tag===30){var n=e.stateNode,r=e.memoizedProps,i=yi(r,n),a=xi(r.default,n.paired?r.share:r.enter);a===`none`?Yl(e):Kl(e,i,a,null,!1)?(Yl(e),n.paired||t||Pd(e,r.onEnter)):Jl(e.child,!1)}else if(e.subtreeFlags&33554432)for(e=e.child;e!==null;)Xl(e,t),e=e.sibling;else Yl(e)}function Zl(e){if(Vl!==null&&Vl.size!==0){var t=Vl;if(e.subtreeFlags&18874368)for(e=e.child;e!==null;){if(e.tag!==22||e.memoizedState===null){if(e.tag===30&&e.flags&18874368){var n=e.memoizedProps,r=n.name;if(r!=null&&r!==`auto`){var i=t.get(r);if(i!==void 0){var a=xi(n.default,n.share);if(a!==`none`&&(Kl(e,r,a,null,!1)?(a=e.stateNode,i.paired=a,a.paired=i,Pd(e,n.onShare)):Jl(e.child,!1)),t.delete(r),t.size===0)break}}}Zl(e)}e=e.sibling}}}function Ql(e){if(e.tag===30){var t=e.memoizedProps,n=yi(t,e.stateNode),r=Vl===null?void 0:Vl.get(n),i=xi(t.default,r===void 0?t.exit:t.share);i!==`none`&&(Kl(e,n,i,null,!1)?r===void 0?Pd(e,t.onExit):(i=e.stateNode,r.paired=i,i.paired=r,Vl.delete(n),Pd(e,t.onShare)):Jl(e.child,!1)),Vl!==null&&Zl(e)}else if(e.subtreeFlags&33554432)for(e=e.child;e!==null;)Ql(e),e=e.sibling;else Vl!==null&&Zl(e)}function $l(e){for(e=e.child;e!==null;){if(e.tag===30){var t=e.memoizedProps,n=yi(t,e.stateNode);t=xi(t.default,t.update),e.flags&=-5,t!==`none`&&Kl(e,n,t,e.memoizedState=[],!1)}else e.subtreeFlags&33554432&&$l(e);e=e.sibling}}function eu(e){if(e.subtreeFlags&18874368)for(e=e.child;e!==null;){if(e.tag!==22||e.memoizedState===null){if(e.tag===30&&e.flags&18874368){var t=e.stateNode;t.paired!==null&&(t.paired=null,Jl(e.child,!1))}eu(e)}e=e.sibling}}function tu(e){if(e.tag===30)e.stateNode.paired=null,Jl(e.child,!1),eu(e);else if(e.subtreeFlags&33554432)for(e=e.child;e!==null;)tu(e),e=e.sibling;else eu(e)}function nu(e){for(e=e.child;e!==null;)e.tag===30?Jl(e.child,!1):e.subtreeFlags&33554432&&nu(e),e=e.sibling}function ru(e,t,n,r,i,a,o){for(var s=!1;t!==null;){if(t.tag===5){var c=t.stateNode;if(a!==null&&Gl<a.length){var l=a[Gl],u=Op(c);(l.view||u.view)&&(s=!0);var d;if(d=(e.flags&4)==0)if(u.clip)d=!0;else{d=l.rect;var f=u.rect;d=d.y!==f.y||d.x!==f.x||d.height!==f.height||d.width!==f.width}d&&(e.flags|=4),u.abs?u=!l.abs:(l=l.rect,u=u.rect,u=l.height!==u.height||l.width!==u.width),u&&(e.flags|=32)}else e.flags|=32;e.flags&4&&Tp(c,Gl===0?n:n+`_`+Gl,i),s&&e.flags&4||(Ul===null&&(Ul=[]),Ul.push(c,Gl===0?r:r+`_`+Gl,t.memoizedProps)),Gl++}else (t.tag!==22||t.memoizedState===null)&&(t.tag===30&&o?e.flags|=t.flags&32:ru(e,t.child,n,r,i,a,o)&&(s=!0));t=t.sibling}return s}function iu(e,t){for(e=e.child;e!==null;){if(e.tag===30){var n=e.memoizedProps,r=e.stateNode,i=yi(n,r),a=xi(n.default,n.update);if(t){r=r.clones;var o=r===null?null:r.map(kp)}else o=e.memoizedState,e.memoizedState=null;r=e;var s=e.child;Gl=0,i=ru(r,s,i,i,a,o,!1),e.flags&4&&i&&(t||Pd(e,n.onUpdate))}else e.subtreeFlags&33554432&&iu(e,t);e=e.sibling}}var au=!1,W=!1,ou=!1,su=!1,cu=typeof WeakSet==`function`?WeakSet:Set,lu=null,uu=!1,du=!1,fu=!1,pu=!1;function mu(e,t,n){if(e=e.containerInfo,sp=gh,e=Yr(e),Xr(e)){if(`selectionStart`in e)var r={start:e.selectionStart,end:e.selectionEnd};else a:{r=(r=e.ownerDocument)&&r.defaultView||window;var i=r.getSelection&&r.getSelection();if(i&&i.rangeCount!==0){r=i.anchorNode;var a=i.anchorOffset,o=i.focusNode;i=i.focusOffset;try{r.nodeType,o.nodeType}catch{r=null;break a}var s=0,c=-1,l=-1,u=0,d=0,f=e,p=null;b:for(;;){for(var m;f!==r||a!==0&&f.nodeType!==3||(c=s+a),f!==o||i!==0&&f.nodeType!==3||(l=s+i),f.nodeType===3&&(s+=f.nodeValue.length),(m=f.firstChild)!==null;)p=f,f=m;for(;;){if(f===e)break b;if(p===r&&++u===a&&(c=s),p===o&&++d===i&&(l=s),(m=f.nextSibling)!==null)break;f=p,p=f.parentNode}f=m}r=c===-1||l===-1?null:{start:c,end:l}}else r=null}r||={start:0,end:0}}else r=null;for(cp={focusedElem:e,selectionRange:r},gh=!1,n=(n&335544064)===n,lu=t,t=n?9270:1024;lu!==null;){if(e=lu,n&&(r=e.deletions,r!==null))for(a=0;a<r.length;a++)n&&Ql(r[a]);if(e.alternate===null&&e.flags&2)n&&Hl(e),hu(n);else{if(e.tag===22){if(r=e.alternate,e.memoizedState!==null){r!==null&&r.memoizedState===null&&n&&Ql(r),hu(n);continue}else if(r!==null&&r.memoizedState!==null){n&&Hl(e),hu(n);continue}}r=e.child,(e.subtreeFlags&t)!==0&&r!==null?(r.return=e,lu=r):(n&&$l(e),hu(n))}}Vl=null}function hu(e){for(;lu!==null;){var t=lu,n=e,r=t.alternate,a=t.flags;switch(t.tag){case 0:case 11:case 15:break;case 1:if(a&1024&&r!==null){n=void 0,a=r.memoizedProps,r=r.memoizedState;var o=t.stateNode;try{var s=Sc(t.type,a);n=o.getSnapshotBeforeUpdate(s,r),o.__reactInternalSnapshotBeforeUpdate=n}catch(e){Z(t,t.return,e)}}break;case 3:if(a&1024){if(r=t.stateNode.containerInfo,n=r.nodeType,n===9)nm(r);else if(n===1)switch(r.nodeName){case`HEAD`:case`HTML`:case`BODY`:nm(r);break;default:r.textContent=``}}break;case 5:case 26:case 27:case 6:case 4:case 17:break;case 30:n&&r!==null&&(n=yi(r.memoizedProps,r.stateNode),a=t.memoizedProps,a=xi(a.default,a.update),a!==`none`&&Kl(r,n,a,r.memoizedState=[],!0));break;default:if(a&1024)throw Error(i(163))}if(r=t.sibling,r!==null){r.return=t.return,lu=r;break}lu=t.return}}function gu(e,t,n){var r=n.flags;switch(n.tag){case 0:case 11:case 15:Iu(e,n),r&4&&Sl(5,n);break;case 1:if(Iu(e,n),r&4)if(e=n.stateNode,t===null)try{e.componentDidMount()}catch(e){Z(n,n.return,e)}else{var i=Sc(n.type,t.memoizedProps);t=t.memoizedState;try{e.componentDidUpdate(i,t,e.__reactInternalSnapshotBeforeUpdate)}catch(e){Z(n,n.return,e)}}r&64&&wl(n),r&512&&El(n,n.return);break;case 3:if(Iu(e,n),r&64&&(e=n.updateQueue,e!==null)){if(t=null,n.child!==null)switch(n.child.tag){case 27:case 5:t=n.child.stateNode;break;case 1:t=n.child.stateNode}try{Eo(e,t)}catch(e){Z(n,n.return,e)}}break;case 27:t===null&&r&4&&zl(n);case 26:case 5:Iu(e,n),t===null&&r&4&&Nl(n),r&512&&El(n,n.return);break;case 12:Iu(e,n);break;case 31:Iu(e,n),r&4&&Tu(e,n);break;case 13:Iu(e,n),r&4&&Eu(e,n),r&64&&(e=n.memoizedState,e!==null&&(e=e.dehydrated,e!==null&&(n=_f.bind(null,n),cm(e,n))));break;case 22:if(r=n.memoizedState!==null||au,!r){var a=t!==null&&t.memoizedState!==null||W;t=au,i=W,au=r,(W=a)&&!i?(r=2,n.subtreeFlags&8772&&(r|=1),Ru(e,n,r)):Iu(e,n),au=t,W=i}break;case 30:Iu(e,n),r&512&&El(n,n.return);break;case 7:r&512&&El(n,n.return);default:Iu(e,n)}}function _u(e,t){for(e=e.child;e!==null;)vu(e,t),e=e.sibling}function vu(e,t){switch(e.tag){case 5:case 26:try{var n=e.stateNode;if(t){var r=n.style;typeof r.setProperty==`function`?r.setProperty(`display`,`none`,`important`):r.display=`none`}else{var i=e.stateNode,a=e.memoizedProps.style,o=a!=null&&a.hasOwnProperty(`display`)?a.display:null;i.style.display=o==null||typeof o==`boolean`?``:(``+o).trim()}}catch(t){Z(e,e.return,t)}yu(e,t);break;case 6:try{e.stateNode.nodeValue=t?``:e.memoizedProps,P=!0}catch(t){Z(e,e.return,t)}break;case 18:try{var s=e.stateNode;t?wp(s,!0):wp(e.stateNode,!1)}catch(t){Z(e,e.return,t)}break;case 22:case 23:e.memoizedState===null&&_u(e,t);break;default:_u(e,t)}}function yu(e,t){if(e.subtreeFlags&67108864)for(e=e.child;e!==null;){a:{var n=e,r=t;switch(n.tag){case 4:vu(n,r);break a;case 22:n.memoizedState===null&&yu(n,r);break a;default:yu(n,r)}}e=e.sibling}}function bu(e){var t=e.alternate;t!==null&&(e.alternate=null,bu(t)),e.child=null,e.deletions=null,e.sibling=null,e.tag===5&&(t=e.stateNode,t!==null&&Nt(t)),e.stateNode=null,e.return=null,e.dependencies=null,e.memoizedProps=null,e.memoizedState=null,e.pendingProps=null,e.stateNode=null,e.updateQueue=null}var xu=null,Su=!1;function Cu(e,t,n){for(n=n.child;n!==null;)wu(e,t,n),n=n.sibling}function wu(e,t,n){if(Qe&&typeof Qe.onCommitFiberUnmount==`function`)try{Qe.onCommitFiberUnmount(Ze,n)}catch{}switch(n.tag){case 26:W||Dl(n,t),Cu(e,t,n),n.memoizedState?n.memoizedState.count--:n.stateNode&&!W&&(n=n.stateNode,n.parentNode.removeChild(n));break;case 27:W||Dl(n,t),Al(n);var r=xu,i=Su;Sp(n.type)&&(xu=n.stateNode,Su=!1),Cu(e,t,n),gm(n.stateNode,n.type,n.memoizedProps),xu=r,Su=i;break;case 5:W||Dl(n,t),Al(n);case 6:if(n.tag===6&&Al(n),r=xu,i=Su,xu=null,Cu(e,t,n),xu=r,Su=i,xu!==null)if(Su)try{(xu.nodeType===9?xu.body:xu.nodeName===`HTML`?xu.ownerDocument.body:xu).removeChild(n.stateNode),P=!0}catch(e){Z(n,t,e)}else try{xu.removeChild(n.stateNode),P=!0}catch(e){Z(n,t,e)}break;case 18:xu!==null&&(Su?(e=xu,Cp(e.nodeType===9?e.body:e.nodeName===`HTML`?e.ownerDocument.body:e,n.stateNode),Hh(e)):Cp(xu,n.stateNode));break;case 4:r=xu,i=Su,xu=n.stateNode.containerInfo,Su=!0,Cu(e,t,n),xu=r,Su=i;break;case 0:case 11:case 14:case 15:Cl(2,n,t),W||Cl(4,n,t),Cu(e,t,n);break;case 1:W||(Dl(n,t),r=n.stateNode,typeof r.componentWillUnmount==`function`&&Tl(n,t,r)),Cu(e,t,n);break;case 21:Cu(e,t,n);break;case 22:W=(r=W)||n.memoizedState!==null,Cu(e,t,n),W=r;break;case 30:Dl(n,t),Cu(e,t,n);break;case 7:W||Dl(n,t),Cu(e,t,n);break;default:Cu(e,t,n)}}function Tu(e,t){if(t.memoizedState===null&&(e=t.alternate,e!==null&&(e=e.memoizedState,e!==null))){e=e.dehydrated;try{Hh(e)}catch(e){Z(t,t.return,e)}}}function Eu(e,t){if(t.memoizedState===null&&(e=t.alternate,e!==null&&(e=e.memoizedState,e!==null&&(e=e.dehydrated,e!==null))))try{Hh(e)}catch(e){Z(t,t.return,e)}}function Du(e){switch(e.tag){case 31:case 13:case 19:var t=e.stateNode;return t===null&&(t=e.stateNode=new cu),t;case 22:return e=e.stateNode,t=e._retryCache,t===null&&(t=e._retryCache=new cu),t;default:throw Error(i(435,e.tag))}}function Ou(e,t){var n=Du(e);t.forEach(function(t){if(!n.has(t)){n.add(t);var r=vf.bind(null,e,t);t.then(r,r)}})}function ku(e,t,n){var r=t.deletions;if(r!==null)for(var a=0;a<r.length;a++){var o=r[a],s=e,c=t,l=c;a:for(;l!==null;){switch(l.tag){case 27:if(Sp(l.type)){xu=l.stateNode,Su=!1;break a}break;case 5:xu=l.stateNode,Su=!1;break a;case 3:case 4:xu=l.stateNode.containerInfo,Su=!0;break a}l=l.return}if(xu===null)throw Error(i(160));wu(s,c,o),xu=null,Su=!1,s=o.alternate,s!==null&&(s.return=null),o.return=null}if(t.subtreeFlags&13886)for(t=t.child;t!==null;)ju(t,e,n),t=t.sibling}var Au=null;function ju(e,t,n){var r=e.alternate,a=e.flags;switch(e.tag){case 0:case 11:case 14:case 15:if(a&4&&(r=e.updateQueue,r=r===null?null:r.events,r!==null))for(var o=0;o<r.length;o++){var s=r[o];s.ref.impl=s.nextImpl}ku(t,e,n),Mu(e),a&4&&(Cl(3,e,e.return),Sl(3,e),Cl(5,e,e.return));break;case 1:ku(t,e,n),Mu(e),a&512&&(W||r===null||Dl(r,r.return)),a&64&&au&&(e=e.updateQueue,e!==null&&(t=e.callbacks,t!==null&&(n=e.shared.hiddenCallbacks,e.shared.hiddenCallbacks=n===null?t:n.concat(t))));break;case 26:if(o=Au,ku(t,e,n),Mu(e),a&512&&(W||r===null||Dl(r,r.return)),a&4)if(a=r===null?null:r.memoizedState,n=e.memoizedState,r===null)if(n===null)if(e.stateNode===null)if(au)e.stateNode=fp(e.type,e.memoizedProps,t.containerInfo,e);else{a:{t=e.type,n=e.memoizedProps,a=o.ownerDocument||o;b:switch(t){case`title`:r=a.getElementsByTagName(`title`)[0],(!r||r[jt]||r[wt]||r.namespaceURI===`http://www.w3.org/2000/svg`||r.hasAttribute(`itemprop`))&&(r=a.createElement(t),a.head.insertBefore(r,a.querySelector(`head > title`))),np(r,t,n),r[wt]=e,Rt(r),t=r;break a;case`link`:if(o=Gm(`link`,`href`,a).get(t+(n.href||``))){for(s=0;s<o.length;s++)if(r=o[s],r.getAttribute(`href`)===(n.href==null||n.href===``?null:n.href)&&r.getAttribute(`rel`)===(n.rel==null?null:n.rel)&&r.getAttribute(`title`)===(n.title==null?null:n.title)&&r.getAttribute(`crossorigin`)===(n.crossOrigin==null?null:n.crossOrigin)){o.splice(s,1);break b}}r=a.createElement(t),np(r,t,n),a.head.appendChild(r);break;case`meta`:if(o=Gm(`meta`,`content`,a).get(t+(n.content||``))){for(s=0;s<o.length;s++)if(r=o[s],r.getAttribute(`content`)===(n.content==null?null:``+n.content)&&r.getAttribute(`name`)===(n.name==null?null:n.name)&&r.getAttribute(`property`)===(n.property==null?null:n.property)&&r.getAttribute(`http-equiv`)===(n.httpEquiv==null?null:n.httpEquiv)&&r.getAttribute(`charset`)===(n.charSet==null?null:n.charSet)){o.splice(s,1);break b}}r=a.createElement(t),np(r,t,n),a.head.appendChild(r);break;default:throw Error(i(468,t))}r[wt]=e,Rt(r),t=r}e.stateNode=t}else au||Km(o,e.type,e.stateNode);else e.stateNode=Bm(o,n,e.memoizedProps);else a===n?n===null&&e.stateNode!==null&&Pl(e,e.memoizedProps,r.memoizedProps):(a===null?(t=r.stateNode,t===null||W||t.parentNode.removeChild(t)):a.count--,n===null?au||Km(o,e.type,e.stateNode):Bm(o,n,e.memoizedProps));break;case 27:ku(t,e,n),Mu(e),a&512&&(W||r===null||Dl(r,r.return)),r!==null&&a&4&&Pl(e,e.memoizedProps,r.memoizedProps);break;case 5:if(o=ou,ou=!1,ku(t,e,n),ou=o,Mu(e),a&512&&(W||r===null||Dl(r,r.return)),e.flags&32){t=e.stateNode;try{fn(t,``),P=!0}catch(t){Z(e,e.return,t)}}a&4&&e.stateNode!=null&&(t=e.memoizedProps,Pl(e,t,r===null?t:r.memoizedProps)),a&1024&&(su=!0);break;case 6:if(ku(t,e,n),Mu(e),a&4){if(e.stateNode===null)throw Error(i(162));t=e.memoizedProps,n=e.stateNode;try{n.nodeValue=t,P=!0}catch(t){Z(e,e.return,t)}}break;case 3:if(P=!1,Wm=null,o=Au,Au=bm(t.containerInfo),ku(t,e,n),Au=o,Mu(e),a&4&&r!==null&&r.memoizedState.isDehydrated)try{Hh(t.containerInfo)}catch(t){Z(e,e.return,t)}su&&(su=!1,Nu(e)),P=!1;break;case 4:a=ou,ou=au,r=Jt(),o=Au,Au=bm(e.stateNode.containerInfo),ku(t,e,n),Mu(e),Au=o,P&&du&&(fu=!0),P=r,ou=a;break;case 12:ku(t,e,n),Mu(e);break;case 31:ku(t,e,n),Mu(e),a&4&&(t=e.updateQueue,t!==null&&(e.updateQueue=null,Ou(e,t)));break;case 13:ku(t,e,n),Mu(e),e.child.flags&8192&&e.memoizedState!==null!=(r!==null&&r.memoizedState!==null)&&(hd=He()),a&4&&(t=e.updateQueue,t!==null&&(e.updateQueue=null,Ou(e,t)));break;case 22:o=e.memoizedState!==null,s=r!==null&&r.memoizedState!==null;var c=au,l=W,u=ou;au=c||o,ou=u||o,W=l||s,ku(t,e,n),W=l,ou=u,au=c,Mu(e),a&8192&&(t=e.stateNode,t._visibility=o?t._visibility&-2:t._visibility|1,!o||r===null||s||au||W||(t=s||W,n=au,r=W,au=o||au,W=t,Lu(e,2),au=n,W=r),!o&&ou||_u(e,o)),a&4&&(t=e.updateQueue,t!==null&&(n=t.retryQueue,n!==null&&(t.retryQueue=null,Ou(e,n))));break;case 19:ku(t,e,n),Mu(e),a&4&&(t=e.updateQueue,t!==null&&(e.updateQueue=null,Ou(e,t)));break;case 30:a&512&&(W||r===null||Dl(r,r.return)),a=Jt(),o=du,s=(n&335544064)===n,c=e.memoizedProps,du=s&&xi(c.default,c.update)!==`none`,ku(t,e,n),Mu(e),s&&r!==null&&P&&(e.flags|=4),du=o,P=a;break;case 21:break;case 7:a&512&&(W||r===null||Dl(r,r.return)),r&&r.stateNode!==null&&(r.stateNode._fragmentFiber=e);default:ku(t,e,n),Mu(e)}}function Mu(e){var t=e.flags;if(t&2){try{for(var n,r=e.return;r!==null;){if(Fl(r)){n=r;break}r=r.return}r=null;for(var a=e.return;a!==null;){if(Ml(a)){var o=a.stateNode;r===null?r=[o]:r.push(o)}if(jl(a))break;a=a.return}var s=r;if(n==null)throw Error(i(160));switch(n.tag){case 27:var c=n.stateNode;Rl(e,Il(e),c,s);break;case 5:var l=n.stateNode;n.flags&32&&(fn(l,``),n.flags&=-33),Rl(e,Il(e),l,s);break;case 3:case 4:var u=n.stateNode.containerInfo;Ll(e,Il(e),u,s);break;default:throw Error(i(161))}}catch(t){Z(e,e.return,t)}e.flags&=-3}t&4096&&(e.flags&=-4097)}function Nu(e){if(e.subtreeFlags&1024)for(e=e.child;e!==null;){var t=e;Nu(t),t.tag===5&&t.flags&1024&&(t=t.stateNode,gh=!0,t.reset(),gh=!1),e=e.sibling}}function Pu(e,t){if(t.subtreeFlags&9270)for(t=t.child;t!==null;)Fu(t,e),t=t.sibling;else iu(t,!1)}function Fu(e,t){var n=e.alternate;if(n===null)Xl(e,!1);else switch(e.tag){case 3:if(pu=uu=!1,Wl(),Pu(t,e),!uu&&!fu){if(e=Ul,e!==null)for(var r=0;r<e.length;r+=3){n=e[r];var i=e[r+1];Ep(n,e[r+2]),n=n.ownerDocument.documentElement,n!==null&&n.animate({opacity:[0,0],pointerEvents:[`none`,`none`]},{duration:0,fill:`forwards`,pseudoElement:`::view-transition-group(`+i+`)`})}e=t.containerInfo,e=e.nodeType===9?e.documentElement:e.ownerDocument.documentElement,e!==null&&e.style.viewTransitionName===``&&(e.style.viewTransitionName=`none`,e.animate({opacity:[0,0],pointerEvents:[`none`,`none`]},{duration:0,fill:`forwards`,pseudoElement:`::view-transition-group(root)`}),e.animate({width:[0,0],height:[0,0]},{duration:0,fill:`forwards`,pseudoElement:`::view-transition`})),pu=!0}Ul=null;break;case 5:Pu(t,e);break;case 4:r=uu,uu=!1,Pu(t,e),uu&&(fu=!0),uu=r;break;case 22:e.memoizedState===null&&(n.memoizedState===null?Pu(t,e):Xl(e,!1));break;case 30:r=uu,i=Wl(),uu=!1,Pu(t,e),uu&&(e.flags|=4);var a=e.memoizedProps,o=e.stateNode;t=yi(a,o),o=yi(n.memoizedProps,o);var s=xi(a.default,a.update);s===`none`?t=!1:(a=n.memoizedState,n.memoizedState=null,n=e.child,Gl=0,t=ru(e,n,t,o,s,a,!0),Gl!==(a===null?0:a.length)&&(e.flags|=32)),e.flags&4&&t?(Pd(e,e.memoizedProps.onUpdate),Ul=i):i!==null&&(i.push.apply(i,Ul),Ul=i),uu=e.flags&32?!0:r;break;default:Pu(t,e)}}function Iu(e,t){if(t.subtreeFlags&8772)for(t=t.child;t!==null;)gu(e,t.alternate,t),t=t.sibling}function Lu(e,t){for(e=e.child;e!==null;){var n=e,r=t;switch(n.tag){case 0:case 11:case 14:case 15:Cl(4,n,n.return),Lu(n,r);break;case 1:Dl(n,n.return);var i=n.stateNode;typeof i.componentWillUnmount==`function`&&Tl(n,n.return,i),Lu(n,r);break;case 27:r&2&&gm(n.stateNode,n.type,n.memoizedProps);case 5:Dl(n,n.return),n.tag!==5&&n.tag!==27||Al(n),Lu(n,r);break;case 6:Al(n);break;case 26:Dl(n,n.return),i=n.stateNode,n.memoizedState!==null||i===null||W||i.parentNode.removeChild(i),Lu(n,r);break;case 22:n.memoizedState===null&&Lu(n,r);break;case 30:Dl(n,n.return),Lu(n,r);break;case 7:Dl(n,n.return);default:Lu(n,r)}e=e.sibling}}function Ru(e,t,n){for(n=t.subtreeFlags&8772?n:n&-2,t=t.child;t!==null;){var r=t.alternate,i=e,a=t,o=a.flags,s=(n&1)!=0;switch(a.tag){case 0:case 11:case 15:Ru(i,a,n),Sl(4,a);break;case 1:if(Ru(i,a,n),r=a,i=r.stateNode,typeof i.componentDidMount==`function`)try{i.componentDidMount()}catch(e){Z(r,r.return,e)}if(r=a,i=r.updateQueue,i!==null){var c=r.stateNode;try{var l=i.shared.hiddenCallbacks;if(l!==null)for(i.shared.hiddenCallbacks=null,i=0;i<l.length;i++)To(l[i],c)}catch(e){Z(r,r.return,e)}}s&&o&64&&wl(a),El(a,a.return);break;case 27:n&2&&zl(a);case 5:a.tag!==5&&a.tag!==27||kl(a),Ru(i,a,n),s&&r===null&&o&4&&Nl(a),El(a,a.return);break;case 6:kl(a);break;case 26:c=a.stateNode,a.memoizedState!==null||c===null||au||Km(bm(c.ownerDocument),a.type,c),Ru(i,a,n),s&&r===null&&o&4&&Nl(a),El(a,a.return);break;case 12:Ru(i,a,n);break;case 31:Ru(i,a,n),s&&o&4&&Tu(i,a);break;case 13:Ru(i,a,n),s&&o&4&&Eu(i,a);break;case 22:a.memoizedState===null&&Ru(i,a,n),El(a,a.return);break;case 30:Ru(i,a,n),El(a,a.return);break;case 7:El(a,a.return);default:Ru(i,a,n)}t=t.sibling}}function zu(e,t){var n=null;e!==null&&e.memoizedState!==null&&e.memoizedState.cachePool!==null&&(n=e.memoizedState.cachePool.pool),e=null,t.memoizedState!==null&&t.memoizedState.cachePool!==null&&(e=t.memoizedState.cachePool.pool),e!==n&&(e!=null&&e.refCount++,n!=null&&Pa(n))}function Bu(e,t){e=null,t.alternate!==null&&(e=t.alternate.memoizedState.cache),t=t.memoizedState.cache,t!==e&&(t.refCount++,e!=null&&Pa(e))}function Vu(e,t,n,r){var i=(n&335544064)===n;if(t.subtreeFlags&(i?10262:10256))for(t=t.child;t!==null;)Hu(e,t,n,r),t=t.sibling;else i&&nu(t)}function Hu(e,t,n,r){var i=(n&335544064)===n;i&&t.alternate===null&&t.return!==null&&t.return.alternate!==null&&tu(t);var a=t.flags;switch(t.tag){case 0:case 11:case 15:Vu(e,t,n,r),a&2048&&Sl(9,t);break;case 1:Vu(e,t,n,r);break;case 3:Vu(e,t,n,r),i&&pu&&(e=e.containerInfo,e=e.nodeType===9?e.body:e.nodeName===`HTML`?e.ownerDocument.body:e,e.style.viewTransitionName===`root`&&(e.style.viewTransitionName=``),e=e.ownerDocument.documentElement,e!==null&&e.style.viewTransitionName===`none`&&(e.style.viewTransitionName=``)),a&2048&&(a=null,t.alternate!==null&&(a=t.alternate.memoizedState.cache),t=t.memoizedState.cache,t!==a&&(t.refCount++,a!=null&&Pa(a)));break;case 12:if(a&2048){Vu(e,t,n,r),a=t.stateNode;try{var o=t.memoizedProps,s=o.id,c=o.onPostCommit;typeof c==`function`&&c(s,t.alternate===null?`mount`:`update`,a.passiveEffectDuration,-0)}catch(e){Z(t,t.return,e)}}else Vu(e,t,n,r);break;case 31:Vu(e,t,n,r);break;case 13:Vu(e,t,n,r);break;case 23:break;case 22:o=t.stateNode,s=t.alternate,t.memoizedState===null?(i&&s!==null&&s.memoizedState!==null&&tu(t),o._visibility&2?Vu(e,t,n,r):(o._visibility|=2,Uu(e,t,n,r,(t.subtreeFlags&10256)!=0||!1))):(i&&s!==null&&s.memoizedState===null&&tu(s),o._visibility&2?Vu(e,t,n,r):G(e,t)),a&2048&&zu(s,t);break;case 24:Vu(e,t,n,r),a&2048&&Bu(t.alternate,t);break;case 30:i&&(a=t.alternate,a!==null&&(Jl(a.child,!0),Jl(t.child,!0))),Vu(e,t,n,r);break;default:Vu(e,t,n,r)}}function Uu(e,t,n,r,i){for(i&&=(t.subtreeFlags&10256)!=0||!1,t=t.child;t!==null;){var a=e,o=t,s=n,c=r,l=o.flags;switch(o.tag){case 0:case 11:case 15:Uu(a,o,s,c,i),Sl(8,o);break;case 23:break;case 22:var u=o.stateNode;o.memoizedState===null?(u._visibility|=2,Uu(a,o,s,c,i)):u._visibility&2?Uu(a,o,s,c,i):G(a,o),i&&l&2048&&zu(o.alternate,o);break;case 24:Uu(a,o,s,c,i),i&&l&2048&&Bu(o.alternate,o);break;default:Uu(a,o,s,c,i)}t=t.sibling}}function G(e,t){if(t.subtreeFlags&10256)for(t=t.child;t!==null;){var n=e,r=t,i=r.flags;switch(r.tag){case 22:G(n,r),i&2048&&zu(r.alternate,r);break;case 24:G(n,r),i&2048&&Bu(r.alternate,r);break;default:G(n,r)}t=t.sibling}}var Wu=8192;function Gu(e,t,n){if(e.subtreeFlags&Wu)for(e=e.child;e!==null;)Ku(e,t,n),e=e.sibling}function Ku(e,t,n){switch(e.tag){case 26:Gu(e,t,n),e.flags&Wu&&(e.memoizedState===null?(e=e.stateNode,(t&335544128)===t&&Zm(n,e)):Qm(n,Au,e.memoizedState,e.memoizedProps));break;case 5:Gu(e,t,n),e.flags&Wu&&(e=e.stateNode,(t&335544128)===t&&Zm(n,e));break;case 3:case 4:var r=Au;Au=bm(e.stateNode.containerInfo),Gu(e,t,n),Au=r;break;case 22:e.memoizedState===null&&(r=e.alternate,r!==null&&r.memoizedState!==null?(r=Wu,Wu=16777216,Gu(e,t,n),Wu=r):Gu(e,t,n));break;case 30:if((e.flags&Wu)!==0&&(r=e.memoizedProps.name,r!=null&&r!==`auto`)){var i=e.stateNode;i.paired=null,Vl===null&&(Vl=new Map),Vl.set(r,i)}Gu(e,t,n);break;default:Gu(e,t,n)}}function qu(e){var t=e.alternate;if(t!==null&&(e=t.child,e!==null)){t.child=null;do t=e.sibling,e.sibling=null,e=t;while(e!==null)}}function Ju(e){var t=e.deletions;if(e.flags&16){if(t!==null)for(var n=0;n<t.length;n++){var r=t[n];lu=r,Zu(r,e)}qu(e)}if(e.subtreeFlags&10256)for(e=e.child;e!==null;)Yu(e),e=e.sibling}function Yu(e){switch(e.tag){case 0:case 11:case 15:Ju(e),e.flags&2048&&Cl(9,e,e.return);break;case 3:Ju(e);break;case 12:Ju(e);break;case 22:var t=e.stateNode;e.memoizedState!==null&&t._visibility&2&&(e.return===null||e.return.tag!==13)?(t._visibility&=-3,Xu(e)):Ju(e);break;default:Ju(e)}}function Xu(e){var t=e.deletions;if(e.flags&16){if(t!==null)for(var n=0;n<t.length;n++){var r=t[n];lu=r,Zu(r,e)}qu(e)}for(e=e.child;e!==null;){switch(t=e,t.tag){case 0:case 11:case 15:Cl(8,t,t.return),Xu(t);break;case 22:n=t.stateNode,n._visibility&2&&(n._visibility&=-3,Xu(t));break;default:Xu(t)}e=e.sibling}}function Zu(e,t){for(;lu!==null;){var n=lu;switch(n.tag){case 0:case 11:case 15:Cl(8,n,t);break;case 23:case 22:if(n.memoizedState!==null&&n.memoizedState.cachePool!==null){var r=n.memoizedState.cachePool.pool;r!=null&&r.refCount++}break;case 24:Pa(n.memoizedState.cache)}if(r=n.child,r!==null)r.return=n,lu=r;else a:for(n=e;lu!==null;){r=lu;var i=r.sibling,a=r.return;if(bu(r),r===n){lu=null;break a}if(i!==null){i.return=a,lu=i;break a}lu=a}}}var Qu={getCacheForType:function(e){var t=R(Ma),n=t.data.get(e);return n===void 0&&(n=e(),t.data.set(e,n)),n},cacheSignal:function(){return R(Ma).controller.signal}},$u=typeof WeakMap==`function`?WeakMap:Map,K=0,ed=null,q=null,J=0,Y=0,td=null,nd=!1,rd=!1,id=!1,ad=0,od=0,sd=0,cd=0,ld=0,ud=0,dd=0,fd=null,pd=null,md=!1,hd=0,gd=0,_d=1/0,vd=null,yd=null,bd=0,xd=null,Sd=null,Cd=0,wd=0,Td=null,Ed=null,Dd=null,Od=null,kd=null,Ad=0,jd=null;function Md(){return K&2&&J!==0?J&-J:j.T===null?xt():Pf()}function Nd(){if(ud===0)if(!(J&536870912)||I){var e=at;at<<=1,!(at&3932160)&&(at=262144),ud=e}else ud=536870912;return e=Mo.current,e!==null&&(e.flags|=32),ud}function Pd(e,t){if(t!=null){var n=e.stateNode,r=n.ref;r===null&&(r=n.ref=Pp(yi(e.memoizedProps,n))),Od===null&&(Od=[]),Od.push(t.bind(null,r))}}function Fd(e,t,n){(e===ed&&(Y===2||Y===9)||e.cancelPendingCommit!==null)&&(Hd(e,0),zd(e,J,ud,!1)),mt(e,n),(!(K&2)||e!==ed)&&(e===ed&&(!(K&2)&&(cd|=n),od===4&&zd(e,J,ud,!1)),Ef(e))}function Id(e,t,n){if(K&6)throw Error(i(327));var r=!n&&(t&127)==0&&(t&e.expiredLanes)===0||lt(e,t),a=r?Xd(e,t):Jd(e,t,!0),o=r;do{if(a===0){rd&&!r&&zd(e,t,0,!1);break}else{if(n=e.current.alternate,o&&!Rd(n)){a=Jd(e,t,!1),o=!1;continue}if(a===2){if(o=t,e.errorRecoveryDisabledLanes&o)var s=0;else s=e.pendingLanes&-536870913,s=s===0?s&536870912?536870912:0:s;if(s!==0){t=s;a:{var c=e;a=fd;var l=c.current.memoizedState.isDehydrated;if(l&&(Hd(c,s).flags|=256),s=Jd(c,s,!1),s!==2&&s!==6){if(id&&!l){c.errorRecoveryDisabledLanes|=o,cd|=o,a=4;break a}o=pd,pd=a,o!==null&&(pd===null?pd=o:pd.push.apply(pd,o))}a=s}if(o=!1,a!==2)continue}}if(a===1){Hd(e,0),zd(e,t,0,!0);break}a:{switch(r=e,o=a,o){case 0:case 1:throw Error(i(345));case 4:if((t&4194048)!==t&&(t&62914560)!==t)break;case 6:zd(r,t,ud,!nd);break a;case 2:pd=null;break;case 3:case 5:break;default:throw Error(i(329))}if((t&62914560)===t&&(a=hd+300-He(),10<a)){if(zd(r,t,ud,!nd),ct(r,0,!0)!==0)break a;Cd=t,r.timeoutHandle=gp(Ld.bind(null,r,n,pd,vd,md,t,ud,cd,dd,nd,o,`Throttled`,-0,0),a);break a}Ld(r,n,pd,vd,md,t,ud,cd,dd,nd,o,null,-0,0)}}break}while(1);Ef(e)}function Ld(e,t,n,r,i,a,o,s,c,l,u,d,f,p){e.timeoutHandle=-1;var m=t.subtreeFlags,h=(a&335544064)===a;if(d=null,(h||m&8192||(m&16785408)==16785408)&&(d={stylesheets:null,count:0,imgCount:0,imgBytes:0,suspenseyImages:[],waitingForImages:!0,waitingForViewTransition:!1,unsuspend:bn},Vl=null,Ku(t,a,d),h&&(m=d,h=e.containerInfo,h=(h.nodeType===9?h:h.ownerDocument).__reactViewTransition,h!=null&&(m.count++,m.waitingForViewTransition=!0,m=nh.bind(m),h.finished.then(m,m))),m=(a&62914560)===a?hd-He():(a&4194048)===a?gd-He():0,m=eh(d,m),m!==null)){Cd=a,e.cancelPendingCommit=m(rf.bind(null,e,t,a,n,r,i,o,s,c,l,u,d,null,f,p)),zd(e,a,o,!l);return}rf(e,t,a,n,r,i,o,s,c,l,u,d)}function Rd(e){for(var t=e;;){var n=t.tag;if((n===0||n===11||n===15)&&t.flags&16384&&(n=t.updateQueue,n!==null&&(n=n.stores,n!==null)))for(var r=0;r<n.length;r++){var i=n[r],a=i.getSnapshot;i=i.value;try{if(!Ur(a(),i))return!1}catch{return!1}}if(n=t.child,t.subtreeFlags&16384&&n!==null)n.return=t,t=n;else{if(t===e)break;for(;t.sibling===null;){if(t.return===null||t.return===e)return!0;t=t.return}t.sibling.return=t.return,t=t.sibling}}return!0}function zd(e,t,n,r){t=ut(e,t),t&=~ld,t&=~cd,e.suspendedLanes|=t,e.pingedLanes&=~t,r&&(e.warmLanes|=t),r=e.expirationTimes;for(var i=t;0<i;){var a=31-et(i),o=1<<a;r[a]=-1,i&=~o}n!==0&&gt(e,n,t)}function Bd(){return K&6?!0:(Df(0,!1),!1)}function Vd(){if(q!==null){if(Y===0)var e=q.return;else e=q,xa=ba=null,as(e),oo=null,so=0,e=q;for(;e!==null;)xl(e.alternate,e),e=e.return;q=null}}function Hd(e,t){var n=e.timeoutHandle;return n!==-1&&(e.timeoutHandle=-1,_p(n)),n=e.cancelPendingCommit,n!==null&&(e.cancelPendingCommit=null,n()),Cd=0,Vd(),ed=e,q=n=Fi(e.current,null),J=t,Y=0,td=null,nd=!1,rd=lt(e,t),id=!1,dd=ud=ld=cd=sd=od=0,pd=fd=null,md=!1,ad=ut(e,t),Ei(),n}function Ud(e,t){V=null,j.H=mc,t===Xa||t===Qa?(t=io(),Y=3):t===Za?(t=io(),Y=4):Y=t===Mc?8:typeof t==`object`&&t&&typeof t.then==`function`?6:1,td=t,q===null&&(od=1,Ec(e,Ui(t,e.current)))}function Wd(){var e=Mo.current;return e===null?!0:(J&4194048)===J?No===null:(J&62914560)===J||J&536870912?e===No:!1}function Gd(){var e=j.H;return j.H=mc,e===null?mc:e}function Kd(){var e=j.A;return j.A=Qu,e}function qd(){od=4,nd||(J&4194048)!==J&&Mo.current!==null||(rd=!0),!(sd&134217727)&&!(cd&134217727)||ed===null||zd(ed,J,ud,!1)}function Jd(e,t,n){var r=K;K|=2;var i=Gd(),a=Kd();(ed!==e||J!==t)&&(vd=null,Hd(e,t)),t=!1;var o=od;a:do try{if(Y!==0&&q!==null){var s=q,c=td;switch(Y){case 8:Vd(),o=6;break a;case 3:case 2:case 9:case 6:Mo.current===null&&(t=!0);var l=Y;if(Y=0,td=null,ef(e,s,c,l),n&&rd){o=0;break a}break;default:l=Y,Y=0,td=null,ef(e,s,c,l)}}Yd(),o=od;break}catch(t){Ud(e,t)}while(1);return t&&e.shellSuspendCounter++,xa=ba=null,K=r,j.H=i,j.A=a,q===null&&(ed=null,J=0,Ei()),o}function Yd(){for(;q!==null;)Qd(q)}function Xd(e,t){var n=K;K|=2;var r=Gd(),a=Kd();ed!==e||J!==t?(vd=null,_d=He()+500,Hd(e,t)):rd=lt(e,t);a:do try{if(Y!==0&&q!==null){t=q;var o=td;b:switch(Y){case 1:Y=0,td=null,ef(e,t,o,1);break;case 2:case 9:if(eo(o)){Y=0,td=null,$d(t);break}t=function(){Y!==2&&Y!==9||ed!==e||(Y=7),Ef(e)},o.then(t,t);break a;case 3:Y=7;break a;case 4:Y=5;break a;case 7:eo(o)?(Y=0,td=null,$d(t)):(Y=0,td=null,ef(e,t,o,7));break;case 5:var s=null;switch(q.tag){case 26:s=q.memoizedState;case 5:case 27:var c=q;if(s?Ym(s):c.stateNode.complete){Y=0,td=null;var l=c.sibling;if(l!==null)q=l;else{var u=c.return;u===null?q=null:(q=u,tf(u))}break b}}Y=0,td=null,ef(e,t,o,5);break;case 6:Y=0,td=null,ef(e,t,o,6);break;case 8:Vd(),od=6;break a;default:throw Error(i(462))}}Zd();break}catch(t){Ud(e,t)}while(1);return xa=ba=null,j.H=r,j.A=a,K=n,q===null?(ed=null,J=0,Ei(),od):0}function Zd(){for(;q!==null&&!Be();)Qd(q)}function Qd(e){var t=fl(e.alternate,e,ad);e.memoizedProps=e.pendingProps,t===null?tf(e):q=t}function $d(e){var t=e,n=t.alternate;switch(t.tag){case 15:case 0:t=Kc(n,t,t.pendingProps,t.type,void 0,J);break;case 11:t=Kc(n,t,t.pendingProps,t.type.render,t.ref,J);break;case 5:as(t);var r=t;r===ia&&(I?(da(r),r.tag===5&&r.stateNode!=null&&(aa=r.stateNode)):(da(r),I=!0));default:xl(n,t),t=q=Ii(t,ad),t=fl(n,t,ad)}e.memoizedProps=e.pendingProps,t===null?tf(e):q=t}function ef(e,t,n,r){xa=ba=null,as(t),oo=null,so=0;var i=t.return;try{if(jc(e,i,t,n,J)){od=1,Ec(e,Ui(n,e.current)),q=null;return}}catch(t){if(i!==null)throw q=i,t;od=1,Ec(e,Ui(n,e.current)),q=null;return}t.flags&32768?(I||r===1?e=!0:rd||J&536870912?e=!1:(nd=e=!0,(r===2||r===9||r===3||r===6)&&(r=Mo.current,r!==null&&r.tag===13&&(r.flags|=16384))),nf(t,e)):tf(t)}function tf(e){var t=e;do{if(t.flags&32768){nf(t,nd);return}e=t.return;var n=yl(t.alternate,t,ad);if(n!==null){q=n;return}if(t=t.sibling,t!==null){q=t;return}q=t=e}while(t!==null);od===0&&(od=5)}function nf(e,t){do{var n=bl(e.alternate,e);if(n!==null){n.flags&=32767,q=n;return}if(n=e.return,n!==null&&(n.flags|=32768,n.subtreeFlags=0,n.deletions=null),!t&&(e=e.sibling,e!==null)){q=e;return}q=e=n}while(e!==null);od=6,q=null}function rf(e,t,n,r,a,o,s,c,l,u,d,f){e.cancelPendingCommit=null;do df();while(bd!==0);if(K&6)throw Error(i(327));if(t!==null){if(t===e.current)throw Error(i(177));e===ed&&(q=ed=null,J=0),Sd=t,xd=e,Cd=n,Td=a,Ed=r,af(e,t,n,s,c,l,f)}}function af(e,t,n,r,i,a,o){var s=t.lanes|t.childLanes;if(wd=s,s|=Ti,ht(e,n,s,r,i,a),Od=null,(n&335544064)===n?(kd=La(e),r=10262):(kd=null,r=10256),(t.subtreeFlags&r)!==0||(t.flags&r)!==0?(e.callbackNode=null,e.callbackPriority=0,yf(Ke,function(){return ff(),null})):(e.callbackNode=null,e.callbackPriority=0),Bl=!1,r=(t.flags&13878)!=0,t.subtreeFlags&13878||r){r=j.T,j.T=null,i=M.p,M.p=2,a=K,K|=4;try{mu(e,t,n)}finally{K=a,M.p=i,j.T=r}}bd=1,Bl?Dd=Mp(o,e.containerInfo,kd,sf,cf,of,lf,ff,X,null,null):(sf(),cf(),lf())}function X(e){if(bd!==0){var t=xd.onRecoverableError;t(e,{componentStack:null})}}function of(){bd===3&&(bd=0,Fu(Sd,xd),bd=4)}function sf(){if(bd===1){bd=0;var e=xd,t=Sd,n=Cd,r=(t.flags&13878)!=0;if(t.subtreeFlags&13878||r){r=j.T,j.T=null;var i=M.p;M.p=2;var a=K;K|=4;try{du=fu=!1,ju(t,e,n),n=cp;var o=Yr(e.containerInfo),s=n.focusedElem,c=n.selectionRange;if(o!==s&&s&&s.ownerDocument&&Jr(s.ownerDocument.documentElement,s)){if(c!==null&&Xr(s)){var l=c.start,u=c.end;if(u===void 0&&(u=l),`selectionStart`in s)s.selectionStart=l,s.selectionEnd=Math.min(u,s.value.length);else{var d=s.ownerDocument||document,f=d&&d.defaultView||window;if(f.getSelection){var p=f.getSelection(),m=s.textContent.length,h=Math.min(c.start,m),g=c.end===void 0?h:Math.min(c.end,m);!p.extend&&h>g&&(o=g,g=h,h=o);var _=qr(s,h),v=qr(s,g);if(_&&v&&(p.rangeCount!==1||p.anchorNode!==_.node||p.anchorOffset!==_.offset||p.focusNode!==v.node||p.focusOffset!==v.offset)){var y=d.createRange();y.setStart(_.node,_.offset),p.removeAllRanges(),h>g?(p.addRange(y),p.extend(v.node,v.offset)):(y.setEnd(v.node,v.offset),p.addRange(y))}}}}for(d=[],p=s;p=p.parentNode;)p.nodeType===1&&d.push({element:p,left:p.scrollLeft,top:p.scrollTop});for(typeof s.focus==`function`&&s.focus(),s=0;s<d.length;s++){var b=d[s];b.element.scrollLeft=b.left,b.element.scrollTop=b.top}}gh=!!sp,cp=sp=null}finally{K=a,M.p=i,j.T=r}}e.current=t,bd=2}}function cf(){if(bd===2){bd=0;var e=xd,t=Sd,n=(t.flags&8772)!=0;if(t.subtreeFlags&8772||n){n=j.T,j.T=null;var r=M.p;M.p=2;var i=K;K|=4;try{gu(e,t.alternate,t)}finally{K=i,M.p=r,j.T=n}}bd=3}}function lf(){if(bd===4||bd===3){bd=0;var e=Dd;Dd=null,Ve();var t=xd,n=Sd,r=Cd,i=Ed,a=(r&335544064)===r?10262:10256;if((n.subtreeFlags&a)!==0||(n.flags&a)!==0?bd=5:(bd=0,Sd=xd=null,uf(t,t.pendingLanes)),a=t.pendingLanes,a===0&&(yd=null),bt(r),n=n.stateNode,Qe&&typeof Qe.onCommitFiberRoot==`function`)try{Qe.onCommitFiberRoot(Ze,n,void 0,(n.current.flags&128)==128)}catch{}if(i!==null){n=j.T,a=M.p,M.p=2,j.T=null;try{for(var o=t.onRecoverableError,s=0;s<i.length;s++){var c=i[s];o(c.value,{componentStack:c.stack})}}finally{j.T=n,M.p=a}}if(i=Od,o=kd,kd=null,i!==null&&(Od=null,o===null&&(o=[]),e!==null))for(c=0;c<i.length;c++)n=(0,i[c])(o),n!==void 0&&e.finished.finally(n);Cd&3&&df(),Ef(t),a=t.pendingLanes,r&261930&&a&42?t===jd?Ad++:(Ad=0,jd=t):(Ad=0,jd=null),Df(0,!1)}}function uf(e,t){(e.pooledCacheLanes&=t)===0&&(t=e.pooledCache,t!=null&&(e.pooledCache=null,Pa(t)))}function df(){return Dd!==null&&(Dd.skipTransition(),Dd=null),sf(),cf(),lf(),ff()}function ff(){if(bd!==5)return!1;var e=xd,t=wd;wd=0;var n=bt(Cd),r=j.T,a=M.p;try{M.p=32>n?32:n,j.T=null,n=Td,Td=null;var o=xd,s=Cd;if(bd=0,Sd=xd=null,Cd=0,K&6)throw Error(i(331));var c=K;if(K|=4,Yu(o.current),Hu(o,o.current,s,n),K=c,Df(0,!1),Qe&&typeof Qe.onPostCommitFiberRoot==`function`)try{Qe.onPostCommitFiberRoot(Ze,o)}catch{}return!0}finally{M.p=a,j.T=r,uf(e,t)}}function pf(e,t,n){t=Ui(n,t),t=Oc(e.stateNode,t,2),e=yo(e,t,2),e!==null&&(mt(e,2),Ef(e))}function Z(e,t,n){if(e.tag===3)pf(e,e,n);else for(;t!==null;){if(t.tag===3){pf(t,e,n);break}else if(t.tag===1){var r=t.stateNode;if(typeof t.type.getDerivedStateFromError==`function`||typeof r.componentDidCatch==`function`&&(yd===null||!yd.has(r))){e=Ui(n,e),n=kc(2),r=yo(t,n,2),r!==null&&(Ac(n,r,t,e),mt(r,2),Ef(r));break}}t=t.return}}function mf(e,t,n){var r=e.pingCache;if(r===null){r=e.pingCache=new $u;var i=new Set;r.set(t,i)}else i=r.get(t),i===void 0&&(i=new Set,r.set(t,i));i.has(n)||(id=!0,i.add(n),e=hf.bind(null,e,t,n),t.then(e,e))}function hf(e,t,n){var r=e.pingCache;r!==null&&r.delete(t),e.pingedLanes|=e.suspendedLanes&n,e.warmLanes&=~n,ed===e&&(J&n)===n&&(od===4||od===3&&(J&62914560)===J&&300>He()-hd?K&2?ld|=n:Hd(e,0):ld|=n,dd===J&&(dd=0)),Ef(e)}function gf(e,t){t===0&&(t=ft()),e=ki(e,t),e!==null&&(mt(e,t),Ef(e))}function _f(e){var t=e.memoizedState,n=0;t!==null&&(n=t.retryLane),gf(e,n)}function vf(e,t){var n=0;switch(e.tag){case 31:case 13:var r=e.stateNode,a=e.memoizedState;a!==null&&(n=a.retryLane);break;case 19:r=e.stateNode;break;case 22:r=e.stateNode._retryCache;break;default:throw Error(i(314))}r!==null&&r.delete(t),gf(e,n)}function yf(e,t){return Re(e,t)}var bf=null,xf=null,Sf=!1,Cf=!1,wf=!1,Tf=0;function Ef(e){e!==xf&&e.next===null&&(xf===null?bf=xf=e:xf=xf.next=e),Cf=!0,Sf||(Sf=!0,Nf())}function Df(e,t){if(!wf&&Cf){wf=!0;do for(var n=!1,r=bf;r!==null;){if(!t)if(e!==0){var i=r.pendingLanes;if(i===0)var a=0;else{var o=r.suspendedLanes,s=r.pingedLanes;a=(1<<31-et(42|e)+1)-1,a&=i&~(o&~s),a=a&201326741?a&201326741|1:a?a|2:0}a!==0&&(n=!0,Mf(r,a))}else a=J,a=ct(r,r===ed?a:0,r.cancelPendingCommit!==null||r.timeoutHandle!==-1),!(a&3)||lt(r,a)||(n=!0,Mf(r,a));r=r.next}while(n);wf=!1}}function Of(){kf()}function kf(){Cf=Sf=!1;var e=0;Tf!==0&&hp()&&(e=Tf);for(var t=He(),n=null,r=bf;r!==null;){var i=r.next,a=Af(r,t);a===0?(r.next=null,n===null?bf=i:n.next=i,i===null&&(xf=n)):(n=r,(e!==0||a&3)&&(Cf=!0)),r=i}bd!==0&&bd!==5||Df(e,!1),Tf!==0&&(Tf=0)}function Af(e,t){for(var n=e.suspendedLanes,r=e.pingedLanes,i=e.expirationTimes,a=e.pendingLanes&-62914561;0<a;){var o=31-et(a),s=1<<o,c=i[o];c===-1?((s&n)===0||(s&r)!==0)&&(i[o]=dt(s,t)):c<=t&&(e.expiredLanes|=s),a&=~s}if(t=ed,n=J,n=ct(e,e===t?n:0,e.cancelPendingCommit!==null||e.timeoutHandle!==-1),r=e.callbackNode,n===0||e===t&&(Y===2||Y===9)||e.cancelPendingCommit!==null)return r!==null&&r!==null&&ze(r),e.callbackNode=null,e.callbackPriority=0;if(!(n&3)||lt(e,n)){if(t=n&-n,t===e.callbackPriority)return t;switch(r!==null&&ze(r),bt(n)){case 2:case 8:n=Ge;break;case 32:n=Ke;break;case 268435456:n=Je;break;default:n=Ke}return r=jf.bind(null,e),n=Re(n,r),e.callbackPriority=t,e.callbackNode=n,t}return r!==null&&r!==null&&ze(r),e.callbackPriority=2,e.callbackNode=null,2}function jf(e,t){if(bd!==0&&bd!==5)return e.callbackNode=null,e.callbackPriority=0,null;var n=e.callbackNode;if(df()&&e.callbackNode!==n)return null;var r=J;return r=ct(e,e===ed?r:0,e.cancelPendingCommit!==null||e.timeoutHandle!==-1),r===0?null:(Id(e,r,t),Af(e,He()),e.callbackNode!=null&&e.callbackNode===n?jf.bind(null,e):null)}function Mf(e,t){if(df())return null;Id(e,t,!0)}function Nf(){bp(function(){K&6?Re(We,Of):kf()})}function Pf(){if(Tf===0){var e=Ba;e===0&&(e=it,it<<=1,!(it&261888)&&(it=256)),Tf=e}return Tf}function Ff(e){return e==null||typeof e==`symbol`||typeof e==`boolean`?null:typeof e==`function`?e:yn(e)}function If(e,t,n,r,i){if(t===`submit`&&n&&n.stateNode===i){var a=Ff((i[Tt]||null).action),o=r.submitter;o&&(t=(t=o[Tt]||null)?Ff(t.formAction):o.getAttribute(`formAction`),t!==null&&(a=t,o=null));var s=new Vn(`action`,`action`,null,r,i);e.push({event:s,listeners:[{instance:null,listener:function(){if(r.defaultPrevented){if(Tf!==0){var e=new FormData(i,o);U(n,{pending:!0,data:e,method:i.method,action:a},null,e)}}else typeof a==`function`&&(s.preventDefault(),e=new FormData(i,o),U(n,{pending:!0,data:e,method:i.method,action:a},a,e))},currentTarget:i}]})}}for(var Lf=0;Lf<gi.length;Lf++){var Rf=gi[Lf];_i(Rf.toLowerCase(),`on`+(Rf[0].toUpperCase()+Rf.slice(1)))}_i(ci,`onAnimationEnd`),_i(li,`onAnimationIteration`),_i(ui,`onAnimationStart`),_i(`dblclick`,`onDoubleClick`),_i(`focusin`,`onFocus`),_i(`focusout`,`onBlur`),_i(di,`onTransitionRun`),_i(fi,`onTransitionStart`),_i(pi,`onTransitionCancel`),_i(mi,`onTransitionEnd`),Ut(`onMouseEnter`,[`mouseout`,`mouseover`]),Ut(`onMouseLeave`,[`mouseout`,`mouseover`]),Ut(`onPointerEnter`,[`pointerout`,`pointerover`]),Ut(`onPointerLeave`,[`pointerout`,`pointerover`]),Ht(`onChange`,`change click focusin focusout input keydown keyup selectionchange`.split(` `)),Ht(`onSelect`,`focusout contextmenu dragend focusin keydown keyup mousedown mouseup selectionchange`.split(` `)),Ht(`onBeforeInput`,[`compositionend`,`keypress`,`textInput`,`paste`]),Ht(`onCompositionEnd`,`compositionend focusout keydown keypress keyup mousedown`.split(` `)),Ht(`onCompositionStart`,`compositionstart focusout keydown keypress keyup mousedown`.split(` `)),Ht(`onCompositionUpdate`,`compositionupdate focusout keydown keypress keyup mousedown`.split(` `));var zf=`abort canplay canplaythrough durationchange emptied encrypted ended error loadeddata loadedmetadata loadstart pause play playing progress ratechange resize seeked seeking stalled suspend timeupdate volumechange waiting`.split(` `),Bf=new Set(`beforetoggle cancel close invalid load scroll scrollend toggle`.split(` `).concat(zf));function Vf(e,t){t=(t&4)!=0;for(var n=0;n<e.length;n++){var r=e[n],i=r.event;r=r.listeners;a:{var a=void 0;if(t)for(var o=r.length-1;0<=o;o--){var s=r[o],c=s.instance,l=s.currentTarget;if(s=s.listener,c!==a&&i.isPropagationStopped())break a;a=s,i.currentTarget=l;try{a(i)}catch(e){Si(e)}i.currentTarget=null,a=c}else for(o=0;o<r.length;o++){if(s=r[o],c=s.instance,l=s.currentTarget,s=s.listener,c!==a&&i.isPropagationStopped())break a;a=s,i.currentTarget=l;try{a(i)}catch(e){Si(e)}i.currentTarget=null,a=c}}}}function Q(e,t){var n=t[Dt];n===void 0&&(n=t[Dt]=new Set);var r=e+`__bubble`;n.has(r)||(Gf(t,e,2,!1),n.add(r))}function Hf(e,t,n){var r=0;t&&(r|=4),Gf(n,e,r,t)}var Uf=`_reactListening`+Math.random().toString(36).slice(2);function Wf(e){if(!e[Uf]){e[Uf]=!0,Bt.forEach(function(t){t!==`selectionchange`&&(Bf.has(t)||Hf(t,!1,e),Hf(t,!0,e))});var t=e.nodeType===9?e:e.ownerDocument;t===null||t[Uf]||(t[Uf]=!0,Hf(`selectionchange`,!1,t))}}function Gf(e,t,n,r){switch(Ch(t)){case 2:var i=_h;break;case 8:i=vh;break;default:i=yh}n=i.bind(null,t,n,e),i=void 0,!An||t!==`touchstart`&&t!==`touchmove`&&t!==`wheel`||(i=!0),r?i===void 0?e.addEventListener(t,n,!0):e.addEventListener(t,n,{capture:!0,passive:i}):i===void 0?e.addEventListener(t,n,!1):e.addEventListener(t,n,{passive:i})}function Kf(e,t,n,r,i){var a=r;if(!(t&1)&&!(t&2)&&r!==null)a:for(;;){if(r===null)return;var s=r.tag;if(s===3||s===4){var c=r.stateNode.containerInfo;if(c===i)break;if(s===4)for(s=r.return;s!==null;){var l=s.tag;if((l===3||l===4)&&s.stateNode.containerInfo===i)return;s=s.return}for(;c!==null;){if(s=Pt(c),s===null)return;if(l=s.tag,l===5||l===6||l===26||l===27){r=a=s;continue a}c=c.parentNode}}r=r.return}Dn(function(){var r=a,i=Sn(n),s=[];a:{var c=hi.get(e);if(c!==void 0){var l=Vn,u=e;switch(e){case`keypress`:if(In(n)===0)break a;case`keydown`:case`keyup`:l=ar;break;case`focusin`:u=`focus`,l=Xn;break;case`focusout`:u=`blur`,l=Xn;break;case`beforeblur`:case`afterblur`:l=Xn;break;case`click`:if(n.button===2)break a;case`auxclick`:case`dblclick`:case`mousedown`:case`mousemove`:case`mouseup`:case`mouseout`:case`mouseover`:case`contextmenu`:l=Jn;break;case`drag`:case`dragend`:case`dragenter`:case`dragexit`:case`dragleave`:case`dragover`:case`dragstart`:case`drop`:l=Yn;break;case`touchcancel`:case`touchend`:case`touchmove`:case`touchstart`:l=cr;break;case ci:case li:case ui:l=Zn;break;case mi:l=lr;break;case`scroll`:case`scrollend`:l=Un;break;case`wheel`:l=ur;break;case`copy`:case`cut`:case`paste`:l=Qn;break;case`gotpointercapture`:case`lostpointercapture`:case`pointercancel`:case`pointerdown`:case`pointermove`:case`pointerout`:case`pointerover`:case`pointerup`:l=or;break;case`submit`:l=sr;break;case`toggle`:case`beforetoggle`:l=dr}var d=(t&4)!=0,f=!d&&(e===`scroll`||e===`scrollend`),p=d?c===null?null:c+`Capture`:c;d=[];for(var m=r,h;m!==null;){var g=m;if(h=g.stateNode,g=g.tag,g!==5&&g!==26&&g!==27||h===null||p===null||(g=On(m,p),g!=null&&d.push(qf(m,g,h))),f)break;m=m.return}0<d.length&&(c=new l(c,u,null,n,i),s.push({event:c,listeners:d}))}}if(!(t&7)){a:{if(l=e===`mouseover`||e===`pointerover`,c=e===`mouseout`||e===`pointerout`,l&&n!==xn&&(u=n.relatedTarget||n.fromElement)&&(Pt(u)||u[Et]))break a;(c||l)&&(u=i.window===i?i:(l=i.ownerDocument)?l.defaultView||l.parentWindow:window,c?(l=n.relatedTarget||n.toElement,c=r,l=l?Pt(l):null,l!==null&&(f=o(l),d=l.tag,l!==f||d!==5&&d!==27&&d!==6)&&(l=null)):(c=null,l=r),c!==l&&(d=Jn,g=`onMouseLeave`,p=`onMouseEnter`,m=`mouse`,(e===`pointerout`||e===`pointerover`)&&(d=or,g=`onPointerLeave`,p=`onPointerEnter`,m=`pointer`),f=c==null?u:It(c),h=l==null?u:It(l),u=new d(g,m+`leave`,c,n,i),u.target=f,u.relatedTarget=h,g=null,Pt(i)===r&&(d=new d(p,m+`enter`,l,n,i),d.target=h,d.relatedTarget=f,g=d),f=g,d=c&&l?C(c,l,Yf):null,c!==null&&Xf(s,u,c,d,!1),l!==null&&f!==null&&Xf(s,f,l,d,!0)))}a:{if(c=r?It(r):window,l=c.nodeName&&c.nodeName.toLowerCase(),l===`select`||l===`input`&&c.type===`file`)var _=jr;else if(Tr(c))if(Mr)_=Vr;else{_=zr;var v=Rr}else l=c.nodeName,!l||l.toLowerCase()!==`input`||c.type!==`checkbox`&&c.type!==`radio`?r&&gn(r.elementType)&&(_=jr):_=Br;if(_&&=_(e,r)){Er(s,_,n,i);break a}v&&v(e,c,r)}switch(v=r?It(r):window,e){case`focusin`:(Tr(v)||v.contentEditable===`true`)&&(Qr=v,$r=r,ei=null);break;case`focusout`:ei=$r=Qr=null;break;case`mousedown`:ti=!0;break;case`contextmenu`:case`mouseup`:case`dragend`:ti=!1,ni(s,n,i);break;case`selectionchange`:if(Zr)break;case`keydown`:case`keyup`:ni(s,n,i)}var y;if(pr)b:{switch(e){case`compositionstart`:var b=`onCompositionStart`;break b;case`compositionend`:b=`onCompositionEnd`;break b;case`compositionupdate`:b=`onCompositionUpdate`;break b}b=void 0}else xr?yr(e,n)&&(b=`onCompositionEnd`):e===`keydown`&&n.keyCode===229&&(b=`onCompositionStart`);b&&(gr&&n.locale!==`ko`&&(xr||b!==`onCompositionStart`?b===`onCompositionEnd`&&xr&&(y=Fn()):(Mn=i,Nn=`value`in Mn?Mn.value:Mn.textContent,xr=!0)),v=Jf(r,b),0<v.length&&(b=new $n(b,e,null,n,i),s.push({event:b,listeners:v}),y?b.data=y:(y=br(n),y!==null&&(b.data=y)))),(y=hr?Sr(e,n):Cr(e,n))&&(b=Jf(r,`onBeforeInput`),0<b.length&&(v=new $n(`onBeforeInput`,`beforeinput`,null,n,i),s.push({event:v,listeners:b}),v.data=y)),If(s,e,r,n,i)}Vf(s,t)})}function qf(e,t,n){return{instance:e,listener:t,currentTarget:n}}function Jf(e,t){for(var n=t+`Capture`,r=[];e!==null;){var i=e,a=i.stateNode;if(i=i.tag,i!==5&&i!==26&&i!==27||a===null||(i=On(e,n),i!=null&&r.unshift(qf(e,i,a)),i=On(e,t),i!=null&&r.push(qf(e,i,a))),e.tag===3)return r;e=e.return}return[]}function Yf(e){if(e===null)return null;do e=e.return;while(e&&e.tag!==5&&e.tag!==27);return e||null}function Xf(e,t,n,r,i){for(var a=t._reactName,o=[];n!==null&&n!==r;){var s=n,c=s.alternate,l=s.stateNode;if(s=s.tag,c!==null&&c===r)break;s!==5&&s!==26&&s!==27||l===null||(c=l,i?(l=On(n,a),l!=null&&o.unshift(qf(n,l,c))):i||(l=On(n,a),l!=null&&o.push(qf(n,l,c)))),n=n.return}o.length!==0&&e.push({event:t,listeners:o})}var Zf=/\r\n?/g,Qf=/\u0000|\uFFFD/g;function $f(e){return(typeof e==`string`?e:``+e).replace(Zf,`
`).replace(Qf,``)}function ep(e,t){return t=$f(t),$f(e)===t}function $(e,t,n,r,a,o){switch(n){case`children`:if(typeof r==`string`)t===`body`||t===`textarea`&&r===``||fn(e,r);else if(typeof r==`number`||typeof r==`bigint`)t!==`body`&&fn(e,``+r);else return;break;case`className`:Xt(e,`class`,r);break;case`tabIndex`:Xt(e,`tabindex`,r);break;case`dir`:case`role`:case`viewBox`:case`width`:case`height`:Xt(e,n,r);break;case`style`:hn(e,r,o);return;case`data`:if(t!==`object`){Xt(e,`data`,r);break}case`src`:case`href`:if(r===``&&(t!==`a`||n!==`href`)){e.removeAttribute(n);break}if(r==null||typeof r==`function`||typeof r==`symbol`||typeof r==`boolean`){e.removeAttribute(n);break}r=yn(r),e.setAttribute(n,r);break;case`action`:case`formAction`:if(typeof r==`function`){e.setAttribute(n,`javascript:throw new Error('A React form was unexpectedly submitted. If you called form.submit() manually, consider using form.requestSubmit() instead. If you\\'re trying to use event.stopPropagation() in a submit event handler, consider also calling event.preventDefault().')`);break}else typeof o==`function`&&(n===`formAction`?(t!==`input`&&$(e,t,`name`,a.name,a,null),$(e,t,`formEncType`,a.formEncType,a,null),$(e,t,`formMethod`,a.formMethod,a,null),$(e,t,`formTarget`,a.formTarget,a,null)):($(e,t,`encType`,a.encType,a,null),$(e,t,`method`,a.method,a,null),$(e,t,`target`,a.target,a,null)));if(r==null||typeof r==`symbol`||typeof r==`boolean`){e.removeAttribute(n);break}r=yn(r),e.setAttribute(n,r);break;case`onClick`:r!=null&&(e.onclick=bn);return;case`onScroll`:r!=null&&Q(`scroll`,e);return;case`onScrollEnd`:r!=null&&Q(`scrollend`,e);return;case`dangerouslySetInnerHTML`:if(r!=null){if(typeof r!=`object`||!(`__html`in r))throw Error(i(61));if(n=r.__html,n!=null){if(a.children!=null)throw Error(i(60));o?.__html!==n&&(e.innerHTML=n)}}break;case`multiple`:e.multiple=r&&typeof r!=`function`&&typeof r!=`symbol`;break;case`muted`:e.muted=r&&typeof r!=`function`&&typeof r!=`symbol`;break;case`suppressContentEditableWarning`:case`suppressHydrationWarning`:case`defaultValue`:case`defaultChecked`:case`innerHTML`:case`ref`:break;case`autoFocus`:break;case`xlinkHref`:if(r==null||typeof r==`function`||typeof r==`boolean`||typeof r==`symbol`){e.removeAttribute(`xlink:href`);break}n=yn(r),e.setAttributeNS(`http://www.w3.org/1999/xlink`,`xlink:href`,n);break;case`contentEditable`:case`spellCheck`:case`draggable`:case`value`:case`autoReverse`:case`externalResourcesRequired`:case`focusable`:case`preserveAlpha`:r!=null&&typeof r!=`function`&&typeof r!=`symbol`?e.setAttribute(n,r):e.removeAttribute(n);break;case`inert`:case`allowFullScreen`:case`async`:case`autoPlay`:case`controls`:case`credentialless`:case`default`:case`defer`:case`disabled`:case`disablePictureInPicture`:case`disableRemotePlayback`:case`formNoValidate`:case`hidden`:case`loop`:case`noModule`:case`noValidate`:case`open`:case`playsInline`:case`readOnly`:case`required`:case`reversed`:case`scoped`:case`seamless`:case`itemScope`:r&&typeof r!=`function`&&typeof r!=`symbol`?e.setAttribute(n,``):e.removeAttribute(n);break;case`capture`:case`download`:!0===r?e.setAttribute(n,``):!1!==r&&r!=null&&typeof r!=`function`&&typeof r!=`symbol`?e.setAttribute(n,r):e.removeAttribute(n);break;case`cols`:case`rows`:case`size`:case`span`:r!=null&&typeof r!=`function`&&typeof r!=`symbol`&&!isNaN(r)&&1<=r?e.setAttribute(n,r):e.removeAttribute(n);break;case`rowSpan`:case`start`:r==null||typeof r==`function`||typeof r==`symbol`||isNaN(r)?e.removeAttribute(n):e.setAttribute(n,r);break;case`popover`:Q(`beforetoggle`,e),Q(`toggle`,e),Yt(e,`popover`,r);break;case`xlinkActuate`:Zt(e,`http://www.w3.org/1999/xlink`,`xlink:actuate`,r);break;case`xlinkArcrole`:Zt(e,`http://www.w3.org/1999/xlink`,`xlink:arcrole`,r);break;case`xlinkRole`:Zt(e,`http://www.w3.org/1999/xlink`,`xlink:role`,r);break;case`xlinkShow`:Zt(e,`http://www.w3.org/1999/xlink`,`xlink:show`,r);break;case`xlinkTitle`:Zt(e,`http://www.w3.org/1999/xlink`,`xlink:title`,r);break;case`xlinkType`:Zt(e,`http://www.w3.org/1999/xlink`,`xlink:type`,r);break;case`xmlBase`:Zt(e,`http://www.w3.org/XML/1998/namespace`,`xml:base`,r);break;case`xmlLang`:Zt(e,`http://www.w3.org/XML/1998/namespace`,`xml:lang`,r);break;case`xmlSpace`:Zt(e,`http://www.w3.org/XML/1998/namespace`,`xml:space`,r);break;case`is`:Yt(e,`is`,r);break;case`innerText`:case`textContent`:return;default:if(!(2<n.length)||n[0]!==`o`&&n[0]!==`O`||n[1]!==`n`&&n[1]!==`N`)n=_n.get(n)||n,Yt(e,n,r);else return}P=!0}function tp(e,t,n,r,a,o){switch(n){case`style`:hn(e,r,o);return;case`dangerouslySetInnerHTML`:if(r!=null){if(typeof r!=`object`||!(`__html`in r))throw Error(i(61));if(n=r.__html,n!=null){if(a.children!=null)throw Error(i(60));o?.__html!==n&&(e.innerHTML=n)}}break;case`children`:if(typeof r==`string`)fn(e,r);else if(typeof r==`number`||typeof r==`bigint`)fn(e,``+r);else return;break;case`onScroll`:r!=null&&Q(`scroll`,e);return;case`onScrollEnd`:r!=null&&Q(`scrollend`,e);return;case`onClick`:r!=null&&(e.onclick=bn);return;case`suppressContentEditableWarning`:case`suppressHydrationWarning`:case`innerHTML`:case`ref`:return;case`innerText`:case`textContent`:return;default:if(!Vt.hasOwnProperty(n))a:{if(n[0]===`o`&&n[1]===`n`&&(a=n.endsWith(`Capture`),o=n.slice(2,a?n.length-7:void 0),t=e[Tt]||null,t=t==null?null:t[n],typeof t==`function`&&e.removeEventListener(o,t,a),typeof r==`function`)){typeof t!=`function`&&t!==null&&(n in e?e[n]=null:e.hasAttribute(n)&&e.removeAttribute(n)),e.addEventListener(o,r,a);break a}P=!0,n in e?e[n]=r:!0===r?e.setAttribute(n,``):Yt(e,n,r)}return}P=!0}function np(e,t,n){switch(t){case`div`:case`span`:case`svg`:case`path`:case`a`:case`g`:case`p`:case`li`:break;case`img`:Q(`error`,e),Q(`load`,e);var r=!1,a=!1,o;for(o in n)if(n.hasOwnProperty(o)){var s=n[o];if(s!=null)switch(o){case`src`:r=!0;break;case`srcSet`:a=!0;break;case`children`:case`dangerouslySetInnerHTML`:throw Error(i(137,t));default:$(e,t,o,s,n,null)}}a&&$(e,t,`srcSet`,n.srcSet,n,null),r&&$(e,t,`src`,n.src,n,null);return;case`input`:Q(`invalid`,e);var c=o=s=a=null,l=null,u=null;for(r in n)if(n.hasOwnProperty(r)){var d=n[r];if(d!=null)switch(r){case`name`:a=d;break;case`type`:s=d;break;case`checked`:l=d;break;case`defaultChecked`:u=d;break;case`value`:o=d;break;case`defaultValue`:c=d;break;case`children`:case`dangerouslySetInnerHTML`:if(d!=null)throw Error(i(137,t));break;default:$(e,t,r,d,n,null)}}sn(e,o,c,l,u,s,a,!1);return;case`select`:for(a in Q(`invalid`,e),r=s=o=null,n)if(n.hasOwnProperty(a)&&(c=n[a],c!=null))switch(a){case`value`:o=c;break;case`defaultValue`:s=c;break;case`multiple`:r=c;default:$(e,t,a,c,n,null)}t=o,n=s,e.multiple=!!r,t==null?n!=null&&ln(e,!!r,n,!0):ln(e,!!r,t,!1);return;case`textarea`:for(s in Q(`invalid`,e),o=a=r=null,n)if(n.hasOwnProperty(s)&&(c=n[s],c!=null))switch(s){case`value`:r=c;break;case`defaultValue`:a=c;break;case`children`:o=c;break;case`dangerouslySetInnerHTML`:if(c!=null)throw Error(i(91));break;default:$(e,t,s,c,n,null)}dn(e,r,a,o);return;case`option`:for(l in n)if(n.hasOwnProperty(l)&&(r=n[l],r!=null))switch(l){case`selected`:e.selected=r&&typeof r!=`function`&&typeof r!=`symbol`;break;default:$(e,t,l,r,n,null)}return;case`dialog`:Q(`beforetoggle`,e),Q(`toggle`,e),Q(`cancel`,e),Q(`close`,e);break;case`iframe`:case`object`:Q(`load`,e);break;case`video`:case`audio`:for(r=0;r<zf.length;r++)Q(zf[r],e);break;case`image`:Q(`error`,e),Q(`load`,e);break;case`details`:Q(`toggle`,e);break;case`embed`:case`source`:case`link`:Q(`error`,e),Q(`load`,e);case`area`:case`base`:case`br`:case`col`:case`hr`:case`keygen`:case`meta`:case`param`:case`track`:case`wbr`:case`menuitem`:for(u in n)if(n.hasOwnProperty(u)&&(r=n[u],r!=null))switch(u){case`children`:case`dangerouslySetInnerHTML`:throw Error(i(137,t));default:$(e,t,u,r,n,null)}return;default:if(gn(t)){for(d in n)n.hasOwnProperty(d)&&(r=n[d],r!==void 0&&tp(e,t,d,r,n,void 0));return}}for(c in n)n.hasOwnProperty(c)&&(r=n[c],r!=null&&$(e,t,c,r,n,null))}var rp={};function ip(e,t,n,r){switch(t){case`div`:case`span`:case`svg`:case`path`:case`a`:case`g`:case`p`:case`li`:break;case`input`:var a=null,o=null,s=null,c=null,l=null,u=null,d=null;for(m in n){var f=n[m];if(n.hasOwnProperty(m)&&f!=null)switch(m){case`checked`:break;case`value`:break;case`defaultValue`:l=f;default:r.hasOwnProperty(m)||$(e,t,m,null,r,f)}}for(var p in r){var m=r[p];if(f=n[p],r.hasOwnProperty(p)&&(m!=null||f!=null))switch(p){case`type`:m!==f&&(P=!0),o=m;break;case`name`:m!==f&&(P=!0),a=m;break;case`checked`:m!==f&&(P=!0),u=m;break;case`defaultChecked`:m!==f&&(P=!0),d=m;break;case`value`:m!==f&&(P=!0),s=m;break;case`defaultValue`:m!==f&&(P=!0),c=m;break;case`children`:case`dangerouslySetInnerHTML`:if(m!=null)throw Error(i(137,t));break;default:m!==f&&$(e,t,p,m,r,f)}}on(e,s,c,l,u,d,o,a);return;case`select`:for(o in m=s=c=p=null,n)if(l=n[o],n.hasOwnProperty(o)&&l!=null)switch(o){case`value`:break;case`multiple`:m=l;default:r.hasOwnProperty(o)||$(e,t,o,null,r,l)}for(a in r)if(o=r[a],l=n[a],r.hasOwnProperty(a)&&(o!=null||l!=null))switch(a){case`value`:o!==l&&(P=!0),p=o;break;case`defaultValue`:o!==l&&(P=!0),c=o;break;case`multiple`:o!==l&&(P=!0),s=o;default:o!==l&&$(e,t,a,o,r,l)}t=c,n=s,r=m,p==null?!!r!=!!n&&(t==null?ln(e,!!n,n?[]:``,!1):ln(e,!!n,t,!0)):ln(e,!!n,p,!1);return;case`textarea`:for(c in m=p=null,n)if(a=n[c],n.hasOwnProperty(c)&&a!=null&&!r.hasOwnProperty(c))switch(c){case`value`:break;case`children`:break;default:$(e,t,c,null,r,a)}for(s in r)if(a=r[s],o=n[s],r.hasOwnProperty(s)&&(a!=null||o!=null))switch(s){case`value`:a!==o&&(P=!0),p=a;break;case`defaultValue`:a!==o&&(P=!0),m=a;break;case`children`:break;case`dangerouslySetInnerHTML`:if(a!=null)throw Error(i(91));break;default:a!==o&&$(e,t,s,a,r,o)}un(e,p,m);return;case`option`:for(var h in n)if(p=n[h],n.hasOwnProperty(h)&&p!=null&&!r.hasOwnProperty(h))switch(h){case`selected`:e.selected=!1;break;default:$(e,t,h,null,r,p)}for(l in r)if(p=r[l],m=n[l],r.hasOwnProperty(l)&&p!==m&&(p!=null||m!=null))switch(l){case`selected`:p!==m&&(P=!0),e.selected=p&&typeof p!=`function`&&typeof p!=`symbol`;break;default:$(e,t,l,p,r,m)}return;case`img`:case`link`:case`area`:case`base`:case`br`:case`col`:case`embed`:case`hr`:case`keygen`:case`meta`:case`param`:case`source`:case`track`:case`wbr`:case`menuitem`:for(var g in n)p=n[g],n.hasOwnProperty(g)&&p!=null&&!r.hasOwnProperty(g)&&$(e,t,g,null,r,p);for(u in r)if(p=r[u],m=n[u],r.hasOwnProperty(u)&&p!==m&&(p!=null||m!=null))switch(u){case`children`:case`dangerouslySetInnerHTML`:if(p!=null)throw Error(i(137,t));break;default:$(e,t,u,p,r,m)}return;default:if(gn(t)){for(var _ in n)p=n[_],n.hasOwnProperty(_)&&p!==void 0&&!r.hasOwnProperty(_)&&tp(e,t,_,void 0,r,p);for(d in r)p=r[d],m=n[d],!r.hasOwnProperty(d)||p===m||p===void 0&&m===void 0||tp(e,t,d,p,r,m);return}}for(var v in n)p=n[v],n.hasOwnProperty(v)&&p!=null&&!r.hasOwnProperty(v)&&$(e,t,v,null,r,p);for(f in r)p=r[f],m=n[f],!r.hasOwnProperty(f)||p===m||p==null&&m==null||$(e,t,f,p,r,m)}function ap(e){switch(e){case`css`:case`script`:case`font`:case`img`:case`image`:case`input`:case`link`:return!0;default:return!1}}function op(){if(typeof performance.getEntriesByType==`function`){for(var e=0,t=0,n=performance.getEntriesByType(`resource`),r=0;r<n.length;r++){var i=n[r],a=i.transferSize,o=i.initiatorType,s=i.duration;if(a&&s&&ap(o)){for(o=0,s=i.responseEnd,r+=1;r<n.length;r++){var c=n[r],l=c.startTime;if(l>s)break;var u=c.transferSize,d=c.initiatorType;u&&ap(d)&&(c=c.responseEnd,o+=u*(c<s?1:(s-l)/(c-l)))}if(--r,t+=8*(a+o)/(i.duration/1e3),e++,10<e)break}}if(0<e)return t/e/1e6}return navigator.connection&&(e=navigator.connection.downlink,typeof e==`number`)?e:5}var sp=null,cp=null;function lp(e){return e.nodeType===9?e:e.ownerDocument}function up(e){switch(e){case`http://www.w3.org/2000/svg`:return 1;case`http://www.w3.org/1998/Math/MathML`:return 2;default:return 0}}function dp(e,t){if(e===0)switch(t){case`svg`:return 1;case`math`:return 2;default:return 0}return e===1&&t===`foreignObject`?0:e}function fp(e,t,n,r){return n=lp(n).createElement(e),n[wt]=r,n[Tt]=t,np(n,e,t),Rt(n),n}function pp(e,t){return e===`textarea`||e===`noscript`||typeof t.children==`string`||typeof t.children==`number`||typeof t.children==`bigint`||typeof t.dangerouslySetInnerHTML==`object`&&t.dangerouslySetInnerHTML!==null&&t.dangerouslySetInnerHTML.__html!=null}var mp=null;function hp(){var e=window.event;return e&&e.type===`popstate`?e===mp?!1:(mp=e,!0):(mp=null,!1)}var gp=typeof setTimeout==`function`?setTimeout:void 0,_p=typeof clearTimeout==`function`?clearTimeout:void 0,vp=typeof Promise==`function`?Promise:void 0,yp=typeof requestAnimationFrame==`function`?requestAnimationFrame:gp,bp=typeof queueMicrotask==`function`?queueMicrotask:vp===void 0?gp:function(e){return vp.resolve(null).then(e).catch(xp)};function xp(e){setTimeout(function(){throw e})}function Sp(e){return e===`head`}function Cp(e,t){var n=t,r=0;do{var i=n.nextSibling;if(e.removeChild(n),i&&i.nodeType===8)if(n=i.data,n===`/$`||n===`/&`){if(r===0){e.removeChild(i),Hh(t);return}r--}else if(n===`$`||n===`$?`||n===`$~`||n===`$!`||n===`&`)r++;else if(n===`html`)_m(e.ownerDocument.documentElement);else if(n===`head`){n=e.ownerDocument.head,_m(n);for(var a=n.firstChild;a;){var o=a.nextSibling,s=a.nodeName;a[jt]||s===`SCRIPT`||s===`STYLE`||s===`LINK`&&a.rel.toLowerCase()===`stylesheet`||n.removeChild(a),a=o}}else n===`body`&&_m(e.ownerDocument.body);n=i}while(n);Hh(t)}function wp(e,t){var n=e;e=0;do{var r=n.nextSibling;if(n.nodeType===1?t?(n._stashedDisplay=n.style.display,n.style.display=`none`):(n.style.display=n._stashedDisplay||``,n.getAttribute(`style`)===``&&n.removeAttribute(`style`)):n.nodeType===3&&(t?(n._stashedText=n.nodeValue,n.nodeValue=``):n.nodeValue=n._stashedText||``),r&&r.nodeType===8)if(n=r.data,n===`/$`){if(e===0)break;e--}else n!==`$`&&n!==`$?`&&n!==`$~`&&n!==`$!`||e++;n=r}while(n)}function Tp(e,t,n){if(t=CSS.escape(t)===t?t:`r-`+btoa(t).replace(/=/g,``),e.style.viewTransitionName=t,n!=null&&(e.style.viewTransitionClass=n),n=getComputedStyle(e),n.display===`inline`){if(t=e.getClientRects(),t.length===1)var r=1;else for(var i=r=0;i<t.length;i++){var a=t[i];0<a.width&&0<a.height&&r++}r===1&&(e=e.style,e.display=t.length===1?`inline-block`:`block`,e.marginTop=`-`+n.paddingTop,e.marginBottom=`-`+n.paddingBottom)}}function Ep(e,t){e=e.style,t=t.style;var n=t==null?null:t.hasOwnProperty(`viewTransitionName`)?t.viewTransitionName:t.hasOwnProperty(`view-transition-name`)?t[`view-transition-name`]:null;e.viewTransitionName=n==null||typeof n==`boolean`?``:(``+n).trim(),n=t==null?null:t.hasOwnProperty(`viewTransitionClass`)?t.viewTransitionClass:t.hasOwnProperty(`view-transition-class`)?t[`view-transition-class`]:null,e.viewTransitionClass=n==null||typeof n==`boolean`?``:(``+n).trim(),e.display===`inline-block`&&(t==null?e.display=e.margin=``:(n=t.display,e.display=n==null||typeof n==`boolean`?``:n,n=t.margin,n==null?(n=t.hasOwnProperty(`marginTop`)?t.marginTop:t[`margin-top`],e.marginTop=n==null||typeof n==`boolean`?``:n,t=t.hasOwnProperty(`marginBottom`)?t.marginBottom:t[`margin-bottom`],e.marginBottom=t==null||typeof t==`boolean`?``:t):e.margin=n))}function Dp(e,t,n){return n=n.ownerDocument.defaultView,{rect:e,abs:t.position===`absolute`||t.position===`fixed`,clip:t.clipPath!==`none`||t.overflow!==`visible`||t.filter!==`none`||t.mask!==`none`||t.mask!==`none`||t.borderRadius!==`0px`,view:0<=e.bottom&&0<=e.right&&e.top<=n.innerHeight&&e.left<=n.innerWidth}}function Op(e){return Dp(e.getBoundingClientRect(),getComputedStyle(e),e)}function kp(e){var t=e.getBoundingClientRect();t=new DOMRect(t.x+2e4,t.y+2e4,t.width,t.height);var n=getComputedStyle(e);return Dp(t,n,e)}function Ap(e){return e.documentElement.clientHeight}function jp(e){this.addEventListener(`load`,e),this.addEventListener(`error`,e)}function Mp(e,t,n,r,i,a,o,s,c){var l=t.nodeType===9?t:t.ownerDocument;try{var u=l.startViewTransition({update:function(){var t=l.defaultView,n=t.navigation&&t.navigation.transition,o=l.fonts.status;r();var s=[];if(o===`loaded`&&(Ap(l),l.fonts.status===`loading`&&s.push(l.fonts.ready)),o=s.length,e!==null)for(var c=e.suspenseyImages,u=0,d=0;d<c.length;d++){var f=c[d];if(!f.complete){var p=f.getBoundingClientRect();if(0<p.bottom&&0<p.right&&p.top<t.innerHeight&&p.left<t.innerWidth){if(u+=Xm(f),u>$m){s.length=o;break}f=new Promise(jp.bind(f)),s.push(f)}}}if(0<s.length)return t=Promise.race([Promise.all(s),new Promise(function(e){return setTimeout(e,500)})]).then(i,i),(n?Promise.allSettled([n.finished,t]):t).then(a,a);if(i(),n)return n.finished.then(a,a);a()},types:n});l.__reactViewTransition=u;var d=[];return u.ready.then(function(){for(var e=l.documentElement.getAnimations({subtree:!0}),t=0;t<e.length;t++){var n=e[t],r=n.effect,i=r.pseudoElement;if(i!=null&&i.startsWith(`::view-transition`)){d.push(n),n=r.getKeyframes();for(var a=i=void 0,s=!0,c=0;c<n.length;c++){var u=n[c],f=u.width;if(i===void 0)i=f;else if(i!==f){s=!1;break}if(f=u.height,a===void 0)a=f;else if(a!==f){s=!1;break}delete u.width,delete u.height,u.transform===`none`&&delete u.transform}s&&i!==void 0&&a!==void 0&&(r.setKeyframes(n),s=getComputedStyle(r.target,r.pseudoElement),s.width!==i||s.height!==a)&&(s=n[0],s.width=i,s.height=a,s=n[n.length-1],s.width=i,s.height=a,r.setKeyframes(n))}}o()},function(e){l.__reactViewTransition===u&&(l.__reactViewTransition=null);try{if(typeof e==`object`&&e)switch(e.name){case`InvalidStateError`:(e.message===`View transition was skipped because document visibility state is hidden.`||e.message===`Skipping view transition because document visibility state has become hidden.`||e.message===`Skipping view transition because viewport size changed.`||e.message===`Transition was aborted because of invalid state`)&&(e=null)}e!==null&&c(e)}finally{r(),i(),o()}}),u.finished.finally(function(){for(var e=0;e<d.length;e++)d[e].cancel();l.__reactViewTransition===u&&(l.__reactViewTransition=null),s()}),u}catch{return r(),i(),o(),null}}function Np(e,t){this._scope=document.documentElement,this._selector=`::view-transition-`+e+`(`+t+`)`}Np.prototype.animate=function(e,t){return t=typeof t==`number`?{duration:t}:w({},t),t.pseudoElement=this._selector,this._scope.animate(e,t)},Np.prototype.getAnimations=function(){for(var e=this._scope,t=this._selector,n=e.getAnimations({subtree:!0}),r=[],i=0;i<n.length;i++){var a=n[i].effect;a!==null&&a.target===e&&a.pseudoElement===t&&r.push(n[i])}return r},Np.prototype.getComputedStyle=function(){return getComputedStyle(this._scope,this._selector)};function Pp(e){return{name:e,group:new Np(`group`,e),imagePair:new Np(`image-pair`,e),old:new Np(`old`,e),new:new Np(`new`,e)}}function Fp(e){this._fragmentFiber=e,this._observers=this._eventListeners=null}Fp.prototype.addEventListener=function(e,t,n){var r=null,i=null;if(!(n!=null&&typeof n!=`boolean`&&(r=n.signal||null,r!==null&&r.aborted))){this._eventListeners===null&&(this._eventListeners=[]);var a=this._eventListeners;if(Bp(a,e,t,n)===-1){var o=this,s=t;n!=null&&typeof n!=`boolean`&&!0===n.once&&(s=function(r){o.removeEventListener(e,t,n),typeof t==`function`?t.call(this,r):t.handleEvent(r)}),r!==null&&(i=o.removeEventListener.bind(o,e,t,n),r.addEventListener(`abort`,i,{once:!0}),i=r.removeEventListener.bind(r,`abort`,i)),r=Rp(n),a.push({type:e,listener:t,optionsOrUseCapture:n,attachedListener:s,cleanup:i}),f(this._fragmentFiber.child,!1,Ip,e,s,r)}this._eventListeners=a}};function Ip(e,t,n,r){return _(e).addEventListener(t,n,r),!1}Fp.prototype.removeEventListener=function(e,t,n){var r=this._eventListeners;if(r!==null&&(t=Bp(r,e,t,n),t!==-1)){var i=r[t];n=i.attachedListener;var a=i.cleanup;i=Rp(i.optionsOrUseCapture),f(this._fragmentFiber.child,!1,Lp,e,n,i),r.splice(t,1),a!==null&&a()}};function Lp(e,t,n,r){return _(e).removeEventListener(t,n,r),!1}function Rp(e){return e!=null&&typeof e!=`boolean`&&(!0===e.once||e.signal instanceof AbortSignal)?{capture:e.capture,passive:e.passive}:e}function zp(e){return e==null?`c=0`:typeof e==`boolean`?`c=`+(e?`1`:`0`):`c=`+(e.capture?`1`:`0`)}function Bp(e,t,n,r){if(e.length===0)return-1;r=zp(r);for(var i=0;i<e.length;i++){var a=e[i];if(a.type===t&&a.listener===n&&zp(a.optionsOrUseCapture)===r)return i}return-1}Fp.prototype.dispatchEvent=function(e){var t=p(this._fragmentFiber);if(t===null)return!0;t=_(t);var n=this._eventListeners;if(n!==null&&0<n.length||!e.bubbles){var r=t.nodeType===9?t.createComment(``):document.createTextNode(``);if(n)for(var i=0;i<n.length;i++){var a=n[i];r.addEventListener(a.type,a.attachedListener,Rp(a.optionsOrUseCapture))}if(t.appendChild(r),e=r.dispatchEvent(e),n)for(i=0;i<n.length;i++)a=n[i],r.removeEventListener(a.type,a.attachedListener,Rp(a.optionsOrUseCapture));return t.removeChild(r),e}return t.dispatchEvent(e)},Fp.prototype.focus=function(e){f(this._fragmentFiber.child,!0,Vp,e,void 0,void 0)};function Vp(e,t){return e.tag===6?!1:(e=_(e),pm(e,t))}Fp.prototype.focusLast=function(e){var t=[];f(this._fragmentFiber.child,!0,Hp,t,void 0,void 0);for(var n=t.length-1;0<=n&&!Vp(t[n],e);n--);};function Hp(e,t){return t.push(e),!1}Fp.prototype.blur=function(){var e=p(this._fragmentFiber);e!==null&&(e=_(e),e=lp(e).activeElement,e!==null&&f(this._fragmentFiber.child,!1,Up,e,void 0,void 0))};function Up(e,t){return e.tag===6?!1:(e=_(e),e===t||e.contains(t)?(t.blur(),!0):!1)}Fp.prototype.observeUsing=function(e){this._observers===null&&(this._observers=new Set),this._observers.add(e),f(this._fragmentFiber.child,!1,Wp,e,void 0,void 0)};function Wp(e,t){return e.tag===6?!1:(e=_(e),t.observe(e),!1)}Fp.prototype.unobserveUsing=function(e){var t=this._observers;if(t!==null&&t.has(e)){t.delete(e),f(this._fragmentFiber.child,!1,Gp,e,void 0,void 0);for(var n=t=0;n<Kp.length;n++){var r=Kp[n];r.fragmentInstance===this&&r.observer===e?e.unobserve(r.instance):Kp[t++]=r}Kp.length=t}};function Gp(e,t){return e.tag===6?!1:(e=_(e),t.unobserve(e),!1)}var Kp=[],qp=!1;function Jp(e,t,n){Kp.push({fragmentInstance:e,observer:t,instance:n}),qp||(qp=!0,mm(function(){qp=!1;var e=Kp;Kp=[];for(var t=0;t<e.length;t++){var n=e[t];n.observer.unobserve(n.instance)}}))}Fp.prototype.getClientRects=function(){var e=[];return f(this._fragmentFiber.child,!1,Yp,e,void 0,void 0),e};function Yp(e,t){if(e.tag===6){e=e.stateNode;var n=e.ownerDocument.createRange();n.selectNodeContents(e),t.push.apply(t,n.getClientRects())}else e=_(e),t.push.apply(t,e.getClientRects());return!1}Fp.prototype.getRootNode=function(e){var t=p(this._fragmentFiber);return t===null?this:_(t).getRootNode(e)},Fp.prototype.compareDocumentPosition=function(e){var t=p(this._fragmentFiber);if(t===null)return Node.DOCUMENT_POSITION_DISCONNECTED;var n=[];f(this._fragmentFiber.child,!1,Hp,n,void 0,void 0);var r=_(t);if(n.length===0){if(n=r,m(this._fragmentFiber)){a:{for(t=this._fragmentFiber.return;t!==null;){if(t.tag===4){t=t.stateNode.containerInfo;break a}if(t.tag===3||t.tag===5||t.tag===27)break;t=t.return}t=null}t!=null&&(n=t)}t=this._fragmentFiber;var i=r=n.compareDocumentPosition(e);return n===e?i=Node.DOCUMENT_POSITION_CONTAINS:r&Node.DOCUMENT_POSITION_CONTAINED_BY&&(n=h(t)[1],n===null?i=Node.DOCUMENT_POSITION_PRECEDING:(e=_(n).compareDocumentPosition(e),i=e===0||e&Node.DOCUMENT_POSITION_FOLLOWING?Node.DOCUMENT_POSITION_FOLLOWING:Node.DOCUMENT_POSITION_PRECEDING)),i|=Node.DOCUMENT_POSITION_IMPLEMENTATION_SPECIFIC}t=_(n[0]),i=_(n[n.length-1]);var a=m(this._fragmentFiber)?t.parentElement:r;if(a==null)return Node.DOCUMENT_POSITION_DISCONNECTED;r=a.compareDocumentPosition(t)&Node.DOCUMENT_POSITION_CONTAINED_BY,a=a.compareDocumentPosition(i)&Node.DOCUMENT_POSITION_CONTAINED_BY;var o=t.compareDocumentPosition(e),s=i.compareDocumentPosition(e),c=o&Node.DOCUMENT_POSITION_CONTAINED_BY||s&Node.DOCUMENT_POSITION_CONTAINED_BY;return s=r&&a&&o&Node.DOCUMENT_POSITION_FOLLOWING&&s&Node.DOCUMENT_POSITION_PRECEDING,t=r&&t===e||a&&i===e||c||s?Node.DOCUMENT_POSITION_CONTAINED_BY:!r&&t===e||!a&&i===e?Node.DOCUMENT_POSITION_IMPLEMENTATION_SPECIFIC:o,t&Node.DOCUMENT_POSITION_DISCONNECTED||t&Node.DOCUMENT_POSITION_IMPLEMENTATION_SPECIFIC||Xp(t,this._fragmentFiber,n[0],n[n.length-1],e)?t:Node.DOCUMENT_POSITION_IMPLEMENTATION_SPECIFIC};function Xp(e,t,n,r,i){var a=Pt(i);if(e&Node.DOCUMENT_POSITION_CONTAINED_BY){if(n=!!a)a:{for(;a!==null;){if(a.tag===7&&(a===t||a.alternate===t)){n=!0;break a}a=a.return}n=!1}return n}if(e&Node.DOCUMENT_POSITION_CONTAINS){if(a===null)return a=i.ownerDocument,i===a||i===a.documentElement||i===a.body;a:{for(a=t,t=p(t);a!==null;){if(!(a.tag!==5&&a.tag!==3&&a.tag!==27||a!==t&&a.alternate!==t)){a=!0;break a}a=a.return}a=!1}return a}return e&Node.DOCUMENT_POSITION_PRECEDING?((t=!!a)&&!(t=a===n)&&(t=C(n,a,S),t===null?t=!1:(f(t,!0,b,a,n),a=v,v=null,t=a!==null)),t):e&Node.DOCUMENT_POSITION_FOLLOWING?((t=!!a)&&!(t=a===r)&&(t=C(r,a,S),t===null?t=!1:(f(t,!0,x,a,r),a=v,y=v=null,t=a!==null)),t):!1}function Zp(e,t){var n=e.ownerDocument.createRange();n.selectNodeContents(e),e=n.getBoundingClientRect(),window.scrollTo(window.scrollX+e.left,t?window.scrollY+e.top:window.scrollY+e.bottom-window.innerHeight)}Fp.prototype.scrollIntoView=function(e){if(typeof e==`object`)throw Error(i(566));var t=[];f(this._fragmentFiber.child,!1,Hp,t,void 0,void 0);var n=!1!==e;if(t.length===0){var r=h(this._fragmentFiber);if(r=n?r[1]||r[0]||p(this._fragmentFiber):r[0]||r[1],r===null)return;if(r.tag===6){e=_(r),Zp(e,n);return}if(r=_(r),r.nodeType!==9){if(r.nodeType===11){n=`host`in r?r.host:null,n!==null&&n.scrollIntoView(e);return}r.scrollIntoView(e)}}for(r=n?t.length-1:0;r!==(n?-1:t.length);){var a=t[r];a.tag===6?(a=_(a),Zp(a,n)):_(a).scrollIntoView(e),r+=n?-1:1}};function Qp(e,t){return e=_(e),$p(e,t),!1}function $p(e,t){e.reactFragments??=new Set,e.reactFragments.add(t)}function em(e,t){var n=t._eventListeners;if(n!==null)for(var r=0;r<n.length;r++){var i=n[r];e.addEventListener(i.type,i.attachedListener,Rp(i.optionsOrUseCapture))}e.nodeType!==3&&(n=t._observers,n!==null&&n.forEach(function(n){for(var r=0,i=0;i<Kp.length;i++){var a=Kp[i];(a.fragmentInstance!==t||a.observer!==n||a.instance!==e)&&(Kp[r++]=a)}Kp.length=r,n.observe(e)}),$p(e,t))}function tm(e,t){var n=t._eventListeners;if(n!==null)for(var r=0;r<n.length;r++){var i=n[r];e.removeEventListener(i.type,i.attachedListener,Rp(i.optionsOrUseCapture))}e.nodeType!==3&&(n=t._observers,n!==null&&n.forEach(function(n){typeof n.rootMargin==`string`?Jp(t,n,e):n.unobserve(e)}),e.reactFragments!=null&&e.reactFragments.delete(t))}function nm(e){var t=e.firstChild;for(t&&t.nodeType===10&&(t=t.nextSibling);t;){var n=t;switch(t=t.nextSibling,n.nodeName){case`HTML`:case`HEAD`:case`BODY`:nm(n),Nt(n);continue;case`SCRIPT`:case`STYLE`:continue;case`LINK`:if(n.rel.toLowerCase()===`stylesheet`)continue}e.removeChild(n)}}function rm(e,t,n,r){for(;e.nodeType===1;){var i=n;if(e.nodeName.toLowerCase()!==t.toLowerCase()){if(!r&&(e.nodeName!==`INPUT`||e.type!==`hidden`))break}else if(!r)if(t===`input`&&e.type===`hidden`){var a=i.name==null?null:``+i.name;if(i.type===`hidden`&&e.getAttribute(`name`)===a)return e}else return e;else if(!e[jt])switch(t){case`meta`:if(!e.hasAttribute(`itemprop`))break;return e;case`link`:if(a=e.getAttribute(`rel`),a===`stylesheet`&&e.hasAttribute(`data-precedence`)||a!==i.rel||e.getAttribute(`href`)!==(i.href==null||i.href===``?null:i.href)||e.getAttribute(`crossorigin`)!==(i.crossOrigin==null?null:i.crossOrigin)||e.getAttribute(`title`)!==(i.title==null?null:i.title))break;return e;case`style`:if(e.hasAttribute(`data-precedence`))break;return e;case`script`:if(a=e.getAttribute(`src`),(a!==(i.src==null?null:i.src)||e.getAttribute(`type`)!==(i.type==null?null:i.type)||e.getAttribute(`crossorigin`)!==(i.crossOrigin==null?null:i.crossOrigin))&&a&&e.hasAttribute(`async`)&&!e.hasAttribute(`itemprop`))break;return e;default:return e}if(e=lm(e.nextSibling),e===null)break}return null}function im(e,t,n){if(t===``)return null;for(;e.nodeType!==3;)if((e.nodeType!==1||e.nodeName!==`INPUT`||e.type!==`hidden`)&&!n||(e=lm(e.nextSibling),e===null))return null;return e}function am(e,t){for(;e.nodeType!==8;)if((e.nodeType!==1||e.nodeName!==`INPUT`||e.type!==`hidden`)&&!t||(e=lm(e.nextSibling),e===null))return null;return e}function om(e){return e.data===`$?`||e.data===`$~`}function sm(e){return e.data===`$!`||e.data===`$?`&&e.ownerDocument.readyState!==`loading`}function cm(e,t){var n=e.ownerDocument;if(e.data===`$~`)e._reactRetry=t;else if(e.data!==`$?`||n.readyState!==`loading`)t();else{var r=function(){t(),n.removeEventListener(`DOMContentLoaded`,r)};n.addEventListener(`DOMContentLoaded`,r),e._reactRetry=r}}function lm(e){for(;e!=null;e=e.nextSibling){var t=e.nodeType;if(t===1||t===3)break;if(t===8){if(t=e.data,t===`$`||t===`$!`||t===`$?`||t===`$~`||t===`&`||t===`F!`||t===`F`)break;if(t===`/$`||t===`/&`)return null}}return e}var um=null;function dm(e){e=e.nextSibling;for(var t=0;e;){if(e.nodeType===8){var n=e.data;if(n===`/$`||n===`/&`){if(t===0)return lm(e.nextSibling);t--}else n!==`$`&&n!==`$!`&&n!==`$?`&&n!==`$~`&&n!==`&`||t++}e=e.nextSibling}return null}function fm(e){e=e.previousSibling;for(var t=0;e;){if(e.nodeType===8){var n=e.data;if(n===`$`||n===`$!`||n===`$?`||n===`$~`||n===`&`){if(t===0)return e;t--}else n!==`/$`&&n!==`/&`||t++}e=e.previousSibling}return null}function pm(e,t){function n(){r=!0}if(e.ownerDocument.activeElement===e)return!0;var r=!1;try{e.ownerDocument.addEventListener(`focus`,n,!0),(e.focus||HTMLElement.prototype.focus).call(e,t)}finally{e.ownerDocument.removeEventListener(`focus`,n,!0)}return r}function mm(e){yp(function(){yp(function(t){return e(t)})})}function hm(e,t,n){switch(t=lp(n),e){case`html`:if(e=t.documentElement,!e)throw Error(i(452));return e;case`head`:if(e=t.head,!e)throw Error(i(453));return e;case`body`:if(e=t.body,!e)throw Error(i(454));return e;default:throw Error(i(451))}}function gm(e,t,n){for(var r in n){var i=n[r];n.hasOwnProperty(r)&&i!=null&&$(e,t,r,null,rp,i)}n.dangerouslySetInnerHTML!=null&&(e.textContent=``),e.onclick===bn&&(e.onclick=null),Nt(e)}function _m(e){for(var t=e.attributes;t.length;)e.removeAttributeNode(t[0]);Nt(e)}var vm=new Map,ym=new Set;function bm(e){if(typeof e.getRootNode==`function`){var t=e.getRootNode();if(t.nodeType===9||t.nodeType===11)return t}return e.nodeType===9?e:e.ownerDocument}var xm=M.d;M.d={f:Sm,r:Cm,D:Em,C:Dm,L:Om,m:km,X:jm,S:Am,M:Mm};function Sm(){var e=xm.f(),t=Bd();return e||t}function Cm(e){var t=Ft(e);t!==null&&t.tag===5&&t.type===`form`?nc(t):xm.r(e)}var wm=typeof document>`u`?null:document;function Tm(e,t,n){var r=wm;if(r&&typeof t==`string`&&t){var i=an(t);i=`link[rel="`+e+`"][href="`+i+`"]`,typeof n==`string`&&(i+=`[crossorigin="`+n+`"]`),ym.has(i)||(ym.add(i),e={rel:e,crossOrigin:n,href:t},r.querySelector(i)===null&&(t=r.createElement(`link`),np(t,`link`,e),Rt(t),r.head.appendChild(t)))}}function Em(e){xm.D(e),Tm(`dns-prefetch`,e,null)}function Dm(e,t){xm.C(e,t),Tm(`preconnect`,e,t)}function Om(e,t,n){xm.L(e,t,n);var r=wm;if(r&&e&&t){var i=`link[rel="preload"][as="`+an(t)+`"]`;t===`image`&&n&&n.imageSrcSet?(i+=`[imagesrcset="`+an(n.imageSrcSet)+`"]`,typeof n.imageSizes==`string`&&(i+=`[imagesizes="`+an(n.imageSizes)+`"]`)):i+=`[href="`+an(e)+`"]`;var a=i;switch(t){case`style`:a=Pm(e);break;case`script`:a=Rm(e)}if(!(vm.has(a)||(e=w({rel:`preload`,href:t===`image`&&n&&n.imageSrcSet?void 0:e,as:t},n),vm.set(a,e),r.querySelector(i)!==null||t===`style`&&r.querySelector(Fm(a))||t===`script`&&r.querySelector(zm(a))))){var o=r.createElement(`link`);np(o,`link`,e),t===`style`&&(o[Mt]=!0,o.onload=o.onerror=function(){zt(o)}),Rt(o),r.head.appendChild(o)}}}function km(e,t){xm.m(e,t);var n=wm;if(n&&e){var r=t&&typeof t.as==`string`?t.as:`script`,i=`link[rel="modulepreload"][as="`+an(r)+`"][href="`+an(e)+`"]`,a=i;switch(r){case`audioworklet`:case`paintworklet`:case`serviceworker`:case`sharedworker`:case`worker`:case`script`:a=Rm(e)}if(!vm.has(a)&&(e=w({rel:`modulepreload`,href:e},t),vm.set(a,e),n.querySelector(i)===null)){switch(r){case`audioworklet`:case`paintworklet`:case`serviceworker`:case`sharedworker`:case`worker`:case`script`:if(n.querySelector(zm(a)))return}r=n.createElement(`link`),np(r,`link`,e),Rt(r),n.head.appendChild(r)}}}function Am(e,t,n){xm.S(e,t,n);var r=wm;if(r&&e){var i=Lt(r).hoistableStyles,a=Pm(e);t||=`default`;var o=i.get(a);if(!o){var s={loading:0,preload:null};if(o=r.querySelector(Fm(a)))s.loading=5;else{e=w({rel:`stylesheet`,href:e,"data-precedence":t},n),(n=vm.get(a))&&Hm(e,n);var c=o=r.createElement(`link`);Rt(c),np(c,`link`,e),c._p=new Promise(function(e,t){c.onload=e,c.onerror=t}),c.addEventListener(`load`,function(){s.loading|=1}),c.addEventListener(`error`,function(){s.loading|=2}),s.loading|=4,Vm(o,t,r)}o={type:`stylesheet`,instance:o,count:1,state:s},i.set(a,o)}}}function jm(e,t){xm.X(e,t);var n=wm;if(n&&e){var r=Lt(n).hoistableScripts,i=Rm(e),a=r.get(i);a||(a=n.querySelector(zm(i)),a||(e=w({src:e,async:!0},t),(t=vm.get(i))&&Um(e,t),a=n.createElement(`script`),Rt(a),np(a,`link`,e),n.head.appendChild(a)),a={type:`script`,instance:a,count:1,state:null},r.set(i,a))}}function Mm(e,t){xm.M(e,t);var n=wm;if(n&&e){var r=Lt(n).hoistableScripts,i=Rm(e),a=r.get(i);a||(a=n.querySelector(zm(i)),a||(e=w({src:e,async:!0,type:`module`},t),(t=vm.get(i))&&Um(e,t),a=n.createElement(`script`),Rt(a),np(a,`link`,e),n.head.appendChild(a)),a={type:`script`,instance:a,count:1,state:null},r.set(i,a))}}function Nm(e,t,n,r){var a=(a=we.current)?bm(a):null;if(!a)throw Error(i(446));switch(e){case`meta`:case`title`:return null;case`style`:return typeof n.precedence==`string`&&typeof n.href==`string`?(n=Pm(n.href),t=Lt(a).hoistableStyles,r=t.get(n),r||(r={type:`style`,instance:null,count:0,state:null},t.set(n,r)),r):{type:`void`,instance:null,count:0,state:null};case`link`:if(n.rel===`stylesheet`&&typeof n.href==`string`&&typeof n.precedence==`string`){e=Pm(n.href);var o=Lt(a).hoistableStyles,s=o.get(e);if(s||(a=a.ownerDocument||a,s={type:`stylesheet`,instance:null,count:0,state:{loading:0,preload:null}},o.set(e,s),(o=a.querySelector(Fm(e)))?o._p||(s.instance=o,s.state.loading=5):(o=vm.get(e),o||(o={rel:`preload`,as:`style`,href:n.href,crossOrigin:n.crossOrigin,integrity:n.integrity,media:n.media,hrefLang:n.hrefLang,referrerPolicy:n.referrerPolicy},vm.set(e,o)),Lm(a,e,o,s.state))),t&&r===null)throw Error(i(528,``));return s}if(t&&r!==null)throw Error(i(529,``));return null;case`script`:return t=n.async,n=n.src,typeof n==`string`&&t&&typeof t!=`function`&&typeof t!=`symbol`?(n=Rm(n),t=Lt(a).hoistableScripts,r=t.get(n),r||(r={type:`script`,instance:null,count:0,state:null},t.set(n,r)),r):{type:`void`,instance:null,count:0,state:null};default:throw Error(i(444,e))}}function Pm(e){return`href="`+an(e)+`"`}function Fm(e){return`link[rel="stylesheet"][`+e+`]`}function Im(e){return w({},e,{"data-precedence":e.precedence,precedence:null})}function Lm(e,t,n,r){if(t=e.querySelector(`link[rel="preload"][as="style"][`+t+`]`)){if(!0!==t[Mt]){r.loading=1;return}}else t=e.createElement(`link`),t[Mt]=!0,t.onload=t.onerror=zt.bind(null,t),np(t,`link`,n),Rt(t),e.head.appendChild(t);r.preload=t,t.addEventListener(`load`,function(){return r.loading|=1}),t.addEventListener(`error`,function(){return r.loading|=2})}function Rm(e){return`[src="`+an(e)+`"]`}function zm(e){return`script[async]`+e}function Bm(e,t,n){if(t.count++,t.instance===null)switch(t.type){case`style`:var r=e.querySelector(`style[data-href~="`+an(n.href)+`"]`);if(r)return t.instance=r,Rt(r),r;var a=w({},n,{"data-href":n.href,"data-precedence":n.precedence,href:null,precedence:null});return r=(e.ownerDocument||e).createElement(`style`),Rt(r),np(r,`style`,a),Vm(r,n.precedence,e),t.instance=r;case`stylesheet`:a=Pm(n.href);var o=e.querySelector(Fm(a));if(o)return t.state.loading|=4,t.instance=o,Rt(o),o;r=Im(n),(a=vm.get(a))&&Hm(r,a),o=(e.ownerDocument||e).createElement(`link`),Rt(o);var s=o;return s._p=new Promise(function(e,t){s.onload=e,s.onerror=t}),np(o,`link`,r),t.state.loading|=4,Vm(o,n.precedence,e),t.instance=o;case`script`:return o=Rm(n.src),(a=e.querySelector(zm(o)))?(t.instance=a,Rt(a),a):(r=n,(a=vm.get(o))&&(r=w({},n),Um(r,a)),e=e.ownerDocument||e,a=e.createElement(`script`),Rt(a),np(a,`link`,r),e.head.appendChild(a),t.instance=a);case`void`:return null;default:throw Error(i(443,t.type))}else t.type===`stylesheet`&&!(t.state.loading&4)&&(r=t.instance,t.state.loading|=4,Vm(r,n.precedence,e));return t.instance}function Vm(e,t,n){for(var r=n.querySelectorAll(`link[rel="stylesheet"][data-precedence],style[data-precedence]`),i=r.length?r[r.length-1]:null,a=i,o=0;o<r.length;o++){var s=r[o];if(s.dataset.precedence===t)a=s;else if(a!==i)break}a?a.parentNode.insertBefore(e,a.nextSibling):(t=n.nodeType===9?n.head:n,t.insertBefore(e,t.firstChild))}function Hm(e,t){e.crossOrigin??=t.crossOrigin,e.referrerPolicy??=t.referrerPolicy,e.title??=t.title}function Um(e,t){e.crossOrigin??=t.crossOrigin,e.referrerPolicy??=t.referrerPolicy,e.integrity??=t.integrity}var Wm=null;function Gm(e,t,n){if(Wm===null){var r=new Map,i=Wm=new Map;i.set(n,r)}else i=Wm,r=i.get(n),r||(r=new Map,i.set(n,r));if(r.has(e))return r;for(r.set(e,null),n=n.getElementsByTagName(e),i=0;i<n.length;i++){var a=n[i];if(!(a[jt]||a[wt]||e===`link`&&a.getAttribute(`rel`)===`stylesheet`)&&a.namespaceURI!==`http://www.w3.org/2000/svg`){var o=a.getAttribute(t)||``;o=e+o;var s=r.get(o);s?s.push(a):r.set(o,[a])}}return r}function Km(e,t,n){e=e.ownerDocument||e,e.head.insertBefore(n,t===`title`?e.querySelector(`head > title`):null)}function qm(e,t,n){if(n===1||t.itemProp!=null)return!1;switch(e){case`meta`:case`title`:return!0;case`style`:if(typeof t.precedence!=`string`||typeof t.href!=`string`||t.href===``)break;return!0;case`link`:if(typeof t.rel!=`string`||typeof t.href!=`string`||t.href===``||t.onLoad||t.onError)break;switch(t.rel){case`stylesheet`:return e=t.disabled,typeof t.precedence==`string`&&e==null;default:return!0}case`script`:if(t.async&&typeof t.async!=`function`&&typeof t.async!=`symbol`&&!t.onLoad&&!t.onError&&t.src&&typeof t.src==`string`)return!0}return!1}function Jm(e,t){return e===`img`&&t.src!=null&&t.src!==``&&t.onLoad==null&&t.loading!==`lazy`}function Ym(e){return!(e.type===`stylesheet`&&!(e.state.loading&3))}function Xm(e){return(e.width||100)*(e.height||100)*(typeof devicePixelRatio==`number`?devicePixelRatio:1)*.25}function Zm(e,t){typeof t.decode==`function`&&(e.imgCount++,t.complete||(e.imgBytes+=Xm(t),e.suspenseyImages.push(t)),e=rh.bind(e),t.decode().then(e,e))}function Qm(e,t,n,r){if(n.type===`stylesheet`&&(typeof r.media!=`string`||!1!==matchMedia(r.media).matches)&&!(n.state.loading&4)){if(n.instance===null){var i=Pm(r.href),a=t.querySelector(Fm(i));if(a){t=a._p,typeof t==`object`&&t&&typeof t.then==`function`&&(e.count++,e=nh.bind(e),t.then(e,e)),n.state.loading|=4,n.instance=a,Rt(a);return}a=t.ownerDocument||t,r=Im(r),(i=vm.get(i))&&Hm(r,i),a=a.createElement(`link`),Rt(a);var o=a;o._p=new Promise(function(e,t){o.onload=e,o.onerror=t}),np(a,`link`,r),n.instance=a}e.stylesheets===null&&(e.stylesheets=new Map),e.stylesheets.set(n,t),(t=n.state.preload)&&!(n.state.loading&3)&&(e.count++,n=nh.bind(e),t.addEventListener(`load`,n),t.addEventListener(`error`,n))}}var $m=0;function eh(e,t){return e.stylesheets&&e.count===0&&ah(e,e.stylesheets),0<e.count||0<e.imgCount?function(n){var r=setTimeout(function(){if(e.stylesheets&&ah(e,e.stylesheets),e.unsuspend){var t=e.unsuspend;e.unsuspend=null,t()}},6e4+t);0<e.imgBytes&&$m===0&&($m=62500*op());var i=setTimeout(function(){if(e.waitingForImages=!1,e.count===0&&(e.stylesheets&&ah(e,e.stylesheets),e.unsuspend)){var t=e.unsuspend;e.unsuspend=null,t()}},(e.imgBytes>$m?50:800)+t);return e.unsuspend=n,function(){e.unsuspend=null,clearTimeout(r),clearTimeout(i)}}:null}function th(e){if(e.count===0&&(e.imgCount===0||!e.waitingForImages)){if(e.stylesheets)ah(e,e.stylesheets);else if(e.unsuspend){var t=e.unsuspend;e.unsuspend=null,t()}}}function nh(){this.count--,th(this)}function rh(){this.imgCount--,th(this)}var ih=null;function ah(e,t){e.stylesheets=null,e.unsuspend!==null&&(e.count++,ih=new Map,t.forEach(oh,e),ih=null,nh.call(e))}function oh(e,t){if(!(t.state.loading&4)){var n=ih.get(e);if(n)var r=n.get(null);else{n=new Map,ih.set(e,n);for(var i=e.querySelectorAll(`link[data-precedence],style[data-precedence]`),a=0;a<i.length;a++){var o=i[a];(o.nodeName===`LINK`||o.getAttribute(`media`)!==`not all`)&&(n.set(o.dataset.precedence,o),r=o)}r&&n.set(null,r)}i=t.instance,o=i.getAttribute(`data-precedence`),a=n.get(o)||r,a===r&&n.set(null,i),n.set(o,i),this.count++,r=nh.bind(this),i.addEventListener(`load`,r),i.addEventListener(`error`,r),a?a.parentNode.insertBefore(i,a.nextSibling):(e=e.nodeType===9?e.head:e,e.insertBefore(i,e.firstChild)),t.state.loading|=4}}var sh={$$typeof:k,Provider:null,Consumer:null,_currentValue:_e,_currentValue2:_e,_threadCount:0};function ch(e,t,n,r,i,a,o,s,c){this.tag=1,this.containerInfo=e,this.pingCache=this.current=this.pendingChildren=null,this.timeoutHandle=-1,this.callbackNode=this.next=this.pendingContext=this.context=this.cancelPendingCommit=null,this.callbackPriority=0,this.expirationTimes=pt(-1),this.entangledLanes=this.shellSuspendCounter=this.errorRecoveryDisabledLanes=this.expiredLanes=this.warmLanes=this.pingedLanes=this.suspendedLanes=this.pendingLanes=0,this.entanglements=pt(0),this.hiddenUpdates=pt(null),this.identifierPrefix=r,this.onUncaughtError=i,this.onCaughtError=a,this.onRecoverableError=o,this.pooledCache=null,this.pooledCacheLanes=0,this.formState=c,this.transitionTypes=null,this.incompleteTransitions=new Map}function lh(e,t,n,r,i,a,o,s,c,l,u,d){return e=new ch(e,t,n,o,c,l,u,d,s),t=1,!0===a&&(t|=24),a=Ni(3,null,null,t),e.current=a,a.stateNode=e,t=Na(),t.refCount++,e.pooledCache=t,t.refCount++,a.memoizedState={element:r,isDehydrated:n,cache:t},go(a),e}function uh(e){return e?(e=ji,e):ji}function dh(e,t,n,r,i,a){i=uh(i),r.context===null?r.context=i:r.pendingContext=i,r=vo(t),r.payload={element:n},a=a===void 0?null:a,a!==null&&(r.callback=a),n=yo(e,r,t),n!==null&&(Fd(n,e,t),bo(n,e,t))}function fh(e,t){if(e=e.memoizedState,e!==null&&e.dehydrated!==null){var n=e.retryLane;e.retryLane=n!==0&&n<t?n:t}}function ph(e,t){fh(e,t),(e=e.alternate)&&fh(e,t)}function mh(e){if(e.tag===13||e.tag===31){var t=ki(e,67108864);t!==null&&Fd(t,e,67108864),ph(e,67108864)}}function hh(e){if(e.tag===13||e.tag===31){var t=Md();t=yt(t);var n=ki(e,t);n!==null&&Fd(n,e,t),ph(e,t)}}var gh=!0;function _h(e,t,n,r){var i=j.T;j.T=null;var a=M.p;try{M.p=2,yh(e,t,n,r)}finally{M.p=a,j.T=i}}function vh(e,t,n,r){var i=j.T;j.T=null;var a=M.p;try{M.p=8,yh(e,t,n,r)}finally{M.p=a,j.T=i}}function yh(e,t,n,r){if(gh){var i=bh(r);if(i===null)Kf(e,t,r,xh,n),Mh(e,r);else if(Ph(i,e,t,n,r))r.stopPropagation();else if(Mh(e,r),t&4&&-1<jh.indexOf(e)){for(;i!==null;){var a=Ft(i);if(a!==null)switch(a.tag){case 3:if(a=a.stateNode,a.current.memoizedState.isDehydrated){var o=st(a.pendingLanes);if(o!==0){var s=a;for(s.pendingLanes|=2,s.entangledLanes|=2;o;){var c=1<<31-et(o);s.entanglements[1]|=c,o&=~c}Ef(a),!(K&6)&&(_d=He()+500,Df(0,!1))}}break;case 31:case 13:s=ki(a,2),s!==null&&Fd(s,a,2),Bd(),ph(a,2)}if(a=bh(r),a===null&&Kf(e,t,r,xh,n),a===i)break;i=a}i!==null&&r.stopPropagation()}else Kf(e,t,r,null,n)}}function bh(e){return e=Sn(e),Sh(e)}var xh=null;function Sh(e){if(xh=null,e=Pt(e),e!==null){var t=o(e);if(t===null)e=null;else{var n=t.tag;if(n===13){if(e=s(t),e!==null)return e;e=null}else if(n===31){if(e=c(t),e!==null)return e;e=null}else if(n===3){if(t.stateNode.current.memoizedState.isDehydrated)return t.tag===3?t.stateNode.containerInfo:null;e=null}else t!==e&&(e=null)}}return xh=e,null}function Ch(e){switch(e){case`beforetoggle`:case`cancel`:case`click`:case`close`:case`contextmenu`:case`copy`:case`cut`:case`auxclick`:case`dblclick`:case`dragend`:case`dragstart`:case`drop`:case`focusin`:case`focusout`:case`input`:case`invalid`:case`keydown`:case`keypress`:case`keyup`:case`mousedown`:case`mouseup`:case`paste`:case`pause`:case`play`:case`pointercancel`:case`pointerdown`:case`pointerup`:case`ratechange`:case`reset`:case`seeked`:case`submit`:case`toggle`:case`touchcancel`:case`touchend`:case`touchstart`:case`volumechange`:case`change`:case`selectionchange`:case`textInput`:case`compositionstart`:case`compositionend`:case`compositionupdate`:case`beforeblur`:case`afterblur`:case`beforeinput`:case`blur`:case`fullscreenchange`:case`fullscreenerror`:case`focus`:case`hashchange`:case`popstate`:case`select`:case`selectstart`:return 2;case`drag`:case`dragenter`:case`dragexit`:case`dragleave`:case`dragover`:case`mousemove`:case`mouseout`:case`mouseover`:case`pointermove`:case`pointerout`:case`pointerover`:case`resize`:case`scroll`:case`touchmove`:case`wheel`:case`mouseenter`:case`mouseleave`:case`pointerenter`:case`pointerleave`:return 8;case`message`:switch(Ue()){case We:return 2;case Ge:return 8;case Ke:case qe:return 32;case Je:return 268435456;default:return 32}default:return 32}}var wh=!1,Th=null,Eh=null,Dh=null,Oh=new Map,kh=new Map,Ah=[],jh=`mousedown mouseup touchcancel touchend touchstart auxclick dblclick pointercancel pointerdown pointerup dragend dragstart drop compositionend compositionstart keydown keypress keyup input textInput copy cut paste click change contextmenu reset`.split(` `);function Mh(e,t){switch(e){case`focusin`:case`focusout`:Th=null;break;case`dragenter`:case`dragleave`:Eh=null;break;case`mouseover`:case`mouseout`:Dh=null;break;case`pointerover`:case`pointerout`:Oh.delete(t.pointerId);break;case`gotpointercapture`:case`lostpointercapture`:kh.delete(t.pointerId)}}function Nh(e,t,n,r,i,a){return e===null||e.nativeEvent!==a?(e={blockedOn:t,domEventName:n,eventSystemFlags:r,nativeEvent:a,targetContainers:[i]},t!==null&&(t=Ft(t),t!==null&&mh(t)),e):(e.eventSystemFlags|=r,t=e.targetContainers,i!==null&&t.indexOf(i)===-1&&t.push(i),e)}function Ph(e,t,n,r,i){switch(t){case`focusin`:return Th=Nh(Th,e,t,n,r,i),!0;case`dragenter`:return Eh=Nh(Eh,e,t,n,r,i),!0;case`mouseover`:return Dh=Nh(Dh,e,t,n,r,i),!0;case`pointerover`:var a=i.pointerId;return Oh.set(a,Nh(Oh.get(a)||null,e,t,n,r,i)),!0;case`gotpointercapture`:return a=i.pointerId,kh.set(a,Nh(kh.get(a)||null,e,t,n,r,i)),!0}return!1}function Fh(e){var t=Pt(e.target);if(t!==null){var n=o(t);if(n!==null){if(t=n.tag,t===13){if(t=s(n),t!==null){e.blockedOn=t,St(e.priority,function(){hh(n)});return}}else if(t===31){if(t=c(n),t!==null){e.blockedOn=t,St(e.priority,function(){hh(n)});return}}else if(t===3&&n.stateNode.current.memoizedState.isDehydrated){e.blockedOn=n.tag===3?n.stateNode.containerInfo:null;return}}}e.blockedOn=null}function Ih(e){if(e.blockedOn!==null)return!1;for(var t=e.targetContainers;0<t.length;){var n=bh(e.nativeEvent);if(n===null){n=e.nativeEvent;var r=new n.constructor(n.type,n);xn=r,n.target.dispatchEvent(r),xn=null}else return t=Ft(n),t!==null&&mh(t),e.blockedOn=n,!1;t.shift()}return!0}function Lh(e,t,n){Ih(e)&&n.delete(t)}function Rh(){wh=!1,Th!==null&&Ih(Th)&&(Th=null),Eh!==null&&Ih(Eh)&&(Eh=null),Dh!==null&&Ih(Dh)&&(Dh=null),Oh.forEach(Lh),kh.forEach(Lh)}function zh(e,n){e.blockedOn===n&&(e.blockedOn=null,wh||(wh=!0,t.unstable_scheduleCallback(t.unstable_NormalPriority,Rh)))}var Bh=null;function Vh(e){Bh!==e&&(Bh=e,t.unstable_scheduleCallback(t.unstable_NormalPriority,function(){Bh===e&&(Bh=null);for(var t=0;t<e.length;t+=3){var n=e[t],r=e[t+1],i=e[t+2];if(typeof r!=`function`){if(Sh(r||n)===null)continue;break}var a=Ft(n);a!==null&&(e.splice(t,3),t-=3,U(a,{pending:!0,data:i,method:n.method,action:r},r,i))}}))}function Hh(e){function t(t){return zh(t,e)}Th!==null&&zh(Th,e),Eh!==null&&zh(Eh,e),Dh!==null&&zh(Dh,e),Oh.forEach(t),kh.forEach(t);for(var n=0;n<Ah.length;n++){var r=Ah[n];r.blockedOn===e&&(r.blockedOn=null)}for(;0<Ah.length&&(n=Ah[0],n.blockedOn===null);)Fh(n),n.blockedOn===null&&Ah.shift();if(n=(e.ownerDocument||e).$$reactFormReplay,n!=null)for(r=0;r<n.length;r+=3){var i=n[r],a=n[r+1],o=i[Tt]||null;if(typeof a==`function`)o||Vh(n);else if(o){var s=null;if(a&&a.hasAttribute(`formAction`)){if(i=a,o=a[Tt]||null)s=o.formAction;else if(Sh(i)!==null)continue}else s=o.action;typeof s==`function`?n[r+1]=s:(n.splice(r,3),r-=3),Vh(n)}}}function Uh(){function e(e){e.canIntercept&&e.info===`react-transition`&&e.intercept({handler:function(){return new Promise(function(e){return i=e})},focusReset:`manual`,scroll:`manual`})}function t(){i!==null&&(i(),i=null),r||setTimeout(n,20)}function n(){if(!r&&!navigation.transition){var e=navigation.currentEntry;e&&e.url!=null&&navigation.navigate(e.url,{state:e.getState(),info:`react-transition`,history:`replace`})}}if(typeof navigation==`object`){var r=!1,i=null;return navigation.addEventListener(`navigate`,e),navigation.addEventListener(`navigatesuccess`,t),navigation.addEventListener(`navigateerror`,t),setTimeout(n,100),function(){r=!0,navigation.removeEventListener(`navigate`,e),navigation.removeEventListener(`navigatesuccess`,t),navigation.removeEventListener(`navigateerror`,t),i!==null&&(i(),i=null)}}}function Wh(e){this._internalRoot=e}Gh.prototype.render=Wh.prototype.render=function(e){var t=this._internalRoot;if(t===null)throw Error(i(409));var n=t.current;dh(n,Md(),e,t,null,null)},Gh.prototype.unmount=Wh.prototype.unmount=function(){var e=this._internalRoot;if(e!==null){this._internalRoot=null;var t=e.containerInfo;dh(e.current,2,null,e,null,null),Bd(),t[Et]=null}};function Gh(e){this._internalRoot=e}Gh.prototype.unstable_scheduleHydration=function(e){if(e){var t=xt();e={blockedOn:null,target:e,priority:t};for(var n=0;n<Ah.length&&t!==0&&t<Ah[n].priority;n++);Ah.splice(n,0,e),n===0&&Fh(e)}};var Kh=n.version;if(Kh!==`19.3.1`)throw Error(i(527,Kh,`19.3.1`));M.findDOMNode=function(e){var t=e._reactInternals;if(t===void 0)throw typeof e.render==`function`?Error(i(188)):(e=Object.keys(e).join(`,`),Error(i(268,e)));return e=u(t),e=e===null?null:d(e),e=e===null?null:e.stateNode,e};var qh={bundleType:0,version:`19.3.1`,rendererPackageName:`react-dom`,currentDispatcherRef:j,reconcilerVersion:`19.3.1`};if(typeof __REACT_DEVTOOLS_GLOBAL_HOOK__<`u`){var Jh=__REACT_DEVTOOLS_GLOBAL_HOOK__;if(!Jh.isDisabled&&Jh.supportsFiber)try{Ze=Jh.inject(qh),Qe=Jh}catch{}}e.createRoot=function(e,t){if(!a(e))throw Error(i(299));var n=!1,r=``,o=Cc,s=wc,c=Tc;return t!=null&&(!0===t.unstable_strictMode&&(n=!0),t.identifierPrefix!==void 0&&(r=t.identifierPrefix),t.onUncaughtError!==void 0&&(o=t.onUncaughtError),t.onCaughtError!==void 0&&(s=t.onCaughtError),t.onRecoverableError!==void 0&&(c=t.onRecoverableError)),t=lh(e,1,!1,null,null,n,r,null,o,s,c,Uh),e[Et]=t.current,Wf(e),new Wh(t)}})),xa=o(((e,t)=>{function n(){if(!(typeof __REACT_DEVTOOLS_GLOBAL_HOOK__>`u`||typeof __REACT_DEVTOOLS_GLOBAL_HOOK__.checkDCE!=`function`))try{__REACT_DEVTOOLS_GLOBAL_HOOK__.checkDCE(n)}catch(e){console.error(e)}}n(),t.exports=ba()})),L=c(ha()),Sa=c(xa(),1);function Ca(e){if(e===void 0)throw ReferenceError(`this hasn't been initialised - super() hasn't been called`);return e}function wa(e,t){e.prototype=Object.create(t.prototype),e.prototype.constructor=e,e.__proto__=t}var Ta={autoSleep:120,force3D:`auto`,nullTargetWarn:1,units:{lineHeight:``}},Ea={duration:.5,overwrite:!1,delay:0},Da,R,Oa,ka=1e8,z=1/ka,Aa=Math.PI*2,ja=Aa/4,Ma=0,Na=Math.sqrt,Pa=Math.cos,Fa=Math.sin,Ia=function(e){return typeof e==`string`},La=function(e){return typeof e==`function`},Ra=function(e){return typeof e==`number`},za=function(e){return e===void 0},Ba=function(e){return typeof e==`object`},Va=function(e){return e!==!1},Ha=function(){return typeof window<`u`},Ua=function(e){return La(e)||Ia(e)},Wa=typeof ArrayBuffer==`function`&&ArrayBuffer.isView||function(){},Ga=Array.isArray,Ka=/random\([^)]+\)/g,qa=/,\s*/g,Ja=/(?:-?\.?\d|\.)+/gi,Ya=/[-+=.]*\d+[.e\-+]*\d*[e\-+]*\d*/g,Xa=/[-+=.]*\d+[.e-]*\d*[a-z%]*/g,Za=/[-+=.]*\d+\.?\d*(?:e-|e\+)?\d*/gi,Qa=/[+-]=-?[.\d]+/,$a=/[^,'"\[\]\s]+/gi,eo=/^[+\-=e\s\d]*\d+[.\d]*([a-z]*|%)\s*$/i,to,no,ro,io,ao={},oo={},so,co=function(e){return(oo=Bo(e,ao))&&nl},lo=function(e,t){return console.warn(`Invalid property`,e,`set to`,t,`Missing plugin? gsap.registerPlugin()`)},uo=function(e,t){return!t&&console.warn(e)},fo=function(e,t){return e&&(ao[e]=t)&&oo&&(oo[e]=t)||ao},po=function(){return 0},mo={suppressEvents:!0,isStart:!0,kill:!1},ho={suppressEvents:!0,kill:!1},go={suppressEvents:!0},_o={},vo=[],yo={},bo,xo={},So={},Co=30,wo=[],To=``,Eo=function(e){var t=e[0],n,r;if(Ba(t)||La(t)||(e=[e]),!(n=(t._gsap||{}).harness)){for(r=wo.length;r--&&!wo[r].targetTest(t););n=wo[r]}for(r=e.length;r--;)e[r]&&(e[r]._gsap||(e[r]._gsap=new fc(e[r],n)))||e.splice(r,1);return e},Do=function(e){return e._gsap||Eo(xs(e))[0]._gsap},Oo=function(e,t,n){return(n=e[t])&&La(n)?e[t]():za(n)&&e.getAttribute&&e.getAttribute(t)||n},ko=function(e,t){return(e=e.split(`,`)).forEach(t)||e},Ao=function(e){return Math.round(e*1e5)/1e5||0},jo=function(e){return Math.round(e*1e7)/1e7||0},Mo=function(e,t){var n=t.charAt(0),r=parseFloat(t.substr(2));return e=parseFloat(e),n===`+`?e+r:n===`-`?e-r:n===`*`?e*r:e/r},No=function(e,t){for(var n=t.length,r=0;e.indexOf(t[r])<0&&++r<n;);return r<n},Po=function(){var e=vo.length,t=vo.slice(0),n,r;for(yo={},vo.length=0,n=0;n<e;n++)r=t[n],r&&r._lazy&&(r.render(r._lazy[0],r._lazy[1],!0)._lazy=0)},Fo=function(e){return!!(e._initted||e._startAt||e.add)},Io=function(e,t,n,r){vo.length&&!R&&Po(),e.render(t,n,r||!!(R&&t<0&&Fo(e))),vo.length&&!R&&Po()},Lo=function(e){var t=parseFloat(e);return(t||t===0)&&(e+``).match($a).length<2?t:Ia(e)?e.trim():e},Ro=function(e){return e},B=function(e,t){for(var n in t)n in e||(e[n]=t[n]);return e},zo=function(e){return function(t,n){for(var r in n)r in t||r===`duration`&&e||r===`ease`||(t[r]=n[r])}},Bo=function(e,t){for(var n in t)e[n]=t[n];return e},Vo=function e(t,n){for(var r in n)r!==`__proto__`&&r!==`constructor`&&r!==`prototype`&&(t[r]=Ba(n[r])?e(t[r]||(t[r]={}),n[r]):n[r]);return t},Ho=function(e,t){var n={},r;for(r in e)r in t||(n[r]=e[r]);return n},V=function(e){var t=e.parent||to,n=e.keyframes?zo(Ga(e.keyframes)):B;if(Va(e.inherit))for(;t;)n(e,t.vars.defaults),t=t.parent||t._dp;return e},H=function(e,t){for(var n=e.length,r=n===t.length;r&&n--&&e[n]===t[n];);return n<0},Uo=function(e,t,n,r,i){n===void 0&&(n=`_first`),r===void 0&&(r=`_last`);var a=e[r],o;if(i)for(o=t[i];a&&a[i]>o;)a=a._prev;return a?(t._next=a._next,a._next=t):(t._next=e[n],e[n]=t),t._next?t._next._prev=t:e[r]=t,t._prev=a,t.parent=t._dp=e,t},Wo=function(e,t,n,r){n===void 0&&(n=`_first`),r===void 0&&(r=`_last`);var i=t._prev,a=t._next;i?i._next=a:e[n]===t&&(e[n]=a),a?a._prev=i:e[r]===t&&(e[r]=i),t._next=t._prev=t.parent=null},Go=function(e,t){e.parent&&(!t||e.parent.autoRemoveChildren)&&e.parent.remove&&e.parent.remove(e),e._act=0},Ko=function(e,t){if(e&&(!t||t._end>e._dur||t._start<0))for(var n=e;n;)n._dirty=1,n=n.parent;return e},qo=function(e){for(var t=e.parent;t&&t.parent;)t._dirty=1,t.totalDuration(),t=t.parent;return e},Jo=function(e,t,n,r){return e._startAt&&(R?e._startAt.revert(ho):e.vars.immediateRender&&!e.vars.autoRevert||e._startAt.render(t,!0,r))},Yo=function e(t){return!t||t._ts&&e(t.parent)},Xo=function(e){return e._repeat?Zo(e._tTime,e=e.duration()+e._rDelay)*e:0},Zo=function(e,t){var n=Math.floor(e=jo(e/t));return e&&n===e?n-1:n},Qo=function(e,t){return(e-t._start)*t._ts+(t._ts>=0?0:t._dirty?t.totalDuration():t._tDur)},$o=function(e){return e._end=jo(e._start+(e._tDur/Math.abs(e._ts||e._rts||z)||0))},es=function(e,t){var n=e._dp;return n&&n.smoothChildTiming&&e._ts&&(e._start=jo(n._time-(e._ts>0?t/e._ts:((e._dirty?e.totalDuration():e._tDur)-t)/-e._ts)),$o(e),n._dirty||Ko(n,e)),e},ts=function(e,t){var n;if((t._time||!t._dur&&t._initted||t._start<e._time&&(t._dur||!t.add))&&(n=Qo(e.rawTime(),t),(!t._dur||hs(0,t.totalDuration(),n)-t._tTime>z)&&t.render(n,!0)),Ko(e,t)._dp&&e._initted&&e._time>=e._dur&&e._ts){if(e._dur<e.duration())for(n=e;n._dp;)n.rawTime()>=0&&n.totalTime(n._tTime),n=n._dp;e._zTime=-z}},ns=function(e,t,n,r){return t.parent&&Go(t),t._start=jo((Ra(n)?n:!n&&os(t)&&(!e._last||e._last._start>=e._time)?e._last?e._last._start:e._time:n||e!==to?fs(e,n,t):e._time)+t._delay),t._end=jo(t._start+(t.totalDuration()/Math.abs(t.timeScale())||0)),Uo(e,t,`_first`,`_last`,e._sort?`_start`:0),os(t)||(e._recent=t),r||ts(e,t),e._ts<0&&es(e,e._tTime),e},rs=function(e,t){return(ao.ScrollTrigger||lo(`scrollTrigger`,t))&&ao.ScrollTrigger.create(t,e)},is=function(e,t,n,r,i){if(xc(e,t,i),!e._initted)return 1;if(!n&&e._pt&&!R&&(e._dur&&e.vars.lazy!==!1||!e._dur&&e.vars.lazy)&&bo!==$s.frame)return vo.push(e),e._lazy=[i,r],1},as=function e(t){var n=t.parent;return n&&n._ts&&n._initted&&!n._lock&&(n.rawTime()<0||e(n))},os=function(e){var t=e.data;return t===`isFromStart`||t===`isStart`},ss=function(e,t,n,r){var i=e.ratio,a=t<0||!t&&(!e._start&&as(e)&&!(!e._initted&&os(e))||(e._ts<0||e._dp._ts<0)&&!os(e))?0:1,o=e._rDelay,s=0,c,l,u;if(o&&e._repeat&&(s=hs(0,e._tDur,t),l=Zo(s,o),e._yoyo&&l&1&&(a=1-a),l!==Zo(e._tTime,o)&&(i=1-a,e.vars.repeatRefresh&&e._initted&&e.invalidate())),a!==i||R||r||e._zTime===z||!t&&e._zTime){if(!e._initted&&is(e,t,r,n,s))return;for(u=e._zTime,e._zTime=t||(n?z:0),n||=t&&!u,e.ratio=a,e._from&&(a=1-a),e._time=0,e._tTime=s,c=e._pt;c;)c.r(a,c.d),c=c._next;t<0&&Jo(e,t,n,!0),e._onUpdate&&!n&&Rs(e,`onUpdate`),s&&e._repeat&&!n&&e.parent&&Rs(e,`onRepeat`),(t>=e._tDur||t<0)&&e.ratio===a&&(a&&Go(e,1),!n&&!R&&(Rs(e,a?`onComplete`:`onReverseComplete`,!0),e._prom&&e._prom()))}else e._zTime||=t},cs=function(e,t,n){var r;if(n>t)for(r=e._first;r&&r._start<=n;){if(r.data===`isPause`&&r._start>t)return r;r=r._next}else for(r=e._last;r&&r._start>=n;){if(r.data===`isPause`&&r._start<t)return r;r=r._prev}},ls=function(e,t,n,r){var i=e._repeat,a=jo(t)||0,o=e._tTime/e._tDur;return o&&!r&&(e._time*=a/e._dur),e._dur=a,e._tDur=i?i<0?1e10:jo(a*(i+1)+e._rDelay*i):a,o>0&&!r&&es(e,e._tTime=e._tDur*o),e.parent&&$o(e),n||Ko(e.parent,e),e},us=function(e){return e instanceof mc?Ko(e):ls(e,e._dur)},ds={_start:0,endTime:po,totalDuration:po},fs=function e(t,n,r){var i=t.labels,a=t._recent||ds,o=t.duration()>=ka?a.endTime(!1):t._dur,s,c,l;return Ia(n)&&(isNaN(n)||n in i)?(c=n.charAt(0),l=n.substr(-1)===`%`,s=n.indexOf(`=`),c===`<`||c===`>`?(s>=0&&(n=n.replace(/=/,``)),(c===`<`?a._start:a.endTime(a._repeat>=0))+(parseFloat(n.substr(1))||0)*(l?(s<0?a:r).totalDuration()/100:1)):s<0?(n in i||(i[n]=o),i[n]):(c=parseFloat(n.charAt(s-1)+n.substr(s+1)),l&&r&&(c=c/100*(Ga(r)?r[0]:r).totalDuration()),s>1?e(t,n.substr(0,s-1),r)+c:o+c)):n==null?o:+n},ps=function(e,t,n){var r=Ra(t[1]),i=(r?2:1)+(e<2?0:1),a=t[i],o,s;if(r&&(a.duration=t[1]),a.parent=n,e){for(o=a,s=n;s&&!(`immediateRender`in o);)o=s.vars.defaults||{},s=Va(s.vars.inherit)&&s.parent;a.immediateRender=Va(o.immediateRender),e<2?a.runBackwards=1:a.startAt=t[i-1]}return new Oc(t[0],a,t[i+1])},ms=function(e,t){return e||e===0?t(e):t},hs=function(e,t,n){return n<e?e:n>t?t:n},gs=function(e,t){return!Ia(e)||!(t=eo.exec(e))?``:t[1]},_s=function(e,t,n){return ms(n,function(n){return hs(e,t,n)})},vs=[].slice,ys=function(e,t){return e&&Ba(e)&&`length`in e&&(!t&&!e.length||e.length-1 in e&&Ba(e[0]))&&!e.nodeType&&e!==no},bs=function(e,t,n){return n===void 0&&(n=[]),e.forEach(function(e){var r;return Ia(e)&&!t||ys(e,1)?(r=n).push.apply(r,xs(e)):n.push(e)})||n},xs=function(e,t,n){return Oa&&!t&&Oa.selector?Oa.selector(e):Ia(e)&&!n&&(ro||!ec())?vs.call((t||io).querySelectorAll(e),0):Ga(e)?bs(e,n):ys(e)?vs.call(e,0):e?[e]:[]},Ss=function(e){return e=xs(e)[0]||uo(`Invalid scope`)||{},function(t){var n=e.current||e.nativeElement||e;return xs(t,n.querySelectorAll?n:n===e?uo(`Invalid scope`)||io.createElement(`div`):e)}},Cs=function(e){return e.sort(function(){return .5-Math.random()})},ws=function(e){if(La(e))return e;var t=Ba(e)?e:{each:e},n=sc(t.ease),r=t.from||0,i=parseFloat(t.base)||0,a={},o=r>0&&r<1,s=isNaN(r)||o,c=t.axis,l=r,u=r;return Ia(r)?l=u={center:.5,edges:.5,end:1}[r]||0:!o&&s&&(l=r[0],u=r[1]),function(e,o,d){var f=(d||t).length,p=a[f],m,h,g,_,v,y,b,x,S;if(!p){if(S=t.grid===`auto`?0:(t.grid||[1,ka])[1],!S){for(b=-ka;b<(b=d[S++].getBoundingClientRect().left)&&S<f;);S<f&&S--}for(p=a[f]=[],m=s?Math.min(S,f)*l-.5:r%S,h=S===ka?0:s?f*u/S-.5:r/S|0,b=0,x=ka,y=0;y<f;y++)g=y%S-m,_=h-(y/S|0),p[y]=v=c?Math.abs(c===`y`?_:g):Na(g*g+_*_),v>b&&(b=v),v<x&&(x=v);r===`random`&&Cs(p),p.max=b-x,p.min=x,p.v=f=(parseFloat(t.amount)||parseFloat(t.each)*(S>f?f-1:c?c===`y`?f/S:S:Math.max(S,f/S))||0)*(r===`edges`?-1:1),p.b=f<0?i-f:i,p.u=gs(t.amount||t.each)||0,n=n&&f<0?oc(n):n}return f=(p[e]-p.min)/p.max||0,jo(p.b+(n?n(f):f)*p.v)+p.u}},Ts=function(e){var t=10**((e+``).split(`.`)[1]||``).length;return function(n){var r=jo(Math.round(parseFloat(n)/e)*e*t);return(r-r%1)/t+(Ra(n)?0:gs(n))}},Es=function(e,t){var n=Ga(e),r,i;return!n&&Ba(e)&&(r=n=e.radius||ka,e.values?(e=xs(e.values),(i=!Ra(e[0]))&&(r*=r)):e=Ts(e.increment)),ms(t,n?La(e)?function(t){return i=e(t),Math.abs(i-t)<=r?i:t}:function(t){for(var n=parseFloat(i?t.x:t),a=parseFloat(i?t.y:0),o=ka,s=0,c=e.length,l,u;c--;)i?(l=e[c].x-n,u=e[c].y-a,l=l*l+u*u):l=Math.abs(e[c]-n),l<o&&(o=l,s=c);return s=!r||o<=r?e[s]:t,i||s===t||Ra(t)?s:s+gs(t)}:Ts(e))},Ds=function(e,t,n,r){return ms(Ga(e)?!t:n===!0?!!(n=0):!r,function(){return Ga(e)?e[~~(Math.random()*e.length)]:(n||=1e-5)&&(r=n<1?10**((n+``).length-2):1)&&Math.floor(Math.round((e-n/2+Math.random()*(t-e+n*.99))/n)*n*r)/r})},Os=function(){var e=[...arguments];return function(t){return e.reduce(function(e,t){return t(e)},t)}},ks=function(e,t){return function(n){return e(parseFloat(n))+(t||gs(n))}},As=function(e,t,n){return Fs(e,t,0,1,n)},js=function(e,t,n){return ms(n,function(n){return e[~~t(n)]})},Ms=function e(t,n,r){var i=n-t;return Ga(t)?js(t,e(0,t.length),n):ms(r,function(e){return(i+(e-t)%i)%i+t})},Ns=function e(t,n,r){var i=n-t,a=i*2;return Ga(t)?js(t,e(0,t.length-1),n):ms(r,function(e){return e=(a+(e-t)%a)%a||0,t+(e>i?a-e:e)})},Ps=function(e){return e.replace(Ka,function(e){var t=e.indexOf(`[`)+1,n=e.substring(t||7,t?e.indexOf(`]`):e.length-1).split(qa);return Ds(t?n:+n[0],t?0:+n[1],+n[2]||1e-5)})},Fs=function(e,t,n,r,i){var a=t-e,o=r-n;return ms(i,function(t){return n+((t-e)/a*o||0)})},Is=function e(t,n,r,i){var a=isNaN(t+n)?0:function(e){return(1-e)*t+e*n};if(!a){var o=Ia(t),s={},c,l,u,d,f;if(r===!0&&(i=1)&&(r=null),o)t={p:t},n={p:n};else if(Ga(t)&&!Ga(n)){for(u=[],d=t.length,f=d-2,l=1;l<d;l++)u.push(e(t[l-1],t[l]));d--,a=function(e){e*=d;var t=Math.min(f,~~e);return u[t](e-t)},r=n}else i||(t=Bo(Ga(t)?[]:{},t));if(!u){for(c in n)gc.call(s,t,c,`get`,n[c]);a=function(e){return Lc(e,s)||(o?t.p:t)}}}return ms(r,a)},Ls=function(e,t,n){var r=e.labels,i=ka,a,o,s;for(a in r)o=r[a]-t,o<0==!!n&&o&&i>(o=Math.abs(o))&&(s=a,i=o);return s},Rs=function(e,t,n){var r=e.vars,i=r[t],a=Oa,o=e._ctx,s,c,l;if(i)return s=r[t+`Params`],c=r.callbackScope||e,n&&vo.length&&Po(),o&&(Oa=o),l=s?i.apply(c,s):i.call(c),Oa=a,l},zs=function(e){return Go(e),e.scrollTrigger&&e.scrollTrigger.kill(!!R),e.progress()<1&&Rs(e,`onInterrupt`),e},Bs,Vs=[],Hs=function(e){if(e)if(e=!e.name&&e.default||e,Ha()||e.headless){var t=e.name,n=La(e),r=t&&!n&&e.init?function(){this._props=[]}:e,i={init:po,render:Lc,add:gc,kill:zc,modifier:Rc,rawVars:0},a={targetTest:0,get:0,getSetter:Nc,aliases:{},register:0};if(ec(),e!==r){if(xo[t])return;B(r,B(Ho(e,i),a)),Bo(r.prototype,Bo(i,Ho(e,a))),xo[r.prop=t]=r,e.targetTest&&(wo.push(r),_o[t]=1),t=(t===`css`?`CSS`:t.charAt(0).toUpperCase()+t.substr(1))+`Plugin`}fo(t,r),e.register&&e.register(nl,r,Hc)}else Vs.push(e)},Us=255,Ws={aqua:[0,Us,Us],lime:[0,Us,0],silver:[192,192,192],black:[0,0,0],maroon:[128,0,0],teal:[0,128,128],blue:[0,0,Us],navy:[0,0,128],white:[Us,Us,Us],olive:[128,128,0],yellow:[Us,Us,0],orange:[Us,165,0],gray:[128,128,128],purple:[128,0,128],green:[0,128,0],red:[Us,0,0],pink:[Us,192,203],cyan:[0,Us,Us],transparent:[Us,Us,Us,0]},Gs=function(e,t,n){return e+=e<0?1:e>1?-1:0,(e*6<1?t+(n-t)*e*6:e<.5?n:e*3<2?t+(n-t)*(2/3-e)*6:t)*Us+.5|0},Ks=function(e,t,n){var r=e?Ra(e)?[e>>16,e>>8&Us,e&Us]:0:Ws.black,i,a,o,s,c,l,u,d,f,p;if(!r){if(e.substr(-1)===`,`&&(e=e.substr(0,e.length-1)),Ws[e])r=Ws[e];else if(e.charAt(0)===`#`){if(e.length<6&&(i=e.charAt(1),a=e.charAt(2),o=e.charAt(3),e=`#`+i+i+a+a+o+o+(e.length===5?e.charAt(4)+e.charAt(4):``)),e.length===9)return r=parseInt(e.substr(1,6),16),[r>>16,r>>8&Us,r&Us,parseInt(e.substr(7),16)/255];e=parseInt(e.substr(1),16),r=[e>>16,e>>8&Us,e&Us]}else if(e.substr(0,3)===`hsl`){if(r=p=e.match(Ja),!t)s=r[0]%360/360,c=r[1]/100,l=r[2]/100,a=l<=.5?l*(c+1):l+c-l*c,i=l*2-a,r.length>3&&(r[3]*=1),r[0]=Gs(s+1/3,i,a),r[1]=Gs(s,i,a),r[2]=Gs(s-1/3,i,a);else if(~e.indexOf(`=`))return r=e.match(Ya),n&&r.length<4&&(r[3]=1),r}else r=e.match(Ja)||Ws.transparent;r=r.map(Number)}return t&&!p&&(i=r[0]/Us,a=r[1]/Us,o=r[2]/Us,u=Math.max(i,a,o),d=Math.min(i,a,o),l=(u+d)/2,u===d?s=c=0:(f=u-d,c=l>.5?f/(2-u-d):f/(u+d),s=u===i?(a-o)/f+(a<o?6:0):u===a?(o-i)/f+2:(i-a)/f+4,s*=60),r[0]=~~(s+.5),r[1]=~~(c*100+.5),r[2]=~~(l*100+.5)),n&&r.length<4&&(r[3]=1),r},qs=function(e){var t=[],n=[],r=-1;return e.split(Ys).forEach(function(e){var i=e.match(Xa)||[];t.push.apply(t,i),n.push(r+=i.length+1)}),t.c=n,t},Js=function(e,t,n){var r=``,i=(e+r).match(Ys),a=t?`hsla(`:`rgba(`,o=0,s,c,l,u;if(!i)return e;if(i=i.map(function(e){return(e=Ks(e,t,1))&&a+(t?e[0]+`,`+e[1]+`%,`+e[2]+`%,`+e[3]:e.join(`,`))+`)`}),n&&(l=qs(e),s=n.c,s.join(r)!==l.c.join(r)))for(c=e.replace(Ys,`1`).split(Xa),u=c.length-1;o<u;o++)r+=c[o]+(~s.indexOf(o)?i.shift()||a+`0,0,0,0)`:(l.length?l:i.length?i:n).shift());if(!c)for(c=e.split(Ys),u=c.length-1;o<u;o++)r+=c[o]+i[o];return r+c[u]},Ys=function(){var e=`(?:\\b(?:(?:rgb|rgba|hsl|hsla)\\(.+?\\))|\\B#(?:[0-9a-f]{3,4}){1,2}\\b`,t;for(t in Ws)e+=`|`+t+`\\b`;return RegExp(e+`)`,`gi`)}(),Xs=/hsl[a]?\(/,Zs=function(e){var t=e.join(` `),n;if(Ys.lastIndex=0,Ys.test(t))return n=Xs.test(t),e[1]=Js(e[1],n),e[0]=Js(e[0],n,qs(e[1])),!0},Qs,$s=function(){var e=Date.now,t=500,n=33,r=e(),i=r,a=1e3/240,o=a,s=[],c,l,u,d,f,p,m=function u(m){var h=e()-i,g=m===!0,_,v,y,b;if((h>t||h<0)&&(r+=h-n),i+=h,y=i-r,_=y-o,(_>0||g)&&(b=++d.frame,f=y-d.time*1e3,d.time=y/=1e3,o+=_+(_>=a?0:a-_),v=1),g||(c=l(u)),v)for(p=0;p<s.length;p++)s[p](y,f,b,m)};return d={time:0,frame:0,tick:function(){m(!0)},deltaRatio:function(e){return f/(1e3/(e||60))},wake:function(){so&&(!ro&&Ha()&&(no=ro=window,io=no.document||{},ao.gsap=nl,(no.gsapVersions||=[]).push(nl.version),co(oo||no.GreenSockGlobals||!no.gsap&&no||{}),Vs.forEach(Hs)),u=typeof requestAnimationFrame<`u`&&requestAnimationFrame,c&&d.sleep(),l=u||function(e){return setTimeout(e,o-d.time*1e3+1|0)},Qs=1,m(2))},sleep:function(){(u?cancelAnimationFrame:clearTimeout)(c),Qs=0,l=po},lagSmoothing:function(e,r){t=e||1/0,n=Math.min(r||33,t)},fps:function(e){a=1e3/(e||240),o=d.time*1e3+a},add:function(e,t,n){var r=t?function(t,n,i,a){e(t,n,i,a),d.remove(r)}:e;return d.remove(e),s[n?`unshift`:`push`](r),ec(),r},remove:function(e,t){~(t=s.indexOf(e))&&s.splice(t,1)&&p>=t&&p--},_listeners:s},d}(),ec=function(){return!Qs&&$s.wake()},U={},tc=/^[\d.\-M][\d.\-,\s]/,nc=/["']/g,rc=function(e){for(var t={},n=e.substr(1,e.length-3).split(`:`),r=n[0],i=1,a=n.length,o,s,c;i<a;i++)s=n[i],o=i===a-1?s.length:s.lastIndexOf(`,`),c=s.substr(0,o),t[r]=isNaN(c)?c.replace(nc,``).trim():+c,r=s.substr(o+1).trim();return t},ic=function(e){var t=e.indexOf(`(`)+1,n=e.indexOf(`)`),r=e.indexOf(`(`,t);return e.substring(t,~r&&r<n?e.indexOf(`)`,n+1):n)},ac=function(e){var t=(e+``).split(`(`),n=U[t[0]];return n&&t.length>1&&n.config?n.config.apply(null,~e.indexOf(`{`)?[rc(t[1])]:ic(e).split(`,`).map(Lo)):U._CE&&tc.test(e)?U._CE(``,e):n},oc=function(e){return function(t){return 1-e(1-t)}},sc=function(e,t){return e&&(La(e)?e:U[e]||ac(e))||t},cc=function(e,t,n,r){n===void 0&&(n=function(e){return 1-t(1-e)}),r===void 0&&(r=function(e){return e<.5?t(e*2)/2:1-t((1-e)*2)/2});var i={easeIn:t,easeOut:n,easeInOut:r},a;return ko(e,function(e){for(var t in U[e]=ao[e]=i,U[a=e.toLowerCase()]=n,i)U[a+(t===`easeIn`?`.in`:t===`easeOut`?`.out`:`.inOut`)]=U[e+`.`+t]=i[t]}),i},lc=function(e){return function(t){return t<.5?(1-e(1-t*2))/2:.5+e((t-.5)*2)/2}},uc=function e(t,n,r){var i=n>=1?n:1,a=(r||(t?.3:.45))/(n<1?n:1),o=a/Aa*(Math.asin(1/i)||0),s=function(e){return e===1?1:i*2**(-10*e)*Fa((e-o)*a)+1},c=t===`out`?s:t===`in`?function(e){return 1-s(1-e)}:lc(s);return a=Aa/a,c.config=function(n,r){return e(t,n,r)},c},dc=function e(t,n){n===void 0&&(n=1.70158);var r=function(e){return e?--e*e*((n+1)*e+n)+1:0},i=t===`out`?r:t===`in`?function(e){return 1-r(1-e)}:lc(r);return i.config=function(n){return e(t,n)},i};ko(`Linear,Quad,Cubic,Quart,Quint,Strong`,function(e,t){var n=t<5?t+1:t;cc(e+`,Power`+(n-1),t?function(e){return e**+n}:function(e){return e},function(e){return 1-(1-e)**n},function(e){return e<.5?(e*2)**n/2:1-((1-e)*2)**n/2})}),U.Linear.easeNone=U.none=U.Linear.easeIn,cc(`Elastic`,uc(`in`),uc(`out`),uc()),(function(e,t){var n=1/t,r=2*n,i=2.5*n,a=function(a){return a<n?e*a*a:a<r?e*(a-1.5/t)**2+.75:a<i?e*(a-=2.25/t)*a+.9375:e*(a-2.625/t)**2+.984375};cc(`Bounce`,function(e){return 1-a(1-e)},a)})(7.5625,2.75),cc(`Expo`,function(e){return 2**(10*(e-1))*e+e*e*e*e*e*e*(1-e)}),cc(`Circ`,function(e){return-(Na(1-e*e)-1)}),cc(`Sine`,function(e){return e===1?1:-Pa(e*ja)+1}),cc(`Back`,dc(`in`),dc(`out`),dc()),U.SteppedEase=U.steps=ao.SteppedEase={config:function(e,t){e===void 0&&(e=1);var n=1/e,r=e+ +!t,i=+!!t,a=1-z;return function(e){return((r*hs(0,a,e)|0)+i)*n}}},Ea.ease=U[`quad.out`],ko(`onComplete,onUpdate,onStart,onRepeat,onReverseComplete,onInterrupt`,function(e){return To+=e+`,`+e+`Params,`});var fc=function(e,t){this.id=Ma++,e._gsap=this,this.target=e,this.harness=t,this.get=t?t.get:Oo,this.set=t?t.getSetter:Nc},pc=function(){function e(e){this.vars=e,this._delay=+e.delay||0,(this._repeat=e.repeat===1/0?-2:e.repeat||0)&&(this._rDelay=e.repeatDelay||0,this._yoyo=!!e.yoyo||!!e.yoyoEase),this._ts=1,ls(this,+e.duration,1,1),this.data=e.data,Oa&&(this._ctx=Oa,Oa.data.push(this)),Qs||$s.wake()}var t=e.prototype;return t.delay=function(e){return e||e===0?(this.parent&&this.parent.smoothChildTiming&&this.startTime(this._start+e-this._delay),this._delay=e,this):this._delay},t.duration=function(e){return arguments.length?this.totalDuration(this._repeat>0?e+(e+this._rDelay)*this._repeat:e):this.totalDuration()&&this._dur},t.totalDuration=function(e){return arguments.length?(this._dirty=0,ls(this,this._repeat<0?e:(e-this._repeat*this._rDelay)/(this._repeat+1))):this._tDur},t.totalTime=function(e,t){if(ec(),!arguments.length)return this._tTime;var n=this._dp;if(n&&n.smoothChildTiming&&this._ts){for(es(this,e),!n._dp||n.parent||ts(n,this);n&&n.parent;)n.parent._time!==n._start+(n._ts>=0?n._tTime/n._ts:(n.totalDuration()-n._tTime)/-n._ts)&&n.totalTime(n._tTime,!0),n=n.parent;!this.parent&&this._dp.autoRemoveChildren&&(this._ts>0&&e<this._tDur||this._ts<0&&e>0||!this._tDur&&!e)&&ns(this._dp,this,this._start-this._delay)}return(this._tTime!==e||!this._dur&&!t||this._initted&&Math.abs(this._zTime)===z||!this._initted&&this._dur&&e||!e&&!this._initted&&(this.add||this._ptLookup))&&(this._ts||(this._pTime=e),Io(this,e,t)),this},t.time=function(e,t){return arguments.length?this.totalTime(Math.min(this.totalDuration(),e+Xo(this))%(this._dur+this._rDelay)||(e?this._dur:0),t):this._time},t.totalProgress=function(e,t){return arguments.length?this.totalTime(this.totalDuration()*e,t):this.totalDuration()?Math.min(1,this._tTime/this._tDur):this.rawTime()>=0&&this._initted?1:0},t.progress=function(e,t){return arguments.length?this.totalTime(this.duration()*(this._yoyo&&!(this.iteration()&1)?1-e:e)+Xo(this),t):this.duration()?Math.min(1,this._time/this._dur):+(this.rawTime()>0)},t.iteration=function(e,t){var n=this.duration()+this._rDelay;return arguments.length?this.totalTime(this._time+(e-1)*n,t):this._repeat?Zo(this._tTime,n)+1:1},t.timeScale=function(e,t){if(!arguments.length)return this._rts===-z?0:this._rts;if(this._rts===e)return this;var n=this.parent&&this._ts?Qo(this.parent._time,this):this._tTime,r=this._rts<0;this._rts=+e||0,this._ts=this._ps||e===-z?0:this._rts;var i=this.totalDuration();return(r!==this._rts<0||n>0&&n<i)&&this.totalTime(hs(-Math.abs(this._delay),i,n),t!==!1),$o(this),qo(this)},t.paused=function(e){if(!arguments.length)return this._ps;if(this._ps!==e)if(this._ps=e,e)this._pTime=this._tTime||Math.max(-this._delay,this.rawTime()),this._ts=this._act=0;else{ec(),this._ts=this._rts;var t=this.parent&&!this.parent.smoothChildTiming?this.rawTime():this._tTime||this._pTime,n=this.progress()===1&&Math.abs(this._zTime)!==z,r;if(n)for(this._tTime-=z,r=this._first;r;){if(!r._dur&&r._zTime<0&&r._ts&&r._start<=t+z){n=!1;break}r=r._next}this.totalTime(t,n)}return this},t.startTime=function(e){if(arguments.length){this._start=jo(e);var t=this.parent||this._dp;return t&&(t._sort||!this.parent)&&ns(t,this,this._start-this._delay),this}return this._start},t.endTime=function(e){return this._start+(Va(e)?this.totalDuration():this.duration())/Math.abs(this._ts||1)},t.rawTime=function(e){var t=this.parent||this._dp;return t?e&&(!this._ts||this._repeat&&this._time&&this.totalProgress()<1)?this._tTime%(this._dur+this._rDelay):this._ts?Qo(t.rawTime(e),this):this._tTime:this._tTime},t.revert=function(e){e===void 0&&(e=go);var t=R;return R=e,Fo(this)&&(this.timeline&&this.timeline.revert(e),this.totalTime(-.01,e.suppressEvents)),this.data!==`nested`&&e.kill!==!1&&this.kill(),R=t,this},t.globalTime=function(e){for(var t=this,n=arguments.length?e:t.rawTime();t;)n=t._start+n/(Math.abs(t._ts)||1),t=t._dp;return!this.parent&&this._sat?this._sat.globalTime(e):n},t.repeat=function(e){return arguments.length?(this._repeat=e===1/0?-2:e,us(this)):this._repeat===-2?1/0:this._repeat},t.repeatDelay=function(e){if(arguments.length){var t=this._time;return this._rDelay=e,us(this),t?this.time(t):this}return this._rDelay},t.yoyo=function(e){return arguments.length?(this._yoyo=e,this):this._yoyo},t.seek=function(e,t){return this.totalTime(fs(this,e),Va(t))},t.restart=function(e,t){return this.play().totalTime(e?-this._delay:0,Va(t)),this._dur||(this._zTime=-z),this},t.play=function(e,t){return e!=null&&this.seek(e,t),this.reversed(!1).paused(!1)},t.reverse=function(e,t){return e!=null&&this.seek(e||this.totalDuration(),t),this.reversed(!0).paused(!1)},t.pause=function(e,t){return e!=null&&this.seek(e,t),this.paused(!0)},t.resume=function(){return this.paused(!1)},t.reversed=function(e){return arguments.length?(!!e!==this.reversed()&&this.timeScale(-this._rts||(e?-z:0)),this):this._rts<0},t.invalidate=function(){return this._initted=this._act=0,this._zTime=-z,this},t.isActive=function(){var e=this.parent||this._dp,t=this._start,n;return!!(!e||this._ts&&this._initted&&e.isActive()&&(n=e.rawTime(!0))>=t&&n<this.endTime(!0)-z)},t.eventCallback=function(e,t,n){var r=this.vars;return arguments.length>1?(t?(r[e]=t,n&&(r[e+`Params`]=n),e===`onUpdate`&&(this._onUpdate=t)):delete r[e],this):r[e]},t.then=function(e){var t=this,n=t._prom;return new Promise(function(r){var i=La(e)?e:Ro,a=function(){var e=t.then;t.then=null,n&&n(),La(i)&&(i=i(t))&&(i.then||i===t)&&(t.then=e),r(i),t.then=e};t._initted&&t.totalProgress()===1&&t._ts>=0||!t._tTime&&t._ts<0?a():t._prom=a})},t.kill=function(){zs(this)},e}();B(pc.prototype,{_time:0,_start:0,_end:0,_tTime:0,_tDur:0,_dirty:0,_repeat:0,_yoyo:!1,parent:null,_initted:!1,_rDelay:0,_ts:1,_dp:0,ratio:0,_zTime:-z,_prom:0,_ps:!1,_rts:1});var mc=function(e){wa(t,e);function t(t,n){var r;return t===void 0&&(t={}),r=e.call(this,t)||this,r.labels={},r.smoothChildTiming=!!t.smoothChildTiming,r.autoRemoveChildren=!!t.autoRemoveChildren,r._sort=Va(t.sortChildren),to&&ns(t.parent||to,Ca(r),n),t.reversed&&r.reverse(),t.paused&&r.paused(!0),t.scrollTrigger&&rs(Ca(r),t.scrollTrigger),r}var n=t.prototype;return n.to=function(e,t,n){return ps(0,arguments,this),this},n.from=function(e,t,n){return ps(1,arguments,this),this},n.fromTo=function(e,t,n,r){return ps(2,arguments,this),this},n.set=function(e,t,n){return t.duration=0,t.parent=this,V(t).repeatDelay||(t.repeat=0),t.immediateRender=!!t.immediateRender,new Oc(e,t,fs(this,n),1),this},n.call=function(e,t,n){return ns(this,Oc.delayedCall(0,e,t),n)},n.staggerTo=function(e,t,n,r,i,a,o){return n.duration=t,n.stagger=n.stagger||r,n.onComplete=a,n.onCompleteParams=o,n.parent=this,new Oc(e,n,fs(this,i)),this},n.staggerFrom=function(e,t,n,r,i,a,o){return n.runBackwards=1,V(n).immediateRender=Va(n.immediateRender),this.staggerTo(e,t,n,r,i,a,o)},n.staggerFromTo=function(e,t,n,r,i,a,o,s){return r.startAt=n,V(r).immediateRender=Va(r.immediateRender),this.staggerTo(e,t,r,i,a,o,s)},n.render=function(e,t,n){var r=this._time,i=this._dirty?this.totalDuration():this._tDur,a=this._dur,o=e<=0?0:jo(e),s=this._zTime<0!=e<0&&(this._initted||!a),c,l,u,d,f,p,m,h,g,_,v,y;if(this!==to&&o>i&&e>=0&&(o=i),o!==this._tTime||n||s){if(r!==this._time&&a&&(o+=this._time-r,e+=this._time-r),c=o,g=this._start,h=this._ts,p=!h,s&&(a||(r=this._zTime),(e||!t)&&(this._zTime=e)),this._repeat){if(v=this._yoyo,f=a+this._rDelay,this._repeat<-1&&e<0)return this.totalTime(f*100+e,t,n);if(c=jo(o%f),o===i?(d=this._repeat,c=a):(_=jo(o/f),d=~~_,d&&d===_&&(c=a,d--),c>a&&(c=a)),_=Zo(this._tTime,f),!r&&this._tTime&&_!==d&&this._tTime-_*f-this._dur<=0&&(_=d),v&&d&1&&(c=a-c,y=1),d!==_&&!this._lock){var b=v&&_&1,x=b===(v&&d&1);if(d<_&&(b=!b),r=b?0:o%a?a:o,this._lock=1,this.render(r||(y?0:jo(d*f)),t,!a)._lock=0,this._tTime=o,!t&&this.parent&&Rs(this,`onRepeat`),this.vars.repeatRefresh&&!y&&(this.invalidate()._lock=1,_=d),r&&r!==this._time||p!==!this._ts||this.vars.onRepeat&&!this.parent&&!this._act||(a=this._dur,i=this._tDur,x&&(this._lock=2,r=b?a:-1e-4,this.render(r,!0),this.vars.repeatRefresh&&!y&&this.invalidate()),this._lock=0,!this._ts&&!p))return this}}if(this._hasPause&&!this._forcing&&this._lock<2&&(m=cs(this,jo(r),jo(c)),m&&(o-=c-(c=m._start))),this._tTime=o,this._time=c,this._act=!!h,this._initted||(this._onUpdate=this.vars.onUpdate,this._initted=1,this._zTime=e,r=0),!r&&o&&a&&!t&&!_&&(Rs(this,`onStart`),this._tTime!==o))return this;if(c>=r&&e>=0)for(l=this._first;l;){if(u=l._next,(l._act||c>=l._start)&&l._ts&&m!==l){if(l.parent!==this)return this.render(e,t,n);if(l.render(l._ts>0?(c-l._start)*l._ts:(l._dirty?l.totalDuration():l._tDur)+(c-l._start)*l._ts,t,n),c!==this._time||!this._ts&&!p){m=0,u&&(o+=this._zTime=-z);break}}l=u}else{l=this._last;for(var S=e<0?e:c;l;){if(u=l._prev,(l._act||S<=l._end)&&l._ts&&m!==l){if(l.parent!==this)return this.render(e,t,n);if(l.render(l._ts>0?(S-l._start)*l._ts:(l._dirty?l.totalDuration():l._tDur)+(S-l._start)*l._ts,t,n||R&&Fo(l)),c!==this._time||!this._ts&&!p){m=0,u&&(o+=this._zTime=S?-z:z);break}}l=u}}if(m&&!t&&(this.pause(),m.render(c>=r?0:-z)._zTime=c>=r?1:-1,this._ts))return this._start=g,$o(this),this.render(e,t,n);this._onUpdate&&!t&&Rs(this,`onUpdate`,!0),(o===i&&this._tTime>=this.totalDuration()||!o&&r)&&(g===this._start||Math.abs(h)!==Math.abs(this._ts))&&(this._lock||((e||!a)&&(o===i&&this._ts>0||!o&&this._ts<0)&&Go(this,1),!t&&!(e<0&&!r)&&(o||r||!i)&&(Rs(this,o===i&&e>=0?`onComplete`:`onReverseComplete`,!0),this._prom&&!(o<i&&this.timeScale()>0)&&this._prom())))}return this},n.add=function(e,t){var n=this;if(Ra(t)||(t=fs(this,t,e)),!(e instanceof pc)){if(Ga(e))return e.forEach(function(e){return n.add(e,t)}),this;if(Ia(e))return this.addLabel(e,t);if(La(e))e=Oc.delayedCall(0,e);else return this}return this===e?this:ns(this,e,t)},n.getChildren=function(e,t,n,r){e===void 0&&(e=!0),t===void 0&&(t=!0),n===void 0&&(n=!0),r===void 0&&(r=-ka);for(var i=[],a=this._first;a;)a._start>=r&&(a instanceof Oc?t&&i.push(a):(n&&i.push(a),e&&i.push.apply(i,a.getChildren(!0,t,n)))),a=a._next;return i},n.getById=function(e){for(var t=this.getChildren(1,1,1),n=t.length;n--;)if(t[n].vars.id===e)return t[n]},n.remove=function(e){return Ia(e)?this.removeLabel(e):La(e)?this.killTweensOf(e):(e.parent===this&&Wo(this,e),e===this._recent&&(this._recent=this._last),Ko(this))},n.totalTime=function(t,n){return arguments.length?(this._forcing=1,!this._dp&&this._ts&&(this._start=jo($s.time-(this._ts>0?t/this._ts:(this.totalDuration()-t)/-this._ts))),e.prototype.totalTime.call(this,t,n),this._forcing=0,this):this._tTime},n.addLabel=function(e,t){return this.labels[e]=fs(this,t),this},n.removeLabel=function(e){return delete this.labels[e],this},n.addPause=function(e,t,n){var r=Oc.delayedCall(0,t||po,n);return r.data=`isPause`,this._hasPause=1,ns(this,r,fs(this,e))},n.removePause=function(e){var t=this._first;for(e=fs(this,e);t;)t._start===e&&t.data===`isPause`&&Go(t),t=t._next},n.killTweensOf=function(e,t,n){for(var r=this.getTweensOf(e,n),i=r.length;i--;)yc!==r[i]&&r[i].kill(e,t);return this},n.getTweensOf=function(e,t){for(var n=[],r=xs(e),i=this._first,a=Ra(t),o;i;)i instanceof Oc?No(i._targets,r)&&(a?(!yc||i._initted&&i._ts)&&i.globalTime(0)<=t&&i.globalTime(i.totalDuration())>t:!t||i.isActive())&&n.push(i):(o=i.getTweensOf(r,t)).length&&n.push.apply(n,o),i=i._next;return n},n.tweenTo=function(e,t){t||={};var n=this,r=fs(n,e),i=t,a=i.startAt,o=i.onStart,s=i.onStartParams,c=i.immediateRender,l,u=Oc.to(n,B({ease:t.ease||`none`,lazy:!1,immediateRender:!1,time:r,overwrite:`auto`,duration:t.duration||Math.abs((r-(a&&`time`in a?a.time:n._time))/n.timeScale())||z,onStart:function(){if(n.pause(),!l){var e=t.duration||Math.abs((r-(a&&`time`in a?a.time:n._time))/n.timeScale());u._dur!==e&&ls(u,e,0,1).render(u._time,!0,!0),l=1}o&&o.apply(u,s||[])}},t));return c?u.render(0):u},n.tweenFromTo=function(e,t,n){return this.tweenTo(t,B({startAt:{time:fs(this,e)}},n))},n.recent=function(){return this._recent},n.nextLabel=function(e){return e===void 0&&(e=this._time),Ls(this,fs(this,e))},n.previousLabel=function(e){return e===void 0&&(e=this._time),Ls(this,fs(this,e),1)},n.currentLabel=function(e){return arguments.length?this.seek(e,!0):this.previousLabel(this._time+z)},n.shiftChildren=function(e,t,n){n===void 0&&(n=0);var r=this._first,i=this.labels,a;for(e=jo(e);r;)r._start>=n&&(r._start+=e,r._end+=e),r=r._next;if(t)for(a in i)i[a]>=n&&(i[a]+=e);return Ko(this)},n.invalidate=function(t){var n=this._first;for(this._lock=0;n;)n.invalidate(t),n=n._next;return e.prototype.invalidate.call(this,t)},n.clear=function(e){e===void 0&&(e=!0);for(var t=this._first,n;t;)n=t._next,this.remove(t),t=n;return this._dp&&(this._time=this._tTime=this._pTime=0),e&&(this.labels={}),Ko(this)},n.totalDuration=function(e){var t=0,n=this,r=n._last,i=ka,a,o,s;if(arguments.length)return n.timeScale((n._repeat<0?n.duration():n.totalDuration())/(n.reversed()?-e:e));if(n._dirty){for(s=n.parent;r;)a=r._prev,r._dirty&&r.totalDuration(),o=r._start,o>i&&n._sort&&r._ts&&!n._lock?(n._lock=1,ns(n,r,o-r._delay,1)._lock=0):i=o,o<0&&r._ts&&(t-=o,(!s&&!n._dp||s&&s.smoothChildTiming)&&(n._start+=jo(o/n._ts),n._time-=o,n._tTime-=o),n.shiftChildren(-o,!1,-1/0),i=0),r._end>t&&r._ts&&(t=r._end),r=a;ls(n,n===to&&n._time>t?n._time:t,1,1),n._dirty=0}return n._tDur},t.updateRoot=function(e){if(to._ts&&(Io(to,Qo(e,to)),bo=$s.frame),$s.frame>=Co){Co+=Ta.autoSleep||120;var t=to._first;if((!t||!t._ts)&&Ta.autoSleep&&$s._listeners.length<2){for(;t&&!t._ts;)t=t._next;t||$s.sleep()}}},t}(pc);B(mc.prototype,{_lock:0,_hasPause:0,_forcing:0});var hc=function(e,t,n,r,i,a,o){var s=new Hc(this._pt,e,t,0,1,Ic,null,i),c=0,l=0,u,d,f,p,m,h,g,_;for(s.b=n,s.e=r,n+=``,r+=``,(g=~r.indexOf(`random(`))&&(r=Ps(r)),a&&(_=[n,r],a(_,e,t),n=_[0],r=_[1]),d=n.match(Za)||[];u=Za.exec(r);)p=u[0],m=r.substring(c,u.index),f?f=(f+1)%5:m.substr(-5)===`rgba(`&&(f=1),p!==d[l++]&&(h=parseFloat(d[l-1])||0,s._pt={_next:s._pt,p:m||l===1?m:`,`,s:h,c:p.charAt(1)===`=`?Mo(h,p)-h:parseFloat(p)-h,m:f&&f<4?Math.round:0},c=Za.lastIndex);return s.c=c<r.length?r.substring(c,r.length):``,s.fp=o,(Qa.test(r)||g)&&(s.e=0),this._pt=s,s},gc=function(e,t,n,r,i,a,o,s,c,l){La(r)&&(r=r(i||0,e,a));var u=e[t],d=n===`get`?La(u)?c?e[t.indexOf(`set`)||!La(e[`get`+t.substr(3)])?t:`get`+t.substr(3)](c):e[t]():u:n,f=La(u)?c?jc:Ac:kc,p;if(Ia(r)&&(~r.indexOf(`random(`)&&(r=Ps(r)),r.charAt(1)===`=`&&(p=Mo(d,r)+(gs(d)||0),(p||p===0)&&(r=p))),!l||d!==r||bc)return!isNaN(d*r)&&r!==``?(p=new Hc(this._pt,e,t,+d||0,r-(d||0),typeof u==`boolean`?Fc:Pc,0,f),c&&(p.fp=c),o&&p.modifier(o,this,e),this._pt=p):(!u&&!(t in e)&&lo(t,r),hc.call(this,e,t,d,r,f,s||Ta.stringFilter,c))},_c=function(e,t,n,r,i){if(La(e)&&(e=Tc(e,i,t,n,r)),!Ba(e)||e.style&&e.nodeType||Ga(e)||Wa(e))return Ia(e)?Tc(e,i,t,n,r):e;var a={},o;for(o in e)a[o]=Tc(e[o],i,t,n,r);return a},vc=function(e,t,n,r,i,a){var o,s,c,l;if(xo[e]&&(o=new xo[e]).init(i,o.rawVars?t[e]:_c(t[e],r,i,a,n),n,r,a)!==!1&&(n._pt=s=new Hc(n._pt,i,e,0,1,o.render,o,0,o.priority),n!==Bs))for(c=n._ptLookup[n._targets.indexOf(i)],l=o._props.length;l--;)c[o._props[l]]=s;return o},yc,bc,xc=function e(t,n,r){var i=t.vars,a=i.ease,o=i.startAt,s=i.immediateRender,c=i.lazy,l=i.onUpdate,u=i.runBackwards,d=i.yoyoEase,f=i.keyframes,p=i.autoRevert,m=t._dur,h=t._startAt,g=t._targets,_=t.parent,v=_&&_.data===`nested`?_.vars.targets:g,y=t._overwrite===`auto`&&!Da,b=t.timeline,x=i.easeReverse||d,S,C,w,T,E,D,O,ee,te,ne,k,re,ie;if(b&&(!f||!a)&&(a=`none`),t._ease=sc(a,Ea.ease),t._rEase=x&&(sc(x)||t._ease),t._from=!b&&!!i.runBackwards,t._from&&(t.ratio=1),!b||f&&!i.stagger){if(ee=g[0]?Do(g[0]).harness:0,re=ee&&i[ee.prop],S=Ho(i,_o),h&&(h._zTime<0&&h.progress(1),n<0&&u&&s&&!p?h.render(-1,!0):h.revert(u&&m?ho:mo),h._lazy=0),o){if(Go(t._startAt=Oc.set(g,B({data:`isStart`,overwrite:!1,parent:_,immediateRender:!0,lazy:!h&&Va(c),startAt:null,delay:0,onUpdate:l&&function(){return Rs(t,`onUpdate`)},stagger:0},o))),t._startAt._dp=0,t._startAt._sat=t,n<0&&(R||!s&&!p)&&t._startAt.revert(ho),s&&m&&n<=0&&r<=0){n&&(t._zTime=n);return}}else if(u&&m&&!h){if(n&&(s=!1),w=B({overwrite:!1,data:`isFromStart`,lazy:s&&!h&&Va(c),immediateRender:s,stagger:0,parent:_},S),re&&(w[ee.prop]=re),Go(t._startAt=Oc.set(g,w)),t._startAt._dp=0,t._startAt._sat=t,n<0&&(R?t._startAt.revert(ho):t._startAt.render(-1,!0)),t._zTime=n,!s)e(t._startAt,z,z);else if(!n)return}for(t._pt=t._ptCache=0,c=m&&Va(c)||c&&!m,C=0;C<g.length;C++){if(E=g[C],O=E._gsap||Eo(g)[C]._gsap,t._ptLookup[C]=ne={},yo[O.id]&&vo.length&&Po(),k=v===g?C:v.indexOf(E),ee&&(te=new ee).init(E,re||S,t,k,v)!==!1&&(t._pt=T=new Hc(t._pt,E,te.name,0,1,te.render,te,0,te.priority),te._props.forEach(function(e){ne[e]=T}),te.priority&&(D=1)),!ee||re)for(w in S)xo[w]&&(te=vc(w,S,t,k,E,v))?te.priority&&(D=1):ne[w]=T=gc.call(t,E,w,`get`,S[w],k,v,0,i.stringFilter);t._op&&t._op[C]&&t.kill(E,t._op[C]),y&&t._pt&&(yc=t,to.killTweensOf(E,ne,t.globalTime(n)),ie=!t.parent,yc=0),t._pt&&c&&(yo[O.id]=1)}D&&Vc(t),t._onInit&&t._onInit(t)}t._onUpdate=l,t._initted=(!t._op||t._pt)&&!ie,f&&n<=0&&b.render(ka,!0,!0)},Sc=function(e,t,n,r,i,a,o,s){var c=(e._pt&&e._ptCache||(e._ptCache={}))[t],l,u,d,f;if(!c)for(c=e._ptCache[t]=[],d=e._ptLookup,f=e._targets.length;f--;){if(l=d[f][t],l&&l.d&&l.d._pt)for(l=l.d._pt;l&&l.p!==t&&l.fp!==t;)l=l._next;if(!l)return bc=1,e.vars[t]=`+=0`,xc(e,o),bc=0,s?uo(t+` not eligible for reset. Try splitting into individual properties`):1;c.push(l)}for(f=c.length;f--;)u=c[f],l=u._pt||u,l.s=(r||r===0)&&!i?r:l.s+(r||0)+a*l.c,l.c=n-l.s,u.e&&=Ao(n)+gs(u.e),u.b&&=l.s+gs(u.b)},Cc=function(e,t){var n=e[0]?Do(e[0]).harness:0,r=n&&n.aliases,i,a,o,s;if(!r)return t;for(a in i=Bo({},t),r)if(a in i)for(s=r[a].split(`,`),o=s.length;o--;)i[s[o]]=i[a];return i},wc=function(e,t,n,r){var i=t.ease||r||`power1.inOut`,a,o;if(Ga(t))o=n[e]||(n[e]=[]),t.forEach(function(e,n){return o.push({t:n/(t.length-1)*100,v:e,e:i})});else for(a in t)o=n[a]||(n[a]=[]),a===`ease`||o.push({t:parseFloat(e),v:t[a],e:i})},Tc=function(e,t,n,r,i){return La(e)?e.call(t,n,r,i):Ia(e)&&~e.indexOf(`random(`)?Ps(e):e},Ec=To+`repeat,repeatDelay,yoyo,repeatRefresh,yoyoEase,easeReverse,autoRevert`,Dc={};ko(Ec+`,id,stagger,delay,duration,paused,scrollTrigger`,function(e){return Dc[e]=1}),Ec=Ec.split(`,`);var Oc=function(e){wa(t,e);function t(t,n,r,i){var a;typeof n==`number`&&(r.duration=n,n=r,r=null),a=e.call(this,i?n:V(n))||this;var o=a.vars,s=o.duration,c=o.delay,l=o.immediateRender,u=o.stagger,d=o.overwrite,f=o.keyframes,p=o.defaults,m=o.scrollTrigger,h=n.parent||to,g=(Ga(t)||Wa(t)?Ra(t[0]):`length`in n)?[t]:xs(t),_,v,y,b,x,S,C,w;if(a._targets=g.length?Eo(g):uo(`GSAP target `+t+` not found. https://gsap.com`,!Ta.nullTargetWarn)||[],a._ptLookup=[],a._overwrite=d,f||u||Ua(s)||Ua(c)){n=a.vars;var T=n.easeReverse||n.yoyoEase;if(_=a.timeline=new mc({data:`nested`,defaults:p||{},targets:h&&h.data===`nested`?h.vars.targets:g}),_.kill(),_.parent=_._dp=Ca(a),_._start=0,u||Ua(s)||Ua(c)){if(b=g.length,C=u&&ws(u),Ba(u))for(x in u)~Ec.indexOf(x)&&(w||={},w[x]=u[x]);for(v=0;v<b;v++)y=Ho(n,Dc),y.stagger=0,T&&(y.easeReverse=T),w&&Bo(y,w),S=g[v],y.duration=+Tc(s,Ca(a),v,S,g),y.delay=(+Tc(c,Ca(a),v,S,g)||0)-a._delay,!u&&b===1&&y.delay&&(a._delay=c=y.delay,a._start+=c,y.delay=0),_.to(S,y,C?C(v,S,g):0),_._ease=U.none;_.duration()?s=c=0:a.timeline=0}else if(f){V(B(_.vars.defaults,{ease:`none`})),_._ease=sc(f.ease||n.ease||`none`);var E=0,D,O,ee;if(Ga(f))f.forEach(function(e){return _.to(g,e,`>`)}),_.duration();else{for(x in y={},f)x===`ease`||x===`easeEach`||wc(x,f[x],y,f.easeEach);for(x in y)for(D=y[x].sort(function(e,t){return e.t-t.t}),E=0,v=0;v<D.length;v++)O=D[v],ee={ease:O.e,duration:(O.t-(v?D[v-1].t:0))/100*s},ee[x]=O.v,_.to(g,ee,E),E+=ee.duration;_.duration()<s&&_.to({},{duration:s-_.duration()})}}s||a.duration(s=_.duration())}else a.timeline=0;return d===!0&&!Da&&(yc=Ca(a),to.killTweensOf(g),yc=0),ns(h,Ca(a),r),n.reversed&&a.reverse(),n.paused&&a.paused(!0),(l||!s&&!f&&a._start===jo(h._time)&&Va(l)&&Yo(Ca(a))&&h.data!==`nested`)&&(a._tTime=-z,a.render(Math.max(0,-c)||0)),m&&rs(Ca(a),m),a}var n=t.prototype;return n.render=function(e,t,n){var r=this._time,i=this._tDur,a=this._dur,o=e<0,s=e>i-z&&!o?i:e<z?0:e,c,l,u,d,f,p,m,h;if(!a)ss(this,e,t,n);else if(s!==this._tTime||!e||n||!this._initted&&this._tTime||this._startAt&&this._zTime<0!==o||this._lazy){if(c=s,h=this.timeline,this._repeat){if(d=a+this._rDelay,this._repeat<-1&&o)return this.totalTime(d*100+e,t,n);if(c=jo(s%d),s===i?(u=this._repeat,c=a):(f=jo(s/d),u=~~f,u&&u===f?(c=a,u--):c>a&&(c=a)),p=this._yoyo&&u&1,p&&(c=a-c),f=Zo(this._tTime,d),c===r&&!n&&this._initted&&u===f)return this._tTime=s,this;u!==f&&this.vars.repeatRefresh&&!p&&!this._lock&&c!==d&&this._initted&&(this._lock=n=1,this.render(jo(d*u),!0).invalidate()._lock=0)}if(!this._initted){if(is(this,o?e:c,n,t,s))return this._tTime=0,this;if(r!==this._time&&!(n&&this.vars.repeatRefresh&&u!==f))return this;if(a!==this._dur)return this.render(e,t,n)}if(this._rEase){var g=c<r;if(g!==this._inv){var _=g?r:a-r;this._inv=g,this._from&&(this.ratio=1-this.ratio),this._invRatio=this.ratio,this._invTime=r,this._invRecip=_?(g?-1:1)/_:0,this._invScale=g?-this.ratio:1-this.ratio,this._invEase=g?this._rEase:this._ease}this.ratio=m=this._invRatio+this._invScale*this._invEase((c-this._invTime)*this._invRecip)}else this.ratio=m=this._ease(c/a);if(this._from&&(this.ratio=m=1-m),this._tTime=s,this._time=c,!this._act&&this._ts&&(this._act=1,this._lazy=0),!r&&s&&!t&&!f&&(Rs(this,`onStart`),this._tTime!==s))return this;for(l=this._pt;l;)l.r(m,l.d),l=l._next;h&&h.render(e<0?e:h._dur*h._ease(c/this._dur),t,n)||this._startAt&&(this._zTime=e),this._onUpdate&&!t&&(o&&Jo(this,e,t,n),Rs(this,`onUpdate`)),this._repeat&&u!==f&&this.vars.onRepeat&&!t&&this.parent&&Rs(this,`onRepeat`),(s===this._tDur||!s)&&this._tTime===s&&(o&&!this._onUpdate&&Jo(this,e,!0,!0),(e||!a)&&(s===this._tDur&&this._ts>0||!s&&this._ts<0)&&Go(this,1),!t&&!(o&&!r)&&(s||r||p)&&(Rs(this,s===i?`onComplete`:`onReverseComplete`,!0),this._prom&&!(s<i&&this.timeScale()>0)&&this._prom()))}return this},n.targets=function(){return this._targets},n.invalidate=function(t){return(!t||!this.vars.runBackwards)&&(this._startAt=0),this._pt=this._op=this._onUpdate=this._lazy=this.ratio=0,this._ptLookup=[],this.timeline&&this.timeline.invalidate(t),e.prototype.invalidate.call(this,t)},n.resetTo=function(e,t,n,r,i){Qs||$s.wake(),this._ts||this.play();var a=Math.min(this._dur,(this._dp._time-this._start)*this._ts),o;return this._initted||xc(this,a),o=this._ease(a/this._dur),Sc(this,e,t,n,r,o,a,i)?this.resetTo(e,t,n,r,1):(es(this,0),this.parent||Uo(this._dp,this,`_first`,`_last`,this._dp._sort?`_start`:0),this.render(0))},n.kill=function(e,t){if(t===void 0&&(t=`all`),!e&&(!t||t===`all`))return this._lazy=this._pt=0,this.parent?zs(this):this.scrollTrigger&&this.scrollTrigger.kill(!!R),this;if(this.timeline){var n=this.timeline.totalDuration();return this.timeline.killTweensOf(e,t,yc&&yc.vars.overwrite!==!0)._first||zs(this),this.parent&&n!==this.timeline.totalDuration()&&ls(this,this._dur*this.timeline._tDur/n,0,1),this}var r=this._targets,i=e?xs(e):r,a=this._ptLookup,o=this._pt,s,c,l,u,d,f,p;if((!t||t===`all`)&&H(r,i))return t===`all`&&(this._pt=0),zs(this);for(s=this._op=this._op||[],t!==`all`&&(Ia(t)&&(d={},ko(t,function(e){return d[e]=1}),t=d),t=Cc(r,t)),p=r.length;p--;)if(~i.indexOf(r[p]))for(d in c=a[p],t===`all`?(s[p]=t,u=c,l={}):(l=s[p]=s[p]||{},u=t),u)f=c&&c[d],f&&((!(`kill`in f.d)||f.d.kill(d)===!0)&&Wo(this,f,`_pt`),delete c[d]),l!==`all`&&(l[d]=1);return this._initted&&!this._pt&&o&&zs(this),this},t.to=function(e,n){return new t(e,n,arguments[2])},t.from=function(e,t){return ps(1,arguments)},t.delayedCall=function(e,n,r,i){return new t(n,0,{immediateRender:!1,lazy:!1,overwrite:!1,delay:e,onComplete:n,onReverseComplete:n,onCompleteParams:r,onReverseCompleteParams:r,callbackScope:i})},t.fromTo=function(e,t,n){return ps(2,arguments)},t.set=function(e,n){return n.duration=0,n.repeatDelay||(n.repeat=0),new t(e,n)},t.killTweensOf=function(e,t,n){return to.killTweensOf(e,t,n)},t}(pc);B(Oc.prototype,{_targets:[],_lazy:0,_startAt:0,_op:0,_onInit:0}),ko(`staggerTo,staggerFrom,staggerFromTo`,function(e){Oc[e]=function(){var t=new mc,n=vs.call(arguments,0);return n.splice(e===`staggerFromTo`?5:4,0,0),t[e].apply(t,n)}});var kc=function(e,t,n){return e[t]=n},Ac=function(e,t,n){return e[t](n)},jc=function(e,t,n,r){return e[t](r.fp,n)},Mc=function(e,t,n){return e.setAttribute(t,n)},Nc=function(e,t){return La(e[t])?Ac:za(e[t])&&e.setAttribute?Mc:kc},Pc=function(e,t){return t.set(t.t,t.p,Math.round((t.s+t.c*e)*1e6)/1e6,t)},Fc=function(e,t){return t.set(t.t,t.p,!!(t.s+t.c*e),t)},Ic=function(e,t){var n=t._pt,r=``;if(!e&&t.b)r=t.b;else if(e===1&&t.e)r=t.e;else{for(;n;)r=n.p+(n.m?n.m(n.s+n.c*e):Math.round((n.s+n.c*e)*1e4)/1e4)+r,n=n._next;r+=t.c}t.set(t.t,t.p,r,t)},Lc=function(e,t){for(var n=t._pt;n;)n.r(e,n.d),n=n._next},Rc=function(e,t,n,r){for(var i=this._pt,a;i;)a=i._next,i.p===r&&i.modifier(e,t,n),i=a},zc=function(e){for(var t=this._pt,n,r;t;)r=t._next,t.p===e&&!t.op||t.op===e?Wo(this,t,`_pt`):t.dep||(n=1),t=r;return!n},Bc=function(e,t,n,r){r.mSet(e,t,r.m.call(r.tween,n,r.mt),r)},Vc=function(e){for(var t=e._pt,n,r,i,a;t;){for(n=t._next,r=i;r&&r.pr>t.pr;)r=r._next;(t._prev=r?r._prev:a)?t._prev._next=t:i=t,(t._next=r)?r._prev=t:a=t,t=n}e._pt=i},Hc=function(){function e(e,t,n,r,i,a,o,s,c){this.t=t,this.s=r,this.c=i,this.p=n,this.r=a||Pc,this.d=o||this,this.set=s||kc,this.pr=c||0,this._next=e,e&&(e._prev=this)}var t=e.prototype;return t.modifier=function(e,t,n){this.mSet=this.mSet||this.set,this.set=Bc,this.m=e,this.mt=n,this.tween=t},e}();ko(To+`parent,duration,ease,delay,overwrite,runBackwards,startAt,yoyo,immediateRender,repeat,repeatDelay,data,paused,reversed,lazy,callbackScope,stringFilter,id,yoyoEase,stagger,inherit,repeatRefresh,keyframes,autoRevert,scrollTrigger,easeReverse`,function(e){return _o[e]=1}),ao.TweenMax=ao.TweenLite=Oc,ao.TimelineLite=ao.TimelineMax=mc,to=new mc({sortChildren:!1,defaults:Ea,autoRemoveChildren:!0,id:`root`,smoothChildTiming:!0}),Ta.stringFilter=Zs;var Uc=[],Wc={},Gc=[],Kc=0,qc=0,Jc=function(e){return(Wc[e]||Gc).map(function(e){return e()})},Yc=function(){var e=Date.now(),t=[];e-Kc>2&&(Jc(`matchMediaInit`),Uc.forEach(function(e){var n=e.queries,r=e.conditions,i,a,o,s;for(a in n)i=no.matchMedia(n[a]).matches,i&&(o=1),i!==r[a]&&(r[a]=i,s=1);s&&(e.revert(),o&&t.push(e))}),Jc(`matchMediaRevert`),t.forEach(function(e){return e.onMatch(e,function(t){return e.add(null,t)})}),Kc=e,Jc(`matchMedia`))},Xc=function(){function e(e,t){this.selector=t&&Ss(t),this.data=[],this._r=[],this.isReverted=!1,this.id=qc++,e&&this.add(e)}var t=e.prototype;return t.add=function(e,t,n){La(e)&&(n=t,t=e,e=La);var r=this,i=function(){var e=Oa,i=r.selector,a;return e&&e!==r&&e.data.push(r),n&&(r.selector=Ss(n)),Oa=r,a=t.apply(r,arguments),La(a)&&r._r.push(a),Oa=e,r.selector=i,r.isReverted=!1,a};return r.last=i,e===La?i(r,function(e){return r.add(null,e)}):e?r[e]=i:i},t.ignore=function(e){var t=Oa;Oa=null,e(this),Oa=t},t.getTweens=function(){var t=[];return this.data.forEach(function(n){return n instanceof e?t.push.apply(t,n.getTweens()):n instanceof Oc&&!(n.parent&&n.parent.data===`nested`)&&t.push(n)}),t},t.clear=function(){this._r.length=this.data.length=0},t.kill=function(e,t){var n=this;if(e?(function(){for(var t=n.getTweens(),r=n.data.length,i;r--;)i=n.data[r],i.data===`isFlip`&&(i.revert(),i.getChildren(!0,!0,!1).forEach(function(e){return t.splice(t.indexOf(e),1)}));for(t.map(function(e){return{g:e._dur||e._delay||e._sat&&!e._sat.vars.immediateRender?e.globalTime(0):-1/0,t:e}}).sort(function(e,t){return t.g-e.g||-1/0}).forEach(function(t){return t.t.revert(e)}),r=n.data.length;r--;)i=n.data[r],i instanceof mc?i.data!==`nested`&&(i.scrollTrigger&&i.scrollTrigger.revert(),i.kill()):!(i instanceof Oc)&&i.revert&&i.revert(e);n._r.forEach(function(t){return t(e,n)}),n.isReverted=!0})():this.data.forEach(function(e){return e.kill&&e.kill()}),this.clear(),t){for(var r=Uc.length;r--;)Uc[r].id===this.id&&Uc.splice(r,1);this._mqs&&this._mqs.forEach(function(e){return e.removeListener?e.removeListener(Yc):e.removeEventListener(`change`,Yc)}),this._mqs=null}},t.revert=function(e){this.kill(e||{})},e}(),Zc=function(){function e(e){this.contexts=[],this.scope=e,Oa&&Oa.data.push(this)}var t=e.prototype;return t.add=function(e,t,n){Ba(e)||(e={matches:e});var r=new Xc(0,n||this.scope),i=r.conditions={},a,o,s;for(o in Oa&&!r.selector&&(r.selector=Oa.selector),this.contexts.push(r),t=r.add(`onMatch`,t),r.queries=e,e)o===`all`?s=1:(a=no.matchMedia(e[o]),a&&(Uc.indexOf(r)<0&&Uc.push(r),(i[o]=a.matches)&&(s=1),a.addListener?a.addListener(Yc):a.addEventListener(`change`,Yc),(r._mqs||=[]).push(a)));return s&&t(r,function(e){return r.add(null,e)}),this},t.revert=function(e){this.kill(e||{})},t.kill=function(e){this.contexts.forEach(function(t){return t.kill(e,!0)})},e}(),Qc={registerPlugin:function(){[...arguments].forEach(function(e){return Hs(e)})},timeline:function(e){return new mc(e)},getTweensOf:function(e,t){return to.getTweensOf(e,t)},getProperty:function(e,t,n,r){Ia(e)&&(e=xs(e)[0]);var i=Do(e||{}).get,a=n?Ro:Lo;return n===`native`&&(n=``),e&&(t?a((xo[t]&&xo[t].get||i)(e,t,n,r)):function(t,n,r){return a((xo[t]&&xo[t].get||i)(e,t,n,r))})},quickSetter:function(e,t,n){if(e=xs(e),e.length>1){var r=e.map(function(e){return nl.quickSetter(e,t,n)}),i=r.length;return function(e){for(var t=i;t--;)r[t](e)}}e=e[0]||{};var a=xo[t],o=Do(e),s=o.harness&&(o.harness.aliases||{})[t]||t,c=a?function(t){var r=new a;Bs._pt=0,r.init(e,n?t+n:t,Bs,0,[e]),r.render(1,r),Bs._pt&&Lc(1,Bs)}:o.set(e,s);return a?c:function(t){return c(e,s,n?t+n:t,o,1)}},quickTo:function(e,t,n){var r,i=nl.to(e,B((r={},r[t]=`+=0.1`,r.paused=!0,r.stagger=0,r),n||{})),a=function(e,n,r){return i.resetTo(t,e,n,r)};return a.tween=i,a},isTweening:function(e){return to.getTweensOf(e,!0).length>0},defaults:function(e){return e&&e.ease&&(e.ease=sc(e.ease,Ea.ease)),Vo(Ea,e||{})},config:function(e){return Vo(Ta,e||{})},registerEffect:function(e){var t=e.name,n=e.effect,r=e.plugins,i=e.defaults,a=e.extendTimeline;(r||``).split(`,`).forEach(function(e){return e&&!xo[e]&&!ao[e]&&uo(t+` effect requires `+e+` plugin.`)}),So[t]=function(e,t,r){return n(xs(e),B(t||{},i),r)},a&&(mc.prototype[t]=function(e,n,r){return this.add(So[t](e,Ba(n)?n:(r=n)&&{},this),r)})},registerEase:function(e,t){U[e]=sc(t)},parseEase:function(e,t){return arguments.length?sc(e,t):U},getById:function(e){return to.getById(e)},exportRoot:function(e,t){e===void 0&&(e={});var n=new mc(e),r,i;for(n.smoothChildTiming=Va(e.smoothChildTiming),to.remove(n),n._dp=0,n._time=n._tTime=to._time,r=to._first;r;)i=r._next,(t||!(!r._dur&&r instanceof Oc&&r.vars.onComplete===r._targets[0]))&&ns(n,r,r._start-r._delay),r=i;return ns(to,n,0),n},context:function(e,t){return e?new Xc(e,t):Oa},matchMedia:function(e){return new Zc(e)},matchMediaRefresh:function(){return Uc.forEach(function(e){var t=e.conditions,n,r;for(r in t)t[r]&&(t[r]=!1,n=1);n&&e.revert()})||Yc()},addEventListener:function(e,t){var n=Wc[e]||(Wc[e]=[]);~n.indexOf(t)||n.push(t)},removeEventListener:function(e,t){var n=Wc[e],r=n&&n.indexOf(t);r>=0&&n.splice(r,1)},utils:{wrap:Ms,wrapYoyo:Ns,distribute:ws,random:Ds,snap:Es,normalize:As,getUnit:gs,clamp:_s,splitColor:Ks,toArray:xs,selector:Ss,mapRange:Fs,pipe:Os,unitize:ks,interpolate:Is,shuffle:Cs},install:co,effects:So,ticker:$s,updateRoot:mc.updateRoot,plugins:xo,globalTimeline:to,core:{PropTween:Hc,globals:fo,Tween:Oc,Timeline:mc,Animation:pc,getCache:Do,_removeLinkedListItem:Wo,reverting:function(){return R},context:function(e){return e&&Oa&&(Oa.data.push(e),e._ctx=Oa),Oa},suppressOverwrites:function(e){return Da=e}}};ko(`to,from,fromTo,delayedCall,set,killTweensOf`,function(e){return Qc[e]=Oc[e]}),$s.add(mc.updateRoot),Bs=Qc.to({},{duration:0});var $c=function(e,t){for(var n=e._pt;n&&n.p!==t&&n.op!==t&&n.fp!==t;)n=n._next;return n},el=function(e,t){var n=e._targets,r,i,a;for(r in t)for(i=n.length;i--;)a=e._ptLookup[i][r],(a&&=a.d)&&(a._pt&&(a=$c(a,r)),a&&a.modifier&&a.modifier(t[r],e,n[i],r))},tl=function(e,t){return{name:e,headless:1,rawVars:1,init:function(e,n,r){r._onInit=function(e){var r,i;if(Ia(n)&&(r={},ko(n,function(e){return r[e]=1}),n=r),t){for(i in r={},n)r[i]=t(n[i]);n=r}el(e,n)}}}},nl=Qc.registerPlugin({name:`attr`,init:function(e,t,n,r,i){var a,o,s;for(a in this.tween=n,t)s=e.getAttribute(a)||``,o=this.add(e,`setAttribute`,(s||0)+``,t[a],r,i,0,0,a),o.op=a,o.b=s,this._props.push(a)},render:function(e,t){for(var n=t._pt;n;)R?n.set(n.t,n.p,n.b,n):n.r(e,n.d),n=n._next}},{name:`endArray`,headless:1,init:function(e,t){for(var n=t.length;n--;)this.add(e,n,e[n]||0,t[n],0,0,0,0,0,1)}},tl(`roundProps`,Ts),tl(`modifiers`),tl(`snap`,Es))||Qc;Oc.version=mc.version=nl.version=`3.15.1`,so=1,Ha()&&ec(),U.Power0,U.Power1,U.Power2,U.Power3,U.Power4,U.Linear,U.Quad,U.Cubic,U.Quart,U.Quint,U.Strong,U.Elastic,U.Back,U.SteppedEase,U.Bounce,U.Sine,U.Expo,U.Circ;var rl,il,al,ol,sl,cl,ll,ul=function(){return typeof window<`u`},dl={},fl=180/Math.PI,pl=Math.PI/180,ml=Math.atan2,hl=1e8,gl=/([A-Z])/g,_l=/(left|right|width|margin|padding|x)/i,vl=/[\s,\(]\S/,yl={autoAlpha:`opacity,visibility`,scale:`scaleX,scaleY`,alpha:`opacity`},bl=function(e,t){return t.set(t.t,t.p,Math.round((t.s+t.c*e)*1e4)/1e4+t.u,t)},xl=function(e,t){return t.set(t.t,t.p,e===1?t.e:Math.round((t.s+t.c*e)*1e4)/1e4+t.u,t)},Sl=function(e,t){return t.set(t.t,t.p,e?Math.round((t.s+t.c*e)*1e4)/1e4+t.u:t.b,t)},Cl=function(e,t){return t.set(t.t,t.p,e===1?t.e:e?Math.round((t.s+t.c*e)*1e4)/1e4+t.u:t.b,t)},wl=function(e,t){var n=t.s+t.c*e;t.set(t.t,t.p,~~(n+(n<0?-.5:.5))+t.u,t)},Tl=function(e,t){return t.set(t.t,t.p,e?t.e:t.b,t)},El=function(e,t){return t.set(t.t,t.p,e===1?t.e:t.b,t)},Dl=function(e,t,n){return e.style[t]=n},Ol=function(e,t,n){return e.style.setProperty(t,n)},kl=function(e,t,n){return e._gsap[t]=n},Al=function(e,t,n){return e._gsap.scaleX=e._gsap.scaleY=n},jl=function(e,t,n,r,i){var a=e._gsap;a.scaleX=a.scaleY=n,a.renderTransform(i,a)},Ml=function(e,t,n,r,i){var a=e._gsap;a[t]=n,a.renderTransform(i,a)},Nl=`transform`,Pl=Nl+`Origin`,Fl=function e(t,n){var r=this,i=this.target,a=i.style,o=i._gsap;if(t in dl&&a){if(this.tfm=this.tfm||{},t!==`transform`)t=yl[t]||t,~t.indexOf(`,`)?t.split(`,`).forEach(function(e){return r.tfm[e]=eu(i,e)}):this.tfm[t]=o.x?o[t]:eu(i,t),t===Pl&&(this.tfm.zOrigin=o.zOrigin);else return yl.transform.split(`,`).forEach(function(t){return e.call(r,t,n)});if(this.props.indexOf(Nl)>=0)return;o.svg&&(this.svgo=i.getAttribute(`data-svg-origin`),this.props.push(Pl,n,``)),t=Nl}(a||n)&&this.props.push(t,n,a[t])},Il=function(e){e.translate&&(e.removeProperty(`translate`),e.removeProperty(`scale`),e.removeProperty(`rotate`))},Ll=function(){var e=this.props,t=this.target,n=t.style,r=t._gsap,i,a;for(i=0;i<e.length;i+=3)e[i+1]?e[i+1]===2?t[e[i]](e[i+2]):t[e[i]]=e[i+2]:e[i+2]?n[e[i]]=e[i+2]:n.removeProperty(e[i].substr(0,2)===`--`?e[i]:e[i].replace(gl,`-$1`).toLowerCase());if(this.tfm){for(a in this.tfm)r[a]=this.tfm[a];r.svg&&(r.renderTransform(),t.setAttribute(`data-svg-origin`,this.svgo||``)),i=ll(),(!i||!i.isStart)&&!n[Nl]&&(Il(n),r.zOrigin&&n[Pl]&&(n[Pl]+=` `+r.zOrigin+`px`,r.zOrigin=0,r.renderTransform()),r.uncache=1)}},Rl=function(e,t){var n={target:e,props:[],revert:Ll,save:Fl};return e._gsap||nl.core.getCache(e),t&&e.style&&e.nodeType&&t.split(`,`).forEach(function(e){return n.save(e)}),n},zl,Bl=function(e,t){var n=il.createElementNS?il.createElementNS((t||`http://www.w3.org/1999/xhtml`).replace(/^https/,`http`),e):il.createElement(e);return n&&n.style?n:il.createElement(e)},Vl=function e(t,n,r){var i=getComputedStyle(t);return i[n]||i.getPropertyValue(n.replace(gl,`-$1`).toLowerCase())||i.getPropertyValue(n)||!r&&e(t,Ul(n)||n,1)||``},Hl=`O,Moz,ms,Ms,Webkit`.split(`,`),Ul=function(e,t,n){var r=(t||sl).style,i=5;if(e in r&&!n)return e;for(e=e.charAt(0).toUpperCase()+e.substr(1);i--&&!(Hl[i]+e in r););return i<0?null:(i===3?`ms`:i>=0?Hl[i]:``)+e},Wl=function(){ul()&&window.document&&(rl=window,il=rl.document,al=il.documentElement,sl=Bl(`div`)||{style:{}},Bl(`div`),Nl=Ul(Nl),Pl=Nl+`Origin`,sl.style.cssText=`border-width:0;line-height:0;position:absolute;padding:0`,zl=!!Ul(`perspective`),ll=nl.core.reverting,ol=1)},Gl=function(e){var t=e.ownerSVGElement,n=Bl(`svg`,t&&t.getAttribute(`xmlns`)||`http://www.w3.org/2000/svg`),r=e.cloneNode(!0),i;r.style.display=`block`,n.appendChild(r),al.appendChild(n);try{i=r.getBBox()}catch{}return n.removeChild(r),al.removeChild(n),i},Kl=function(e,t){for(var n=t.length;n--;)if(e.hasAttribute(t[n]))return e.getAttribute(t[n])},ql=function(e){var t,n;try{t=e.getBBox()}catch{t=Gl(e),n=1}return t&&(t.width||t.height)||n||(t=Gl(e)),t&&!t.width&&!t.x&&!t.y?{x:+Kl(e,[`x`,`cx`,`x1`])||0,y:+Kl(e,[`y`,`cy`,`y1`])||0,width:0,height:0}:t},Jl=function(e){return!!(e.getCTM&&(!e.parentNode||e.ownerSVGElement)&&ql(e))},Yl=function(e,t){if(t){var n=e.style,r;t in dl&&t!==Pl&&(t=Nl),n.removeProperty?(r=t.substr(0,2),(r===`ms`||t.substr(0,6)===`webkit`)&&(t=`-`+t),n.removeProperty(r===`--`?t:t.replace(gl,`-$1`).toLowerCase())):n.removeAttribute(t)}},Xl=function(e,t,n,r,i,a){var o=new Hc(e._pt,t,n,0,1,a?El:Tl);return e._pt=o,o.b=r,o.e=i,e._props.push(n),o},Zl={deg:1,rad:1,turn:1},Ql={grid:1,flex:1},$l=function e(t,n,r,i){var a=parseFloat(r)||0,o=(r+``).trim().substr((a+``).length)||`px`,s=sl.style,c=_l.test(n),l=t.tagName.toLowerCase()===`svg`,u=(l?`client`:`offset`)+(c?`Width`:`Height`),d=100,f=i===`px`,p=i===`%`,m,h,g,_;if(i===o||!a||Zl[i]||Zl[o])return a;if(o!==`px`&&!f&&(a=e(t,n,r,`px`)),_=t.getCTM&&Jl(t),(p||o===`%`)&&(dl[n]||~n.indexOf(`adius`)))return m=_?t.getBBox()[c?`width`:`height`]:t[u],Ao(p?a/m*d:a/100*m);if(s[c?`width`:`height`]=d+(f?o:i),h=i!==`rem`&&~n.indexOf(`adius`)||i===`em`&&t.appendChild&&!l?t:t.parentNode,_&&(h=(t.ownerSVGElement||{}).parentNode),(!h||h===il||!h.appendChild)&&(h=il.body),g=h._gsap,g&&p&&g.width&&c&&g.time===$s.time&&!g.uncache)return Ao(a/g.width*d);if(p&&(n===`height`||n===`width`)){var v=t.style[n];t.style[n]=d+i,m=t[u],v?t.style[n]=v:Yl(t,n)}else (p||o===`%`)&&!Ql[Vl(h,`display`)]&&(s.position=Vl(t,`position`)),h===t&&(s.position=`static`),h.appendChild(sl),m=sl[u],h.removeChild(sl),s.position=`absolute`;return c&&p&&(g=Do(h),g.time=$s.time,g.width=h[u]),Ao(f?m*a/d:m&&a?d/m*a:0)},eu=function(e,t,n,r){var i;return ol||Wl(),t in yl&&t!==`transform`&&(t=yl[t],~t.indexOf(`,`)&&(t=t.split(`,`)[0])),dl[t]&&t!==`transform`?(i=du(e,r),i=t===`transformOrigin`?i.svg?i.origin:fu(Vl(e,Pl))+` `+i.zOrigin+`px`:i[t]):(i=e.style[t],(!i||i===`auto`||r||~(i+``).indexOf(`calc(`))&&(i=au[t]&&au[t](e,t,n)||Vl(e,t)||Oo(e,t)||+(t===`opacity`))),n&&!~(i+``).trim().indexOf(` `)?$l(e,t,i,n)+n:i},tu=function(e,t,n,r){if(!n||n===`none`){var i=Ul(t,e,1),a=i&&Vl(e,i,1);a&&a!==n?(t=i,n=a):t===`borderColor`&&(n=Vl(e,`borderTopColor`))}var o=new Hc(this._pt,e.style,t,0,1,Ic),s=0,c=0,l,u,d,f,p,m,h,g,_,v,y,b;if(o.b=n,o.e=r,n+=``,r+=``,r.substring(0,6)===`var(--`&&(r=Vl(e,r.substring(4,r.indexOf(`)`)))),r===`auto`&&(m=e.style[t],e.style[t]=r,r=Vl(e,t)||r,m?e.style[t]=m:Yl(e,t)),l=[n,r],Zs(l),n=l[0],r=l[1],d=n.match(Xa)||[],b=r.match(Xa)||[],b.length){for(;u=Xa.exec(r);)h=u[0],_=r.substring(s,u.index),p?p=(p+1)%5:(_.substr(-5)===`rgba(`||_.substr(-5)===`hsla(`)&&(p=1),h!==(m=d[c++]||``)&&(f=parseFloat(m)||0,y=m.substr((f+``).length),h.charAt(1)===`=`&&(h=Mo(f,h)+y),g=parseFloat(h),v=h.substr((g+``).length),s=Xa.lastIndex-v.length,v||(v=v||Ta.units[t]||y,s===r.length&&(r+=v,o.e+=v)),y!==v&&(f=$l(e,t,m,v)||0),o._pt={_next:o._pt,p:_||c===1?_:`,`,s:f,c:g-f,m:p&&p<4||t===`zIndex`?Math.round:0});o.c=s<r.length?r.substring(s,r.length):``}else o.r=t===`display`&&r===`none`?El:Tl;return Qa.test(r)&&(o.e=0),this._pt=o,o},nu={top:`0%`,bottom:`100%`,left:`0%`,right:`100%`,center:`50%`},ru=function(e){var t=e.split(` `),n=t[0],r=t[1]||`50%`;return(n===`top`||n===`bottom`||r===`left`||r===`right`)&&(e=n,n=r,r=e),t[0]=nu[n]||n,t[1]=nu[r]||r,t.join(` `)},iu=function(e,t){if(t.tween&&t.tween._time===t.tween._dur){var n=t.t,r=n.style,i=t.u,a=n._gsap,o,s,c;if(i===`all`||i===!0)r.cssText=``,s=1;else for(i=i.split(`,`),c=i.length;--c>-1;)o=i[c],dl[o]&&(s=1,o=o===`transformOrigin`?Pl:Nl),Yl(n,o);s&&(Yl(n,Nl),a&&(a.svg&&n.removeAttribute(`transform`),r.scale=r.rotate=r.translate=`none`,du(n,1),a.uncache=1,Il(r)))}},au={clearProps:function(e,t,n,r,i){if(i.data!==`isFromStart`){var a=e._pt=new Hc(e._pt,t,n,0,0,iu);return a.u=r,a.pr=-10,a.tween=i,e._props.push(n),1}}},W=[1,0,0,1,0,0],ou={},su=function(e){return e===`matrix(1, 0, 0, 1, 0, 0)`||e===`none`||!e},cu=function(e){var t=Vl(e,Nl);return su(t)?W:t.substr(7).match(Ya).map(Ao)},lu=function(e,t){var n=e._gsap||Do(e),r=e.style,i=cu(e),a,o,s,c;return n.svg&&e.getAttribute(`transform`)?(s=e.transform.baseVal.consolidate().matrix,i=[s.a,s.b,s.c,s.d,s.e,s.f],i.join(`,`)===`1,0,0,1,0,0`?W:i):(i===W&&!e.offsetParent&&e!==al&&!n.svg&&(s=r.display,r.display=`block`,a=e.parentNode,(!a||!e.offsetParent&&!e.getBoundingClientRect().width)&&(c=1,o=e.nextElementSibling,al.appendChild(e)),i=cu(e),s?r.display=s:Yl(e,`display`),c&&(o?a.insertBefore(e,o):a?a.appendChild(e):al.removeChild(e))),t&&i.length>6?[i[0],i[1],i[4],i[5],i[12],i[13]]:i)},uu=function(e,t,n,r,i,a){var o=e._gsap,s=i||lu(e,!0),c=o.xOrigin||0,l=o.yOrigin||0,u=o.xOffset||0,d=o.yOffset||0,f=s[0],p=s[1],m=s[2],h=s[3],g=s[4],_=s[5],v=t.split(` `),y=parseFloat(v[0])||0,b=parseFloat(v[1])||0,x,S,C,w;n?s!==W&&(S=f*h-p*m)&&(C=h/S*y+b*(-m/S)+(m*_-h*g)/S,w=y*(-p/S)+f/S*b-(f*_-p*g)/S,y=C,b=w):(x=ql(e),y=x.x+(~v[0].indexOf(`%`)?y/100*x.width:y),b=x.y+(~(v[1]||v[0]).indexOf(`%`)?b/100*x.height:b)),r||r!==!1&&o.smooth?(g=y-c,_=b-l,o.xOffset=u+(g*f+_*m)-g,o.yOffset=d+(g*p+_*h)-_):o.xOffset=o.yOffset=0,o.xOrigin=y,o.yOrigin=b,o.smooth=!!r,o.origin=t,o.originIsAbsolute=!!n,e.style[Pl]=`0px 0px`,a&&(Xl(a,o,`xOrigin`,c,y),Xl(a,o,`yOrigin`,l,b),Xl(a,o,`xOffset`,u,o.xOffset),Xl(a,o,`yOffset`,d,o.yOffset)),e.setAttribute(`data-svg-origin`,y+` `+b)},du=function(e,t){var n=e._gsap||new fc(e);if(`x`in n&&!t&&!n.uncache)return n;var r=e.style,i=n.scaleX<0,a=`px`,o=`deg`,s=getComputedStyle(e),c=Vl(e,Pl)||`0`,l=u=d=m=h=g=_=v=y=0,u,d,f=p=1,p,m,h,g,_,v,y,b,x,S,C,w,T,E,D,O,ee,te,ne,k,re,ie,ae,oe,se,ce,le,ue;return n.svg=!!(e.getCTM&&Jl(e)),s.translate&&((s.translate!==`none`||s.scale!==`none`||s.rotate!==`none`)&&(r[Nl]=(s.translate===`none`?``:`translate3d(`+(s.translate+` 0 0`).split(` `).slice(0,3).join(`, `)+`) `)+(s.rotate===`none`?``:`rotate(`+s.rotate+`) `)+(s.scale===`none`?``:`scale(`+s.scale.split(` `).join(`,`)+`) `)+(s[Nl]===`none`?``:s[Nl])),r.scale=r.rotate=r.translate=`none`),S=lu(e,n.svg),n.svg&&(n.uncache?(re=e.getBBox(),c=n.xOrigin-re.x+`px `+(n.yOrigin-re.y)+`px`,k=``):k=!t&&e.getAttribute(`data-svg-origin`),uu(e,k||c,!!k||n.originIsAbsolute,n.smooth!==!1,S)),b=n.xOrigin||0,x=n.yOrigin||0,S!==W&&(E=S[0],D=S[1],O=S[2],ee=S[3],l=te=S[4],u=ne=S[5],S.length===6?(f=Math.sqrt(E*E+D*D),p=Math.sqrt(ee*ee+O*O),m=E||D?ml(D,E)*fl:0,_=O||ee?ml(O,ee)*fl+m:0,_&&(p*=Math.abs(Math.cos(_*pl))),n.svg&&(l-=b-(b*E+x*O),u-=x-(b*D+x*ee))):(ue=S[6],ce=S[7],ae=S[8],oe=S[9],se=S[10],le=S[11],l=S[12],u=S[13],d=S[14],C=ml(ue,se),h=C*fl,C&&(w=Math.cos(-C),T=Math.sin(-C),k=te*w+ae*T,re=ne*w+oe*T,ie=ue*w+se*T,ae=te*-T+ae*w,oe=ne*-T+oe*w,se=ue*-T+se*w,le=ce*-T+le*w,te=k,ne=re,ue=ie),C=ml(-O,se),g=C*fl,C&&(w=Math.cos(-C),T=Math.sin(-C),k=E*w-ae*T,re=D*w-oe*T,ie=O*w-se*T,le=ee*T+le*w,E=k,D=re,O=ie),C=ml(D,E),m=C*fl,C&&(w=Math.cos(C),T=Math.sin(C),k=E*w+D*T,re=te*w+ne*T,D=D*w-E*T,ne=ne*w-te*T,E=k,te=re),h&&Math.abs(h)+Math.abs(m)>359.9&&(h=m=0,g=180-g),f=Ao(Math.sqrt(E*E+D*D+O*O)),p=Ao(Math.sqrt(ne*ne+ue*ue)),C=ml(te,ne),_=Math.abs(C)>2e-4?C*fl:0,y=le?1/(le<0?-le:le):0),n.svg&&(k=e.getAttribute(`transform`),n.forceCSS=e.setAttribute(`transform`,``)||!su(Vl(e,Nl)),k&&e.setAttribute(`transform`,k))),Math.abs(_)>90&&Math.abs(_)<270&&(i?(f*=-1,_+=m<=0?180:-180,m+=m<=0?180:-180):(p*=-1,_+=_<=0?180:-180)),t||=n.uncache,n.x=l-((n.xPercent=l&&(!t&&n.xPercent||(Math.round(e.offsetWidth/2)===Math.round(-l)?-50:0)))?e.offsetWidth*n.xPercent/100:0)+a,n.y=u-((n.yPercent=u&&(!t&&n.yPercent||(Math.round(e.offsetHeight/2)===Math.round(-u)?-50:0)))?e.offsetHeight*n.yPercent/100:0)+a,n.z=d+a,n.scaleX=Ao(f),n.scaleY=Ao(p),n.rotation=Ao(m)+o,n.rotationX=Ao(h)+o,n.rotationY=Ao(g)+o,n.skewX=_+o,n.skewY=v+o,n.transformPerspective=y+a,(n.zOrigin=parseFloat(c.split(` `)[2])||!t&&n.zOrigin||0)&&(r[Pl]=fu(c)),n.xOffset=n.yOffset=0,n.force3D=Ta.force3D,n.renderTransform=n.svg?yu:zl?vu:mu,n.uncache=0,n},fu=function(e){return(e=e.split(` `))[0]+` `+e[1]},pu=function(e,t,n){var r=gs(t);return Ao(parseFloat(t)+parseFloat($l(e,`x`,n+`px`,r)))+r},mu=function(e,t){t.z=`0px`,t.rotationY=t.rotationX=`0deg`,t.force3D=0,vu(e,t)},hu=`0deg`,gu=`0px`,_u=`) `,vu=function(e,t){var n=t||this,r=n.xPercent,i=n.yPercent,a=n.x,o=n.y,s=n.z,c=n.rotation,l=n.rotationY,u=n.rotationX,d=n.skewX,f=n.skewY,p=n.scaleX,m=n.scaleY,h=n.transformPerspective,g=n.force3D,_=n.target,v=n.zOrigin,y=``,b=g===`auto`&&e&&e!==1||g===!0;if(v&&(u!==hu||l!==hu)){var x=parseFloat(l)*pl,S=Math.sin(x),C=Math.cos(x),w;x=parseFloat(u)*pl,w=Math.cos(x),a=pu(_,a,S*w*-v),o=pu(_,o,-Math.sin(x)*-v),s=pu(_,s,C*w*-v+v)}h!==gu&&(y+=`perspective(`+h+_u),(r||i)&&(y+=`translate(`+r+`%, `+i+`%) `),(b||a!==gu||o!==gu||s!==gu)&&(y+=s!==gu||b?`translate3d(`+a+`, `+o+`, `+s+`) `:`translate(`+a+`, `+o+_u),c!==hu&&(y+=`rotate(`+c+_u),l!==hu&&(y+=`rotateY(`+l+_u),u!==hu&&(y+=`rotateX(`+u+_u),(d!==hu||f!==hu)&&(y+=`skew(`+d+`, `+f+_u),(p!==1||m!==1)&&(y+=`scale(`+p+`, `+m+_u),_.style[Nl]=y||`translate(0, 0)`},yu=function(e,t){var n=t||this,r=n.xPercent,i=n.yPercent,a=n.x,o=n.y,s=n.rotation,c=n.skewX,l=n.skewY,u=n.scaleX,d=n.scaleY,f=n.target,p=n.xOrigin,m=n.yOrigin,h=n.xOffset,g=n.yOffset,_=n.forceCSS,v=parseFloat(a),y=parseFloat(o),b,x,S,C,w;s=parseFloat(s),c=parseFloat(c),l=parseFloat(l),l&&(l=parseFloat(l),c+=l,s+=l),s||c?(s*=pl,c*=pl,b=Math.cos(s)*u,x=Math.sin(s)*u,S=Math.sin(s-c)*-d,C=Math.cos(s-c)*d,c&&(l*=pl,w=Math.tan(c-l),w=Math.sqrt(1+w*w),S*=w,C*=w,l&&(w=Math.tan(l),w=Math.sqrt(1+w*w),b*=w,x*=w)),b=Ao(b),x=Ao(x),S=Ao(S),C=Ao(C)):(b=u,C=d,x=S=0),(v&&!~(a+``).indexOf(`px`)||y&&!~(o+``).indexOf(`px`))&&(v=$l(f,`x`,a,`px`),y=$l(f,`y`,o,`px`)),(p||m||h||g)&&(v=Ao(v+p-(p*b+m*S)+h),y=Ao(y+m-(p*x+m*C)+g)),(r||i)&&(w=f.getBBox(),v=Ao(v+r/100*w.width),y=Ao(y+i/100*w.height)),w=`matrix(`+b+`,`+x+`,`+S+`,`+C+`,`+v+`,`+y+`)`,f.setAttribute(`transform`,w),_&&(f.style[Nl]=w)},bu=function(e,t,n,r,i){var a=360,o=Ia(i),s=parseFloat(i)*(o&&~i.indexOf(`rad`)?fl:1)-r,c=r+s+`deg`,l,u;return o&&(l=i.split(`_`)[1],l===`short`&&(s%=a,s!==s%(a/2)&&(s+=s<0?a:-a)),l===`cw`&&s<0?s=(s+a*hl)%a-~~(s/a)*a:l===`ccw`&&s>0&&(s=(s-a*hl)%a-~~(s/a)*a)),e._pt=u=new Hc(e._pt,t,n,r,s,xl),u.e=c,u.u=`deg`,e._props.push(n),u},xu=function(e,t){for(var n in t)e[n]=t[n];return e},Su=function(e,t,n){var r=xu({},n._gsap),i=`perspective,force3D,transformOrigin,svgOrigin`,a=n.style,o,s,c,l,u,d,f,p;for(s in r.svg?(c=n.getAttribute(`transform`),n.setAttribute(`transform`,``),a[Nl]=t,o=du(n,1),Yl(n,Nl),n.setAttribute(`transform`,c)):(c=getComputedStyle(n)[Nl],a[Nl]=t,o=du(n,1),a[Nl]=c),dl)c=r[s],l=o[s],c!==l&&i.indexOf(s)<0&&(f=gs(c),p=gs(l),u=f===p?parseFloat(c):$l(n,s,c,p),d=parseFloat(l),e._pt=new Hc(e._pt,o,s,u,d-u,bl),e._pt.u=p||0,e._props.push(s));xu(o,r)};ko(`padding,margin,Width,Radius`,function(e,t){var n=`Top`,r=`Right`,i=`Bottom`,a=`Left`,o=(t<3?[n,r,i,a]:[n+a,n+r,i+r,i+a]).map(function(n){return t<2?e+n:`border`+n+e});au[t>1?`border`+e:e]=function(e,t,n,r,i){var a,s;if(arguments.length<4)return a=o.map(function(t){return eu(e,t,n)}),s=a.join(` `),s.split(a[0]).length===5?a[0]:s;a=(r+``).split(` `),s={},o.forEach(function(e,t){return s[e]=a[t]=a[t]||a[(t-1)/2|0]}),e.init(t,s,i)}});var Cu={name:`css`,register:Wl,targetTest:function(e){return e.style&&e.nodeType},init:function(e,t,n,r,i){var a=this._props,o=e.style,s=n.vars.startAt,c,l,u,d,f,p,m,h,g,_,v,y,b,x,S,C,w;for(m in ol||Wl(),this.styles=this.styles||Rl(e),C=this.styles.props,this.tween=n,t)if(m!==`autoRound`&&(l=t[m],!(xo[m]&&vc(m,t,n,r,e,i)))){if(f=typeof l,p=au[m],f===`function`&&(l=l.call(n,r,e,i),f=typeof l),f===`string`&&~l.indexOf(`random(`)&&(l=Ps(l)),p)p(this,e,m,l,n)&&(S=1);else if(m.substr(0,2)===`--`)c=(getComputedStyle(e).getPropertyValue(m)+``).trim(),l+=``,Ys.lastIndex=0,Ys.test(c)||(h=gs(c),g=gs(l),g?h!==g&&(c=$l(e,m,c,g)+g):h&&(l+=h)),this.add(o,`setProperty`,c,l,r,i,0,0,m),a.push(m),C.push(m,0,o[m]);else if(f!==`undefined`){if(s&&m in s?(c=typeof s[m]==`function`?s[m].call(n,r,e,i):s[m],Ia(c)&&~c.indexOf(`random(`)&&(c=Ps(c)),gs(c+``)||c===`auto`||(c+=Ta.units[m]||gs(eu(e,m))||``),(c+``).charAt(1)===`=`&&(c=eu(e,m))):c=eu(e,m),d=parseFloat(c),_=f===`string`&&l.charAt(1)===`=`&&l.substr(0,2),_&&(l=l.substr(2)),u=parseFloat(l),m in yl&&(m===`autoAlpha`&&(d===1&&eu(e,`visibility`)===`hidden`&&u&&(d=0),C.push(`visibility`,0,o.visibility),Xl(this,o,`visibility`,d?`inherit`:`hidden`,u?`inherit`:`hidden`,!u)),m!==`scale`&&m!==`transform`&&(m=yl[m],~m.indexOf(`,`)&&(m=m.split(`,`)[0]))),v=m in dl,v){if(this.styles.save(m),w=l,f===`string`&&l.substring(0,6)===`var(--`){if(l=Vl(e,l.substring(4,l.indexOf(`)`))),l.substring(0,5)===`calc(`){var T=e.style.perspective;e.style.perspective=l,l=Vl(e,`perspective`),T?e.style.perspective=T:Yl(e,`perspective`)}u=parseFloat(l)}if(y||(b=e._gsap,b.renderTransform&&!t.parseTransform||du(e,t.parseTransform),x=t.smoothOrigin!==!1&&b.smooth,y=this._pt=new Hc(this._pt,o,Nl,0,1,b.renderTransform,b,0,-1),y.dep=1),m===`scale`)this._pt=new Hc(this._pt,b,`scaleY`,b.scaleY,(_?Mo(b.scaleY,_+u):u)-b.scaleY||0,bl),this._pt.u=0,a.push(`scaleY`,m),m+=`X`;else if(m===`transformOrigin`){C.push(Pl,0,o[Pl]),l=ru(l),b.svg?uu(e,l,0,x,0,this):(g=parseFloat(l.split(` `)[2])||0,g!==b.zOrigin&&Xl(this,b,`zOrigin`,b.zOrigin,g),Xl(this,o,m,fu(c),fu(l)));continue}else if(m===`svgOrigin`){uu(e,l,1,x,0,this);continue}else if(m in ou){bu(this,b,m,d,_?Mo(d,_+l):l);continue}else if(m===`smoothOrigin`){Xl(this,b,`smooth`,b.smooth,l);continue}else if(m===`force3D`){b[m]=l;continue}else if(m===`transform`){Su(this,l,e);continue}}else m in o||(m=Ul(m)||m);if(v||(u||u===0)&&(d||d===0)&&!vl.test(l)&&m in o)h=(c+``).substr((d+``).length),u||=0,g=gs(l)||(m in Ta.units?Ta.units[m]:h),h!==g&&(d=$l(e,m,c,g)),this._pt=new Hc(this._pt,v?b:o,m,d,(_?Mo(d,_+u):u)-d,!v&&(g===`px`||m===`zIndex`)&&t.autoRound!==!1?wl:bl),this._pt.u=g||0,v&&w!==l?(this._pt.b=c,this._pt.e=w,this._pt.r=Cl):h!==g&&g!==`%`&&(this._pt.b=c,this._pt.r=Sl);else if(m in o)tu.call(this,e,m,c,_?_+l:l);else if(m in e)this.add(e,m,c||e[m],_?_+l:l,r,i);else if(m!==`parseTransform`){lo(m,l);continue}v||(m in o?C.push(m,0,o[m]):typeof e[m]==`function`?C.push(m,2,e[m]()):C.push(m,1,c||e[m])),a.push(m)}}S&&Vc(this)},render:function(e,t){if(t.tween._time||!ll())for(var n=t._pt;n;)n.r(e,n.d),n=n._next;else t.styles.revert()},get:eu,aliases:yl,getSetter:function(e,t,n){var r=yl[t];return r&&r.indexOf(`,`)<0&&(t=r),t in dl&&t!==Pl&&(e._gsap.x||eu(e,`x`))?n&&cl===n?t===`scale`?Al:kl:(cl=n||{})&&(t===`scale`?jl:Ml):e.style&&!za(e.style[t])?Dl:~t.indexOf(`-`)?Ol:Nc(e,t)},core:{_removeProperty:Yl,_getMatrix:lu}};nl.utils.checkPrefix=Ul,nl.core.getStyleSaver=Rl,(function(e,t,n,r){var i=ko(e+`,`+t+`,`+n,function(e){dl[e]=1});ko(t,function(e){Ta.units[e]=`deg`,ou[e]=1}),yl[i[13]]=e+`,`+t,ko(r,function(e){var t=e.split(`:`);yl[t[1]]=i[t[0]]})})(`x,y,z,scale,scaleX,scaleY,xPercent,yPercent`,`rotation,rotationX,rotationY,skewX,skewY`,`transform,transformOrigin,svgOrigin,force3D,smoothOrigin,transformPerspective`,`0:translateX,1:translateY,2:translateZ,8:rotate,8:rotationZ,8:rotateZ,9:rotateX,10:rotateY`),ko(`x,y,z,top,right,bottom,left,width,height,fontSize,padding,margin,perspective`,function(e){Ta.units[e]=`px`}),nl.registerPlugin(Cu);var wu=nl.registerPlugin(Cu)||nl;wu.core.Tween;var Tu=typeof document<`u`?L.useLayoutEffect:L.useEffect,Eu=e=>e&&!Array.isArray(e)&&typeof e==`object`,Du=[],Ou={},ku=wu,Au=(e,t=Du)=>{let n=Ou;Eu(e)?(n=e,e=null,t=`dependencies`in n?n.dependencies:Du):Eu(t)&&(n=t,t=`dependencies`in n?n.dependencies:Du),e&&typeof e!=`function`&&console.warn(`First parameter must be a function or config object`);let{scope:r,revertOnUpdate:i}=n,a=(0,L.useRef)(!1),o=(0,L.useRef)(ku.context(()=>{},r)),s=(0,L.useRef)(e=>o.current.add(null,e)),c=t&&t.length&&!i;return c&&Tu(()=>(a.current=!0,()=>o.current.revert()),Du),Tu(()=>{if(e&&o.current.add(e,r),!c||!a.current)return()=>o.current.revert()},t),{context:o.current,contextSafe:s.current}};Au.register=e=>{ku=e},Au.headless=!0;var ju=e=>e?.replace(/([a-z0-9])([A-Z])/g,`$1-$2`).toLowerCase();function Mu(e,t,n=[]){if(t==null)throw Error(`[lucide]: iconNode is required when icon name is used`);return{name:ju(e),size:24,node:t,...n.length>0?{aliases:n}:{}}}var Nu=e=>{let t=``,n=!1;for(let r of e){if(r===`-`||r===`_`||r<=` `){n=t.length>0;continue}t.length===0?t+=r.toLowerCase():t+=n?r.toUpperCase():r,n=!1}return t},Pu=e=>{let t=Nu(e);return t.charAt(0).toUpperCase()+t.slice(1)},Fu=(...e)=>e.filter((e,t,n)=>!!e&&e.trim()!==``&&n.indexOf(e)===t).join(` `).trim(),Iu={xmlns:`http://www.w3.org/2000/svg`,width:24,height:24,viewBox:`0 0 24 24`,fill:`none`,stroke:`currentColor`,"stroke-width":2,"stroke-linecap":`round`,"stroke-linejoin":`round`};function Lu(e){return e!=null}function Ru(e,t={}){let n=t.attributeNames??{},r=e=>n[e]??e,i=e.size??e.width??Iu.width,a=e.size??e.height??Iu.height,o=e.aliases?.filter(e=>typeof e==`string`&&e.trim()!==``).map(e=>`lucide-${e}`)??[],s=[...e.name?[`lucide-${e.name}`]:[],...o],c=t.className?.split(` `).filter(Boolean)??[],l=t.includeDefaultClasses===!1?Fu(...c):Fu(`lucide`,...s,...c),u=t.absoluteStrokeWidth?Number(t.strokeWidth??Iu[`stroke-width`])*Number(e.size??e.width??Iu.width)/Number(t.size??t.width??Iu.width):t.strokeWidth??Iu[`stroke-width`];return[`svg`,{...Object.entries(Iu).reduce((e,[t,n])=>(e[r(t)]=n,e),{}),...`color`in t&&t.color&&{[r(`stroke`)]:t.color},...`size`in t&&Lu(t.size)&&{[r(`width`)]:t.size,[r(`height`)]:t.size},...`width`in t&&Lu(t.width)&&{[r(`width`)]:t.width},...`height`in t&&Lu(t.height)&&{[r(`height`)]:t.height},[r(`stroke-width`)]:u,...l&&{[r(`class`)]:l},[r(`viewBox`)]:`0 0 ${i} ${a}`,...t.hasA11yProp===!1?{[r(`aria-hidden`)]:`true`}:{},...`attributes`in t&&t.attributes},e.node.map(e=>{let[n,i,a]=e,o=t.nonScalingStroke?{[r(`vector-effect`)]:`non-scaling-stroke`,...i}:i;return a?[n,o,a]:[n,o]})]}function zu(e,t={}){return Ru(e,{...t,attributeNames:{...t.attributeNames,class:`className`,"stroke-width":`strokeWidth`,"stroke-linecap":`strokeLinecap`,"stroke-linejoin":`strokeLinejoin`,"vector-effect":`vectorEffect`}})}var Bu=e=>{for(let t in e)if(t.startsWith(`aria-`)||t===`role`||t===`title`)return!0;return!1},Vu=(0,L.createContext)({}),Hu=()=>(0,L.useContext)(Vu),Uu=(0,L.forwardRef)(({color:e,size:t,width:n,height:r,strokeWidth:i,absoluteStrokeWidth:a,nonScalingStroke:o,className:s=``,children:c,iconNode:l=[],icon:u={node:l,aliases:[],size:24},...d},f)=>{let{size:p=24,strokeWidth:m=2,absoluteStrokeWidth:h=!1,nonScalingStroke:g=!1,color:_=`currentColor`,className:v=``}=Hu()??{},y=!!c||Bu(d),[b,x,S=[]]=zu(u,{color:e??_,width:n??t??p,height:r??t??p,strokeWidth:i??m,absoluteStrokeWidth:a??h,nonScalingStroke:o??g,className:Fu(v,s),hasA11yProp:y,attributes:d});return(0,L.createElement)(b,{ref:f,...x},[...S.map(([e,t])=>(0,L.createElement)(e,t)),...Array.isArray(c)?c:[c]])});function G(e,t=[],n=[]){let r=typeof e==`string`?Mu(e,t,n):e,i=(0,L.forwardRef)(({className:e,...t},n)=>(0,L.createElement)(Uu,{ref:n,icon:r,className:e,...t}));return r.name&&(i.displayName=Pu(r.name)),i}var Wu={name:`arrow-down-left`,size:24,node:[[`path`,{d:`M17 7 7 17`,key:`15tmo1`}],[`path`,{d:`M17 17H7V7`,key:`1org7z`}]]};Wu.node;var Gu=G(Wu),Ku={name:`arrow-right`,size:24,node:[[`path`,{d:`M5 12h14`,key:`1ays0h`}],[`path`,{d:`m12 5 7 7-7 7`,key:`xquz4c`}]]};Ku.node;var qu=G(Ku),Ju={name:`arrow-up-right`,size:24,node:[[`path`,{d:`M7 7h10v10`,key:`1tivn9`}],[`path`,{d:`M7 17 17 7`,key:`1vkiza`}]]};Ju.node;var Yu=G(Ju),Xu={name:`award`,size:24,node:[[`path`,{d:`m15.477 12.89 1.515 8.526a.5.5 0 0 1-.81.47l-3.58-2.687a1 1 0 0 0-1.197 0l-3.586 2.686a.5.5 0 0 1-.81-.469l1.514-8.526`,key:`1yiouv`}],[`circle`,{cx:`12`,cy:`8`,r:`6`,key:`1vp47v`}]]};Xu.node;var Zu=G(Xu),Qu={name:`bell`,size:24,node:[[`path`,{d:`M10.268 21a2 2 0 0 0 3.464 0`,key:`vwvbt9`}],[`path`,{d:`M3.262 15.326A1 1 0 0 0 4 17h16a1 1 0 0 0 .74-1.673C19.41 13.956 18 12.499 18 8A6 6 0 0 0 6 8c0 4.499-1.411 5.956-2.738 7.326`,key:`11g9vi`}]]};Qu.node;var $u=G(Qu),K={name:`building-complex`,size:24,node:[[`path`,{d:`M10 12h4`,key:`a56b0p`}],[`path`,{d:`M10 8h4`,key:`1sr2af`}],[`path`,{d:`M14 21v-3a2 2 0 0 0-4 0v3`,key:`1rgiei`}],[`path`,{d:`M6 10H4a2 2 0 0 0-2 2v7a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-2`,key:`secmi2`}],[`path`,{d:`M6 21V5a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v16`,key:`16ra0t`}]],aliases:[`building-2`]};K.node;var ed=G(K),q={name:`chart-no-axes-combined`,size:24,node:[[`path`,{d:`M12 16v5`,key:`zza2cw`}],[`path`,{d:`M16 14.639V21`,key:`1s85h0`}],[`path`,{d:`M20 10.656V21`,key:`q45596`}],[`path`,{d:`m22 3-8.646 8.646a.5.5 0 0 1-.708 0L9.354 8.354a.5.5 0 0 0-.707 0L2 15`,key:`1fw8x9`}],[`path`,{d:`M4 18.463V21`,key:`1otddq`}],[`path`,{d:`M8 14.656V21`,key:`1t2idw`}]]};q.node;var J=G(q),Y={name:`check`,size:24,node:[[`path`,{d:`M20 6 9 17l-5-5`,key:`1gmf2c`}]]};Y.node;var td=G(Y),nd={name:`chevron-right`,size:24,node:[[`path`,{d:`m9 18 6-6-6-6`,key:`mthhwq`}]]};nd.node;var rd=G(nd),id={name:`clock`,size:24,node:[[`circle`,{cx:`12`,cy:`12`,r:`10`,key:`1mglay`}],[`path`,{d:`M12 6v6l4 2`,key:`mmk7yg`}]]};id.node;var ad=G(id),od={name:`coffee`,size:24,node:[[`path`,{d:`M10 2v2`,key:`7u0qdc`}],[`path`,{d:`M14 2v2`,key:`6buw04`}],[`path`,{d:`M16 8a1 1 0 0 1 1 1v8a4 4 0 0 1-4 4H7a4 4 0 0 1-4-4V9a1 1 0 0 1 1-1h14a4 4 0 1 1 0 8h-1`,key:`pwadti`}],[`path`,{d:`M6 2v2`,key:`colzsn`}]]};od.node;var sd=G(od),cd={name:`credit-card`,size:24,node:[[`rect`,{width:`20`,height:`14`,x:`2`,y:`5`,rx:`2`,key:`ynyp8z`}],[`line`,{x1:`2`,x2:`22`,y1:`10`,y2:`10`,key:`1b3vmo`}],[`path`,{d:`M6 14h2`,key:`mk7k0u`}]]};cd.node;var ld=G(cd),ud={name:`download`,size:24,node:[[`path`,{d:`M12 15V3`,key:`m9g1x1`}],[`path`,{d:`M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4`,key:`ih7n3h`}],[`path`,{d:`m7 10 5 5 5-5`,key:`brsn70`}]]};ud.node;var dd=G(ud),fd={name:`external-link`,size:24,node:[[`path`,{d:`M15 3h6v6`,key:`1q9fwt`}],[`path`,{d:`M10 14 21 3`,key:`gplh6r`}],[`path`,{d:`M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6`,key:`a6xqqp`}]]};fd.node;var pd=G(fd),md={name:`file-text`,size:24,node:[[`path`,{d:`M6 22a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h8a2.4 2.4 0 0 1 1.704.706l3.588 3.588A2.4 2.4 0 0 1 20 8v12a2 2 0 0 1-2 2z`,key:`1oefj6`}],[`path`,{d:`M14 2v5a1 1 0 0 0 1 1h5`,key:`wfsgrz`}],[`path`,{d:`M10 9H8`,key:`b1mrlr`}],[`path`,{d:`M16 13H8`,key:`t4e002`}],[`path`,{d:`M16 17H8`,key:`z1uh3a`}]]};md.node;var hd=G(md),gd={name:`folder-kanban`,size:24,node:[[`path`,{d:`M4 20h16a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-7.93a2 2 0 0 1-1.66-.9l-.82-1.2A2 2 0 0 0 7.93 3H4a2 2 0 0 0-2 2v13c0 1.1.9 2 2 2Z`,key:`1fr9dc`}],[`path`,{d:`M8 10v4`,key:`tgpxqk`}],[`path`,{d:`M12 10v2`,key:`hh53o1`}],[`path`,{d:`M16 10v6`,key:`1d6xys`}]]};gd.node;var _d=G(gd),vd={name:`house`,size:24,node:[[`path`,{d:`M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8`,key:`5wwlr5`}],[`path`,{d:`M3 10a2 2 0 0 1 .709-1.528l7-6a2 2 0 0 1 2.582 0l7 6A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z`,key:`r6nss1`}]],aliases:[`home`]};vd.node;var yd=G(vd),bd={name:`inbox`,size:24,node:[[`polyline`,{points:`22 12 16 12 14 15 10 15 8 12 2 12`,key:`o97t9d`}],[`path`,{d:`M5.45 5.11 2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z`,key:`oot6mr`}]]};bd.node;var xd=G(bd),Sd={name:`layers`,size:24,node:[[`path`,{d:`M12.83 2.18a2 2 0 0 0-1.66 0L2.6 6.08a1 1 0 0 0 0 1.83l8.58 3.91a2 2 0 0 0 1.66 0l8.58-3.9a1 1 0 0 0 0-1.83z`,key:`zw3jo`}],[`path`,{d:`M2 12a1 1 0 0 0 .58.91l8.6 3.91a2 2 0 0 0 1.65 0l8.58-3.9A1 1 0 0 0 22 12`,key:`1wduqc`}],[`path`,{d:`M2 17a1 1 0 0 0 .58.91l8.6 3.91a2 2 0 0 0 1.65 0l8.58-3.9A1 1 0 0 0 22 17`,key:`kqbvx6`}]],aliases:[`layers-3`]};Sd.node;var Cd=G(Sd),wd={name:`layout-dashboard`,size:24,node:[[`rect`,{width:`7`,height:`9`,x:`3`,y:`3`,rx:`1`,key:`10lvy0`}],[`rect`,{width:`7`,height:`5`,x:`14`,y:`3`,rx:`1`,key:`16une8`}],[`rect`,{width:`7`,height:`9`,x:`14`,y:`12`,rx:`1`,key:`1hutg5`}],[`rect`,{width:`7`,height:`5`,x:`3`,y:`16`,rx:`1`,key:`ldoo1y`}]]};wd.node;var Td=G(wd),Ed={name:`log-out`,size:24,node:[[`path`,{d:`m16 17 5-5-5-5`,key:`1bji2h`}],[`path`,{d:`M21 12H9`,key:`dn1m92`}],[`path`,{d:`M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4`,key:`1uf3rs`}]]};Ed.node;var Dd=G(Ed),Od={name:`mail`,size:24,node:[[`path`,{d:`m22 7-8.991 5.727a2 2 0 0 1-2.009 0L2 7`,key:`132q7q`}],[`rect`,{x:`2`,y:`4`,width:`20`,height:`16`,rx:`2`,key:`izxlao`}]]};Od.node;var kd=G(Od),Ad={name:`moon`,size:24,node:[[`path`,{d:`M20.985 12.486a9 9 0 1 1-9.473-9.472c.405-.022.617.46.402.803a6 6 0 0 0 8.268 8.268c.344-.215.825-.004.803.401`,key:`kfwtm`}]]};Ad.node;var jd=G(Ad),Md={name:`plane`,size:24,node:[[`path`,{d:`M17.8 19.2 16 11l3.5-3.5C21 6 21.5 4 21 3c-1-.5-3 0-4.5 1.5L13 8 4.8 6.2c-.5-.1-.9.1-1.1.5l-.3.5c-.2.5-.1 1 .3 1.3L9 12l-2 3H4l-1 1 3 2 2 3 1-1v-3l3-2 3.5 5.3c.3.4.8.5 1.3.3l.5-.2c.4-.3.6-.7.5-1.2z`,key:`1v9wt8`}]]};Md.node;var Nd=G(Md),Pd={name:`plus`,size:24,node:[[`path`,{d:`M5 12h14`,key:`1ays0h`}],[`path`,{d:`M12 5v14`,key:`s699le`}]]};Pd.node;var Fd=G(Pd),Id={name:`search`,size:24,node:[[`path`,{d:`m21 21-4.34-4.34`,key:`14j7rj`}],[`circle`,{cx:`11`,cy:`11`,r:`8`,key:`4ej97u`}]]};Id.node;var Ld=G(Id),Rd={name:`settings-2`,size:24,node:[[`path`,{d:`M14 17H5`,key:`gfn3mx`}],[`path`,{d:`M19 7h-9`,key:`6i9tg`}],[`circle`,{cx:`17`,cy:`17`,r:`3`,key:`18b49y`}],[`circle`,{cx:`7`,cy:`7`,r:`3`,key:`dfmy0x`}]]};Rd.node;var zd=G(Rd),Bd={name:`shopping-bag`,size:24,node:[[`path`,{d:`M16 10a4 4 0 0 1-8 0`,key:`1ltviw`}],[`path`,{d:`M3.103 6.034h17.794`,key:`awc11p`}],[`path`,{d:`M3.4 5.467a2 2 0 0 0-.4 1.2V20a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6.667a2 2 0 0 0-.4-1.2l-2-2.667A2 2 0 0 0 17 2H7a2 2 0 0 0-1.6.8z`,key:`o988cm`}]]};Bd.node;var Vd=G(Bd),Hd={name:`sparkles`,size:24,node:[[`path`,{d:`M11.017 2.814a1 1 0 0 1 1.966 0l1.051 5.558a2 2 0 0 0 1.594 1.594l5.558 1.051a1 1 0 0 1 0 1.966l-5.558 1.051a2 2 0 0 0-1.594 1.594l-1.051 5.558a1 1 0 0 1-1.966 0l-1.051-5.558a2 2 0 0 0-1.594-1.594l-5.558-1.051a1 1 0 0 1 0-1.966l5.558-1.051a2 2 0 0 0 1.594-1.594z`,key:`1s2grr`}],[`path`,{d:`M20 2v4`,key:`1rf3ol`}],[`path`,{d:`M22 4h-4`,key:`gwowj6`}],[`circle`,{cx:`4`,cy:`20`,r:`2`,key:`6kqj1y`}]],aliases:[`stars`]};Hd.node;var Ud=G(Hd),Wd={name:`sun`,size:24,node:[[`circle`,{cx:`12`,cy:`12`,r:`4`,key:`4exip2`}],[`path`,{d:`M12 2v2`,key:`tus03m`}],[`path`,{d:`M12 20v2`,key:`1lh1kg`}],[`path`,{d:`m4.93 4.93 1.41 1.41`,key:`149t6j`}],[`path`,{d:`m17.66 17.66 1.41 1.41`,key:`ptbguv`}],[`path`,{d:`M2 12h2`,key:`1t8f8n`}],[`path`,{d:`M20 12h2`,key:`1q8mjw`}],[`path`,{d:`m6.34 17.66-1.41 1.41`,key:`1m8zz5`}],[`path`,{d:`m19.07 4.93-1.41 1.41`,key:`1shlcs`}]]};Wd.node;var Gd=G(Wd),Kd={name:`target`,size:24,node:[[`circle`,{cx:`12`,cy:`12`,r:`10`,key:`1mglay`}],[`circle`,{cx:`12`,cy:`12`,r:`6`,key:`1vlfrh`}],[`circle`,{cx:`12`,cy:`12`,r:`2`,key:`1c9p78`}]]};Kd.node;var qd=G(Kd),Jd={name:`trending-up`,size:24,node:[[`path`,{d:`M16 7h6v6`,key:`box55l`}],[`path`,{d:`m22 7-8.5 8.5-5-5L2 17`,key:`1t1m79`}]]};Jd.node;var Yd=G(Jd),Xd={name:`user`,size:24,node:[[`path`,{d:`M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2`,key:`975kel`}],[`circle`,{cx:`12`,cy:`7`,r:`4`,key:`17ys0d`}]]};Xd.node;var Zd=G(Xd),Qd={name:`users`,size:24,node:[[`path`,{d:`M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2`,key:`1yyitq`}],[`path`,{d:`M16 3.128a4 4 0 0 1 0 7.744`,key:`16gr8j`}],[`path`,{d:`M22 21v-2a4 4 0 0 0-3-3.87`,key:`kshegd`}],[`circle`,{cx:`9`,cy:`7`,r:`4`,key:`nufk8`}]]};Qd.node;var $d=G(Qd),ef={name:`wallet`,size:24,node:[[`path`,{d:`M19 7V4a1 1 0 0 0-1-1H5a2 2 0 0 0 0 4h15a1 1 0 0 1 1 1v4h-3a2 2 0 0 0 0 4h3a1 1 0 0 0 1-1v-2a1 1 0 0 0-1-1`,key:`18etb6`}],[`path`,{d:`M3 5v14a2 2 0 0 0 2 2h15a1 1 0 0 0 1-1v-4`,key:`xoc0q4`}]]};ef.node;var tf=G(ef),nf={name:`x`,size:24,node:[[`path`,{d:`M18 6 6 18`,key:`1bl5f8`}],[`path`,{d:`m6 6 12 12`,key:`d8bk6v`}]]};nf.node;var rf=G(nf),af=o((e=>{var t=Symbol.for(`react.transitional.element`),n=Symbol.for(`react.fragment`);function r(e,n,r){var i=null;if(r!==void 0&&(i=``+r),n.key!==void 0&&(i=``+n.key),`key`in n)for(var a in r={},n)a!==`key`&&(r[a]=n[a]);else r=n;return n=r.ref,{$$typeof:t,type:e,key:i,ref:n===void 0?null:n,props:r}}e.Fragment=n,e.jsx=r,e.jsxs=r})),X=o(((e,t)=>{t.exports=af()}))();wu.registerPlugin(Au);var of={blur:22,opacity:.3,saturation:1.2,tint:`#ffffff`,edge:.6},sf=[{id:`overview`,label:`Overview`,icon:yd},{id:`activity`,label:`Activity`,icon:tf},{id:`savings`,label:`Savings`,icon:qd},{id:`reports`,label:`Reports`,icon:J}],cf=(e,t,n,r)=>Number.isFinite(e)?Math.min(n,Math.max(t,e)):r,lf=e=>({blur:cf(e.blur??of.blur,0,40,of.blur),opacity:cf(e.opacity??of.opacity,.08,.9,of.opacity),saturation:cf(e.saturation??of.saturation,.5,2,of.saturation),edge:cf(e.edge??of.edge,0,1,of.edge),tint:/^#[0-9a-f]{6}$/i.test(e.tint??``)?e.tint:of.tint}),uf=e=>Number.isFinite(e)?Math.max(0,e):0,df=e=>e.target>0?cf(e.saved/e.target*100,0,100,0):0;function ff({category:e}){return(0,X.jsx)(e===`Income`?Gu:e===`Dining`?sd:e===`Travel`?Nd:e===`Shopping`?Vd:ed,{size:17,strokeWidth:1.7,"aria-hidden":`true`})}function pf({brand:e=`Workspace`,userName:t,backgroundImage:n,balance:r=0,balanceChange:i,account:a,periodLabel:o,cashFlowPeriods:s=[],initialPeriodId:c,footerNote:l,savingsNote:u,transactions:d=[],goals:f=[],glass:p=of,onGlassChange:m,currency:h=`USD`,theme:g=`system`,useHostTheme:_=!0,className:v=``,style:y}){let b=(0,L.useRef)(null),x=(0,L.useRef)(null),S=(0,L.useRef)(null),C=(0,L.useId)().replace(/:/g,``),[w,T]=(0,L.useState)(`overview`),[E,D]=(0,L.useState)(()=>lf(p)),[O,ee]=(0,L.useState)(!1),[te,ne]=(0,L.useState)(g),[k,re]=(0,L.useState)(c??s[0]?.id??``),[ie,ae]=(0,L.useState)(``),[oe,se]=(0,L.useState)(``),[ce,le]=(0,L.useState)(!1),[ue,de]=(0,L.useState)(!1);(0,L.useEffect)(()=>D(lf(p)),[p.blur,p.opacity,p.saturation,p.tint,p.edge]),(0,L.useEffect)(()=>ne(g),[g]),(0,L.useEffect)(()=>{c!==void 0&&re(c)},[c]),(0,L.useEffect)(()=>{O&&b.current?.querySelector(`.gw-material button`)?.focus()},[O]),(0,L.useEffect)(()=>de(!1),[n]),(0,L.useEffect)(()=>{if(!oe)return;let e=window.setTimeout(()=>se(``),3200);return()=>window.clearTimeout(e)},[oe]);let fe=(0,L.useMemo)(()=>{try{return new Intl.NumberFormat(`en-US`,{style:`currency`,currency:h,maximumFractionDigits:2})}catch{return new Intl.NumberFormat(`en-US`,{style:`currency`,currency:`USD`})}},[h]),pe=e=>fe.format(Number.isFinite(e)?e:0),me=d.filter(e=>e.amount<0).reduce((e,t)=>e-t.amount,0),he=f.reduce((e,t)=>e+Math.max(0,t.saved),0),ge=d.filter(e=>`${e.name} ${e.category}`.toLowerCase().includes(ie.toLowerCase())),A=s.find(e=>e.id===k)??s[0],j=A?.points??[],M=j.reduce((e,t)=>e+uf(t.income),0),_e=j.reduce((e,t)=>e+uf(t.expenses),0),ve=Math.max(1,...j.flatMap(e=>[uf(e.income),uf(e.expenses)])),ye=e=>j.length===1?300:e*600/(j.length-1),be=e=>180-uf(e)/ve*160,xe=e=>j.map((t,n)=>`${ye(n)},${be(t[e])}`).join(` `),N=new Set(Array.from({length:Math.min(j.length,6)},(e,t)=>j.length<=6?t:Math.round(t*(j.length-1)/5))),Se=Array.from(new Set(d.filter(e=>e.amount<0).map(e=>e.category)));Au(()=>{let e=wu.matchMedia();return e.add(`(prefers-reduced-motion: no-preference)`,()=>{let e=x.current?.querySelectorAll(`.gw-reveal`);e?.length&&wu.fromTo(e,{y:12,opacity:.45,filter:`blur(3px)`},{y:0,opacity:1,filter:`blur(0px)`,duration:.48,stagger:.045,ease:`power3.out`,clearProps:`transform,opacity,filter`})}),()=>e.revert()},{scope:b,dependencies:[w],revertOnUpdate:!0});function Ce(e){let t=lf({...E,...e});D(t),m?.(t)}function we(){ee(!1),S.current?.focus()}function Te(e){T(e),le(!1)}function Ee(){let e=b.current?getComputedStyle(b.current).colorScheme:`normal`;ne(e===`dark`||e!==`light`&&window.matchMedia(`(prefers-color-scheme: dark)`).matches?`light`:`dark`)}function De(){let e=e=>`"${(/^[\s]*[=+@-]/.test(e)?`'`:``)+e.replace(/"/g,`""`)}"`,t=[`Name,Category,Date,Amount,Status`,...ge.map(t=>[e(t.name),e(t.category),e(t.date),t.amount,e(t.status)].join(`,`))].join(`\r
`),n=URL.createObjectURL(new Blob([t],{type:`text/csv;charset=utf-8;`})),r=document.createElement(`a`);r.href=n,r.download=`transactions.csv`,r.click(),window.setTimeout(()=>URL.revokeObjectURL(n),1e3),se(`Transactions exported.`)}let Oe=(e=!1)=>(0,X.jsx)(`nav`,{className:e?`gw-rail gw-glass`:`gw-dock gw-glass`,"aria-label":e?`Quick navigation`:`Workspace views`,children:sf.map((t,n)=>(0,X.jsxs)(`button`,{type:`button`,"aria-label":e?t.label:void 0,title:e?t.label:void 0,"aria-current":w===t.id?`page`:void 0,onClick:()=>Te(t.id),onKeyDown:e=>{if(![`ArrowLeft`,`ArrowRight`,`Home`,`End`].includes(e.key))return;e.preventDefault();let t=e.key===`Home`?0:e.key===`End`?3:(n+(e.key===`ArrowRight`?1:3))%4;Te(sf[t].id),(e.currentTarget.parentElement?.children[t])?.focus()},children:[(0,X.jsx)(t.icon,{size:18,strokeWidth:1.7,"aria-hidden":`true`}),(0,X.jsx)(`span`,{children:t.label})]},t.id))}),ke=e=>s.length>1?(0,X.jsx)(`div`,{className:`gw-segment`,role:`group`,"aria-label":e,children:s.map(e=>(0,X.jsx)(`button`,{type:`button`,"aria-pressed":A?.id===e.id,onClick:()=>re(e.id),children:e.label},e.id))}):null,Ae=j.length?(0,X.jsxs)(`div`,{className:`gw-chart-wrap`,children:[(0,X.jsxs)(`div`,{className:`gw-chart-labels`,children:[(0,X.jsx)(`span`,{children:pe(ve)}),(0,X.jsx)(`span`,{children:pe(ve/2)}),(0,X.jsx)(`span`,{children:pe(0)})]}),(0,X.jsxs)(`svg`,{viewBox:`0 0 600 185`,role:`img`,"aria-label":`${A?.label??`Cash flow`}: money in ${pe(M)}, money out ${pe(_e)}.`,preserveAspectRatio:`none`,children:[(0,X.jsx)(`desc`,{children:j.map(e=>`${e.label}: income ${pe(uf(e.income))}, expenses ${pe(uf(e.expenses))}`).join(`. `)}),(0,X.jsx)(`defs`,{children:(0,X.jsxs)(`linearGradient`,{id:`${C}-area`,x1:`0`,x2:`0`,y1:`0`,y2:`1`,children:[(0,X.jsx)(`stop`,{offset:`0`,stopColor:`var(--gw-accent)`,stopOpacity:`.23`}),(0,X.jsx)(`stop`,{offset:`1`,stopColor:`var(--gw-accent)`,stopOpacity:`0`})]})}),[20,100,180].map(e=>(0,X.jsx)(`path`,{d:`M0 ${e} H600`,stroke:`currentColor`,opacity:`.11`,strokeDasharray:`3 5`},e)),(0,X.jsx)(`path`,{d:`M${ye(0)} 185 ${j.map((e,t)=>`L${ye(t)} ${be(e.income)}`).join(` `)} L${ye(j.length-1)} 185 Z`,fill:`url(#${C}-area)`}),(0,X.jsx)(`polyline`,{points:xe(`income`),fill:`none`,stroke:`var(--gw-accent)`,strokeWidth:`2.6`,strokeLinejoin:`round`,strokeLinecap:`round`}),(0,X.jsx)(`polyline`,{points:xe(`expenses`),fill:`none`,stroke:`currentColor`,strokeOpacity:`.45`,strokeWidth:`2`,strokeLinejoin:`round`,strokeLinecap:`round`}),j.length===1&&(0,X.jsxs)(X.Fragment,{children:[(0,X.jsx)(`circle`,{cx:`300`,cy:be(j[0].income),r:`4`,fill:`var(--gw-accent)`}),(0,X.jsx)(`circle`,{cx:`300`,cy:be(j[0].expenses),r:`4`,fill:`currentColor`,opacity:`.45`})]})]}),(0,X.jsx)(`div`,{className:`gw-chart-months`,children:j.map((e,t)=>N.has(t)&&(0,X.jsx)(`span`,{style:{left:`${ye(t)/6}%`,transform:t===0&&j.length>1?`none`:t===j.length-1&&j.length>1?`translateX(-100%)`:`translateX(-50%)`},children:e.label},`${e.label}-${t}`))})]}):(0,X.jsxs)(`div`,{className:`gw-empty gw-chart-empty`,children:[(0,X.jsx)(J,{size:23,"aria-hidden":`true`}),(0,X.jsx)(`h3`,{children:`No cash-flow data yet`}),(0,X.jsx)(`p`,{children:`Cash flow will appear when period data is available.`})]}),je=e=>(0,X.jsx)(`div`,{className:`gw-transactions`,children:ge.length?ge.slice(0,e).map(e=>(0,X.jsxs)(`div`,{className:`gw-transaction`,children:[(0,X.jsx)(`span`,{className:`gw-transaction-icon ${e.amount>0?`is-income`:``}`,children:(0,X.jsx)(ff,{category:e.category})}),(0,X.jsxs)(`div`,{className:`gw-transaction-name`,children:[(0,X.jsx)(`strong`,{children:e.name}),(0,X.jsxs)(`span`,{children:[e.category,` · `,e.date]})]}),(0,X.jsxs)(`span`,{className:`gw-transaction-status ${e.status===`Pending`?`is-pending`:``}`,children:[e.status===`Completed`&&(0,X.jsx)(td,{size:12,"aria-hidden":`true`}),e.status]}),(0,X.jsxs)(`strong`,{className:e.amount>0?`gw-positive`:``,children:[e.amount>0?`+`:`−`,pe(Math.abs(e.amount))]})]},e.id)):(0,X.jsxs)(`div`,{className:`gw-empty`,children:[(0,X.jsx)(Ld,{size:23,"aria-hidden":`true`}),(0,X.jsx)(`h3`,{children:ie?`No matching transactions`:`No transactions yet`}),(0,X.jsx)(`p`,{children:ie?`Try another name or category.`:`Your activity will appear here.`}),ie&&(0,X.jsx)(`button`,{type:`button`,onClick:()=>ae(``),children:`Clear search`})]})}),Me=(0,X.jsx)(`div`,{className:`gw-goals`,children:f.length?f.map((e,t)=>(0,X.jsxs)(`div`,{className:`gw-goal`,children:[(0,X.jsxs)(`div`,{className:`gw-goal-top`,children:[(0,X.jsx)(`span`,{className:`gw-goal-icon`,children:t%2?(0,X.jsx)(Nd,{size:18,"aria-hidden":`true`}):(0,X.jsx)(qd,{size:18,"aria-hidden":`true`})}),(0,X.jsx)(`strong`,{children:e.name}),(0,X.jsxs)(`span`,{children:[Math.round(df(e)),`%`]})]}),(0,X.jsx)(`div`,{className:`gw-goal-track`,role:`progressbar`,"aria-label":e.name,"aria-valuenow":Math.round(df(e)),"aria-valuemin":0,"aria-valuemax":100,children:(0,X.jsx)(`i`,{style:{width:`${df(e)}%`,background:e.color}})}),(0,X.jsxs)(`p`,{children:[(0,X.jsx)(`strong`,{children:pe(e.saved)}),(0,X.jsxs)(`span`,{children:[`of `,pe(e.target)]})]})]},e.id)):(0,X.jsx)(`p`,{className:`gw-empty`,children:`No savings goals yet.`})});return(0,X.jsxs)(`div`,{ref:b,className:`gw-root ${v}`,"data-theme":_?`system`:te,"data-host-theme":_,style:{"--gw-blur":`${E.blur}px`,"--gw-opacity":E.opacity,"--gw-saturation":E.saturation,"--gw-tint":_?`color-mix(in srgb, var(--color-background, Canvas) 80%, ${E.tint})`:E.tint,"--gw-edge":E.edge,...y},onKeyDown:e=>{e.key===`Escape`&&(O&&we(),le(!1))},children:[(0,X.jsx)(`style`,{children:Z}),n&&!ue&&(0,X.jsx)(`img`,{className:`gw-room`,src:n,alt:``,onError:()=>de(!0)}),(0,X.jsx)(`div`,{className:`gw-room-shade`,"aria-hidden":`true`}),(0,X.jsxs)(`div`,{className:`gw-workspace`,children:[(0,X.jsxs)(`header`,{className:`gw-topbar gw-glass`,children:[(0,X.jsxs)(`a`,{className:`gw-brand`,href:`#`,onClick:e=>{e.preventDefault(),Te(`overview`)},children:[(0,X.jsx)(`span`,{className:`gw-brand-icon`,children:(0,X.jsx)(Cd,{size:18,strokeWidth:1.7,"aria-hidden":`true`})}),(0,X.jsx)(`strong`,{children:e}),(0,X.jsx)(`span`,{className:`gw-brand-divider`}),(0,X.jsx)(`span`,{className:`gw-personal`,children:`Personal workspace`})]}),(0,X.jsxs)(`div`,{className:`gw-toolbar`,children:[(0,X.jsxs)(`button`,{type:`button`,className:`gw-adjust`,ref:S,onClick:()=>{ee(!O),le(!1)},"aria-expanded":O,"aria-controls":`${C}-material`,children:[(0,X.jsx)(zd,{size:16,"aria-hidden":`true`}),(0,X.jsx)(`span`,{children:`Adjust glass`})]}),!_&&(0,X.jsxs)(`button`,{type:`button`,className:`gw-icon-button`,"aria-label":`Toggle light and dark theme`,onClick:Ee,children:[(0,X.jsx)(Gd,{className:`gw-sun`,size:17,"aria-hidden":`true`}),(0,X.jsx)(jd,{className:`gw-moon`,size:17,"aria-hidden":`true`})]}),(0,X.jsxs)(`button`,{type:`button`,className:`gw-icon-button gw-bell`,"aria-label":`Notifications`,"aria-expanded":ce,onClick:()=>{le(!ce),ee(!1)},children:[(0,X.jsx)($u,{size:17,"aria-hidden":`true`}),(0,X.jsx)(`i`,{})]}),t&&(0,X.jsx)(`span`,{className:`gw-avatar`,title:t,children:t.slice(0,1).toUpperCase()})]})]}),(0,X.jsxs)(`div`,{className:`gw-stage`,children:[Oe(!0),(0,X.jsxs)(`main`,{className:`gw-main gw-glass`,children:[(0,X.jsxs)(`div`,{className:`gw-view-heading`,children:[(0,X.jsxs)(`div`,{children:[(0,X.jsx)(`p`,{className:`gw-greeting`,children:w===`overview`&&t?`Welcome back, ${t}.`:`Your personal workspace`}),(0,X.jsx)(`h1`,{children:w===`overview`?`Overview`:w===`activity`?`Activity`:w===`savings`?`Savings & goals`:`Reports`})]}),(0,X.jsx)(`div`,{className:`gw-heading-action`,children:w===`activity`||w===`reports`?(0,X.jsxs)(`button`,{type:`button`,className:`gw-button`,onClick:De,children:[(0,X.jsx)(dd,{size:14,"aria-hidden":`true`}),`Export CSV`]}):o&&(0,X.jsx)(`span`,{className:`gw-date`,children:o})})]}),(0,X.jsx)(`div`,{className:`gw-mobile-nav`,children:Oe()}),(0,X.jsxs)(`div`,{ref:x,className:`gw-view`,children:[w===`overview`&&(0,X.jsxs)(X.Fragment,{children:[(0,X.jsxs)(`div`,{className:`gw-overview-grid`,children:[(0,X.jsxs)(`section`,{className:`gw-panel gw-balance gw-reveal`,children:[(0,X.jsxs)(`div`,{className:`gw-panel-title`,children:[(0,X.jsx)(`span`,{children:`Available balance`}),(0,X.jsx)(tf,{size:17,"aria-hidden":`true`})]}),(0,X.jsx)(`strong`,{className:`gw-balance-value`,children:pe(r)}),i&&Number.isFinite(i.percent)&&(0,X.jsxs)(`p`,{className:`gw-balance-meta`,children:[(0,X.jsxs)(`span`,{className:i.percent>=0?`gw-positive`:void 0,children:[i.percent>0?`+`:``,i.percent,`%`]}),` `,i.label]}),a&&(0,X.jsxs)(`div`,{className:`gw-account`,children:[(0,X.jsx)(`span`,{className:`gw-account-icon`,children:(0,X.jsx)(ld,{size:19,"aria-hidden":`true`})}),(0,X.jsxs)(`div`,{children:[(0,X.jsx)(`strong`,{children:a.name}),a.lastFour&&(0,X.jsxs)(`span`,{children:[`•••• `,a.lastFour.slice(-4)]})]}),(0,X.jsx)(`button`,{type:`button`,"aria-label":`View account activity`,onClick:()=>Te(`activity`),children:(0,X.jsx)(Yu,{size:20,"aria-hidden":`true`})})]})]}),(0,X.jsxs)(`section`,{className:`gw-panel gw-cashflow gw-reveal`,children:[(0,X.jsxs)(`div`,{className:`gw-panel-title`,children:[(0,X.jsx)(`h2`,{children:`Cash flow`}),ke(`Chart period`)]}),(0,X.jsxs)(`div`,{className:`gw-chart-summary`,children:[(0,X.jsxs)(`div`,{children:[(0,X.jsxs)(`span`,{children:[(0,X.jsx)(`i`,{}),`Money in`]}),(0,X.jsx)(`strong`,{children:pe(M)})]}),(0,X.jsxs)(`div`,{children:[(0,X.jsxs)(`span`,{children:[(0,X.jsx)(`i`,{}),`Money out`]}),(0,X.jsx)(`strong`,{children:pe(_e)})]})]}),Ae]})]}),(0,X.jsxs)(`div`,{className:`gw-lower-grid`,children:[(0,X.jsxs)(`section`,{className:`gw-panel gw-reveal`,children:[(0,X.jsxs)(`div`,{className:`gw-panel-title`,children:[(0,X.jsx)(`h2`,{children:`Recent activity`}),(0,X.jsxs)(`button`,{className:`gw-text-button`,type:`button`,onClick:()=>Te(`activity`),children:[`View all`,(0,X.jsx)(qu,{size:14,"aria-hidden":`true`})]})]}),je(4)]}),(0,X.jsxs)(`section`,{className:`gw-panel gw-reveal`,children:[(0,X.jsxs)(`div`,{className:`gw-panel-title`,children:[(0,X.jsx)(`h2`,{children:`Savings goals`}),(0,X.jsxs)(`span`,{className:`gw-small-label`,children:[f.length,` active`]})]}),Me]})]})]}),w===`activity`&&(0,X.jsxs)(`section`,{className:`gw-panel gw-reveal`,children:[(0,X.jsxs)(`div`,{className:`gw-panel-title`,children:[(0,X.jsxs)(`h2`,{children:[`Transactions`,` `,(0,X.jsx)(`span`,{className:`gw-count`,children:d.length})]}),(0,X.jsxs)(`label`,{className:`gw-search`,children:[(0,X.jsx)(Ld,{size:15,"aria-hidden":`true`}),(0,X.jsx)(`input`,{"aria-label":`Search transactions`,placeholder:`Search transactions`,value:ie,onChange:e=>ae(e.target.value)}),ie&&(0,X.jsx)(`button`,{type:`button`,"aria-label":`Clear search`,onClick:()=>ae(``),children:(0,X.jsx)(rf,{size:14,"aria-hidden":`true`})})]})]}),je()]}),w===`savings`&&(0,X.jsxs)(X.Fragment,{children:[(0,X.jsxs)(`div`,{className:`gw-savings-intro gw-reveal`,children:[(0,X.jsx)(`span`,{className:`gw-savings-orb`,children:(0,X.jsx)(qd,{size:28,strokeWidth:1.3,"aria-hidden":`true`})}),(0,X.jsxs)(`div`,{children:[(0,X.jsx)(`p`,{children:`Total saved`}),(0,X.jsx)(`strong`,{children:pe(he)})]}),(0,X.jsxs)(`span`,{children:[f.length,` savings goals`,(0,X.jsx)(`br`,{}),`Tracked in one place`]})]}),(0,X.jsxs)(`section`,{className:`gw-panel gw-reveal`,children:[(0,X.jsxs)(`div`,{className:`gw-panel-title`,children:[(0,X.jsx)(`h2`,{children:`Your goals`}),(0,X.jsxs)(`span`,{children:[f.length,` active`]})]}),Me]}),u&&(0,X.jsxs)(`section`,{className:`gw-savings-note gw-reveal`,children:[(0,X.jsx)(td,{size:18,"aria-hidden":`true`}),(0,X.jsx)(`p`,{children:u})]})]}),w===`reports`&&(0,X.jsxs)(X.Fragment,{children:[(0,X.jsx)(`div`,{className:`gw-report-stats gw-reveal`,children:[{label:`Money in`,value:M,icon:Gu},{label:`Money out`,value:_e,icon:Yu},{label:`Net cash flow`,value:M-_e,icon:J}].map(e=>(0,X.jsxs)(`section`,{className:`gw-panel`,children:[(0,X.jsxs)(`div`,{className:`gw-panel-title`,children:[(0,X.jsx)(`span`,{children:e.label}),(0,X.jsx)(e.icon,{size:17,"aria-hidden":`true`})]}),(0,X.jsx)(`strong`,{children:pe(e.value)}),(0,X.jsx)(`span`,{children:A?.label??`No period data`})]},e.label))}),(0,X.jsxs)(`div`,{className:`gw-reports-grid`,children:[(0,X.jsxs)(`section`,{className:`gw-panel gw-reveal`,children:[(0,X.jsxs)(`div`,{className:`gw-panel-title`,children:[(0,X.jsx)(`h2`,{children:`Income & expenses`}),ke(`Report period`)]}),(0,X.jsxs)(`div`,{className:`gw-chart-legend`,children:[(0,X.jsxs)(`span`,{children:[(0,X.jsx)(`i`,{}),`Money in`]}),(0,X.jsxs)(`span`,{children:[(0,X.jsx)(`i`,{}),`Money out`]})]}),Ae,A?.description&&(0,X.jsx)(`p`,{className:`gw-chart-footnote`,children:A.description})]}),(0,X.jsxs)(`section`,{className:`gw-panel gw-reveal`,children:[(0,X.jsxs)(`div`,{className:`gw-panel-title`,children:[(0,X.jsx)(`h2`,{children:`Where it goes`}),(0,X.jsx)(`span`,{children:`All supplied activity`})]}),(0,X.jsx)(`div`,{className:`gw-category-list`,children:Se.map((e,t)=>{let n=d.filter(t=>t.category===e&&t.amount<0).reduce((e,t)=>e-t.amount,0);return(0,X.jsxs)(`div`,{children:[(0,X.jsxs)(`div`,{children:[(0,X.jsx)(ff,{category:e}),(0,X.jsx)(`span`,{children:e}),(0,X.jsx)(`strong`,{children:pe(n)})]}),(0,X.jsx)(`span`,{className:`gw-category-track`,children:(0,X.jsx)(`i`,{style:{width:`${me?n/me*100:0}%`,opacity:Math.max(.4,1-t*.14)}})})]},e)})})]})]})]})]},w),l&&(0,X.jsx)(`footer`,{className:`gw-footer`,children:(0,X.jsxs)(`span`,{children:[(0,X.jsx)(`i`,{}),l]})}),(0,X.jsx)(`div`,{className:`gw-desktop-dock`,children:Oe()})]})]}),ce&&(0,X.jsxs)(`aside`,{className:`gw-notifications gw-glass`,"aria-label":`Notifications`,children:[(0,X.jsxs)(`div`,{children:[(0,X.jsx)(`h2`,{children:`You're all caught up.`}),(0,X.jsx)(`button`,{type:`button`,"aria-label":`Close notifications`,onClick:()=>le(!1),children:(0,X.jsx)(rf,{size:17,"aria-hidden":`true`})})]}),(0,X.jsx)(`p`,{children:`No new notifications.`})]}),O&&(0,X.jsxs)(`aside`,{className:`gw-material gw-glass`,id:`${C}-material`,"aria-label":`Glass appearance`,children:[(0,X.jsxs)(`div`,{className:`gw-material-title`,children:[(0,X.jsxs)(`div`,{children:[(0,X.jsx)(`span`,{className:`gw-material-icon`,children:(0,X.jsx)(zd,{size:18,"aria-hidden":`true`})}),(0,X.jsx)(`h2`,{children:`Glass appearance`})]}),(0,X.jsx)(`button`,{type:`button`,className:`gw-icon-button`,"aria-label":`Close glass settings`,onClick:we,children:(0,X.jsx)(rf,{size:18,"aria-hidden":`true`})})]}),(0,X.jsx)(`p`,{children:`Adjust the material across your workspace.`}),(0,X.jsxs)(`div`,{className:`gw-material-sample`,"aria-hidden":`true`,children:[(0,X.jsx)(Cd,{size:28,strokeWidth:1.1}),(0,X.jsx)(`span`,{children:`Live material preview`})]}),(0,X.jsx)(`div`,{className:`gw-presets`,"aria-label":`Glass presets`,children:[{name:`Clear`,value:{blur:8,opacity:.12,saturation:1.1,edge:.8}},{name:`Frosted`,value:of},{name:`Solid`,value:{blur:32,opacity:.86,saturation:1,edge:.35}}].map(e=>(0,X.jsx)(`button`,{type:`button`,onClick:()=>Ce(e.value),children:e.name},e.name))}),[{key:`blur`,label:`Blur`,min:0,max:40,step:1,value:`${Math.round(E.blur)} px`},{key:`opacity`,label:`Opacity`,min:.08,max:.9,step:.01,value:`${Math.round(E.opacity*100)}%`},{key:`saturation`,label:`Saturation`,min:.5,max:2,step:.05,value:`${Math.round(E.saturation*100)}%`},{key:`edge`,label:`Edge light`,min:0,max:1,step:.05,value:`${Math.round(E.edge*100)}%`}].map(e=>(0,X.jsxs)(`label`,{className:`gw-range`,children:[(0,X.jsxs)(`span`,{children:[e.label,(0,X.jsx)(`output`,{children:e.value})]}),(0,X.jsx)(`input`,{type:`range`,"aria-label":e.label,min:e.min,max:e.max,step:e.step,value:E[e.key],onChange:t=>Ce({[e.key]:Number(t.target.value)})})]},e.key)),(0,X.jsxs)(`label`,{className:`gw-tint`,children:[`Glass tint`,` `,(0,X.jsx)(`input`,{type:`color`,value:E.tint,onChange:e=>Ce({tint:e.target.value})})]}),(0,X.jsx)(`button`,{className:`gw-reset`,type:`button`,onClick:()=>Ce(lf(p)),children:`Reset appearance`})]})]}),oe&&(0,X.jsxs)(`div`,{className:`gw-toast`,role:`status`,children:[(0,X.jsx)(td,{size:16,"aria-hidden":`true`}),oe]})]})}var Z=`
.gw-root {
  --gw-ink: var(--color-foreground, CanvasText);
  --gw-muted: var(--color-muted-foreground, GrayText);
  --gw-accent: var(--color-primary, Highlight);
  --gw-line: color-mix(
    in srgb,
    var(--color-border, CanvasText) 35%,
    transparent
  );
  --gw-background: var(--color-background, Canvas);
  --gw-shade: color-mix(
    in srgb,
    var(--color-background, Canvas) 22%,
    transparent
  );
  --gw-surface: var(--color-card, var(--color-background, Canvas));
  --gw-panel: var(--color-card, var(--color-background, Canvas));
  --gw-brand: var(--color-primary, Highlight);
  --gw-brand-ink: var(--color-primary-foreground, HighlightText);
  --gw-avatar: var(--color-secondary, ButtonFace);
  --gw-rail-active: color-mix(
    in srgb,
    var(--color-secondary, ButtonFace) 70%,
    transparent
  );
  --gw-positive-surface: color-mix(
    in srgb,
    var(--color-primary, Highlight) 15%,
    var(--color-card, Canvas)
  );
  --gw-account-surface: color-mix(
    in srgb,
    var(--color-secondary, ButtonFace) 45%,
    transparent
  );
  --gw-account-action: color-mix(
    in srgb,
    var(--color-secondary, ButtonFace) 45%,
    transparent
  );
  --gw-segment: color-mix(
    in srgb,
    var(--color-muted, ButtonFace) 25%,
    transparent
  );
  --gw-segment-active: color-mix(
    in srgb,
    var(--color-card, Canvas) 85%,
    transparent
  );
  --gw-transaction-surface: color-mix(
    in srgb,
    var(--color-secondary, ButtonFace) 45%,
    transparent
  );
  --gw-income-surface: color-mix(
    in srgb,
    var(--color-primary, Highlight) 15%,
    transparent
  );
  --gw-pending: var(--color-muted-foreground, GrayText);
  --gw-goal-surface: color-mix(
    in srgb,
    var(--color-secondary, ButtonFace) 40%,
    transparent
  );
  --gw-dock: color-mix(in srgb, var(--color-card, Canvas) 70%, transparent);
  --gw-dock-active: var(--color-secondary, ButtonFace);
  --gw-button: var(--color-primary, Highlight);
  --gw-button-ink: var(--color-primary-foreground, HighlightText);
  --gw-search: color-mix(in srgb, var(--color-input, Canvas) 35%, transparent);
  --gw-savings-orb: color-mix(
    in srgb,
    var(--color-primary, Highlight) 15%,
    transparent
  );
  --gw-popover: color-mix(
    in srgb,
    var(--color-popover, Canvas) 94%,
    transparent
  );
  --gw-notification: color-mix(
    in srgb,
    var(--color-popover, Canvas) 94%,
    transparent
  );
  --gw-fallback: var(--color-card, Canvas);
  --gw-mobile-dock: color-mix(
    in srgb,
    var(--color-card, Canvas) 55%,
    transparent
  );
  --gw-shadow: color-mix(
    in srgb,
    var(--color-foreground, CanvasText) 18%,
    transparent
  );
  --gw-panel-shadow: color-mix(
    in srgb,
    var(--color-foreground, CanvasText) 16%,
    transparent
  );
  --gw-soft-shadow: color-mix(
    in srgb,
    var(--color-foreground, CanvasText) 7%,
    transparent
  );
  --gw-segment-shadow: color-mix(
    in srgb,
    var(--color-foreground, CanvasText) 6%,
    transparent
  );
  --gw-dock-shadow: color-mix(
    in srgb,
    var(--color-foreground, CanvasText) 7%,
    transparent
  );
  --gw-popover-shadow: color-mix(
    in srgb,
    var(--color-foreground, CanvasText) 20%,
    transparent
  );
  --gw-sample-shadow: color-mix(
    in srgb,
    var(--color-foreground, CanvasText) 35%,
    transparent
  );
  --gw-toast-shadow: color-mix(
    in srgb,
    var(--color-foreground, CanvasText) 13%,
    transparent
  );
  --gw-toast: var(--color-primary, Highlight);
  --gw-dock-ink: var(--color-secondary-foreground, CanvasText);
  --gw-selection: color-mix(
    in srgb,
    var(--color-primary, Highlight) 35%,
    transparent
  );
  --gw-scrollbar: var(--color-muted-foreground, GrayText);
  --gw-hover: color-mix(
    in srgb,
    var(--color-secondary, ButtonFace) 25%,
    transparent
  );
  --gw-dock-hover: color-mix(
    in srgb,
    var(--color-secondary, ButtonFace) 30%,
    transparent
  );
  --gw-control-hover: color-mix(
    in srgb,
    var(--color-secondary, ButtonFace) 35%,
    transparent
  );
  --gw-strong-edge: color-mix(
    in srgb,
    var(--color-card, Canvas) 60%,
    transparent
  );
  --gw-soft-edge: color-mix(
    in srgb,
    var(--color-card, Canvas) 53%,
    transparent
  );
  --gw-toast-ink: var(--color-primary-foreground, HighlightText);
  --gw-highlight: var(--color-card, Canvas);
  position: relative;
  isolation: isolate;
  min-height: 100svh;
  overflow: hidden;
  padding: 38px 28px 32px;
  background: var(--gw-background);
  color: var(--gw-ink);
  font:
    14px/1.5 "Segoe UI",
    Arial,
    sans-serif;
  letter-spacing: -0.012em;
  font-variant-numeric: tabular-nums;
  box-sizing: border-box;
  color-scheme: inherit;
}
.gw-root[data-theme="light"] {
  color-scheme: light;
}
.gw-root[data-theme="dark"] {
  color-scheme: dark;
}
.gw-root * {
  box-sizing: border-box;
}
.gw-root ::selection {
  background: var(--gw-selection);
}
.gw-root button,
.gw-root input,
.gw-root a {
  font: inherit;
  color: inherit;
}
.gw-root button {
  cursor: pointer;
}
.gw-root button:disabled {
  cursor: not-allowed;
  opacity: 0.5;
}
.gw-root button,
.gw-root a,
.gw-root input {
  outline-offset: 4px;
}
.gw-root :focus-visible {
  outline: 2px solid var(--gw-accent);
}
.gw-root button {
  border: 0;
  background: none;
}
.gw-root h1,
.gw-root h2,
.gw-root h3,
.gw-root p {
  margin: 0;
}
.gw-room {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: center 56%;
  z-index: -3;
}
.gw-room-shade {
  position: absolute;
  inset: 0;
  background: var(--gw-shade);
  z-index: -2;
}
.gw-workspace {
  position: relative;
  width: min(1280px, 100%);
  margin: auto;
}
.gw-glass {
  background: color-mix(
    in srgb,
    var(--gw-surface) calc(var(--gw-opacity) * 100%),
    transparent
  );
  backdrop-filter: blur(var(--gw-blur)) saturate(var(--gw-saturation));
  -webkit-backdrop-filter: blur(var(--gw-blur)) saturate(var(--gw-saturation));
  box-shadow:
    inset 0 1px 0
      color-mix(
        in srgb,
        var(--gw-highlight) calc(var(--gw-edge) * 100%),
        transparent
      ),
    inset 0 0 0 1px
      color-mix(
        in srgb,
        var(--gw-highlight) calc(var(--gw-edge) * 34%),
        transparent
      ),
    0 20px 52px -25px var(--gw-shadow);
  position: relative;
}
.gw-glass:before {
  content: "";
  position: absolute;
  inset: 0;
  background: var(--gw-tint);
  opacity: 0.12;
  pointer-events: none;
  border-radius: inherit;
}
.gw-topbar {
  height: 62px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 20px;
  border-radius: 20px;
  margin-bottom: 18px;
  padding: 0 20px;
}
.gw-brand {
  display: flex;
  align-items: center;
  gap: 10px;
  text-decoration: none;
  white-space: nowrap;
}
.gw-brand strong {
  font-size: 14px;
  letter-spacing: -0.025em;
}
.gw-brand-icon {
  display: grid;
  place-items: center;
  width: 29px;
  height: 29px;
  background: var(--gw-brand);
  color: var(--gw-brand-ink);
  border-radius: 9px;
}
.gw-brand-divider {
  height: 16px;
  width: 1px;
  background: var(--gw-line);
  margin: 0 4px;
}
.gw-personal {
  font-size: 12px;
  color: var(--gw-muted);
}
.gw-toolbar {
  display: flex;
  align-items: center;
  gap: 10px;
}
.gw-adjust {
  display: flex;
  align-items: center;
  gap: 8px;
  border-radius: 9px;
  padding: 8px 10px;
}
.gw-adjust:hover {
  background: var(--gw-hover);
}
.gw-icon-button {
  width: 34px;
  height: 34px;
  display: grid;
  place-items: center;
  border-radius: 50%;
  flex: none;
}
.gw-icon-button:hover {
  background: var(--gw-hover);
}
.gw-bell {
  position: relative;
}
.gw-bell i {
  position: absolute;
  right: 8px;
  top: 6px;
  background: var(--gw-accent);
  width: 4px;
  height: 4px;
  border-radius: 50%;
}
.gw-avatar {
  width: 30px;
  height: 30px;
  border-radius: 50%;
  background: var(--gw-avatar);
  display: grid;
  place-items: center;
  font:
    600 12px Georgia,
    serif;
}
.gw-stage {
  display: flex;
  gap: 16px;
  align-items: flex-start;
}
.gw-rail {
  border-radius: 23px;
  width: 50px;
  padding: 8px 5px;
  display: flex;
  flex-direction: column;
  gap: 8px;
  margin-top: 50px;
  flex: none;
}
.gw-rail button {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  display: grid;
  place-items: center;
}
.gw-rail button span {
  display: none;
}
.gw-rail button[aria-current] {
  background: var(--gw-rail-active);
  box-shadow: 0 3px 8px var(--gw-soft-shadow);
}
.gw-main {
  border-radius: 27px;
  padding: 30px 30px 98px;
  flex: 1;
  min-width: 0;
}
.gw-view-heading {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 20px;
  margin-bottom: 28px;
}
.gw-greeting {
  font-size: 13px;
  color: var(--gw-muted);
  margin-bottom: 5px !important;
}
.gw-view-heading h1 {
  font-size: clamp(23px, 2.3vw, 31px);
  font-weight: 500;
  letter-spacing: -0.035em;
  line-height: 1.18;
}
.gw-date {
  display: flex;
  align-items: center;
  gap: 12px;
  font-size: 12px;
  color: var(--gw-muted);
  white-space: nowrap;
}
.gw-panel {
  background: color-mix(
    in srgb,
    var(--gw-panel) calc((0.16 + var(--gw-opacity) * 0.5) * 100%),
    transparent
  );
  border-radius: 17px;
  box-shadow:
    inset 0 1px 0
      color-mix(
        in srgb,
        var(--gw-highlight) calc(var(--gw-edge) * 75%),
        transparent
      ),
    0 8px 22px -20px var(--gw-panel-shadow);
  padding: 21px;
  min-width: 0;
  position: relative;
}
.gw-panel-title {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 20px;
  color: var(--gw-muted);
  font-size: 12px;
}
.gw-panel-title h2 {
  font-size: 14px;
  letter-spacing: -0.02em;
  font-weight: 600;
  color: var(--gw-ink);
}
.gw-panel-title > svg {
  opacity: 0.65;
}
.gw-overview-grid {
  display: grid;
  grid-template-columns: 0.82fr 1.5fr;
  gap: 16px;
  margin-bottom: 16px;
}
.gw-balance {
  display: flex;
  flex-direction: column;
}
.gw-balance-value {
  font-size: clamp(29px, 3.15vw, 43px);
  font-weight: 500;
  letter-spacing: -0.04em;
  line-height: 1.25;
  white-space: nowrap;
}
.gw-balance-meta {
  font-size: 11px;
  color: var(--gw-muted);
  margin-top: 10px !important;
}
.gw-positive {
  color: var(--gw-accent);
}
.gw-balance-meta .gw-positive {
  background: var(--gw-positive-surface);
  border-radius: 5px;
  padding: 3px 5px;
  margin-right: 5px;
}
.gw-account {
  margin-top: auto;
  padding-top: 35px;
  display: flex;
  align-items: center;
  gap: 10px;
}
.gw-account-icon {
  display: grid;
  place-items: center;
  width: 36px;
  height: 36px;
  border-radius: 10px;
  background: var(--gw-account-surface);
}
.gw-account > div {
  display: flex;
  flex-direction: column;
}
.gw-account strong {
  font-weight: 500;
  font-size: 12px;
}
.gw-account span {
  font-size: 11px;
  color: var(--gw-muted);
}
.gw-account > button {
  margin-left: auto;
  width: 36px;
  height: 36px;
  border-radius: 50%;
  background: var(--gw-account-action);
  display: grid;
  place-items: center;
}
.gw-segment {
  display: flex;
  gap: 3px;
  background: var(--gw-segment);
  border-radius: 8px;
  padding: 3px;
  font-size: 10px;
}
.gw-segment button {
  padding: 4px 8px;
  border-radius: 6px;
}
.gw-segment button[aria-pressed="true"] {
  background: var(--gw-segment-active);
  box-shadow: 0 2px 4px var(--gw-segment-shadow);
  color: var(--gw-ink);
}
.gw-chart-summary {
  display: flex;
  gap: 34px;
  margin-bottom: 18px;
}
.gw-chart-legend {
  display: flex;
  gap: 20px;
  margin: -4px 0 14px;
  font-size: 11px;
  color: var(--gw-muted);
}
.gw-chart-legend span {
  display: flex;
  gap: 6px;
  align-items: center;
}
.gw-chart-legend i {
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: var(--gw-accent);
}
.gw-chart-legend span + span i {
  background: var(--gw-muted);
}
.gw-chart-summary > div {
  display: flex;
  flex-direction: column;
  gap: 4px;
}
.gw-chart-summary span {
  font-size: 10px;
  color: var(--gw-muted);
  display: flex;
  align-items: center;
  gap: 5px;
}
.gw-chart-summary i {
  width: 5px;
  height: 5px;
  background: var(--gw-accent);
  border-radius: 50%;
}
.gw-chart-summary > div + div i {
  background: var(--gw-muted);
}
.gw-chart-summary strong {
  font-size: 21px;
  font-weight: 500;
  letter-spacing: -0.03em;
}
.gw-chart-wrap {
  position: relative;
  padding-left: 39px;
  padding-top: 2px;
}
.gw-chart-wrap svg {
  display: block;
  width: 100%;
  height: 126px;
  overflow: visible;
}
.gw-chart-labels {
  position: absolute;
  left: 0;
  top: 6px;
  bottom: 22px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  font-size: 8px;
  color: var(--gw-muted);
}
.gw-chart-months {
  position: relative;
  height: 24px;
  font-size: 9px;
  color: var(--gw-muted);
  padding-top: 10px;
}
.gw-lower-grid {
  display: grid;
  grid-template-columns: 1.3fr 1fr;
  gap: 16px;
}
.gw-text-button {
  display: flex;
  align-items: center;
  gap: 6px;
  font-size: 11px !important;
}
.gw-text-button:hover {
  color: var(--gw-accent);
}
.gw-transaction {
  display: flex;
  align-items: center;
  gap: 11px;
  padding: 11px 0;
  border-top: 1px solid var(--gw-line);
  min-width: 0;
}
.gw-transaction:first-child {
  border-top: 0;
  padding-top: 0;
}
.gw-transaction:last-child {
  padding-bottom: 0;
}
.gw-transaction-icon {
  width: 34px;
  height: 34px;
  border-radius: 10px;
  display: grid;
  place-items: center;
  background: var(--gw-transaction-surface);
  flex: none;
}
.gw-transaction-icon.is-income {
  background: var(--gw-income-surface);
  color: var(--gw-accent);
}
.gw-transaction-name {
  display: flex;
  flex-direction: column;
  min-width: 0;
  flex: 1;
}
.gw-transaction-name strong {
  font-size: 12px;
  font-weight: 500;
  overflow: hidden;
  white-space: nowrap;
  text-overflow: ellipsis;
}
.gw-transaction-name span {
  font-size: 10px;
  color: var(--gw-muted);
  margin-top: 2px;
}
.gw-transaction > strong {
  font-size: 12px;
  font-weight: 500;
  white-space: nowrap;
}
.gw-transaction-status {
  font-size: 9px;
  color: var(--gw-muted);
  display: flex;
  align-items: center;
  gap: 3px;
}
.gw-transaction-status.is-pending {
  color: var(--gw-pending);
}
.gw-small-label {
  font-size: 10px;
}
.gw-goal + .gw-goal {
  margin-top: 22px;
}
.gw-goal-top {
  display: flex;
  align-items: center;
  gap: 9px;
}
.gw-goal-top strong {
  font-size: 12px;
  font-weight: 500;
  flex: 1;
}
.gw-goal-top > span:last-child {
  font-size: 10px;
  color: var(--gw-muted);
}
.gw-goal-icon {
  width: 30px;
  height: 30px;
  border-radius: 9px;
  background: var(--gw-goal-surface);
  display: grid;
  place-items: center;
}
.gw-goal-track {
  height: 5px;
  background: var(--gw-line);
  margin: 11px 0 6px;
  border-radius: 5px;
  overflow: hidden;
}
.gw-goal-track i {
  height: 100%;
  display: block;
  background: var(--gw-accent);
  border-radius: 5px;
}
.gw-goal p {
  display: flex;
  justify-content: space-between;
  font-size: 10px;
  color: var(--gw-muted);
}
.gw-goal p strong {
  font-weight: 500;
  color: var(--gw-ink);
}
.gw-footer {
  display: flex;
  align-items: center;
  justify-content: space-between;
  color: var(--gw-muted);
  font-size: 9px;
  margin-top: 22px;
  gap: 16px;
}
.gw-footer > span:first-child {
  display: flex;
  align-items: center;
  gap: 6px;
}
.gw-footer i {
  height: 4px;
  width: 4px;
  background: var(--gw-accent);
  border-radius: 50%;
}
.gw-desktop-dock {
  position: absolute;
  bottom: 19px;
  left: 50%;
  transform: translateX(-50%);
}
.gw-dock {
  display: flex;
  align-items: center;
  gap: 3px;
  border-radius: 30px;
  padding: 5px;
  white-space: nowrap;
  background: var(--gw-dock);
  backdrop-filter: blur(20px);
}
.gw-dock button {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  border-radius: 24px;
  padding: 10px 17px;
  font-size: 11px;
  transition:
    background 0.22s,
    color 0.22s;
}
.gw-dock button svg {
  width: 15px;
}
.gw-dock button[aria-current] {
  background: var(--gw-dock-active);
  color: var(--gw-dock-ink);
  box-shadow: 0 3px 7px var(--gw-dock-shadow);
}
.gw-dock button:not([aria-current]):hover {
  background: var(--gw-dock-hover);
}
.gw-mobile-nav {
  display: none;
}
.gw-button {
  padding: 9px 13px;
  border-radius: 9px;
  display: flex;
  align-items: center;
  gap: 7px;
  background: var(--gw-button) !important;
  color: var(--gw-button-ink) !important;
  font-size: 11px !important;
  white-space: nowrap;
}
.gw-button:hover {
  filter: brightness(1.13);
}
.gw-search {
  display: flex;
  align-items: center;
  gap: 8px;
  background: var(--gw-search);
  border: 1px solid var(--gw-line);
  border-radius: 8px;
  padding: 7px 10px;
}
.gw-search input {
  width: 165px;
  background: none;
  border: 0;
  caret-color: var(--gw-accent);
  font-size: 11px;
}
.gw-search input::placeholder {
  color: var(--gw-muted);
}
.gw-search button {
  padding: 0;
  display: flex;
}
.gw-count {
  margin-left: 6px;
  font-size: 10px;
  color: var(--gw-muted);
}
.gw-empty {
  text-align: center;
  padding: 70px 15px;
  color: var(--gw-muted);
  font-size: 12px;
}
.gw-empty svg {
  margin-bottom: 12px;
}
.gw-empty h3 {
  font-size: 15px;
  color: var(--gw-ink);
  margin-bottom: 6px;
}
.gw-empty button {
  margin-top: 15px;
  text-decoration: underline;
}
.gw-savings-intro {
  display: flex;
  align-items: center;
  gap: 20px;
  padding: 20px 10px 35px;
}
.gw-savings-orb {
  width: 65px;
  height: 65px;
  display: grid;
  place-items: center;
  border-radius: 50%;
  background: var(--gw-savings-orb);
  box-shadow: inset 0 1px 0 var(--gw-strong-edge);
}
.gw-savings-intro p {
  font-size: 12px;
  color: var(--gw-muted);
}
.gw-savings-intro strong {
  font-size: 40px;
  letter-spacing: -0.04em;
  font-weight: 500;
}
.gw-savings-intro > span:last-child {
  margin-left: auto;
  font-size: 13px;
  color: var(--gw-muted);
}
.gw-view:has(.gw-savings-intro) .gw-goals {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 34px;
}
.gw-view:has(.gw-savings-intro) .gw-goal + .gw-goal {
  margin-top: 0;
}
.gw-savings-note {
  display: flex;
  align-items: center;
  gap: 12px;
  color: var(--gw-muted);
  font-size: 12px;
  padding: 24px 4px;
}
.gw-report-stats {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 16px;
  margin-bottom: 16px;
}
.gw-report-stats strong {
  font-size: 28px;
  font-weight: 500;
  letter-spacing: -0.035em;
  display: block;
}
.gw-report-stats section > span {
  font-size: 10px;
  color: var(--gw-muted);
}
.gw-report-stats .gw-panel-title {
  margin-bottom: 15px;
}
.gw-reports-grid {
  display: grid;
  grid-template-columns: 1.6fr 1fr;
  gap: 16px;
}
.gw-reports-grid .gw-chart-wrap svg {
  height: 185px;
}
.gw-chart-footnote {
  font-size: 9px;
  color: var(--gw-muted);
  margin-top: 15px !important;
}
.gw-category-list > div + div {
  margin-top: 19px;
}
.gw-category-list > div > div {
  display: flex;
  gap: 7px;
  align-items: center;
  font-size: 11px;
}
.gw-category-list strong {
  margin-left: auto;
  font-weight: 500;
}
.gw-category-list svg {
  width: 14px;
}
.gw-category-track {
  display: block;
  height: 4px;
  border-radius: 3px;
  background: var(--gw-line);
  margin-top: 9px;
}
.gw-category-track i {
  display: block;
  height: 100%;
  background: var(--gw-accent);
  border-radius: 3px;
}
.gw-material {
  position: absolute;
  z-index: 20;
  max-height: calc(100svh - 128px);
  overflow: auto;
  scrollbar-width: thin;
  scrollbar-color: var(--gw-scrollbar) transparent;
  right: 10px;
  top: 75px;
  width: 300px;
  border-radius: 22px;
  padding: 22px;
  background: var(--gw-popover);
  box-shadow:
    inset 0 1px 0 var(--gw-soft-edge),
    0 24px 80px var(--gw-popover-shadow);
}
.gw-material-title {
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.gw-material-title > div {
  display: flex;
  gap: 10px;
  align-items: center;
}
.gw-material h2 {
  font-size: 17px;
  font-weight: 500;
  letter-spacing: -0.03em;
}
.gw-material-icon {
  display: grid;
  place-items: center;
}
.gw-material > p {
  font-size: 11px;
  color: var(--gw-muted);
  margin: 7px 0 18px;
}
.gw-material-sample {
  height: 87px;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 12px;
  border-radius: 13px;
  margin-bottom: 17px;
  background: color-mix(
    in srgb,
    var(--gw-tint) calc(var(--gw-opacity) * 100%),
    transparent
  );
  backdrop-filter: blur(var(--gw-blur));
  box-shadow:
    inset 0 1px 0
      color-mix(
        in srgb,
        var(--gw-highlight) calc(var(--gw-edge) * 100%),
        transparent
      ),
    0 12px 20px -18px var(--gw-sample-shadow);
  font-size: 12px;
}
.gw-presets {
  display: flex;
  gap: 5px;
  margin-bottom: 20px;
}
.gw-presets button {
  flex: 1;
  border: 1px solid var(--gw-line);
  border-radius: 7px;
  padding: 6px 0;
  font-size: 11px;
}
.gw-presets button:hover {
  background: var(--gw-control-hover);
}
.gw-range {
  display: block;
  margin: 17px 0;
}
.gw-range > span {
  display: flex;
  justify-content: space-between;
  font-size: 11px;
}
.gw-range output {
  font-size: 10px;
  color: var(--gw-muted);
}
.gw-range input {
  width: 100%;
  accent-color: var(--gw-accent);
  height: 16px;
  margin: 8px 0 0;
  cursor: pointer;
}
.gw-tint {
  display: flex;
  justify-content: space-between;
  align-items: center;
  font-size: 11px;
  margin-top: 20px;
}
.gw-tint input {
  height: 28px;
  width: 42px;
  padding: 2px;
  background: none;
  border: 1px solid var(--gw-line);
  border-radius: 6px;
  cursor: pointer;
}
.gw-reset {
  width: 100%;
  border: 1px solid var(--gw-line) !important;
  border-radius: 8px;
  padding: 8px;
  margin-top: 22px;
  font-size: 11px !important;
}
.gw-reset:hover {
  background: var(--gw-control-hover);
}
.gw-notifications {
  position: absolute;
  right: 25px;
  top: 75px;
  z-index: 21;
  width: 280px;
  border-radius: 16px;
  padding: 22px;
  background: var(--gw-notification);
}
.gw-notifications > div {
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.gw-notifications h2 {
  font-size: 15px;
  font-weight: 500;
}
.gw-notifications p {
  margin-top: 8px;
  font-size: 12px;
  color: var(--gw-muted);
}
.gw-toast {
  position: fixed;
  left: 50%;
  bottom: 25px;
  transform: translateX(-50%);
  z-index: 30;
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 13px 20px;
  border-radius: 12px;
  background: var(--gw-toast);
  color: var(--gw-toast-ink);
  box-shadow: 0 10px 30px var(--gw-toast-shadow);
  font-size: 12px;
  white-space: nowrap;
}
.gw-sun {
  display: none;
}
[data-theme="dark"] .gw-sun {
  display: block;
}
[data-theme="dark"] .gw-moon {
  display: none;
}
.gw-chart-months > span {
  position: absolute;
  white-space: nowrap;
}
.gw-chart-empty {
  padding: 35px 15px;
  min-height: 160px;
}
@supports not (backdrop-filter: blur(1px)) {
  .gw-glass,
  .gw-panel {
    background: var(--gw-fallback);
  }
}
@media (min-width: 1550px) {
  .gw-root {
    padding-top: 65px;
  }
  .gw-main {
    padding-top: 36px;
  }
  .gw-chart-wrap svg {
    height: 150px;
  }
  .gw-panel {
    padding: 25px;
  }
  .gw-transaction {
    padding: 14px 0;
  }
}
@media (max-width: 1050px) {
  .gw-root {
    padding: 24px 18px;
  }
  .gw-main {
    padding: 25px 23px 92px;
  }
  .gw-rail {
    display: none;
  }
  .gw-balance-value {
    font-size: 32px;
  }
  .gw-transaction-status {
    display: none;
  }
  .gw-personal,
  .gw-brand-divider {
    display: none;
  }
  .gw-panel {
    padding: 18px;
  }
  .gw-chart-summary {
    gap: 20px;
  }
  .gw-chart-summary strong {
    font-size: 19px;
  }
}
@media (max-width: 700px) {
  .gw-root {
    padding: 12px 10px 24px;
  }
  .gw-topbar {
    height: 56px;
    padding: 0 12px;
    border-radius: 17px;
    margin-bottom: 12px;
  }
  .gw-toolbar {
    gap: 3px;
  }
  .gw-brand {
    gap: 7px;
  }
  .gw-brand strong {
    font-size: 12px;
  }
  .gw-brand-icon {
    width: 25px;
    height: 25px;
  }
  .gw-bell,
  .gw-avatar {
    display: none !important;
  }
  .gw-adjust {
    padding: 8px;
    font-size: 11px !important;
    gap: 5px;
  }
  .gw-main {
    border-radius: 20px;
    padding: 23px 15px;
  }
  .gw-view-heading {
    gap: 8px;
    align-items: flex-start;
    margin-bottom: 20px;
  }
  .gw-view-heading h1 {
    font-size: 25px;
    max-width: 290px;
    line-height: 1.12;
  }
  .gw-greeting {
    font-size: 11px;
  }
  .gw-heading-action .gw-date {
    display: none;
  }
  .gw-heading-action .gw-button {
    padding: 8px 10px;
    font-size: 10px !important;
  }
  .gw-mobile-nav {
    display: block;
    margin-bottom: 20px;
  }
  .gw-mobile-nav .gw-dock {
    width: 100%;
    padding: 4px;
    border-radius: 12px;
    justify-content: space-between;
    background: var(--gw-mobile-dock);
    box-shadow: none;
  }
  .gw-dock button {
    font-size: 10px;
    padding: 9px 10px;
    border-radius: 9px;
    gap: 5px;
  }
  .gw-dock button svg {
    width: 13px;
    height: 13px;
  }
  .gw-desktop-dock {
    display: none;
  }
  .gw-overview-grid,
  .gw-lower-grid,
  .gw-reports-grid {
    grid-template-columns: 1fr;
    gap: 12px;
  }
  .gw-overview-grid {
    margin-bottom: 12px;
  }
  .gw-balance {
    min-height: 221px;
  }
  .gw-balance-value {
    font-size: 39px;
  }
  .gw-balance-meta {
    font-size: 11px;
  }
  .gw-account {
    padding-top: 23px;
  }
  .gw-panel {
    border-radius: 15px;
    padding: 18px;
  }
  .gw-chart-wrap svg {
    height: 130px;
  }
  .gw-chart-summary strong {
    font-size: 22px;
  }
  .gw-chart-summary {
    gap: 35px;
  }
  .gw-panel-title {
    gap: 8px;
    margin-bottom: 18px;
  }
  .gw-footer {
    font-size: 8px;
    margin-top: 24px;
  }
  .gw-footer > span:last-child {
    display: none;
  }
  .gw-material {
    right: 4px;
    top: 65px;
    width: min(310px, calc(100% - 8px));
    padding: 20px;
    max-height: calc(100svh - 90px);
    overflow: auto;
    scrollbar-width: thin;
    scrollbar-color: var(--gw-scrollbar) transparent;
  }
  .gw-notifications {
    right: 4px;
    max-width: calc(100% - 8px);
  }
  .gw-transaction-name strong,
  .gw-transaction > strong {
    font-size: 11px;
  }
  .gw-search {
    padding: 7px;
    width: 100%;
  }
  .gw-search input {
    width: 100%;
    min-width: 0;
  }
  .gw-view:has(.gw-search) .gw-panel-title {
    flex-wrap: wrap;
  }
  .gw-report-stats {
    grid-template-columns: 1fr;
    gap: 12px;
    margin-bottom: 12px;
  }
  .gw-report-stats .gw-panel {
    display: grid;
    grid-template-columns: 1fr auto;
    align-items: center;
  }
  .gw-report-stats .gw-panel-title {
    margin: 0;
  }
  .gw-report-stats .gw-panel-title svg {
    display: none;
  }
  .gw-report-stats strong {
    font-size: 26px;
  }
  .gw-report-stats section > span {
    grid-column: 1/-1;
    margin-top: 8px;
  }
  .gw-savings-intro {
    gap: 12px;
    padding: 10px 2px 26px;
    flex-wrap: wrap;
  }
  .gw-savings-intro strong {
    font-size: 34px;
  }
  .gw-savings-intro > span:last-child {
    display: none;
  }
  .gw-savings-orb {
    width: 52px;
    height: 52px;
  }
  .gw-view:has(.gw-savings-intro) .gw-goals {
    grid-template-columns: 1fr;
    gap: 25px;
  }
  .gw-view:has(.gw-search) {
    min-height: 370px;
  }
  .gw-toast {
    max-width: calc(100% - 30px);
    font-size: 11px;
    white-space: normal;
  }
  .gw-chart-months {
    font-size: 8px;
  }
}
@media (max-height: 550px) {
  .gw-material {
    top: 70px;
    max-height: calc(100svh - 110px);
  }
}
@media (prefers-reduced-motion: reduce) {
  .gw-root * {
    scroll-behavior: auto !important;
    transition: none !important;
  }
}
`,mf={"--gw-ink":`light-dark(#242b27,#f4f4ed)`,"--gw-muted":`light-dark(#384238,#d0c9bf)`,"--gw-accent":`light-dark(#326b54,#91d5b0)`,"--gw-line":`light-dark(#283b3020,#e1eddf26)`,"--gw-background":`light-dark(#d6cebf,#282a25)`,"--gw-shade":`light-dark(#e9e7df18,#12100e7a)`,"--gw-surface":`light-dark(#fff,#262322)`,"--gw-panel":`light-dark(#fff,#2b2825)`,"--gw-brand":`light-dark(#294b39,#e2eee0)`,"--gw-brand-ink":`light-dark(#fff,#183725)`,"--gw-avatar":`light-dark(#f1e4d1,#616e58)`,"--gw-rail-active":`light-dark(#fff9,#d7e5d42c)`,"--gw-positive-surface":`light-dark(#dce9da,#294f3a)`,"--gw-account-surface":`light-dark(#d9dfcf75,#596e5355)`,"--gw-account-action":`light-dark(#fff7,#bac7b220)`,"--gw-segment":`light-dark(#293d3010,#e9f6e713)`,"--gw-segment-active":`light-dark(#ffffffe0,#dae8d836)`,"--gw-transaction-surface":`light-dark(#e7dccb77,#c2bfa021)`,"--gw-income-surface":`light-dark(#cadcc688,#91d5b024)`,"--gw-pending":`light-dark(#805b20,#e1c383)`,"--gw-goal-surface":`light-dark(#d6d9c566,#c6d3be22)`,"--gw-dock":`light-dark(#f4f2e655,#15261bcc)`,"--gw-dock-active":`light-dark(#fffffff0,#eef3e6)`,"--gw-button":`light-dark(#274b39,#d8ebd7)`,"--gw-button-ink":`light-dark(#fff,#193320)`,"--gw-search":`light-dark(#ffffff55,#14261d77)`,"--gw-savings-orb":`light-dark(#d6e1c888,#b7e1b52b)`,"--gw-popover":`light-dark(#f5f0e9e8,#15261ef0)`,"--gw-notification":`light-dark(#f6f1e8ef,#15261ef0)`,"--gw-fallback":`light-dark(#f1ede5,#1e2c22)`,"--gw-mobile-dock":`light-dark(#fff4,#15261b99)`,"--gw-shadow":`#17291b48`,"--gw-panel-shadow":`#14251c44`,"--gw-soft-shadow":`#20292012`,"--gw-segment-shadow":`#14251a10`,"--gw-dock-shadow":`#14251c12`,"--gw-popover-shadow":`#13201733`,"--gw-sample-shadow":`#13331d80`,"--gw-toast-shadow":`#0002`,"--gw-toast":`#243e2e`,"--gw-dock-ink":`#283e2e`,"--gw-selection":`#698c7270`,"--gw-scrollbar":`#8e9d88`,"--gw-hover":`#ffffff28`,"--gw-dock-hover":`#ffffff30`,"--gw-control-hover":`#ffffff36`,"--gw-strong-edge":`#fff9`,"--gw-soft-edge":`#fff8`,"--gw-toast-ink":`#fff`,"--gw-highlight":`#fff`},hf={useHostTheme:!0,blur:22,opacity:.3,saturation:1.2,edge:.6,tint:`#eadbc7`},gf=[{id:`1`,name:`Studio retainer`,category:`Income`,date:`Today`,amount:4800,status:`Completed`},{id:`2`,name:`Sunday Coffee`,category:`Dining`,date:`Today`,amount:-18.5,status:`Completed`},{id:`3`,name:`Aesop`,category:`Shopping`,date:`Yesterday`,amount:-86,status:`Completed`},{id:`4`,name:`Weekend in Sedona`,category:`Travel`,date:`Nov 03`,amount:-320,status:`Pending`},{id:`5`,name:`November rent`,category:`Home`,date:`Nov 01`,amount:-1850,status:`Completed`},{id:`6`,name:`Website project`,category:`Income`,date:`Nov 01`,amount:6250,status:`Completed`},{id:`7`,name:`Whole Foods Market`,category:`Shopping`,date:`Oct 31`,amount:-124.8,status:`Completed`}],_f=[{id:`reserve`,name:`Emergency fund`,saved:8400,target:12e3,color:`#69876c`},{id:`travel`,name:`Travel fund`,saved:2350,target:5e3,color:`#ab8b68`}],vf=[{id:`week`,label:`Week`,description:`Sample daily totals for the selected week.`,points:[{label:`Mon`,income:680,expenses:112},{label:`Tue`,income:940,expenses:188},{label:`Wed`,income:720,expenses:84},{label:`Thu`,income:1120,expenses:245},{label:`Fri`,income:760,expenses:98},{label:`Sat`,income:340,expenses:174},{label:`Sun`,income:240,expenses:65}]},{id:`month`,label:`Month`,description:`Sample totals across November. Each point represents its labeled interval.`,points:[{label:`Nov 01`,income:560,expenses:124},{label:`Nov 03`,income:660,expenses:168},{label:`Nov 06`,income:575,expenses:149},{label:`Nov 08`,income:840,expenses:174},{label:`Nov 11`,income:785,expenses:144},{label:`Nov 13`,income:995,expenses:223},{label:`Nov 16`,income:940,expenses:193},{label:`Nov 18`,income:1120,expenses:238},{label:`Nov 21`,income:1010,expenses:213},{label:`Nov 23`,income:1205,expenses:258},{label:`Nov 26`,income:1135,expenses:223},{label:`Nov 30`,income:1225,expenses:292.3}]},{id:`year`,label:`Year`,description:`Sample monthly totals for 2026.`,points:[{label:`Jan`,income:7300,expenses:4200},{label:`Feb`,income:8100,expenses:3850},{label:`Mar`,income:7600,expenses:4540},{label:`Apr`,income:9200,expenses:3900},{label:`May`,income:8500,expenses:4720},{label:`Jun`,income:10200,expenses:4350},{label:`Jul`,income:9800,expenses:5600},{label:`Aug`,income:11700,expenses:4800},{label:`Sep`,income:10800,expenses:6200},{label:`Oct`,income:12300,expenses:5400},{label:`Nov`,income:11050,expenses:2399.3},{label:`Dec`,income:13900,expenses:6100}]}];function yf(e={}){let t={...hf,...e};return(0,X.jsx)(pf,{brand:`Automate Flows`,userName:`Troy`,balance:28430.6,balanceChange:{percent:8.2,label:`compared with last month`},account:{name:`Everyday account`,lastFour:`4829`},periodLabel:`November 2026`,cashFlowPeriods:vf,initialPeriodId:`month`,footerNote:`All figures are sample data`,savingsNote:`Your progress is shown from the sample goals supplied to this demo.`,useHostTheme:t.useHostTheme,style:t.useHostTheme?void 0:mf,glass:t,transactions:gf,goals:t.useHostTheme?_f.map(({color:e,...t})=>t):_f,backgroundImage:`https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?auto=format&fit=crop&w=1920&q=80`})}wu.registerPlugin(Au);var bf={blur:22,opacity:.32,saturation:1.25,tint:`#ffffff`,edge:.6},xf=[{id:`overview`,label:`Ringkasan`,icon:Td},{id:`messages`,label:`Pesan Masuk`,icon:kd},{id:`content`,label:`Koleksi Konten`,icon:_d},{id:`analytics`,label:`Statistik Interaksi`,icon:Yd}],Sf=(e,t,n,r)=>Number.isFinite(e)?Math.min(n,Math.max(t,e)):r,Cf=e=>({blur:Sf(e.blur??bf.blur,0,40,bf.blur),opacity:Sf(e.opacity??bf.opacity,.08,.9,bf.opacity),saturation:Sf(e.saturation??bf.saturation,.5,2,bf.saturation),edge:Sf(e.edge??bf.edge,0,1,bf.edge),tint:/^#[0-9a-f]{6}$/i.test(e.tint??``)?e.tint:bf.tint});function wf({data:e}){let t=(0,L.useRef)(null),n=(0,L.useRef)(null),r=(0,L.useRef)(null),i=(0,L.useId)().replace(/:/g,``),[a,o]=(0,L.useState)(`overview`),[s,c]=(0,L.useState)(()=>{try{let e=localStorage.getItem(`admin_glass_settings`);if(e)return Cf(JSON.parse(e))}catch{}return bf}),[l,u]=(0,L.useState)(!1),[d,f]=(0,L.useState)(`dark`),[p,m]=(0,L.useState)(``),[h,g]=(0,L.useState)(``),_=e=>{let t=Cf({...s,...e});c(t);try{localStorage.setItem(`admin_glass_settings`,JSON.stringify(t))}catch{}},v=e=>{g(e)};(0,L.useEffect)(()=>{if(!h)return;let e=window.setTimeout(()=>g(``),3e3);return()=>window.clearTimeout(e)},[h]),Au(()=>{let e=wu.matchMedia();return e.add(`(prefers-reduced-motion: no-preference)`,()=>{let e=n.current?.querySelectorAll(`.ag-reveal`);e?.length&&wu.fromTo(e,{y:14,opacity:.35,filter:`blur(3px)`},{y:0,opacity:1,filter:`blur(0px)`,duration:.45,stagger:.04,ease:`power3.out`,clearProps:`transform,opacity,filter`})}),()=>e.revert()},{scope:t,dependencies:[a],revertOnUpdate:!0});let y=(0,L.useMemo)(()=>{if(!p)return e.recentMessages;let t=p.toLowerCase();return e.recentMessages.filter(e=>e.name.toLowerCase().includes(t)||e.email.toLowerCase().includes(t)||e.message.toLowerCase().includes(t))},[e.recentMessages,p]),b=(0,L.useMemo)(()=>{let t=e.chartData.labels||[],n=e.chartData.messages||[],r=e.chartData.content||[];return t.map((e,t)=>({label:e,messages:n[t]??0,content:r[t]??0}))},[e.chartData]),x=Math.max(1,...b.flatMap(e=>[e.messages,e.content])),S=e=>b.length<=1?300:e*600/(b.length-1),C=e=>170-e/x*140,w=b.map((e,t)=>`${S(t)},${C(e.messages)}`).join(` `),T=b.map((e,t)=>`${S(t)},${C(e.content)}`).join(` `);return(0,X.jsxs)(`div`,{ref:t,className:`ag-root`,"data-theme":d,style:{"--ag-blur":`${s.blur}px`,"--ag-opacity":s.opacity,"--ag-saturation":s.saturation,"--ag-edge":s.edge,"--ag-tint":s.tint},children:[(0,X.jsx)(`style`,{children:Tf}),(0,X.jsx)(`img`,{className:`ag-wallpaper`,src:`https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?auto=format&fit=crop&w=2160&q=80`,alt:`Glass Space`}),(0,X.jsx)(`div`,{className:`ag-ambient-shade`,"aria-hidden":`true`}),(0,X.jsxs)(`div`,{className:`ag-shell`,children:[(0,X.jsxs)(`header`,{className:`ag-topbar ag-glass`,children:[(0,X.jsxs)(`div`,{className:`ag-brand-wrap`,children:[(0,X.jsx)(`span`,{className:`ag-brand-badge`,children:(0,X.jsx)(Cd,{size:18,strokeWidth:2})}),(0,X.jsxs)(`div`,{className:`ag-brand-text`,children:[(0,X.jsx)(`strong`,{children:`HANAFI`}),(0,X.jsx)(`span`,{children:`Portal Administrator`})]})]}),(0,X.jsxs)(`nav`,{className:`ag-top-nav`,children:[(0,X.jsxs)(`a`,{href:e.routes.projects,className:`ag-nav-pill`,children:[(0,X.jsx)(_d,{size:14}),(0,X.jsx)(`span`,{children:`Portfolio`})]}),(0,X.jsxs)(`a`,{href:e.routes.certificates,className:`ag-nav-pill`,children:[(0,X.jsx)(Zu,{size:14}),(0,X.jsx)(`span`,{children:`Sertifikat`})]}),(0,X.jsxs)(`a`,{href:e.routes.articles,className:`ag-nav-pill`,children:[(0,X.jsx)(hd,{size:14}),(0,X.jsx)(`span`,{children:`Blog`})]}),(0,X.jsxs)(`a`,{href:e.routes.clients,className:`ag-nav-pill`,children:[(0,X.jsx)($d,{size:14}),(0,X.jsx)(`span`,{children:`Klien`})]}),(0,X.jsxs)(`a`,{href:e.routes.about,className:`ag-nav-pill`,children:[(0,X.jsx)(Zd,{size:14}),(0,X.jsx)(`span`,{children:`Tentang`})]}),(0,X.jsxs)(`a`,{href:e.routes.messages,className:`ag-nav-pill`,children:[(0,X.jsx)(kd,{size:14}),(0,X.jsx)(`span`,{children:`Inbox`}),e.messageCount>0&&(0,X.jsx)(`span`,{className:`ag-pill-badge`,children:e.messageCount})]})]}),(0,X.jsxs)(`div`,{className:`ag-toolbar`,children:[(0,X.jsxs)(`a`,{href:e.routes.website,target:`_blank`,rel:`noreferrer`,className:`ag-btn-ghost`,title:`Kunjungi Website Publik`,children:[(0,X.jsx)(pd,{size:15}),(0,X.jsx)(`span`,{className:`hidden sm:inline`,children:`Lihat Web`})]}),(0,X.jsxs)(`button`,{type:`button`,ref:r,className:`ag-btn-ghost`,onClick:()=>u(!l),title:`Sesuaikan efek kaca`,"aria-expanded":l,children:[(0,X.jsx)(zd,{size:16}),(0,X.jsx)(`span`,{className:`hidden sm:inline`,children:`Efek Kaca`})]}),(0,X.jsx)(`button`,{type:`button`,className:`ag-icon-btn`,onClick:()=>f(d===`dark`?`light`:`dark`),title:`Ganti Tema`,children:d===`dark`?(0,X.jsx)(Gd,{size:16}):(0,X.jsx)(jd,{size:16})}),(0,X.jsxs)(`form`,{method:`POST`,action:e.routes.logout,className:`m-0`,children:[(0,X.jsx)(`input`,{type:`hidden`,name:`_token`,value:e.csrfToken}),(0,X.jsxs)(`button`,{type:`submit`,className:`ag-logout-btn`,title:`Keluar dari Panel Admin`,children:[(0,X.jsx)(Dd,{size:15}),(0,X.jsx)(`span`,{className:`hidden md:inline`,children:`Keluar`})]})]}),(0,X.jsx)(`div`,{className:`ag-user-avatar`,title:e.adminName,children:e.adminName.slice(0,1).toUpperCase()})]})]}),(0,X.jsxs)(`div`,{className:`ag-stage`,children:[(0,X.jsx)(`nav`,{className:`ag-rail ag-glass`,children:xf.map(e=>{let t=e.icon;return(0,X.jsxs)(`button`,{type:`button`,className:`ag-rail-btn ${a===e.id?`is-active`:``}`,onClick:()=>o(e.id),title:e.label,children:[(0,X.jsx)(t,{size:19,strokeWidth:1.8}),(0,X.jsx)(`span`,{children:e.label})]},e.id)})}),(0,X.jsxs)(`main`,{className:`ag-main ag-glass`,children:[(0,X.jsxs)(`div`,{className:`ag-view-head`,children:[(0,X.jsxs)(`div`,{children:[(0,X.jsxs)(`p`,{className:`ag-greeting`,children:[`Selamat Datang kembali, `,(0,X.jsx)(`strong`,{children:e.adminName})]}),(0,X.jsxs)(`h1`,{children:[a===`overview`&&`Dashboard Administrator`,a===`messages`&&`Daftar Pesan Masuk`,a===`content`&&`Koleksi & Manajemen Konten`,a===`analytics`&&`Grafik & Statistik Interaksi`]})]}),(0,X.jsx)(`div`,{className:`ag-head-actions`,children:(0,X.jsxs)(`a`,{href:e.routes.projectsCreate,className:`ag-cta-btn`,children:[(0,X.jsx)(Fd,{size:15}),(0,X.jsx)(`span`,{children:`Tambah Portfolio`})]})})]}),(0,X.jsxs)(`div`,{ref:n,className:`ag-view-content`,children:[a===`overview`&&(0,X.jsxs)(X.Fragment,{children:[(0,X.jsxs)(`div`,{className:`ag-stats-grid`,children:[(0,X.jsxs)(`a`,{href:e.routes.projects,className:`ag-panel ag-stat-card ag-reveal group`,children:[(0,X.jsxs)(`div`,{className:`ag-stat-top`,children:[(0,X.jsx)(`span`,{children:`Total Portfolio`}),(0,X.jsx)(_d,{size:18,className:`text-blue-400`})]}),(0,X.jsx)(`strong`,{className:`ag-stat-value`,children:e.projectCount}),(0,X.jsxs)(`div`,{className:`ag-stat-link`,children:[`Kelola Portfolio `,(0,X.jsx)(qu,{size:13})]})]}),(0,X.jsxs)(`a`,{href:e.routes.certificates,className:`ag-panel ag-stat-card ag-reveal group`,children:[(0,X.jsxs)(`div`,{className:`ag-stat-top`,children:[(0,X.jsx)(`span`,{children:`Total Sertifikat`}),(0,X.jsx)(Zu,{size:18,className:`text-emerald-400`})]}),(0,X.jsx)(`strong`,{className:`ag-stat-value`,children:e.certificateCount}),(0,X.jsxs)(`div`,{className:`ag-stat-link`,children:[`Kelola Sertifikat `,(0,X.jsx)(qu,{size:13})]})]}),(0,X.jsxs)(`a`,{href:e.routes.messages,className:`ag-panel ag-stat-card ag-reveal group`,children:[(0,X.jsxs)(`div`,{className:`ag-stat-top`,children:[(0,X.jsx)(`span`,{children:`Pesan Masuk`}),(0,X.jsx)(kd,{size:18,className:`text-amber-400`})]}),(0,X.jsx)(`strong`,{className:`ag-stat-value`,children:e.messageCount}),(0,X.jsxs)(`div`,{className:`ag-stat-link`,children:[`Buka Inbox `,(0,X.jsx)(qu,{size:13})]})]}),(0,X.jsxs)(`a`,{href:e.routes.articles,className:`ag-panel ag-stat-card ag-reveal group`,children:[(0,X.jsxs)(`div`,{className:`ag-stat-top`,children:[(0,X.jsx)(`span`,{children:`Artikel Blog`}),(0,X.jsx)(hd,{size:18,className:`text-purple-400`})]}),(0,X.jsx)(`strong`,{className:`ag-stat-value`,children:e.articleCount}),(0,X.jsxs)(`div`,{className:`ag-stat-link`,children:[`Kelola Blog `,(0,X.jsx)(qu,{size:13})]})]}),(0,X.jsxs)(`a`,{href:e.routes.clients,className:`ag-panel ag-stat-card ag-reveal group`,children:[(0,X.jsxs)(`div`,{className:`ag-stat-top`,children:[(0,X.jsx)(`span`,{children:`Klien / Mitra`}),(0,X.jsx)($d,{size:18,className:`text-pink-400`})]}),(0,X.jsx)(`strong`,{className:`ag-stat-value`,children:e.clientCount}),(0,X.jsxs)(`div`,{className:`ag-stat-link`,children:[`Kelola Klien `,(0,X.jsx)(qu,{size:13})]})]})]}),(0,X.jsxs)(`section`,{className:`ag-panel ag-reveal ag-chart-panel`,children:[(0,X.jsxs)(`div`,{className:`ag-panel-header`,children:[(0,X.jsxs)(`div`,{children:[(0,X.jsx)(`h2`,{children:`Statistik Interaksi Website`}),(0,X.jsx)(`p`,{className:`ag-muted-desc`,children:`Pergerakan pesan masuk vs penambahan konten baru (14 hari terakhir)`})]}),(0,X.jsxs)(`div`,{className:`ag-chart-legend`,children:[(0,X.jsxs)(`span`,{className:`is-messages`,children:[(0,X.jsx)(`i`,{}),` Pesan Masuk`]}),(0,X.jsxs)(`span`,{className:`is-content`,children:[(0,X.jsx)(`i`,{}),` Konten Baru`]})]})]}),(0,X.jsxs)(`div`,{className:`ag-chart-svg-wrap`,children:[(0,X.jsxs)(`svg`,{viewBox:`0 0 600 180`,preserveAspectRatio:`none`,className:`ag-svg-chart`,children:[(0,X.jsx)(`defs`,{children:(0,X.jsxs)(`linearGradient`,{id:`${i}-msg-grad`,x1:`0`,y1:`0`,x2:`0`,y2:`1`,children:[(0,X.jsx)(`stop`,{offset:`0%`,stopColor:`#3b82f6`,stopOpacity:`0.32`}),(0,X.jsx)(`stop`,{offset:`100%`,stopColor:`#3b82f6`,stopOpacity:`0`})]})}),[30,90,150].map(e=>(0,X.jsx)(`line`,{x1:`0`,y1:e,x2:`600`,y2:e,stroke:`currentColor`,strokeOpacity:`0.08`,strokeDasharray:`4 4`},e)),(0,X.jsx)(`polyline`,{points:w,fill:`none`,stroke:`#3b82f6`,strokeWidth:`2.8`,strokeLinecap:`round`,strokeLinejoin:`round`}),(0,X.jsx)(`polyline`,{points:T,fill:`none`,stroke:`#a855f7`,strokeWidth:`2.2`,strokeLinecap:`round`,strokeLinejoin:`round`,strokeDasharray:`5 3`}),b.map((e,t)=>(0,X.jsxs)(`g`,{children:[(0,X.jsx)(`circle`,{cx:S(t),cy:C(e.messages),r:`3.5`,fill:`#3b82f6`}),(0,X.jsx)(`circle`,{cx:S(t),cy:C(e.content),r:`3`,fill:`#a855f7`})]},t))]}),(0,X.jsx)(`div`,{className:`ag-chart-dates`,children:b.map((e,t)=>(t%2==0||t===b.length-1)&&(0,X.jsx)(`span`,{style:{left:`${S(t)/600*100}%`},children:e.label},t))})]})]}),(0,X.jsxs)(`div`,{className:`ag-lower-grid`,children:[(0,X.jsxs)(`section`,{className:`ag-panel ag-reveal`,children:[(0,X.jsxs)(`div`,{className:`ag-panel-header`,children:[(0,X.jsx)(`h2`,{children:`Pesan Terbaru`}),(0,X.jsxs)(`a`,{href:e.routes.messages,className:`ag-link-all`,children:[`Lihat semua `,(0,X.jsx)(rd,{size:14})]})]}),(0,X.jsx)(`div`,{className:`ag-message-list`,children:e.recentMessages.length?e.recentMessages.slice(0,4).map(e=>(0,X.jsxs)(`div`,{className:`ag-msg-item`,children:[(0,X.jsx)(`div`,{className:`ag-msg-avatar`,children:(0,X.jsx)(kd,{size:16})}),(0,X.jsxs)(`div`,{className:`ag-msg-info`,children:[(0,X.jsxs)(`div`,{className:`ag-msg-top`,children:[(0,X.jsx)(`strong`,{children:e.name}),(0,X.jsx)(`span`,{children:e.time})]}),(0,X.jsx)(`span`,{className:`ag-msg-email`,children:e.email}),(0,X.jsx)(`p`,{className:`ag-msg-snippet`,children:e.message})]})]},e.id)):(0,X.jsxs)(`div`,{className:`ag-empty-box`,children:[(0,X.jsx)(xd,{size:28}),(0,X.jsx)(`p`,{children:`Belum ada pesan masuk.`})]})})]}),(0,X.jsxs)(`section`,{className:`ag-panel ag-reveal`,children:[(0,X.jsxs)(`div`,{className:`ag-panel-header`,children:[(0,X.jsx)(`h2`,{children:`Portfolio Terbaru`}),(0,X.jsxs)(`a`,{href:e.routes.projects,className:`ag-link-all`,children:[`Semua item `,(0,X.jsx)(rd,{size:14})]})]}),(0,X.jsx)(`div`,{className:`ag-project-previews`,children:e.recentProjects.length?e.recentProjects.slice(0,4).map(t=>(0,X.jsxs)(`div`,{className:`ag-proj-row`,children:[(0,X.jsx)(`img`,{src:t.cover_image,alt:t.title,className:`ag-proj-thumb`,onError:e=>{e.target.src=`https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?auto=format&fit=crop&w=120&q=70`}}),(0,X.jsxs)(`div`,{className:`ag-proj-meta`,children:[(0,X.jsx)(`strong`,{children:t.title}),(0,X.jsxs)(`span`,{children:[t.category,` · `,t.updated_at]})]}),(0,X.jsx)(`a`,{href:e.routes.projects,className:`ag-item-action`,title:`Lihat di manager`,children:(0,X.jsx)(Yu,{size:15})})]},t.id)):(0,X.jsxs)(`div`,{className:`ag-empty-box`,children:[(0,X.jsx)(_d,{size:28}),(0,X.jsx)(`p`,{children:`Belum ada portofolio dibuat.`})]})})]})]})]}),a===`messages`&&(0,X.jsxs)(`section`,{className:`ag-panel ag-reveal`,children:[(0,X.jsxs)(`div`,{className:`ag-panel-header`,children:[(0,X.jsxs)(`div`,{children:[(0,X.jsx)(`h2`,{children:`Kotak Masuk Kontak`}),(0,X.jsxs)(`p`,{className:`ag-muted-desc`,children:[`Total `,e.recentMessages.length,` pesan terbaru dari pengunjung situs`]})]}),(0,X.jsxs)(`div`,{className:`ag-search-bar`,children:[(0,X.jsx)(Ld,{size:15}),(0,X.jsx)(`input`,{type:`text`,placeholder:`Cari pengirim atau email...`,value:p,onChange:e=>m(e.target.value)}),p&&(0,X.jsx)(`button`,{type:`button`,onClick:()=>m(``),children:(0,X.jsx)(rf,{size:14})})]})]}),(0,X.jsx)(`div`,{className:`ag-full-messages-list`,children:y.length?y.map(t=>(0,X.jsxs)(`div`,{className:`ag-full-msg-card`,children:[(0,X.jsxs)(`div`,{className:`ag-card-head`,children:[(0,X.jsxs)(`div`,{children:[(0,X.jsx)(`h4`,{children:t.name}),(0,X.jsx)(`a`,{href:`mailto:${t.email}`,children:t.email})]}),(0,X.jsxs)(`div`,{className:`ag-card-time`,children:[(0,X.jsx)(ad,{size:13}),(0,X.jsx)(`span`,{children:t.date||t.time})]})]}),(0,X.jsx)(`p`,{className:`ag-card-body`,children:t.message}),(0,X.jsxs)(`div`,{className:`ag-card-footer`,children:[(0,X.jsx)(`a`,{href:`mailto:${t.email}?subject=Balasan Portofolio`,className:`ag-reply-btn`,children:`Balas Email`}),(0,X.jsx)(`a`,{href:e.routes.messages,className:`ag-btn-subtle`,children:`Buka di Inbox Panel →`})]})]},t.id)):(0,X.jsxs)(`div`,{className:`ag-empty-box`,children:[(0,X.jsx)(xd,{size:32}),(0,X.jsx)(`p`,{children:`Tidak ditemukan pesan yang cocok.`})]})})]}),a===`content`&&(0,X.jsxs)(`div`,{className:`ag-content-grid ag-reveal`,children:[(0,X.jsxs)(`section`,{className:`ag-panel`,children:[(0,X.jsxs)(`div`,{className:`ag-panel-header`,children:[(0,X.jsxs)(`div`,{children:[(0,X.jsx)(`h2`,{children:`Portfolio Terkini`}),(0,X.jsxs)(`span`,{className:`ag-badge-count`,children:[e.projectCount,` Proyek`]})]}),(0,X.jsxs)(`a`,{href:e.routes.projectsCreate,className:`ag-mini-btn`,children:[(0,X.jsx)(Fd,{size:14}),` Tambah`]})]}),(0,X.jsx)(`div`,{className:`ag-card-column`,children:e.recentProjects.map(e=>(0,X.jsxs)(`div`,{className:`ag-item-card`,children:[(0,X.jsx)(`img`,{src:e.cover_image,alt:e.title,className:`ag-card-img`,onError:e=>{e.target.src=`https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?auto=format&fit=crop&w=200&q=70`}}),(0,X.jsxs)(`div`,{className:`ag-card-detail`,children:[(0,X.jsx)(`span`,{className:`ag-tag`,children:e.category}),(0,X.jsx)(`strong`,{children:e.title}),(0,X.jsx)(`small`,{children:e.updated_at})]})]},e.id))})]}),(0,X.jsxs)(`section`,{className:`ag-panel`,children:[(0,X.jsxs)(`div`,{className:`ag-panel-header`,children:[(0,X.jsxs)(`div`,{children:[(0,X.jsx)(`h2`,{children:`Sertifikat Terkini`}),(0,X.jsxs)(`span`,{className:`ag-badge-count`,children:[e.certificateCount,` Dokumen`]})]}),(0,X.jsxs)(`a`,{href:e.routes.certificatesCreate,className:`ag-mini-btn`,children:[(0,X.jsx)(Fd,{size:14}),` Tambah`]})]}),(0,X.jsx)(`div`,{className:`ag-card-column`,children:e.recentCertificates.map(e=>(0,X.jsxs)(`div`,{className:`ag-item-card`,children:[(0,X.jsx)(`div`,{className:`ag-cert-badge`,children:(0,X.jsx)(Zu,{size:20,className:`text-emerald-400`})}),(0,X.jsxs)(`div`,{className:`ag-card-detail`,children:[(0,X.jsx)(`span`,{className:`ag-tag`,children:e.issuer}),(0,X.jsx)(`strong`,{children:e.name}),(0,X.jsx)(`small`,{children:e.updated_at})]})]},e.id))})]})]}),a===`analytics`&&(0,X.jsxs)(`section`,{className:`ag-panel ag-reveal`,children:[(0,X.jsx)(`div`,{className:`ag-panel-header`,children:(0,X.jsxs)(`div`,{children:[(0,X.jsx)(`h2`,{children:`Detail Analisis Kunjungan & Interaksi`}),(0,X.jsx)(`p`,{className:`ag-muted-desc`,children:`Rekapitulasi trafik formulir kontak dan update portofolio`})]})}),(0,X.jsxs)(`div`,{className:`ag-analytics-metrics`,children:[(0,X.jsxs)(`div`,{className:`ag-metric-box`,children:[(0,X.jsx)(`span`,{children:`Total Portofolio`}),(0,X.jsx)(`strong`,{children:e.projectCount})]}),(0,X.jsxs)(`div`,{className:`ag-metric-box`,children:[(0,X.jsx)(`span`,{children:`Total Sertifikat`}),(0,X.jsx)(`strong`,{children:e.certificateCount})]}),(0,X.jsxs)(`div`,{className:`ag-metric-box`,children:[(0,X.jsx)(`span`,{children:`Artikel Diterbitkan`}),(0,X.jsx)(`strong`,{children:e.articleCount})]}),(0,X.jsxs)(`div`,{className:`ag-metric-box`,children:[(0,X.jsx)(`span`,{children:`Pesan Diterima`}),(0,X.jsx)(`strong`,{children:e.messageCount})]})]}),(0,X.jsxs)(`div`,{className:`mt-8`,children:[(0,X.jsx)(`h3`,{className:`text-sm font-semibold mb-3`,children:`Tabel Log Harian (14 Hari)`}),(0,X.jsx)(`div`,{className:`ag-table-wrap`,children:(0,X.jsxs)(`table`,{className:`ag-table`,children:[(0,X.jsx)(`thead`,{children:(0,X.jsxs)(`tr`,{children:[(0,X.jsx)(`th`,{children:`Tanggal`}),(0,X.jsx)(`th`,{children:`Pesan Masuk`}),(0,X.jsx)(`th`,{children:`Konten Baru`}),(0,X.jsx)(`th`,{children:`Status Aktivitas`})]})}),(0,X.jsx)(`tbody`,{children:b.map((e,t)=>(0,X.jsxs)(`tr`,{children:[(0,X.jsx)(`td`,{children:e.label}),(0,X.jsx)(`td`,{children:(0,X.jsxs)(`span`,{className:`ag-val-blue`,children:[e.messages,` Pesan`]})}),(0,X.jsx)(`td`,{children:(0,X.jsxs)(`span`,{className:`ag-val-purple`,children:[e.content,` Item`]})}),(0,X.jsx)(`td`,{children:e.messages+e.content>0?(0,X.jsx)(`span`,{className:`ag-pill-active`,children:`Ada Aktivitas`}):(0,X.jsx)(`span`,{className:`ag-pill-idle`,children:`Sunyi`})})]},t))})]})})]})]})]},a)]})]}),l&&(0,X.jsxs)(`aside`,{className:`ag-drawer ag-glass`,children:[(0,X.jsxs)(`div`,{className:`ag-drawer-header`,children:[(0,X.jsxs)(`div`,{className:`flex items-center gap-2`,children:[(0,X.jsx)(zd,{size:18}),(0,X.jsx)(`h3`,{children:`Pengaturan Material Kaca`})]}),(0,X.jsx)(`button`,{type:`button`,className:`ag-icon-btn`,onClick:()=>u(!1),children:(0,X.jsx)(rf,{size:17})})]}),(0,X.jsx)(`p`,{className:`ag-drawer-desc`,children:`Kustomisasi transparansi, blur, dan saturasi efek kaca secara live.`}),(0,X.jsx)(`div`,{className:`ag-presets-bar`,children:[{name:`Clear`,val:{blur:8,opacity:.16,saturation:1.1,edge:.8}},{name:`Frosted`,val:bf},{name:`Solid`,val:{blur:30,opacity:.85,saturation:1,edge:.4}}].map(e=>(0,X.jsx)(`button`,{type:`button`,onClick:()=>{_(e.val),v(`Preset ${e.name} diterapkan.`)},children:e.name},e.name))}),[{key:`blur`,label:`Blur Radius`,min:0,max:40,step:1,val:`${Math.round(s.blur)}px`},{key:`opacity`,label:`Opasitas Panel`,min:.08,max:.9,step:.02,val:`${Math.round(s.opacity*100)}%`},{key:`saturation`,label:`Saturasi Warna`,min:.5,max:2,step:.05,val:`${Math.round(s.saturation*100)}%`},{key:`edge`,label:`Sorotan Tepi (Edge Light)`,min:0,max:1,step:.05,val:`${Math.round(s.edge*100)}%`}].map(e=>(0,X.jsxs)(`label`,{className:`ag-slider-row`,children:[(0,X.jsxs)(`div`,{className:`flex justify-between text-xs`,children:[(0,X.jsx)(`span`,{children:e.label}),(0,X.jsx)(`strong`,{children:e.val})]}),(0,X.jsx)(`input`,{type:`range`,min:e.min,max:e.max,step:e.step,value:s[e.key],onChange:t=>_({[e.key]:Number(t.target.value)})})]},e.key)),(0,X.jsxs)(`label`,{className:`ag-color-row`,children:[(0,X.jsx)(`span`,{children:`Warna Tint Kaca`}),(0,X.jsx)(`input`,{type:`color`,value:s.tint,onChange:e=>_({tint:e.target.value})})]}),(0,X.jsx)(`button`,{type:`button`,className:`ag-reset-btn`,onClick:()=>{_(bf),v(`Pengaturan kaca direset ke bawaan.`)},children:`Reset ke Bawaan`})]})]}),h&&(0,X.jsxs)(`div`,{className:`ag-toast`,children:[(0,X.jsx)(Ud,{size:16}),(0,X.jsx)(`span`,{children:h})]})]})}var Tf=`
.ag-root {
  position: relative;
  min-height: 100svh;
  overflow-x: hidden;
  background: #09090b;
  color: #f4f4f5;
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Inter", sans-serif;
  letter-spacing: -0.015em;
  padding: 24px 28px;
  box-sizing: border-box;
  isolation: isolate;
}
.ag-root[data-theme="light"] {
  background: #f4f4f5;
  color: #18181b;
}

.ag-wallpaper {
  position: fixed;
  inset: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: center 40%;
  z-index: -3;
  opacity: 0.85;
}
.ag-ambient-shade {
  position: fixed;
  inset: 0;
  background: radial-gradient(circle at 50% 0%, rgba(59, 130, 246, 0.12), transparent 75%),
              rgba(10, 10, 15, 0.65);
  z-index: -2;
  pointer-events: none;
}
[data-theme="light"] .ag-ambient-shade {
  background: rgba(245, 245, 247, 0.72);
}

.ag-shell {
  max-width: 1360px;
  margin: 0 auto;
}

/* Glass Surface Styles */
.ag-glass {
  background: color-mix(in srgb, rgba(20, 20, 26, 0.85) calc(var(--ag-opacity) * 100%), transparent);
  backdrop-filter: blur(var(--ag-blur)) saturate(var(--ag-saturation));
  -webkit-backdrop-filter: blur(var(--ag-blur)) saturate(var(--ag-saturation));
  border: 1px solid color-mix(in srgb, rgba(255, 255, 255, 0.4) calc(var(--ag-edge) * 100%), transparent);
  box-shadow: 0 20px 50px -15px rgba(0, 0, 0, 0.5), inset 0 1px 0 rgba(255, 255, 255, 0.15);
  position: relative;
}
[data-theme="light"] .ag-glass {
  background: color-mix(in srgb, rgba(255, 255, 255, 0.88) calc(var(--ag-opacity) * 100%), transparent);
  border-color: color-mix(in srgb, rgba(0, 0, 0, 0.15) calc(var(--ag-edge) * 100%), transparent);
  box-shadow: 0 16px 40px -10px rgba(0, 0, 0, 0.08), inset 0 1px 0 rgba(255, 255, 255, 0.8);
}
.ag-glass:before {
  content: "";
  position: absolute;
  inset: 0;
  background: var(--ag-tint);
  opacity: 0.08;
  pointer-events: none;
  border-radius: inherit;
}

/* Topbar */
.ag-topbar {
  border-radius: 20px;
  height: 64px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0 22px;
  margin-bottom: 20px;
  gap: 16px;
}
.ag-brand-wrap {
  display: flex;
  align-items: center;
  gap: 12px;
}
.ag-brand-badge {
  width: 34px;
  height: 34px;
  background: linear-gradient(135deg, #3b82f6, #1d4ed8);
  color: #fff;
  border-radius: 10px;
  display: grid;
  place-items: center;
  box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
}
.ag-brand-text {
  display: flex;
  flex-direction: column;
}
.ag-brand-text strong {
  font-size: 14px;
  letter-spacing: -0.02em;
}
.ag-brand-text span {
  font-size: 11px;
  opacity: 0.65;
}

.ag-top-nav {
  display: flex;
  align-items: center;
  gap: 6px;
}
@media (max-width: 900px) {
  .ag-top-nav {
    display: none;
  }
}
.ag-nav-pill {
  display: flex;
  align-items: center;
  gap: 7px;
  padding: 7px 12px;
  border-radius: 9px;
  font-size: 12px;
  font-weight: 500;
  color: inherit;
  text-decoration: none;
  transition: all 0.2s;
}
.ag-nav-pill:hover {
  background: rgba(255, 255, 255, 0.08);
}
[data-theme="light"] .ag-nav-pill:hover {
  background: rgba(0, 0, 0, 0.05);
}
.ag-pill-badge {
  background: #3b82f6;
  color: #fff;
  padding: 1px 6px;
  border-radius: 999px;
  font-size: 10px;
  font-weight: 700;
}

.ag-toolbar {
  display: flex;
  align-items: center;
  gap: 10px;
}
.ag-btn-ghost {
  display: flex;
  align-items: center;
  gap: 7px;
  padding: 7px 12px;
  border-radius: 9px;
  border: 1px solid rgba(255, 255, 255, 0.12);
  background: rgba(255, 255, 255, 0.04);
  color: inherit;
  font-size: 12px;
  font-weight: 500;
  text-decoration: none;
  cursor: pointer;
}
.ag-btn-ghost:hover {
  background: rgba(255, 255, 255, 0.1);
}
.ag-icon-btn {
  width: 34px;
  height: 34px;
  border-radius: 50%;
  border: 0;
  background: rgba(255, 255, 255, 0.06);
  color: inherit;
  display: grid;
  place-items: center;
  cursor: pointer;
}
.ag-icon-btn:hover {
  background: rgba(255, 255, 255, 0.12);
}
.ag-logout-btn {
  display: flex;
  align-items: center;
  gap: 6px;
  padding: 7px 12px;
  border-radius: 9px;
  border: 0;
  background: rgba(239, 68, 68, 0.15);
  color: #f87171;
  font-size: 12px;
  font-weight: 600;
  cursor: pointer;
}
.ag-logout-btn:hover {
  background: rgba(239, 68, 68, 0.25);
}
.ag-user-avatar {
  width: 32px;
  height: 32px;
  border-radius: 50%;
  background: linear-gradient(135deg, #4f46e5, #7c3aed);
  color: #fff;
  display: grid;
  place-items: center;
  font-size: 13px;
  font-weight: 700;
}

/* Stage Layout */
.ag-stage {
  display: flex;
  gap: 16px;
}
.ag-rail {
  width: 60px;
  border-radius: 22px;
  padding: 12px 6px;
  display: flex;
  flex-direction: column;
  gap: 12px;
  height: fit-content;
}
@media (max-width: 768px) {
  .ag-rail {
    display: none;
  }
}
.ag-rail-btn {
  width: 48px;
  height: 48px;
  border-radius: 14px;
  border: 0;
  background: none;
  color: inherit;
  opacity: 0.6;
  display: grid;
  place-items: center;
  cursor: pointer;
  transition: all 0.2s;
}
.ag-rail-btn span {
  display: none;
}
.ag-rail-btn:hover {
  opacity: 1;
  background: rgba(255, 255, 255, 0.08);
}
.ag-rail-btn.is-active {
  opacity: 1;
  background: #3b82f6;
  color: #fff;
  box-shadow: 0 4px 14px rgba(59, 130, 246, 0.45);
}

.ag-main {
  flex: 1;
  min-width: 0;
  border-radius: 24px;
  padding: 28px 32px 40px;
}

/* View Head */
.ag-view-head {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 26px;
}
.ag-greeting {
  font-size: 13px;
  opacity: 0.65;
  margin-bottom: 4px;
}
.ag-view-head h1 {
  font-size: 26px;
  font-weight: 600;
  margin: 0;
  letter-spacing: -0.03em;
}
.ag-cta-btn {
  display: flex;
  align-items: center;
  gap: 7px;
  background: #3b82f6;
  color: #fff;
  padding: 9px 16px;
  border-radius: 11px;
  font-size: 12px;
  font-weight: 600;
  text-decoration: none;
  box-shadow: 0 4px 12px rgba(59, 130, 246, 0.35);
}
.ag-cta-btn:hover {
  background: #2563eb;
}

/* Panels */
.ag-panel {
  background: rgba(255, 255, 255, 0.04);
  border-radius: 18px;
  border: 1px solid rgba(255, 255, 255, 0.08);
  padding: 20px 22px;
}
[data-theme="light"] .ag-panel {
  background: rgba(0, 0, 0, 0.02);
  border-color: rgba(0, 0, 0, 0.06);
}
.ag-panel-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 18px;
}
.ag-panel-header h2 {
  font-size: 15px;
  font-weight: 600;
  margin: 0;
}
.ag-muted-desc {
  font-size: 11px;
  opacity: 0.6;
  margin-top: 3px;
}

/* 5 Stats Grid */
.ag-stats-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
  gap: 14px;
  margin-bottom: 18px;
}
.ag-stat-card {
  display: flex;
  flex-direction: column;
  text-decoration: none;
  color: inherit;
  transition: transform 0.2s, border-color 0.2s;
}
.ag-stat-card:hover {
  transform: translateY(-2px);
  border-color: rgba(59, 130, 246, 0.4);
}
.ag-stat-top {
  display: flex;
  justify-content: space-between;
  align-items: center;
  font-size: 12px;
  opacity: 0.7;
}
.ag-stat-value {
  font-size: 32px;
  font-weight: 600;
  margin: 8px 0 10px;
  letter-spacing: -0.04em;
}
.ag-stat-link {
  font-size: 11px;
  color: #3b82f6;
  display: flex;
  align-items: center;
  gap: 4px;
  margin-top: auto;
}

/* Chart Panel */
.ag-chart-panel {
  margin-bottom: 18px;
}
.ag-chart-legend {
  display: flex;
  align-items: center;
  gap: 16px;
  font-size: 11px;
}
.ag-chart-legend span {
  display: flex;
  align-items: center;
  gap: 6px;
}
.ag-chart-legend i {
  width: 8px;
  height: 8px;
  border-radius: 50%;
}
.ag-chart-legend .is-messages i {
  background: #3b82f6;
}
.ag-chart-legend .is-content i {
  background: #a855f7;
}

.ag-chart-svg-wrap {
  position: relative;
  height: 180px;
  width: 100%;
}
.ag-svg-chart {
  width: 100%;
  height: 150px;
  overflow: visible;
}
.ag-chart-dates {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  height: 20px;
  font-size: 10px;
  opacity: 0.55;
}
.ag-chart-dates span {
  position: absolute;
  transform: translateX(-50%);
  white-space: nowrap;
}

/* Lower Split Grid */
.ag-lower-grid {
  display: grid;
  grid-template-columns: 1.2fr 1fr;
  gap: 16px;
}
@media (max-width: 960px) {
  .ag-lower-grid {
    grid-template-columns: 1fr;
  }
}
.ag-link-all {
  font-size: 11px;
  color: #3b82f6;
  text-decoration: none;
  display: flex;
  align-items: center;
  gap: 3px;
}
.ag-message-list {
  display: flex;
  flex-direction: column;
  gap: 12px;
}
.ag-msg-item {
  display: flex;
  gap: 12px;
  padding: 10px;
  border-radius: 12px;
  background: rgba(255, 255, 255, 0.02);
  border: 1px solid rgba(255, 255, 255, 0.05);
}
.ag-msg-avatar {
  width: 34px;
  height: 34px;
  border-radius: 10px;
  background: rgba(59, 130, 246, 0.15);
  color: #60a5fa;
  display: grid;
  place-items: center;
  flex-shrink: 0;
}
.ag-msg-info {
  flex: 1;
  min-width: 0;
}
.ag-msg-top {
  display: flex;
  justify-content: space-between;
  align-items: baseline;
}
.ag-msg-top strong {
  font-size: 13px;
}
.ag-msg-top span {
  font-size: 10px;
  opacity: 0.5;
}
.ag-msg-email {
  font-size: 11px;
  color: #3b82f6;
  display: block;
}
.ag-msg-snippet {
  font-size: 11px;
  opacity: 0.7;
  margin: 4px 0 0;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

/* Project Previews */
.ag-project-previews {
  display: flex;
  flex-direction: column;
  gap: 10px;
}
.ag-proj-row {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 8px;
  border-radius: 10px;
  background: rgba(255, 255, 255, 0.02);
  border: 1px solid rgba(255, 255, 255, 0.04);
}
.ag-proj-thumb {
  width: 44px;
  height: 32px;
  object-fit: cover;
  border-radius: 6px;
  flex-shrink: 0;
}
.ag-proj-meta {
  flex: 1;
  min-width: 0;
}
.ag-proj-meta strong {
  font-size: 12px;
  display: block;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}
.ag-proj-meta span {
  font-size: 10px;
  opacity: 0.6;
}
.ag-item-action {
  width: 30px;
  height: 30px;
  border-radius: 50%;
  display: grid;
  place-items: center;
  color: inherit;
  opacity: 0.6;
  text-decoration: none;
}
.ag-item-action:hover {
  opacity: 1;
  background: rgba(255, 255, 255, 0.1);
}

/* Search bar */
.ag-search-bar {
  display: flex;
  align-items: center;
  gap: 8px;
  background: rgba(255, 255, 255, 0.05);
  border: 1px solid rgba(255, 255, 255, 0.1);
  padding: 6px 12px;
  border-radius: 10px;
}
.ag-search-bar input {
  background: none;
  border: 0;
  outline: none;
  font-size: 12px;
  color: inherit;
  width: 200px;
}

/* Full messages cards */
.ag-full-messages-list {
  display: flex;
  flex-direction: column;
  gap: 14px;
}
.ag-full-msg-card {
  padding: 16px 18px;
  border-radius: 14px;
  background: rgba(255, 255, 255, 0.03);
  border: 1px solid rgba(255, 255, 255, 0.06);
}
.ag-card-head {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  margin-bottom: 10px;
}
.ag-card-head h4 {
  font-size: 14px;
  font-weight: 600;
  margin: 0;
}
.ag-card-head a {
  font-size: 12px;
  color: #3b82f6;
  text-decoration: none;
}
.ag-card-time {
  display: flex;
  align-items: center;
  gap: 5px;
  font-size: 11px;
  opacity: 0.6;
}
.ag-card-body {
  font-size: 13px;
  line-height: 1.6;
  opacity: 0.85;
  margin: 0 0 14px;
}
.ag-card-footer {
  display: flex;
  align-items: center;
  gap: 12px;
}
.ag-reply-btn {
  background: #3b82f6;
  color: #fff;
  font-size: 11px;
  font-weight: 600;
  padding: 6px 14px;
  border-radius: 8px;
  text-decoration: none;
}
.ag-btn-subtle {
  font-size: 11px;
  color: inherit;
  opacity: 0.7;
  text-decoration: none;
}
.ag-btn-subtle:hover {
  opacity: 1;
  text-decoration: underline;
}

/* Content Tab */
.ag-content-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 16px;
}
@media (max-width: 800px) {
  .ag-content-grid {
    grid-template-columns: 1fr;
  }
}
.ag-badge-count {
  font-size: 11px;
  opacity: 0.6;
}
.ag-mini-btn {
  display: flex;
  align-items: center;
  gap: 4px;
  padding: 5px 10px;
  border-radius: 8px;
  background: #3b82f6;
  color: #fff;
  font-size: 11px;
  font-weight: 600;
  text-decoration: none;
}
.ag-card-column {
  display: flex;
  flex-direction: column;
  gap: 10px;
}
.ag-item-card {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 10px;
  border-radius: 12px;
  background: rgba(255, 255, 255, 0.02);
  border: 1px solid rgba(255, 255, 255, 0.05);
}
.ag-card-img {
  width: 50px;
  height: 38px;
  border-radius: 6px;
  object-fit: cover;
}
.ag-cert-badge {
  width: 44px;
  height: 44px;
  border-radius: 10px;
  background: rgba(16, 185, 129, 0.15);
  display: grid;
  place-items: center;
}
.ag-card-detail {
  display: flex;
  flex-direction: column;
}
.ag-tag {
  font-size: 9px;
  font-weight: 700;
  text-transform: uppercase;
  color: #3b82f6;
}
.ag-card-detail strong {
  font-size: 13px;
  margin: 1px 0;
}
.ag-card-detail small {
  font-size: 10px;
  opacity: 0.55;
}

/* Analytics Tab */
.ag-analytics-metrics {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
  gap: 14px;
}
.ag-metric-box {
  padding: 16px;
  border-radius: 14px;
  background: rgba(255, 255, 255, 0.03);
  border: 1px solid rgba(255, 255, 255, 0.06);
}
.ag-metric-box span {
  font-size: 12px;
  opacity: 0.65;
}
.ag-metric-box strong {
  display: block;
  font-size: 26px;
  margin-top: 6px;
}
.ag-table-wrap {
  overflow-x: auto;
}
.ag-table {
  width: 100%;
  border-collapse: collapse;
  font-size: 12px;
}
.ag-table th, .ag-table td {
  padding: 10px 14px;
  text-align: left;
  border-bottom: 1px solid rgba(255, 255, 255, 0.06);
}
.ag-table th {
  opacity: 0.5;
  font-weight: 500;
}
.ag-val-blue {
  color: #60a5fa;
  font-weight: 600;
}
.ag-val-purple {
  color: #c084fc;
  font-weight: 600;
}
.ag-pill-active {
  background: rgba(16, 185, 129, 0.15);
  color: #34d399;
  padding: 2px 8px;
  border-radius: 999px;
  font-size: 10px;
  font-weight: 600;
}
.ag-pill-idle {
  opacity: 0.45;
  font-size: 11px;
}

/* Drawer / Glass Settings */
.ag-drawer {
  position: fixed;
  top: 96px;
  right: 28px;
  width: 310px;
  border-radius: 20px;
  padding: 22px;
  z-index: 50;
  box-shadow: 0 25px 60px rgba(0, 0, 0, 0.6);
}
.ag-drawer-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.ag-drawer-header h3 {
  font-size: 14px;
  font-weight: 600;
  margin: 0;
}
.ag-drawer-desc {
  font-size: 11px;
  opacity: 0.65;
  margin: 6px 0 16px;
}
.ag-presets-bar {
  display: flex;
  gap: 6px;
  margin-bottom: 16px;
}
.ag-presets-bar button {
  flex: 1;
  padding: 6px;
  border-radius: 8px;
  border: 1px solid rgba(255, 255, 255, 0.1);
  background: rgba(255, 255, 255, 0.05);
  color: inherit;
  font-size: 11px;
  cursor: pointer;
}
.ag-presets-bar button:hover {
  background: rgba(255, 255, 255, 0.12);
}
.ag-slider-row {
  display: block;
  margin-bottom: 14px;
}
.ag-slider-row input {
  width: 100%;
  margin-top: 6px;
  accent-color: #3b82f6;
  cursor: pointer;
}
.ag-color-row {
  display: flex;
  justify-content: space-between;
  align-items: center;
  font-size: 12px;
  margin: 16px 0;
}
.ag-color-row input {
  width: 36px;
  height: 26px;
  border: 0;
  border-radius: 6px;
  background: none;
  cursor: pointer;
}
.ag-reset-btn {
  width: 100%;
  padding: 8px;
  border-radius: 8px;
  border: 1px solid rgba(255, 255, 255, 0.12);
  background: none;
  color: inherit;
  font-size: 11px;
  cursor: pointer;
}
.ag-reset-btn:hover {
  background: rgba(255, 255, 255, 0.08);
}

/* Toast */
.ag-toast {
  position: fixed;
  bottom: 24px;
  left: 50%;
  transform: translateX(-50%);
  background: #3b82f6;
  color: #fff;
  padding: 10px 18px;
  border-radius: 12px;
  font-size: 12px;
  font-weight: 500;
  display: flex;
  align-items: center;
  gap: 8px;
  box-shadow: 0 10px 30px rgba(59, 130, 246, 0.4);
  z-index: 99;
}
.ag-empty-box {
  text-align: center;
  padding: 40px 10px;
  opacity: 0.5;
  font-size: 12px;
}
.ag-empty-box svg {
  margin: 0 auto 8px;
}
`;window.Alpine=pa,pa.start();var Ef=document.getElementById(`glass-dashboard-root`);Ef&&Sa.createRoot(Ef).render(L.createElement(L.StrictMode,null,L.createElement(yf)));var Df=document.getElementById(`admin-glass-dashboard-root`);if(Df)try{let e=Df.getAttribute(`data-dashboard`),t=e?JSON.parse(e):null;t&&Sa.createRoot(Df).render(L.createElement(L.StrictMode,null,L.createElement(wf,{data:t})))}catch(e){console.error(`Error mounting Admin Glass Dashboard:`,e)}
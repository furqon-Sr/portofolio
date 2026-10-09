import crypto from 'node:crypto';

/**
 * MCP Serverless Endpoint for Vercel / External Clients
 *
 * Implements Model Context Protocol (MCP) JSON-RPC 2.0 & SSE Stream
 * for external AI agent integration (Gemini Spark, Claude, etc.)
 */

// Active SSE sessions (in-memory for current instance)
const sseSessions = new Map();

// Tool definitions for MCP tools/list
const MCP_TOOLS = [
  {
    name: 'get_contacts',
    description: 'Mengambil pesan masuk dari form kontak website portofolio.',
    inputSchema: {
      type: 'object',
      properties: {
        limit: {
          type: 'integer',
          description: 'Jumlah maksimal pesan kontak yang ingin diambil (default: 50, max: 100).'
        }
      }
    }
  },
  {
    name: 'get_projects',
    description: 'Melihat daftar proyek portofolio yang ada.',
    inputSchema: {
      type: 'object',
      properties: {
        category: {
          type: 'string',
          description: "Filter kategori proyek (contoh: 'Web Dev' atau 'Design')."
        },
        limit: {
          type: 'integer',
          description: 'Jumlah maksimal proyek yang ingin diambil (default: 50).'
        }
      }
    }
  },
  {
    name: 'create_project',
    description: 'Menambahkan entri portofolio baru ke website.',
    inputSchema: {
      type: 'object',
      properties: {
        title: {
          type: 'string',
          description: 'Judul proyek portofolio (wajib).'
        },
        category: {
          type: 'string',
          description: "Kategori proyek (contoh: 'Web Dev', 'Design') (wajib)."
        },
        description: {
          type: 'string',
          description: 'Deskripsi lengkap mengenai proyek (wajib).'
        },
        live_link: {
          type: 'string',
          description: 'URL demo atau website langsung (opsional).'
        },
        github_link: {
          type: 'string',
          description: 'URL repositori GitHub (opsional).'
        },
        cover_image_url: {
          type: 'string',
          description: 'URL gambar sampul (cover image) proyek (opsional).'
        }
      },
      required: ['title', 'category', 'description']
    }
  },
  {
    name: 'update_project',
    description: 'Memperbarui data proyek portofolio yang sudah ada berdasarkan ID.',
    inputSchema: {
      type: 'object',
      properties: {
        id: {
          type: 'integer',
          description: 'ID proyek portofolio yang ingin diperbarui (wajib).'
        },
        title: {
          type: 'string',
          description: 'Judul baru proyek portofolio (opsional).'
        },
        category: {
          type: 'string',
          description: "Kategori baru proyek (contoh: 'Web Dev', 'Design') (opsional)."
        },
        description: {
          type: 'string',
          description: 'Deskripsi baru mengenai proyek (opsional).'
        },
        live_link: {
          type: 'string',
          description: 'URL demo atau website baru (opsional).'
        },
        github_link: {
          type: 'string',
          description: 'URL repositori GitHub baru (opsional).'
        },
        cover_image_url: {
          type: 'string',
          description: 'URL gambar sampul (cover image) baru (opsional).'
        }
      },
      required: ['id']
    }
  },
  {
    name: 'get_certificates',
    description: 'Mengambil daftar sertifikat yang terdaftar.',
    inputSchema: {
      type: 'object',
      properties: {
        limit: {
          type: 'integer',
          description: 'Jumlah maksimal sertifikat yang ingin diambil (default: 50).'
        }
      }
    }
  },
  {
    name: 'create_certificate',
    description: 'Menambahkan data sertifikat baru ke website.',
    inputSchema: {
      type: 'object',
      properties: {
        name: {
          type: 'string',
          description: 'Nama atau judul sertifikat (wajib).'
        },
        issuer: {
          type: 'string',
          description: "Penerbit sertifikat (misal: 'Google', 'Coursera', 'AWS') (wajib)."
        },
        issued_at: {
          type: 'string',
          description: 'Tanggal atau periode penerbitan sertifikat (format: YYYY-MM-DD atau Bulan Tahun) (wajib).'
        },
        credential_id: {
          type: 'string',
          description: 'ID kredensial sertifikat (opsional).'
        },
        credential_url: {
          type: 'string',
          description: 'URL verifikasi kredensial (opsional).'
        },
        image_url: {
          type: 'string',
          description: 'URL gambar sertifikat (opsional).'
        }
      },
      required: ['name', 'issuer', 'issued_at']
    }
  },
  {
    name: 'get_articles',
    description: 'Melihat daftar artikel blog yang sudah terbit di website.',
    inputSchema: {
      type: 'object',
      properties: {
        limit: {
          type: 'integer',
          description: 'Jumlah maksimal artikel yang ingin diambil (default: 50).'
        }
      }
    }
  },
  {
    name: 'create_article',
    description: 'Membuat dan menerbitkan artikel blog baru ke website portofolio.',
    inputSchema: {
      type: 'object',
      properties: {
        title: {
          type: 'string',
          description: 'Judul artikel blog (wajib).'
        },
        content: {
          type: 'string',
          description: 'Isi lengkap teks artikel blog (wajib, mendukung teks/HTML).'
        },
        excerpt: {
          type: 'string',
          description: 'Ringkasan singkat artikel untuk preview (opsional).'
        },
        cover_image_url: {
          type: 'string',
          description: 'URL gambar sampul (cover image) artikel (opsional).'
        },
        cover_image_source: {
          type: 'string',
          description: 'Label kredit sumber gambar (opsional).'
        },
        cover_image_source_url: {
          type: 'string',
          description: 'URL sumber gambar asli (opsional).'
        },
        references: {
          type: 'array',
          description: 'Daftar referensi (opsional).',
          items: {
            type: 'object',
            properties: {
              title: { type: 'string' },
              url: { type: 'string' }
            },
            required: ['title', 'url']
          }
        }
      },
      required: ['title', 'content']
    }
  },
  {
    name: 'update_article',
    description: 'Memperbarui artikel blog yang sudah ada berdasarkan ID.',
    inputSchema: {
      type: 'object',
      properties: {
        id: {
          type: 'integer',
          description: 'ID artikel yang ingin diperbarui (wajib).'
        },
        title: {
          type: 'string',
          description: 'Judul baru artikel blog (opsional).'
        },
        content: {
          type: 'string',
          description: 'Isi teks baru artikel blog (opsional).'
        },
        excerpt: {
          type: 'string',
          description: 'Ringkasan preview baru artikel (opsional).'
        },
        cover_image_url: {
          type: 'string',
          description: 'URL gambar sampul baru (opsional).'
        },
        cover_image_source: {
          type: 'string',
          description: 'Label kredit sumber gambar baru (opsional).'
        },
        cover_image_source_url: {
          type: 'string',
          description: 'URL sumber gambar asli baru (opsional).'
        },
        references: {
          type: 'array',
          description: 'Daftar referensi baru (opsional).'
        }
      },
      required: ['id']
    }
  },
  {
    name: 'get_expertise',
    description: 'Mengambil daftar keahlian/expertise teknologi dan tools yang ada di website portofolio.',
    inputSchema: {
      type: 'object',
      properties: {
        limit: {
          type: 'integer',
          description: 'Jumlah maksimal data keahlian yang ingin diambil (opsional).'
        }
      }
    }
  },
  {
    name: 'create_expertise',
    description: 'Menambahkan data keahlian/expertise baru ke website portofolio.',
    inputSchema: {
      type: 'object',
      properties: {
        name: {
          type: 'string',
          description: 'Nama keahlian atau teknologi (wajib, contoh: "React", "Docker", "Python").'
        },
        url: {
          type: 'string',
          description: 'Tautan URL resmi teknologi (opsional).'
        },
        logo: {
          type: 'string',
          description: 'Nama berkas logo (misal: "react.png") atau URL gambar logo (opsional, default: "code.svg").'
        },
        bg_class: {
          type: 'string',
          description: 'Class warna latar belakang Tailwind (opsional, contoh: "bg-[#61DAFB]/10", default: "bg-white").'
        },
        hover_class: {
          type: 'string',
          description: 'Class warna border saat hover Tailwind (opsional, contoh: "hover:border-[#61DAFB]", default: "hover:border-blue-500").'
        }
      },
      required: ['name']
    }
  },
  {
    name: 'update_expertise',
    description: 'Memperbarui data keahlian/expertise yang sudah ada berdasarkan ID.',
    inputSchema: {
      type: 'object',
      properties: {
        id: {
          type: 'integer',
          description: 'ID data keahlian yang ingin diperbarui (wajib).'
        },
        name: {
          type: 'string',
          description: 'Nama keahlian atau teknologi baru (opsional).'
        },
        url: {
          type: 'string',
          description: 'Tautan URL resmi baru (opsional).'
        },
        logo: {
          type: 'string',
          description: 'Nama berkas logo atau URL gambar baru (opsional).'
        },
        bg_class: {
          type: 'string',
          description: 'Class latar belakang Tailwind baru (opsional).'
        },
        hover_class: {
          type: 'string',
          description: 'Class border hover Tailwind baru (opsional).'
        }
      },
      required: ['id']
    }
  },
  {
    name: 'delete_expertise',
    description: 'Menghapus data keahlian/expertise dari website berdasarkan ID.',
    inputSchema: {
      type: 'object',
      properties: {
        id: {
          type: 'integer',
          description: 'ID data keahlian yang ingin dihapus (wajib).'
        }
      },
      required: ['id']
    }
  }
];

/**
 * Extract configuration from request & environment
 */
function getApiConfig(req) {
  const host = req.headers.host || 'localhost:8000';
  const protocol = host.includes('localhost') ? 'http' : 'https';
  const baseUrl = process.env.APP_URL || (process.env.VERCEL_URL ? `https://${process.env.VERCEL_URL}` : `${protocol}://${host}`);
  const apiKey = process.env.PORTFOLIO_API_KEY || process.env.GEMINI_API_KEY || '';
  return { baseUrl, apiKey };
}

/**
 * Call portfolio REST API endpoints internally
 */
async function callPortfolioApi(toolName, args, config) {
  const { baseUrl, apiKey } = config;

  const headers = {
    'Accept': 'application/json',
    'Content-Type': 'application/json',
    'X-API-KEY': apiKey
  };

  switch (toolName) {
    case 'get_contacts': {
      const url = new URL('/api/contacts', baseUrl);
      if (args?.limit) url.searchParams.set('limit', String(args.limit));

      const res = await fetch(url.toString(), { method: 'GET', headers });
      const json = await res.json();
      if (!res.ok) throw new Error(json?.message || `HTTP ${res.status}`);
      return json;
    }

    case 'get_projects': {
      const url = new URL('/api/projects', baseUrl);
      if (args?.category) url.searchParams.set('category', args.category);
      if (args?.limit) url.searchParams.set('limit', String(args.limit));

      const res = await fetch(url.toString(), { method: 'GET', headers });
      const json = await res.json();
      if (!res.ok) throw new Error(json?.message || `HTTP ${res.status}`);
      return json;
    }

    case 'create_project': {
      const url = new URL('/api/projects', baseUrl);
      const res = await fetch(url.toString(), {
        method: 'POST',
        headers,
        body: JSON.stringify({
          title: args.title,
          category: args.category,
          description: args.description,
          live_link: args.live_link || null,
          github_link: args.github_link || null,
          cover_image_url: args.cover_image_url || null
        })
      });
      const json = await res.json();
      if (!res.ok) throw new Error(json?.message || `HTTP ${res.status}`);
      return json;
    }

    case 'update_project': {
      const id = args.id;
      if (!id) throw new Error("Parameter 'id' wajib disertakan.");

      const url = new URL(`/api/projects/${id}`, baseUrl);
      const payload = {};
      if (args.title !== undefined) payload.title = args.title;
      if (args.category !== undefined) payload.category = args.category;
      if (args.description !== undefined) payload.description = args.description;
      if (args.live_link !== undefined) payload.live_link = args.live_link;
      if (args.github_link !== undefined) payload.github_link = args.github_link;
      if (args.cover_image_url !== undefined) payload.cover_image_url = args.cover_image_url;

      const res = await fetch(url.toString(), {
        method: 'PUT',
        headers,
        body: JSON.stringify(payload)
      });
      const json = await res.json();
      if (!res.ok) throw new Error(json?.message || `HTTP ${res.status}`);
      return json;
    }

    case 'get_certificates': {
      const url = new URL('/api/certificates', baseUrl);
      if (args?.limit) url.searchParams.set('limit', String(args.limit));

      const res = await fetch(url.toString(), { method: 'GET', headers });
      const json = await res.json();
      if (!res.ok) throw new Error(json?.message || `HTTP ${res.status}`);
      return json;
    }

    case 'create_certificate': {
      const url = new URL('/api/certificates', baseUrl);
      const res = await fetch(url.toString(), {
        method: 'POST',
        headers,
        body: JSON.stringify({
          name: args.name,
          issuer: args.issuer,
          issued_at: args.issued_at,
          credential_id: args.credential_id || null,
          credential_url: args.credential_url || null,
          image_url: args.image_url || null
        })
      });
      const json = await res.json();
      if (!res.ok) throw new Error(json?.message || `HTTP ${res.status}`);
      return json;
    }

    case 'get_articles': {
      const url = new URL('/api/articles', baseUrl);
      if (args?.limit) url.searchParams.set('limit', String(args.limit));

      const res = await fetch(url.toString(), { method: 'GET', headers });
      const json = await res.json();
      if (!res.ok) throw new Error(json?.message || `HTTP ${res.status}`);
      return json;
    }

    case 'create_article': {
      const url = new URL('/api/articles', baseUrl);
      const res = await fetch(url.toString(), {
        method: 'POST',
        headers,
        body: JSON.stringify({
          title: args.title,
          content: args.content,
          excerpt: args.excerpt || null,
          cover_image_url: args.cover_image_url || null,
          cover_image_source: args.cover_image_source || null,
          cover_image_source_url: args.cover_image_source_url || null,
          references: args.references || []
        })
      });
      const json = await res.json();
      if (!res.ok) throw new Error(json?.message || `HTTP ${res.status}`);
      return json;
    }

    case 'update_article': {
      const id = args.id;
      if (!id) throw new Error("Parameter 'id' wajib disertakan.");

      const url = new URL(`/api/articles/${id}`, baseUrl);
      const payload = {};
      if (args.title !== undefined) payload.title = args.title;
      if (args.content !== undefined) payload.content = args.content;
      if (args.excerpt !== undefined) payload.excerpt = args.excerpt;
      if (args.cover_image_url !== undefined) payload.cover_image_url = args.cover_image_url;
      if (args.cover_image_source !== undefined) payload.cover_image_source = args.cover_image_source;
      if (args.cover_image_source_url !== undefined) payload.cover_image_source_url = args.cover_image_source_url;
      if (args.references !== undefined) payload.references = args.references;

      const res = await fetch(url.toString(), {
        method: 'PUT',
        headers,
        body: JSON.stringify(payload)
      });
      const json = await res.json();
      if (!res.ok) throw new Error(json?.message || `HTTP ${res.status}`);
      return json;
    }

    // Expertise CRUD Tools
    case 'get_expertise': {
      const url = new URL('/api/expertise', baseUrl);
      if (args?.limit) url.searchParams.set('limit', String(args.limit));

      const res = await fetch(url.toString(), { method: 'GET', headers });
      const json = await res.json();
      if (!res.ok) throw new Error(json?.message || `HTTP ${res.status}`);
      return json;
    }

    case 'create_expertise': {
      const url = new URL('/api/expertise', baseUrl);
      const res = await fetch(url.toString(), {
        method: 'POST',
        headers,
        body: JSON.stringify({
          name: args.name,
          url: args.url || null,
          logo: args.logo || 'code.svg',
          bg_class: args.bg_class || 'bg-white',
          hover_class: args.hover_class || 'hover:border-blue-500'
        })
      });
      const json = await res.json();
      if (!res.ok) throw new Error(json?.message || `HTTP ${res.status}`);
      return json;
    }

    case 'update_expertise': {
      const id = args.id;
      if (!id) throw new Error("Parameter 'id' wajib disertakan.");

      const url = new URL(`/api/expertise/${id}`, baseUrl);
      const payload = {};
      if (args.name !== undefined) payload.name = args.name;
      if (args.url !== undefined) payload.url = args.url;
      if (args.logo !== undefined) payload.logo = args.logo;
      if (args.bg_class !== undefined) payload.bg_class = args.bg_class;
      if (args.hover_class !== undefined) payload.hover_class = args.hover_class;

      const res = await fetch(url.toString(), {
        method: 'PUT',
        headers,
        body: JSON.stringify(payload)
      });
      const json = await res.json();
      if (!res.ok) throw new Error(json?.message || `HTTP ${res.status}`);
      return json;
    }

    case 'delete_expertise': {
      const id = args.id;
      if (!id) throw new Error("Parameter 'id' wajib disertakan.");

      const url = new URL(`/api/expertise/${id}`, baseUrl);
      const res = await fetch(url.toString(), {
        method: 'DELETE',
        headers
      });
      const json = await res.json();
      if (!res.ok) throw new Error(json?.message || `HTTP ${res.status}`);
      return json;
    }

    default:
      throw new Error(`Tool '${toolName}' tidak dikenal.`);
  }
}

/**
 * Handle individual JSON-RPC 2.0 message
 */
async function handleJsonRpc(message, config) {
  const { id, method, params } = message;

  // Notification (no ID)
  const isNotification = id === undefined || id === null;

  switch (method) {
    case 'initialize': {
      return {
        jsonrpc: '2.0',
        id,
        result: {
          protocolVersion: '2024-11-05',
          capabilities: {
            tools: {
              listChanged: false
            }
          },
          serverInfo: {
            name: 'portfolio-mcp-server',
            version: '1.0.0'
          }
        }
      };
    }

    case 'notifications/initialized': {
      return null;
    }

    case 'ping': {
      return {
        jsonrpc: '2.0',
        id,
        result: {}
      };
    }

    case 'tools/list': {
      return {
        jsonrpc: '2.0',
        id,
        result: {
          tools: MCP_TOOLS
        }
      };
    }

    case 'tools/call': {
      const toolName = params?.name;
      const toolArgs = params?.arguments || {};

      try {
        const result = await callPortfolioApi(toolName, toolArgs, config);
        return {
          jsonrpc: '2.0',
          id,
          result: {
            content: [
              {
                type: 'text',
                text: JSON.stringify(result, null, 2)
              }
            ],
            isError: false
          }
        };
      } catch (err) {
        return {
          jsonrpc: '2.0',
          id,
          result: {
            content: [
              {
                type: 'text',
                text: `Error executing tool '${toolName}': ${err.message}`
              }
            ],
            isError: true
          }
        };
      }
    }

    default: {
      if (isNotification) return null;
      return {
        jsonrpc: '2.0',
        id,
        error: {
          code: -32601,
          message: `Method '${method}' tidak ditemukan pada MCP server.`
        }
      };
    }
  }
}

/**
 * Parse incoming HTTP request body safely
 */
async function readBody(req) {
  if (req.body && typeof req.body === 'object') {
    return req.body;
  }
  if (typeof req.body === 'string' && req.body.trim()) {
    try {
      return JSON.parse(req.body);
    } catch {
      return {};
    }
  }

  return new Promise((resolve) => {
    let raw = '';
    req.on('data', (chunk) => {
      raw += chunk;
    });
    req.on('end', () => {
      try {
        resolve(raw ? JSON.parse(raw) : {});
      } catch {
        resolve({});
      }
    });
    req.on('error', () => resolve({}));
  });
}

/**
 * Vercel Serverless Function Handler
 */
export default async function handler(req, res) {
  // CORS Headers
  res.setHeader('Access-Control-Allow-Origin', '*');
  res.setHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS');
  res.setHeader('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-API-KEY, X-Session-Id');

  if (req.method === 'OPTIONS') {
    return res.status(200).end();
  }

  const config = getApiConfig(req);
  const parsedUrl = new URL(req.url, `https://${req.headers.host || 'localhost'}`);
  const sessionId = parsedUrl.searchParams.get('sessionId') || req.headers['x-session-id'];

  // 1. GET Request: SSE Transport or Server Status
  if (req.method === 'GET') {
    const acceptsSse = req.headers.accept?.includes('text/event-stream') ||
                       parsedUrl.searchParams.get('transport') === 'sse';

    if (acceptsSse) {
      const newSessionId = sessionId || crypto.randomUUID();

      res.writeHead(200, {
        'Content-Type': 'text/event-stream',
        'Cache-Control': 'no-cache, no-transform',
        'Connection': 'keep-alive',
        'Access-Control-Allow-Origin': '*',
        'X-Accel-Buffering': 'no'
      });

      // Send endpoint event according to MCP specification
      const endpointPath = `/api/mcp?sessionId=${newSessionId}`;
      res.write(`event: endpoint\ndata: ${endpointPath}\n\n`);

      sseSessions.set(newSessionId, res);

      const keepAlive = setInterval(() => {
        try {
          res.write(': keepalive\n\n');
        } catch {
          clearInterval(keepAlive);
        }
      }, 15000);
      if (typeof keepAlive.unref === 'function') {
        keepAlive.unref();
      }

      req.on('close', () => {
        clearInterval(keepAlive);
        sseSessions.delete(newSessionId);
      });

      return;
    }

    // Friendly JSON status for browser/inspector
    return res.status(200).json({
      status: 'online',
      server: 'portfolio-mcp-server',
      version: '1.0.0',
      protocolVersion: '2024-11-05',
      transport: ['sse', 'http-post'],
      endpoints: {
        sse: '/api/mcp (Accept: text/event-stream)',
        post: '/api/mcp'
      },
      tools: MCP_TOOLS.map((t) => ({ name: t.name, description: t.description }))
    });
  }

  // 2. POST Request: JSON-RPC 2.0 Execution
  if (req.method === 'POST') {
    const body = await readBody(req);

    if (!body || typeof body !== 'object') {
      return res.status(400).json({
        jsonrpc: '2.0',
        id: null,
        error: { code: -32700, message: 'Parse error: Invalid JSON payload' }
      });
    }

    // Support batch requests or single request
    const isBatch = Array.isArray(body);
    const messages = isBatch ? body : [body];

    const responses = [];
    for (const msg of messages) {
      const resp = await handleJsonRpc(msg, config);
      if (resp) responses.push(resp);
    }

    const finalResult = isBatch ? responses : (responses[0] || null);

    // If an SSE connection is active for this session, also dispatch event
    if (sessionId && sseSessions.has(sessionId) && finalResult) {
      const sseRes = sseSessions.get(sessionId);
      try {
        sseRes.write(`event: message\ndata: ${JSON.stringify(finalResult)}\n\n`);
      } catch (e) {
        sseSessions.delete(sessionId);
      }
    }

    // Always respond with JSON-RPC payload directly in HTTP response
    if (finalResult) {
      return res.status(200).json(finalResult);
    }

    return res.status(204).end();
  }

  return res.status(405).json({ error: 'Method Not Allowed' });
}

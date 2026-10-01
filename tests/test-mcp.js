import handler from '../api/mcp.js';
import assert from 'node:assert';

// Mock response object
function createMockRes() {
  const res = {
    statusCode: 200,
    headers: {},
    body: null,
    setHeader(key, value) {
      res.headers[key.toLowerCase()] = value;
      return res;
    },
    status(code) {
      res.statusCode = code;
      return res;
    },
    json(data) {
      res.body = data;
      return res;
    },
    end() {
      return res;
    },
    writeHead(code, headers) {
      res.statusCode = code;
      Object.assign(res.headers, headers);
      return res;
    },
    write(chunk) {
      res.writtenData = (res.writtenData || '') + chunk;
      return true;
    }
  };
  return res;
}

async function runTests() {
  console.log('Testing MCP Server...');

  // Test 1: GET status
  {
    const req = { method: 'GET', url: '/api/mcp', headers: {} };
    const res = createMockRes();
    await handler(req, res);
    assert.strictEqual(res.statusCode, 200);
    assert.strictEqual(res.body.status, 'online');
    assert.strictEqual(res.body.server, 'portfolio-mcp-server');
    console.log('✓ GET /api/mcp returns online status');
  }

  // Test 2: GET with SSE
  {
    const req = {
      method: 'GET',
      url: '/api/mcp',
      headers: { accept: 'text/event-stream' },
      on: () => {}
    };
    const res = createMockRes();
    await handler(req, res);
    assert.strictEqual(res.statusCode, 200);
    assert.ok(res.writtenData.includes('event: endpoint'));
    assert.ok(res.writtenData.includes('/api/mcp?sessionId='));
    console.log('✓ GET /api/mcp (SSE) emits endpoint event');
  }

  // Test 3: POST initialize
  {
    const req = {
      method: 'POST',
      url: '/api/mcp',
      headers: { 'content-type': 'application/json' },
      body: {
        jsonrpc: '2.0',
        id: 1,
        method: 'initialize',
        params: {}
      }
    };
    const res = createMockRes();
    await handler(req, res);
    assert.strictEqual(res.statusCode, 200);
    assert.strictEqual(res.body.jsonrpc, '2.0');
    assert.strictEqual(res.body.id, 1);
    assert.strictEqual(res.body.result.protocolVersion, '2024-11-05');
    assert.strictEqual(res.body.result.serverInfo.name, 'portfolio-mcp-server');
    console.log('✓ POST /api/mcp initialize responds correctly');
  }

  // Test 4: POST tools/list
  {
    const req = {
      method: 'POST',
      url: '/api/mcp',
      headers: { 'content-type': 'application/json' },
      body: {
        jsonrpc: '2.0',
        id: 2,
        method: 'tools/list',
        params: {}
      }
    };
    const res = createMockRes();
    await handler(req, res);
    assert.strictEqual(res.statusCode, 200);
    const toolNames = res.body.result.tools.map(t => t.name);
    assert.ok(toolNames.includes('get_contacts'));
    assert.ok(toolNames.includes('get_projects'));
    assert.ok(toolNames.includes('create_project'));
    assert.ok(toolNames.includes('get_certificates'));
    assert.ok(toolNames.includes('create_certificate'));
    console.log(`✓ POST /api/mcp tools/list returns ${toolNames.length} tools`);
  }

  // Test 5: POST ping
  {
    const req = {
      method: 'POST',
      url: '/api/mcp',
      headers: { 'content-type': 'application/json' },
      body: {
        jsonrpc: '2.0',
        id: 3,
        method: 'ping'
      }
    };
    const res = createMockRes();
    await handler(req, res);
    assert.strictEqual(res.statusCode, 200);
    assert.deepStrictEqual(res.body.result, {});
    console.log('✓ POST /api/mcp ping responds correctly');
  }

  // Test 6: OPTIONS preflight
  {
    const req = { method: 'OPTIONS', url: '/api/mcp', headers: {} };
    const res = createMockRes();
    await handler(req, res);
    assert.strictEqual(res.statusCode, 200);
    assert.strictEqual(res.headers['access-control-allow-origin'], '*');
    console.log('✓ OPTIONS /api/mcp responds with CORS headers');
  }

  console.log('\nAll MCP unit tests passed successfully!');
}

runTests().catch(err => {
  console.error('Test failed:', err);
  process.exit(1);
});

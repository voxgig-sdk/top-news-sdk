"use strict";
var __createBinding = (this && this.__createBinding) || (Object.create ? (function(o, m, k, k2) {
    if (k2 === undefined) k2 = k;
    var desc = Object.getOwnPropertyDescriptor(m, k);
    if (!desc || ("get" in desc ? !m.__esModule : desc.writable || desc.configurable)) {
      desc = { enumerable: true, get: function() { return m[k]; } };
    }
    Object.defineProperty(o, k2, desc);
}) : (function(o, m, k, k2) {
    if (k2 === undefined) k2 = k;
    o[k2] = m[k];
}));
var __setModuleDefault = (this && this.__setModuleDefault) || (Object.create ? (function(o, v) {
    Object.defineProperty(o, "default", { enumerable: true, value: v });
}) : function(o, v) {
    o["default"] = v;
});
var __importStar = (this && this.__importStar) || (function () {
    var ownKeys = function(o) {
        ownKeys = Object.getOwnPropertyNames || function (o) {
            var ar = [];
            for (var k in o) if (Object.prototype.hasOwnProperty.call(o, k)) ar[ar.length] = k;
            return ar;
        };
        return ownKeys(o);
    };
    return function (mod) {
        if (mod && mod.__esModule) return mod;
        var result = {};
        if (mod != null) for (var k = ownKeys(mod), i = 0; i < k.length; i++) if (k[i] !== "default") __createBinding(result, mod, k[i]);
        __setModuleDefault(result, mod);
        return result;
    };
})();
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
const node_path_1 = __importDefault(require("node:path"));
const Fs = __importStar(require("node:fs"));
const node_test_1 = require("node:test");
const node_assert_1 = __importDefault(require("node:assert"));
const live_runner_1 = require("../../live-runner");
const live_entity_1 = require("../../live-entity");
const __1 = require("../../..");
const utility_1 = require("../../utility");
// AFTER the imports on purpose: TypeScript hoists `import` above any
// statement in the emitted CommonJS, so a loader placed above them would
// run only after every imported module had already been evaluated - and
// anything reading process.env at module scope would miss these values.
(0, utility_1.loadEnvLocal)(__dirname + '/../../../.env.local');
(0, node_test_1.describe)('TopNewEntity', async () => {
    // Per-test live pacing. Delay is read from sdk-test-control.json's
    // `test.live.delayMs`; only sleeps when TOP_NEWS_TEST_LIVE=TRUE.
    (0, node_test_1.afterEach)((0, utility_1.liveDelay)('TOP_NEWS_TEST_LIVE'));
    (0, node_test_1.test)('instance', async () => {
        const testsdk = __1.TopNewsSDK.test();
        const ent = testsdk.TopNew();
        (0, node_assert_1.default)(null != ent);
    });
    (0, node_test_1.test)('basic', async (t) => {
        const live = 'TRUE' === process.env.TOP_NEWS_TEST_LIVE;
        for (const op of ['list']) {
            if (!live && (0, utility_1.maybeSkipControl)(t, 'entityOp', 'top_new.' + op, live))
                return;
        }
        const setup = basicSetup();
        if (setup.live) {
            return (0, live_entity_1.runLiveEntity)(setup, { "active": true, "alias": { "field": {} }, "fields": [{ "active": true, "name": "news", "req": true, "short": "Array of news articles in this cluster from different sources", "type": "`$ARRAY`", "index$": 0 }], "name": "top_new", "op": { "list": { "input": "data", "name": "list", "points": [{ "active": true, "args": { "query": [{ "active": true, "kind": "query", "name": "date", "orig": "date", "reqd": false, "type": "`$STRING`", "index$": 0 }, { "active": true, "example": "en", "kind": "query", "name": "language", "orig": "language", "reqd": true, "type": "`$STRING`", "index$": 1 }, { "active": true, "example": "us", "kind": "query", "name": "source_country", "orig": "source_country", "reqd": true, "type": "`$STRING`", "index$": 2 }] }, "contract": { "id": "GET /top-news", "json": "{\"operationId\":\"getTopNews\",\"parameters\":[{\"description\":\"The country code for which to retrieve top news (e.g., 'us' for United States)\",\"in\":\"query\",\"name\":\"source-country\",\"required\":true,\"schema\":{\"example\":\"us\",\"type\":\"string\"}},{\"description\":\"The language code for the news articles (e.g., 'en' for English)\",\"in\":\"query\",\"name\":\"language\",\"required\":true,\"schema\":{\"example\":\"en\",\"type\":\"string\"}},{\"description\":\"The date for which to retrieve top news. If not specified, defaults to current day.\",\"in\":\"query\",\"name\":\"date\",\"required\":false,\"schema\":{\"format\":\"date\",\"type\":\"string\"}}],\"protocol\":\"http\",\"responses\":{\"200\":{\"content\":{\"application/json\":{\"example\":{\"country\":\"us\",\"language\":\"en\",\"top_news\":[{\"news\":[{\"author\":\"Taegan Goddard\",\"authors\":[\"Taegan Goddard\"],\"id\":224767206,\"image\":\"https://politicalwire.com/wp-content/uploads/2018/02/PW-podcast-logo.jpg\",\"publish_date\":\"2024-05-29 00:10:48\",\"summary\":\"...\",\"text\":\"...\",\"title\":\"Jury to Begin Deliberations In Trump Trial\",\"url\":\"https://politicalwire.com/2024/05/28/jury-to-begin-deliberations-in-trump-trial/\",\"video\":null}]}]},\"schema\":{\"properties\":{\"country\":{\"description\":\"Country code of the news source\",\"example\":\"us\",\"type\":\"string\"},\"language\":{\"description\":\"Language code of the news articles\",\"example\":\"en\",\"type\":\"string\"},\"top_news\":{\"description\":\"Array of news clusters, ordered by ranking\",\"items\":{\"properties\":{\"news\":{\"description\":\"Array of news articles in this cluster from different sources\",\"items\":{\"properties\":{\"author\":{\"description\":\"Primary author of the article\",\"example\":\"Taegan Goddard\",\"type\":\"string\"},\"authors\":{\"description\":\"List of all authors of the article\",\"example\":[\"Taegan Goddard\"],\"items\":{\"type\":\"string\"},\"type\":\"array\"},\"id\":{\"description\":\"Unique identifier for the news article\",\"example\":224767206,\"type\":\"integer\"},\"image\":{\"description\":\"URL to the article's main image\",\"example\":\"https://politicalwire.com/wp-content/uploads/2018/02/PW-podcast-logo.jpg\",\"format\":\"uri\",\"nullable\":true,\"type\":\"string\"},\"publish_date\":{\"description\":\"Publication date and time of the article\",\"example\":\"2024-05-29 00:10:48\",\"type\":\"string\"},\"summary\":{\"description\":\"Summary or excerpt of the news article\",\"type\":\"string\"},\"text\":{\"description\":\"Full text content of the news article\",\"type\":\"string\"},\"title\":{\"description\":\"Title of the news article\",\"example\":\"Jury to Begin Deliberations In Trump Trial\",\"type\":\"string\"},\"url\":{\"description\":\"URL to the original news article\",\"example\":\"https://politicalwire.com/2024/05/28/jury-to-begin-deliberations-in-trump-trial/\",\"format\":\"uri\",\"type\":\"string\"},\"video\":{\"description\":\"URL to the article's video content if available\",\"format\":\"uri\",\"nullable\":true,\"type\":\"string\"}},\"required\":[\"id\",\"title\",\"url\",\"publish_date\"],\"type\":\"object\"},\"type\":\"array\"}},\"required\":[\"news\"],\"type\":\"object\"},\"type\":\"array\"}},\"required\":[\"top_news\",\"language\",\"country\"],\"type\":\"object\"}}},\"description\":\"Successful response with top news clusters\"},\"400\":{\"description\":\"Bad request - invalid parameters\"},\"401\":{\"description\":\"Unauthorized - invalid or missing API key\"},\"429\":{\"description\":\"Too many requests - rate limit exceeded\"},\"500\":{\"description\":\"Internal server error\"}},\"security\":[{\"apiKey\":[]}],\"securitySchemes\":{\"apiKey\":{\"description\":\"API key for authentication. Required for all requests.\",\"in\":\"header\",\"name\":\"x-api-key\",\"type\":\"apiKey\"}},\"securitySource\":\"operation\"}", "source": "openapi3", "version": 1 }, "kind": "http", "method": "GET", "orig": "/top-news", "segments": [{ "lit": "top-news" }], "select": { "exist": ["date", "language", "source_country"] }, "transform": { "req": "`reqdata`", "res": "`body.top_news`" }, "index$": 0 }], "key$": "list" } }, "relations": { "ancestors": [] }, "key$": "top_new", "name__orig": "top_new", "Name": "TopNew", "name_": "top_new", "name-": "top-new", "NAME": "TOP_NEW", "index$": 0 }, { "active": true, "entity": "top_new", "key$": "BasicTopNewFlow", "kind": "basic", "name": "BasicTopNewFlow", "param": {}, "step": [{ "active": true, "data": {}, "input": {}, "match": {}, "op": "list", "spec": [], "valid": [{ "apply": "ItemExists", "def": { "ref": "top_new_ref01" } }], "index$": 0 }] }, 'TopNew');
        }
        const client = setup.client;
        const struct = setup.struct;
        const isempty = struct.isempty;
        const select = struct.select;
        let top_new_ref01_data = Object.values(setup.data.existing.top_new)[0];
        // LIST
        const top_new_ref01_ent = client.TopNew();
        const top_new_ref01_match = {};
        const top_new_ref01_list = (await top_new_ref01_ent.list(top_new_ref01_match)).map((e) => e.data());
    });
});
function basicSetup(extra) {
    // TODO: fix test def options
    const options = {}; // null
    // TODO: needs test utility to resolve path
    const entityDataFile = node_path_1.default.resolve(__dirname, '../../../../.sdk/test/entity/top_new/TopNewTestData.json');
    // TODO: file ready util needed?
    const entityDataSource = Fs.readFileSync(entityDataFile).toString('utf8');
    // TODO: need a xlang JSON parse utility in voxgig/struct with better error msgs
    const entityData = JSON.parse(entityDataSource);
    options.entity = entityData.existing;
    let client = __1.TopNewsSDK.test(options, extra);
    const struct = client.utility().struct;
    const merge = struct.merge;
    const transform = struct.transform;
    let idmap = transform(['top_new01', 'top_new02', 'top_new03'], {
        '`$PACK`': ['', {
                '`$KEY`': '`$COPY`',
                '`$VAL`': ['`$FORMAT`', 'upper', '`$COPY`']
            }]
    });
    const env = (0, utility_1.envOverride)({
        'TOP_NEWS_TEST_TOP_NEW_ENTID': idmap,
        'TOP_NEWS_TEST_LIVE': 'FALSE',
        'TOP_NEWS_TEST_EXPLAIN': 'FALSE',
        'TOP_NEWS_APIKEY': '',
    });
    idmap = env['TOP_NEWS_TEST_TOP_NEW_ENTID'];
    const live = 'TRUE' === env.TOP_NEWS_TEST_LIVE;
    const transport = (0, live_runner_1.createLiveTransport)();
    if (live) {
        const rawIds = process.env['TOP_NEWS_TEST_TOP_NEW_ENTID'];
        idmap = rawIds && rawIds.trim() ? JSON.parse(rawIds) : {};
        if (!idmap || Array.isArray(idmap) || typeof idmap !== 'object') {
            throw new Error('Live ENTID must be a JSON object');
        }
        client = new __1.TopNewsSDK(merge([
            // FIRST, so the generated fields below win: sdk-test-control.json's
            // test.client.options adds to the live client, it does not redirect it.
            (0, utility_1.liveClientOptions)(),
            {
                apikey: env.TOP_NEWS_APIKEY,
            },
            // 'extra || {}', not a bare 'extra': struct.merge returns UNDEFINED when the
            // last entry is undefined, and basicSetup is normally called with no
            // argument at all - so a bare 'extra' silently discarded the apikey
            // and server values above and handed the SDK undefined. Harmless
            // while there was nothing in that object; not harmless now.
            extra || {},
            { system: { fetch: transport.fetch } }
        ]));
    }
    const setup = {
        idmap,
        env,
        options,
        client,
        struct,
        data: entityData,
        explain: 'TRUE' === env.TOP_NEWS_TEST_EXPLAIN,
        live,
        transport,
        now: Date.now(),
    };
    return setup;
}
//# sourceMappingURL=TopNewEntity.test.js.map
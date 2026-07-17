-- TopNews SDK exists test

local sdk = require("top-news_sdk")

describe("TopNewsSDK", function()
  it("should create test SDK", function()
    local testsdk = sdk.test(nil, nil)
    assert.is_not_nil(testsdk)
  end)
end)

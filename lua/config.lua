-- ProjectName SDK configuration

local function make_config()
  return {
    main = {
      name = "TopNews",
    },
    feature = {
      ["test"] = {
        ["options"] = {
          ["active"] = false,
        },
      },
    },
    options = {
      base = "https://api.worldnewsapi.com",
      headers = {
        ["content-type"] = "application/json",
      },
      entity = {
        ["top_new"] = {},
      },
    },
    entity = {
      ["top_new"] = {
        ["fields"] = {
          {
            ["name"] = "new",
            ["req"] = true,
            ["type"] = "`$ARRAY`",
            ["active"] = true,
            ["index$"] = 0,
          },
        },
        ["name"] = "top_new",
        ["op"] = {
          ["list"] = {
            ["name"] = "list",
            ["points"] = {
              {
                ["args"] = {
                  ["query"] = {
                    {
                      ["kind"] = "query",
                      ["name"] = "date",
                      ["orig"] = "date",
                      ["reqd"] = false,
                      ["type"] = "`$STRING`",
                      ["active"] = true,
                    },
                    {
                      ["example"] = "en",
                      ["kind"] = "query",
                      ["name"] = "language",
                      ["orig"] = "language",
                      ["reqd"] = true,
                      ["type"] = "`$STRING`",
                      ["active"] = true,
                    },
                    {
                      ["example"] = "us",
                      ["kind"] = "query",
                      ["name"] = "source_country",
                      ["orig"] = "source_country",
                      ["reqd"] = true,
                      ["type"] = "`$STRING`",
                      ["active"] = true,
                    },
                  },
                },
                ["method"] = "GET",
                ["orig"] = "/top-news",
                ["parts"] = {
                  "top-news",
                },
                ["select"] = {
                  ["exist"] = {
                    "date",
                    "language",
                    "source_country",
                  },
                },
                ["transform"] = {
                  ["req"] = "`reqdata`",
                  ["res"] = "`body`",
                },
                ["active"] = true,
                ["index$"] = 0,
              },
            },
            ["input"] = "data",
            ["key$"] = "list",
          },
        },
        ["relations"] = {
          ["ancestors"] = {},
        },
      },
    },
  }
end


local function make_feature(name)
  local features = require("features")
  local factory = features[name]
  if factory ~= nil then
    return factory()
  end
  return features.base()
end


-- Attach make_feature to the SDK class
local function setup_sdk(SDK)
  SDK._make_feature = make_feature
end


return make_config

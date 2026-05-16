# TopNews SDK configuration

module TopNewsConfig
  def self.make_config
    {
      "main" => {
        "name" => "TopNews",
      },
      "feature" => {
        "test" => {
          "options" => {
            "active" => false,
          },
        },
      },
      "options" => {
        "base" => "https://api.worldnewsapi.com",
        "auth" => {
          "prefix" => "Bearer",
        },
        "headers" => {
          "content-type" => "application/json",
        },
        "entity" => {
          "top_new" => {},
        },
      },
      "entity" => {
        "top_new" => {
          "fields" => [
            {
              "name" => "new",
              "req" => true,
              "type" => "`$ARRAY`",
              "active" => true,
              "index$" => 0,
            },
          ],
          "name" => "top_new",
          "op" => {
            "list" => {
              "name" => "list",
              "points" => [
                {
                  "args" => {
                    "query" => [
                      {
                        "kind" => "query",
                        "name" => "date",
                        "orig" => "date",
                        "reqd" => false,
                        "type" => "`$STRING`",
                        "active" => true,
                      },
                      {
                        "example" => "en",
                        "kind" => "query",
                        "name" => "language",
                        "orig" => "language",
                        "reqd" => true,
                        "type" => "`$STRING`",
                        "active" => true,
                      },
                      {
                        "example" => "us",
                        "kind" => "query",
                        "name" => "source_country",
                        "orig" => "source_country",
                        "reqd" => true,
                        "type" => "`$STRING`",
                        "active" => true,
                      },
                    ],
                  },
                  "method" => "GET",
                  "orig" => "/top-news",
                  "parts" => [
                    "top-news",
                  ],
                  "select" => {
                    "exist" => [
                      "date",
                      "language",
                      "source_country",
                    ],
                  },
                  "transform" => {
                    "req" => "`reqdata`",
                    "res" => "`body`",
                  },
                  "active" => true,
                  "index$" => 0,
                },
              ],
              "input" => "data",
              "key$" => "list",
            },
          },
          "relations" => {
            "ancestors" => [],
          },
        },
      },
    }
  end


  def self.make_feature(name)
    require_relative 'features'
    TopNewsFeatures.make_feature(name)
  end
end

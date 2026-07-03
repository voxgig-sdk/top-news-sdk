# TopNews SDK configuration


def make_config():
    return {
        "main": {
            "name": "TopNews",
        },
        "feature": {
            "test": {
        "options": {
          "active": False,
        },
      },
        },
        "options": {
            "base": "https://api.worldnewsapi.com",
            "auth": {
                "prefix": "Bearer",
            },
            "headers": {
        "content-type": "application/json",
      },
            "entity": {
                "top_new": {},
            },
        },
        "entity": {
      "top_new": {
        "fields": [
          {
            "active": True,
            "name": "new",
            "req": True,
            "type": "`$ARRAY`",
            "index$": 0,
          },
        ],
        "name": "top_new",
        "op": {
          "list": {
            "input": "data",
            "name": "list",
            "points": [
              {
                "active": True,
                "args": {
                  "query": [
                    {
                      "active": True,
                      "kind": "query",
                      "name": "date",
                      "orig": "date",
                      "reqd": False,
                      "type": "`$STRING`",
                    },
                    {
                      "active": True,
                      "example": "en",
                      "kind": "query",
                      "name": "language",
                      "orig": "language",
                      "reqd": True,
                      "type": "`$STRING`",
                    },
                    {
                      "active": True,
                      "example": "us",
                      "kind": "query",
                      "name": "source_country",
                      "orig": "source_country",
                      "reqd": True,
                      "type": "`$STRING`",
                    },
                  ],
                },
                "method": "GET",
                "orig": "/top-news",
                "parts": [
                  "top-news",
                ],
                "select": {
                  "exist": [
                    "date",
                    "language",
                    "source_country",
                  ],
                },
                "transform": {
                  "req": "`reqdata`",
                  "res": "`body`",
                },
                "index$": 0,
              },
            ],
            "key$": "list",
          },
        },
        "relations": {
          "ancestors": [],
        },
      },
    },
    }

package core

func MakeConfig() map[string]any {
	return map[string]any{
		"main": map[string]any{
			"name": "TopNews",
		},
		"feature": map[string]any{
			"test": map[string]any{
				"options": map[string]any{
					"active": false,
				},
			},
		},
		"options": map[string]any{
			"base": "https://api.worldnewsapi.com",
			"auth": map[string]any{
				"prefix": "Bearer",
			},
			"headers": map[string]any{
				"content-type": "application/json",
			},
			"entity": map[string]any{
				"top_new": map[string]any{},
			},
		},
		"entity": map[string]any{
			"top_new": map[string]any{
				"fields": []any{
					map[string]any{
						"name": "new",
						"req": true,
						"type": "`$ARRAY`",
						"active": true,
						"index$": 0,
					},
				},
				"name": "top_new",
				"op": map[string]any{
					"list": map[string]any{
						"name": "list",
						"points": []any{
							map[string]any{
								"args": map[string]any{
									"query": []any{
										map[string]any{
											"kind": "query",
											"name": "date",
											"orig": "date",
											"reqd": false,
											"type": "`$STRING`",
											"active": true,
										},
										map[string]any{
											"example": "en",
											"kind": "query",
											"name": "language",
											"orig": "language",
											"reqd": true,
											"type": "`$STRING`",
											"active": true,
										},
										map[string]any{
											"example": "us",
											"kind": "query",
											"name": "source_country",
											"orig": "source_country",
											"reqd": true,
											"type": "`$STRING`",
											"active": true,
										},
									},
								},
								"method": "GET",
								"orig": "/top-news",
								"parts": []any{
									"top-news",
								},
								"select": map[string]any{
									"exist": []any{
										"date",
										"language",
										"source_country",
									},
								},
								"transform": map[string]any{
									"req": "`reqdata`",
									"res": "`body`",
								},
								"active": true,
								"index$": 0,
							},
						},
						"input": "data",
						"key$": "list",
					},
				},
				"relations": map[string]any{
					"ancestors": []any{},
				},
			},
		},
	}
}

func makeFeature(name string) Feature {
	switch name {
	case "test":
		if NewTestFeatureFunc != nil {
			return NewTestFeatureFunc()
		}
	default:
		if NewBaseFeatureFunc != nil {
			return NewBaseFeatureFunc()
		}
	}
	return nil
}

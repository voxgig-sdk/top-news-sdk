<?php
declare(strict_types=1);

// TopNews SDK configuration

class TopNewsConfig
{
    public static function make_config(): array
    {
        return [
            "main" => [
                "name" => "TopNews",
            ],
            "feature" => [
                "test" => [
          'options' => [
            'active' => false,
          ],
        ],
            ],
            "options" => [
                "base" => "https://api.worldnewsapi.com",
                "auth" => [
                    "prefix" => "Bearer",
                ],
                "headers" => [
          'content-type' => 'application/json',
        ],
                "entity" => [
                    "top_new" => [],
                ],
            ],
            "entity" => [
        'top_new' => [
          'fields' => [
            [
              'active' => true,
              'name' => 'new',
              'req' => true,
              'type' => '`$ARRAY`',
              'index$' => 0,
            ],
          ],
          'name' => 'top_new',
          'op' => [
            'list' => [
              'input' => 'data',
              'name' => 'list',
              'points' => [
                [
                  'active' => true,
                  'args' => [
                    'query' => [
                      [
                        'active' => true,
                        'kind' => 'query',
                        'name' => 'date',
                        'orig' => 'date',
                        'reqd' => false,
                        'type' => '`$STRING`',
                      ],
                      [
                        'active' => true,
                        'example' => 'en',
                        'kind' => 'query',
                        'name' => 'language',
                        'orig' => 'language',
                        'reqd' => true,
                        'type' => '`$STRING`',
                      ],
                      [
                        'active' => true,
                        'example' => 'us',
                        'kind' => 'query',
                        'name' => 'source_country',
                        'orig' => 'source_country',
                        'reqd' => true,
                        'type' => '`$STRING`',
                      ],
                    ],
                  ],
                  'method' => 'GET',
                  'orig' => '/top-news',
                  'parts' => [
                    'top-news',
                  ],
                  'select' => [
                    'exist' => [
                      'date',
                      'language',
                      'source_country',
                    ],
                  ],
                  'transform' => [
                    'req' => '`reqdata`',
                    'res' => '`body`',
                  ],
                  'index$' => 0,
                ],
              ],
              'key$' => 'list',
            ],
          ],
          'relations' => [
            'ancestors' => [],
          ],
        ],
      ],
        ];
    }


    public static function make_feature(string $name)
    {
        require_once __DIR__ . '/features.php';
        return TopNewsFeatures::make_feature($name);
    }
}

<?php
declare(strict_types=1);

// TopNews SDK configuration

class TopNewsConfig
{
    /** @var array<string,mixed>|null */
    private static ?array $shared_config = null;

    /**
     * Return the process-wide config, built once on first use. The SDK reads
     * the config on every request and never writes to it, so one instance is
     * shared by every client rather than rebuilt per client.
     *
     * PHP arrays are copy-on-write, so callers that do mutate the result get
     * their own copy and cannot disturb the shared one.
     */
    public static function shared_config(): array
    {
        if (self::$shared_config === null) {
            self::$shared_config = self::make_config();
        }
        return self::$shared_config;
    }

    /**
     * Build a fresh, fully materialised config array. Every call rebuilds the
     * whole structure, so prefer shared_config unless you need a private copy.
     */
    public static function make_config(): array
    {
        return [
            "main" => [
                "name" => "TopNews",
                "slug" => "top-news",
                "version" => "0.0.1",
                "target" => "php",
            ],
            "feature" => [
                "test" => [
          'options' => [
            'active' => false,
          ],
          'transport' => 'base',
        ],
            ],
            "options" => [
                "base" => "https://api.worldnewsapi.com",
                "auth" => [
                    "prefix" => "",
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
              'name' => 'news',
              'req' => true,
              'short' => 'Array of news articles in this cluster from different sources',
              'type' => '`$ARRAY`',
            ],
          ],
          'name' => 'top_new',
          'op' => [
            'list' => [
              'input' => 'data',
              'name' => 'list',
              'points' => [
                [
                  'args' => [
                    'query' => [
                      [
                        'kind' => 'query',
                        'name' => 'date',
                        'orig' => 'date',
                        'type' => '`$STRING`',
                      ],
                      [
                        'example' => 'en',
                        'kind' => 'query',
                        'name' => 'language',
                        'orig' => 'language',
                        'reqd' => true,
                        'type' => '`$STRING`',
                      ],
                      [
                        'example' => 'us',
                        'kind' => 'query',
                        'name' => 'source_country',
                        'orig' => 'source_country',
                        'reqd' => true,
                        'type' => '`$STRING`',
                      ],
                    ],
                  ],
                  'kind' => 'http',
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
                    'res' => '`body.top_news`',
                  ],
                ],
              ],
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

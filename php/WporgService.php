<?php
namespace Rarst\Guzzle;

class WporgService
{
    public static function getDescription()
    {
        return [
            'name'        => 'WordPress.org API',
            'baseUrl'     => 'https://api.wordpress.org',
            'description' => 'Guzzle client for WordPress.org APIs',
            'operations'  => [
                'getSalt'             => [
                    'summary'       => 'Get security secret keys and salts.',
                    'responseModel' => 'body',
                    'httpMethod'    => 'GET',
                    'uri'           => 'secret-key/{version}/salt/',
                    'parameters'    => [
                        'version' => [
                            'location' => 'uri',
                            'default'  => '1.1',
                        ]
                    ],
                ],
                'getStats'            => [
                    'summary'       => 'Get usage stats information.',
                    'responseModel' => 'json',
                    'httpMethod'    => 'GET',
                    'uri'           => 'stats/{type}/{version}/{slug}',
                    'parameters'    => [
                        'type'    => [
                            'location' => 'uri',
                            'type'     => 'string',
                            'required' => true,
                        ],
                        'version' => [
                            'location' => 'uri',
                            'default'  => '1.0',
                        ],
                        'slug'    => [
                            'location' => 'uri',
                            'type'     => 'string',
                        ],
                    ],
                ],
                'getDownloads'        => [
                    'extends'    => 'getStats',
                    'uri'        => 'stats/{type}/{version}/downloads.php',
                    'parameters' => [
                        'type'    => [
                            'location' => 'uri',
                            'default'  => 'plugin',
                            'required' => true,
                        ],
                        'version' => [
                            'location' => 'uri',
                            'default'  => '1.0',
                        ],
                        'slug'    => [
                            'location' => 'query',
                            'type'     => 'string',
                        ],
                        'limit'   => [
                            'location' => 'query',
                        ],
                    ],
                ],
                'getCoreVersionCheck' => [
                    'summary'       => 'Get WordPress core update information.',
                    'responseModel' => 'json',
                    'httpMethod'    => 'GET',
                    'uri'           => 'core/version-check/{api_version}/',
                    'parameters'    => [
                        'api_version' => [
                            'location' => 'uri',
                            'default'  => '1.7',
                        ],
                        'version'     => [
                            'location' => 'query',
                        ],
                        'locale'      => [
                            'location' => 'query',
                        ],
                    ],
                ],
                'getCoreCredits'      => [
                    'summary'       => 'Get core release credits information.',
                    'responseModel' => 'json',
                    'httpMethod'    => 'GET',
                    'uri'           => 'core/credits/{api_version}/',
                    'parameters'    => [
                        'api_version' => [
                            'location' => 'uri',
                            'default'  => '1.1',
                        ],
                        'version'     => [
                            'location' => 'query',
                        ],
                    ],
                ],
                'getTranslations'     => [
                    'summary'       => 'Get available translations information.',
                    'responseModel' => 'json',
                    'httpMethod'    => 'GET',
                    'uri'           => 'translations/{type}/{api_version}/',
                    'parameters'    => [
                        'type'        => [
                            'location' => 'uri',
                            'requires' => true,
                        ],
                        'api_version' => [
                            'location' => 'uri',
                            'default'  => '1.0',
                        ],
                        'version'     => [
                            'location' => 'query',
                        ],
                        'slug'        => [
                            'location' => 'query',
                        ],
                    ],
                ],
                'getThemesInfo'       => [
                    'summary'       => 'Get repository theme information.',
                    'responseModel' => 'serialized',
                    'httpMethod'    => 'POST',
                    'uri'           => 'themes/info/{version}/',
                    'parameters'    => [
                        'version' => [
                            'location' => 'uri',
                            'default'  => '1.0',
                        ],
                        'action'  => [
                            'location' => 'postField',
                            'default'  => 'theme_information',
                        ],
                        'request' => [
                            'location' => 'postField',
                            'type'     => 'array',
                            'filters'  => [
                                'stdClass::__set_state',
                                'serialize',
                            ],
                        ],
                    ],
                ],
                'getPluginsInfo'      => [
                    'summary'       => 'Get repository plugin information.',
                    'responseModel' => 'json',
                    'httpMethod'    => 'GET',
                    'uri'           => 'plugins/info/{version}/{slug}.json',
                    'parameters'    => [
                        'version' => [
                            'location' => 'uri',
                            'default'  => '1.0',
                        ],
                        'slug'    => [
                            'location' => 'uri',
                            'required' => true,
                        ],
                    ],
                ],
                'getCoreImporters'    => [
                    'summary'       => 'Get popular importers information.',
                    'responseModel' => 'json',
                    'httpMethod'    => 'GET',
                    'uri'           => 'core/importers/{api_version}/',
                    'parameters'    => [
                        'api_version' => [
                            'location' => 'uri',
                            'default'  => '1.1',
                        ],
                    ],
                ],
                'getImporters'        => [ 'extends' => 'getCoreImporters' ], // shorter alias
                'getCoreChecksums'    => [
                    'summary'       => 'Get core files checksums information.',
                    'responseModel' => 'json',
                    'httpMethod'    => 'GET',
                    'uri'           => '/core/checksums/{api_version}/',
                    'parameters'    => [
                        'api_version' => [
                            'location' => 'uri',
                            'default'  => '1.0',
                        ],
                        'version'     => [
                            'location' => 'query',
                            'required' => 'true',
                        ],
                        'locale'      => [
                            'location' => 'query',
                            'default'  => 'en_US',
                        ],
                    ],
                ],
            ],
            'models'      => [
                'body'       => [
                    'type'       => 'object',
                    'properties' => [
                        'body' => [
                            'location' => 'body',
                            'type'     => 'string',
                        ],
                    ]
                ],
                'json'       => [
                    'type'                 => 'object',
                    'additionalProperties' => [ 'location' => 'json' ],
                ],
                'serialized' => [
                    'type'       => 'object',
                    'properties' => [
                        'body' => [
                            'location' => 'body',
                            'type'     => 'string',
                            'filters'  => [ 'unserialize', 'get_object_vars' ],
                        ],
                    ],
                ],
                'serializedArray' => [
                    'type'       => 'object',
                    'properties' => [
                        'body' => [
                            'location' => 'body',
                            'type'     => 'string',
                            'filters'  => [ 'unserialize' ],
                        ],
                    ],
                ],
            ]
        ];
    }
}

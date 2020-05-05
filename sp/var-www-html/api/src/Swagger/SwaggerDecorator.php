<?php

declare(strict_types=1);

namespace App\Swagger;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class SwaggerDecorator implements NormalizerInterface
{
    private NormalizerInterface $decorated;

    public function __construct(NormalizerInterface $decorated)
    {
        $this->decorated = $decorated;
    }

    public function supportsNormalization($data, $format = null): bool
    {
        return $this->decorated->supportsNormalization($data, $format);
    }

    public function normalize($object, $format = null, array $context = [])
    {
        $docs = $this->decorated->normalize($object, $format, $context);

        $docs['components']['schemas']['Token'] = [
            'type' => 'object',
            'properties' => [
                'token' => [
                    'type' => 'string',
                    'readOnly' => true,
                ],
            ],
        ];


        $userDefinition = [
            'name' => 'email',
            'definition' => 'Email Address',
            'summary' => 'user',
            #'default' => 'johndoe@test.com',
            'in' => 'body',
            'schema' => [
                'type' => 'object',
                'required' => [
                    'email',
                    'password'
                ],
                'properties' => [
                    'email' =>  [
                        'type' => 'string'
                    ],
                    'password' => [
                        'type' => 'string'
                    ]
                    
                ]
            ]
        ];

        $emailDefinition = [
            'name' => 'email',
            'definition' => 'Email Address',
            'default' => 'johndoe@test.com',
            'required' => 'true',
            'in' => 'body',
        ];


        $passwordDefinition = [
            'name' => 'password',
            'definition' => 'Password',
            'default' => 'test',
            'required' => 'true',
            'in' => 'body',
        ];

        $docs['components']['schemas']['Credentials'] = [
            'in' => 'body',
            'type' => 'object',
            'properties' => [
                'username' => [
                    'type' => 'string',
                    'example' => 'api',
                ],
                'password' => [
                    'type' => 'string',
                    'example' => 'api',
                ],
            ],
        ];

        $tokenDocumentation = [
            'paths' => [
                '/login' => [
                    'post' => [
                        'tags' => ['Token'],
                        'operationId' => 'postCredentialsItem',
                        'summary' => 'Get JWT token to login.',
                        'requestBody' => [
                            'description' => 'Create new JWT Token',
                            'content' => [
                                'application/json' => [
#                                    'schema' => [
#                                         'type' => 'object',
#                                         'properties' => [
#                                             'email' => [
#                                                 'type' => 'string'
#                                             ],
#                                             'password' => [
#                                                 'type' => 'string'
#                                             ]
#                                    
#                                         ]
                                        '$ref' => '#/components/schemas/Credentials',
#                                    ],
                                ],
                            ],
                        ],
                        'responses' => [
                            Response::HTTP_OK => [
                                'description' => 'Get JWT token',
                                'content' => [
                                    'application/json' => [
                                        'schema' => [
                                            '$ref' => '#/components/schemas/Token',
                                        ],
                                    ],
                                ],
                            ],
                        ],
                        'parameters' => [ $userDefinition ]
                    ],
                ],
            ],
            'components' => [
                'schemas' => [ 
                    'Credentials' => [
                        'type' => 'object',
                        'required' =>  [
                            'email',
                            'password'
                        ],
                        'properties' => [
                            'email' => [
                                'type' => 'string'
                            ],
                            'password' => [
                                'type' => 'string'
                            ]
                        ]
                    ]
                ]
            ]
        ];

        return array_merge_recursive($docs, $tokenDocumentation);
    }
}

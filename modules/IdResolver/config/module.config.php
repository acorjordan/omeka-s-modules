<?php
namespace IdResolver;

use Laminas\Router\Http;

return [
    'controllers' => [
        'invokables' => [
            'IdResolver\Controller\Site\Index' => Controller\Site\IndexController::class,
        ],
    ],
    'router' => [
        'routes' => [
            'site' => [
                'child_routes' => [
                    'id-resolver' => [
                        'type' => Http\Literal::class,
                        'options' => [
                            'route' => '/id-resolver',
                            'defaults' => [
                                '__NAMESPACE__' => 'IdResolver\Controller\Site',
                                'controller' => 'index',
                                'action' => 'index',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
];

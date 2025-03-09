<?php

namespace ItemSetParty;

return [
    'controllers' => [
        'invokables' => [
            'ItemSetParty\Controller\Admin\Index' => Controller\Admin\IndexController::class,
            'ItemSetParty\Controller\Site\Index' => Controller\Site\IndexController::class,
        ],
    ],
    'controller_plugins' => [
        'factories' => [
            'itemSetParty' => Service\ControllerPlugin\ItemSetPartyFactory::class,
        ],
    ],
    'view_helpers' => [
        'invokables' => [
            'itemSetPartyTree' => View\Helper\ItemSetPartyTree::class,
            'itemSetPartyResource' => View\Helper\ItemSetPartyResource::class,
            'itemSetPartySidebarResource' => View\Helper\ItemSetPartySidebarResource::class,
        ],
    ],
    'navigation' => [
        'AdminModule' => [
            [
                'label' => 'Item Set Party', // @translate
                'class' => 'item-set-party',
                'route' => 'admin/item-set-party',
                'resource' => 'ItemSetParty\Controller\Admin\Index',
                'privilege' => 'index',
            ],
        ],
    ],
    'navigation_links' => [
        'invokables' => [
            'itemSetParty' => Site\Navigation\Link\ItemSetParty::class,
        ],
    ],
    'block_layouts' => [
        'invokables' => [
            'itemSetParty' => Site\BlockLayout\ItemSetParty::class,
        ],
    ],
    'router' => [
        'routes' => [
            'admin' => [
                'child_routes' => [
                    'item-set-party' => [
                        'type' => 'Segment',
                        'options' => [
                            'route' => '/item-set-party',
                            'defaults' => [
                                '__NAMESPACE__' => 'ItemSetParty\Controller\Admin',
                                'controller' => 'Index',
                                'action' => 'index',
                            ],
                        ],
                        'may_terminate' => true,
                        'child_routes' => [
                            'relations' => [
                                'type' => 'Segment',
                                'options' => [
                                    'route' => '/relations/:type/:id',
                                    'constraints' => [
                                        'id' => '\d+',
                                    ],
                                    'defaults' => [
                                        '__NAMESPACE__' => 'ItemSetParty\Controller\Admin',
                                        'controller' => 'Index',
                                        'action' => 'get-relations',
                                    ],
                                ],
                            ],
                            'resource-details' => [
                                'type' => 'Segment',
                                'options' => [
                                    'route' => '/resource-details/:type/:id',
                                    'constraints' => [
                                        'id' => '\d+',
                                    ],
                                    'defaults' => [
                                        '__NAMESPACE__' => 'ItemSetParty\Controller\Admin',
                                        'controller' => 'Index',
                                        'action' => 'resource-details',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            'site' => [
                'child_routes' => [
                    'item-set-party' => [
                        'type' => 'Segment',
                        'options' => [
                            'route' => '/item-set-party',
                            'defaults' => [
                                '__NAMESPACE__' => 'ItemSetParty\Controller\Site',
                                'controller' => 'Index',
                                'action' => 'index',
                            ],
                        ],
                        'may_terminate' => true,
                        'child_routes' => [
                            'relations' => [
                                'type' => 'Segment',
                                'options' => [
                                    'route' => '/relations/:type/:id',
                                    'constraints' => [
                                        'id' => '\d+',
                                    ],
                                    'defaults' => [
                                        '__NAMESPACE__' => 'ItemSetParty\Controller\Site',
                                        'controller' => 'Index',
                                        'action' => 'get-relations',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'translator' => [
        'translation_file_patterns' => [
            [
                'type' => 'gettext',
                'base_dir' => dirname(__DIR__) . '/language',
                'pattern' => '%s.mo',
                'text_domain' => null,
            ],
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            dirname(__DIR__) . DIRECTORY_SEPARATOR . 'view',
        ],
    ],
];

<?php declare(strict_types=1);

namespace Robots;

return [
    'controllers' => [
        'factories' => [
            Controller\RobotsController::class => Service\Controller\RobotsControllerFactory::class
        ],
    ],
    'router' => [
        'routes' => [
            'robots' => [
                'type' => \Laminas\Router\Http\Literal::class,
                'options' => [
                    'route' => '/robots.txt',
                    'defaults' => [
                        '__NAMESPACE__' => 'Robots\Controller',
                        'controller' => Controller\RobotsController::class,
                        'action' => 'robots',
                    ],
                ],
            ],
        ],
    ],
    'form_elements' => [
        'invokables' => [
            'Robots\Form\ConfigForm' => Form\ConfigForm::class
        ],
    ],
    'robots' => [
        'config' => [
            'robots_content' => '',
        ],
    ],
];

?>
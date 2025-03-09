<?php

namespace RedirectAfterLogin;

return [
    'listeners' => [
        'RedirectAfterLogin\MvcListeners',
    ],
    'service_manager' => [
        'invokables' => [
            'RedirectAfterLogin\MvcListeners' => Mvc\MvcListeners::class,
        ],
    ],
];

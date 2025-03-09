<?php

namespace ArkUrl;

return [
    'api_adapters' => [
        'delegators' => [
            \Omeka\Api\Adapter\ItemAdapter::class => [
                Service\Delegator\ApiAdapterDelegatorFactory::class,
            ],
            \Omeka\Api\Adapter\ItemSetAdapter::class => [
                Service\Delegator\ApiAdapterDelegatorFactory::class,
            ],
            \Omeka\Api\Adapter\MediaAdapter::class => [
                Service\Delegator\ApiAdapterDelegatorFactory::class,
            ],
        ],
    ],
    'view_helpers' => [
        'invokables' => [
            'arkUrl' => View\Helper\ArkUrl::class,
        ],
        'delegators' => [
            'resourcePageBlocks' => [
                Service\Delegator\ViewHelperResourcePageBlocksDelegatorFactory::class,
            ],
        ],
    ],
];

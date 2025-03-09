<?php

namespace ArkUrl\Api\Adapter;

use Omeka\Api\Adapter\ItemSetAdapter;

class ItemSetAdapterDelegator extends ItemSetAdapter
{
    /**
     * This is used by EventManagerAwareTrait to add other identifiers to the
     * event manager
     */
    protected $eventIdentifier = ItemSetAdapter::class;

    public function getRepresentationClass()
    {
        return \ArkUrl\Api\Representation\ItemSetRepresentation::class;
    }
}

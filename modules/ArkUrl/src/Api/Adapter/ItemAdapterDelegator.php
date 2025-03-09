<?php

namespace ArkUrl\Api\Adapter;

use Omeka\Api\Adapter\ItemAdapter;

class ItemAdapterDelegator extends ItemAdapter
{
    /**
     * This is used by EventManagerAwareTrait to add other identifiers to the
     * event manager
     */
    protected $eventIdentifier = ItemAdapter::class;

    public function getRepresentationClass()
    {
        return \ArkUrl\Api\Representation\ItemRepresentation::class;
    }
}

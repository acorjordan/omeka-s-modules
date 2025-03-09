<?php

namespace ArkUrl\Api\Adapter;

use Omeka\Api\Adapter\MediaAdapter;

class MediaAdapterDelegator extends MediaAdapter
{
    /**
     * This is used by EventManagerAwareTrait to add other identifiers to the
     * event manager
     */
    protected $eventIdentifier = MediaAdapter::class;

    public function getRepresentationClass()
    {
        return \ArkUrl\Api\Representation\MediaRepresentation::class;
    }
}

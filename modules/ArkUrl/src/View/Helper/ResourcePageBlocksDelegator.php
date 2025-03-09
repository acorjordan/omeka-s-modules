<?php

namespace ArkUrl\View\Helper;

use Omeka\View\Helper\ResourcePageBlocks;
use Omeka\Api\Representation;

class ResourcePageBlocksDelegator extends ResourcePageBlocks
{
    public function __invoke(Representation\AbstractResourceEntityRepresentation $resource, $regionName = 'main')
    {
        $this->resource = $resource;
        $this->regionName = $regionName;
        $this->resourceName = $resource->resourceName();

        if (!in_array($this->resourceName, ['items', 'item_sets', 'media'])) {
            throw new \Exception('Invalid resource');
        }

        return $this;
    }
}

<?php
namespace ItemSetParty\View\Helper;

use Laminas\View\Helper\AbstractHelper;

class ItemSetPartyResource extends AbstractHelper
{
    public function __invoke($side, $id, $resourceType)
    {
        $resource = $this->getView()->api()->read('resources', $id)->getContent();

        return $this->getView()->partial(
            "item-set-party/$side/item-set-party/resource",
            [
                'resource' => $resource,
                'resourceType' => $resourceType,
            ]
        );
    }
}

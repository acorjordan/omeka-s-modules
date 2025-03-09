<?php
namespace ItemSetParty\View\Helper;

use Laminas\View\Helper\AbstractHelper;

class ItemSetPartyTree extends AbstractHelper
{
    public function __invoke($side, $resourceRelations)
    {
        return $this->getView()->partial(
            "item-set-party/$side/item-set-party/tree",
            [
                'resourceRelations' => $resourceRelations,
            ]
        );
    }
}

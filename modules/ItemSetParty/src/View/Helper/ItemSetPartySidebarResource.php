<?php
namespace ItemSetParty\View\Helper;

use Laminas\View\Helper\AbstractHelper;

class ItemSetPartySidebarResource extends AbstractHelper
{
    public function __invoke()
    {
        return $this->getView()->partial(
            'item-set-party/admin/item-set-party/sidebar-resource',
        );
    }
}

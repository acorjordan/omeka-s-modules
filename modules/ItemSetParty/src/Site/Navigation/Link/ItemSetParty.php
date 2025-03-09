<?php

/*
 * Copyright 2020 BibLibre
 *
 * This file is part of ItemSetParty.
 *
 * ItemSetParty is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * ItemSetParty is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with ItemSetParty.  If not, see <https://www.gnu.org/licenses/>.
 */

namespace ItemSetParty\Site\Navigation\Link;

use Omeka\Api\Representation\SiteRepresentation;
use Omeka\Site\Navigation\Link\LinkInterface;
use Omeka\Stdlib\ErrorStore;

class ItemSetParty implements LinkInterface
{
    public function getName()
    {
        return 'Item Set Party'; // @translate
    }

    public function getLabel(array $data, SiteRepresentation $site)
    {
        return $data['label'] ? $data['label'] : null;
    }

    public function isValid(array $data, ErrorStore $errorStore)
    {
        return true;
    }

    public function getFormTemplate()
    {
        return 'item-set-party/navigation-link-form/item-set-party';
    }

    public function toZend(array $data, SiteRepresentation $site)
    {
        return [
            'label' => $data['label'],
            'route' => 'site/item-set-party',
            'params' => [
                'site-slug' => $site->slug(),
            ],
        ];
    }

    public function toJstree(array $data, SiteRepresentation $site)
    {
        return [
            'label' => $data['label'],
        ];
    }
}

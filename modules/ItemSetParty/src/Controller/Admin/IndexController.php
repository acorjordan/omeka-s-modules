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

namespace ItemSetParty\Controller\Admin;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Omeka\Stdlib\Message;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $idsFromModuleConfig = $this->settings()->get('itemsetparty_archival_item_sets');
        if (isset($idsFromModuleConfig)) {
            $view = new ViewModel();
            $resources = $this->itemSetParty()->getRelations($idsFromModuleConfig, 'item_sets');
            if (empty($resources)) {
                $itemSets = [];
                foreach ($idsFromModuleConfig as $id) {
                    $itemSet = $this->itemSetParty()->getResourceDetails($id, 'item_sets');
                    $itemSets[$id] = $itemSet;
                }
                return $this->viewError(
                    new Message(
                        'None relation found for this item set' //@translate
                    ),
                    false,
                    $itemSets
                );
            }
            $view->setVariable('resources', $resources);
            $view->setVariable('resourceType', 'item_sets');
            return $view;
        } else {
            return $this->viewError(
                new Message(
                    'None archival item set configured on module' //@translate
                ),
                true
            );
        }
    }

    public function getRelationsAction()
    {
        $params = $this->params()->fromRoute();
        $resourceId = $params['id'];
        $resourceType = $params['type'];
        $resourceRelations = $this->itemSetParty()->getRelations($resourceId, $resourceType);

        foreach ($resourceRelations as $relation) {
            $view = new ViewModel;
            $view->setTerminal(true);
            $view->setTemplate('item-set-party/admin/item-set-party/tree');
            $view->setVariable('resourceRelations', $relation);
            return $view;
        }
    }

    public function resourceDetailsAction()
    {
        $params = $this->params()->fromRoute();
        $resourceId = $params['id'];
        $resourceType = $params['type'];
        $resourceIcon = "o-icon-" . str_replace('_', '-', $resourceType);

        $typeMapping = [
            'item_sets' => 'item set',
            'items' => 'item',
            'media' => 'media',
        ];

        $resourceRepresentation = $this->itemSetParty()->getResourceDetails($resourceId, $resourceType);

        $view = new ViewModel;
        $view->setTerminal(true);
        $view->setTemplate('item-set-party/admin/item-set-party/resource-details');
        $view->setVariable('resource', $resourceRepresentation);
        $view->setVariable('resourceIcon', $resourceIcon);
        $view->setVariable('resourceTypeLabel', $typeMapping[$resourceType]);

        return $view;
    }

    protected function viewError($errorMessage, $isConfigError, $itemSets = null): ViewModel
    {
        $view = new ViewModel;
        $view->setVariable('message', $errorMessage);
        $view->setVariable('isConfigError', $isConfigError);
        if (isset($itemSets)) {
            $view->setVariable('itemSets', $itemSets);
        }
        return $view
            ->setTemplate('item-set-party/admin/error');
    }
}

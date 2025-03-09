<?php
namespace IdResolver\Controller\Site;

use Laminas\Mvc\Controller\AbstractActionController;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $id = $this->params()->fromQuery('id');
        $resource = $this->params()->fromQuery('resource');
        $property = $this->params()->fromQuery('property');

        $response = $this->getResponse();
        $site = $this->currentSite();

        // Validate parameters.
        switch ($resource) {
            case 'item':
                $resourceName = 'items';
                $controller = 'item';
                break;
            case 'item_set':
                $resourceName = 'item_sets';
                $controller = 'item-set';
                break;
            case 'media':
                $resourceName = 'media';
                $controller = 'media';
                break;
            default:
                return $response->setStatusCode(400)->setContent('Missing or invalid resource parameter');
        }
        if (!(is_string($id) && '' !== trim($id))) {
            return $response->setStatusCode(400)->setContent('Missing or invalid id parameter');
        }
        if (!(is_string($property) && '' !== trim($property))) {
            return $response->setStatusCode(400)->setContent('Missing or invalid property parameter');
        }

        // Query the resource.
        $searchQuery = [
            'site_id' => $site->id(),
            'property' => [
                [
                    'type' => 'eq',
                    'property' => $property,
                    'text' => $id,
                ],
            ],
        ];
        $resources = $this->api()->search($resourceName, $searchQuery)->getContent();

        if (0 === count($resources)) {
            // Resource not found.
            return $response->setStatusCode(404)->setContent('Resource not found');
        }
        if (1 === count($resources)) {
            // Redirect to the resource page.
            return $this->redirect()->toRoute('site/resource-id', [
                'site-slug' => $site->slug(),
                'controller' => $controller,
                'action' => 'show',
                'id' => $resources[0]->id(),
            ]);
        }
        // Redirect to the resource browse page.
        return $this->redirect()->toRoute('site/resource', [
            'site-slug' => $site->slug(),
            'controller' => $controller,
            'action' => 'browse',
        ], [
            'query' => $searchQuery,
        ]);
    }
}

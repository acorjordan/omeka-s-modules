<?php
namespace ItemSetParty\Mvc\Controller\Plugin;

use Omeka\Api\Manager as ApiManager;
use Laminas\Mvc\Controller\Plugin\AbstractPlugin;

class ItemSetParty extends AbstractPlugin
{
    protected $apiManager;

    public function __construct(ApiManager $apiManager)
    {
        $this->apiManager = $apiManager;
    }

    public function getRelations($resourcesIds, $resourceType)
    {
        $resourcesRepresentations = $this->apiManager->search($resourceType, ['id' => $resourcesIds])->getContent();
        $resourcesRelations = [];

        foreach ($resourcesRepresentations as $representation) {
            if (isset($representation->values()["dcterms:hasPart"])) {
                $resourcesRelations[$representation->id()]["dcterms:hasPart"] = $representation->values()["dcterms:hasPart"]['values'];
            }
        }
        return $resourcesRelations;
    }

    public function getResourceDetails($resourcesId, $resourceType)
    {
        $resourceRepresentation = $this->apiManager->search($resourceType, ['id' => $resourcesId])->getContent()[0];
        return $resourceRepresentation;
    }
}

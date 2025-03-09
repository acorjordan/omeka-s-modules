<?php

namespace ItemSetParty\Service\ControllerPlugin;

use Interop\Container\ContainerInterface;
use ItemSetParty\Mvc\Controller\Plugin\ItemSetParty;
use Laminas\ServiceManager\Factory\FactoryInterface;

class ItemSetPartyFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $services, $requestedName, array $options = null)
    {
        $apiManager = $services->get('Omeka\ApiManager');

        return new ItemSetParty($apiManager);
    }
}

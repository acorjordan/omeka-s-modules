<?php

namespace ArkUrl;

use Omeka\Module\AbstractModule;
use Zend\Mvc\MvcEvent;

class Module extends AbstractModule
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function onBootstrap(MvcEvent $event)
    {
        parent::onBootstrap($event);

        $acl = $this->getServiceLocator()->get('Omeka\Acl');

        $acl->addResource('ArkUrl\Api\Adapter\ItemAdapterDelegator', 'Omeka\Api\Adapter\ItemAdapter');
        $acl->addResource('ArkUrl\Api\Adapter\ItemSetAdapterDelegator', 'Omeka\Api\Adapter\ItemSetAdapter');
        $acl->addResource('ArkUrl\Api\Adapter\MediaAdapterDelegator', 'Omeka\Api\Adapter\MediaAdapter');
    }
}

<?php

namespace GuestRole;

use Omeka\Module\AbstractModule;
use Omeka\Module\Manager as ModuleManager;
use Laminas\Mvc\MvcEvent;

class Module extends AbstractModule
{
    const ROLE_GUEST = 'guest';

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function onBootstrap(MvcEvent $event)
    {
        parent::onBootstrap($event);

        $services = $this->getServiceLocator();
        $moduleManager = $services->get('Omeka\ModuleManager');
        $guestModule = $moduleManager->getModule('Guest');
        if (false === $guestModule || $guestModule->getState() !== ModuleManager::STATE_ACTIVE) {
            $this->addGuestRole();
        }
    }

    protected function addGuestRole()
    {
        $services = $this->getServiceLocator();
        $acl = $services->get('Omeka\Acl');
        if (!$acl->hasRole(self::ROLE_GUEST)) {
            $acl->addRole(self::ROLE_GUEST);
        }

        $roleLabels = $acl->getRoleLabels();
        if (!array_key_exists(self::ROLE_GUEST, $roleLabels)) {
            $acl->addRoleLabel(self::ROLE_GUEST, 'Guest'); // @translate
        }

        // This is allowed for everyone by default, but guest users should
        // never have access to admin
        $acl->deny(self::ROLE_GUEST, 'Omeka\Controller\SiteAdmin\Index');
        $acl->deny(self::ROLE_GUEST, 'Omeka\Controller\SiteAdmin\Page');
    }
}

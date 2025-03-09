<?php

namespace RedirectAfterLogin;

use Omeka\Module\AbstractModule;
use Zend\Session\Container;

class Module extends AbstractModule
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function attachListeners($sharedEventManager)
    {
        $sharedEventManager->attach(
            'Omeka\Controller\LoginController',
            'user.login',
            [$this, 'onUserLogin']
        );
    }

    public function onUserLogin($event)
    {
        $session = Container::getDefaultManager()->getStorage();
        $redirect_url = $session->offsetGet('redirect_url');

        if (!$redirect_url) {
            $acl = $this->getServiceLocator()->get('Omeka\Acl');
            $user = $event->getTarget();

            if (!$acl->isAllowed($user, 'Omeka\Controller\Admin\Index', 'browse')) {
                $session->offsetSet('redirect_url', '/');
            }
        }
    }
}

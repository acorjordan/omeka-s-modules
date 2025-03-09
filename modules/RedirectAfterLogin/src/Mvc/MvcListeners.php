<?php

namespace RedirectAfterLogin\Mvc;

use Zend\EventManager\AbstractListenerAggregate;
use Zend\EventManager\EventManagerInterface;
use Zend\Mvc\MvcEvent;
use Zend\Session\Container;

class MvcListeners extends AbstractListenerAggregate
{
    public function attach(EventManagerInterface $events, $priority = 1)
    {
        $this->listeners[] = $events->attach(
            MvcEvent::EVENT_ROUTE,
            [$this, 'setRedirectUrl']
        );
    }

    public function setRedirectUrl(MvcEvent $event)
    {
        $request = $event->getRequest();
        if (!$request->isGet()) {
            return;
        }

        $routeMatch = $event->getRouteMatch();
        if ('login' !== $routeMatch->getMatchedRouteName()) {
            return;
        }

        $redirect_url = $request->getQuery('redirect_url');
        if (!$redirect_url || 0 !== strpos($redirect_url, '/')) {
            return;
        }

        $services = $event->getApplication()->getServiceManager();
        $auth = $services->get('Omeka\AuthenticationService');
        if ($auth->hasIdentity()) {
            $response = $event->getResponse();

            $response->getHeaders()->addHeaderLine('Location', $redirect_url);
            $response->setStatusCode(302);
            $response->sendHeaders();

            return $response;
        }

        $session = Container::getDefaultManager()->getStorage();
        $session->offsetSet('redirect_url', $redirect_url);
    }
}

<?php declare(strict_types=1);

namespace Robots;

require_once __DIR__ . '/vendor/autoload.php';

use Common\TraitModule;
use Omeka\Module\AbstractModule;
use Laminas\Mvc\MvcEvent;

class Module extends AbstractModule
{
    const NAMESPACE = __NAMESPACE__;

    use TraitModule;
    
    /**
     * Get this module's configuration array.
     *
     * @return array
     */
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    /**
     * {@inheritDoc}
     * @see \Omeka\Module\AbstractModule::onBootstrap()
     */
    public function onBootstrap(MvcEvent $event) : void
    {
        parent::onBootstrap($event);

        $this->addAclRules();
    }

    protected function addAclRules() : void
    {
        /** @var \Omeka\Permissions\Acl $acl */
        $services = $this->getServiceLocator();
        $acl = $services->get('Omeka\Acl');

        // Allow anonymous users to access robots.txt
        $acl->allow(
            null,
            [
                \Robots\Controller\RobotsController::class
            ]
        );
    }
}

?>
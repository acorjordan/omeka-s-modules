<?php
namespace ArkUrl\Service\Delegator;

use ArkUrl\Api\Adapter\ItemAdapterDelegator;
use ArkUrl\Api\Adapter\ItemSetAdapterDelegator;
use ArkUrl\Api\Adapter\MediaAdapterDelegator;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\DelegatorFactoryInterface;
use Omeka\Api\Adapter\ItemAdapter;
use Omeka\Api\Adapter\ItemSetAdapter;
use Omeka\Api\Adapter\MediaAdapter;
use Omeka\Module\Manager as OmekaModuleManager;

class ApiAdapterDelegatorFactory implements DelegatorFactoryInterface
{
    protected $delegators = [
        ItemAdapter::class => ItemAdapterDelegator::class,
        ItemSetAdapter::class => ItemSetAdapterDelegator::class,
        MediaAdapter::class => MediaAdapterDelegator::class,
    ];

    public function __invoke(ContainerInterface $container, $name, callable $callback, array $options = null)
    {
        if (isset($this->delegators[$name])) {
            $moduleManager = $container->get('Omeka\ModuleManager');
            if ($this->moduleIsActive($moduleManager, 'Quark') || $this->moduleIsActive($moduleManager, 'Ark')) {
                $delegatorClass = $this->delegators[$name];
                return new $delegatorClass;
            }
        }

        return call_user_func($callback);
    }

    protected function moduleIsActive($moduleManager, $moduleName)
    {
        if (!$moduleManager->isRegistered($moduleName)) {
            return false;
        }

        return $moduleManager->getModule($moduleName)->getState() === OmekaModuleManager::STATE_ACTIVE;
    }
}

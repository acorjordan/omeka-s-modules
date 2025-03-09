<?php
namespace ArkUrl\Service\Delegator;

use ArkUrl\View\Helper\ResourcePageBlocksDelegator;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\DelegatorFactoryInterface;
use Omeka\Module\Manager as OmekaModuleManager;

class ViewHelperResourcePageBlocksDelegatorFactory implements DelegatorFactoryInterface
{
    public function __invoke(ContainerInterface $container, $name, callable $callback, array $options = null)
    {
        $moduleManager = $container->get('Omeka\ModuleManager');
        if ($this->moduleIsActive($moduleManager, 'Quark') || $this->moduleIsActive($moduleManager, 'Ark')) {
            $currentTheme = $container->get('Omeka\Site\ThemeManager')->getCurrentTheme();
            $blockLayoutManager = $container->get('Omeka\ResourcePageBlockLayoutManager');
            $resourcePageBlocks = $blockLayoutManager->getResourcePageBlocks($currentTheme);
            return new ResourcePageBlocksDelegator($blockLayoutManager, $resourcePageBlocks);
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

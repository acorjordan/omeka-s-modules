<?php declare(strict_types=1);

namespace BulkImport\Service\Stdlib;

use BulkImport\Stdlib\MetaMapperConfig;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class MetaMapperConfigFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $services, $requestedNamed, array $options = null)
    {
        $plugins = $services->get('ControllerPluginManager');
        return new MetaMapperConfig(
            $plugins->get('automapFields'),
            $plugins->get('bulk'),
            $services->get('Common\EasyMeta'),
            $services->get('Omeka\Logger')
        );
    }
}

<?php
namespace IdResolver;

use Omeka\Module\AbstractModule;

/**
 * An Omeka S module that resolves legacy IDs to Omeka S resources via an endpoint.
 */
class Module extends AbstractModule
{
    public function getConfig()
    {
        return include sprintf('%s/config/module.config.php', __DIR__);
    }
}

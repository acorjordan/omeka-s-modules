<?php declare(strict_types=1);

namespace SimplePdf;

use Omeka\Module\AbstractModule;

class Module extends AbstractModule
{
    /**
     * Get this module's configuration array.
     *
     * @return array
     */
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
}

?>
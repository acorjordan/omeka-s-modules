<?php
namespace Robots\Service\Controller;

use Robots\Controller\RobotsController;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;

class RobotsControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $services, $requestedName, array $options = null)
    {
        return new RobotsController($services->get('Omeka\Settings'));
    }
}
?>
<?php
namespace Solr\Service\Controller;

use Interop\Container\ContainerInterface;
use Solr\Controller\ApiController;
use Laminas\ServiceManager\Factory\FactoryInterface;

class ApiControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $services, $requestedName, array $options = null)
    {
        return new ApiController(
            $services->get('Omeka\Paginator'),
            $services->get('Omeka\ApiManager')
        );
    }
}

<?php declare(strict_types=1);

namespace Robots\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\Http\PhpEnvironment\Response;
use Omeka\Settings\Settings;

class RobotsController extends AbstractActionController
{
    /**
     * @var Omeka\Settings\Settings
     */
    protected $settings;
    
    public function __construct(Settings $settings)
    {
        $this->settings = $settings;
    }
    
    public function robotsAction() : Response
    {
        $content = $this->settings->get("robots_content");
        
        $response = $this->getResponse();
        $response->setContent($content);
        
        return $response;
    }
}
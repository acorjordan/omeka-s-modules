<?php
namespace FreeSpace;

use Omeka\Module\AbstractModule;
use Zend\EventManager\Event;
use Zend\EventManager\SharedEventManagerInterface;
use Zend\View\View;

class Module extends AbstractModule
{
    private $cssClass = "";

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    private function formattedDiskUsage() {
	    $bytes = disk_free_space(".");
	    $si_prefix = array( 'B', 'KB', 'MB', 'GB', 'TB', 'EB', 'ZB', 'YB' );
	    $base = 1024;
	    $class = min((int)log($bytes , $base) , count($si_prefix) - 1);

	    $gigaBytesWarningLimit = 15;

	    if ((int)$bytes < ($gigaBytesWarningLimit * $base * $base * $base)) {
	        $this->cssClass = "freeSpaceWarning";
	    }


        return sprintf('%1.2f' , $bytes / pow($base,$class)) . ' ' . $si_prefix[$class] . '';
    }

    public function attachListeners(SharedEventManagerInterface $sharedEventManager)
    {
        $sharedEventManager->attach(
            'Omeka\Controller\Admin\Index',
            'view.browse.after',
            function(Event $event) {
                print $event->getTarget()->partial("free-space-block",
                    [
                        "freeSpaceFormatted" => $this->formattedDiskUsage(),
                        "freeSpaceClass" => $this->cssClass
                    ]
                );
            }
        );
    }
}
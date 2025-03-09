<?php

namespace OaiPmhRepositoryMediaPropertyMapper;

use Laminas\EventManager\SharedEventManagerInterface;
use Laminas\EventManager\Event;
use Laminas\Mvc\Controller\AbstractController;
use Laminas\Mvc\MvcEvent;
use Laminas\ServiceManager\ServiceLocatorInterface;
use Laminas\View\Renderer\PhpRenderer;
use OaiPmhRepositoryMediaPropertyMapper\Form\ConfigForm;
use Omeka\Module\AbstractModule;

class Module extends AbstractModule
{
    public function getConfigForm(PhpRenderer $renderer)
    {
        $serviceLocator = $this->getServiceLocator();
        $settings = $serviceLocator->get('Omeka\Settings');
        $formElementManager = $serviceLocator->get('FormElementManager');

        $form = $formElementManager->get(ConfigForm::class);
        $form->setData([
            'oaipmhrepositorymediapropertymapper_config' => $settings->get('oaipmhrepositorymediapropertymapper_config', ''),
        ]);

        return $renderer->formCollection($form, false);
    }

    public function handleConfigForm(AbstractController $controller)
    {
        $serviceLocator = $this->getServiceLocator();
        $formElementManager = $serviceLocator->get('FormElementManager');
        $settings = $serviceLocator->get('Omeka\Settings');

        $form = $formElementManager->get(ConfigForm::class);
        $form->setData($controller->params()->fromPost());
        if (!$form->isValid()) {
            $controller->messenger()->addFormErrors($form);
            return false;
        }

        $formData = $form->getData();
        $settings->set('oaipmhrepositorymediapropertymapper_config', $formData['oaipmhrepositorymediapropertymapper_config']);

        return true; 
    }

    public function attachListeners(SharedEventManagerInterface $sharedEventManager)
    {
        $sharedEventManager->attach(\OaiPmhRepository\OaiPmh\Metadata\AbstractMetadata::class, 'oaipmhrepository.values.pre', [$this, 'onOaipmhrepositoryValuesPre']);
    }

    public function getConfig()
    {
        return require __DIR__ . '/config/module.config.php';
    }

    public function onOaipmhrepositoryValuesPre(Event $event)
    {
        $settings = $this->getServiceLocator()->get('Omeka\Settings');

        $values = $event->getParam('values');
        $resource = $event->getParam('resource');

        if (!$resource instanceof \Omeka\Api\Representation\ItemRepresentation) {
            return;
        }
        $item = $resource;

        $config = parse_ini_string($settings->get('oaipmhrepositorymediapropertymapper_config', ''));
        if ($config === false) {
            $this->getServiceLocator()->get('Omeka\Logger')->err('OaiPmhRepositoryMediaPropertyMapper: Configuration cannot be parsed');
            return;
        }

        if (empty($config)) {
            return;
        }

        foreach ($item->media() as $media) {
            foreach ($config as $mediaPropertyTerm => $itemPropertyTerm) {
                $mediaValues = $media->value($mediaPropertyTerm, ['all' => true, 'default' => []]);
                $values[$itemPropertyTerm] ??= [];
                $values[$itemPropertyTerm]['values'] ??= [];
                $values[$itemPropertyTerm]['values'] = array_merge($values[$itemPropertyTerm]['values'], $mediaValues);
            }
        }

        $event->setParam('values', $values);
    }
}

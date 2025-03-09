<?php

namespace ItemSetParty;

use Omeka\Module\AbstractModule;
use Laminas\EventManager\SharedEventManagerInterface;
use Laminas\Mvc\Controller\AbstractController;
use Laminas\EventManager\Event;
use Laminas\Mvc\MvcEvent;
use Laminas\View\Renderer\PhpRenderer;
use ItemSetParty\Form\ConfigForm;

class Module extends AbstractModule
{
    public function onBootstrap(MvcEvent $event)
    {
        parent::onBootstrap($event);

        $acl = $this->getServiceLocator()->get('Omeka\Acl');
        $acl
            ->allow(
                null,
                [
                    "ItemSetParty\Controller\Site\Index",
                ]
            );
    }

    public function getConfigForm(PhpRenderer $renderer)
    {
        $settings = $this->getServiceLocator()->get('Omeka\Settings');
        $archival_item_sets = $settings->get('itemsetparty_archival_item_sets', '[]');

        $form = $this->getServiceLocator()->get('FormElementManager')->get(ConfigForm::class);
        $form->init();
        $form->setData([
            'archival_item_sets' => $archival_item_sets,
        ]);

        return $renderer->formCollection($form, false);
    }

    public function handleConfigForm(AbstractController $controller)
    {
        $settings = $this->getServiceLocator()->get('Omeka\Settings');
        $form = $this->getServiceLocator()->get('FormElementManager')->get(ConfigForm::class);
        $form->init();
        $form->setData($controller->params()->fromPost());
        if (!$form->isValid()) {
            $controller->messenger()->addErrors($form->getMessages());
            return false;
        }
        $formData = $form->getData();
        $settings->set('itemsetparty_archival_item_sets', $formData['archival_item_sets']);

        return true;
    }

    public function attachListeners(SharedEventManagerInterface $sharedEventManager)
    {
        $sharedEventManager->attach('*', 'view.layout', function (Event $event) {
            $view = $event->getTarget();
            $view->headLink()->appendStylesheet($view->assetUrl('css/item-set-party.css', 'ItemSetParty'));
        });
    }

    public function getConfig()
    {
        return require __DIR__ . '/config/module.config.php';
    }

    public function onSiteSettingsFormAddElements(Event $event)
    {
        $services = $this->getServiceLocator();
        $forms = $services->get('FormElementManager');
        $siteSettings = $services->get('Omeka\Settings\Site');

        $fieldset = $forms->get(SiteSettingsFieldset::class);
        $fieldset->populateValues([
            'itemsetparty_display' => $siteSettings->get('itemsetparty_display', 'all'),
        ]);

        $form = $event->getTarget();

        $groups = $form->getOption('element_groups');
        if (isset($groups)) {
            $groups['itemsetparty'] = $fieldset->getLabel();
            $form->setOption('element_groups', $groups);
            foreach ($fieldset->getElements() as $element) {
                $form->add($element);
            }
        } else {
            $form->add($fieldset);
        }
    }
}

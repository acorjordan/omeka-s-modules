<?php
namespace ViewPrivateResources;

use Omeka\Module\AbstractModule;
use Laminas\Form;
use Laminas\Mvc\Controller\AbstractController;
use Laminas\Mvc\MvcEvent;
use Laminas\View\Renderer\PhpRenderer;

class Module extends AbstractModule
{
    public function getConfig()
    {
        return [
            'translator' => [
                'translation_file_patterns' => [
                    [
                        'type' => 'gettext',
                        'base_dir' => sprintf('%s/../language', __DIR__),
                        'pattern' => '%s.mo',
                    ],
                ],
            ],
        ];
    }

    public function onBootstrap(MvcEvent $event)
    {
        parent::onBootstrap($event);

        $settings = $this->getServiceLocator()->get('Omeka\Settings');
        $acl = $this->getServiceLocator()->get('Omeka\Acl');

        if ($settings->get('view_private_resources_researcher')) {
            $acl->allow(
                'researcher',
                'Omeka\Entity\Resource',
                'view-all'
            );
        }
        if ($settings->get('view_private_resources_author')) {
            $acl->allow(
                'author',
                'Omeka\Entity\Resource',
                'view-all'
            );
        }
    }

    public function getConfigForm(PhpRenderer $view)
    {
        $settings = $this->getServiceLocator()->get('Omeka\Settings');
        $form = new Form\Form;
        $form->add([
            'type' => Form\Element\Checkbox::class,
            'name' => 'view_private_resources_researcher',
            'options' => [
                'label' => 'Allow researchers to view private resources', // @translate
            ],
            'attributes' => [
                'value' => (bool) $settings->get('view_private_resources_researcher', 0),
            ],
        ]);
        $form->add([
            'type' => Form\Element\Checkbox::class,
            'name' => 'view_private_resources_author',
            'options' => [
                'label' => 'Allow authors to view private resources', // @translate
            ],
            'attributes' => [
                'value' => (bool) $settings->get('view_private_resources_author', 0),
            ],
        ]);
        return $view->formCollection($form, false);
    }

    public function handleConfigForm(AbstractController $controller)
    {
        $settings = $this->getServiceLocator()->get('Omeka\Settings');
        $post = $controller->params()->fromPost();
        $settings->set('view_private_resources_researcher', $post['view_private_resources_researcher']);
        $settings->set('view_private_resources_author', $post['view_private_resources_author']);
    }
}

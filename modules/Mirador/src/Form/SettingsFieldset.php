<?php declare(strict_types=1);

namespace Mirador\Form;

use Laminas\Form\Element;
use Laminas\Form\Fieldset;
use Mirador\Form\Element as MiradorElement;

class SettingsFieldset extends Fieldset
{
    protected $label = 'Mirador IIIF Viewer'; // @translate

    protected $elementGroups = [
        // "Player" is used instead of viewer, because "viewer" is used for a site
        // user role and cannot be translated differently (no context).
        // Player is polysemic too anyway, but less used and more adapted for
        // non-image viewers.
        'player' => 'Players', // @translate
    ];

    /**
     * @var array
     */
    protected $plugins = [];

    /**
     * @var array
     */
    protected $plugins2 = [];

    public function init(): void
    {
        $this
            ->setAttribute('id', 'mirador')
            ->setOption('element_groups', $this->elementGroups)
            ->add([
                'name' => 'mirador_version',
                'type' => Element\Radio::class,
                'options' => [
                    'element_group' => 'player',
                    'label' => 'Mirador version', // @translate
                    'value_options' => [
                        '2' => '2.7 (deprecated)', // @translate
                        '3' => '3.0 and above', // @translate
                    ],
                ],
                'attributes' => [
                    'id' => 'mirador_version',
                ],
            ])

            ->add([
                'name' => 'mirador_plugins_2',
                'type' => MiradorElement\OptionalSelect::class,
                'options' => [
                    'element_group' => 'player',
                    'label' => 'Mirador plugins for v2',
                    'info' => 'Some plugins require json options to work. Cross compatibility has not been checked, so add them one by one and only the needed ones.', // @translate
                    'documentation' => 'https://github.com/daniel-km/omeka-s-module-mirador#plugins',
                    'value_options' => $this->getPlugins2(),
                    'empty_option' => '',
                    'use_hidden_element' => true,
                    'disable_inarray_validator' => true,
                ],
                'attributes' => [
                    'id' => 'mirador_plugins_2',
                    'class' => 'chosen-select',
                    'multiple' => true,
                    'data-placeholder' => 'Select plugins…', // @translate
                ],
            ])
            ->add([
                'name' => 'mirador_config_item_2',
                'type' => Element\Textarea::class,
                'options' => [
                    'element_group' => 'player',
                    'label' => 'Mirador json config for v2 (item)', // @translate
                    'info' => 'This json object will be merged with the default one generated by the module. Placeholders: {manifestUri} and {canvasID}.', // @translate
                    'documentation' => 'https://github.com/daniel-km/omeka-s-module-mirador#usage',
                ],
                'attributes' => [
                    'id' => 'mirador_config_item_2',
                ],
            ])
            ->add([
                'name' => 'mirador_config_collection_2',
                'type' => Element\Textarea::class,
                'options' => [
                    'element_group' => 'player',
                    'label' => 'Mirador json config for v2 (collection)', // @translate
                    'info' => 'Iiif collections are Omeka item sets, but may be search results too.',
                ],
                'attributes' => [
                    'id' => 'mirador_config_collection_2',
                ],
            ])

            ->add([
                'name' => 'mirador_plugins',
                'type' => MiradorElement\OptionalSelect::class,
                'options' => [
                    'element_group' => 'player',
                    'label' => 'Mirador plugins for v3',
                    'info' => 'Some plugins require json options to work. Cross compatibility has not been checked, so add them one by one and only the needed ones.', // @translate
                    'documentation' => 'https://github.com/daniel-km/omeka-s-module-mirador#plugins',
                    'value_options' => $this->getPlugins(),
                    'empty_option' => '',
                    'use_hidden_element' => true,
                    'disable_inarray_validator' => true,
                ],
                'attributes' => [
                    'id' => 'mirador_plugins',
                    'class' => 'chosen-select',
                    'multiple' => true,
                    'data-placeholder' => 'Select plugins…', // @translate
                ],
            ])
            ->add([
                'name' => 'mirador_config_item',
                'type' => Element\Textarea::class,
                'options' => [
                    'element_group' => 'player',
                    'label' => 'Mirador config as object string for v3 (item)', // @translate
                    'info' => 'This object will be merged with the default one generated by the module.', // @translate
                    'documentation' => 'https://github.com/daniel-km/omeka-s-module-mirador#usage',
                ],
                'attributes' => [
                    'id' => 'mirador_config_item',
                ],
            ])
            ->add([
                'name' => 'mirador_config_collection',
                'type' => Element\Textarea::class,
                'options' => [
                    'element_group' => 'player',
                    'label' => 'Mirador config as object string for v3 (collection)', // @translate
                    'info' => 'Iiif collections are Omeka item sets, but may be search results too.',
                ],
                'attributes' => [
                    'id' => 'mirador_config_collection',
                ],
            ])
            ->add([
                'name' => 'mirador_annotation_endpoint',
                'type' => MiradorElement\OptionalUrl::class,
                'options' => [
                    'element_group' => 'player',
                    'label' => 'Endpoint to store annotations externally', // @translate
                    'info' => 'This option is used only if the plugin Annotations is enabled, and useful only with an external annotation server.', // @translate
                ],
                'attributes' => [
                    'id' => 'mirador_annotation_endpoint',
                ],
            ])

            ->add([
                'name' => 'mirador_preselected_items',
                'type' => Element\Number::class,
                'options' => [
                    'element_group' => 'player',
                    'label' => 'Preselect manifests from the same collection', // @translate
                    'info' => 'Set a number of items to preselect. IiifServer should be enabled.', // @translate
                ],
                'attributes' => [
                    'id' => 'mirador_preselected_items',
                    'min' => 0,
                    'max' => 999,
                ],
            ])
        ;
    }

    public function setPlugins(array $plugins): self
    {
        $this->plugins = $plugins;
        return $this;
    }

    public function getPlugins(): array
    {
        return $this->plugins;
    }

    public function setPlugins2(array $plugins): self
    {
        $this->plugins2 = $plugins;
        return $this;
    }

    public function getPlugins2(): array
    {
        return $this->plugins2;
    }
}

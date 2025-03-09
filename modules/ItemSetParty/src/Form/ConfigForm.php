<?php
namespace ItemSetParty\Form;

use Laminas\Form\Form;
use Omeka\Form\Element\ItemSetSelect;

class ConfigForm extends Form
{
    public function init()
    {
        $this->add([
            'type' => ItemSetSelect::class,
            'name' => 'archival_item_sets',
            'attributes' => [
                'id' => 'select-item-set',
                'class' => 'chosen-select',
                'multiple' => true,
                'data-placeholder' => 'Select archival item sets', // @translate
            ],
            'options' => [
                'label' => 'Archival item sets', // @translate
                'resource_value_options' => [
                    'resource' => 'item sets',
                ],
            ],
        ]);

        $inputFilter = $this->getInputFilter();
        $inputFilter->add([
            'name' => 'archival_item_sets',
            'allow_empty' => true,
        ]);
    }
}

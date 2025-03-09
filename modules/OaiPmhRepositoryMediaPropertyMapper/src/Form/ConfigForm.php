<?php

namespace OaiPmhRepositoryMediaPropertyMapper\Form;

use Laminas\Form\Element\Textarea;
use Laminas\Form\Form;

class ConfigForm extends Form
{
    public function init()
    {
        $this->add([
            'name' => 'oaipmhrepositorymediapropertymapper_config',
            'type' => Textarea::class,
            'options' => [
                'label' => 'Configuration', // @translate
                'info' => 'Configure which media property should go into which item property. One mapping per line', // @translate
            ],
            'attributes' => [
                'placeholder' => "dcterms:title = dcterms:alternative\ndcterms:subject = dcterms:subject",
                'rows' => 10,
            ],
        ]);
    }
}

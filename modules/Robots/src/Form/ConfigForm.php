<?php
namespace Robots\Form;

use Laminas\Form\Form;
use Laminas\Form\Element;

class ConfigForm extends Form
{
    protected $label = 'Robots';
    
    public function init()
    {
        $this->add([
            'name' => 'robots_content',
            'type' => Element\Textarea::class,
            'options' => [
                'label' => 'Robots.txt content',
            ],
            'attributes' => [
                'id' => 'robots_content',
                'rows' => '15',
            ],
        ]);
    }
}

?>
<?php

namespace ItemSetParty\Site\BlockLayout;

use Laminas\View\Renderer\PhpRenderer;
use Laminas\Form\Element\Text;
use Laminas\Form\Element\Number;
use Laminas\Form\Form;
use Omeka\Api\Representation\SitePageBlockRepresentation;
use Omeka\Api\Representation\SitePageRepresentation;
use Omeka\Api\Representation\SiteRepresentation;
use Omeka\Site\BlockLayout\AbstractBlockLayout;

class ItemSetParty extends AbstractBlockLayout
{
    public function getLabel()
    {
        return 'Item Set Party'; // @translate
    }

    public function form(
        PhpRenderer $view,
        SiteRepresentation $site,
        SitePageRepresentation $page = null,
        SitePageBlockRepresentation $block = null
    ) {
        $defaults = [
            'heading' => '',
            'depth' => 1,
        ];

        $data = $block ? $block->data() + $defaults : $defaults;

        $form = new Form();
        $form->add([
            'name' => 'o:block[__blockIndex__][o:data][heading]',
            'type' => Text::class,
            'options' => [
                'label' => 'Block title', // @translate
            ],
            'attributes' => [
                'id' => 'item-set-party-heading',
            ],
        ]);
        $form->add([
            'name' => 'o:block[__blockIndex__][o:data][depth]',
            'type' => Number::class,
            'options' => [
                'label' => 'Depth', // @translate
            ],
            'attributes' => [
                'id' => 'item-set-party-depth',
                'min' => 1,
            ],
        ]);

        $form->setData([
            'o:block[__blockIndex__][o:data][heading]' => $data['heading'],
            'o:block[__blockIndex__][o:data][depth]' => $data['depth'],
        ]);

        return $view->formCollection($form);
    }

    public function render(PhpRenderer $view, SitePageBlockRepresentation $block)
    {
        $idsFromSettings = $view->setting('itemsetparty_archival_item_sets');
        if (isset($idsFromSettings)) {
            foreach ($idsFromSettings as $id) {
                $resourcesRepresentations[$id] = $this->getResourceRepresentation($view, $id, 'item_sets');
            }
        }
        $data = $block->data() + ['resourcesFromConfig' => $resourcesRepresentations];

        return $view->partial('common/block-layout/item-set-party', $data);
    }

    private function getResourceRepresentation($view, $id, $resourceType)
    {
        $resourceRepresentation = $view->api()->read($resourceType, ['id' => $id])->getContent();
        return $resourceRepresentation;
    }
}

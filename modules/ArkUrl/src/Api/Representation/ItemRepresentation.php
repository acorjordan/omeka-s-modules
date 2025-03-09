<?php

namespace ArkUrl\Api\Representation;

class ItemRepresentation extends \Omeka\Api\Representation\ItemRepresentation
{
    /**
     * This is used by EventManagerAwareTrait to add other identifiers to the
     * event manager
     */
    protected $eventIdentifier = \Omeka\Api\Representation\ItemRepresentation::class;

    public function siteUrl($siteSlug = null, $canonical = false)
    {
        $arkUrl = $this->getViewHelper('arkUrl');
        $siteUrl = $arkUrl->siteUrl($this, $siteSlug, $canonical);
        if (!$siteUrl) {
            $siteUrl = parent::siteUrl($siteSlug, $canonical);
        }

        return $siteUrl;
    }
}

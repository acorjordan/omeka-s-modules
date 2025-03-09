<?php

namespace ArkUrl\Api\Representation;

class MediaRepresentation extends \Omeka\Api\Representation\MediaRepresentation
{
    /**
     * This is used by EventManagerAwareTrait to add other identifiers to the
     * event manager
     */
    protected $eventIdentifier = \Omeka\Api\Representation\MediaRepresentation::class;

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

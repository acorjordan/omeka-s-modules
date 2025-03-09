<?php

namespace ArkUrl\View\Helper;

use Laminas\View\Helper\AbstractHelper;
use Omeka\Api\Representation\AbstractResourceEntityRepresentation;

class ArkUrl extends AbstractHelper
{
    public function siteUrl(AbstractResourceEntityRepresentation $resource, $siteSlug = null, $canonical = false)
    {
        $identifiers = $resource->value('dcterms:identifier', ['type' => 'literal', 'all' => true]);
        $ark = null;
        foreach ($identifiers as $identifier) {
            if (0 === strncmp($identifier, 'ark:/', 5)) {
                $ark = $identifier;
                break;
            }
        }

        if ($ark) {
            $params = [];
            if ($siteSlug) {
                $params['site-slug'] = $siteSlug;
            }
            $reuseMatchedParams = true;

            $siteUrl = $this->getView()->url('site', $params, ['force_canonical' => $canonical], $reuseMatchedParams);
            return $siteUrl . '/' . $ark;
        }
    }
}

<?php declare(strict_types=1);

namespace SimplePdf\Media\FileRenderer;

use Laminas\View\Renderer\PhpRenderer;
use Omeka\Api\Representation\MediaRepresentation;
use Omeka\Media\FileRenderer\RendererInterface;

class PdfRenderer implements RendererInterface
{
    /**
     * The default partial view script.
     */
    const PARTIAL_NAME = 'common/pdf-embed';

    public function render(PhpRenderer $view, MediaRepresentation $media, array $options = [])
    {
        $template = $options['template'] ?? self::PARTIAL_NAME;
        return $view->partial($template, [
            'media' => $media
        ]);
    }
}
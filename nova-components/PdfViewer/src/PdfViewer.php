<?php

namespace Elezerk\PdfViewer;

use Laravel\Nova\ResourceTool;

class PdfViewer extends ResourceTool
{
    /**
     * Get the displayable name of the resource tool.
     *
     * @return string
     */
    public function name()
    {
        return 'Pdf Viewer';
    }

    /**
     * Get the component name for the resource tool.
     *
     * @return string
     */
    public function component()
    {
        return 'pdf-viewer';
    }
}

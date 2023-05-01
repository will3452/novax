<?php

namespace Nsct\ImportAndExport;

use Laravel\Nova\Nova;
use Laravel\Nova\Tool;

class ImportAndExport extends Tool
{
    /**
     * Perform any tasks that need to happen when the tool is booted.
     *
     * @return void
     */
    public function boot()
    {
        Nova::script('import-and-export', __DIR__.'/../dist/js/tool.js');
        Nova::style('import-and-export', __DIR__.'/../dist/css/tool.css');
    }

    /**
     * Build the view that renders the navigation links for the tool.
     *
     * @return \Illuminate\View\View
     */
    public function renderNavigation()
    {
        return view('import-and-export::navigation');
    }
}

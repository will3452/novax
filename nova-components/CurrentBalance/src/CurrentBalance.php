<?php

namespace Elezerk\CurrentBalance;

use Laravel\Nova\Card;

class CurrentBalance extends Card
{
    /**
     * The width of the card (1/3, 1/2, or full).
     *
     * @var string
     */
    public $width = '1/3';

    public $balance = 0;

    /**
     * Get the component name for the element.
     *
     * @return string
     */
    public function component()
    {
        return 'current-balance';
    }
}

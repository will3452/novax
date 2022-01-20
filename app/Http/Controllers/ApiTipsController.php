<?php

namespace App\Http\Controllers;

use App\Models\Tip;
use Illuminate\Http\Request;

class ApiTipsController extends Controller
{
    public function tip()
    {
        return [
            'tip' => Tip::whereType(Tip::TYPE_TIP)->inRandomOrder()->first(),
        ];
    }

    public function quote()
    {
        return [
            'quote' => Tip::whereType(Tip::TYPE_QUOTES)->inRandomOrder()->first(),
        ];
    }
}

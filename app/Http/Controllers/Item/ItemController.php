<?php

namespace App\Http\Controllers\Item;

use App\Http\Controllers\Controller;
use App\Models\Item;

class ItemController extends Controller
{
    public function show(Item $item)
    {
        return view('items.show', compact('item'));
    }
}

<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function list()
    {
        $products = Product::all();
        return Inertia::render('Product/list',[
            'data' => $products
        ]);
    }
}

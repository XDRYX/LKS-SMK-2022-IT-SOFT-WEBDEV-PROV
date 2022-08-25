<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ShopController extends Controller
{
    public function index()
    {
        $response = Http::get(env("API_ENDPOINT") . "/product");
        if ($response->ok()) {
            $product = $response->collect()['success']['data'];
            return view("pages.shop", ["products" => $product]);
        }
    }
}

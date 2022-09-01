<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $response = Http::get(env("API_ENDPOINT") . "/product");
        if ($response->ok()) {

            // to collection
            $product = collect($response->collect()['success']['data']);

            // if has serch query
            if ($request->has("search")) {
                $product = $product->where("name", $request->search);
                return view("pages.shop", ["products" => $product]);
            }
            // if not have
            return view("pages.shop", ["products" => $product]);
        }
    }
}

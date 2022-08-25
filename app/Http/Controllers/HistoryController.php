<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HistoryController extends Controller
{
    public function index(Request $request)
    {
        $response = Http::get(env("API_ENDPOINT") . "/order");
        $customerID = $request->session()->get("CustomerID");
        if ($response->ok()) {
            $historyCartByUser = collect($response->collect()['success']['data'])->where('id_customer', $customerID);
            return view('pages.historyorder', ['histories' => $historyCartByUser]);
        }
    }
}

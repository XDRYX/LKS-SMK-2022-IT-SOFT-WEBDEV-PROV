<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CartController extends Controller
{
    public function indexAddToCart(Request $request, int $productid)
    {
        $response = Http::get(env("API_ENDPOINT") . "/product/{$productid}");
        if ($response->ok()) {
            return view('pages.addtocart', [
                'product' => $response->collect()['success']['data']
            ]);
        }
    }

    public function indexCart(Request $request)
    {
        $carts = $request->session()->get("CartList");
        $product = [];
        $subtotal = 0;
        $fee = 0;
        if ($carts) {
            foreach ($carts as $cart) {
                $response = Http::get(env("API_ENDPOINT") . "/product/{$cart['productID']}");
                if ($response->ok()) {
                    $product[] = $response->collect()['success']['data'];
                }
            }
            if ($product) {
                foreach ($product as $item) {
                    $itemqty = collect($carts)->where('productID', $item['id_product'])->first()['productQty'];
                    $subtotal += $item['price'] * $itemqty;
                }
            }
            if ($subtotal != 0) {
                $fee = $subtotal * 0.05;
            }
        }
        return view('pages.cart', [
            'carts' => collect($carts),
            'products' => $carts ? $product : [],
            'subtotal' => $subtotal,
            'fee' => $fee,
            'total' => $subtotal + $fee,
        ]);
    }

    public function addToCart(Request $request, int $productid)
    {
        $cart = [];
        $cart = $request->session()->get("CartList");
        if ($cart && is_array($cart)) {
            foreach ($cart as $index => $item) {
                if ($cart[$index]['productID'] == $productid) {
                    $oldqty = $item['productQty'];
                    unset($cart[$index]);
                    $cart[] = [
                        'productID' => $productid,
                        'productQty' => $request->productQty + $oldqty,
                    ];
                } else {
                    $cart[] = [
                        'productID' => $productid,
                        'productQty' => $request->productQty,
                    ];
                }
            }
        } else {
            $cart[] = [
                'productID' => $productid,
                'productQty' => $request->productQty,
            ];
        }

        $request->session()->put("CartList", $cart);
        $request->session()->save();
        return redirect(route('view.cart'));
    }

    public function removeFromCart(int $index, Request $request)
    {
        $cart = $request->session()->get("CartList");
        unset($cart[$index]);
        $request->session()->put("CartList", $cart);
        $request->session()->save();
        return back();
    }

    public function order(Request $request)
    {
        $userID = $request->session()->get("CustomerID");
        $cartList = $request->session()->get("CartList");
        $response = null;
        foreach ($cartList as $cart) {
            $response = Http::post(env("API_ENDPOINT") . "/order", [
                'id_customer' => $userID,
                'id_product' => $cart['productID'],
                'order_date' => date("Y-m-d"),
                'order_qty' => $cart['productQty'],
            ]);
        }
        if ($response->ok()) {
            $request->session()->put("CartList", []);
            $request->session()->save();
            return back()->with("checkout.success", "<script>
            swal({
                title: 'Good job!',
                text: '" . $response->collect()['success']['message'] . "',
                icon: 'success',
            });
        </script>");
        }
    }
}

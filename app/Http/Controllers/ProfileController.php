<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerCreateRequest;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        return view('pages.profile', [
            'user' => $request->session()->get('user'),
        ]);
    }

    public function update(ProfileUpdateRequest $request) {
        $credential = [
            'first_name' => $request->first_name,
            'last_name' =>$request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => md5($request->password),
            'address' => $request->address,
        ];
        $userID = $request->session()->get("CustomerID");
        $response = Http::put(env("API_ENDPOINT") . "/customer/{$userID}", $credential);
        if($response->ok()) {
            return back()->with('update.success', "<script>
            swal({
                title: 'Good job!',
                text: '" . $response->collect()['success']['message'] . "',
                icon: 'success',
            });
        </script>");
        }
    }
}

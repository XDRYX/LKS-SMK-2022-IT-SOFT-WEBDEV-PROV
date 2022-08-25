<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function indexLogin()
    {
        return view('pages.authentication.login');
    }

    public function indexRegister()
    {
        return view('pages.authentication.register');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required'],
            // 'password' => ['required'],
        ]);
        // fetch all data
        $response = Http::get(env("API_ENDPOINT") . "/customer");
        if ($response->ok()) {
            // convert to collection
            $customer_data = collect($response->collect()['success']['data']);
            // check if credential available
            $findCustomer = $customer_data->where('email', $request->email)->first();
            if ($findCustomer) {
                // if true login

                $request->session()->put("CustomerID", $findCustomer['id_customer']);
                $request->session()->put("user", $findCustomer);
                $request->session()->save();
                return redirect(route('view.home'))->with("login.success", "<script>
            swal({
                title: 'Good job!',
                text: '" . $response->collect()['success']['message'] . "',
                icon: 'success',
            });
        </script>");
            } else {
                return back()->with("notfound", "<script>
                swal({
                    title: 'Good job!',
                    text: 'Credential not found',
                    icon: 'error',
                });
            </script>");
            }
        }
    }

    public function logout(Request $request) {
        $request->session()->remove("CustomerID");
        $request->session()->remove("CartList");
        $request->session()->remove("user");
        $request->session()->regenerate();
        $request->session()->save();
        return redirect(route('view.login'))->with('logout.success', "<script>
        swal({
            title: 'Good job!',
            text: 'Logout Successfuly',
            icon: 'success',
        });
    </script>");
    }

    public function register(RegisterUserRequest $request)
    {
        $response = Http::post(env("API_ENDPOINT") . "/register", $request->validated());
        if ($response->ok()) {
            return redirect(route('login.user'))->with("register.success", "<script>
            swal({
                title: 'Good job!',
                text: '" . $response->collect()['success']['message'] . "',
                icon: 'success',
            });
        </script>");
        }
    }
}

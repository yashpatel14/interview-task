<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $result["defaultPrice"] = 999;
        $result["loggedIn"] = $request->session()->has('USER_LOGIN');
        if ($result["loggedIn"]) {
            $result["price"] = 649;
            $result["cutOfPrice"] = $result["defaultPrice"] - $result["price"];
            $result["discount"] = round((($result["defaultPrice"] - $result["price"]) / $result["defaultPrice"]) * 100);
        } else {
            $result["price"] = $result["defaultPrice"];
        }

        return view('front.index', $result);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function login()
    {
        return view('front.login');
    }


    function getUserTempId()
    {
        if (!session()->has('USER_TEMP_ID')) {
            $rand = rand(111111111, 999999999);
            session()->put('USER_TEMP_ID', $rand);
            return $rand;
        } else {
            return session()->get('USER_TEMP_ID');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function loginProcess(Request $request)
    {
        $userCheck = User::where('email', $request->email)->first();

        if ($userCheck) {
            if (Hash::check($request->password, $userCheck->password)) {
                $request->session()->put('USER_LOGIN', true);
                $request->session()->put('USER_ID', $userCheck->id);
                $request->session()->put('USER_NAME', $userCheck->name);


                $getUserTempId = $this->getUserTempId();
                Cart::where('user_id', $getUserTempId)
                    ->update(['user_id' => $userCheck->id]);


                return redirect('/')->with('success', 'Logged in successfully!');
            }
            return redirect()->back()->with('error', 'Please Enter Valid Login Details');
        }
    }
}

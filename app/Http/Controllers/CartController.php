<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     function getUserTempId(){
        if(!session()->has('USER_TEMP_ID')){
            $rand=rand(111111111,999999999);
            session()->put('USER_TEMP_ID',$rand);
            return $rand;
        }else{
            return session()->get('USER_TEMP_ID');
        }
    }

    public function addToCart(Request $request)
{
    if($request->session()->has('USER_LOGIN')){
        $userId=$request->session()->get('USER_ID');

    }else{
        $userId=$this->getUserTempId();
    }


    $cart=new Cart();
    $cart->user_id=$userId;
    $cart->qty=$request->qty;
    $cart->price=$request->price;
    $cart->save();

    return response()->json(['status' => 'success']);
}

    /**
     * Show the form for creating a new resource.
     */
    public function cartCount(Request $request)
{
    if($request->session()->has('USER_LOGIN')){
        $userId=$request->session()->get('USER_ID');

    }else{
        $userId=$this->getUserTempId();
    }


    $count = Cart::where('user_id', $userId)->count();

    return response()->json(['count' => $count]);
}

    /**
     * Store a newly created resource in storage.
     */
    public function cart(Request $request)
    {
        if($request->session()->has('USER_LOGIN')){
            $userId=$request->session()->get('USER_ID');

        }else{
            $userId=$this->getUserTempId();
        }

        $result["cart"]=Cart::where('user_id', $userId)->get();

        return view('front.cart',$result);
    }

    public function updateQty(Request $request)
{
    $cart = Cart::find($request->id);

    if ($cart) {
        $cart->qty = $request->qty;
        $cart->save();
        return response()->json(['status' => 'success']);
    }

    return response()->json(['status' => 'error', 'message' => 'Cart item not found'], 404);
}


    public function delete($id)
    {
        $cart=Cart::where("id",$id)->delete();

        return redirect()->back()->with('success', 'Cart Item Deleted successfully!');
    }
}

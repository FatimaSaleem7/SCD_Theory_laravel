<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
class PageController extends Controller
{
    
    public function home() {
        return view('pages.home'); // include the folder name
    }

    public function departments() {
        return view('pages.departments');
    }

    public function medicines() {
        return view('pages.medicines');
    }

   public function medicinedetail($id)
{
    $product = Medicine::findOrFail($id);
    return view('pages.medicinedetail', compact('product'));
}


    public function contact() {
        return view('pages.contact');
    }

    public function cart() {
        return view('pages.cart');
    }

    public function checkout() {
        return view('pages.checkout');
    }

    public function login() {
        return view('pages.login');
    }

    public function register() {
        return view('pages.register');
    }
    public function thankyou() {
    return view('pages.thankyou');
    }
}

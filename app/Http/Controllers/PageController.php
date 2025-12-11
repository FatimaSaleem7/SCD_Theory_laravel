<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicine; // <-- added

class PageController extends Controller
{
    public function home() {
        return view('pages.home');
    }

    public function departments() {
        return view('pages.departments');
    }

    // Updated to pass medicines to the frontend medicines page
    public function medicines() {
        $medicines = Medicine::orderBy('created_at','desc')->get();
        return view('pages.medicines', compact('medicines'));
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

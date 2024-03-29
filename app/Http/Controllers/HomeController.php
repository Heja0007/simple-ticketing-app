<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     */
    public function index()
    {
        if (Auth::user()) {
            if (\auth()->user()->role == 'admin') {
                return redirect()->to('/admin/tickets');
            } else {
                return view('dashboard.home');
            }
        }
        return view('auth.login');
    }

}

<?php
/**
 * ANA RITA VIEIRA DE ALMEIDA 35456
 */
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

class RoutingController extends Controller {

    public function home() {

        return view('home');
    }

    public function about() {

        return view('about');
    }

    public function images() {

        return view('images');
    }

    public function comments() {

        return view('comments');
    }

    public function buy() {

        return view('buy');
    }

    public function contact() {

        return view('contact');
    }

    public function profile() {

        if(!(Auth::check())) {

            return redirect()->route('login');
        }
        return view('profile');
    }
}
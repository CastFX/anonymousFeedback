<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Contracts\Support\Renderable;

class HomeController extends Controller
{
//    /**
//     * Create a new controller instance.
//     *
//     * @return void
//     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {

        $feedbacks = Feedback::all('created_at', 'rating', 'email', 'name');
        $numberOfRankings = 5;
        return view('home', compact('feedbacks', 'numberOfRankings'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FeedbackController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        //todo return json of all feedbacks
        return view('leaveFeedback');
    }

    public function create()
    {
        //todo get users
//        $users = auth()->user()->following()->pluck('profiles.user_id');
        return view('feedback.create', compact('users'));
    }

    public function store()
    {
        $data = request()->validate([
            'email' => 'required|email',
            'rating' => 'required',
            'description' => 'required'
        ]);

        $email = $data['email'];
        $user = DB::table('users')->where('email', $email)->first();


        //todo create feedback in db
        auth()->feedbacks()->create([
            'email' => $data['email'],
            'rating' => $data['rating'],
            'description' => $data['description']
        ]);

        //todo return answer to show modal
        return redirect('/profile/' . auth()->user()->id);
    }

    public function showFeedbackList()
    {
        $feedbacks = auth()->feedbacks();
        return view('feedback.list', compact('feedbacks'));
    }
}

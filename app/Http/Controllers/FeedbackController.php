<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Collection;
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
     * @return Feedback[]|Renderable|Collection
     */
    public function index()
    {
        return Feedback::orderBy('created_at', 'DESC')->get();
    }

    public function create()
    {
        $emails = auth()->user()->pluck('email');
        return view('feedback.create', compact('emails'));
    }

    public function store()
    {
        $data = request()->validate([
            'email' => 'required|email|exists:users,email',
            'rating' => 'required',
            'description' => 'nullable|string'
        ]);

        $user = User::where('email', $data['email'])->first();

        $user->feedbacks()->create([
            'email' => $data['email'],
            'rating' => $data['rating'],
            'description' => $data['description']
        ]);

        $success = (object) ["name" => $user->name];
        $emails = auth()->user()->pluck('email');
        return redirect()->back()->with(compact("success", "emails"));
    }

    public function list()
    {
        $emails = auth()->user()->pluck('email', 'id');
        return view('feedback.list', compact('emails'));
    }

    public function show($user)
    {
        return User::findOrFail($user)->feedbacks()->orderBy('created_at', 'DESC')->get();
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\JobPost;

class HomeController extends Controller
{
    public function index()
    {
        $jobPosts = JobPost::with('client')
            ->where('status', 'open')
            ->latest()
            ->take(6)
            ->get();

        return view('home', compact('jobPosts'));
    }
}

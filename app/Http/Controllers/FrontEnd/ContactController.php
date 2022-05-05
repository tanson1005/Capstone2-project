<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comments;

class ContactController extends Controller
{
    public function aboutUs()
    {
        $comments = Comments::orderby('id', 'desc')->limit(5)->get();
        return view('frontend.aboutUs.about', compact('comments'));
    }

    public function contact()
    {
        return view('frontend.aboutUs.contact');
    }
}

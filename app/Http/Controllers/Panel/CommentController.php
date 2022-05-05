<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Comments;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comments::all();
        return view('panel.comment.index', compact('comments'));
    }

    public function delete($id)
    {
        Comments::find((int)$id)->update(['active'=>0]);
        return redirect()->route('comment.index');
    }

    public function restore($id)
    {
        Comments::find((int)$id)->update(['active'=>1]);
        return redirect()->route('comment.index');
    }
}

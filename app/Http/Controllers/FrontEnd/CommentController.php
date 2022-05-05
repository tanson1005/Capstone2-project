<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comments;

class CommentController extends Controller
{
    public function comment(Request $request)
    {
        Comments::create([
            'comment_username'=>$request->name,
            'comment_email'=>$request->email,
            'comment_content'=>$request->comment,
            'product_id'=>(int)$request->product_id,
            'active'=>1,
        ]);
        return redirect()->back()->with('comment', 'Đã gởi bình luận.');
    }
}

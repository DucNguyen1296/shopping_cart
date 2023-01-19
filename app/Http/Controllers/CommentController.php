<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    //
    public function comment_product(Request $request)
    {
        $data = $request->all();
        $comment = new Comment();
        $comment->user_id = Auth::user()->id;
        $comment->product_id = $data['product_id'];
        $comment->rate = $data['rate'];
        $comment->comment = $data['comment'];
        $comment->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $comment->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $comment->save();
        return back();
    }
}

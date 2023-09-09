<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::where('status', 1)->orderBy('created_at', 'ASC')->get();
        return view('blog', compact('blogs'));
    }

    public function details($id)
    {
        $details = Blog::find(decrypt($id));
        $comments = Comment::where('status', 1)->where('blog_id', $id)->orderBy('created_at', 'DESC')->get();

        if (!empty($details)) {
            return view('blog_details', ['details' => $details, 'comments' => $comments]);
        } else {
            return redirect(route('index'));
        }
    }

    public function comment(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'blog_id' => 'required',
            'comment' => 'required'
        ]);

        $comment = new Comment();
        $comment->name = $request->name;
        $comment->comment = $request->comment;
        $comment->blog_id = $request->blog_id;

        if ($comment->save()) {
            return redirect()->back()->with(['type' => 'success', 'message' => 'Comment Saved !!']);
        } else {
            return redirect()->back()->with(['type' => 'danger', 'message' => 'Internal Server Error']);
        }
    }
}

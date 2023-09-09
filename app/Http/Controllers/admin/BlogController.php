<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $blogs = Blog::orderBy('created_at', 'DESC');
        if (!empty($request->search)) {
            $blogs = Blog::where('name', 'like', '%' . $request->search . '%')->orderBy('created_at', 'DESC');
        }
        $blogs = $blogs->paginate(5);
        return view('admin.blog.list', compact('blogs'));
    }

    public function create()
    {
        return view('admin.blog.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            // 'image' => 'required',
            // 'status' => 'required',
            'short_description' => 'required|max:255'
        ]);

        $imageName = time() . "." . $request->file('image')->getClientOriginalExtension();
        $sourcePath = "./uploads/blog/thumb/small/";
        $request->image->move(public_path($sourcePath), $imageName);


        // small thumbnails (360, 220)
        // large thumbnail ()

        $blog = new Blog();
        $blog->name = $request->name;
        $blog->description = $request->description;
        $blog->image = $imageName;
        $blog->status = $request->status;
        $blog->short_description = $request->short_description;

        if ($blog->save()) {
            return redirect(route('blog.list'))->with(['type' => 'success', 'message' => 'Blog Saved Successfully']);
        } else {
            return redirect(route('blog.list'))->with(['type' => 'danger', 'message' => 'Internal Server Error']);
        }
    }

    public function edit($id)
    {
        $blog = Blog::where('id', $id)->first();

        if (empty($blog)) {
            return redirect(route('blog.list'))->with(['type' => 'danger', 'message' => 'No Record Found']);
        }
        return view('admin.blog.edit', compact('blog'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            // 'image' => 'required',
            // 'status' => 'required',
            'short_description' => 'required|max:255'
        ]);

        $blog = Blog::find($id);

        if (empty($blog)) {
            return redirect(route('blog.list'))->with(['type' => 'danger', 'message' => 'Record Not Found']);
        }


        $blog->name = $request->name;
        $blog->description = $request->description;
        $blog->status = $request->status;
        $blog->short_description = $request->short_description;

        if (!empty($request->file('image'))) {
            $imageName = time() . "." . $request->file('image')->getClientOriginalExtension();
            $sourcePath = "./uploads/blog/thumb/small/";

            if (file_exists($sourcePath . $request->old_image)) {
                unlink($sourcePath . $request->old_image);
            }

            $request->image->move(public_path($sourcePath), $imageName);
            $blog->image = $imageName;
        }

        if ($blog->save()) {
            return redirect(route('blog.list'))->with(['type' => 'success', 'message' => 'Blog Details Updated Successfully']);
        } else {
            return redirect(route('blog.list'))->with(['type' => 'danger', 'message' => 'Internal Server Error']);
        }
    }

    public function delete($id)
    {
        $blog = Blog::where('id', $id)->first();
        if (empty($blog)) {
            return redirect(route('blog.list'))->with(['type' => 'danger', 'message' => 'Record Not Found']);
        } else {
            if ($blog->delete()) {
                if (file_exists('./uploads/blog/thumb/small/' . $blog->image)) {
                    unlink('./uploads/blog/thumb/small/' . $blog->image);
                }
                return redirect(route('blog.list'))->with(['type' => 'success', 'message' => 'Blog Deleted Successfully']);
            } else {
                return redirect(route('blog.list'))->with(['type' => 'danger', 'message' => 'Internal Server Error']);
            }
        }
    }

}

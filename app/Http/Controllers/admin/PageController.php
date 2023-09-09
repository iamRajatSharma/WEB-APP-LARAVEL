<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(Request $request)
    {
        $data = Page::orderBy('created_at', 'DESC');
        if (!empty($request->search)) {
            $data = Page::where('name', 'like', '%' . $request->search . '%')->orderBy('created_at', 'DESC');
        }
        $data = $data->paginate(5);
        return view('admin.pages.list', compact('data'));
    }

    public function create()
    {
        return view('admin.pages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'content' => 'required',
            // 'image' => 'required',
            // 'status' => 'required',
        ]);

        if ($request->file('image') != null) {
            $imageName = time() . "." . $request->file('image')->getClientOriginalExtension();
            $sourcePath = "./uploads/pages/thumb/small/";
            $request->image->move(public_path($sourcePath), $imageName);
        } else {
            $imageName = null;
        }

        $data = new Page();
        $data->name = $request->name;
        $data->content = $request->content;
        $data->image = $imageName;
        $data->status = $request->status;

        if ($data->save()) {
            return redirect(route('pages.list'))->with(['type' => 'success', 'message' => 'Data Saved Successfully']);
        } else {
            return redirect(route('pages.list'))->with(['type' => 'danger', 'message' => 'Internal Server Error']);
        }
    }

    public function edit($id)
    {
        $data = Page::where('id', $id)->first();

        if (empty($data)) {
            return redirect(route('pages.list'))->with(['type' => 'danger', 'message' => 'No Record Found']);
        }
        return view('admin.pages.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'content' => 'required',
        ]);

        $data = Page::find($id);

        if (empty($data)) {
            return redirect(route('pages.list'))->with(['type' => 'danger', 'message' => 'Record Not Found']);
        }

        $data->name = $request->name;
        $data->content = $request->content;
        $data->status = $request->status;

        if (!empty($request->file('image'))) {
            $imageName = time() . "." . $request->file('image')->getClientOriginalExtension();
            $sourcePath = "./uploads/pages/thumb/small/";

            if (file_exists($sourcePath . $request->old_image)) {
                unlink($sourcePath . $request->old_image);
            }

            $data->image->move(public_path($sourcePath), $imageName);
            $data->image = $imageName;
        }

        if ($data->save()) {
            return redirect(route('pages.list'))->with(['type' => 'success', 'message' => 'Data Updated Successfully']);
        } else {
            return redirect(route('pages.list'))->with(['type' => 'danger', 'message' => 'Internal Server Error']);
        }
    }

    public function delete($id)
    {
        $data = Page::where('id', $id)->first();
        if (empty($data)) {
            return redirect(route('pages.list'))->with(['type' => 'danger', 'message' => 'Record Not Found']);
        } else {
            if ($data->delete()) {
                if (file_exists('./uploads/pages/thumb/small/' . $data->image)) {
                    unlink('./uploads/pages/thumb/small/' . $data->image);
                }
                return redirect(route('pages.list'))->with(['type' => 'success', 'message' => 'Record Deleted Successfully']);
            } else {
                return redirect(route('pages.list'))->with(['type' => 'danger', 'message' => 'Internal Server Error']);
            }
        }
    }
}

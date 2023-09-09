<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $services = Service::orderBy('created_at', 'DESC');
        if (!empty($request->search)) {
            $services = Service::where('name', 'like', '%' . $request->search . '%')->orderBy('created_at', 'DESC');
        }
        $services = $services->paginate(5);
        return view('admin.services.list', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
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
        $sourcePath = "./uploads/services/thumb/small/";
        $request->image->move(public_path($sourcePath), $imageName);


        // small thumbnails (360, 220)
        // large thumbnail ()

        $service = new Service();
        $service->name = $request->name;
        $service->description = $request->description;
        $service->image = $imageName;
        $service->status = $request->status;
        $service->short_description = $request->short_description;

        if ($service->save()) {
            return redirect(route('serviceList'))->with(['type' => 'success', 'message' => 'Data Saved Successfully']);
        } else {
            return redirect(route('serviceList'))->with(['type' => 'danger', 'message' => 'Internal Server Error']);
        }
    }

    public function edit($id)
    {
        $service = Service::where('id', $id)->first();

        if (empty($service)) {
            return redirect(route('serviceList'))->with(['type' => 'danger', 'message' => 'No Record Found']);
        }
        return view('admin.services.edit', compact('service'));
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

        $service = Service::find($id);

        if (empty($service)) {
            return redirect(route('serviceList'))->with(['type' => 'danger', 'message' => 'Record Not Found']);
        }


        $service->name = $request->name;
        $service->description = $request->description;
        $service->status = $request->status;
        $service->short_description = $request->short_description;

        if (!empty($request->file('image'))) {
            $imageName = time() . "." . $request->file('image')->getClientOriginalExtension();
            $sourcePath = "./uploads/services/thumb/small/";

            if (file_exists($sourcePath . $request->old_image)) {
                unlink($sourcePath . $request->old_image);
            }

            $request->image->move(public_path($sourcePath), $imageName);
            $service->image = $imageName;
        }

        if ($service->save()) {
            return redirect(route('serviceList'))->with(['type' => 'success', 'message' => 'Data Updated Successfully']);
        } else {
            return redirect(route('serviceList'))->with(['type' => 'danger', 'message' => 'Internal Server Error']);
        }
    }

    public function delete($id)
    {
        $service = Service::where('id', $id)->first();
        if (empty($service)) {
            return redirect(route('serviceList'))->with(['type' => 'danger', 'message' => 'Record Not Found']);
        } else {
            if ($service->delete()) {
                if (file_exists('./uploads/services/thumb/small/' . $service->image)) {
                    unlink('./uploads/services/thumb/small/' . $service->image);
                }
                return redirect(route('serviceList'))->with(['type' => 'success', 'message' => 'Record Deleted Successfully']);
            } else {
                return redirect(route('serviceList'))->with(['type' => 'danger', 'message' => 'Internal Server Error']);
            }
        }
    }
}

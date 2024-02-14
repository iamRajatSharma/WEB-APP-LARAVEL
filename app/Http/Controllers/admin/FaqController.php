<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;
Use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        // DB::connection()->enableQueryLog();


        DB::connection()->enableQueryLog();
        $data = Faq::orderBy('created_at', 'DESC');
        if (!empty($request->search)) {
            $data = Faq::where('name', 'like', '%' . $request->search . '%')->orderBy('created_at', 'DESC');
        }
        $data = $data->paginate(5);
        // $querieslog = DB::getQueryLog();
        // dd($querieslog);
        return view('admin.faq.list', compact('data'));
    }

    public function create()
    {
        return view('admin.faq.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required',
            'answer' => 'required'
        ]);

        $faq = new Faq();
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->status = $request->status;

        if ($faq->save()) {
            return redirect(route('faq.list'))->with(['type' => 'success', 'message' => 'Data Saved Successfully']);
        } else {
            return redirect(route('faq.list'))->with(['type' => 'danger', 'message' => 'Internal Server Error']);
        }
    }

    public function edit($id)
    {
        $data = Faq::where('id', $id)->first();

        if (empty($data)) {
            return redirect(route('faq.list'))->with(['type' => 'danger', 'message' => 'No Record Found']);
        }
        return view('admin.faq.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'question' => 'required',
            'answer' => 'required'
        ]);

        $data = Faq::find($id);

        if (empty($data)) {
            return redirect(route('faq.list'))->with(['type' => 'danger', 'message' => 'Record Not Found']);
        }

        $data->question = $request->question;
        $data->answer = $request->answer;
        $data->status = $request->status;

        if ($data->save()) {
            return redirect(route('faq.list'))->with(['type' => 'success', 'message' => 'Data Updated Successfully']);
        } else {
            return redirect(route('faq.list'))->with(['type' => 'danger', 'message' => 'Internal Server Error']);
        }
    }

    public function delete($id)
    {
        $data = Faq::where('id', $id)->first();
        if (empty($data)) {
            return redirect(route('faq.list'))->with(['type' => 'danger', 'message' => 'Record Not Found']);
        } else {
            if ($data->delete()) {
                return redirect(route('faq.list'))->with(['type' => 'success', 'message' => 'Record Deleted Successfully']);
            } else {
                return redirect(route('faq.list'))->with(['type' => 'danger', 'message' => 'Internal Server Error']);
            }
        }
    }
}

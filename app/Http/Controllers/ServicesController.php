<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function index()
    {
        $services = Service::where('status', 1)->orderBy('name', 'ASC')->get();
        return view('services', ['services' => $services]);
    }

    public function details($id)
    {
        $details = Service::find($id);
        if (!empty($details)) {
            return view('details', ['details' => $details]);
        } else {
            return redirect(route('index'));
        }
    }
}

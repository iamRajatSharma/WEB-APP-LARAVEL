<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Service;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    public function index()
    {
        $data = Service::where('status', 1)->orderBy('name', 'ASC')->limit(4)->get();
        return view('home',  ['data' => $data]);
    }

    public function about()
    {
        $data = Page::where('id', 3)->first();
        return view('about', ['data' => $data]);
    }

    public function privacy()
    {
        $data = Page::where('id', 3)->first();
        return view('about', ['data' => $data]);
    }
}

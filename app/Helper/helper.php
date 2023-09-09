<?php

use App\Models\Feature;
use App\Models\Setting;

function featuredService()
{
    return Feature::all();
}



function getSetting(){
    return Setting::all();
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class Welcome extends Controller
{
    public function about(){
        return view('pages');

    }
}

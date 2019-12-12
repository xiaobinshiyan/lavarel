<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RequestController extends Controller
{
    public function form(Request $request)
    {
    	$id = $request->input('id');
    	echo $id;exit();
    	  print_r($request->all());exit();
    }
    public function formPage()
    {
    	return view('request.form');
    }
}

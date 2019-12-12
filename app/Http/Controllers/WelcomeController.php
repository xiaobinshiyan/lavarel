<?php

namespace app\Http\Controllers;

use App\Http\Controllers\Controller;

/**
 * 
 */
class WelcomeController extends Controller
{
		/**
		 * [index description]
		 * @return [type] [description]
		 */
		public function index() {
			// echo url('/');exit();
			return view('index');
		}
}
<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use DB;

class OrderController extends Controller
{
    public function __construct()
    {
    	$languages = DB::table('languages')->get();
        foreach($languages as $language) {
		    define($language->lang_key, $language->lang_value);
		}
		
        $this->middleware('customer');
    }

    public function index()
    {
        $g_setting = DB::table('general_settings')->where('id', 1)->first();
        return view('customer.pages.order', compact('g_setting'));
    }

}

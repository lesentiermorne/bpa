<?php

namespace App\Http\Controllers\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class DashboardController extends Controller
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
        return view('customer.pages.dashboard', compact('g_setting'));
    }
}
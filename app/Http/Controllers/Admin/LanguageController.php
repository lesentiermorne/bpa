<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use DB;

class LanguageController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $language_data = Language::orderBy('id', 'asc')->get();
        return view('admin.language.index', compact('language_data'));
    }

    public function update(Request $request)
    {

        $i=0;
        foreach(request('lang_id') as $value)
        {
            $arr1[$i] = $value;
            $i++;
        }

        $i=0;
        foreach(request('lang_key') as $value)
        {
            $arr2[$i] = $value;
            $i++;
        }

        $i=0;
        foreach(request('lang_value') as $value)
        {
            $arr3[$i] = $value;
            $i++;
        }

        for($i=0;$i<count($arr1);$i++)
        {
            $data = array();
            $data['lang_value'] = $arr3[$i];
            DB::table('languages')->where('id', $arr1[$i])->update($data);
        }

        return redirect()->route('admin.language.index')->with('success', 'Language is updated successfully!');
    }
}

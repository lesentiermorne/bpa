<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use App\Models\Admin\JobApplication;
use Illuminate\Http\Request;
use DB;

class JobController extends Controller
{
    public function index()
    {
        $g_setting = DB::table('general_settings')->where('id', 1)->first();
        $career = DB::table('page_career_items')->where('id', 1)->first();
        $jobs = DB::table('jobs')->orderby('job_order', 'asc')->get();
        return view('pages.career', compact('career','g_setting','jobs'));
    }

    public function detail($slug)
    {
        $g_setting = DB::table('general_settings')->where('id', 1)->first();
        $job_detail = DB::table('jobs')->where('job_slug', $slug)->first();
        return view('pages.job', compact('job_detail','g_setting'));
    }

    public function apply($slug)
    {
        $g_setting = DB::table('general_settings')->where('id', 1)->first();
        $job_detail = DB::table('jobs')->where('job_slug', $slug)->first();
        return view('pages.job_apply', compact('job_detail','g_setting'));
    }

    public function apply_form(Request $request)
    {
        $g_setting = DB::table('general_settings')->where('id', 1)->first();

        $job_application = new JobApplication();
        $data = $request->only($job_application->getFillable());

        $request->validate(
            [
                'applicant_first_name' => 'required',
                'applicant_last_name' => 'required',
                'applicant_email' => 'required|email',
                'applicant_phone' => 'required',
                'applicant_country' => 'required',
                'applicant_state' => 'required',
                'applicant_street' => 'required',
                'applicant_city' => 'required',
                'applicant_zip_code' => 'required',
                'applicant_expected_salary' => 'required',
                'applicant_cover_letter' => 'required',
                'applicant_cv' => 'required|mimes:doc,docx|max:2048'
            ],
            [
                'applicant_first_name.required' => ERROR_MESSAGE_FIRST_NAME_EMPTY,
                'applicant_last_name.required' => ERROR_MESSAGE_LAST_NAME_EMPTY,
                'applicant_email.required' => ERROR_MESSAGE_EMAIL_EMPTY,
                'applicant_email.email' => ERROR_MESSAGE_EMAIL_VALID,
                'applicant_phone.required' => ERROR_MESSAGE_PHONE_EMPTY,
                'applicant_country.required' => ERROR_MESSAGE_COUNTRY_EMPTY,
                'applicant_state.required' => ERROR_MESSAGE_STATE_EMPTY,
                'applicant_street.required' => ERROR_MESSAGE_STREET_EMPTY,
                'applicant_city.required' => ERROR_MESSAGE_CITY_EMPTY,
                'applicant_zip_code.required' => ERROR_MESSAGE_ZIP_CODE_EMPTY,
                'applicant_expected_salary.required' => ERROR_MESSAGE_EXPECTED_SALARY_EMPTY,
                'applicant_cover_letter.required' => ERROR_MESSAGE_COVER_LETTER_EMPTY,
                'applicant_cv.required' => ERROR_MESSAGE_CV_ATTACH_EMPTY,
                'applicant_cv.mimes' => ERROR_MESSAGE_CV_ATTACH_VALID,
                'applicant_cv.max' => ERROR_MESSAGE_CV_ATTACH_MAX
            ]
        );

        if($g_setting->google_recaptcha_status == 'Show') {
            $request->validate([
                'g-recaptcha-response' => 'required'
            ],
            [
                'g-recaptcha-response.required' => ERROR_MESSAGE_CAPTCHA
            ]);
        }

        $statement = DB::select("SHOW TABLE STATUS LIKE 'job_applications'");
        $ai_id = $statement[0]->Auto_increment;

        $ext = $request->file('applicant_cv')->extension();
        $final_name = 'cv-'.$ai_id.'.'.$ext;
        $request->file('applicant_cv')->move(public_path('uploads/'), $final_name);
        $data['applicant_cv'] = $final_name;

        $job_application->fill($data)->save();

        return redirect()->back()->with('success', SUCCESS_MESSAGE_JOB_APPLICATION);
    }
}

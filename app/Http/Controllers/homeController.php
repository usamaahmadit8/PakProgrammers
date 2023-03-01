<?php

namespace App\Http\Controllers;

use App\Models\banner;
use App\Models\course;
use App\Models\CourseHeading;
use App\Models\CourseOutline;
use App\Models\CourseRegister;
use App\Models\laguage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use App\Models\CoursesDetail;
use App\Models\WhyChooseUsHeading;
use App\Models\WhyChooseUSDescription;
use App\Models\FypHeading;
use App\Models\FypDescription;
use App\Models\EnrollDropdown;
use App\Models\FeeStructure;
use App\Models\InterviewAnswer;
use App\Models\InterviewPoint;
use App\Models\LanguageCategory;
use App\Models\LanguageDetail;
use App\Models\LanguageHeading;
use App\Models\LanguageSubHead;

class homeController extends Controller
{
    //
    public function getLanguages()
    {
        $languages = array();
        $languages = laguage::all();
        return $languages;
    }

    public function getCourses()
    {
        $courses = array();
        $courses = course::all();
        return $courses;

        // $courses = course::all();
        // $lan = laguage::all();

        // return $courses . $lan;
    }
    public function getDropdown()
    {
        $courses = array();
        $courses = course::all();
        $lan = array();
        $lan = laguage::all();
        return [['courses' => $courses, 'language' => $lan]];
    }
    public function getBanners()
    {
        $banners = array();
        $banners = banner::all();
        return $banners;
    }

    public function register_course(Request $request)
    {
        try {
            $validateData = Validator::make($request->all(), [
                "first_name" => "required|max:20",
                "last_name" => "required|max:20",
                "email" => "email|required",
                "phone" => "required",
                "city" => "required",
                "qualification" => "required",
                "course" => "required",

            ]);
            if ($validateData->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateData->errors()
                ], 401);
            }
            // $request['password'] = md5($request->password);
            $user = CourseRegister::create($request->all());
            return response()->json([
                'status' => true,
                'message' => 'Registration Successfull.'
                // 'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                // 'message' => $th->getMessage()
                'message' => 'User already Exits'
            ], 500);
        }
    }

    public function getCourseRegisteredUser(Request $request)
    {

        $course = CourseRegister::where("email", "=", "$request->email")->get();
        return $course;
    }

    public function getCourseOutline(Request $request)
    {
        $course_id = $request->course_id;
        $complete_course = array();
        $course_outline = CourseHeading::where("course_id", $course_id)->get();
        for ($i = 0; $i < count($course_outline); $i++) {
            $course = CourseOutline::where("course_id", $course_id)
                ->where("course_title_id", $course_outline[$i]->id)
                ->get();
            if (count($course) > 0) {
                $course_outline[$i]->outline = $course;
            } else {
                $course = array();
                $course_outline[$i]->outline = $course;
            }
        }

        return $course_outline;
    }



    public function cousedetail()
    {
        $coursedetail = CoursesDetail::all();
        return ['coursede' => $coursedetail];
    }

    public function getCourseOutlineline(Request $request)
    {
        $course_id = $request->course_id;
        $complete_course = array();
        $course_outline = CourseHeading::get();
        for ($i = 0; $i < count($course_outline); $i++) {
            $course = CourseOutline::where("course_title_id", $course_outline[$i]->id)
                ->get();
            if (count($course) > 0) {
                $course_outline[$i]->outline = $course;
            } else {
                $course = array();
                $course_outline[$i]->outline = $course;
            }
        }

        return $course_outline;
    }



    public function whychoose()
    {
        $heading = WhyChooseUsHeading::get();
        for ($i = 0; $i < count($heading); $i++) {
            $course = WhyChooseUSDescription::where("heading_id", $heading[$i]->id)
                ->get();
            $heading[$i]->Description = $course;
        }

        return $heading;
    }

    public function FYPP()
    {
        $heading = FypHeading::get();
        for ($i = 0; $i < count($heading); $i++) {
            $course = FypDescription::where("fyp_id", $heading[$i]->id)
                ->get();
            $heading[$i]->Description = $course;
        }

        return $heading;
    }
    public function enrolldrop()
    {
        $enroll = EnrollDropdown::all();
        return $enroll;
    }
    public function getLanguageCategory(Request $request)
    {
        $language_id = $request->language_id;
        $category = LanguageCategory::where("language_id", "=", $language_id)
            ->get();
        return $category;
    }
    public function getLanguageHeading(Request $request)
    {
        $language_id = $request->language_id;
        $lang_category_id = $request->lang_category_id;
        $category = LanguageHeading::where("language_id", "=", $language_id)
            ->where("lang_category_id", "=", $lang_category_id)
            ->get();
        for ($i = 0; $i < count($category); $i++) {
            $sub_heading = LanguageSubHead::where("lang_head_id", $category[$i]->id)
                ->get();
            if (count($sub_heading) > 0) {
                $category[$i]->sub_heading = $sub_heading;
            } else {
                $sub_heading = array();
                $category[$i]->sub_heading = $sub_heading;
            }
        }
        return $category;
    }
    public function getLanguageDetails(Request $request)
    {
        $sub_head_id = $request->sub_head_id;
        $language_detail = LanguageDetail::where("sub_head_id", "=", $sub_head_id)
            ->get();
        return $language_detail;
    }
    public function getInterviewHeading(Request $request)
    {
        $language_id = $request->language_id;
        $lang_category_id = $request->lang_category_id;
        $questions = LanguageHeading::where("language_id", "=", $language_id)
            ->where("lang_category_id", "=", $lang_category_id)
            ->get();
        return $questions;
    }
    public function getInterviewDetail(Request $request)
    {
        $sub_head_id = $request->sub_head_id;
        $inerview_detail = InterviewAnswer::where("heading_id", "=", $sub_head_id)
            ->get();
        for ($i = 0; $i < count($inerview_detail); $i++) {
            $sub_points = InterviewPoint::where("interview_ans_id", $inerview_detail[$i]->id)
                ->get();
            if (count($sub_points) > 0) {
                $inerview_detail[$i]->sub_points = $sub_points;
            } else {
                $sub_points = array();
                $inerview_detail[$i]->sub_points = $sub_points;
            }
        }
        return $inerview_detail;
    }
    public function getFeeStructure(){
        $course_fee=FeeStructure::get();
        for ($i = 0; $i < count($course_fee); $i++) {
            $course_name = course::where("id", $course_fee[$i]->course_id)
                ->get();
            if (count($course_name) > 0) {
                $course_fee[$i]->course_name = $course_name[0]->course_title;
            }
        }
        return $course_fee;
    }
}

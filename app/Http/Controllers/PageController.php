<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Registration;
use App\Models\User;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return view('front.index', compact('courses'));
    }

    public function search(Request $request)
    {
        // dd($request->all());
        $courses = Course::where('name', 'like', '%' . $request->s . '%')
        ->orWhere('content', 'like', '%' . $request->s . '%')
        ->get();
        return view('front.index', compact('courses'));
    }

    public function course($slug)
    {
        $course = Course::where('slug', $slug)->first();
        return view('front.course', compact('course'));
    }

    public function register($slug)
    {
        $course = Course::where('slug', $slug)->first();
        return view('front.register', compact('course'));
    }

    public function registerSubmit(Request $request, $slug)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'required'
        ]);

        // dd($request->all());

        $course = Course::where('slug', $slug)->select('id')->first();
        $user = User::where('email', $request->email)->first();
        if(is_null($user)) {
            // create new user
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'gender' => $request->gender
            ]);
        }


        $regiter = Registration::create([
            'user_id' => $user->id,
            'course_id' => $course->id
        ]);

        return redirect()->route('pay', $regiter->id);

    }


    function pay($id)
    {
        $regster = Registration::find($id);
        return view('front.pay', compact('regster'));
    }

    function thanks($id) {
        Registration::find($id)->update([
            'status' => 1
        ]);

        return redirect()->route('homepage');
    }
}

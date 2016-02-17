<?php

use App\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {

    /**
     * List all courses
     */

    Route::get('/', function () {
        $courses = Course::orderBy('created_at', 'asc')->get();

        return view('courses', [
            'courses' => $courses
        ]);
    });

    /**
     * Add a course
     */

    Route::post('/course', function (Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'date' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }

        $course = new Course();
        $course->name = $request->name;
        $course->date = $request->date;
        $course->save();

        return redirect('/');

    });

    /**
     * Delete a course
     */

    Route::delete('/course/{course}', function (Course $course) {
        $course->delete();

        return redirect('/');
    });
});




<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// middleware('auth') mean can only access after logged in 
// middleware('guest') prevent user that already logged in to access
// redirect of these middleware can be found in 
// RouteServiceProvider and Authenticate

// all jobs
Route::get('/', [JobController::class, 'index']);

// show create form
Route::get('/jobs/create', [JobController::class, 'create'])->middleware('auth');

// store job data
Route::post('/jobs', [JobController::class, 'store'])->middleware('auth');

// show edit form
Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])->middleware('auth');

// update job
Route::put('/jobs/{job}', [JobController::class, 'update'])->middleware('auth');

// delete job
Route::delete('/jobs/{job}', [JobController::class, 'delete'])->middleware('auth');

// manage job
Route::get('/jobs/manage', [JobController::class, 'manage'])->middleware('auth');

// single job
// this route have to be at the last
// all route that use the same format such as /jobs/whateverthisis
// need to be on the top cuz {job} will take all 
// like nextjs 13 folder route [...]
Route::get('/jobs/{job}', [JobController::class, 'show']);
/* 
    The line above equal to
    Route::get('/jobs/{id}', function($id){
        $job = Job::find($id)

        if($job){
            return view("show", [
                'job' => $job
            ])
        } else {
            abort('404')
        }
    });

    Another alternative way is Route model binding
    Route::get('/jobs/{job}', function(Job $job){
         return view("show", [
            'job' => $job
        ])
    });

    Keep in mind that you have to match the parameter with what ever inside the route .../{ThisThingHere}
    And by using route model binding, it will automatically check if the id exists and return 404 if it does not 

    The callback function has been split to JobController, that why we using [JobController::class, 'show'] here
*/

// show register/create account form
Route::get('/register', [UserController::class, 'create'])->middleware('guest');

// create new user
Route::post('/users', [UserController::class, 'store']);

// logout
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

// show login form
// name this /login route to 'login'
// to authenticate user
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

// login user
Route::post('/users/authenticate', [UserController::class, 'authenticate']);

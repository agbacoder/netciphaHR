<?php

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

if (\Illuminate\Support\Facades\App::environment('local'))
{
    Route::get('/testing', function () {
        $employee = \App\Models\Employees::factory()->make();
        Mail::to($employee)->send(new \App\Mail\EmployeeDetails($employee));

        return null;
    });
    // Route::get( '/reset-password/{token}', function($token){
    //     return view('auth.password-rest',[
    //         'token' => $token
    //     ]);
    // })
    // ->middleware(['guest:'.config('fortify.guard')])
    // ->name('password.reset');
}


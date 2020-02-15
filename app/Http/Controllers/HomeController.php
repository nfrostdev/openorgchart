<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct()
    {
        if (env('AUTHENTICATION_REQUIRED')) {
            $this->middleware('auth', ['only' => 'index']);
        }
    }

    /**
     * Show the application index.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('index', ['departments' => Department::all()]);
    }
}

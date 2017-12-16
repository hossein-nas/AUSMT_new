<?php

namespace App\Http\Controllers\View;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['visit']);
    }
    
    public function home()
    {
        return view('home');
    }
}

<?php

namespace NinjaPortal\Shadow\Controllers;

use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    public function welcome()
    {
        return view('welcome');
    }

}

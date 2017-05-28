<?php

namespace App\Http\Controllers\Admin;


class IndexController extends Controller
{

   public function home()
   {

       return view('admin.student');
   }
}
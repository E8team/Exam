<?php
/**
 * Created by PhpStorm.
 * User: Lei
 * Date: 2017/6/3
 * Time: 15:29
 */

namespace App\Http\Controllers\Admin;


class LoginController extends Controller
{
    //protected $redirectTo = '/';

    public function login()
    {
        return view('admin.login');
    }
}
<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Services\StudentService;
use App\Http\Controllers\Controller;
use App\Widgets\Alert;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Jrean\UserVerification\Traits\VerifiesUsers;
use UserVerification;


class RegisterController extends Controller
{
    private $sendEmailTitle = '马克思学院考试系统';
    protected $redirectAfterVerification = 'after_verification';
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use VerifiesUsers;
    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('register');
    }

    public function showWaitVerifyForm()
    {
        if(!Auth::user()->verified){
            return view('wait_verify', ['user' => Auth::user()]);
        }else{
            return redirect(route('choose'));
        }

    }

    /**
     * 邮箱验证后跳转到注册成功页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showAfterVerifyForm()
    {
        return view('reg_success');
    }



    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $data = $request->all();
        $this->validator($data)->validate();
        $student = false;
        try {
            $student = $this->validateStudent($data);
        } catch (ModelNotFoundException $exception) {
            // 学号不存在
            return $this->sendFailedRegisterResponse($request, ['student_num' => '该学号不存在!']);
        }
        if (false == $student) {
            // 身份证号码错误
            return $this->sendFailedRegisterResponse($request, ['id_card' => '身份证号码错误!']);
        }

        $data['id_card_num'] = $student->id_card_num;
        $data['name'] = $student->name;
        $data['department_class_id'] = $student->department_class_id;
        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);

        event(new Registered($user));

        $this->guard()->login($user);

        return $this->sendVerifyEmail();

    }

    public function sendVerifyEmail()
    {
        $alert = app(Alert::class);
        if($alert->hasMessage()) {
            $alert->keepMessage();
        }
        $user = Auth::user();
        if (!$user->verified) {
            UserVerification::generate($user);
            UserVerification::sendQueue($user, $this->sendEmailTitle);
            return redirect(route('wait_verify'));
        } else {
            return redirect(route('after_verification'));
        }
    }

    /**
     * 注册成功等待验证页面
     * @return string
     */
    protected function redirectTo()
    {
        return route('wait_verify');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'student_num' => 'required|digits:10|unique:users',
            'id_card' => 'required|string|size:6',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed'
        ], [
            'student_num.required' => '请填写学号',
            'student_num.digits' => '学号必须是10位的数字',
            'student_num.unique' => '学号已经被注册',
            'id_card.required' => '请填写身份证号码',
            'id_card.size' => '请填写身份证号码的后6位数字',
            'email.required' => '请填写邮箱',
            'email.email' => '邮箱格式不正确',
            'email.unique' => '该邮箱已经被注册',
            'password.required' => '请填写密码',
            'password.min' => '密码最低6位',
            'password.confirmed' =>'两次密码不相同',
        ]);
    }

    protected function validateStudent($data)
    {
        $studentService = app(StudentService::class);
        $student = $studentService->findByStudentNum($data['student_num']);
        if (substr($student->id_card_num, -strlen($data['id_card'])) == $data['id_card']) {
            return $student;
        } else {
            return false;
        }
    }


    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  mixed $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        //
    }

    /**
     * Get the failed register response instance.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendFailedRegisterResponse(Request $request, $errors)
    {
        return redirect()->back()
            ->withInput($request->except('password'))
            ->withErrors($errors);
    }


}

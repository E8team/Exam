<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Services\StudentService;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Jrean\UserVerification\Traits\VerifiesUsers;
use UserVerification;


class RegisterController extends Controller
{
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

    use RedirectsUsers, VerifiesUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['getVerification', 'getVerificationError']]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $data = $request->all();

        $this->validator($data)->validate();

        $student = false;
        try{
            $student = $this->validateStudent($data);
        }catch (ModelNotFoundException $exception){
            // 学号不存在
            return $this->sendFailedRegisterResponse($request, ['student_num' => '该学号不存在!']);
        }
        if(false==$student){
            // 身份证号码错误
            return $this->sendFailedRegisterResponse($request, ['student_num' => '身份证号码错误!']);
        }
        $data['id_card_num'] = $student->id_card_num;
        $data['name'] = $student->name;
        $data['department_class_id'] = $student->department_class_id;
        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);

        event(new Registered($user));

        $this->guard()->login($user);

        UserVerification::generate($user);

        UserVerification::send($user, 'My Custom E-mail Subject');

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'student_num' => 'required|integer|min:1000000000|max:9999999999',
            'id_card' => 'required|string|size:6',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);
    }

    protected function validateStudent($data)
    {
        $studentService = app(StudentService::class);
        $student = $studentService->findByStudentNum($data['student_num']);
        if(substr($student->id_card_num, -strlen($data['id_card'])) == $data['id_card']) {
            return $student;
        }else{
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
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        //
    }

    /**
     * Get the failed register response instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendFailedRegisterResponse(Request $request, $errors)
    {
        return redirect()->back()
            ->withInput($request->except('password'))
            ->withErrors($errors);
    }
}

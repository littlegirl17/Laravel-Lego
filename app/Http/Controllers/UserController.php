<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Mail\WelcomeUser;
use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\VerificationCode;
use App\Http\Requests\LoginValidate;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\VerifyCodeRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\ForgetPasswordRequest;
use App\Models\Order;

class UserController extends Controller
{
    private $userModel;
    private $orderModel;

    public function __construct()
    {
        $this->userModel = new User();
        $this->orderModel = new Order();
    }

    public function login(LoginValidate $request)
    {

        $user = $this->userModel->checkAccount($request->email);
        if (!$user) {
            return redirect()->route('login')->with('error', 'Tài khoản không tồn tại trong hệ thống!');
        }


        if (auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            if ($user->status < 1) {
                return redirect()->route('login')->with('error', 'Tài khoản bạn đã bị khóa');
            }
            session()->put('user', $user);
            return redirect('/')->with('success', 'Đăng nhập thành công');
        }
        return redirect()->route('login')->with('error', 'Email hoặc password của bạn đã sai!');
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerate();
        return redirect()->route('login')->with('success', 'Đăng nhập tại đây');
    }

    public function forgetPassword(ForgetPasswordRequest  $request)
    {
        //Tạo mã ranđom code
        $code = rand(100000, 999999);
        // kiểm tra tài khoản email trong system
        $user = $this->userModel->checkAccount($request->email);
        //tiến hành update mã code
        $user->verification_code = $code;
        $user->save();
        // gửi mail
        Mail::to($user->email)->send(new VerificationCode($code));
        return redirect()->route('confirmationCodePassword')->with('email', $request->email);
    }

    public function confirmationPassword(VerifyCodeRequest  $request)
    {
        // Kiểm tra tài khoản email trong hệ thống
        $user = $this->userModel->checkAccount($request->email);

        if ($user->verification_code == $request->verification_code) {
            return redirect()->route('resetPassword')->with('email', $request->email);
        } else {
            return redirect()->route('confirmationCodePassword')->with('error', 'Mã xác nhận không hợp lệ');
        }
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        // kiểm tra tài khoản email trong system
        $user = $this->userModel->checkAccount($request->email);
        $user->password = bcrypt($request->password);
        $user->verification_code = null;
        $user->save();
        return redirect()->route('login')->with('success', 'Mật khẩu đã được thay đổi thành công');
    }

    public function register(RegisterRequest $request)
    {
        // Kiểm tra xem tài khoản đã tồn tại hay chưa
        $existingUser = $this->userModel->checkAccount($request->email);
        if ($existingUser) {
            return redirect()->route('register')->with('error', 'Email đã tồn tại trong hệ thống');
        }

        // Tạo tài khoản mới
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = bcrypt($request->password);
        $user->status = 1; // 1 = active, 0 = inactive
        $user->image = "userDefault.png";
        $user->save();



        // Gửi email chào mừng
        Mail::to($user->email)->send(new WelcomeUser($user));


        return redirect()->route('login')->with('success', 'Đăng ký thành công. Vui lòng kiểm tra email để xác nhận tài khoản của bạn.');
    }

    /*-------------------------------------- */
    public function contact()
    {
        return view('contact');
    }
}

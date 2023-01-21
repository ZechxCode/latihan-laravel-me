<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Seshac\Otp\Otp;
use App\Models\User;
use App\Mail\SendMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use SebastianBergmann\Diff\Exception;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\VerifyOtpRequest;

class UserController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function StoreLogin(LoginRequest $loginRequest)
    {
        $payload = $loginRequest->validated();
        $user = User::where('email', $payload['email'])->first();
        if (!$user) {
            return redirect()->back()->with('error', 'User not found');
        }
        if (Hash::check($payload['password'], $user->password)) {
            Auth::login($user);
            return redirect('/');
        }
        return redirect()->back()->with('error', 'Invalid Credentials');
    }

    public function Logout()
    {
        $user = auth()->user();
        Auth::logout();
        return redirect('/login');
    }
    public function register()
    {
        return view('auth.register');
    }

    public function storeRegister(RegisterRequest $registerRequest)
    {
        $payload = $registerRequest->validated();
        $payload['password'] = Hash::make($payload['password']);
        $user = User::create($payload);
        $this->sendOtpVerification($user->id);
        return redirect('/otp/' . $user->id)->with(['success' => 'Register successful, please verify your email']);
    }

    public function generateOtp($identifier)
    {
        try {
            $otp =  Otp::setValidity(10)  // otp validity time in mins
                ->setLength(6)  // Length of the generated otp
                ->setMaximumOtpsAllowed(10) // Number of times allowed to regenerate otps
                ->setOnlyDigits(true)  // generated otp contains mixed characters ex:ad2312
                ->setUseSameToken(false) // if you re-generate OTP, you will get same token
                ->generate($identifier); // unique token
            // $verify = Otp::setAllowedAttempts(10) // number of times they can allow to attempt with wrong token
            //     ->validate($identifier, $otp->token);
            return $otp;
        } catch (Exception $err) {
            return redirect()->back()->with('error', $err->getMessage());
        }
    }

    public function verifyOtp($identifier, $token)
    {
        try {
            $verify = Otp::setAllowedAttempts(10) // number of times they can allow to attempt with wrong token
                ->validate($identifier, $token);
            return $verify;
        } catch (Exception $err) {
            return redirect()->back()->with('error', $err->getMessage());
        }
    }

    public function sendOtpVerification($userID)
    {
        try {
            $user = User::find($userID);
            if (!$user) {
                return redirect()->back()->with('error', 'User not found');
            }

            $token = $this->generateOtp($user->email);
            return Mail::to($user->email)->send(new SendMessage($user->email, 'Your OTP token : ' . $token->token));
            // return redirect()->back()->with('success', 'OTP token has been sent to your email');
        } catch (Exception $err) {
            return redirect()->back()->with('error', $err->getMessage());
        }
    }


    public function checkOtp(VerifyOtpRequest $verifyOtpRequest, $userID)
    {
        try {
            $payload = $verifyOtpRequest->validated();
            $otp = '';
            foreach ($payload as $key => $item) {
                $otp .= $item;
            }
            rtrim($otp, ',');
            $user = User::find($userID);
            if (!$user) {
                return redirect()->back()->with('error', 'User not found');
            }
            // $email = $this->hideEmail($user->email);
            $verify = $this->verifyOtp($user->email, $otp);
            if ($verify->status == false) {
                return redirect()->back()->with('warning', 'OTP token is invalid');
            }
            $user->email_verified_at = Carbon::now();
            $user->save();
            // Auth::login($user);
            return redirect('/login')->with('success', 'Your account has been verified, please login');
        } catch (Exception $err) {
            return redirect()->back()->with('error', $err->getMessage());
        }
    }

    public function hideEmail($email)
    {
        $email = explode('@', $email);
        $email[0] = substr($email[0], 0, 3) . '****';
        return implode('@', $email);
    }

    public function viewOtp($userID)
    {
        $user = User::find($userID);
        if (!$user) {
            return redirect()->back()->with('error', 'User not found');
        }
        $email = $this->hideEmail($user->email);
        $userID = $user->id;
        return view('auth.otp', compact('email', 'userID'));
    }
}

<?php

namespace App\Http\Controllers;

// use GuzzleHttp\Psr7\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use PragmaRX\Google2FA\Google2FA;
use PragmaRX\Google2FAQRCode\Google2FA as FAQR;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function test(){
        $user = auth()->user();
        return view('test')->with('qr', $user->qr_code);
    }
    
    public function verify(Request $request){
        // return $request->one_time_password;
        $user = User::where('email', $request->email)->first();
        if($user){
        $google2fa = new Google2FA();
        $valid = $google2fa->verifyKey($user->google_key, $request->one_time_password);

        if($valid){
            Auth::login($user);

            return redirect(RouteServiceProvider::HOME);
        }
        else{
            return back()->withErrors(['msg' => 'OTP is Invalid']);
        }
        }   else{
            return back()->withErrors(['msg' => 'User not found']);
        }
    }
}

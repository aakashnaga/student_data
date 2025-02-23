<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;

class MailController extends Controller
{
    public function sendTestEmail()
    {
        $otp = rand(100000, 999999); // Generate a random OTP
        Mail::to('aakashnaga917@gmail.com')->send(new OtpMail($otp));

        return "OTP email sent successfully!";
    }
}

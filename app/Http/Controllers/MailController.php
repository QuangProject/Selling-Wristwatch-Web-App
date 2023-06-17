<?php

namespace App\Http\Controllers;

use App\Mail\ReplyContactEmail;
use App\Mail\WelcomeEmail;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendMail()
    {
        try {
            $userEmail = 'quangnd5802@gmail.com';
            Mail::to($userEmail)->send(new WelcomeEmail());
            return response()->json([
                'message' => 'Send mail successfully',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Send mail failed',
                'error' => $th
            ], 400);
        }
    }

    public function replyContact(Request $request)
    {
        try {
            $full_name = $request->full_name;
            $userEmail = $request->email;
            $subject = $request->subject;
            $reply = $request->reply;
            Mail::to($userEmail)->send(new ReplyContactEmail($full_name, $subject, $reply));
            return response()->json([
                'message' => 'Send mail successfully',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Send mail failed',
                'error' => $th
            ], 400);
        }
    }
}

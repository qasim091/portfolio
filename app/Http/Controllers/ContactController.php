<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;
use ReCaptcha\ReCaptcha;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            // 'g-recaptcha-response' => 'required',
        ]);

        // // Verify reCAPTCHA
        // $recaptcha = new ReCaptcha(env('RECAPTCHA_SECRET_KEY'));
        // $response = $recaptcha->verify($request->input('g-recaptcha-response'), $request->ip());

        // if (!$response->isSuccess()) {
        //     return back()->with('error', 'reCAPTCHA verification failed. Please try again.')->withInput();
        // }

        try {
            $details = [
                'name'    => $request->name,
                'email'   => $request->email,
                'subject' => $request->subject,
                'message' => $request->message,
            ];

            Mail::to(config('mail.from.address'))->send(new ContactMail($details));

            return back()->with('success', 'Your message was sent successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Oops! Something went wrong. Please try again later.');
        }
    }

}

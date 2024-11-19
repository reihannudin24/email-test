<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\YourMailableClass;

class EmailController extends Controller
{
    public function sendEmails()
    {
        $emails = [
            'email1@example.com',
            'email2@example.com',
            'email3@example.com',
        ];

        foreach ($emails as $email) {
            Mail::to($email)->send(new YourMailableClass());
        }

        return 'Emails sent successfully!';
    }
}






Mail::send('emails.example', $data, function ($message) use ($data) {
    $message->to('recipient@example.com') // Ganti dengan email tujuan
    ->subject($data['subject']);
});

return response()->json(['message' => 'Email with template sent successfully!']);

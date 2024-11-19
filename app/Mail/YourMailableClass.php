<?php
namespace App\Mail;

use Illuminate\Mail\Mailable;

class YourMailableClass extends Mailable
{
    public function build()
    {
        return $this->view('emails.test_email')
            ->subject('Test Email Subject');
    }
}

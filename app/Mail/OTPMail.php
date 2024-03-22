<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;

class OTPMail extends Mailable
{
    use Queueable;

    public $content;

    public function __construct($content)
    {
        $this->content = $content;
    }

    public function build(): self
    {
        return $this->subject('Your OTP')->from(env('MAIL_FROM_ADDRESS'))->raw($this->content);
        // return $this->subject('Your OTP')
        //             ->view('emails.otp')
        //             ->with('otp', $this->otp);
    }
}

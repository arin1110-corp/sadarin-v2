<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SadarinOtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $nama;
    public string $otp;

    /**
     * Create a new message instance.
     */
    public function __construct(
        string $nama,
        string $otp
    ) {
        $this->nama = $nama;
        $this->otp = $otp;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this
            ->subject('Kode OTP Login SADARIN')
            ->view('emails.sadarin.otp');
    }
}
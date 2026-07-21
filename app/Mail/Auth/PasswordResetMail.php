<?php

namespace App\Mail\Auth;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PasswordResetMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $token,
        public string $nama,
        public string $email,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Reset Password - AyoKos',
        );
    }

    public function content(): Content
    {
        $url = route('password.reset', ['token' => $this->token, 'email' => $this->email]);

        return new Content(
            html: 'emails.auth.password-reset',
            with: [
                'nama' => $this->nama,
                'url' => $url,
            ],
        );
    }
}

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class User_forget_password extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $email;
    public $user_id;

    public function __construct($name,$email,$user_id)
    {
        $this->name     = $name;
        $this->email    = $email;
        $this->user_id  = $user_id;
    }

    
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'User Forget Password',
        );
    }

   
    public function content(): Content
    {
        return new Content(
            view: 'user.emails.forgetPassword',
        );
    }

   
    public function attachments(): array
    {
        return [];
    }
}
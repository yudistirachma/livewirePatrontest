<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserAccount extends Mailable
{
    use Queueable, SerializesModels;

    public $name, $email, $position, $password;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name,$email,$position,$password)
    {
        $this->name = $name;
        $this->email = $email;
        $this->position = $position;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.userAccount', ['name' => $this->name, 'email' => $this->email, 'position' => $this->position, 'password' => $this->password]);
    }
}
<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NoteNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $note, $sender, $role;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($note = '', $sender = '', $role = '')
    {
        $this->note = $note;
        $this->sender = $sender;
        $this->role = $role;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.createNoteNotification', [
            "note" => $this->note,
            "sender" => $this->sender,
            "role" => $this->role,
            
        ]);
    }
}

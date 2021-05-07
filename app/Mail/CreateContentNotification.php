<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CreateContentNotification extends Mailable
{
    use Queueable, SerializesModels;
    public $name, $title, $deadline, $group_id ;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $jurnalis)
    {
        $this->name = $jurnalis->name;
        $this->title = $data['title'];
        $this->deadline = $data['deadline'];
        $this->group_id = $data['group_id'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.createContentNotification', [
            "name" => $this->name,
            "title" => $this->title,
            "deadline" => $this->deadline,
            "group_id" => $this->group_id,
        ]);
    }
}

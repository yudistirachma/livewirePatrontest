<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GroupNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $name, $group, $redaktur, $journalist ;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $group, $redaktur, $journalist)
    {
        $this->name = $name;
        $this->group = $group;
        $this->redaktur = $redaktur;
        $this->journalist = $journalist;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.newGroupNotification', [
            'name' => $this->name, 
            'group' => $this->group, 
            'redaktur' => $this->redaktur, 
            'journalist' => $this->journalist, 
        ]);
    }
}

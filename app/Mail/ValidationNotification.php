<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ValidationNotification extends Mailable
{
    use Queueable, SerializesModels;
    public $title, $segment, $verification , $idContent ; 

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($content)
    {
        $this->title = $content->title;
        $this->segment = $content->group->segment;
        $this->verification = $content->verification ? $content->verification->format('d, M Y') : "" ;
        $this->idContent = $content->id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.validationNotification', [
            "title" => $this->title,
            "segment" => $this->segment,
            "verification" => $this->verification,
            "idContent" => $this->idContent,
        ]);
    }
}

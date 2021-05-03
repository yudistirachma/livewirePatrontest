<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RequestDeleteContent extends Mailable
{
    use Queueable, SerializesModels;
    public $titleContent, $idContent, $redakturName, $redakturEmail, $redakturId, $segment ;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($content, $redaktur)
    {
        $this->titleContent = $content->title;
        $this->idContent = $content->id;
        $this->redakturName = $redaktur->name;
        $this->redakturEmail = $redaktur->email;
        $this->redakturId = $redaktur->id;
        $this->segment = $content->group->segment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.requestDeleteContent', [
            "titleContent" => $this->titleContent,
            "idContent" => $this->idContent,
            "redakturName" => $this->redakturName,
            "redakturEmail" => $this->redakturEmail,
            "redakturId" => $this->redakturId,
            "segment" => $this->segment,
        ]);
    }
}

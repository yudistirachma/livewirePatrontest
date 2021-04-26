<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CommentNotification extends Mailable
{
    use Queueable, SerializesModels;
    
    public $sender, $titleContent, $segment, $comment, $createdComment, $idContent;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($content, $comment)
    {
        $this->sender = $comment->user->name;
        $this->titleContent = $content->title;
        $this->segment = $content->group->segment;
        $this->comment = $comment->comment;
        $this->createdComment = $comment->created_at->format('d, M Y H:i');
        $this->idContent = $content->id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.commentNotification',[
            "sender" => $this->sender,
            "titleContent" => $this->titleContent,
            "segment" => $this->segment,
            "comment" => $this->comment,
            "createdComment" => $this->createdComment,
            "createdComment" => $this->createdComment,
        ]);
    }
}

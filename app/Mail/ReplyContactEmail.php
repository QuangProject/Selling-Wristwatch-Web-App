<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReplyContactEmail extends Mailable
{
    use Queueable, SerializesModels;
    private $full_name;
    private $responseSubject;
    private $reply;

    /**
     * Create a new message instance.
     */
    public function __construct($full_name, $responseSubject, $reply)
    {
        $this->full_name = $full_name;
        $this->responseSubject = $responseSubject;
        $this->reply = $reply;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Respond to your contact with Watch World',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.reply',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }

    public function build()
    {
        return $this->view('emails.reply')
            ->with([
                'full_name' => $this->full_name,
                'subject' => $this->responseSubject,
                'reply' => $this->reply
            ]);
    }
}

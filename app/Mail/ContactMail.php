<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public array $payload;
    protected string $viewName;
    protected string $mailSubject;
    protected ?string $replyToEmail;
    protected array $mailAttachments;

    /**
     * Create a new message instance.
     */
    public function __construct(array $payload, string $viewName, string $mailSubject, ?string $replyToEmail = null, array $mailAttachments = [])
    {
        $this->payload = $payload;
        $this->viewName = $viewName;
        $this->mailSubject = $mailSubject;
        $this->replyToEmail = $replyToEmail;
        $this->mailAttachments = $mailAttachments;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->mailSubject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        if ($this->replyToEmail) {
            $this->replyTo($this->replyToEmail);
        }

        return new Content(
            view: $this->viewName,
            with: $this->payload,
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return $this->mailAttachments;
    }
}

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Invoice extends Mailable
{
    use Queueable, SerializesModels;

    protected $recipientEmail;
    protected $pdfContent;

    /**
     * Create a new message instance.
     */
    public function __construct($recipientEmail, $pdfContent)
    {
        $this->recipientEmail = $recipientEmail;
        $this->pdfContent = $pdfContent;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('invoice@timcity.com', 'This is my city'),
            subject: 'Invoice - This is my city',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.invoice',
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
        return $this->to($this->recipientEmail)
            ->from('invoice@timcity.com', 'This is my city')
            ->subject('Invoice - This is my city')
            ->view($this->content()->view)
            ->attachData($this->pdfContent, 'invoice.pdf');
    }
}

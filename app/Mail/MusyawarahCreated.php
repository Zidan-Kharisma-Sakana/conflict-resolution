<?php

namespace App\Mail;

use App\Models\Complaint\Musyawarah;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MusyawarahCreated extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(private Musyawarah $musyawarah)
    {
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $pengaduan = $this->musyawarah->pengaduan;
        return new Envelope(
            subject: 'Musyawarah Dijadwalkan',
            to: [
                $pengaduan->pialang->user->email,
                $pengaduan->nasabah->user->email,
            ]
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.musyawarah.created',
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
}

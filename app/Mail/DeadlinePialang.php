<?php

namespace App\Mail;

use App\Models\Complaint\Pengaduan;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DeadlinePialang extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(private Pengaduan $pengaduan)
    {
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $allBappebti = User::where('role', User::IS_BAPPEBTI)->get()->map(function(User $user){
            return $user->email;
        });
        return new Envelope(
            subject: 'Deadline Pialang',
            to:[
                $this->pengaduan->pialang->user->email
            ],
            cc: $allBappebti
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.pengaduan.deadline-pialang',
            with: [
                'pengaduan' => $this->pengaduan
            ]
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

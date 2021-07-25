<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\{User, Message};

class ResponseHim extends Mailable
{
    use Queueable, SerializesModels;

    public $message;
    public $sender;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Message $message, User $sender)
    {
        $this->message = $message;
        $this->sender = $sender;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->sender->email)
            ->markdown('emails.response')
            ->subject('Blood Request')
            ->with([
                'chat' => $this->message,
                'sender' => $this->sender
            ]);;
    }
}

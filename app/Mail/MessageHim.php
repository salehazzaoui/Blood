<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Message;

class MessageHim extends Mailable
{
    use Queueable, SerializesModels;

    public $message;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $url = config('app.url') . '/donor/message/' . $this->message->id . '/' . auth()->user()->email;
        return $this->from(auth()->user()->email)
            ->markdown('emails.message')
            ->subject('Blood Request')
            ->with([
                'sender' => auth()->user(),
                'chat' => $this->message,
                'url' => $url
            ]);
    }
}

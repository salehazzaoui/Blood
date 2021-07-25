<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Contact;

class ContactUs extends Mailable
{
    use Queueable, SerializesModels;

    protected $contact;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->contact->email)
                    ->view('emails.contact')
                    ->subject('Have a suggestion'. $this->contact->name)
                    ->with([
                    'contact' => $this->contact,
                    ]);
    }
}

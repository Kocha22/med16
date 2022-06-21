<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\File;

class SendApproved extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($post_data)
    {
       $this->post_data = $post_data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('admin@programmingfields.com')
        ->view('email.mail-approve')
        ->subject('Одобрена')       
        ->with('post_data', $this->post_data)
        ->attach($this->post_data['file']->getRealPath(),
         [
                    'as' => $this->post_data['file']->getClientOriginalName(),
                    'mime' => $this->post_data['file']->getClientMimeType(),
                ]);
    }
}

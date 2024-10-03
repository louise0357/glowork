<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ExampleMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Örnek Konu') 
                    ->html($this->getContent());
    }

    /**
     * Get the email content.
     *
     * @return string
     */
    protected function getContent()
    {
        return "<html><body>
                    <h1>{$this->data['header']}</h1>
                    <p>{$this->data['message']}</p>
                </body></html>";
    }
}

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TicketReplay extends Mailable
{
    use Queueable, SerializesModels;

    public $mailData;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mailData)
    {
        $this->mailData = $mailData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->view('mail.testMail');

        // $this->withSwiftMessage(function ($message) {
        //     $message->getHeaders()->addTextHeader('In-Reply-To', 'CAKTHnjYqs4Kj1T4JxfZ3viOdiL97Wjcx7G0tX-JLeW2dG8fDEA@mail.gmail.com');
        //     $message->getHeaders()->addTextHeader('References', 'CAKTHnjYqs4Kj1T4JxfZ3viOdiL97Wjcx7G0tX-JLeW2dG8fDEA@mail.gmail.com');
        //     // $message->replyTo('CAF6MMiqyGPKRtWq6af-5sspbJvFMqcPN-V=R7hrL7QFApwbJRg@mail.gmail.com');
        // });


        $this->withSwiftMessage(function ($message){
            $headers = $message->getHeaders();
            $headers->addTextHeader('Message-ID', 'CAKTHnjYqs4Kj1T4JxfZ3viOdiL97Wjcx7G0tX-JLeW2dG8fDEA@mail.gmail.com');
            $headers->addTextHeader('In-Reply-To', '');
            $headers->addTextHeader('References', 'CAKTHnjYqs4Kj1T4JxfZ3viOdiL97Wjcx7G0tX-JLeW2dG8fDEA@mail.gmail.com');
        });



        return $this;
    }
}

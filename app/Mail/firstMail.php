<?php

namespace App\Mail;

use App\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;


class firstMail extends Mailable
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
//        if(Auth::check()) {
//            $user = Auth::user();
//            return $this->subject('ME BIVA')
//                ->view('emails.first')
//                ->with(['username' => $user->email]);
//        }else{
//            return $this->view('emails.first')
//                ->with(['username'=>'GUEST']);
//        }
        return $this->from(Auth::user()->email)->subject($this->message->subject)->view('emails.first');

    }

}

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use Illuminate\Support\Str;

class ForgotPasswordMail extends Mailable
{
    protected $id;
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user = User::find($this->id);
        $token = Str::random(100);
        $user->token = $token;
        $user->save();
        $EmailPath = 'emails.user.forgotpasswordmail';
        $Subject = "Reset Password";
        return $this->subject($Subject)->from('donotreply@theelectrohub.co.uk','The Electro Hub')->view($EmailPath, compact('user' , 'token'));
    }
}

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\Models\User;

class PasswordResetLinkMail extends Mailable
{
    use Queueable, SerializesModels;
    
    public $user;
    public $link;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $link)
    {
      $this->user = $user;
      $this->link = $link;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Lien pour réinitialiser votre mot de passe')
                    ->view('emails.users.password-reset');
    }
}

<?php

namespace Modules\Auth\App\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResetPassword extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(public string $token, public string $code)
    {
        $this->afterCommit();
    }

    /**
     * Build the message.
     */
    public function build(): self
    {
        return $this->markdown('auth::emails.auth.reset');
    }
}

<?php

namespace App\Mail;

use App\Models\Competition;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CompetitionInviteMail extends Mailable
{
    use Queueable, SerializesModels;

    public Competition $competition;

    public User $association;

    public function __construct(Competition $competition, User $association)
    {
        $this->competition = $competition->loadMissing(['partner', 'project']);
        $this->association = $association;
    }

    public function build(): self
    {
        return $this
            ->from('aziz.hamed@esprit.tn', 'UrbanGreen')
            ->subject('Competition Invitation')
            ->view('emails.competitions.invite');
    }
}

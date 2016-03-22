<?php

namespace Unicorn\Jobs;

use Unicorn\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Contracts\Mail\Mailer;
use Unicorn\User;
use Mail;


class SendWelcomeEmail extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    /**
     * Store the user
     *
     * @var User
     */
    protected $user;

    /**
     * Total order value
     *
     * @var int
     */
    protected $total;

    /**
     * Create a new job instance.
     *
     * @param User $user
     * @param int $value
     * @return void
     */
    public function __construct(User $user, $value)
    {
        $this->user = $user;
        $this->total = (float) $value;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Mailer $mailer)
    {
        Mail::send(['email.welcome', 'email.welcome_text'], ['value' => $this->total], function($message) {	
    		$message->to($this->user->email);
    		$message->subject('Greetings from dev.ms');
    	});
    }
}

<?php

namespace App\Jobs\Users;

use App\Mail\FailedJobUpdateUserLogin;
use App\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class UpdateLastLogin implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user, $date;

    public $tries = 3;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, Carbon $date)
    {
        $this->user = $user;
        $this->date = $date;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->user->update([
            'last_login' => $this->date
        ]);
    }

    public function failed()
    {
        Log::error('failed to update user last_login');
        $recipient = 'danny@example.com';
        Mail::to($recipient)->send(new FailedJobUpdateUserLogin($this->user));
    }
}

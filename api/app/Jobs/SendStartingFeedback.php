<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Spatie\WebhookServer\WebhookCall;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SendStartingFeedback implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $users = User::all()->pluck('id');

        WebhookCall::create()
            ->url('http://127.0.0.1:8001/webhook-receiving-url')
            ->payload([
                'users' => $users,
                'link' => 'http://127.0.0.1:8000/feedback-form'
            ])
            ->useSecret(env('WEBHOOK_APP_SECRET'))
            ->dispatch();
    }
}

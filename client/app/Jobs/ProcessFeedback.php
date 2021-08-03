<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use App\Events\FeedbackFormSent;
use Illuminate\Support\Facades\Log;
use App\Notifications\NewFeedbackSent;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Spatie\WebhookClient\ProcessWebhookJob;
use Spatie\WebhookClient\Models\WebhookCall;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class ProcessFeedback extends ProcessWebhookJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 5;

    public WebhookCall $webhookCall;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(WebhookCall $webhookCall)
    {
        $this->webhookCall = $webhookCall;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = json_decode($this->webhookCall, true);

        $payload = $data['payload'];
        $link = $payload['link'];

        foreach ($payload['users'] as $key => $user_id) {
            $userInstance = User::find($user_id);
            if ($userInstance) {
                // Send Notification to email & app(database)
                $userInstance->notify(new NewFeedbackSent($link));
                // fire event to notify user on the UI
                FeedbackFormSent::dispatch($userInstance->id);
            }
        }
    }
}

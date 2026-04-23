<?php
namespace App\Services;

use App\Models\NewsletterSubscriber;
use Illuminate\Support\Facades\Mail;

class BrevoService
{
    public function sendConfirmationEmail(NewsletterSubscriber $subscriber): void
    {
        $confirmUrl = route('newsletter.confirm', $subscriber->token);
        $unsubUrl = route('newsletter.unsubscribe', $subscriber->token);

        Mail::send('emails.newsletter-confirm', compact('subscriber', 'confirmUrl', 'unsubUrl'), function ($message) use ($subscriber) {
            $message->to($subscriber->email, $subscriber->name)
                ->subject(__('newsletter.confirm_subject'));
        });
    }

    public function sendWelcomeEmail(NewsletterSubscriber $subscriber): void
    {
        $unsubUrl = route('newsletter.unsubscribe', $subscriber->token);
        Mail::send('emails.newsletter-welcome', compact('subscriber', 'unsubUrl'), function ($message) use ($subscriber) {
            $message->to($subscriber->email, $subscriber->name)
                ->subject(__('newsletter.welcome_subject'));
        });
    }
}

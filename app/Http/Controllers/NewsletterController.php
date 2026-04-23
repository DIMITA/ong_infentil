<?php
namespace App\Http\Controllers;

use App\Http\Requests\NewsletterRequest;
use App\Models\NewsletterSubscriber;
use App\Services\BrevoService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NewsletterController extends Controller
{
    public function subscribe(NewsletterRequest $request, BrevoService $brevo)
    {
        $subscriber = NewsletterSubscriber::firstOrCreate(
            ['email' => $request->email],
            ['name' => $request->name, 'token' => Str::random(64)]
        );

        if (!$subscriber->isConfirmed()) {
            $brevo->sendConfirmationEmail($subscriber);
        }

        return redirect()->back()->with('newsletter_success', __('newsletter.check_email'));
    }

    public function confirm(string $token)
    {
        $subscriber = NewsletterSubscriber::where('token', $token)->firstOrFail();
        $subscriber->update(['confirmed_at' => now()]);
        return view('pages.newsletter-confirmed');
    }

    public function unsubscribe(string $token)
    {
        $subscriber = NewsletterSubscriber::where('token', $token)->firstOrFail();
        $subscriber->update(['unsubscribed_at' => now()]);
        return view('pages.newsletter-unsubscribed');
    }
}

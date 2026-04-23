<?php
namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Setting;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('pages.contact');
    }

    public function send(ContactRequest $request)
    {
        $contactEmail = Setting::get('contact_email', config('mail.from.address'));

        Mail::send('emails.contact', ['data' => $request->validated()], function ($message) use ($contactEmail, $request) {
            $message->to($contactEmail)
                ->subject('[Contact] ' . $request->subject)
                ->replyTo($request->email, $request->name);
        });

        return redirect()->back()->with('success', __('contact.success'));
    }
}

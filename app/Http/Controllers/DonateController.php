<?php
namespace App\Http\Controllers;

use App\Models\Setting;

class DonateController extends Controller
{
    public function index()
    {
        $donorboxUrl = Setting::get('donorbox_campaign_url', config('app.url').'/donate');
        $kkiapayKey = config('kkiapay.public_key');
        $sandbox = config('kkiapay.sandbox');
        return view('pages.donate', compact('donorboxUrl', 'kkiapayKey', 'sandbox'));
    }

    public function merci()
    {
        return view('pages.donate-merci');
    }
}

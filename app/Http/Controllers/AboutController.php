<?php
namespace App\Http\Controllers;

use App\Models\Partner;
use App\Models\Setting;

class AboutController extends Controller
{
    public function index()
    {
        $partners = Partner::active()->get();
        return view('pages.about', compact('partners'));
    }
}

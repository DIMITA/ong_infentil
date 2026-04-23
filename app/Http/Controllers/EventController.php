<?php
namespace App\Http\Controllers;

use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        $upcomingEvents = Event::active()->upcoming()->get();
        $pastEvents = Event::active()->past()->paginate(9);
        return view('pages.events', compact('upcomingEvents', 'pastEvents'));
    }

    public function show(string $slug)
    {
        $event = Event::where('slug', $slug)->where('is_active', true)->firstOrFail();
        return view('pages.event-show', compact('event'));
    }
}

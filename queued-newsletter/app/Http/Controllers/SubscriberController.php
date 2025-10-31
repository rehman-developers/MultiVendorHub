<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;
use App\Jobs\SendWelcomeEmail;
use Illuminate\Support\Facades\Cache;
use App\Rules\NoProfaneWords;
use App\Events\SubscriberSubscribed;
use App\Http\Resources\SubscriberResource;

class SubscriberController extends Controller
{
    public function showForm()
    {
        $stats = Cache::remember('subscriber_stats', 3600, function () {
            return [
                'total' => Subscriber::count(),
                'today' => Subscriber::whereDate('created_at', today())->count()
            ];
        });
        
        return view('subscribe', compact('stats'));
    }

    public function subscribe(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', new NoProfaneWords],
            'email' => 'required|email|unique:subscribers',
            'profile_pic' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('profile_pic')) {
            $validated['profile_pic'] = $request->file('profile_pic')->store('profiles', 'public');
        }

        $subscriber = Subscriber::create($validated);

        event(new SubscriberSubscribed($subscriber));

        $subscriber->activities()->create([
            'type' => 'subscribe',
            'description' => 'New subscription'
        ]);

        SendWelcomeEmail::dispatch($subscriber); 
        // SendWelcomeNotification::dispatch($subscriber);  // ← COMMENTED

        return redirect()->route('success')->with('success', 'Subscribed!');
    }

    public function apiIndex()
    {
        return SubscriberResource::collection(Subscriber::paginate(10));
    }

    public function dashboard()
{
    $stats = [
        'total_subscribers' => Subscriber::count(),
        'today_subscribers' => Subscriber::whereDate('created_at', today())->count(),
        'active_subscribers' => Subscriber::where('status', 'active')->count(),
    ];

    $subscribers = Subscriber::with('activities')->paginate(10);

    return view('dashboard', compact('stats', 'subscribers'));
}
}
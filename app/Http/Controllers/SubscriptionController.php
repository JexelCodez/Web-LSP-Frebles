<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    // Store function
    public function sendSubscription(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:subscribers,email'
        ]);
        
        $user = Auth::user();
        
        // Check if the user already has a subscriber
        if ($user->subscriber) {
            // If the user already has a subscriber, update its email
            $subscriber = $user->subscriber;
            $subscriber->email = $request->email;
            $subscriber->status = 'active'; // Or set a default status
            $subscriber->save();
        } else {
            // If the user doesn't have a subscriber, create a new one
            $subscriber = new Subscriber();
            $subscriber->email = $request->email;
            $subscriber->status = 'active'; // Or set a default status
            $subscriber->user_id = $user->id; // Set the user_id directly
            $subscriber->save();
        }
        
        // Optionally, send a confirmation email
        
        return redirect()->route('landingpage');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

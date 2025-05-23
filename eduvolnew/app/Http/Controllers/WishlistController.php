<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Wishlist;
use App\Models\Event;

class WishlistController extends Controller
{
    /**
     * Add an event to the user's wishlist.
     */
    public function add(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
        ]);

        $user = Auth::user();
        $eventId = $request->input('event_id');

        // Check if the event is already in the wishlist
        $existingWishlistItem = Wishlist::where('user_id', $user->id)
                                        ->where('event_id', $eventId)
                                        ->first();

        if ($existingWishlistItem) {
            return response()->json(['success' => false, 'message' => 'Event already in wishlist']);
        }

        // Add the event to the wishlist
        Wishlist::create([
            'user_id' => $user->id,
            'event_id' => $eventId,
        ]);

        return response()->json(['success' => true, 'message' => 'Event added to wishlist']);
    }

    /**
     * Display the user's wishlist.
     */
    public function index()
    {
        $user = Auth::user();
        $wishlistItems = Wishlist::where('user_id', $user->id)->with('event')->get();

        // Extract events from wishlist items
        $wishlistEvents = $wishlistItems->map(function ($item) {
            return $item->event;
        });

        return view('wishlist', ['events' => $wishlistEvents]);
    }

    /**
     * Remove an event from the user's wishlist.
     */
    public function remove(Event $event)
    {
        $user = Auth::user();

        $wishlistItem = Wishlist::where('user_id', $user->id)
                                ->where('event_id', $event->id)
                                ->first();

        if ($wishlistItem) {
            $wishlistItem->delete();
            return response()->json(['success' => true, 'message' => 'Event removed from wishlist']);
        } else {
            return response()->json(['success' => false, 'message' => 'Event not found in wishlist'], 404);
        }
    }
}

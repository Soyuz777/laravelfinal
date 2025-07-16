<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Notifications\BookingCreated;

class BookingDashboardController extends Controller
{
    use AuthorizesRequests;

    /**
     * Dashboard View: Shows stats and summary
     */
    public function index()
    {
        $userId = Auth::id();
        $bookings = Booking::where('user_id', $userId)->latest()->get();

        $stats = [
            'total' => $bookings->count(),
            'upcoming' => $bookings->where('status', 'upcoming')->count(),
            'pending' => $bookings->where('status', 'pending')->count(),
            'completed' => $bookings->where('status', 'completed')->count(),
            'users' => Auth::user()->isAdmin() ? User::count() : null,
        ];

        return view('dashboard', compact('bookings', 'stats'));
    }

    /**
     * Bookings Index Page: Shows all bookings (like /bookings)
     */
    public function bookingsIndex()
    {
        $user = Auth::user();
        $bookings = $user->isAdmin()
            ? Booking::latest()->get()
            : Booking::where('user_id', $user->id)->latest()->get();

        return view('bookings.index', compact('bookings'));
    }

    /**
     * Manual Booking Form (view)
     */
    public function createManual()
    {
        return view('bookings.manual');
    }

    /**
     * Store booking from manual form
     */
    public function storeManual(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'time' => 'required',
            'duration' => 'required|integer|min:1',
        ]);

        $conflict = Booking::where('date', $validated['date'])
            ->where('time', $validated['time'])
            ->exists();

        if ($conflict) {
            return redirect()->back()->withInput()->with('error', 'This slot is already booked.');
        }

        $validated['user_id'] = Auth::id();
        $validated['status'] = 'pending';

        $booking = Booking::create($validated);
        Auth::user()->notify(new BookingCreated($booking));

        return redirect()->route('dashboard')->with('success', 'Manual booking created.');
    }

    /**
     * Store a new booking (calendar-based or API)
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = validator($data, [
            'title' => 'required|string',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'time' => 'required',
            'duration' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return $this->respondWithError($request, $validator->errors());
        }

        $validated = $validator->validated();

        $conflict = Booking::where('date', $validated['date'])
            ->where('time', $validated['time'])
            ->exists();

        if ($conflict) {
            return $this->respondWithError($request, ['time' => ['This time slot is already booked!']], 409);
        }

        $validated['user_id'] = Auth::id();
        $validated['status'] = 'pending';

        $booking = Booking::create($validated);
        Auth::user()->notify(new BookingCreated($booking));

        return $this->respondWithSuccess($request, $booking, 'Booking created.');
    }

    /**
     * Edit a booking form
     */
    public function edit(Booking $booking)
    {
        $this->authorize('update', $booking);
        return view('bookings.edit', compact('booking'));
    }

    /**
     * Update an existing booking
     */
    public function update(Request $request, Booking $booking)
    {
        $this->authorize('update', $booking);

        $data = $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'time' => 'required',
            'duration' => 'required|integer',
            'status' => 'required|in:pending,upcoming,completed',
        ]);

        $booking->update($data);

        return redirect()->route('bookings.index')->with('success', 'Booking updated.');
    }

    /**
     * Delete a booking
     */
    public function destroy(Booking $booking)
    {
        $this->authorize('delete', $booking);
        $booking->delete();

        return redirect()->route('bookings.index')->with('success', 'Booking deleted.');
    }

    /**
     * Helper: Handle validation error response
     */
    private function respondWithError($request, $errors, $status = 422)
    {
        return $request->expectsJson() || $request->ajax()
            ? response()->json(['success' => false, 'errors' => $errors], $status)
            : redirect()->back()->withErrors($errors)->withInput();
    }

    /**
     * Helper: Handle success response
     */
    private function respondWithSuccess($request, $booking, $message)
    {
        return $request->expectsJson() || $request->ajax()
            ? response()->json(['success' => true, 'booking' => $booking], 201)
            : redirect()->route('bookings.index')->with('success', $message);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\TeachingSession;

class ProfileController extends Controller
{
    public function index()
    {
        $user = \App\Models\User::find(Auth::id());
        $events = \App\Models\Event::orderBy('start_date', 'desc')->take(2)->get();

        // Milestone data
        $targetHours = $user->target_hours;
        $totalSessions = $user->teachingSessions()->count();
        $totalHours = $user->teachingSessions()->sum('duration');

        // Badge logic
        if ($totalHours >= 1001) $badge = 'gold';
        elseif ($totalHours >= 501) $badge = 'silver';
        elseif ($totalHours >= 1) $badge = 'bronze';
        else $badge = null;

        return view('profile', compact(
            'user', 'events', 'targetHours', 'totalSessions', 'totalHours', 'badge'
        ));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        try {
            $user = Auth::user();
            
            $validated = $request->validate([
                'first_name' => 'required|string|max:100',
                'last_name' => 'required|string|max:100',
                'profession' => 'required|string|max:100',
                'domicile' => 'required|string|max:100',
                'mobile_phone' => 'nullable|string|max:20',
                'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
            ]);

            // Pastikan email tidak diubah
            unset($validated['email']);

            // Handle photo upload
            if ($request->hasFile('profile_photo')) {
                // Delete old photo if exists
                if ($user->profile_photo) {
                    Storage::disk('public')->delete($user->profile_photo);
                }

                // Store the new photo
                $path = $request->file('profile_photo')->store('profile-photos', 'public');
                $validated['profile_photo'] = $path;

                // Log success
                Log::info('Profile photo uploaded successfully', [
                    'user_id' => $user->id,
                    'path' => $path
                ]);
            }

            // Remove profile_photo from validated data if no new photo was uploaded
            if (!$request->hasFile('profile_photo')) {
                unset($validated['profile_photo']);
            }

            // Update user data
            $user->update($validated);

            // Refresh session user
            Auth::setUser($user->fresh());

            // Log the successful update
            Log::info('Profile updated successfully', [
                'user_id' => $user->id,
                'updated_fields' => array_keys($validated)
            ]);

            return redirect()->route('profile')
                ->with('success', 'Profil berhasil diperbarui');

        } catch (\Exception $e) {
            // Log the error
            Log::error('Profile update failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return back()
                ->withInput()
                ->withErrors(['error' => 'Gagal memperbarui profil. ' . $e->getMessage()]);
        }
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini tidak sesuai']);
        }

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('profile')
            ->with('success', 'Password berhasil diubah');
    }

    public function updateAvatar(Request $request)
    {
        try {
            $request->validate([
                'profile_photo' => 'required|image|mimes:jpeg,png,jpg|max:2048'
            ]);

            $user = Auth::user();

            // Delete old photo if exists
            if ($user->profile_photo) {
                Storage::disk('public')->delete($user->profile_photo);
            }

            // Store the new photo
            $path = $request->file('profile_photo')->store('profile-photos', 'public');

            // Update user
            $user->update(['profile_photo' => $path]);

            // Log success
            Log::info('Avatar updated successfully', [
                'user_id' => $user->id,
                'path' => $path
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Foto profil berhasil diperbarui',
                'path' => Storage::url($path)
            ]);

        } catch (\Exception $e) {
            Log::error('Avatar update failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupload foto profil: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show()
    {
        $user = Auth::user();
        $targetHours = $user->target_hours;
        $totalSessions = $user->teachingSessions()->count();
        $totalHours = $user->teachingSessions()->sum('duration');

        // Badge logic
        if ($totalHours >= 1001) $badge = 'gold';
        elseif ($totalHours >= 501) $badge = 'silver';
        elseif ($totalHours >= 1) $badge = 'bronze';
        else $badge = null;

        return view('profile', compact(
            'user', 'targetHours', 'totalSessions', 'totalHours', 'badge'
        ));
    }

    public function editTarget()
    {
        $user = Auth::user();
        $targetHours = $user->target_hours;
        return view('profile.edit_target', compact('targetHours'));
    }

    public function updateTarget(Request $request)
    {
        $request->validate([
            'target_hours' => 'required|integer|min:1|max:5000'
        ]);
        $user = Auth::user();
        $user->target_hours = $request->target_hours;
        $user->save();

        return redirect()->route('profile')->with('success', 'Target hours updated!');
    }
} 
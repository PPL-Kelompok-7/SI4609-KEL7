<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // Get the currently authenticated user
        return view('profile', compact('user'));
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
                'mobile_phone' => 'required|string|max:20',
                'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
            ]);

            // Handle photo upload
            if ($request->hasFile('profile_photo')) {
                $file = $request->file('profile_photo');
                
                // Log file information for debugging
                \Log::info('Uploading profile photo', [
                    'original_name' => $file->getClientOriginalName(),
                    'mime_type' => $file->getMimeType(),
                    'size' => $file->getSize()
                ]);

                try {
                    // Delete old photo if exists
                    if ($user->profile_photo && Storage::disk('public')->exists($user->profile_photo)) {
                        Storage::disk('public')->delete($user->profile_photo);
                    }

                    // Generate unique filename
                    $filename = 'profile-photos/' . uniqid('profile_') . '_' . time() . '.' . $file->getClientOriginalExtension();
                    
                    // Store file directly using Storage facade
                    Storage::disk('public')->put($filename, file_get_contents($file));
                    
                    // Update the path in validated data
                    $validated['profile_photo'] = $filename;

                    // Log success
                    \Log::info('Profile photo uploaded successfully', [
                        'path' => $filename
                    ]);
                } catch (\Exception $e) {
                    \Log::error('Failed to upload profile photo', [
                        'error' => $e->getMessage(),
                        'trace' => $e->getTraceAsString()
                    ]);
                    throw new \Exception('Gagal mengupload foto profil: ' . $e->getMessage());
                }
            }

            // Update user data
            $user->update($validated);

            // Log the successful update
            \Log::info('Profile updated successfully', [
                'user_id' => $user->id,
                'updated_fields' => array_keys($validated)
            ]);

            return redirect()->route('profile')
                ->with('success', 'Profil berhasil diperbarui');

        } catch (\Exception $e) {
            // Log the error
            \Log::error('Profile update failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return back()
                ->withInput()
                ->withErrors(['error' => 'Gagal memperbarui profil. ' . $e->getMessage()]);
        }
    }

    // Metode baru untuk mengubah password
    public function changePassword(Request $request)
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

    // Metode baru untuk mengubah email
    public function changeEmail(Request $request)
    {
        $request->validate([
            'new_email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Password tidak sesuai']);
        }

        // Di sini bisa ditambahkan logika untuk mengirim email verifikasi
        // ke alamat email baru sebelum benar-benar mengubah email

        $user->email = $request->new_email;
        $user->save();

        return redirect()->route('profile')
            ->with('success', 'Email berhasil diubah');
    }
} 
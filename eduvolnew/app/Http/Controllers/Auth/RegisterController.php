<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        try {
            // Log the incoming request data
            Log::info('Registration attempt', ['request_data' => $request->all()]);

            // Validate request
            $validated = $request->validate([
                'first_name' => 'required|string|max:100',
                'last_name' => 'required|string|max:100',
                'birth_date' => 'required|date',
                'profession' => 'required|string|max:100',
                'domicile' => 'required|string|max:100',
                'email' => 'required|string|email|max:100|unique:users',
                'password' => 'required|string|min:8|confirmed',
                'terms_agreed' => 'required|accepted'
            ]);

            // Log the validation success
            Log::info('Registration validation passed', ['data' => $validated]);

            // Create user
            $user = User::create([
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'birth_date' => $validated['birth_date'],
                'profession' => $validated['profession'],
                'domicile' => $validated['domicile'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'terms_agreed' => true,
                'role_id' => 3 // Default role for participant
            ]);

            // Log the successful user creation
            Log::info('User created successfully', ['user_id' => $user->id]);

            // Redirect with success message
            return redirect()->route('login')
                ->with('success', 'Registration successful! Please login.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Log validation errors
            Log::error('Registration validation failed', [
                'errors' => $e->errors(),
                'data' => $request->all()
            ]);
            throw $e;
        } catch (\Exception $e) {
            // Log any other errors with full stack trace
            Log::error('Registration failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'data' => $request->all()
            ]);

            // Redirect back with error
            return back()
                ->withInput()
                ->withErrors(['error' => 'Registration failed. Please try again. Error: ' . $e->getMessage()]);
        }
    }
} 
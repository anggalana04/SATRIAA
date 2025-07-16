<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('organisasi.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('autentikasi.registrasi');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|string|min:3',
            'jenis' => 'required|in:individu,organisasi,admin',
        ]);

        // Hash the password
        $validatedData['password'] =  Hash::make('password'); // Password encryption

        try {
            // Create the user
            $user = User::create($validatedData);

            // Redirect to the appropriate profile creation form
            Auth::login($user);
            if ($user->jenis === 'individu') {
                return redirect()->route('profil_relawan.create')->with('success', 'User created successfully. Please complete your profile.');
            } elseif ($user->jenis === 'admin') {
                return redirect()->route('dashboardAdmin')->with('success', 'User created successfully. Please complete your profile.');
            }



            return redirect()->route('organisasi.create')->with('success', 'User created successfully. Please complete your organization profile.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create user: ' . $e->getMessage());
        }
    }




    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::find($id);
        // Show edit form with existing user data
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // Validate input
        $validatedData = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id . '|max:255',
            'password' => 'nullable|string|min:3',
            'jenis' => 'required|in:individu,organisasi,admin',
        ]);

        // Update password if provided
        if ($request->password) {
            $validatedData['password'] = Hash::make($request->password);
        } else {
            unset($validatedData['password']);
        }

        try {
            // Update the user
            $user->update($validatedData);
            return redirect()->route('dashboardAdmin')->with('success', 'User updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update user: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }

    /**
     * Custom method to create a user.
     */
    public function createUser(Request $request)
    {
        // Your custom logic to create a user goes here.
    }
}

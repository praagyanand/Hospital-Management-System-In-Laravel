<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\User;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::with('user')->paginate(10);
        return view('doctors.index', compact('doctors'));
    }

    public function create()
    {
        return view('doctors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'specialization' => 'required',
            'license_number' => 'required|unique:doctors'
        ]);

        // Create User
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt('password'),
            'role' => 'doctor'
        ]);

        // Create Doctor
        Doctor::create([
            'user_id' => $user->id,
            'specialization' => $request->specialization,
            'license_number' => $request->license_number
        ]);

        return redirect()->route('doctors.index')->with('success', 'Doctor added!');
    }
}
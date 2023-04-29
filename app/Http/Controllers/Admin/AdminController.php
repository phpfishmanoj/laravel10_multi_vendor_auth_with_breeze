<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rules\Password;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function Index()
    {
        return view('admin.admin_login');
        //
    }

    public function Register()
    {
        return view('admin.admin_register');
    }

    public function RegisterProcess(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:admins,email',
            'password' => [
                'required',
                Password::min(8)
                    ->mixedCase()
                    ->letters()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
            ],
            'confirmPassword' => 'required|same:password',
        ], [
            'confirmPassword.required' => 'Please re-enter the password',
            'confirmPassword.same' => 'Password must be same',
        ]);

        Admin::create([
            'name' => $credentials['name'],
            'email' => $credentials['email'],
            'password' => bcrypt($credentials['password']),
            'created_at' => Carbon::now()
        ]);

        return redirect()->route('admin_login_form')->with('success', 'Register successfully, please login');
    }
    public function Login(Request $request): RedirectResponse
    {

        //dd($request->all());
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.dashboard')->with('success', 'Admin login successfully');
        } else {
            return redirect()->route('admin_login_form')->with('error', 'Invalid Email or Password.');
        }
        //
    }

    public function Logout(Request $request): RedirectResponse
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();
        return redirect()->route('admin_login_form')->with('success', 'Admin logout successfully');
    }
    public function Dashboard()
    {
        return view('admin.index');
        //
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

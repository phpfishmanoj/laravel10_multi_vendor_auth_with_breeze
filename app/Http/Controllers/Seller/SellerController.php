<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Seller;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function Index()
    {
        return view('seller.seller_login');
        //
    }

    public function Register()
    {
        return view('seller.seller_register');
    }

    public function RegisterProcess(Request $request): RedirectResponse
    {
        //dd($request->all());
        $credentials = $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:sellers,email',
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

        Seller::create([
            'name' => $credentials['name'],
            'email' => $credentials['email'],
            'password' => bcrypt($credentials['password']),
            'created_at' => Carbon::now()
        ]);

        return redirect()->route('seller_login_form')->with('success', 'Register successfully, please login');
    }
    public function Login(Request $request): RedirectResponse
    {

        //dd($request->all());
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('seller')->attempt($credentials)) {
            return redirect()->route('seller.seller_dashboard')->with('success', 'Seller login successfully');
        } else {
            return redirect()->route('seller_login_form')->with('error', 'Invalid Email or Password.');
        }
        //
    }

    public function Logout(Request $request): RedirectResponse
    {
        Auth::guard('seller')->logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();
        return redirect()->route('seller_login_form')->with('success', 'Seller logout successfully');
    }
    public function Dashboard()
    {
        return view('seller.index');
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

<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Routing\Controller;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\Inertia;

class RegisterController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Auth/Register');
    }

    public function store(Request $request): RedirectResponse
    {
        // return $request;
        $validated = $request->validate([
            'email' => 'required|string|email|max:255|unique:users',
            'username' => 'required|string|max:255|unique:users',
            'name' => 'required|string|max:255',
            'password' => 'required|min:8'
        ]);
        User::create($validated);
        return redirect('/login');
    }
}

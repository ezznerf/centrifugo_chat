<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Mockery\Exception;

class RegistrationController extends Controller
{
    public function index()
    {
        return view('registration.index');
    }
    public function registration(RegistrationRequest $request): RedirectResponse{
        try {
            $validated = $request->validated();

            $user = new User();
            $user->email = $validated['email'];
            $user->password = $validated['password'];
            $user->name = $validated['name'];
            $user->save();

            return Redirect::route('login');
        }catch (Exception){
            return back()->withErrors(['error' => 'Registration error, try again later'])->withInput();
        }

    }
}

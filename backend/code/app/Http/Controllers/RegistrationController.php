<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class RegistrationController extends Controller
{
    public function register(RegistrationRequest $request): RedirectResponse{
        $validated = $request->validated();

        $user = new User();
        $user->email = $validated['email'];
        $user->password = $validated['password'];
        $user->name = $validated['name'];
        $user->save();

        return Redirect::route('login');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;


use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function create_user(UserRequest $request)
    {

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'ps1' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'string', 'in:admin,commercial,prop_store'],
        ]);

        $validated['ps1'] = Hash::make($validated['ps1']);

        User::create([

            'name' => $request->name,
            'email' => $request->email,
            'password' =>  $validated['ps1'],
            'role' => $validated['role'],
            
        ]);

       

        // return dd($request-> all() ) ;

        return redirect()->route('dashboard')->with('success', 'utilisateur ajouté');

    }
}

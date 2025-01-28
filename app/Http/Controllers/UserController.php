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


    public function dashboard() {
        $store_users = User::where('role' , "prop_store" )->  
        orderBy('created_at', 'desc') -> paginate(10) ;

        $commerciaux = User::where('role' , "commercial" ) -> 
        orderBy('created_at', 'desc') -> paginate(10) ;

        $admins = User::where('role' , "admin" ) -> 
        orderBy('created_at', 'desc') -> paginate(10) ;

        return  view("dashboard" , compact("store_users" , "commerciaux" , 'admins' ) ) ;
    }

     

    public function delete_user( $id ) {
         
        User::find($id) -> delete( ) ;

        return  view("dashboard" )  -> with("success"  , "utilisateur supprimé" ) ;
    }


    public function create_user(UserRequest $request)
    {

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'ps1' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'string', 'in:admin,commercial,prop_store'],
            'tlf' => ['required', 'numeric' ],
        ]);

        // get_all_store_users

        $validated['ps1'] = Hash::make($validated['ps1']);

        User::create([

            'name' => $request->name,
            'email' => $request->email,
            'password' =>  $validated['ps1'],
            'role' => $validated['role'],
            'tlf' => $validated['tlf'],
            
        ]);


        // return dd($request-> all() ) ;

        return redirect()->route('dashboard')->with('success', 'utilisateur ajouté');

    }


    public function get_all_store_users() {
        $store_users = User::where('role' , "prop_store" )  ;
        return $store_users ;
    }


}

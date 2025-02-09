<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Store;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use Illuminate\Support\Facades\DB;
// Use App\Models\Store;
// use App\Http\Controllers\StoreController; 
use Illuminate\Http\Request;

class UserController extends StoreController
{


    public function dashboard()
    {
        $store_users = User::where('role', "prop_store")->orderBy('created_at', 'desc')->paginate(10);

        $commerciaux = User::where('role', "commercial")->orderBy('created_at', 'desc')->paginate(10);

        $admins = User::where('role', "admin")->orderBy('created_at', 'desc')->paginate(10);

        $nb_stores = $this->get_nb_stores();

        return  view("dashboard", compact("store_users", "commerciaux", 'admins', "nb_stores"));
    }


    public function dashboard_commercial()
    {

        $nb_stores =  Store::where('id_added_by_com', '=', Auth::user()->id)->count();

        return  view("commercials.dashboard_commercial", compact("nb_stores"));
    }



    public function delete_user($id)
    {

        $user =  User::find($id);
        $count_admins = User::Where('role', '=', "admin")->count();
        


        if ($user) {

            if (($user->role) != "admin") {

                $user->delete();
                return  redirect()->back()->with("success", "utilisateur supprimé");

            } else {

              

                if ($count_admins > 1 ) {

                    $user->delete();
                    return  redirect()->back()->with("success", "utilisateur supprimé");

                } else {
                    return  redirect()->back()->with("error", "c'est le dernier Admin! impossible de le supprimer");
                }
 
            }
        } else {
            return redirect()->back()->with("error", "utilisateur introuvable");
        }
    }


    public function create_user(UserRequest $request)
    {

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'ps1' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'string', 'in:admin,commercial,prop_store'],
            'tlf' => ['required', 'numeric'],
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

        return redirect()->route('dashboard')->with('success', 'Utilisateur ajouté');
    }


    public function get_all_store_users()
    {
        $store_users = User::where('role', "prop_store");
        return $store_users;
    }

    public function create_store_page()
    {

        return  view("commercials.create_store_page");
    }



    public function create_store(UserRequest $request)
    {

        $id_user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'tlf' => $request->tlf,
            'adresse' => $request->adresse,
            'role' =>  'prop_store',
        ]);

        if ($id_user) {

            Store::create([
                'store_name' => $request->store_name,
                'id_added_by_com' =>  Auth::user()->id,
                'id_prop' => $id_user->id,
                'total_to_pay' => 0,
            ]);

            return redirect()->back()->with("success", "Store ajouté");
        } else {

            return redirect()->back()->with("error", "Erreur ");
        }

        return  view("commercials.create_store_page")->with("error", "Erreur ");
    }


    public function dashboard_store()
    {

        $info_store = Store::where('id_prop', '=', (Auth::user()->id))->get();

        return  view("stores.dashboard_store", compact('info_store'));
    }


    public function update_admin_page($id)
    {

        $info_user = User::find($id);
        if ($info_user && ($info_user->role == "admin")) {
            return  view("admin.update_user_page", compact('info_user'));
        } else {
            return  redirect()->route('dashboard')->with('error', 'erreur1 !');
        }
    }



    public function update_admin($id, UserRequest $request)
    {

        $info_user = User::find($id);
        if ($info_user && ($info_user->role == "admin")) {

            if ($request->ps1 == $request->ps1_confirmation) {

                $info_user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => $request->ps1,
                    'tlf' => $request->tlf,

                ]);

                return   redirect()->back()->with('success', 'Admin modifié!');
            } else {
                return  redirect()->back()->with('error', 'erreur du mot de passe !');
            }
        } else {
            return  redirect()->back()->with('error', 'erreur du Id !');
        }
    }




    public function update_commercial_page($id)
    {

        $info_user = User::find($id);
        if ($info_user && ($info_user->role == "commercial")) {
            return  view("commercials.update_commercial_page", compact('info_user'));
        } else {
            return  redirect()->route('dashboard')->with('error', 'erreur2 !');
        }
    }



    public function update_commercial($id, UserRequest $request)
    {

        $info_user = User::find($id);
        if ($info_user && ($info_user->role == "commercial")) {

            if ($request->ps1 == $request->ps1_confirmation) {

                $info_user->update([

                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => $request->ps1,
                    'tlf' => $request->tlf,

                ]);

                return   redirect()->back()->with('success', 'commercial modifié!');
            } else {
                return  redirect()->back()->with('error', 'erreur du mot de passe !');
            }
        } else {
            return  redirect()->back()->with('error', 'erreur du Id !');
        }
    }
}

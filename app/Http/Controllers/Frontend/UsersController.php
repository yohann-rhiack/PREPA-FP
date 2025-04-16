<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;

class UsersController extends Controller
{
    public function index()
    {
        $title = 'Gestionnaire des Utilisateurs';
        $users = User::all();
        $roles = Role::all();
        return view('frontend.utilisateur', compact('title', 'users', 'roles'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'nullable|string|max:255',
            'phone' => 'required|numeric',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role_id' => 'required|exists:roles,id',
        ]);
        User::create([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $request->role_id, // Associer le rôle
        ]);

        return redirect()->back()->with('success', 'Utilisateur ajouté avec succès.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $title = 'Modifier Utilisateur';
        $roles = Role::all();
        return view('frontend.edit-utilisateur', compact('title', 'user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $validated = $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'nullable|string',
            'phone' => 'required|numeric',
            'email' => 'required|email|unique:users,email,' . $id,
            'role_id' => 'required|exists:roles,id',
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'fname' => $validated['fname'],
            'lname' => $validated['lname'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'role_id' => $validated['role_id'], // Mise à jour du role associé
        ]);

        return redirect()->route('frontend.utilisateur')->with('success', 'Utilisateur mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return back()->with('success', 'Utilisateur supprimé avec succès.');
    }

    public function show($id)
    {
        $users = User::with('role')->findOrFail($id);
        $title = 'Détails Utilisateur';
        return view('frontend.show-utilisateur', compact('users','title'));
    }
}

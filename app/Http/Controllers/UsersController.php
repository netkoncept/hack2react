<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $users = User::paginate();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password'))
        ]);
        session()->flash('flash.banner', 'Dodano użytkownika: ' . $request->get('name'));
        return to_route('users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $attributes = [
            'name' => $request->get('name'),
            'email' => $request->get('email')
        ];

        if ($request->has('password')) {
            $attributes['password'] = Hash::make($request->get('password'));
        }

        $user->update($attributes);
        session()->flash('flash.banner', 'Zapisano użytkownika: ' . $user->name);
        return to_route('users.edit', $user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if ($user->id == auth()->id()) {
            session()->flash('flash.banner', 'Nie można usunąć swojego konta użytkownika');
            session()->flash('flash.bannerStyle', 'danger');
            return to_route('users.index');
        }
        $user->delete();
        session()->flash('flash.banner', 'Usunięto użytkownika: ' . $user->name);

        return to_route('users.index');
    }
}

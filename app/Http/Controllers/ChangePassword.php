<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ChangePassword extends Controller
{

    protected $user;

    public function __construct()
    {
        Auth::logout();

        $id = intval(request()->id);
        $this->user = User::find($id);
    }

    public function show()
    {
        return view('auth.change-password');
    }

    public function update(Request $request)
    {
        $attributes = $request->validate([
            'email' => ['required'],
            'password' => ['required', 'min:8'],
            'confirm-password' => ['same:password']
        ]);

        $request['password'] = Hash::make($request['password']); // ou bcrypt($data['senha']);

        $existingUser = User::where('email', $attributes['email'])->first();
        if ($existingUser) {
            $existingUser->update([
                'password' => $request['password'] 
            ]);
            return redirect('entrar')->with('msg', 'Senha redefinida com sucesso.');
        } else {
            return back()->with('msg', 'Seu e-mail não corresponde ao e-mail de quem solicitou a alteração da senha');
        }
    }
}

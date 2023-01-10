<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{

    protected $user;

    public function __construct()
    {
        $id = intval(request()->id);
        $this->user = User::find($id);
    }

    public function trocarSenha()
    {
        return view('senha.grid');
    }

    public function trocarSenhaperform(Request $request)
    {
        $attributes = $request->validate([
            'password' => ['required', 'min:8'],
            'confirm-password' => ['same:password']
        ]);

        $request['password'] = Hash::make($request['password']); // ou bcrypt($data['senha']);

        $existingUser = User::where('id', Auth::user()->id)->first();
        if ($existingUser) {
            $existingUser->update([
                'password' => $request['password'] 
            ]);
            return redirect('trocar-senha')->with('msg','Senha redefinida com sucesso.');
        } else {
            return back()->with('msg', 'Houve uma falha.');
        }
    }
}

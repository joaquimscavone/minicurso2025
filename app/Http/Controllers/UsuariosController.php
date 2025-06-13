<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsuariosController extends Controller
{
    //listar todos os usuários
    public function index(){
        $total = User::count();
        $tecnicos = User::where('tecnico',true)->count();
        $admins = User::where('admin',true)->count();
        $usuarios = User::all();
        return view('usuarios',compact('total','tecnicos','admins','usuarios'));
    }
    public function changeTecnico(User $user){
        $user->tecnico = !$user->tecnico;
        $user->save();
        return redirect()->route('usuarios')->with('Success',"$user->name atualizado com sucesso!");
    }
    public function changeAdmin(User $user){
        $user->admin = !$user->admin;
        $user->save();
        return redirect()->route('usuarios')->with('Success',"$user->name atualizado com sucesso!");
    }
}

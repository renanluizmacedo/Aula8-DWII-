<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

class ClienteController extends Controller
{



    public function index()
    {

        $dados = Cliente::with(['endereco'])->get();
        $clinica = "VetClin DWII";

        return view('clientes.index', compact(['dados', 'clinica']));
    }

    public function create()
    {

        return view('clientes.create');
    }

    public function store(Request $request)
    {
        $regras = [
            'nome' => 'required|max:100|min:10',
            'email' => 'required|max:150|min:15|unique:clientes',
            'telefone' => 'required|min:9',
        ];

        $msgs = [
            "required" => "O preenchimento do campo [:attribute] é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
            "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!",
            "unique" => "Já existe um endereço cadastrado com esse [:attribute]!"
        ];
    
        $request->validate($regras, $msgs);

        Cliente::create([
            'nome' => mb_strtoupper($request->nome, 'UTF-8'),
            'email' => $request->email,
            'telefone' => $request->telefone,
            'endereco_id' => 1,
        ]);

        return redirect()->route('clientes.index');
    }

    public function show($id)
    {

        $dados = Cliente::find($id);

        if (!isset($dados)) {
            return "<h1>ID: $id não encontrado!</h1>";
        }

        return view('clientes.show', compact('dados'));
    }

    public function edit($id)
    {

        $dados = Cliente::find($id);

        if (!isset($dados)) {
            return "<h1>ID: $id não encontrado!</h1>";
        }

        return view('clientes.edit', compact('dados'));
    }

    public function update(Request $request, $id)
    {

        $obj = Cliente::find($id);

        if (!isset($obj)) {
            return "<h1>ID: $id não encontrado!";
        }

        $obj->fill([
            'nome' => mb_strtoupper($request->nome, 'UTF-8'),
            'email' => $request->email,
            'telefone' => $request->telefone,
            'endereco_id' => 1,
        ]);

        $obj->save();

        return redirect()->route('clientes.index');
    }

    public function destroy($id)
    {
        $obj = Cliente::find($id);

        if (!isset($obj)) {
            return "<h1>ID: $id não encontrado!";
        }

        $obj->destroy($id);

        return redirect()->route('clientes.index');
    }
}

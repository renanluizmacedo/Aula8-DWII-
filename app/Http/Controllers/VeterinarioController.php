<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VeterinarioController extends Controller
{

    public $veterinarios = [[
        "id" => 0,
        "crmv" => 123456789,
        "nome" => "Gil Eduardo",
        "especialidade" => "Cirugia"
    ]];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $aux = session('veterinarios');


        if (!isset($aux)) {
            session(['veterinarios' => $this->veterinarios]);
        }
    }

    public function index()
    {
        $dados = session('veterinarios');
        $clinica = "VetClin DWII";

        // Passa um array "dados" com os "clientes" e a string "clínicas"
        return view('veterinarios.index', compact(['dados', 'clinica']));
        // return view('cliente.index')->with('dados', $dados)->with('clinica', $clinica);    }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('veterinarios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $aux = session('veterinarios');
        $ids = array_column($aux, 'id');

        if (count($ids) > 0) {
            $new_id = max($ids) + 1;
        } else {
            $new_id = 1;
        }

        $novo = [
            "id" => $new_id,
            "crmv" => $request->crmv,
            "nome" => $request->nome,
            "especialidade" => $request->especialidade
        ];

        array_push($aux, $novo);
        session(['veterinarios' => $aux]);

        return redirect()->route('veterinarios.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $aux = session('veterinarios');

        $index = array_search($id, array_column($aux, 'id'));

        $dados = $aux[$index];

        return view('veterinarios.show', compact('dados')); //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $aux = session('veterinarios');

        $aux = $this->backup($aux);

        $index = array_search($id, array_column($aux, 'id'));

        $dados = $aux[$index];


        return view('veterinarios.edit', compact('dados'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $aux = session('veterinarios');

        $index = array_search($id, array_column($aux, 'id'));

        $novo = [
            "id" => $id,
            "crmv" => $request->crmv,
            "nome" => $request->nome,
            "especialidade" => $request->especialidade
        ];


        $aux[$index] = $novo;
        session(['veterinarios' => $aux]);

        return redirect()->route('veterinarios.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $aux = session('veterinarios');

        $index = array_search($id, array_column($aux, 'id'));

        $aux = $this->backup($aux);

        unset($aux[$index]);


        session(['veterinarios' => $aux]);

        return redirect()->route('veterinarios.index');
    }
    public function backup($dados)
    {
        $i = 0;
        foreach ($dados as $dado) {
            $new[$i] = $dado;
            $i++;
        }

        return $new;
    }
}

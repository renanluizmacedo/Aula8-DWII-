<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PetController extends Controller
{

    public $pets = [[
        "id" => 1,
        "nome" => "Rex",
        "raca" => "Rottweiler"
    ]];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $aux = session('pets');

        if (!isset($aux)) {
            session(['pets' => $this->pets]);
        }
    }
    public function index()
    {
        $dados = session('pets');
        $clinica = "VetClin DWII";

        // Passa um array "dados" com os "clientes" e a string "clínicas"
        return view('pets.index', compact(['dados', 'clinica']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pets.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $aux = session('pets');
        $ids = array_column($aux, 'id');

        if (count($ids) > 0) {
            $new_id = max($ids) + 1;
        } else {
            $new_id = 1;
        }

        $novo = [
            "id" => $new_id,
            "nome" => $request->nome,
            "raca" => $request->raca
        ];

        array_push($aux, $novo);
        session(['pets' => $aux]);

        return redirect()->route('pets.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $aux = session('pets');

        $index = array_search($id, array_column($aux, 'id'));

        $dados = $aux[$index];

        return view('pets.show', compact('dados'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $aux = session('pets');

        $index = array_search($id, array_column($aux, 'id'));

        $dados = $aux[$index];

        return view('pets.edit', compact('dados'));
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
        $aux = session('pets');

        $index = array_search($id, array_column($aux, 'id'));

        $novo = [
            "id" => $id,
            "nome" => $request->nome,
            "raca" => $request->raca,
        ];

        $aux[$index] = $novo;
        session(['pets' => $aux]);

        return redirect()->route('pets.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $aux = session('pets');
        
        $index = array_search($id, array_column($aux, 'id')); 

        unset($aux[$index]);

        session(['pets' => $aux]);

        return redirect()->route('pets.index'); 
       }
}

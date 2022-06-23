<!-- Herda o layout padrão definido no template "main" -->
@extends('templates.main', ['titulo' => "Pets", 'rota' => "pets.create"])
<!-- Preenche o conteúdo da seção "titulo" -->
@section('titulo') Pets @endsection
<!-- Preenche o conteúdo da seção "conteudo" -->
@section('conteudo')

    <div class="row">
        <div class="col">
            
            <!-- Utiliza o componente "datalist" criado -->
            <x-datalistPet
                :header="['ID', 'NOME', 'RAÇA', 'AÇÕES']" 
                :data="$dados"
                :hide="[true, true, true, false]" 
            />

        </div>
    </div>
@endsection
<!-- Herda o layout padrão definido no template "main" -->
@extends('templates.main', ['titulo' => "Especialidades", 'rota' => "especialidades.create"])
<!-- Preenche o conteúdo da seção "titulo" -->
@section('titulo') - Especialidades @endsection
<!-- Preenche o conteúdo da seção "conteudo" -->
@section('conteudo')

<div class="row">
    <div class="col">

        <!-- Utiliza o componente "datalist" criado -->
        <x-datalistEspecialidades :header="['NOME', 'DESCRICÃO', 'AÇÕES']" 
        :data="$dados" 
        :hide="[ false, true, false]" />

    </div>

</div>
@endsection
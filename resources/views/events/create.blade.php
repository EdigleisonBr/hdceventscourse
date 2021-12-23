@extends('layouts.main')

@section('title', 'Criar Evento')

@section('content')

@include('sweetalert::alert')

<?php
$teste = Auth::user()->id;
?>

<div id="event-create-container" class="col-md-12">
    <h1>Crie seu evento</h1>
    <form action="/events" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <!-- image -->
            <div class="form-group border rounded p-1 col-md-6">
                <label for="image">Imagem do Evento:</label>
                <input type="file" id="image" name="image" class="form-control-input">
            </div> 
        </div>

        <div class="row">
            <!-- event -->
            <div class="form-group col-md-6">
                <label for="title">Evento:</label>
                <input type="text" class="form-control teste" id="title" name="title" onblur="validaNome(this)"  placeholder="Nome do evento">
                <!-- <input type="text" class="form-control text-uppercase" id="title" name="title" placeholder="Nome do evento"> -->
            </div>
        
            <!-- errors -->
            @if(count($errors)>0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
  
            <!-- date -->
            <div class="form-group col-md-3">
                <label for="date">Data do evento:</label>
                <input type="date" class="form-control" id="date" name="date">
                <!-- <input type="text" class="form-control text-uppercase" id="title" name="title" placeholder="Nome do evento"> -->
            </div>

            <!-- private -->
            <div class="form-group col-md-3">
                <label for="private">O evento é privado?</label>
                <select name="private" id="private" class="form-control">
                    <option value="0">Não</option>
                    <option value="1">Sim</option>
                </select>
            </div>
        </div>

        <!-- description -->
        <div class="form-group">
            <label for="description">Descrição:</label>
            <textarea name="description" id="description" placeholder="O que vai acontecer neste evento?" class="form-control"></textarea>
        </div>  

        <!-- items -->
        <div class="form-group border p-3 rounded">
            <label for="items">Adicione itens de infraestrutura:</label>
            <hr>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Cadeiras"> Cadeiras
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Palco"> Palco
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Cerveja grátis"> Cerveja grátis
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Open Food"> Open Food
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Brindes"> Brindes
            </div>
        </div>  

        {{-- button --}}
        <input type="submit" class="btn btn-primary" value="Criar evento">   
    </form> 
</div>
@endsection

@section('scripts')
    <script type="text/javascript">

        function validaNome (obj) {
            var nome = obj.value;
            
            if (!/^[A-Za-z\s]*$/g.test(obj.value)) {
            //if (!/^[A-Za-z'\s]*$/.test(obj.value)) {
                alert('caracteres');
                $('.teste').focus();
                $('.teste').val('');
            
            }

        // swal("Good job!", "You clicked the button!", "success");
            $.ajax({
                url: '/valida-nome',
                dataType: 'json',
                data:{
                    name: nome,
                },
            }).done(
            function (){
                stopLoading();
            }).fail(function (retorno) { 
                if (retorno.responseJSON.aux){
                    swal("Nome já inserido no banco de dados", retorno.responseJSON.aux, "error");
                    stopLoading();
                    obj.value = '';
                    obj.focus();
                    return false;
                }
            });   
        }
    </script>
@stop






@extends('layouts.main')

@section('title', 'Cadastro de Cliente')

@section('content')

@include('sweetalert::alert')

<div id="event-create-container" class="col-md-6 offset-md-3">
    <h1>Cadastro de Cliente:</h1>
    <form action="/users" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" class="form-control" id="nome" name="nome" onblur="teste(this)" placeholder="Nome">
            <!-- <input type="text" class="form-control text-uppercase" id="title" name="title" placeholder="Nome do evento"> -->
        </div>
        @if(count($errors)>0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="form-group">
            <label for="date">Data de Nascimento:</label>
            <input type="date" class="form-control" id="date" name="date">
            <!-- <input type="text" class="form-control text-uppercase" id="title" name="title" placeholder="Nome do evento"> -->
        </div>
        <div class="form-group">
            <label for="text">Cidade:</label>
            <input type="text" class="form-control" id="city" name="city"  placeholder="Cidade">
        </div>
        <div class="form-group">
            <label for="Solteiro">Estado Civil</label>
            <select name="estado_civil" id="Solteiro" class="form-control">
                <option value="0">Solteiro</option>
                <option value="1">Casado</option>
            </select>
        </div>
             
        <input type="submit" class="btn btn-primary" value="Salvar">   
    </form> 
    
</div>
<script>
    function teste(obj){
        var x = obj.value;
        if (x.length<3) {
            alert('O campo deve ter no mínimo 3 caracteres!');
            return false;
            obj.focus();
        }
    }
    // function teste(){
    //     var x = document.getElementsByName("title");
    //     if(x.length < 3){
    //         return back()->with('toast_error', 'Nome do Evento não pode ter menos que 3 caracteres!');
    //     }
    // }
</script>
@endsection

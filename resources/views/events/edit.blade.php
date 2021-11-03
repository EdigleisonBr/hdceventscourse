@extends('layouts.main')

@section('title', 'Editando: ' . $event->title)

@section('content')

@include('sweetalert::alert')

<div id="event-create-container" class="col-md-6 offset-md-3">
    <h1>Editando: {{ $event->title }}</h1>
    <form action="/events/update/{{ $event->id }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <!-- image -->
        <div class="form-group border rounded p-1">
            <label for="image">Imagem do Evento:</label>
            <input type="file" id="image" name="image" class="form-control-input">
            <img src="/img/events/{{$event->image}}" alt="{{ $event->title }}" class="img-preview">
        </div>
        <div class="form-group">
            <label for="title">Evento:</label>
            <input type="text" class="form-control" id="title" name="title" onblur="teste(this)" placeholder="Nome do evento" value="{{$event->title}}">
            <!-- <input type="text" class="form-control text-uppercase" id="title" name="title" placeholder="Nome do evento"> -->
        </div>
        @if(count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="form-group">
            <label for="date">Data do evento:</label>
            <input type="date" class="form-control" id="date" name="date" value="{{ $event->date->format('Y-m-d') }}">
            <!-- <input type="text" class="form-control text-uppercase" id="title" name="title" placeholder="Nome do evento"> -->
        </div>
        <div class="form-group">
            <label for="text">Cidade:</label>
            <input type="text" class="form-control" id="city" name="city"  placeholder="Local do evento" value="{{$event->city}}">
        </div>
        <div class="form-group">
            <label for="private">O evento é privado?</label>
            <select name="private" id="private" class="form-control">
                <option value="0">Não</option>
                <option value="1" {{ $event->private == 1 ? "selected='selected'" : ""}}>Sim</option>
            </select>
        </div>
        <div class="form-group">
            <label for="description">Descrição:</label>
            <textarea name="description" id="description" placeholder="O que vai acontecer neste evento?"class="form-control">{{$event->description}}</textarea>
        </div>  
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
        
        <input type="submit" class="btn btn-primary" value="Editar Evento">   
    </form> 
    
</div>
<script>
    // function teste(obj){
    //     var x = obj.value;
    //     if (x.length<3) {
    //         alert('O campo deve ter no mínimo 3 caracteres!');
    //         return false;
    //         obj.focus();
    //     }
    // }
    // function teste(){
    //     var x = document.getElementsByName("title");
    //     if(x.length < 3){
    //         return back()->with('toast_error', 'Nome do Evento não pode ter menos que 3 caracteres!');
    //     }
    // }
</script>
@endsection

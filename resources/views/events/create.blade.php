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

        <div class="row">
            <div class="form-group col-md-3">
                {!! Form::label('zip_code', 'Cep:') !!}
                {!! Form::text('zip_code', null, ['class' => 'form-control text-right cep', 'required'=>'required',  'onkey' => 'buscaCep()']) !!}
            </div>

             <!-- Complemento Field -->
            <div class="form-group col-md-3">
                {!! Form::label('complement', 'Complemento:') !!}
                {!! Form::text('complement', null, ['class' => 'form-control']) !!}
            </div>

              <!-- Numero Field -->
            <div class="form-group col-md-3">
                {!! Form::label('address_number', 'Número:') !!}
                {!! Form::number('address_number', null, ['class' => 'form-control text-right',
                'required'=>'required', 'max' => '99999', 'min' => '0', 'step'=>'1' ]) !!}
            </div>
    
            <!-- cd_tipo_logradouro Field -->
            <div class="form-group col-sm-3">
                {!! Form::label('cd_tipo_logradouro', 'Logradouro:') !!}
                {!! Form::select('cd_tipo_logradouro',[
                ''=>'',
                'R'=>'Rua',
                'A'=>'Avenida',
                'T' => 'Travessa',
                ], null, ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="row">
            <!-- Endereco Field -->
            <div class="form-group col-md-4">
                {!! Form::label('street', 'Endereço:') !!}
                {!! Form::text('street', null, ['class' => 'form-control','autocomplete' => 'chrome-off', 'required'=>'required']) !!}
            </div>
    
            <!-- Bairro Field -->
            <div class="form-group col-md-3">
                {!! Form::label('neighborhood', 'Bairro:') !!}
                {!! Form::text('neighborhood', null, ['class' => 'form-control','autocomplete' => 'chrome-off', 'required'=>'required']) !!}
            </div>
       
            <!-- Cidade Field -->
            <div class="form-group col-md-3">
                {!! Form::label('city', 'Cidade:') !!}
                {!! Form::text('city', null, ['class' => 'form-control','autocomplete' => 'chrome-off', 'required'=>'required']) !!}
            </div>

              <!-- Estado Field -->
            <div class="form-group col-md-2">
                {!! Form::label('state', 'Estado:') !!}
                {!! Form::text('state', null, ['class' => 'form-control text-uppercase','autocomplete' => 'chrome-off', 'required'=>'required','maxlength'=>'2']) !!}
            </div>
        </div>
      
        <!-- Estado Field -->
        <div class="form-group">
            {!! Form::hidden('event_id', 1, ['class' => 'form-control text-uppercase','autocomplete' => 'chrome-off', 'required'=>'required','maxlength'=>'2']) !!}
        </div>
    
        @if (auth()->user()->name == 'Edigleison')
            <!-- Active Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('active', 'Ativo') !!}
                <div class="form-control">
                    {!! Form::checkbox('active', 0,[ 'id'=>'active']) !!}
                </div>
            </div>
          
        @endif 

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

    function buscaCep () {
      valor = $('.cep').val();
      if (valor.length == 9) {
        startLoading();
        valor = valor.replace('-', '');
        $.ajax({
          url: '/cep/' + valor,
          dataType: 'json',
          crossDomain: true,
        }).done(function (json) {
          console.log(json);
          stopLoading();
          if (json.cidade) {
            console.log(json);
            $("#street").val(json.logradouro);
            $("#neighborhood").val(json.bairro);
            $("#city").val(json.localidade);
            $("#state").val(json.uf);  
            $("#number").focus();
          }
          else {
            swal('CEP não encontrado', '', 'error');
          }
        }).fail(function () {
          stopLoading();
          swal('CEP não encontrado!', '', 'error');
        });
      }
    }

    // function validaCEP(obj){
    //     var cep = document.getElementById("zip_code").value
    //     var url = "https://viacep.com.br/ws/"+cep+"/json";
    //     var link = 'https://buscacepinter.correios.com.br/app/endereco/index.php';
        

    //     $.ajax({
    //         url: url,
    //         type: "get",
    //         dataType: 'json',

    //         success:function(dados){
    //             console.log(dados);
    //             $("#street").val(dados.logradouro);
    //             $("#neighborhood").val(dados.bairro);
    //             $("#city").val(dados.localidade);
    //             $("#state").val(dados.uf);   
    //             if (dados.erro){
    //                 swal("CEP não localizado!", "Deseja verificar CEP em Correios?", {
    //                     buttons: {

    //                         cancel: "Não",
                            
    //                         catch: {
    //                             text: "Sim",
    //                             value: "catch", 
    //                         },
    //                     }
    //                 }) 
    //                 .then((value) => {
    //                     switch (value){
    //                         case "cancel":
    //                         swal.close();
    //                         break;

    //                         case "catch":
    //                         window.location.href = link;     
    //                         break;
    //                     }
    //                 });
    //             }
    //         },
    //     })
    // }
</script>
@stop






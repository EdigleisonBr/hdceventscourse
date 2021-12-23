@extends('layouts.main')

@section('title', 'Criar Evento')

@section('content')

@include('sweetalert::alert')

<?php
$teste = Auth::user()->id;
?>

<div id="event-create-container">
    <h1>Endereço:</h1>
    <br>
    <form action="/addresses" method="POST" enctype="multipart/form-data">
        @csrf

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
  
        <div class="row ml-1">
            <div class="form-group col-md-3">
                {!! Form::label('zip_code', 'Cep:') !!}
                {!! Form::text('zip_code', null, ['class' => 'form-control text-right cep', 'required'=>'required',  'onkeyup' => 'buscaCep(this)', 'minlength' => '9']) !!}
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
                'Rua'=>'Rua',
                'Avenida'=>'Avenida',
                'Travessa' => 'Travessa',
                ], null, ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="row">
            <!-- Endereco Field -->
            <div class="form-group col-md-6">
                {!! Form::label('street', 'Endereço:') !!}
                {!! Form::text('street', null, ['class' => 'form-control','autocomplete' => 'chrome-off', 'required'=>'required']) !!}
            </div>
    
            <!-- Bairro Field -->
            <div class="form-group col-md-6">
                {!! Form::label('neighborhood', 'Bairro:') !!}
                {!! Form::text('neighborhood', null, ['class' => 'form-control','autocomplete' => 'chrome-off', 'required'=>'required']) !!}
            </div>
        </div>

        <div class="row">      
            <!-- Cidade Field -->
            <div class="form-group col-md-4">
                {!! Form::label('city', 'Cidade:') !!}
                {!! Form::text('city', null, ['class' => 'form-control','autocomplete' => 'chrome-off', 'required'=>'required']) !!}
            </div>

              <!-- Estado Field -->
            <div class="form-group col-md-3">
                {!! Form::label('state', 'Estado:') !!}
                {!! Form::text('state', null, ['class' => 'form-control text-uppercase','autocomplete' => 'chrome-off', 'required'=>'required','maxlength'=>'2']) !!}
            </div>
        </div>      
      
        <!-- Estado Field -->
        <div class="form-group">
            {!! Form::hidden('event_id', 1, ['class' => 'form-control text-uppercase','autocomplete' => 'chrome-off', 'required'=>'required','maxlength'=>'2']) !!}
        </div>
    
        {{-- button --}}
        <input type="submit" class="btn btn-primary" value="Salvar">   
    </form> 
</div>
@endsection

@section('scripts')
    <script type="text/javascript">

        // function buscaCep () {
        //     valor = $('.cep').val();
        //     var link = 'https://buscacepinter.correios.com.br/app/endereco/index.php';

        //     if (valor.length == 9) {
        //         valor = valor.replace('-', '');
        //         $.ajax({
        //             url: '/busca-cep/'+valor,
        //             dataType: 'json',
        //                 data: {
        //                     cep: valor,
        //                 },
        //             success: function(data) {
        //                 if (data.bairro){
        //                     $("#street").val(data.logradouro);
        //                     $("#neighborhood").val(data.bairro);
        //                     $("#city").val(data.cidade);
        //                     $("#state").val(data.estado);  
        //                     $("#complement").focus();
        //                 }
        //                 else{
        //                     swal("CEP não localizado!", "Deseja verificar CEP em Correios?", {
        //                         buttons: {
        //                             cancel: "Não",
    
        //                             catch: {
        //                                 text: "Sim",
        //                                 value: "catch", 
        //                             },
        //                         }
        //                     }) 
        //                     .then((value) => {
        //                         switch (value){
        //                             case "cancel":
        //                             swal.close();
        //                             break;

        //                             case "catch":
        //                             window.open(link);     
        //                             break;
        //                         }
        //                     });
        //                 }
        //             },
        //         });
        //     } 
        // }

        function buscaCep () {
            valor = $('.cep').val();
            var link = 'https://buscacepinter.correios.com.br/app/endereco/index.php';

            if (valor.length == 9) {
                //startLoading();
                valor = valor.replace('-', '');
                $.ajax({
                url: '/cep/' + valor,
                dataType: 'json',
                crossDomain: true,
                }).fail(function (retorno) {
                    if (retorno.responseJSON.data.logradouro) {
                        $("#street").val(retorno.responseJSON.data.logradouro);
                        $("#neighborhood").val(retorno.responseJSON.data.bairro);
                        $("#city").val(retorno.responseJSON.data.cidade);
                        $("#state").val(retorno.responseJSON.data.estado);  
                        $("#address_number").focus();
                    }
                }).done(function () {
                    swal("CEP não localizado!", "Deseja verificar CEP em Correios?", {
                        buttons: {
                            cancel: "Não",

                            catch: {
                                text: "Sim",
                                value: "catch", 
                            },
                        },
                    }) 
                    .then((value) => {
                        switch (value){
                            case "cancel":
                            swal.close();
                            break;

                            case "catch":
                            window.open(link);     
                            break;
                        }
                    });
                });
            }
        }
    </script>
@stop






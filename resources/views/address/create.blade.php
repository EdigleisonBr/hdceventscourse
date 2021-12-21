<form action="/events" method="POST" enctype="multipart/form-data">
    <!-- Cep Field -->
    <div class="form-group col-sm-2">
        {!! Form::label('zip_code', 'Cep:') !!}
        <small>
            <a class="btn btn-link btn-xs pull-right" target="_blank"
            href="#">
            Não sabe o CEP? <i class="fa fa-link"></i>
            </a>
        </small>
        {!! Form::text('zip_code', null, ['class' => 'form-control text-right cep', 'required'=>'required']) !!}
    </div>

    <!-- cd_tipo_logradouro Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('cd_tipo_logradouro', 'Tipo Logradouro:') !!}
        {!! Form::text('cd_tipo_logradouro', null,
                [
                    'class' => 'form-control',
                    'required'=>'required'
                ]
        ) !!}
    </div>
    
    <!-- Endereco Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('street', 'Endereço:') !!}
        {!! Form::text('street', null, ['class' => 'form-control','autocomplete' => 'chrome-off', 'required'=>'required']) !!}
    </div>

    <!-- Numero Field -->
    <div class="form-group col-sm-2">
        {!! Form::label('address_number', 'Número:') !!}
        {!! Form::number('address_number', null, ['class' => 'form-control text-right',
        'required'=>'required', 'max' => '99999', 'min' => '0', 'step'=>'1' ]) !!}
    </div>

    <!-- Bairro Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('neighborhood', 'Bairro:') !!}
        {!! Form::text('neighborhood', null, ['class' => 'form-control','autocomplete' => 'chrome-off', 'required'=>'required']) !!}
    </div>

    <!-- Complemento Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('complement', 'Complemento:') !!}
        {!! Form::text('complement', null, ['class' => 'form-control']) !!}
    </div>

    <!-- Cidade Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('city', 'Cidade:') !!}
        {!! Form::text('city', null, ['class' => 'form-control','autocomplete' => 'chrome-off', 'required'=>'required']) !!}
    </div>

    <!-- Estado Field -->
    <div class="form-group">
        {!! Form::label('state', 'Estado:') !!}
        {!! Form::text('state', null, ['class' => 'form-control text-uppercase','autocomplete' => 'chrome-off', 'required'=>'required','maxlength'=>'2']) !!}
    </div>

     <!-- Estado Field -->
     <div class="form-group">
        {!! Form::label('event_id', 'Evento:') !!}
        {!! Form::number('event_id', null, ['class' => 'form-control text-uppercase','autocomplete' => 'chrome-off', 'required'=>'required','maxlength'=>'2']) !!}
    </div>


    <!-- Submit Field -->
    <div class="form-group col-sm-12" style="margin-top: 10px">
        {!! Form::button( '<i class="fa fa-save"></i> '. ucfirst( trans('Salvar') ), ['class' => 'btn btn-success pull-right btn-lg btn-flat', 'type'=>'submit']) !!}
        <a href="#" class="btn btn-default btn-lg btn-flat"><i
                    class="fa fa-times"></i>Cancelar</a>
    </div>
</form>

@section('scripts')
    <script type="text/javascript">
    //   var pessoa_atual_id = {{ isset($paciente)?$paciente->id:'null' }};
    //   var redirect_to_person = true;

    //   function validaDocumento () {
    //     if ($('.cpf').val() != '') {
    //       startLoading();
    //       $.ajax({
    //         url: '/valida-documento',
    //         data: {
    //           numero: $('.cpf').val(),
    //           pessoa_id: pessoa_atual_id,
    //         },
    //       }).done(function () {
    //         stopLoading();
    //       }).fail(function (retorno) {
    //         stopLoading();
    //         if (retorno.responseJSON.erro) {
    //           swal({
    //             title: retorno.responseJSON.erro,
    //             text: '',
    //             type: 'error',
    //             showCancelButton: false,
    //             confirmButtonText: 'Ok',
    //             closeOnConfirm: false,
    //           }, function () {
    //             documento = $('.cpf').val();
    //             $('.cpf').val('');
    //             if (redirect_to_person) {
    //               swal({
    //                   title: 'Deseja ir para o cadastro desta pessoa?',
    //                   text: '',
    //                   type: 'warning',
    //                   showCancelButton: true,
    //                   confirmButtonColor: '#00a65a',
    //                   confirmButtonText: 'Sim',
    //                   cancelButtonText: 'Não, continuar um novo cadastro',
    //                   closeOnConfirm: false,
    //                 },
    //                 function () {
    //                   document.location = '/pacientes/por-documento?numero=' + documento;
    //                 });
    //             }
    //             else {
    //               swal.close();
    //             }
    //           });

    //         }
    //         else {
    //           numero = $('.cpf').val();
    //           resposta = !numero.length ? 'Nulo' : 'Inválido';

    //           swal({
    //             title: 'Número ' + resposta,
    //             text: 'Este registro não será salvo enquanto o mesmo não for um número válido',
    //             type: 'error',
    //             showCancelButton: false,
    //             confirmButtonText: 'Ok',
    //             closeOnConfirm: true,
    //           });
    //         }

    //       });
    //     }

    //   }

    //   function buscaCep () {
    //     valor = $('.cep').val();
    //     if (valor.length == 9) {
    //       startLoading();
    //       valor = valor.replace('-', '');
    //       $.ajax({
    //         url: '/cep/' + valor,
    //         dataType: 'json',
    //         crossDomain: true,
    //       }).done(function (json) {
    //         stopLoading();
    //         if (json.cidade) {
    //           $('input[name="endereco"]').val(json.logradouro);
    //           $('input[name="estado"]').val(json.uf);
    //           $('input[name="cidade"]').val(json.cidade);
    //           $('input[name="bairro"]').val(json.bairro);
    //           $('input[name="numero"]').focus();
    //         }
    //         else {
    //           swal('CEP não encontrado', '', 'error');
    //         }
    //       }).fail(function () {
    //         stopLoading();
    //         swal('CEP não encontrado!', '', 'error');
    //       });
    //     }
    //   }

    //   function validaNome (obj) {
    //     if (obj.value == '') {
    //       swal('Insira um nome', 'Não é possível inserir números ou caracteres especiais!', 'error');
    //       obj.focus();
    //       return false;
    //     }
    //     if (!/^[A-Za-z\u00C0-\u00FF \']*$/g.test(obj.value)) {
    //       swal('Caracteres inválidos', 'Não é possível inserir números ou caracteres especiais!', 'error');
    //       obj.focus();
    //       return false;
    //     }
    //   }

    //   function validaEnderecoBairro(obj){
    //     vax x = obj.value;
    //     if (x.length<3){
    //       swal('Tamanho mínimo', 'O campo deve ter no mínimo 3 caracteres!', 'error');
    //       return false;
    //       obj.focus();
    //     }        
    //   }

    </script>
@stop 

@extends('layouts.main')

@section('title', 'Create Crud')

@section('content')

@include('sweetalert::alert')

<div class="container mt-5">
    <div class="row">
        <div id="event-create-container" class="col-md-6 offset-md-3">
            <div class="col-lg-8">
                <button class="btn btn-primary" onclick="create()">+ Product</button>
            </div>
        </div>
    </div>
</div>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <div id="page" class="p-2"></div>
        </div>
  
      </div>
    </div>
  </div>

@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){ 

        });
        
        function create (){
            $.get("{{url('crud_create')}}", {}, function(data,status){
                $("#exampleModalLabel").html('Create Product');
                $("#page").html(data);
                $("#exampleModal").modal('show');
            });
        }

        function store() {
            //faz referencia ao name da view create
            var name = $("#name").val();
    </script>
@stop



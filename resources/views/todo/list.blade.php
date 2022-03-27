@extends('home')

@section('content')

<section class="">
  <div class="container py-5 h-30">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col">
        <div class="card" id="list1" style="border-radius: .75rem; background-color: #eff1f2;">
          <div class="card-body py-4 px-4 px-md-5">

            <p class="h1 text-center mt-3 mb-4 pb-3 text-primary">
              <i class="fas fa-check-square me-1"></i>Mini Todo App
            </p>

            <div class="pb-2">
              <div class="card">
                <div class="card-body">
                  
                <!-- <form method="post" action="{{url('/todo/add')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                  <div class="d-flex flex-row align-items-center">
                   
                      <input type="text" class="form-control form-control-lg" id="exampleFormControlInput1" placeholder="Add new..." name="name">
                      <a href="#!" data-mdb-toggle="tooltip" title="Set due date"></a>
                      <div>
                        <button type="submit" class="btn btn-primary">Add</button>
                      </div>
                  </div>
                  </form>  -->

                  <br>
                  <form method="post" action="{{url('/todo/add')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Tambah To do list" name="name" />
                    <button class="btn btn-outline-primary" type="submit" id="button-addon2" >
                      <i class="fa fa-plus"></i>
                    </button>
                  </form>

                </div>

                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="vh-100" style="background-color: #3da2c3;">
  <div class="container h-50">
    <div class="row d-flex justify-content-center align-items-center h-100">

    @foreach($todo as $t)
      <div class="col col-lg-4 col-xl-3">
        <div class="card rounded-3 mt-3">
          <div class="card-body p-4">

          <div class="row">
            <div class="col-10">
              <p class="mb-2">
                  <span class="h5 me-5">{{$t->name}}</span>
                  <!-- <a href="{{url('/todo/del')}}/{{$t->id}}" class="badge badge-danger"><i class="fa fa-trash"></i> </a> -->
              </p>  
            </div>
            <div class="col-2">
                <form method="post" action="{{url('/todo/del')}}/{{$t->id}}" enctype="multipart/form-data">
                  @method('DELETE')
                  {{ csrf_field() }}
                  <button type="submit" class="badge badge-danger">
                    <i class="fa fa-trash"></i>
                  </button>
              </form>
            </div>
          </div>
          
            <ul class="list-group rounded-0">
            @foreach($t->details as $td)
              <li class="list-group-item border-0 d-flex align-items-center ps-0 delete-checked" id="list-detail-{{$td->id}}">
                <!-- <input class="form-check-input me-3" type="checkbox" value="" aria-label="..." checked /> -->
                <input class="form-check-input me-3" type="checkbox" value="{{$td->name}}" aria-label="..." />
                <!-- <s>{{$td->name}}</s>  -->
                <form method="post" action="{{url('/todo/detail/del')}}/{{$td->id}}" enctype="multipart/form-data" id="form-{{$td->id}}">
                      @method('DELETE')
                      {{ csrf_field() }}
                      
                       {{$td->name}} <span class="action-detail" id="div-detail-{{$td->id}}"></span> 
                </form>
              </li>
              @foreach($td->subDetail as $ts)
                <li class="list-group-item border-0 d-flex align-items-center ps-0 delete-checked" id="list-detail-{{$ts->id}}">
                  <!-- <input class="form-check-input me-3" type="checkbox" value="" aria-label="..." checked /> -->
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input class="form-check-input me-3 ml-4" type="checkbox" value="{{$ts->name}} " aria-label="..." />
                  <!-- <s>{{$ts->name}}</s>  -->
                  <form method="post" action="{{url('/todo/detail/del')}}/{{$ts->id}}" enctype="multipart/form-data" id="form-{{$ts->id}}">
                        @method('DELETE')
                        {{ csrf_field() }}
                        
                        {{$ts->name}} 
                        <span class="action-detail" id="div-detail-{{$ts->id}}"></span> 
                        <input type="hidden" name="subToDo" value="y">
                  </form>
                </li>
              @endforeach

            @endforeach
              <div id="newDetail{{$t->id}}" ></div>
              <li class="list-group-item border-0 d-flex align-items-center p-0" >
                <form action="{{url('/todo/add-detail')}}"  method="post" enctype="multipart/form-data" class="create-detail" id="create-detail-{{$t->id}}">
                    {{ csrf_field() }}
                    <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Tambah Task list" name="name" />
                    <input type="hidden" name="todo_id" value="{{$t->id}}">
                    <button class="btn btn-outline-primary" type="submit" id="button-addon2" >
                        <i class="fa fa-plus"></i>
                    </button>
                </form>
              </li>

            </ul>

          </div>
        </div>
      </div>
      @endforeach

    </div>
  </div>
</section>

@endsection

@section('script')
<script>
addDetail();
deleteCheck();

function addDetail(){
  $('.create-detail').submit(function(event) {
    var form = $(this).attr('id');
    var todo_id = $('#'+form+' [name=todo_id]').val();  

      //post detail
      $.post('/todo/add-detail', $('#'+form).serialize(), function(id) { 
        $('#'+form+' [name=name]').val('');
        var subtodo = $('#'+form+' [name=todo_sub]').val();

          //ambil data
          $.get('/todo/detail/'+id, function(data) {
              if(subtodo > ''){
                //jika subtodo
                $('#create-detail-'+todo_id).html(data);
                $('#create-detail-'+todo_id+' li').prepend('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');
                $('#create-detail-'+todo_id+' li form').prepend('<input type="hidden" name="subToDo" value="y">');
                $('#create-detail-'+todo_id+' li').unwrap();
              }else{
                //jika tanpa sub
                $('#newDetail'+todo_id).append(data);
              }
              deleteCheck();
          });
      });
      event.preventDefault();
  });
}

function deleteCheck(){
  $('.delete-checked').hover(function() {
    //var getId = $(this).children().attr('id');
    var getId = $(this).find( "span" ).attr('id');
    console.log('getId'+getId);

    //subTodoCheck
    var subTodoCheck = $(this).find( "form [name=subToDo]" ).val();
    console.log('subTodoCheck : '+subTodoCheck);

    if(subTodoCheck>''){
      $('#'+getId).html(`
            <button type="submit" class="badge badge-danger">
              <i class="fa fa-trash"></i>
            </button>
        </form>`);
    }else{
      $('#'+getId).html(`
          <button type="submit" class="badge badge-danger">
            <i class="fa fa-trash"></i>
          </button>
          <button type="button" class="badge badge-primary btn-add-sub" id="btn-subdetail-`+getId+`">
            <i class="fa fa-plus"></i> 
          </button>
          <button type="button" class="badge badge-secondary btn-edit-sub" id="btn-editDetail-`+getId+`">
            <i class="fa fa-edit"></i> 
          </button>
      </form>`);
    }

      $(".btn-add-sub").click(function() {
        var getIdBtn = $(this).attr('id');
        var getIdBtn1 = getIdBtn.replace("btn-subdetail-div-detail-", "");
        addNewSubDetail(getIdBtn1);
      });

      $(".btn-edit-sub").click(function() {
        var getIdBtn = $(this).attr('id');
        var getIdBtn1 = getIdBtn.replace("btn-editDetail-div-detail-", "");
        editDetail(getIdBtn1);
      });

  }, function() {
    $('.action-detail').html('');
  });
}

function addNewSubDetail(varId){
  console.log('getIdBtn : '+varId);

$('#list-detail-'+varId).after(`
  <li class="list-group-item border-0 d-flex align-items-center p-0" >
      <form action="{{url('/todo/add-detail')}}"  method="post" enctype="multipart/form-data" class="create-detail" id="create-detail-`+varId+`">
          {{ csrf_field() }}
          <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Tambah Task list" name="name" />
          <input type="hidden" name="todo_id" value="`+varId+`">
          <input type="hidden" name="todo_sub" value="y">
          <button class="btn btn-outline-primary" type="submit" id="button-addon2" >
              <i class="fa fa-plus"></i>
          </button>
      </form>
    </li>
  `);
  addDetail();
}

function editDetail(varId){
  console.log('getIdBtn : '+varId);
  var ldi = $('#list-detail-'+varId+' .form-check-input').val();
  console.log('ldi '+ldi);

  $('#list-detail-116 ').val();

$('#list-detail-'+varId).html(`
<form action="{{url('/todo/edit-detail')}}/`+varId+`"  method="post" enctype="multipart/form-data" class="edit-detail" id="edit-detail-`+varId+`">
    {{ csrf_field() }}
    @method('PATCH')
    <div class="input-group mb-3">
    <input type="text" class="form-control" placeholder="Edit Task list" name="name" value="`+ldi+`"/>
    <input type="hidden" name="todo_id" value="`+varId+`">
    <button class="btn btn-outline-primary" type="submit" id="button-addon2" >
        <i class="fa fa-edit"></i>
    </button>
</form>
  `);
}



</script>
@endsection
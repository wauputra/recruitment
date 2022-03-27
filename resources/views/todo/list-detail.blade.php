<li class="list-group-item border-0 d-flex align-items-center ps-0">
<input class="form-check-input me-3" type="checkbox" value="" aria-label="..." value="{{$todoDetail->name}} "/>
<form method="post" action="{{url('/todo/detail/del')}}/{{$todoDetail->id}}" enctype="multipart/form-data">
        @method('DELETE')
        {{ csrf_field() }}
    <div class="delete-checked">{{$todoDetail->name}} 
        <span class="action-detail" id="div-detail-{{$todoDetail->id}}"></span> 
    </div> 
</form>
</li>


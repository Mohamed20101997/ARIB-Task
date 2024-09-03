@if(Session::has('error'))
    <div class="row mr-2 ml-2" >
        <p  class="alert alert-danger"id="type-error" style="font-size: 18px">
            <i class="fa fa-warning"></i>
            {{Session::get('error')}}
        </p>
    </div>
@endif

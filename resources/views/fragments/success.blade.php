@if(session('message'))

<div class="alert alert-success mt-0 message " role="alert">
    {{session('message')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="بستن">
        <span aria-hidden="true">&times;</span>
  </div>
  @endif

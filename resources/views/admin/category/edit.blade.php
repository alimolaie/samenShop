@extends('admin.admin_layout')
@section('admin_content')
@include('admin.cms-admin.sidebar')
@include('admin.cms-admin.header')
@include('admin.cms-admin.notification')
@include('admin.cms-admin.sidebar')
@include('admin.cms-admin.header')
@include('admin.cms-admin.notification')


  <!-- ########## START: MAIN PANEL ########## -->
  <div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="index.html">Samen</a>
      <a class="breadcrumb-item" href="index.html">category</a>
      <span class="breadcrumb-item active">Category update</span>
    </nav>

    <div class="sl-pagebody">
      <div class="sl-page-title">
        <h5>Category update</h5>

      </div><!-- sl-page-title -->

      <div class="card pd-20 pd-sm-40">
        <h6 class="card-body-title">Category update

        </h6>

        <br>
        <div class="table-wrapper">

            <form method="POST" action="{{route('update.category',$category->id)}}">
                @csrf
                <div class="form-group">
                  <label for="exampleInputEmail1" class="bold">category name:</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter category name" value="{{$category->category_name}}" name="category_name">
                    <br>
                   

                <button type="submit" class="btn btn-primary">update</button>
              </form>
        </div><!-- table-wrapper -->
      </div><!-- card -->

  </div><!-- sl-mainpanel -->
  <!-- ########## END: MAIN PANEL ########## -->



@endsection

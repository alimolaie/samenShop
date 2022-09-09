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
      <a class="breadcrumb-item" href="index.html">Starlight</a>
      <a class="breadcrumb-item" href="index.html">Tables</a>
      <span class="breadcrumb-item active">Data Table</span>
    </nav>

    <div class="sl-pagebody">
      <div class="sl-page-title">
        <h5>Bolg Category Table</h5>

      </div><!-- sl-page-title -->

      <div class="card pd-20 pd-sm-40">
        <h6 class="card-body-title">Blog Category List
            <a href="#" class="btn btn-sm btn-warning" style="float: right" data-toggle="modal" data-target="#modaldemo3">Add new</a>
        </h6>


        <div class="table-wrapper">
          <table id="datatable1" class="table display responsive nowrap">
            <thead>
              <tr>
                <th class="wd-15p">ID</th>
                <th class="wd-15p">Category name en</th>
                <th class="wd-15p">Category name fa</th>
                <th class="wd-20p">Action</th>

              </tr>
            </thead>
            <tbody>
                @foreach ($blogCategory as $key => $row)


              <tr>
                <td>{{$key +1}}</td>
                <td>{{$row->category_name_en}}</td>
                <td>{{$row->category_name_fa}}</td>
                <td>
                    <a href="{{URL::to('/edit/blog/category/'.$row->id)}}" class="btn btn-sm btn-info" >Edit</a>
                    <a href="{{URL::to('delete/blog/category/'.$row->id)}}" class="btn btn-sm btn-danger" >Delete</a>

                </td>

              </tr>
              @endforeach
            </tbody>
          </table>
        </div><!-- table-wrapper -->
      </div><!-- card -->

  </div><!-- sl-mainpanel -->
  <!-- ########## END: MAIN PANEL ########## -->


  <!-- LARGE MODAL -->
  <div id="modaldemo3" class="modal fade">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content tx-size-sm">
        <div class="modal-header pd-x-20">
          <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Category Add</h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body pd-20">
            <form method="POST" action="{{route('store.category.blog')}}">
                @csrf
                <div class="form-group">
                  <label for="exampleInputEmail1">Category Name en</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter category name english" name="category_name_en">

                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Category Name fa</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter category name farsi" name="category_name_fa">

                  </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info pd-x-20">submit</button>
                    <button type="button" class="btn btn-secondary pd-x-20" data-dismiss="modal">Close</button>
              </form>
        </div><!-- modal-body -->

        </div>
      </div>
    </div><!-- modal-dialog -->
  </div><!-- modal -->
@endsection

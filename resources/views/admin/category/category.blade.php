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
        <h5>Category Table</h5>

      </div><!-- sl-page-title -->

      <div class="card pd-20 pd-sm-40">
        <h6 class="card-body-title">Category List
            <a href="#" class="btn btn-sm btn-warning" style="float: right" data-toggle="modal" data-target="#modaldemo3">Add new</a>
        </h6>


        <div class="table-wrapper">
          <table id="datatable1" class="table display responsive nowrap">
            <thead>
              <tr>
                <th class="wd-15p">ID</th>
                <th class="wd-15p">Category name</th>
                <th class="wd-20p">Action</th>

              </tr>
            </thead>
            <tbody>
                @foreach ($categories as $key => $row)
              <tr>
                <td>{{$key +1}}</td>

                  @if($row->parent_id>0)
                  <td>{{$row->category_name}} {{$row->childs}}</td>
                  @elseif($row->parent_id==0)

                      <td>{{$row->category_name}}/td>

@endif



                <td>
                    <a href="{{URL::to('edit/category/'.$row->id)}}" class="btn btn-sm btn-info" >Edit</a>
                    <a href="{{URL::to('delete/category/'.$row->id)}}" class="btn btn-sm btn-danger" >Delete</a>

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
            <form method="POST" action="{{route('store.category')}}">
                @csrf
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Sub Category</label>
                    <select class="form-control" id="exampleFormControlSelect1" name="parent_id">
                        <option value="0">Parent category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @if(count($category->childs))
                                @include('admin.category.dropdown_childs',['childs' => $category->childs,'level'=>0])
                            @endif
                        @endforeach

                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Category Name</label>
                    <input type="text" class="form-control"  aria-describedby="emailHelp" placeholder="Enter category name" name="category_name">
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

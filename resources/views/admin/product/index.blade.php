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
      <a class="breadcrumb-item" href="index.html">Product</a>
      <a class="breadcrumb-item" href="index.html">All Product</a>
      <span class="breadcrumb-item active"></span>
    </nav>

    <div class="sl-pagebody">
      <div class="sl-page-title">
        <h5>Product Table</h5>

      </div><!-- sl-page-title -->

      <div class="card pd-20 pd-sm-40">
        <h6 class="card-body-title">Product List
            <a href="{{route('add.product')}}" class="btn btn-sm btn-warning" style="float: right" >Add new</a>
        </h6>


        <div class="table-wrapper mt-2">
          <table id="datatable2" class="table display responsive nowrap">
            <thead>
              <tr>
                <th class="wd-15p">Product Code</th>
                <th class="wd-15p">Product Name</th>
                <th class="wd-15p">Image</th>
                <th class="wd-15p">Category</th>
                <th class="wd-15p">Brand</th>
                <th class="wd-15p">Quantity</th>
                <th class="wd-15p">Status</th>
                <th class="wd-15p">Action</th>
                <th class="wd-20p">Status2</th>

              </tr>
            </thead>
            <tbody>
                @foreach ($product  as $row)


              <tr>
                <td>{{$row->product_code}} - {{ $row->id }}</td>
                <td>{{$row->product_name}}</td>
                <td>
                    <img src="{{asset('uploads/products/'.$row->image_one)}}" height="70px;" width="80px;">

                </td>
                <td>{{$row->category_name}}</td>
                <td>{{$row->brand_name}}</td>
                <td>{{$row->product_quantity}}</td>
                <td>
                    @if ($row->status == 1 )

                    <span class="badge badge-success">Active</span>
                    @else
                    <span class="badge badge-danger">InActive</span>
                    @endif
                </td>
                <td>
                    <a href="{{URL::to('edit/product/'.$row->id)}}" class="btn btn-sm btn-info" title="Edit" ><i class="fa fa-edit"></i></a>
                   <div>
                       <br>
                   </div>
                   <div>









                    <form method="POST" action="{{ route('delete.product', $row->id) }}">
                        @csrf
                        <input name="_method" type="hidden" value="DELETE">
                        <button type="submit" class="btn btn-xs btn-danger btn-flat delete-confirm" data-toggle="tooltip" data-name={{ $row->product_name }}><i class="fa fa-trash"></i></button>
                    </form>


                       
                </div>



                <br>

                <div>
                    @if ($row->status == 1)
                    <a href="{{URL::to('inactive/product/'.$row->id)}}" class="btn btn-sm btn-secondary" title="InActive"><i class="fa fa-thumbs-o-down"></i></a>
                    @else
                    <a href="{{URL::to('active/product/'.$row->id)}}" class="btn btn-sm btn-secondary" title="Active"><i class="fa fa-thumbs-o-up"></i></a>
                    @endif

                </div>



                </td>

                <td>
                     <!-- Rounded switch -->
                   <label class="switch">
                    <input type="checkbox">
                     <span class="slider round"></span>
                    </label>
                </td>

              </tr>
              @endforeach
            </tbody>
          </table>
        </div><!-- table-wrapper -->
      </div><!-- card -->

  </div><!-- sl-mainpanel -->
  <!-- ########## END: MAIN PANEL ########## -->



@endsection

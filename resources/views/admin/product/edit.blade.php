@extends('admin.admin_layout')
@include('admin.cms-admin.sidebar')
@include('admin.cms-admin.header')
@include('admin.cms-admin.notification')
@section('admin_content')


@php
     $category=DB::table('categories')->get();
     $brand=DB::table('brands')->get();
     $subcategory=DB::table('subcategories')->get();
@endphp

 <!-- ########## START: MAIN PANEL ########## -->
 <div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="index.html">Samen</a>
      <span class="breadcrumb-item active"> Product Section</span>
    </nav>

    <div class="sl-pagebody">


        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Update Product
                <a href="{{route('all.product')}}" class="btn btn-success btn-sm pull-right">All Product</a>
            </h6>
            <p class="mg-b-20 mg-sm-b-30">Update Product Form</p>
                <form method="POST" action="{{route('update.product',$product->id)}}" enctype="multipart/form-data">

            @csrf
            <div class="form-layout">
              <div class="row mg-b-25">
                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label">Product Name: <span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" name="product_name"  placeholder="Enter product name" value="{{ $product->product_name}}">
                  </div>
                </div><!-- col-4 -->
                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label">Product Code:<span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" name="product_code"  placeholder="Enter product code" value="{{ $product->product_code}}">
                  </div>
                </div><!-- col-4 -->
                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label">Product Quantitiy: <span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" name="product_quantity"  placeholder="Enter product quantitys" value="{{ $product->product_quantity}}">
                  </div>
                </div><!-- col-4 -->

                <div class="col-lg-4">
                  <div class="form-group mg-b-10-force">
                    <label class="form-control-label">Category: <span class="tx-danger">*</span></label>
                    <select class="form-control select2" data-placeholder="Choose Category" name="category_id">
                      <option label="Choose Category">Choose Category</option>
                      @foreach ($category as $row)


                      <option value="{{$row->id}}"

                        <?php
                        if($row->id==$product->category_id)
                        echo "selected";
                        ?>

                        >{{$row->category_name}}</option>
                      @endforeach
                    </select>
                  </div>
                </div><!-- col-4 -->

                <div class="col-lg-4">
                  <div class="form-group mg-b-10-force">
                    <label class="form-control-label"> Brand:</label>
                    <select class="form-control select2"  name="brand_id">
                      <option label="Choose Category">Choose Brand</option>
                      @foreach ($brand as $br)

                      <option value="{{$br->id}}"
                        <?php
                          if($br->id==$product->brand_id)
                          echo "selected";
                          ?>


                        >{{$br->brand_name}}</option>
                      @endforeach

                    </select>
                  </div>
                </div>




                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label">Product Color: <span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" name="product_color" data-role="tagsinput" id="color" value="{{$product->product_color}}">

                  </div>
                </div><!-- col-4 -->

                <div class="col-lg-4">
                    <div class="form-group">
                      <label class="form-control-label">Product size: <span class="tx-danger">*</span></label>
                      <input class="form-control" type="text" name="product_size" data-role="tagsinput" id="size" value="{{$product->product_size}}">

                    </div>
                  </div><!-- col-4 -->


                  <div class="col-lg-4">
                    <div class="form-group">
                      <label class="form-control-label">selling price:<span class="tx-danger">*</span></label>
                      <input class="form-control" type="text" name="selling_price"  placeholder="Enter selling price" value="{{$product->selling_price}}">
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="form-group">
                      <label class="form-control-label">Product Details:<span class="tx-danger">*</span></label>
                      <textarea class="form-control" name="product_details" id="summernote">

                      {{$product->product_details}}
                      </textarea>

                    </div>
                  <div class="col-lg-12">
                    <div class="form-group">
                      <label class="form-control-label">Video Link:<span class="tx-danger">*</span></label>
                      <input class="form-control"  name="video_link" placeholder="Enter your video link" value="{{$product->video_link}}">
                    </div>
                  </div>

                  </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-control-label">Image one (Index Image):<span class="tx-danger">*</span></label>
                        <label class="custom-file">
                            <input type="file" id="file" class="custom-file-input" name="image_one" onchange="readURL1(this);" >
                            <span class="custom-file-control"></span>
                            <img src="#" >
                          </label>
                    </div>
                    <div class="col-lg-6 col-sm-6">
                        <img src="{{asset('uploads/products/'.$product->image_one)}}" width="80px" height="80px" id="one">
                    </div>
                    <br>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-control-label">Image two:<span class="tx-danger">*</span></label>
                        <label class="custom-file">
                            <input type="file" id="file" class="custom-file-input" name="image_two" onchange="readURL2(this);" >
                            <span class="custom-file-control"></span>
                            <img src="#" >
                          </label>
                    </div>
                    <div class="col-lg-6 col-sm-6">
                        <img src="{{asset('uploads/products/'.$product->image_two)}}" width="80px" height="80px" id="two">
                    </div>
                  </div>
                  <br>

                  <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-control-label">Image Three:<span class="tx-danger">*</span></label>
                        <label class="custom-file">
                            <input type="file" id="file" class="custom-file-input" name="image_three" onchange="readURL3(this);" >
                            <span class="custom-file-control"></span>
                            <img src="#" >
                          </label>
                    </div>
                    <div class="col-lg-6 col-sm-6">
                        <img src="{{asset('uploads/products/'.$product->image_three)}}" width="80px" height="80px" id="three">
                    </div>
                  </div>
              </div><!-- row -->


              <hr>
              <br>


              <div class="row">
                <div class="col-lg-4">
                    <label class="ckbox">
                        <input type="checkbox" name="main_slider" value="1"

                        <?php
                          if($product->main_slider==1)
                          echo "checked";
                          ?>

                        >
                        <span>Main Slider</span>
                      </label>
                       </div>
                       <div class="col-lg-4">
                        <label class="ckbox">
                            <input type="checkbox" name="hot_deal" value="1"
                            <?php
                            if($product->hot_deal==1)
                            echo "checked";
                            ?>

                            >
                            <span>Hot Deal</span>
                          </label>
                           </div>
                           <div class="col-lg-4">
                            <label class="ckbox">
                                <input type="checkbox" name="best_rated" value="1"
                                <?php
                                if($product->best_rated==1)
                                echo "checked";
                                ?>

                                >
                                <span>Best Rated</span>
                              </label>
                               </div>
                               <div class="col-lg-4">
                                <label class="ckbox">
                                    <input type="checkbox" name="trend" value="1"

                                    <?php
                                    if($product->trend==1)
                                    echo "checked";
                                    ?>

                                    >
                                    <span>trend product</span>
                                  </label>
                                   </div>
                                   <div class="col-lg-4">
                                    <label class="ckbox">
                                        <input type="checkbox" name="mid_slider" value="1"

                                        <?php
                                        if($product->mid_slider==1)
                                        echo "checked";
                                        ?>

                                        >
                                        <span>mid slider</span>
                                      </label>
                                       </div>
                                       <div class="col-lg-4">
                                        <label class="ckbox">
                                            <input type="checkbox" name="hot_new" value="1"

                                            <?php
                                            if($product->hot_new==1)
                                            echo "checked";
                                            ?>



                                            >
                                            <span>Hot new</span>
                                          </label>
                                           </div>

              </div>
              <br>

              <div class="form-layout-footer">
                <button class="btn btn-info mg-r-5">Submit Form</button>
                <button class="btn btn-secondary">Cancel</button>
              </div><!-- form-layout-footer -->
            </div><!-- form-layout -->

          </div><!-- card -->
        </form>

    </div><!-- sl-pagebody -->

  </div><!-- sl-mainpanel -->
  <!-- ########## END: MAIN PANEL ########## -->

@endsection

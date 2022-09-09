@extends('admin.admin_layout')
@include('admin.cms-admin.sidebar')
@include('admin.cms-admin.header')
@include('admin.cms-admin.notification')
@section('admin_content')

 <!-- ########## START: MAIN PANEL ########## -->
 <div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="index.html">Samen</a>
      <span class="breadcrumb-item active"> Product Section</span>
    </nav>

    <div class="sl-pagebody">


        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">New Product Add
                <a href="{{route('all.product')}}" class="btn btn-success btn-sm pull-right">All Product</a>
            </h6>
            <p class="mg-b-20 mg-sm-b-30">New Product Add Form</p>
                <form method="POST" action="{{route('store.product')}}" enctype="multipart/form-data">
                    @csrf
            <div class="form-layout">
              <div class="row mg-b-25">
                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label">Product Name: <span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" name="product_name"  placeholder="Enter product name">
                  </div>
                </div><!-- col-4 -->
                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label">Product Code:<span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" name="product_code"  placeholder="Enter product code">
                  </div>
                </div><!-- col-4 -->
                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label">Product Quantitiy: <span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" name="product_quantity"  placeholder="Enter product quantitys">
                  </div>
                </div><!-- col-4 -->

                <div class="col-lg-4">
                  <div class="form-group mg-b-10-force">
                    <label class="form-control-label">Category: <span class="tx-danger">*</span></label>
                    <select class="form-control select2" data-placeholder="Choose Category" name="category_id">
                      <option label="Choose Category">Choose Category</option>
                      @foreach ($category as $row)


                      <option value="{{$row->id}}">{{$row->category_name}}</option>
                      @endforeach
                    </select>
                  </div>
                </div><!-- col-4 -->

                <div class="col-lg-4">
                  <div class="form-group mg-b-10-force">
                    <label class="form-control-label">Sub Category:</label>
                    <select class="form-control select2" data-placeholder="Choose subCategory" name="subcategory_id">


                    </select>
                  </div>
                </div><!-- col-4 -->

                <div class="col-lg-4">
                  <div class="form-group mg-b-10-force">
                    <label class="form-control-label"> Brand:</label>
                    <select class="form-control select2" data-placeholder="Choose Brand" name="brand_id">
                      <option label="Choose Category">Choose Brand</option>
                      @foreach ($brand as $br)

                      <option value="{{$br->id}}">{{$br->brand_name}}</option>
                      @endforeach

                    </select>
                  </div>
                </div>




                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label">Product Color: <span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" name="product_color" data-role="tagsinput" id="color">

                  </div>
                </div><!-- col-4 -->

                <div class="col-lg-4">
                    <div class="form-group">
                      <label class="form-control-label">Product size: <span class="tx-danger">*</span></label>
                      <input class="form-control" type="text" name="product_size" data-role="tagsinput" id="size">

                    </div>
                  </div><!-- col-4 -->


                  <div class="col-lg-4">
                    <div class="form-group">
                      <label class="form-control-label">selling price:<span class="tx-danger">*</span></label>
                      <input class="form-control" type="text" name="selling_price"  placeholder="Enter selling price">
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="form-group">
                      <label class="form-control-label">Product Details:<span class="tx-danger">*</span></label>
                      <textarea class="form-control" name="product_details" id="summernote">


                      </textarea>

                    </div>
                  <div class="col-lg-12">
                    <div class="form-group">
                      <label class="form-control-label">Video Link:<span class="tx-danger">*</span></label>
                      <input class="form-control"  name="video_link" placeholder="Enter your video link">
                    </div>
                  </div>

                  </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-control-label">Image one (Index Image):<span class="tx-danger">*</span></label>
                        <label class="custom-file">
                            <input type="file" id="file" class="custom-file-input" name="image_one" onchange="readURL1(this);" required>
                            <span class="custom-file-control"></span>
                            <img src="#" id="one">
                          </label>
                    </div>
                    <br>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-control-label">Image two:<span class="tx-danger">*</span></label>
                        <label class="custom-file">
                            <input type="file" id="file" class="custom-file-input" name="image_two" onchange="readURL2(this);" required>
                            <span class="custom-file-control"></span>
                            <img src="#" id="two">
                          </label>
                    </div>
                  </div>
                  <br>

                  <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-control-label">Image Three:<span class="tx-danger">*</span></label>
                        <label class="custom-file">
                            <input type="file" id="file" class="custom-file-input" name="image_three" onchange="readURL3(this);" required>
                            <span class="custom-file-control"></span>
                            <img src="#" id="three">
                          </label>
                    </div>
                  </div>
              </div><!-- row -->


              <hr>
              <br>


              <div class="row">
                <div class="col-lg-4">
                    <label class="ckbox">
                        <input type="checkbox" name="main_slider" value="1">
                        <span>Main Slider</span>
                      </label>
                       </div>
                       <div class="col-lg-4">
                        <label class="ckbox">
                            <input type="checkbox" name="hot_deal" value="1">
                            <span>Hot Deal</span>
                          </label>
                           </div>
                           <div class="col-lg-4">
                            <label class="ckbox">
                                <input type="checkbox" name="best_rated" value="1">
                                <span>Best Rated</span>
                              </label>
                               </div>
                               <div class="col-lg-4">
                                <label class="ckbox">
                                    <input type="checkbox" name="trend" value="1">
                                    <span>trend product</span>
                                  </label>
                                   </div>
                                   <div class="col-lg-4">
                                    <label class="ckbox">
                                        <input type="checkbox" name="mid_slider" value="1">
                                        <span>mid slider</span>
                                      </label>
                                       </div>
                                       <div class="col-lg-4">
                                        <label class="ckbox">
                                            <input type="checkbox" name="hot_new" value="1">
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

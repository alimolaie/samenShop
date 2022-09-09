<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Twitter -->
    <meta name="twitter:site" content="@themepixels">
    <meta name="twitter:creator" content="@themepixels">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Starlight">
    <meta name="twitter:description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="twitter:image" content="http://themepixels.me/starlight/img/starlight-social.png">

    <!-- Facebook -->
    <meta property="og:url" content="http://themepixels.me/starlight">
    <meta property="og:title" content="Starlight">
    <meta property="og:description" content="Premium Quality and Responsive UI for Dashboard.">

    <meta property="og:image" content="http://themepixels.me/starlight/img/starlight-social.png">
    <meta property="og:image:secure_url" content="http://themepixels.me/starlight/img/starlight-social.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">

    <!-- Meta -->
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">

    <title>Admin ecommece Dashboard</title>

    <!-- vendor css -->
    <link href="{{asset('backend/lib/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('backend/lib/Ionicons/css/ionicons.css')}}" rel="stylesheet">
    <link href="{{asset('backend/lib/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet">
    <link href="{{asset('backend/lib/rickshaw/rickshaw.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/msg.css')}}">
    <link href="{{asset('backend/lib/highlightjs/github.css')}}" rel="stylesheet">
    <link href="{{asset('backend/lib/datatables/jquery.dataTables.js')}}" rel="stylesheet">
    <link href="{{asset('backend/lib/select2/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/toastr.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/bootstrap-tagsinput.css')}}" rel="stylesheet">
    <link href="{{asset('backend/lib/summernote/summernote-bs4.css')}}" rel="stylesheet">
    <!-- Starlight CSS -->
    <link rel="stylesheet" href="{{asset('backend/css/starlight.css')}}">

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


  </head>

  <body>


    @yield('admin_content')

    <script src="{{asset('js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('backend/lib/popper.js/popper.js')}}"></script>
    <script src="{{asset('backend/lib/bootstrap/bootstrap.js')}}"></script>
    <script src="{{asset('backend/lib/jquery-ui/jquery-ui.js')}}"></script>
    <script src="{{asset('backend/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js')}}"></script>
    <script src="{{asset('backend/lib/jquery.sparkline.bower/jquery.sparkline.min.js')}}"></script>
    <script src="{{asset('backend/lib/d3/d3.js')}}"></script>
    <script src="{{asset('backend/lib/rickshaw/rickshaw.min.js')}}"></script>
    <script src="{{asset('backend/lib/chart.js/Chart.js')}}"></script>
    <script src="{{asset('backend/lib/Flot/jquery.flot.js')}}"></script>
    <script src="{{asset('backend/lib/Flot/jquery.flot.pie.js')}}"></script>
    <script src="{{asset('backend/lib/Flot/jquery.flot.resize.js')}}"></script>
    <script src="{{asset('backend/lib/flot-spline/jquery.flot.spline.js')}}"></script>
    <script src="{{asset('backend/lib/highlightjs/highlight.pack.js')}}"></script>
    <script src="{{asset('backend/lib/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('backend/lib/datatables-responsive/dataTables.responsive.js')}}"></script>
    <script src="{{asset('backend/lib/select2/js/select2.min.js')}}"></script>
    <script src="{{asset('backend/js/starlight.js')}}"></script>
    <script src="{{asset('backend/js/ResizeSensor.js')}}"></script>
    <script src="{{asset('backend/js/dashboard.js')}}"></script>
    <script src="{{asset('js/bootstrap-tagsinput.min.js')}}"></script>
    <script src="{{asset('backend/lib/summernote/summernote-bs4.min.js')}}"></script>
    <script src="{{asset('backend/lib/medium-editor/medium-editor.js')}}"></script>

    <script src="{{asset('js/toastr.js')}}"></script>
        <script>
            @if (Session::has('message'))
                var type="{{Session::get('alert-type','info')}}";
                switch(type){
                    case 'info':
                    toastr.info("{{Session::get('message')}}");
                    break;
                    case 'success':
                    toastr.success("{{Session::get('message')}}");
                    break;
                    case 'warrning':
                    toastr.warrning("{{Session::get('message')}}");
                    break;
                    case 'error':
                    toastr.error("{{Session::get('message')}}");
                    break;

                }
            @endif
        </script>
        <script>
            $(function(){
              'use strict';

              $('#datatable1').DataTable({
                responsive: true,
                language: {
                  searchPlaceholder: 'Search...',
                  sSearch: '',
                  lengthMenu: '_MENU_ items/page',
                }
              });

              $('#datatable2').DataTable({
                bLengthChange: false,
                searching: false,
                responsive: true
              });

              // Select2
              $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });

            });
          </script>

        <script>
            $('#size').tagsinput('items');
            $('#color').tagsinput('items');
            $('#summernote').summernote({
           height: 150,
           tooltip: false
          });
          var editor = new MediumEditor('.editable');
            </script>
             <script type="text/javascript">
               $(document).ready(function(){
               $('select[name="category_id"]').on('change',function(){
                    var category_id = $(this).val();
                    if (category_id) {

                      $.ajax({
                        url: "{{ url('/get/subcategory/') }}/"+category_id,
                        type:"GET",
                        dataType:"json",
                        success:function(data) {
                        var d =$('select[name="category_id"]');
                        $.each(data, function(key, value){

                        $('select[name="subcategory_id"]').append('<option value="'+ value.id + '">' + value.subcategory_name + '</option>');

                        });
                        },
                      });

                    }else{
                      alert('danger');
                    }

                      });

                });


           </script>
              <script type="text/javascript">
                function readURL1(input){
             if (input.files && input.files[0]) {
               var reader = new FileReader();
                reader.onload = function(e) {
                  $('#one')
                  .attr('src', e.target.result)
                  .width(80)
                .height(80);
                };
             reader.readAsDataURL(input.files[0]);
        }
     }
     </script>
       <script type="text/javascript">
        function readURL2(input){
     if (input.files && input.files[0]) {
       var reader = new FileReader();
        reader.onload = function(e) {
          $('#two')
          .attr('src', e.target.result)
          .width(80)
        .height(80);
        };
     reader.readAsDataURL(input.files[0]);
}
}
</script>
<script type="text/javascript">
    function readURL3(input){
 if (input.files && input.files[0]) {
   var reader = new FileReader();
    reader.onload = function(e) {
      $('#three')
      .attr('src', e.target.result)
      .width(80)
    .height(80);
    };
 reader.readAsDataURL(input.files[0]);
}
}
</script>
<script>

 $('.delete-confirm').click(function(event) {
      var form =  $(this).closest("form");
      var name = $(this).data("name");
      event.preventDefault();
      swal({
          title: `Are you sure you want to delete ${name}?`,
          text: "If you delete this, it will be gone forever.",
          icon: "warning",
          buttons: true,
          dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          form.submit();
        }
      });
  });
    </script>
  </body>
</html>

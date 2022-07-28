
<form method="post" class="btn-submit row" data-id="{{ $data->subcat_id }}">


  <div class="form-group col-md-12">
    <label>Item Name:</label>
    <div class="input-group">
      <div class="input-group-addon"><i class="fa fa-check-square-o"></i></div>
      <select class="form-control" name="subcat_item_id" required="">
        <option value="">Select Item</option>
        @php
        $item = DB::table('pdt_item')->where('item_status',1)->get();   
        @endphp 
        @foreach($item as $i)
        <option value="{{ $i->item_id  }}" <?php if ($i->item_id == $data->subcat_item_id) {
          echo "selected";
        } ?>>{{ $i->item_name_en }} ( {{ $i->item_name_bn }} )</option>
        @endforeach
      </select>
    </div>
  </div>


  <div class="form-group col-md-12">
    <label>Category Name:</label>
    <div class="input-group">
      <div class="input-group-addon"><i class="fa fa-check-square-o"></i></div>
      <select class="form-control" name="subcat_cat_id" required="">
        <option value="">Select Category</option>
        @php
        $category = DB::table('pdt_category')->where('cat_status',1)->get();    
        @endphp 
        @foreach($category as $c)
        <option value="{{ $c->cat_id  }}" <?php if ($c->cat_id == $data->subcat_cat_id) {
          echo "selected";
        } ?>>{{ $c->cat_name_en }} ( {{ $c->cat_name_bn }} )</option>
        @endforeach
      </select>
    </div>
  </div>




  <div class="form-group col-md-12">
    <label>SubCategory Name(EN):</label>
    <div class="input-group">
      <div class="input-group-addon"><i class="fa fa-text-width"></i></div>
      <input class="form-control" type="text" name="subcat_name_en" id="subcat_name_en" placeholder="subCategory Name(EN)" value="{{ $data->subcat_name_en }}" required="">
    </div>
  </div>

  <div class="form-group col-md-12">
    <label>SubCategory Name(BN):</label>
    <div class="input-group">
      <div class="input-group-addon"><i class="fa fa-text-width"></i></div>
      <input class="form-control" type="text" name="subcat_name_bn" id="subcat_name_bn" placeholder="subCategory Name(BN)" value="{{ $data->subcat_name_bn }}">
    </div>
  </div>


  <div class="form-group col-md-6">
    <label>SubCategory URL:</label>
    <div class="input-group">
      <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
      <input class="form-control" type="url" placeholder="subCategory URL" name="subcat_url" id="subcat_url" value="{{ $data->subcat_url }}">
    </div>
  </div>

  <div class="form-group col-md-6">
    <label>Status:</label>
    <div class="input-group">
      <div class="input-group-addon"><i class="fa fa-check-square-o"></i></div>
      <select class="form-control" name="subcat_status" id="subcat_status">
        @if($data->subcat_status == 1)
        <option value="1">Active</option>
        <option value="0">Inactive</option>
        @else
        <option value="0">Inactive</option>
        <option value="1">Active</option>
        @endif
      </select>
    </div>
  </div>

  <div class="modal-footer border-0 ml-auto">
    <button type="button" class="btn btn-secondary border-0" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-success button border-0">Update</button>
    <button type="button" class="btn btn-success loading border-0">Loading...</button>
  </div>
</form>






<script type="text/javascript">

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });


  $('.loading').hide();
  $(".btn-submit").submit(function(e){
    e.preventDefault();

    var data = $(this).serialize();
    var id = $(this).data("id");

    $.ajax({
      url:"{{ url('updatesubcategory') }}/"+id,
      method:'POST',
      data:data,

      beforeSend:function(response) { 

        $('.loading').show();
        $('.button').hide();

      },


      success:function(response){

       Command:toastr["info"]("Data Update Successfully Done")
       toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "3000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
      }

      $('.loading').hide();
      $('.button').show();
      $('#exampleModalCenters').modal('hide');



      showdata();

    },

    error:function(error){
      console.log(error)
    }
  });
  });



</script>
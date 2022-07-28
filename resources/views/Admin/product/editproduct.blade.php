@extends('Admin.layouts.index')
@section('content')


<div class="content-wrapper">
  <div class="page-heading">
    <h3 class="page-title">Product Update Information</h3>
  </div>



  <div class="page-content fade-in">
    <div class="ibox">
      <div class="ibox-head mb-3 myhead">
        <div class="ibox-title"><i class="fa fa-list-ul" aria-hidden="true"></i>&nbsp;&nbsp;Product
        Setup List</div>
        <div><a href="{{ url('manageproduct') }}" class="btn btn-dark rounded addbutton"><i class="fa fa-eye"></i>&nbsp;View Product</a></div>
      </div>
      <div class="ibox-body">
        <form method="post" class="btn-submit" data-id="{{ $data->pdt_id }}">
          @csrf

          <div class="row myinput">

            <div class="col-md-6 row">


              <div class="form-group col-md-12">
                <label>Item Name:</label>
                <div class="input-group">

                  <select class="form-control" name="pdt_item_id" required="">
                    <option value=""></option>
                    @php
                    $item = DB::table('pdt_item')->where('item_status',1)->get();   
                    @endphp 
                    @foreach($item as $i)
                    <option value="{{ $i->item_id  }}" <?php if ($i->item_id == $data->pdt_item_id) {
                     echo "selected";
                   } ?>>{{ $i->item_name_en }} ( {{ $i->item_name_bn }} )</option>
                   @endforeach
                 </select>
               </div>
             </div>


             <div class="form-group col-md-6">
              <label>Category Name:</label>
              <div class="input-group">

                <select class="form-control" name="pdt_cat_id">
                  <option value=""></option>
                  @php
                  $category = DB::table('pdt_category')->where('cat_status',1)->get();    
                  @endphp 
                  @foreach($category as $c)
                  <option value="{{ $c->cat_id  }}" <?php if ($c->cat_id == $data->pdt_cat_id) {
                   echo "selected";
                 } ?>>{{ $c->cat_name_en }} ( {{ $c->cat_name_bn }} )</option>
                 @endforeach
               </select>
             </div>
           </div>


           <div class="form-group col-md-6">
            <label>Subcategory Name:</label>
            <div class="input-group">

              <select class="form-control" name="pdt_subcat_id">
                <option value=""></option>
                @php
                $subcategory = DB::table('pdt_subcategory')->where('subcat_status',1)->get();   
                @endphp 
                @foreach($subcategory as $c)
                <option value="{{ $c->subcat_id  }}"<?php if ($c->subcat_id == $data->pdt_subcat_id) {
                 echo "selected";
               } ?>>{{ $c->subcat_name_en }} ( {{ $c->subcat_name_bn }} )</option>
               @endforeach
             </select>
           </div>
         </div>



         <div class="form-group col-md-12">
          <label>Brand Name:</label>
          <div class="input-group">

            <select class="form-control" name="pdt_brand_id">
              <option value=""></option>
              @php
              $brand = DB::table('pdt_brand')->where('brand_status',1)->get();    
              @endphp 
              @foreach($brand as $c)
              <option value="{{ $c->brand_id  }}"<?php if ($c->brand_id == $data->pdt_brand_id) {
               echo "selected";
             } ?>>{{ $c->brand_name_en }} ( {{ $c->brand_name_bn }} )</option>
             @endforeach
           </select>
         </div>
       </div>



       <div class="form-group col-md-12">
        <label>Product Name(EN):</label>
        <div class="input-group">
          <input class="form-control" type="text" name="pdt_name_en" id="pdt_name_en"required="" value="{{ $data->pdt_name_en }}">
        </div>
      </div>

      <div class="form-group col-md-12">
        <label>Product Name(BN):</label>
        <div class="input-group">
          <input class="form-control" type="text" name="pdt_name_bn" id="pdt_name_bn" value={{ $data->pdt_name_bn }}>
        </div>
      </div>


      <div class="form-group col-md-12">
        <label>Measurement:</label>
        <div class="input-group">
          <input class="form-control" type="text" name="pdt_measurement" id="pdt_measurement" value={{ $data->pdt_measurement }}>
        </div>
      </div>


      <div class="form-group col-md-6">
        <label>Purchase Price:</label>
        <div class="input-group">
          <input class="form-control" type="text" name="pdt_purchase_price" id="pdt_purchase_price" value={{ $data->pdt_purchase_price }}>
        </div>
      </div>

      <div class="form-group col-md-6">
        <label>Sale Price:</label>
        <div class="input-group">
          <input class="form-control" type="text" name="pdt_sale_price" id="pdt_sale_price" required="" value={{ $data->pdt_sale_price }}>
        </div>
      </div>

      <div class="form-group col-md-6">
        <label>Over Stock:</label>
        <div class="input-group">
          <input class="form-control" type="number" name="pdt_over_stock" id="pdt_over_stock" value={{ $data->pdt_over_stock }}>
        </div>
      </div>


      <div class="form-group col-md-6">
        <label>Shelf No:</label>
        <div class="input-group">
          <input class="form-control" type="text" name="pdt_shelf_no" id="pdt_shelf_no" value={{ $data->pdt_shelf_no }}>
        </div>
      </div>


      <div class="form-group col-md-6">
        <label>Order Qty:</label>
        <div class="input-group">
          <input class="form-control" type="number" name="pdt_order_qunt" id="pdt_order_qunt" value={{ $data->pdt_order_qunt }}>
        </div>
      </div>

      <div class="form-group col-md-6">
        <label>Suspension:</label>
        <div class="input-group">
          <input class="form-control" type="text" name="pdt_suspension" id="pdt_suspension" value={{ $data->pdt_suspension }}>
        </div>
      </div>

      <div class="form-group col-md-12">
        <label>Product URL:</label>
        <div class="input-group">
          <input class="form-control" type="text" name="pdt_url" id="pdt_url" value={{ $data->pdt_url }}>
        </div>
      </div>


    </div>

    <div class="col-md-6">

      <div class="form-group col-md-12">
        <label>Short Details:</label>
        <div class="input-group">
          <textarea class="form-control" rows="10" name="pdt_short_details" id="pdt_short_details">{{ $data->pdt_short_details }}</textarea>
        </div>
      </div>


      <div class="form-group col-md-12">
        <label>Full Details:</label>
        <div class="input-group">
          <textarea class="form-control" rows="10" name="pdt_details" id="pdt_details">{{ $data->pdt_details }}</textarea>
        </div>
      </div>

      <div class="form-group col-md-12">
        <label>Condition:</label>
        <div class="input-group">
          <textarea class="form-control" rows="10" name="pdt_condition" id="pdt_condition">{{ $data->pdt_condition }}</textarea>
        </div>
      </div>  

      <div class="form-group col-md-12">
        <label>Status:</label>
        <div class="input-group">
          <select class="form-control" name="pdt_status" id="pdt_status">
            @if($data->pdt_status == 1)
           <option value="1">Active</option>
           <option value="0">Inactive</option>
           @else
           <option value="0">Inactive</option>
           <option value="1">Active</option>
           @endif
         </select>
       </div>
     </div>


     <br><br>

     <div class="modal-footer border-0">
      <button type="button" class="btn btn-secondary border-0" onClick="window.location.reload();">Close</button>
      <button type="submit" class="btn btn-success button border-0">Save</button>
      <button type="button" class="btn btn-success loading border-0">Loading...</button>
    </div>

  </div>











</div>
</form>

</div>
</div>

</div>
</div>

<!-------End Table--------->




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
      url:'{{ url('updateproduct') }}/'+id,
      method:'POST',
      data:data,
      beforeSend:function(response) { 
        $('.loading').show();
        $('.button').hide();

      },
      success:function(response){

        Command:toastr["success"]("Data Update Successfully Done")
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


      },

      error:function(error){
        console.log(error)
      }
    });
  });

  // End Add Data


</script>





@endsection
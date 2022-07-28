
<form method="post" class="btn-submit row myinput" data-id="{{ $data->customer_id }}">


  @php
  $branch = DB::table('branch_info')->get();
  @endphp

  <div class="form-group col-md-12">
    <label>Branch Name:</label>
    <div class="input-group">
      <div class="input-group-addon"><i class="fa fa-check-square-o"></i></div>
      <select class="form-control" name="customer_branch_id" id="customer_branch_id">
        <option value="">Select Branch</option>
        @if(isset($branch))
        @foreach($branch as $c)
        <option value="{{ $c->branch_id }}"  <?php if ($c->branch_id == $data->customer_branch_id ) {
       echo "selected";
        } ?>>{{ $c->branch_name_en }}</option>
        @endforeach
        @endif

      </select>
    </div>
  </div>



  <div class="form-group col-md-12">
    <label>Customer Name(EN):</label>
    <div class="input-group">
      <div class="input-group-addon"><i class="fa fa-text-width"></i></div>
      <input class="form-control" type="text" name="customer_name_en" id="customer_name_en" placeholder="Customer Name(EN)" required="" value="{{ $data->customer_name_en }}">
    </div>
  </div>



  <div class="form-group col-md-12">
    <label>Customer Name(BN):</label>
    <div class="input-group">
      <div class="input-group-addon"><i class="fa fa-text-width"></i></div>
      <input class="form-control" type="text" name="customer_name_bn" id="customer_name_bn" placeholder="Customer Name(BN)" value="{{ $data->customer_name_bn }}">
    </div>
  </div>


  <div class="form-group col-md-6">
    <label>Customer Mobile:</label>
    <div class="input-group">
      <div class="input-group-addon"><i class="fa fa-phone"></i></div>
      <input class="form-control" type="number" name="customer_phone" id="customer_phone" placeholder="Customer Mobile" required="" value="{{ $data->customer_phone }}">
    </div>
  </div>

  <div class="form-group col-md-6">
    <label>Email:</label>
    <div class="input-group">
      <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
      <input class="form-control" type="text" placeholder="Email" name="customer_email" id="customer_email" value="{{ $data->customer_email }}">
    </div>
  </div>


  <div class="form-group col-md-12">
    <label>Address:</label>
    <div class="input-group">
      <div class="input-group-addon"><i class="fa fa-location-arrow"></i></div>
      <textarea class="form-control" rows="3" name="customer_address" id="customer_address" required="">{{ $data->customer_address }}</textarea>
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
      url:"{{ url('updatecustomer') }}/"+id,
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

      window.location.href="";





    },

    error:function(error){
      console.log(error)
    }
  });
  });



</script>

<form method="post" class="btn-submit row" data-id="{{ $data->company_id }}">
  <div class="form-group col-md-6">
    <label>Company Name(EN):</label>
    <div class="input-group">
      <div class="input-group-addon"><i class="fa fa-text-width"></i></div>
      <input class="form-control" type="text" name="company_name_en" id="company_name_en" placeholder="Company Name(EN)" value="{{ $data->company_name_en }}" required="">
    </div>
  </div>

  <div class="form-group col-md-6">
    <label>Company Name(BN):</label>
    <div class="input-group">
      <div class="input-group-addon"><i class="fa fa-text-width"></i></div>
      <input class="form-control" type="text" name="company_name_bn" id="company_name_bn" placeholder="Company Name(BN)" value="{{ $data->company_name_bn }}">
    </div>
  </div>

  <div class="form-group col-md-12">
    <label>Company Mobile:</label>
    <div class="input-group">
      <div class="input-group-addon"><i class="fa fa-phone"></i></div>
      <input class="form-control" type="number" name="company_mobile" id="company_mobile" placeholder="Company Mobile" value="{{ $data->company_mobile }}" required="">
    </div>
  </div>

  <div class="form-group col-md-12">
    <label>Company Address(EN):</label>
    <div class="input-group">
      <div class="input-group-addon"><i class="fa fa-location-arrow"></i></div>
      <textarea class="form-control" rows="3" name="company_address_en" id="company_address_en" required="">{{ $data->company_address_en }}</textarea>
    </div>
  </div>

  <div class="form-group col-md-12">
    <label>Company Address(BN):</label>
    <div class="input-group">
      <div class="input-group-addon"><i class="fa fa-location-arrow"></i></div>
      <textarea class="form-control" rows="3" name="company_address_bn" id="company_address_bn">{{ $data->company_address_bn }}</textarea>
    </div>
  </div>

  <div class="form-group col-md-6">
    <label>Email:</label>
    <div class="input-group">
      <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
      <input class="form-control" type="text" placeholder="Email" name="company_email" id="company_email" value="{{ $data->company_email }}">
    </div>
  </div>

  <div class="form-group col-md-6">
    <label>Status:</label>
    <div class="input-group">
      <div class="input-group-addon"><i class="fa fa-check-square-o"></i></div>
      <select class="form-control" name="status" id="status">
        @if($data->status == 1)
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
      url:"{{ url('updatecompany') }}/"+id,
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
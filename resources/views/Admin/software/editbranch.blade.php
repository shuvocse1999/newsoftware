
<form method="post" class="btn-submit row" data-id="{{ $data->branch_id }}">


  @php
  $company = DB::table('company_info')->get();
  @endphp

  <div class="form-group col-md-12">
    <label>Com. Name:</label>
    <div class="input-group">
      <div class="input-group-addon"><i class="fa fa-check-square-o"></i></div>
      <select class="form-control" name="company_id" id="company_id">
        @if(isset($company))
        @foreach($company as $c)
        <option value="{{ $c->company_id }}" <?php if ($c->company_id == $data->company_id) {
          echo "selected";
        }  ?>>{{ $c->company_name_en }}</option>
        @endforeach
        @endif

      </select>
    </div>
  </div>



  <div class="form-group col-md-6">
    <label>Branch Name(EN):</label>
    <div class="input-group">
      <div class="input-group-addon"><i class="fa fa-text-width"></i></div>
      <input class="form-control" type="text" name="branch_name_en" id="branch_name_en" placeholder="Branch Name(BN)" required="" value="{{ $data->branch_name_en }}">
    </div>
  </div>



  <div class="form-group col-md-6">
    <label>Branch Name(BN):</label>
    <div class="input-group">
      <div class="input-group-addon"><i class="fa fa-text-width"></i></div>
      <input class="form-control" type="text" name="branch_name_bn" id="branch_name_bn" placeholder="Branch Name(BN)" value="{{ $data->branch_name_bn }}">
    </div>
  </div>


  <div class="form-group col-md-12">
    <label>Branch Mobile:</label>
    <div class="input-group">
      <div class="input-group-addon"><i class="fa fa-phone"></i></div>
      <input class="form-control" type="number" name="branch_mobile" id="branch_mobile" placeholder="Branch Mobile" required="" value="{{ $data->branch_mobile }}">
    </div>
  </div>

  <div class="form-group col-md-12">
    <label>Address(EN):</label>
    <div class="input-group">
      <div class="input-group-addon"><i class="fa fa-location-arrow"></i></div>
      <textarea class="form-control" rows="3" name="branch_address_en" id="branch_address_en" required="">{{ $data->branch_address_en }}</textarea>
    </div>
  </div>

  <div class="form-group col-md-12">
    <label>Address(BN):</label>
    <div class="input-group">
      <div class="input-group-addon"><i class="fa fa-location-arrow"></i></div>
      <textarea class="form-control" rows="3" name="branch_address_bn" id="branch_address_bn">{{ $data->branch_address_bn }}</textarea>
    </div>
  </div>




  <div class="form-group col-md-6">
    <label>Email:</label>
    <div class="input-group">
      <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
      <input class="form-control" type="text" placeholder="Email" name="branch_email" id="branch_email" value="{{ $data->branch_email }}" value="{{ $data->branch_email }}">
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
      url:"{{ url('updatebranch') }}/"+id,
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
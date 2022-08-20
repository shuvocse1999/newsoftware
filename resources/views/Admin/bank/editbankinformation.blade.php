

<form method="post" class="btn-submit row" data-id="{{ $data->id }}">


    <div class="form-group col-md-12">
      <label>Bank Name:</label>
      <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-text-width"></i></div>
        <input class="form-control" type="text" name="bank_name" id="bank_name" placeholder="Bank Name" required="" value="{{ $data->bank_name }}">
      </div>
    </div>



    <div class="form-group col-md-12">
      <label>Account Number:</label>
      <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-text-width"></i></div>
        <input class="form-control" type="number" name="account_number" id="account_number" placeholder="Account No." required="" value="{{ $data->account_number }}">
      </div>
    </div>

    <div class="form-group col-md-6">
      <label>Account Type:</label>
      <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-text-width"></i></div>
        <input class="form-control" type="text" name="account_type" id="account_type" placeholder="Account Type" value="{{ $data->account_type }}">
      </div>
    </div>


    <div class="form-group col-md-6">
      <label>Contact Number:</label>
      <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-text-width"></i></div>
        <input class="form-control" type="text" name="contact" id="contact" placeholder="Account Type" value="{{ $data->contact }}">
      </div>
    </div>




    <div class="form-group col-md-6">
      <label>Banking Type:</label>
      <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-text-width"></i></div>
        <input class="form-control" type="text" name="bankingType" id="bankingType" placeholder="Banking Type" value="{{ $data->bankingType }}">
      </div>
    </div>


    <div class="form-group col-md-12">
      <label>Details:</label>
      <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-text-width"></i></div>
        <textarea rows="3" name="details" id="details" class="form-control" placeholder="Details">{{ $data->details }}</textarea>
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
      url:"{{ url('updatebankinformation') }}/"+id,
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
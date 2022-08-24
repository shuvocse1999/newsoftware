
<form method="post" class="btn-submit row myinput" data-id="{{ $data->id }}">



  <div class="form-group col-md-6">
    <label>Employee Name:</label>
    <div class="input-group">
      <div class="input-group-addon"><i class="fa fa-text-width"></i></div>
      <input class="form-control" type="text" name="employee_name" id="employee_name"  required=""value="{{ $data->employee_name }}" placeholder="Employee Name">
    </div>
  </div>



  <div class="form-group col-md-6">
    <label>Employee Mobile:</label>
    <div class="input-group">
      <div class="input-group-addon"><i class="fa fa-phone"></i></div>
      <input class="form-control" type="number" name="employee_phone" id="employee_phone" required=""value="{{ $data->employee_phone }}" placeholder="Employee Mobile">
    </div>
  </div>



  <div class="form-group col-md-6">
    <label>Email:</label>
    <div class="input-group">
      <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
      <input class="form-control" type="text"  name="employee_email" id="employee_email"value="{{ $data->employee_email }}" placeholder="Employee Email">
    </div>
  </div>



  <div class="form-group col-md-6">
    <label>NID No:</label>
    <div class="input-group">
      <div class="input-group-addon"><i class="fa fa-text-width"></i></div>
      <input class="form-control" type="text" name="employee_nid" id="employee_nid" value="{{ $data->employee_nid }}" placeholder="NID NO.">
    </div>
  </div>


  <div class="form-group col-md-6">
    <label>Joining Date:</label>
    <div class="input-group">
      <div class="input-group-addon"><i class="fa fa-text-width"></i></div>
      <input class="form-control" type="date" name="joining_date" id="joining_date" value="{{ $data->joining_date }}" placeholder="NID NO." required="">
    </div>
  </div>





  <div class="form-group col-md-12">
    <label>Address:</label>
    <div class="input-group">
      <div class="input-group-addon"><i class="fa fa-location-arrow"></i></div>
      <textarea class="form-control" rows="3" name="employee_address" id="employee_address" required="" placeholder="Address">{{ $data->employee_address }}</textarea>
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
      url:"{{ url('updateemployee') }}/"+id,
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
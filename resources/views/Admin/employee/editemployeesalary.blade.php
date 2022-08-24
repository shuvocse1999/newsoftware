
<form method="post" class="btn-submit row myinput" data-id="{{ $data->id }}">

  <div class="form-group col-md-6">
    <label>Employee Name:</label>
    <div class="input-group">
      <div class="input-group-addon"><i class="fa fa-user"></i></div>
      <select class="form-control select2_demo_1" name="employee_id" id=
      "employee_id" required="">
      <option value="">Select Employee</option>
      @php
      $employee = DB::table('employee_info')->where("branch",Auth('admin')->user()->branch)->get();   
      @endphp 
      @foreach($employee as $i)
      <option value="{{ $i->id  }}" <?php if ($i->id == $data->employee_id) {
       echo "selected";
      } ?>>{{ $i->id }} - {{ $i->employee_name }}</option>
      @endforeach
    </select>
    <div class="input-group-addon border border-left-0" data-toggle="modal" data-target="#exampleModalCenters"><i class="fa fa-plus-circle text-primary"></i></div>
  </div>
</div>



<div class="form-group col-md-6">
  <label>Withdraw:</label>
  <div class="input-group">
    <div class="input-group-addon"><i class="fa fa-money"></i></div>
    <input class="form-control" type="number"  name="salary_withdraw" id="salary_withdraw" placeholder="Withdraw" required="" value="{{ $data->salary_withdraw }}">
  </div>
</div>



<div class="form-group col-md-6">
  <label>Transaction Type:</label>
  <div class="input-group">
    <div class="input-group-addon"><i class="fa fa-text-width"></i></div>
    <input class="form-control" type="text" name="transaction_type" id="transaction_type" value="{{ $data->transaction_type }}"  placeholder="Transaction Type" required="">
  </div>
</div>


<div class="form-group col-md-6">
  <label>Date:</label>
  <div class="input-group">
    <div class="input-group-addon"><i class="fa fa-text-width"></i></div>
    <input class="form-control" type="date" name="payment_dates" id="payment_dates" value="{{ $data->date }}" placeholder="" required="">
  </div>
</div>





<div class="form-group col-md-12">
  <label>Comment:</label>
  <div class="input-group">
    <div class="input-group-addon"><i class="fa fa-location-arrow"></i></div>
    <textarea class="form-control" rows="3" name="note" id="note" placeholder="Comment">{{ $data->note }}</textarea>
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
      url:"{{ url('updateemployeesalary') }}/"+id,
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
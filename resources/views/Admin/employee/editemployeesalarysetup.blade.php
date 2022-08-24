
<form method="post" class="btn-submit row" data-id="{{ $data->id }}">

  @php
  $employee = DB::table('employee_info')->where('status',1)->where("branch",Auth('admin')->user()->id)->get();
  @endphp

  <div class="form-group col-md-12">
    <label>Branch Name:</label>
    <div class="input-group">
      <div class="input-group-addon"><i class="fa fa-check-square-o"></i></div>
      <select class="form-control" name="employee_id" id="employee_id" required="" style="width: 100%!important;">
        <option value="">Select Employee</option>
        @if(isset($employee))
        @foreach($employee as $c)
        <option value="{{ $c->id }}" <?php if ($c->id == $data->employee_id) {
         echo "selected";
        } ?>>{{ $c->employee_name }}</option>
        @endforeach
        @endif

      </select>
    </div>
  </div>



  <div class="form-group col-md-12">
    <label>Salary:</label>
    <div class="input-group">
      <div class="input-group-addon"><i class="fa fa-text-width"></i></div>
      <input type="number" name="employee_salary" id="employee_salary" placeholder="Salary" class="form-control" required="" value="{{ $data->employee_salary }}">
    </div>
  </div>



  <div class="form-group col-md-12">
    <label>Status:</label>
    <div class="input-group">
      <div class="input-group-addon"><i class="fa fa-check-square-o"></i></div>
      <select class="form-control" name="salary_status" id="salary_status">
        @if($data->salary_status == 1)
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
      url:"{{ url('updateemployeesalarysetup') }}/"+id,
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
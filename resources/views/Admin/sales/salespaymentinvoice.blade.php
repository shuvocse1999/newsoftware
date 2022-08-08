
<!DOCTYPE html>
<html>
<head>
  <title>Invoice</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400&display=swap" rel="stylesheet">
</head>
<body>


  @php
  use NumberToWords\NumberToWords;
  $company_info = DB::table("company_info")->first();
  $numberToWords = new NumberToWords();
  $numberTransformer = $numberToWords->getNumberTransformer('en');

  @endphp


  <div class="invoice border">

    <center><img src="{{ url($company_info->banner) }}" id="header_image" class="img-fluid"></center>


    <table class="table table-bordered">
      <tr>
        <td colspan="4" style="text-align:center;font-size: 16px;text-transform: uppercase;font-weight: bold;"><b>Sales Payment Invoice</b></td>
      </tr>
      <tr>
       <td colspan="2">
        Date : {{ $data->entry_date }}<br>
        Voucher No : {{ $data->id }} <br>
        Suplier Info : {{ $data->customer_name_en }}, {{ $data->customer_phone }}

      </td>
      <td colspan="2">
        Transaction : {{ $data->payment_type }}<br>
        Print  : {{ date('d M Y') }}<br>
      </tr>



      <!-- <thead> -->
       <tr>
         <th>SL</th>
         <th>Payment Date</th>
         <th>Payment</th>
         <th>Type</th>
       </tr>
       <!-- </thead> -->



       <tbody>

    
        <tr>
          <td>01</td>
          <td>{{ $data->entry_date }}</td>
          <td>{{ $data->payment_amount }}</td>
          <td>{{ $data->payment_type }}</td>
         
        </tr>


      </tbody>





    </table>

    <span class="note p-4">
      <span style="text-transform: capitalize;"><b>In Word:</b> {{ $numberTransformer->toWords($data->payment_amount) }} Taka Only.</span>
    </span>




    <br>

    <div class="row p-4">
      <div class="col-4">
        --------------------<br>
        Customer's Signature
      </div>
      <div class="col-4" style="text-align:center;">
        --------------------<br>
        Prepared By
      </div>
      <div class="col-4" style="text-align:right;">
        --------------------<br>
        Authorized  Signature
      </div>
    </div>

    <br>
    <center><a href="#" class="btn btn-danger btn-sm print w-10" onclick="window.print();">Print</a></center>
    <br>

  </div>






  <style type="text/css">

    body{
      font-family: 'Lato';
    }

  
    .invoice{
      background: #fff;
      padding: 30px;
    }
 
    .invoice span{
      font-size: 15px;
    }

    thead{
      font-size: 15px;
    }

    tbody{
      font-size: 13px;
    }

    .table-bordered td, .table-bordered th{
      border: 1px solid #585858 !important;
      box-shadow: none;
      border-bottom: 1px solid #585858;
    }

    .table-bordered tr{
      border: 1px solid #585858 !important;
    }


    tbody {
      border: none !important;
    }


    @media  print
    {

      .table-bordered tr{
        border: 1px solid #585858 !important;
      }

      @page  {
        /*size: 7in 15.00in;*/
        margin: 1mm 1mm 1mm 1mm;
        padding: 10px;
      }

      .print{
        display: none;
      }

      .invoice span{
        font-size: 22px;
      }
      /*@page  { size: 10cm 20cm landscape; }*/

    }


  </style>


</body>
</html>
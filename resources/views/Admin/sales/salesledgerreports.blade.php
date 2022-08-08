
<!DOCTYPE html>
<html>
<head>
  <title>Sales Reports</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400&display=swap" rel="stylesheet">
</head>
<body>


  @php
  $company_info = DB::table("company_info")->first();

  @endphp


  <div class="invoice border">

    <center><img src="{{ url($company_info->banner) }}" id="header_image" class="img-fluid"></center>


    <table class="table table-bordered">
      <tr>

        <td colspan="9" style="text-align:center;font-size: 16px;text-transform: uppercase;"><b>Sale Ledger Reports</b>
          <br>
          <div style="font-size: 13px;">



          </div>
        </td>
      </tr>
      <tr>

      </tr>



      <!-- <thead> -->
       <tr>
         <th>SL</th>
         <th>Invoice No</th>
         <th>Invoice Date</th>
         <th>Customer Info.</th>
         <th>Transaction</th>
         <th>Total Amount</th>
         <th>Discount</th>
         <th>Paid</th>
         <th>Due</th>

       </tr>
       <!-- </thead> -->



       <tbody>

        @php
        $i=1;
        $totalamount = 0;
        $grandtotal = 0;
        $granddiscount = 0;
        $grandpaid = 0;
        $granddue = 0;
        @endphp
        @if(isset($data))
        @foreach($data as $d)
        @php
        $entry = DB::table("sales_entry")->where("invoice_no",$d->invoice_no)->get();
        $granddiscount = $granddiscount+$d->final_discount;
        $grandpaid     = $grandpaid+$d->paid_amount;
        @endphp

        @foreach($entry as $e)
        @php
        $totalamount = ($e->product_sales_price*$e->product_quantity)-($e->product_discount_amount*$e->product_quantity);
        @endphp
        @endforeach

        @php
          $grandtotal = $grandtotal+$d->total;
          $granddue   = $granddue+($d->total-$d->final_discount)-$d->paid_amount;
        @endphp


        <tr>
          <td>{{ $i++ }}</td>
          <td>{{ $d->invoice_no }}</td>
          <td>{{ $d->invoice_date }}</td>
          <td>{{ $d->customer_name_en }}, {{ $d->customer_phone }}</td>
          <td>{{ $d->transaction_type }}</td>
          <td>{{ $d->total }}</td>
          <td>{{ $d->final_discount }}</td>
          <td>{{ $d->paid_amount }}</td>
          <td>{{ ($d->total-$d->final_discount)-$d->paid_amount }}</td>
          

        </tr>

        @endforeach
        @endif


      </tbody>

      <tr>
        <th colspan="5" class="text-right">TOTAL:</th>
        <th>{{ $grandtotal }} /-</th>
        <th>{{ $granddiscount }} /-</th>
        <th>{{ $grandpaid }} /-</th>
        <th>{{ $granddue }} /-</th>
      </tr>



    </table>




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
      border:none!important;
      padding:30px;

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
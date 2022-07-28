
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

    <center><img src="{{ url($company_info->banner) }}" id="header_image"></center>


    <table class="table table-bordered">
      <tr>
        <td colspan="6" style="text-align:center;font-size: 16px;text-transform: uppercase;font-weight: bold;"><b>Purchase Invoice</b></td>
      </tr>
      <tr>
       <td colspan="2">
        Date : {{ $data->invoice_date }}<br>
        Invoice No : {{ $data->invoice_no }} <br>
        Suplier Info : {{ $data->supplier_name_en }}, {{ $data->supplier_phone }}

      </td>
      <td colspan="3">
        Transaction : {{ $data->transaction_type }}<br>
        Prepared By : {{ $data->name }}<br>
        Print  : {{ $data->entry_date }}<br>
      </tr>



      <!-- <thead> -->
       <tr>
         <th>SL</th>
         <th>Product</th>
         <th>Quantity</th>
         <th>Price</th>
         <th>Sub Total</th>
       </tr>
       <!-- </thead> -->



       <tbody>

        @php
        $i=1;
        @endphp
        @if(isset($product))
        @foreach($product as $p)

        <tr>
          <td>{{ $i++ }}</td>
          <td>{{ $p->pdt_name_en }} {{ $p->pdt_name_bn }}</td>
          <td>{{ $p->product_quantity }}</td>
          <td>{{ $p->purchase_price }}</td>
          <td>{{ $p->purchase_price*$p->product_quantity }}</td>
        </tr>

        @endforeach
        @endif


      </tbody>



      <tr>

        <td colspan="4" style="text-align: right;">
          Total Amount :<br>
          Paid :<br>
          Due :
        </td>




        <td>
          {{ $data->total_amount }} /- <br>
          {{ $data->paid }} /-<br>
          {{ $data->due }} /-<br>

        </td>


      </tr>


    </table>

    <span class="note p-4">
      <span style="text-transform: capitalize;"><b>In Word:</b> {{ $numberTransformer->toWords($data->total_amount) }} Taka Only.</span>
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


    <center><a style="font-size: 12px;">Software Developed by SBIT. For query: 01840241895</a></center>

  </div>






  <style type="text/css">

    body{
      font-family: 'Lato';
    }

    #header_image
    {
      width:100%;
      height: 140px;

    }
    .invoice{
      background: #f9f9f9;
      size: 21cm 29.7cm;
      margin: 0mm 45mm 30mm 45mm;
    }
    .invoice img{
      height: 80px;
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
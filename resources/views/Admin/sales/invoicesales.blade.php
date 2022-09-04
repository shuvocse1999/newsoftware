
<!DOCTYPE html>
<html>
<head>
  <title>Invoice</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>






  <div class="invoice border" style="padding-bottom:80px;">



    <table class="table table-bordered" >
      <div class="header">
        <div class="title">
         <h1> <span>تموينات انور مباركي</span><br>
           <b>ANWER MUBARAKI GROCERY</b><br></h1>
           <span>   الجردية</span><br>
           <span> صمتة</span><br>
           <b>AL JURDIYYAH</b>
           <div class="row">
            <div class="col-12"  style="text-align:left;">
              <b>Tex no :   30213110030003 </b>
            </div>
            <div class="col-12"  style="text-align:right;">
              <b>الرقم الضريبي</b>
            </div>
          </div>
        </div>
      </div>
      <!--<img src="http://sbit.com.bd/pos/public/admin/assets/img/banner.jpg" style="width:100%;height:250px;">-->
      <tr>
       <td colspan="6">
         Print Date & Time : 04-09-2022 & 02:48:51
         Invoice ID :SI-0001927 <br>
         Customer Info :Shohidul Islam
       </td>
     </tr>



     <!-- <thead> -->
       <tr>
         <th >SL</th>
         <th >Product </th>
         <th >Qty.</th>
         <th >Price</th>
         <th >Total</th>
       </tr>
       <!-- </thead> -->



       <tbody>


         @php
         $i=1;
         $total_amount = 0;
         @endphp
         @if(isset($product))
         @foreach($product as $p)

         @php
         $total_amount =($total_amount+($p->product_sales_price*$p->product_quantity))-($p->product_discount_amount*$p->product_quantity);
         @endphp

         <tr>
          <td>{{ $i++ }}</td>
          <td>{{ $p->pdt_name_en }} {{ $p->pdt_name_bn }}</td>
          <td>{{ $p->product_quantity }}</td>
          <td>{{ $p->product_sales_price }}</td>
          <td>{{ ($p->product_sales_price*$p->product_quantity)-($p->product_discount_amount*$p->product_quantity) }}</td>
        </tr>

        @endforeach
        @endif

      </tbody>



      <tr>

        <td colspan="4" style="text-align: right;padding-right: 5px;border-right: 1px solid #999">
         Total :<br>
       </td>
       <td>
        {{ $total_amount }}<br>
      </td>


    </tr>



  <tr>

    <td colspan="4" style="text-align: right;padding-right: 5px;border-right: 1px solid #999">
     Discount :<br>
   </td>
   <td>
    {{ $data->final_discount }}<br>
  </td>


</tr>


    <tr>

      <td colspan="4" style="text-align: right;padding-right: 5px;border-right: 1px solid #999">
        Vat :<br>
     </td>
     <td>
      {{ $data->vat }}<br>
    </td>


  </tr>



<tr>

  <td colspan="4" style="text-align: right;padding-right: 5px;border-right: 1px solid #999">
    Grand Total :<br>
  </td>
  <td>
    {{ ($data->vat+($total_amount-$data->final_discount)) }}<br>
  </td>


</tr>


<tr>

  <td colspan="4" style="text-align: right;padding-right: 5px;border-right: 1px solid #999">
    Paid :<br>
  </td>
  <td>
    {{ $data->paid_amount }}<br>
  </td>


</tr>


<tr>

  <td colspan="4" style="text-align: right;padding-right: 5px;border-right: 1px solid #999">
    Due :<br>
  </td>
  <td>
    {{ (($total_amount+ $data->vat)-$data->final_discount)-$data->paid_amount }}<br>
  </td>


</tr>


</table>

<span class="note">
  In Word: one hundred thirteen thousand eight hundred twenty-five only<br>
  Prepared By : Admin<br>
</span>

<script>
  window.print();
</script>


<style type="text/css">
  *{
    padding: 0px;margin: 0px;
  }
  .invoice{
    margin-top : 0px;
  }
  body{
    font-family: 'Poppins', sans-serif;
    color: black;
  }
  .title {
    text-align: center;
  }

  .title span {
    font-size: 18px !important;
    font-weight: bold;
  }

  .title b {
    font-size: 18px;
  }
  .invoice{
    width: 110mm;
   
    padding: 3mm;
    /*margin: 0 auto;*/
  }
  .invoice img{
    height: 80px;
  }
  .invoice span{
    font-size: 16px;
  }

  thead{
    font-size: 16px;
  }

  tbody{
    font-size: 16px;
  }
  .table-bordered td{
    padding : 3px;
  }
  .table-bordered th{
    padding : 3px;
  }

  .table-bordered{
    border : none !important;
  }

  @media    print
  {
    .print{
      display: none;
    }

    .invoice span{
      font-size: 16px;
    }

    thead{
      font-size: 16px;
    }
    tbody{
      font-size: 16px;
    }
  }

</style>


</body>
</html>
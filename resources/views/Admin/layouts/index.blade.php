<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width initial-scale=1.0">
 <meta name="csrf-token" content="{{ csrf_token() }}" />
 <title>Admin Dashboard</title>
 <!-- GLOBAL MAINLY STYLES-->
 <link href="{{ url('public/Admin') }}/assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
 <link href="{{ url('public/Admin') }}/assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
 <link href="{{ url('public/Admin') }}/assets/vendors/summernote/dist/summernote.css" rel="stylesheet" />
 <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
 <link href="{{ url('public/Admin') }}/assets/vendors/themify-icons/css/themify-icons.css" rel="stylesheet" />
 <!-- PLUGINS STYLES-->
 <link href="{{ url('public/Admin') }}/assets/vendors/jvectormap/jquery-jvectormap-2.0.3.css" rel="stylesheet" />
 <link href="{{ url('public/Admin') }}/assets/vendors/DataTables/datatables.min.css" rel="stylesheet" />
 <link href="{{ url('public/Admin') }}/assets/css/bootstrap-icons.css">
 <link href="{{ url('public/Admin') }}/assets/vendors/select2/dist/css/select2.css" rel="stylesheet" />
 <!-- THEME STYLES-->
 <link href="{{ url('public/Admin') }}/assets/css/main.min.css" rel="stylesheet" />
 <link href="{{ url('public/Admin') }}/assets/css/main.css" rel="stylesheet" />
 <script src="{{ url('public/Admin') }}/assets/js/jquery.min.js"></script>
 <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js"></script>
 <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet"/>



 <!-- PAGE LEVEL STYLES-->
 <style type="text/css">
   .page-title{
    font-size: 22px!important;
    font-weight: bold;
    color: #414141;
  }
  .myhead{
    background: #2E4D62; color: #f1f1f1;
  }

  .ibox-title2{
    background: #2E4D62; color: #f1f1f1; font-size: 14px!important; width: 100%;padding: 10px;
  }
  
  .ibox-title{font-size: 14px!important;}

  .mythead{
    background: #14A586; color: #f1f1f1; font-size: 13px;
  }
  .tbody{
    font-size: 13px;
  }
  .addbutton{
    background: #14A586!important;
    font-size: 13px;
  }
  .addbutton:focus{
    box-shadow: none;
  }
  .myinput label{
    font-size: 13px;
    font-weight: 600;
    color: #585858;
  }

  .myinput .fa{
    font-size: 12px;
  }

  .myinput textarea{
    font-size: 13px;
    border-radius: 0px;
    
  }

  .myinput input{
    height: 40px;
    font-size: 13px;
    border-radius: 0px;
    
  }
  .myinput select{
    height: 40px!important;
    font-size: 13px;
    cursor: pointer;
    border-radius: 0px!important;
    
  }

  ::placeholder {
   color: lightgray;
   font-size: 12px;
 }

 .btn{font-size: 12px!important;}

 .btn:hover{
  cursor: pointer;
}


.purchase thead{
  background: #2E4D62!important;
  font-size: 13px;
}


.purchase tbody{
  font-size: 13px;
}


.input-group-addon{
  border-radius: 0px!important;
  border-color: #e1e1e1;
}

.overflow{overflow: auto;}

.modal-title{font-size: 15px!important;}
.input-group-addon{background: #f4f4f4; color: #414141; border-right: none; border-radius: 0px;}
.side-menu .nav-2-level > li > a i{font-size: 11px!important;}
.side-menu .nav-2-level > li > a{font-size: 13px; padding-top: 8px;padding-bottom: 8px;}
.side-menu .nav-2-level > li > a:hover{background: #2E4D62;}
.side-menu .nav-2-level > li > a:focus{background: #2E4D62;}
.side-menu .nav-2-level > li > .active{background: #2E4D62;}
.nav-label{font-size: 14px;}
.toast-message{
  font-size: 13px!important;
}

.side-menu > li:hover > a{
  background: #273c75;
}

.side-menu > li.active > a, .side-menu > li.active > a:hover, .side-menu > li.active > a:focus{
  background: #273c75;
}
.gj-datepicker-bootstrap [role=right-icon] button .gj-icon, .gj-datepicker-bootstrap [role=right-icon] button .material-icons{
 position: relative;
 font-size: 24px;
 top: 0px;
 left: 0px;
 border-radius: 0px!important;
 border-color: #fff;
}

.gj-datepicker-bootstrap [role=right-icon] button{
  width: 100%;
  border-radius: 0px;
}

</style>
</head>

<body class="fixed-navbar <?php if(request()->path() === 'purchase'){ echo 'sidebar-mini'; } ?>">
 <div class="page-wrapper">
  <!-- START HEADER-->
  <header class="header">
   <div class="page-brand">
    <a class="link" href="{{ url('/AdminDashboard') }}">
     <span class="brand font-weight-bold">DASHBOARD
     </span>
     <span class="brand-mini">DB</span>
   </a>
 </div>
 <div class="flexbox flex-1">
  <!-- START TOP-LEFT TOOLBAR-->
  <ul class="nav navbar-toolbar">
   <li>
    <a class="nav-link sidebar-toggler js-sidebar-toggler"><i class="ti-menu"></i></a>
  </li>
  <li>
    <form class="navbar-search" action="javascript:;">
     <div class="rel">
      <span class="search-icon"><i class="ti-search"></i></span>
      <input class="form-control" placeholder="Search here...">
    </div>
  </form>
</li>
</ul>
<!-- END TOP-LEFT TOOLBAR-->
<!-- START TOP-RIGHT TOOLBAR-->
<ul class="nav navbar-toolbar">
 <li class="dropdown dropdown-inbox">
  <a class="nav-link dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope-o"></i>
   <span class="badge badge-primary envelope-badge">9</span>
 </a>
 <ul class="dropdown-menu dropdown-menu-right dropdown-menu-media">
   <li class="dropdown-menu-header">
    <div>
     <span><strong>9 New</strong> Messages</span>
     <a class="pull-right" href="mailbox.html">view all</a>
   </div>
 </li>
 <li class="list-group list-group-divider scroller" data-height="240px" data-color="#71808f">
  <div>
   <a class="list-group-item">
    <div class="media">
     <div class="media-img">
      <img src="{{ url('public/Admin') }}/assets/img/users/u1.jpg" />
    </div>
    <div class="media-body">
      <div class="font-strong"> </div>Jeanne Gonzalez<small class="text-muted float-right">Just now</small>
      <div class="font-13">Your proposal interested me.</div>
    </div>
  </div>
</a>
<a class="list-group-item">
  <div class="media">
   <div class="media-img">
    <img src="{{ url('public/Admin') }}/assets/img/users/u2.jpg" />
  </div>
  <div class="media-body">
    <div class="font-strong"></div>Becky Brooks<small class="text-muted float-right">18 mins</small>
    <div class="font-13">Lorem Ipsum is simply.</div>
  </div>
</div>
</a>
<a class="list-group-item">
  <div class="media">
   <div class="media-img">
    <img src="{{ url('public/Admin') }}/assets/img/users/u3.jpg" />
  </div>
  <div class="media-body">
    <div class="font-strong"></div>Frank Cruz<small class="text-muted float-right">18 mins</small>
    <div class="font-13">Lorem Ipsum is simply.</div>
  </div>
</div>
</a>
<a class="list-group-item">
  <div class="media">
   <div class="media-img">
    <img src="{{ url('public/Admin') }}/assets/img/users/u4.jpg" />
  </div>
  <div class="media-body">
    <div class="font-strong"></div>Rose Pearson<small class="text-muted float-right">3 hrs</small>
    <div class="font-13">Lorem Ipsum is simply.</div>
  </div>
</div>
</a>
</div>
</li>
</ul>
</li>
<li class="dropdown dropdown-notification">
  <a class="nav-link dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell-o rel"><span class="notify-signal"></span></i></a>
  <ul class="dropdown-menu dropdown-menu-right dropdown-menu-media">
   <li class="dropdown-menu-header">
    <div>
     <span><strong>5 New</strong> Notifications</span>
     <a class="pull-right" href="javascript:;">view all</a>
   </div>
 </li>
 <li class="list-group list-group-divider scroller" data-height="240px" data-color="#71808f">
  <div>
   <a class="list-group-item">
    <div class="media">
     <div class="media-img">
      <span class="badge badge-success badge-big"><i class="fa fa-check"></i></span>
    </div>
    <div class="media-body">
      <div class="font-13">4 task compiled</div><small class="text-muted">22 mins</small></div>
    </div>
  </a>
  <a class="list-group-item">
   <div class="media">
    <div class="media-img">
     <span class="badge badge-default badge-big"><i class="fa fa-shopping-basket"></i></span>
   </div>
   <div class="media-body">
     <div class="font-13">You have 12 new orders</div><small class="text-muted">40 mins</small></div>
   </div>
 </a>
 <a class="list-group-item">
  <div class="media">
   <div class="media-img">
    <span class="badge badge-danger badge-big"><i class="fa fa-bolt"></i></span>
  </div>
  <div class="media-body">
    <div class="font-13">Server #7 rebooted</div><small class="text-muted">2 hrs</small></div>
  </div>
</a>
<a class="list-group-item">
 <div class="media">
  <div class="media-img">
   <span class="badge badge-success badge-big"><i class="fa fa-user"></i></span>
 </div>
 <div class="media-body">
   <div class="font-13">New user registered</div><small class="text-muted">2 hrs</small></div>
 </div>
</a>
</div>
</li>
</ul>
</li>
<li class="dropdown dropdown-user">
  <a class="nav-link dropdown-toggle link" data-toggle="dropdown">
   <img src="{{ url('public/Admin') }}/assets/img/admin-avatar.png" />
   <span></span>Admin<i class="fa fa-angle-down m-l-5"></i></a>
   <ul class="dropdown-menu dropdown-menu-right">
    <a class="dropdown-item" href="profile.html"><i class="fa fa-user"></i>Profile</a>
    <a class="dropdown-item" href="profile.html"><i class="fa fa-cog"></i>Settings</a>
    <a class="dropdown-item" href="javascript:;"><i class="fa fa-support"></i>Support</a>
    <li class="dropdown-divider"></li>
    <a class="dropdown-item" href="{{ url("adminlogout") }}"><i class="fa fa-power-off"></i>Logout</a>
  </ul>
</li>
</ul>
<!-- END TOP-RIGHT TOOLBAR-->
</div>
</header>
<!-- END HEADER-->
<!-- START SIDEBAR-->
<nav class="page-sidebar" id="sidebar">
  <div id="sidebar-collapse">
   <div class="admin-block d-flex">
    <div>
     <img src="{{ url('public/Admin') }}/assets/img/admin-avatar.png" width="45px" />
   </div>
   <div class="admin-info">
     <div class="font-strong">{{ Auth('admin')->user()->name }}</div><small>Administrator</small></div>
   </div>
   <ul class="side-menu metismenu">
     <li class="@if(request()->path() === 'AdminDashboard'){{'active'}}@else @endif">
      <a class="active" href="{{ url('/AdminDashboard') }}"><i class="sidebar-item-icon fa fa-tachometer"></i>
       <span class="nav-label">Dashboard</span>
     </a>
   </li>



   <li class="heading">Sales & Purchase </li>


   <li class="@if(request()->path() === 'sales'){{'active'}}@else @endif">
    <a href="{{ url('/sales') }}"><i class="sidebar-item-icon fa fa-balance-scale"></i>
     <span class="nav-label">Sales</span>
   </a>
 </li>


 <li class="@if(request()->path() === 'purchase'){{'active'}}@else @endif">
  <a href="{{ url('/purchase') }}"><i class="sidebar-item-icon fa fa-shopping-bag"></i>
   <span class="nav-label">Purchase</span>
 </a>
</li>


<li class="@if(request()->path() === 'stocks'){{'active'}}@else @endif">
  <a href="{{ url('/stocks') }}"><i class="sidebar-item-icon fa fa-stack-exchange"></i>
   <span class="nav-label">Stocks</span>
 </a>
</li>



<li class="@if(request()->path() === 'allpurchaseledger' || request()->path() === 'allpurchaseledgerreports' || request()->path() === 'purchasepayment' || request()->path() === 'purchasepaymentlist' ){{'active'}}@else @endif">
  <a href="javascript:;"><i class="fa fa-shopping-bag sidebar-item-icon" aria-hidden="true"></i>
   <span class="nav-label">Purchase Information</span><i class="fa fa-angle-left arrow"></i></a>
   <ul class="nav-2-level collapse">
     <li>
       <a href="{{ url('allpurchaseledger') }}"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;Purchase Ledger</a>
     </li>

     <li>
       <a href="{{ url('allpurchaseledgerreports') }}"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;Purchase Ledger Reports</a>
     </li>

     <li>
       <a href="{{ url('purchasepayment') }}"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;Purchase Payment</a>
     </li>

     <li>
       <a href="{{ url('purchasepaymentlist') }}"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;Purchase Payment List</a>
     </li>
   </ul>
 </li>






 <li class="@if(request()->path() === 'allsalesledger' || request()->path() === 'allsalesledgerreports' || request()->path() === 'salespayment' || request()->path() === 'salespaymentlist' ){{'active'}}@else @endif">
  <a href="javascript:;"><i class="fa fa-balance-scale sidebar-item-icon" aria-hidden="true"></i>
   <span class="nav-label">Sales Information</span><i class="fa fa-angle-left arrow"></i></a>
   <ul class="nav-2-level collapse">
     <li>
       <a href="{{ url('allsalesledger') }}"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;Sales Ledger</a>
     </li>

     <li>
       <a href="{{ url('allsalesledgerreports') }}"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;Sales Ledger Reports</a>
     </li>

     <li>
       <a href="{{ url('salespayment') }}"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;Sales Payment</a>
     </li>

     <li>
       <a href="{{ url('salespaymentlist') }}"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;Sales Payment List</a>
     </li>
   </ul>
 </li>







 <li class="heading">FEATURES</li>


 <li class="@if(request()->path() === 'company' || request()->path() === 'branch' ){{'active'}}@else @endif">
  <a href="javascript:;"><i class="fa fa-sliders sidebar-item-icon" aria-hidden="true"></i>
   <span class="nav-label">Software Setting</span><i class="fa fa-angle-left arrow"></i></a>
   <ul class="nav-2-level collapse">
    <li>
     <a href="{{ url('company') }}"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;Company</a>
   </li>
   <li>
     <a href="{{ url('branch') }}"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;Branch</a>
   </li>
 </ul>
</li>




<li class="@if(request()->path() === 'customer' || request()->path() === 'managecustomer' || request()->path() === 'customerduelist' ){{'active'}}@else @endif">
  <a href="javascript:;"><i class="fa fa-user-plus sidebar-item-icon"></i>
   <span class="nav-label">Customer Info.</span><i class="fa fa-angle-left arrow"></i></a>
   <ul class="nav-2-level collapse">
    <li>
     <a href="{{ url('customer') }}"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;Customer</a>
   </li>
   <li>
     <a href="{{ url('managecustomer') }}"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;Manage Customer</a>
   </li>
   <li>
    <a href="{{ url('customerduelist') }}"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;Customer Due List</a>
  </li>
</ul>
</li>




<li class="@if(request()->path() === 'supplier' || request()->path() === 'managesupplier'  || request()->path() === 'supplierduelist' ){{'active'}}@else @endif">
  <a href="javascript:;"><i class="fa fa-user-plus sidebar-item-icon"></i>
   <span class="nav-label">Supplier Info.</span><i class="fa fa-angle-left arrow"></i></a>
   <ul class="nav-2-level collapse">
    <li>
     <a href="{{ url('supplier') }}"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;Supplier</a>
   </li>
   <li>
     <a href="{{ url('managesupplier') }}"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;Manage Supplier</a>
   </li>

   <li>
    <a href="{{ url('supplierduelist') }}"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;Supplier Due List</a>
  </li>
</ul>
</li>



<li class="@if(request()->path() === 'product' || request()->path() === 'manageproduct' ){{'active'}}@else @endif">
  <a href="javascript:;"><i class="fa fa-product-hunt sidebar-item-icon"></i>
   <span class="nav-label">Product Info.</span><i class="fa fa-angle-left arrow"></i></a>
   <ul class="nav-2-level collapse">
    <li>
     <a href="{{ url('product') }}"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;Product</a>
   </li>
   <li>
     <a href="{{ url('manageproduct') }}"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;Manage Product</a>
   </li>
 </ul>
</li>






<li class="@if(request()->path() === 'item' || request()->path() === 'category' || request()->path() === 'subcategory' || request()->path() === 'brand'  || request()->path() === 'measurement' ){{'active'}}@else @endif">
  <a href="javascript:;"><i class="fa fa-cog sidebar-item-icon"></i>
   <span class="nav-label">Product Setting</span><i class="fa fa-angle-left arrow"></i></a>
   <ul class="nav-2-level collapse">
    <li>
     <a href="{{ url('item') }}"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;Item</a>
   </li>
   <li>
     <a href="{{ url('category') }}"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;Category</a>
   </li>

   <li>
     <a href="{{ url('subcategory') }}"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;Subcategory</a>
   </li>

   <li>
     <a href="{{ url('brand') }}"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;Brand</a>
   </li>

   <li>
     <a href="{{ url('measurement') }}"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;Measurement</a>
   </li>
 </ul>
</li>






<li class="@if(request()->path() === 'income_expensetitle'  || request()->path() === 'incomeentry' || request()->path() === 'expenseentry' ){{'active'}}@else @endif">
  <a href="javascript:;"><i class="fa fa-money sidebar-item-icon"></i>
   <span class="nav-label">Income Expense Info.</span><i class="fa fa-angle-left arrow"></i></a>
   <ul class="nav-2-level collapse">
    <li>
     <a href="{{ url('income_expensetitle') }}"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;Income Expense Title</a>
   </li>
   <li>
     <a href="{{ url('incomeentry') }}"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;Income Entry</a>
   </li>

   <li>
     <a href="{{ url('expenseentry') }}"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;Expense Entry</a>
   </li>
 </ul>
</li>




<li class="@if(request()->path() === 'bankinformation'  || request()->path() === 'banktransaction'  || request()->path() === 'managebanktransaction' || request()->path() === 'banktransactionreports' || request()->path() === 'bankstatement' ){{'active'}}@else @endif">
  <a href="javascript:;"><i class="fa fa-university sidebar-item-icon"></i>
   <span class="nav-label">Bank Information</span><i class="fa fa-angle-left arrow"></i></a>
   <ul class="nav-2-level collapse">
    <li>
     <a href="{{ url('bankinformation') }}"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;Add New Bank</a>
   </li>

   <li>
     <a href="{{ url('banktransaction') }}"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;Bank Transaction</a>
   </li>

   <li>
     <a href="{{ url('managebanktransaction') }}"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;Manage Bank Transaction</a>
   </li>

   <li>
    <a href="{{ url('banktransactionreports') }}" target="_blank"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;Bank Transaction Reports</a>
  </li>

  <li>
    <a href="{{ url('bankstatement') }}"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;Bank Statement</a>
  </li>

</ul>
</li>



<li class="@if(request()->path() === 'employee' || request()->path() === 'manageemployee'  || request()->path() === 'employeeduelist'  || request()->path() === 'employeesalarysetup' || request()->path() === 'employeesalary' || request()->path() === 'manageemployeesalary' ){{'active'}}@else @endif">
  <a href="javascript:;"><i class="fa fa-user-plus sidebar-item-icon"></i>
   <span class="nav-label">Employee Info.</span><i class="fa fa-angle-left arrow"></i></a>
   <ul class="nav-2-level collapse">
    <li>
     <a href="{{ url('employee') }}"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;Employee</a>
   </li>
   <li>
     <a href="{{ url('manageemployee') }}"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;Manage Employee</a>
   </li>

   <li>
     <a href="{{ url('employeesalarysetup') }}"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;Employee Salary Setup</a>
   </li>

   <li>
    <a href="{{ url('employeesalary') }}"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;Employee Salary</a>
   </li>

   <li>
    <a href="{{ url('manageemployeesalary') }}"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;Manage Employee Salary</a>
   </li>


 </ul>
</li>







































            {{-- 
            <li>
             <a href="javascript:;"><i class="sidebar-item-icon fa fa-edit"></i>
              <span class="nav-label">Forms</span><i class="fa fa-angle-left arrow"></i></a>
              <ul class="nav-2-level collapse">
               <li>
                <a href="form_basic.html">Basic Forms</a>
               </li>
               <li>
                <a href="form_advanced.html">Advanced Plugins</a>
               </li>
               <li>
                <a href="form_masks.html">Form input masks</a>
               </li>
               <li>
                <a href="form_validation.html">Form Validation</a>
               </li>
               <li>
                <a href="text_editors.html">Text Editors</a>
               </li>
              </ul>
             </li>
             <li>
              <a href="javascript:;"><i class="sidebar-item-icon fa fa-table"></i>
               <span class="nav-label">Tables</span><i class="fa fa-angle-left arrow"></i></a>
               <ul class="nav-2-level collapse">
                <li>
                 <a href="table_basic.html">Basic Tables</a>
                </li>
                <li>
                 <a href="datatables.html">Datatables</a>
                </li>
               </ul>
              </li>
              <li>
               <a href="javascript:;"><i class="sidebar-item-icon fa fa-bar-chart"></i>
                <span class="nav-label">Charts</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                 <li>
                  <a href="charts_flot.html">Flot Charts</a>
                 </li>
                 <li>
                  <a href="charts_morris.html">Morris Charts</a>
                 </li>
                 <li>
                  <a href="chartjs.html">Chart.js</a>
                 </li>
                 <li>
                  <a href="charts_sparkline.html">Sparkline Charts</a>
                 </li>
                </ul>
               </li>
               <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-map"></i>
                 <span class="nav-label">Maps</span><i class="fa fa-angle-left arrow"></i></a>
                 <ul class="nav-2-level collapse">
                  <li>
                   <a href="maps_vector.html">Vector maps</a>
                  </li>
                 </ul>
                </li>
                <li>
                 <a href="icons.html"><i class="sidebar-item-icon fa fa-smile-o"></i>
                  <span class="nav-label">Icons</span>
                 </a>
                </li>
                <li class="heading">PAGES</li>
                <li>
                 <a href="javascript:;"><i class="sidebar-item-icon fa fa-envelope"></i>
                  <span class="nav-label">Mailbox</span><i class="fa fa-angle-left arrow"></i></a>
                  <ul class="nav-2-level collapse">
                   <li>
                    <a href="mailbox.html">Inbox</a>
                   </li>
                   <li>
                    <a href="mail_view.html">Mail view</a>
                   </li>
                   <li>
                    <a href="mail_compose.html">Compose mail</a>
                   </li>
                  </ul>
                 </li>
                 <li>
                  <a href="calendar.html"><i class="sidebar-item-icon fa fa-calendar"></i>
                   <span class="nav-label">Calendar</span>
                  </a>
                 </li>

                 
                 <li>
                  <a href="javascript:;"><i class="sidebar-item-icon fa fa-file-text"></i>
                   <span class="nav-label">Pages</span><i class="fa fa-angle-left arrow"></i></a>
                   <ul class="nav-2-level collapse">
                    <li>
                     <a href="invoice.html">Invoice</a>
                    </li>
                    <li>
                     <a href="profile.html">Profile</a>
                    </li>
                    <li>
                     <a href="login.html">Login</a>
                    </li>
                    <li>
                     <a href="register.html">Register</a>
                    </li>
                    <li>
                     <a href="lockscreen.html">Lockscreen</a>
                    </li>
                    <li>
                     <a href="forgot_password.html">Forgot password</a>
                    </li>
                    <li>
                     <a href="error_404.html">404 error</a>
                    </li>
                    <li>
                     <a href="error_500.html">500 error</a>
                    </li>
                   </ul>
                  </li>
                  <li>
                   <a href="javascript:;"><i class="sidebar-item-icon fa fa-sitemap"></i>
                    <span class="nav-label">Menu Levels</span><i class="fa fa-angle-left arrow"></i></a>
                    <ul class="nav-2-level collapse">
                     <li>
                      <a href="javascript:;">Level 2</a>
                     </li>
                     <li>
                      <a href="javascript:;">
                       <span class="nav-label">Level 2</span><i class="fa fa-angle-left arrow"></i></a>
                       <ul class="nav-3-level collapse">
                        <li>
                         <a href="javascript:;">Level 3</a>
                        </li>
                        <li>
                         <a href="javascript:;">Level 3</a>
                        </li>
                       </ul>
                      </li>
                     </ul>
                   </li> --}}
                 </ul>
               </div>
             </nav>
             <!-- END SIDEBAR-->

             @yield('content')

           </div>


           <script>
            $('#datepicker').datepicker({
              uiLibrary: 'bootstrap4'
            });
            $('#fromdate').datepicker({
              uiLibrary: 'bootstrap4'
            });
            $('#todate').datepicker({
              uiLibrary: 'bootstrap4'
            });

            $('#payment_date').datepicker({
              uiLibrary: 'bootstrap4'
            });

            $('#payment_date2').datepicker({
              uiLibrary: 'bootstrap4'
            });


          </script>





          <script src="{{ url('public/Admin') }}/assets/vendors/jquery/dist/jquery.min.js" type="text/javascript"></script>
          <script src="{{ url('public/Admin') }}/assets/vendors/popper.js/dist/umd/popper.min.js" type="text/javascript"></script>
          <script src="{{ url('public/Admin') }}/assets/vendors/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
          <script src="{{ url('public/Admin') }}/assets/vendors/metisMenu/dist/metisMenu.min.js" type="text/javascript"></script>
          <script src="{{ url('public/Admin') }}/assets/vendors/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
          <!-- PAGE LEVEL PLUGINS-->
          <script src="{{ url('public/Admin') }}/assets/vendors/chart.js/dist/Chart.min.js" type="text/javascript"></script>
          <script src="{{ url('public/Admin') }}/assets/vendors/jvectormap/jquery-jvectormap-2.0.3.min.js" type="text/javascript"></script>
          <script src="{{ url('public/Admin') }}/assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
          <script src="{{ url('public/Admin') }}/assets/vendors/jvectormap/jquery-jvectormap-us-aea-en.js" type="text/javascript"></script>
          <!-- CORE SCRIPTS-->
          <script src="{{ url('public/Admin') }}/assets/js/app.min.js" type="text/javascript"></script>
          <!-- PAGE LEVEL SCRIPTS-->
          <script src="{{ url('public/Admin') }}/assets/js/scripts/dashboard_1_demo.js" type="text/javascript"></script>

          <script src="{{ url('public/Admin') }}/assets/vendors/DataTables/datatables.min.js" type="text/javascript"></script>

          <script src="{{ url('public/Admin') }}/assets/vendors/select2/dist/js/select2.full.min.js" type="text/javascript"></script>

          <script type="text/javascript">
            $(function() {
              $('#example-table').DataTable({
                pageLength: 25,

              });
            })
          </script>




          <script type="text/javascript" src="{{ url('public/Admin') }}/assets/js/toastr.min.js"></script>
          <script type="text/javascript" src="{{ url('public/Admin') }}/assets/css/toastr.min.css"></script>

          <script src="{{ url('public/Admin') }}/assets/vendors/summernote/dist/summernote.min.js" type="text/javascript"></script>



          <script type="text/javascript">
            $(document).ready(function () {
              $("select").select2();
            });
          </script>


          <script src="{{ url('public/Admin') }}/assets/js/sweetalert.min.js"></script>

        </body>
        </html>
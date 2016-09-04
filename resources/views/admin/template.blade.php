<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
  <meta charset="utf-8" />
  <title>Paw Family - Admin</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1" name="viewport" />
  <meta content="" name="description" />
  <meta content="" name="author" />
  <!-- BEGIN GLOBAL MANDATORY STYLES -->
  <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
  <link href="{{url("assets/metronic/global/plugins/font-awesome/css/font-awesome.min.css")}}" rel="stylesheet" type="text/css" />
  <link href="{{url("assets/metronic/global/plugins/simple-line-icons/simple-line-icons.min.css")}}" rel="stylesheet" type="text/css" />
  <link href="{{url("assets/metronic/global/plugins/bootstrap/css/bootstrap.min.css")}}" rel="stylesheet" type="text/css" />
  <link href="{{url("assets/metronic/global/plugins/uniform/css/uniform.default.css")}}" rel="stylesheet" type="text/css" />
  <link href="{{url("assets/metronic/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css")}}" rel="stylesheet" type="text/css" />
  <!-- END GLOBAL MANDATORY STYLES -->

  <!-- BEGIN PAGE LEVEL PLUGINS -->
  <link href="{{url("assets/metronic/global/plugins/bootstrap-toastr/toastr.min.css")}}" rel="stylesheet" type="text/css" />
  <link href="{{url("assets/metronic/global/plugins/bootstrap-editable/bootstrap-editable/css/bootstrap-editable.css")}}" rel="stylesheet" type="text/css" />
  <link href="{{url("assets/metronic/global/plugins/select2/css/select2.min.css")}}" rel="stylesheet" type="text/css" />
  <link href="{{url("assets/metronic/global/plugins/select2/css/select2-bootstrap.min.css")}}" rel="stylesheet" type="text/css" />
  <link href="{{url("assets/metronic/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css")}}" rel="stylesheet" type="text/css" />
  <link href="{{url("assets/metronic/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css")}}" rel="stylesheet" type="text/css" />
  <!-- END PAGE LEVEL PLUGINS -->

  <!-- BEGIN THEME GLOBAL STYLES -->
  <link href="{{url("assets/metronic/global/css/components.min.css")}}" rel="stylesheet" id="style_components" type="text/css" />
  <link href="{{url("assets/metronic/global/css/plugins.min.css")}}" rel="stylesheet" type="text/css" />
  <!-- END THEME GLOBAL STYLES -->
  <!-- BEGIN THEME LAYOUT STYLES -->
  <link href="{{url("assets/metronic/layouts/layout2/css/layout.min.css")}}" rel="stylesheet" type="text/css" />
  <link href="{{url("assets/metronic/layouts/layout2/css/themes/blue.min.css")}}" rel="stylesheet" type="text/css" id="style_color" />
  <link href="{{url("assets/metronic/custom.css")}}" rel="stylesheet" type="text/css" id="style_color" />

  <!-- END THEME LAYOUT STYLES -->
  {{--<link rel="shortcut icon" href="favicon.ico" />--}}
  @section("css")

  @endsection
</head>
<!-- END HEAD -->

<body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid">
<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
  <!-- BEGIN HEADER INNER -->
  <div class="page-header-inner ">
    <!-- BEGIN LOGO -->
    <div class="page-logo">
      <a href="index.html">
        <img src="{{ url("assets/metronic/layouts/layout2/img/logo-default.png") }}" alt="logo" class="logo-default" /> </a>
      <div class="menu-toggler sidebar-toggler">
        <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
      </div>
    </div>
    <!-- END LOGO -->
    <!-- BEGIN RESPONSIVE MENU TOGGLER -->
    <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
    <!-- END RESPONSIVE MENU TOGGLER -->
    <!-- BEGIN PAGE TOP -->
    <div class="page-top">
      <!-- BEGIN HEADER SEARCH BOX -->
      <!-- DOC: Apply "search-form-expanded" right after the "search-form" class to have half expanded search box -->
      <form class="search-form search-form-expanded" action="page_general_search_3.html" method="GET">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Search..." name="query">
                            <span class="input-group-btn">
                                <a href="javascript:;" class="btn submit">
                                  <i class="icon-magnifier"></i>
                                </a>
                            </span>
        </div>
      </form>
      <!-- END HEADER SEARCH BOX -->
      <!-- BEGIN TOP NAVIGATION MENU -->
      <div class="top-menu">
        <ul class="nav navbar-nav pull-right">
          <!-- BEGIN USER LOGIN DROPDOWN -->
          <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
          <li class="dropdown dropdown-user">
            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
              <img alt="" class="img-circle" src="{{ url("assets/metronic/layouts/layout2/img/avatar3_small.jpg")}}" />
              <span class="username username-hide-on-mobile"> Nick </span>
              <i class="fa fa-angle-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-default">
              <li>
                <a href="{{ url("admin/logout") }}">
                  <i class="icon-key"></i> Log Out </a>
              </li>
            </ul>
          </li>
          <!-- END USER LOGIN DROPDOWN -->
        </ul>
      </div>
      <!-- END TOP NAVIGATION MENU -->
    </div>
    <!-- END PAGE TOP -->
  </div>
  <!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<!-- BEGIN HEADER & CONTENT DIVIDER -->
<div class="clearfix"> </div>
<!-- END HEADER & CONTENT DIVIDER -->
<!-- BEGIN CONTAINER -->
<div class="page-container">
  <!-- BEGIN SIDEBAR -->
  <div class="page-sidebar-wrapper">
    <!-- END SIDEBAR -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse">
      <!-- BEGIN SIDEBAR MENU -->
      <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
      <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
      <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
      <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
      <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
      <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
      <ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-hover-submenu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
        <li class="nav-item start ">
          <a href="#" class="nav-link nav-toggle">
            <i class="icon-home"></i>
            <span class="title">Dashboard</span>
            <span class="arrow"></span>
          </a>
        </li>
        <li class="nav-item  ">
          <a href="{{url("admin/sale")}}" class="nav-link nav-toggle">
            <i class="icon-basket"></i>
            <span class="title">Orders</span>
            <span class="arrow"></span>
          </a>
        </li>
        <li class="nav-item start ">
          <a href="{{url("admin/customer")}}" class="nav-link nav-toggle">
            <i class="icon-users"></i>
            <span class="title">Customers</span>
            <span class="arrow"></span>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{url("admin/product")}}" class="nav-link nav-toggle">
            <i class="icon-disc"></i>
            <span class="title">Products</span>
            <span class="arrow"></span>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link nav-toggle">
            <i class="icon-bar-chart"></i>
            <span class="title">Reports</span>
            <span class="arrow"></span>
          </a>
          <ul class="sub-menu">
            <li class="nav-item ">
              <a href="{{url("admin/report/sales")}}" class="nav-link "> Daily Sales </a>
            </li>
            <li class="nav-item ">
              <a href="{{url("admin/report/profit")}}" class="nav-link "> Profit </a>
            </li>
            <li class="nav-item ">
              <a href="{{url("admin/report/product-views")}}" class="nav-link "> Product Views </a>
            </li>
            <li class="nav-item ">
              <a href="{{url("admin/report/most-searched")}}" class="nav-link "> Most Searched </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="{{url('admin/banner')}}" class="nav-link nav-toggle">
            <i class="icon-frame"></i>
            <span class="title">Banners</span>
            <span class="arrow"></span>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{url('admin/featured')}}" class="nav-link nav-toggle">
            <i class="icon-bulb"></i>
            <span class="title">Featured</span>
            <span class="arrow"></span>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{url('admin/brand')}}" class="nav-link nav-toggle">
            <i class="icon-star"></i>
            <span class="title">Brands</span>
            <span class="arrow"></span>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{url('admin/category')}}" class="nav-link nav-toggle">
            <i class="icon-grid"></i>
            <span class="title">Categories</span>
            <span class="arrow"></span>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{url('admin/supplier')}}" class="nav-link nav-toggle">
            <i class="icon-paper-plane"></i>
            <span class="title">Suppliers</span>
            <span class="arrow"></span>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{url('admin/setting')}}" class="nav-link nav-toggle">
            <i class="icon-settings"></i>
            <span class="title">Settings</span>
            <span class="arrow"></span>
          </a>
          <ul class="sub-menu">
            <li class="nav-item ">
              <a href="{{url("admin/delivery")}}" class="nav-link "> Delivery Dates </a>
            </li>
            <li class="nav-item ">
              <a href="{{url("admin/district-postal")}}" class="nav-link "> Districts and Postals </a>
            </li>
            <li class="nav-item ">
              <a href="{{url("admin/config")}}" class="nav-link "> Config </a>
            </li>
          </ul>
        </li>
      </ul>
      <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
  </div>
  <!-- END SIDEBAR -->
  <!-- BEGIN CONTENT -->

  <div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <!-- <div class="page-content" ng-app="myApp" ng-controller="myController"> -->
    <div class="page-content">
      <div class="row">
        <div class="col-md-12">

          <!--<h3 class="page-title"> Blank Page Layout</h3>-->
          <form method="post" action="" class="form-horizontal" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <div class="portlet light">
              @if(isset($title) && $title)
                <div class="portlet-title">
                  <div class='row'>
                    <div class='col-xs-6'>
                      <h3 class="page-title">{{ $title }}</h3>
                    </div>
                    <div class='col-xs-6 text-right'>
                      @if($action == "create" || $action == "update")
                        <button class="btn green-haze" type="submit"><i class="fa fa-check"></i> Save</button>
                        @if(isset($hide_delete) && $hide_delete == true)

                        @elseif($action == "update")
                          <input type="hidden" name="delete" id="delete">
                          <button id="btn-delete" type="button" class="btn red-sunglo" data-placement="bottom" data-singleton='true' data-toggle='confirmation' data-original-title='Are you sure?'><i class="fa fa-times"></i> Delete</button>
                        @endif
                      @elseif($action == "index")
                        <a href="{{url("admin/".$controller."/save")}}"><button type="button" class="btn blue">Create</button></a>
                      @endif
                      <button type="button" name="back" class="btn btn-default" onclick="history.go(-1)"><i class="fa fa-angle-left"></i> Back</button>
                    </div>
                  </div>

                  @if(Session::has('msg'))
                    <div class="alert alert-success ">
                      {{ Session::get('msg') }}
                    </div>
                  @endif

                  @if ($errors->has())
                    <div class="alert alert-danger">
                      @foreach ($errors->all() as $error)
                        {{ $error }}<br>
                      @endforeach
                    </div>
                  @endif
                </div>
              @endif
              <div class="portlet-body">
                @yield("content")
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- END CONTENT BODY -->
  </div>
  <!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<!--<div class="page-footer">
  <div class="page-footer-inner"> 2015 &copy; Metronic by keenthemes.
    <a href="http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes" title="Purchase Metronic just for 27$ and get lifetime updates for free" target="_blank">Purchase Metronic!</a>
  </div>
  <div class="scroll-to-top">
    <i class="icon-arrow-up"></i>
  </div>
</div>-->
<!-- END FOOTER -->
<!--[if lt IE 9]>
<script src="../assets/global/plugins/respond.min.js"></script>
<script src="../assets/global/plugins/excanvas.min.js"></script>
<![endif]-->
<!-- BEGIN CORE PLUGINS -->
<script src="{{url("assets/metronic/global/plugins/jquery.min.js")}}" type="text/javascript"></script>
<script src="{{url("assets/metronic/global/plugins/bootstrap/js/bootstrap.min.js")}}" type="text/javascript"></script>
<script src="{{url("assets/metronic/global/plugins/js.cookie.min.js")}}" type="text/javascript"></script>
<script src="{{url("assets/metronic/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js")}}" type="text/javascript"></script>
<script src="{{url("assets/metronic/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js")}}" type="text/javascript"></script>
<script src="{{url("assets/metronic/global/plugins/jquery.blockui.min.js")}}" type="text/javascript"></script>
<script src="{{url("assets/metronic/global/plugins/uniform/jquery.uniform.min.js")}}" type="text/javascript"></script>
<script src="{{url("assets/metronic/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js")}}" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
{#<script src="{{url("assets/metronic/global/plugins/select2/js/select2.full.min.js")}}" type="text/javascript"></script>
<script src="{{url("assets/metronic/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js")}}" type="text/javascript"></script>
<script src="{{url("assets/metronic/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js")}}" type="text/javascript"></script>
<script src="{{url("assets/metronic/global/plugins/moment.min.js")}}" type="text/javascript"></script>
<script src="{{url("assets/metronic/global/plugins/bootstrap-typeahead/bootstrap3-typeahead.min.js")}}" type="text/javascript"></script>#}

<script src="{{url("assets/metronic/global/plugins/bootstrap-toastr/toastr.min.js")}}" type="text/javascript"></script>
<script src="{{url("assets/metronic/global/plugins/bootstrap-editable/bootstrap-editable/js/bootstrap-editable.js")}}" type="text/javascript"></script>
<script src="{{url("assets/metronic/global/plugins/bootstrap-confirmation/bootstrap-confirmation.min.js")}}" type="text/javascript"></script>

<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="{{url("assets/metronic/global/scripts/app.js")}}" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<!-- END PAGE LEVEL SCRIPTS -->

<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="{{url("assets/metronic/layouts/layout2/scripts/layout.min.js")}}" type="text/javascript"></script>
<script src="{{url("assets/metronic/layouts/layout2/scripts/demo.min.js")}}" type="text/javascript"></script>
<script src="{{url("assets/metronic/layouts/global/scripts/quick-sidebar.min.js")}}" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->

<script src="{{url("assets/metronic/custom.js")}}" type="text/javascript"></script>

<script type="text/javascript">
  toastr.options.positionClass = "toast-top-center";
  $.fn.editable.defaults.inputclass = 'form-control';

  $(document).ready(function() {
    $('#btn-delete').on('confirmed.bs.confirmation', function () {
      $("#delete").val("true");
      $("form").submit();
    });
  });
</script>

@section("script")

@show
</body>
</html>
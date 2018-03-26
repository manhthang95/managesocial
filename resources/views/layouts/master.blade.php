<!DOCTYPE html>
<html lang="en">
  
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <link rel="shortcut icon" href="/img/favicon.html">

    <title>Social Tool</title>

    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen"/>
    <link rel="stylesheet" href="/css/owl.carousel.css" type="text/css">
<link rel="stylesheet" type="text/css" href="/assets/bootstrap-datepicker/css/datepicker.css" />
    <link rel="stylesheet" type="text/css" href="/assets/bootstrap-timepicker/compiled/timepicker.css" />
    <!--right slidebar-->
    <link href="/css/slidebars.css" rel="stylesheet">

    <!-- Custom styles for this template -->

    <link href="/css/style.css" rel="stylesheet">
    <link href="/css/style-responsive.css" rel="stylesheet" />
    @yield('css_top')
    @yield('script_top')



    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
      <script src="/js/html5shiv.js"></script>
      <script src="/js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

  <section id="container" >
        <?php
            $menu = $data['Menu'];
            $sub = (isset($data['Sub'])) ? $data['Sub'] : "";
        ?>
      <!--header start-->
      <header class="header white-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
            <a href="/welcome.html" class="logo">Flat<span>lab</span></a>
            <!--logo end-->
            <div class="top-nav ">
                <!--user info start-->
                <ul class="nav pull-right top-menu">
                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <img alt="" src="img/avatar1_small.jpg">
                            <span class="username">{{ Auth::User()->name }}</span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <div class="log-arrow-up"></div>
                            <li><a></a></li>
                            <li><a href="/my-profile.html"><i class="fa fa-suitcase"></i>Profile</a></li>
                            <li><a href="/logout-action.html"><i class="fa fa-key"></i> Log Out</a></li>
                        </ul>
                    </li>
                    <!-- user login dropdown end -->
                </ul>
                <!--search & user info end-->
            </div>
        </header>
      <!--header end-->
      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
                  <li>
                      <a href="/welcome.html" id="mn-dashboard">
                          <i class="fa fa-dashboard"></i>
                          <span>Dashboard</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a href="javascript:;" id="mn-system">
                          <i class="fa fa-laptop"></i>
                          <span>Admin</span>
                      </a>
                      <ul class="sub mn-system">
                          <li id="sub-list-users"><a  href="/manage-user.html">Danh Sách User</a></li>
                          <li id="sub-list-user-logs"><a  href="/manage-user-logs.html">Log User</a></li>
                      </ul>
                  </li>

                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-book"></i>
                          <span>Facebook</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="general.html">General</a></li>
                          <li><a  href="buttons.html">Buttons</a></li>
                          <li><a  href="modal.html">Modal</a></li>
                          <li><a  href="toastr.html">Toastr Notifications</a></li>
                          <li><a  href="widget.html">Widget</a></li>
                          <li><a  href="slider.html">Slider</a></li>
                          <li><a  href="nestable.html">Nestable</a></li>
                          <li><a  href="font_awesome.html">Font Awesome</a></li>
                      </ul>
                  </li>
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
                @yield('content')
          </section>
      </section>
      <!--main content end-->

  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="/js/jquery.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="/js/jquery.scrollTo.min.js"></script>
    <script src="/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="/js/jquery.sparkline.js" type="text/javascript"></script>
    <script src="assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
    <script src="/js/owl.carousel.js" ></script>
    <script src="/js/jquery.customSelect.min.js" ></script>
    <script src="/js/respond.min.js" ></script>

    <!--right slidebar-->
    <script src="/js/slidebars.min.js"></script>

    <!--common script for all pages-->
    <script src="/js/common-scripts.js"></script>

    <!--script for this page-->
    <script src="/js/sparkline-chart.js"></script>
    <script src="/js/easy-pie-chart.js"></script>
    <script src="/js/count.js"></script>
    @yield('script_bottom')

  <script>

    var menu = '<?= $menu; ?>';
    var sub = '<?= $sub; ?>';
    if (sub) {
        $("#" + sub).addClass("active");
    }
    if (menu) {
        $("#" + menu).addClass("active");
    } else {
        $("#mn-dashboard").addClass("active");
    }

      //owl carousel

      $(document).ready(function() {
          $("#owl-demo").owlCarousel({
              navigation : true,
              slideSpeed : 300,
              paginationSpeed : 400,
              singleItem : true,
			  autoPlay:true

          });
      });

      //custom select box

      $(function(){
          $('select.styled').customSelect();
      });

  </script>

  </body>

</html>

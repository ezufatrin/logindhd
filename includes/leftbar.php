	<!-- <nav class="ts-sidebar">
			<ul class="ts-sidebar-menu">
			
			<li class="ts-label">Main</li>
			<li><a href="profile.php"><i class="fa fa-user"></i> &nbsp;Profile</a>
			</li>
			<li><a href="feedback.php"><i class="fa fa-envelope"></i> &nbsp;Feedback</a>
			</li>
			<li><a href="notification.php"><i class="fa fa-bell"></i> &nbsp;Notification<sup style="color:red">*</sup></a>
			</li>
			<li><a href="messages.php"><i class="fa fa-envelope"></i> &nbsp;Messages</a>
			</li>
			</ul>
			<p class="text-center" style="color:#ffffff; margin-top: 100px;">© Ajay</p>
		</nav>
		 -->


		 
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="profile.php" class="brand-link bg-info">
        <img src="login/images/logo-dhd.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
          style="opacity: .8">
        <span class="brand-text font-weight-light">Mitra DHD Farm</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <!-- <div class="image">
			<img src="images/<?php echo htmlentities($result->image);?>" class="img-circle elevation-2" alt="User Image">
			
          </div> -->
          <div class="info">
			<!-- <a href="#" class="d-block">Ezu</a> -->
			
			<div class="panel-heading text-white"><?php echo htmlentities($_SESSION['alogin']); ?></div>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item has-treeview ">
              <a id = "menu-profile" href="profile.php" class="nav-link" onclick="tambahaktiv()">
                <i class="nav-icon fas fa-user"></i>
                <p>Profile</p>
              </a>
			      </li>		
            <li class="nav-item has-treeview ">
                <a href="feedback.php" class="nav-link">
                  <i class="nav-icon fa fa-envelope"></i>
                  <p>Feedback</p>
                </a>
            </li>
            <li class="nav-item has-treeview ">
                <a href="notification.php" class="nav-link">
                  <i class="nav-icon fa fa-bell"></i>
                  <p>Pemberitahuan</p>
                </a>
            </li>
            <li class="nav-item has-treeview ">
                <a href="messages.php" class="nav-link">
                  <i class="nav-icon fa fa-envelope"></i>
                  <p>Pesan</p>
                </a>
            </li>
          </ul>
        </nav>
		<!-- /.sidebar-menu -->
	
		</div>
      <!-- /.sidebar -->
    </aside>	

		
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.world.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<script>
function tambahaktiv() {
			var elem = document.getElementById('menu-profile');
			elem.addclass="active";
			}
</script>

<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{Auth::user()->photo}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          @if(Auth::user()->isAdmin())
          <p>{{Auth::user()->fullname()}}</p>
          @else
          <p>{{Auth::user()->company->name}}</p>
          @endif
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li {!! set_active('admin/dashboard', 'treeview') !!}>
          <a href="{{URL::route('admin::dashboard')}}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span> 
          </a>
        </li>
        <li {!! set_active(['admin/tickets', 'admin/tickets/*', 'admin/rents'], 'treeview') !!}>
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Reports</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('admin::tickets.bookings')}}"><i class="fa fa-circle-o"></i> Tickets Bookings Report</a></li>
            <li><a href="{{route('admin::tickets.sales')}}"><i class="fa fa-circle-o"></i> Tickets Sales Report</a></li>
            <li><a href="{{route('admin::rents.bookings')}}"><i class="fa fa-circle-o"></i> Rent Report</a></li>
           <!--  <li><a href="pages/layout/boxed.html"><i class="fa fa-circle-o"></i> Tours Report</a></li>
            <li><a href="pages/layout/collapsed-sidebar.html"><i class="fa fa-circle-o"></i> Customer Reviews</a></li> -->
          </ul>
        </li>
        <li {!! set_active(['admin/buses', 'admin/buses/*', 'admin/stations/*', 'admin/stations', 'admin/trips/*', 'admin/trips', 'admin/rentals', 'admin/rentals/*'], 'treeview') !!}>
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Manage Products</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            @if(Auth::user()->isAdmin())<li><a href="{{URL::route('admin::admin.companies.index')}}"><i class="fa fa-circle-o"></i> Company</a></li>@endif
            <li><a href="{{route('admin::admin.buses.index')}}"><i class="fa fa-circle-o"></i> Bus</a></li>
            <li><a href="{{route('admin::admin.stations.index')}}"><i class="fa fa-circle-o"></i> Station</a></li>
            <li><a href="{{route('admin::admin.trips.index')}}"><i class="fa fa-circle-o"></i> Trip</a></li>
            <li><a href="{{route('admin::admin.rentals.index')}}"><i class="fa fa-circle-o"></i> Rental</a></li>
            <!-- <li><a href=""><i class="fa fa-circle-o"></i> Tour</a></li> -->
          </ul>
        </li>
        @can('admin')
        <li {!! set_active(['settings/profile', 'settings/template', 'settings/format', 'settings/policy'], 'treeview') !!}>
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>Settings</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('admin::settings.policy')}}"><i class="fa fa-circle-o"></i> Site Policy</a></li>
            <li><a href="{{route('admin::settings.site')}}"><i class="fa fa-circle-o"></i> Site Settings</a></li>
            <li><a href="{{route('admin::settings.site.payment')}}"><i class="fa fa-circle-o"></i> Site Payments</a></li>
          </ul>
        </li>
        @else
         <li {!! set_active(['settings/profile', 'settings/template', 'settings/format', 'settings/policy'], 'treeview') !!}>
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>Settings</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('admin::settings.profile')}}"><i class="fa fa-circle-o"></i> Company Info</a></li>
            <li><a href="{{route('admin::settings.template')}}"><i class="fa fa-circle-o"></i> Confirmation Template</a></li>
            <li><a href="{{route('admin::settings.format')}}"><i class="fa fa-circle-o"></i> E-ticket Format</a></li>
            <li><a href="{{route('admin::settings.policy')}}"><i class="fa fa-circle-o"></i> My Policy</a></li>
          </ul>
        </li>
        @endcan
        <!-- <li {!! set_active('', 'treeview') !!}>
          <a href="#">
            <i class="fa fa-edit"></i> <span>My Programs</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="pages/forms/general.html"><i class="fa fa-circle-o"></i> My Prize</a></li>
            <li><a href="pages/forms/advanced.html"><i class="fa fa-circle-o"></i> My Gifts</a></li>
          </ul>
        </li>
        <li {!! set_active('', 'treeview') !!}>
          <a href="#">
            <i class="fa fa-table"></i> <span>Manage Users</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="pages/tables/simple.html"><i class="fa fa-circle-o"></i> Add User</a></li>
            <li><a href="pages/tables/data.html"><i class="fa fa-circle-o"></i> Manage Users</a></li>
          </ul>
        </li> -->
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript::;">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript::;">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript::;">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript::;">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript::;">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript::;">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript::;">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript::;">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->

      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript::;" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
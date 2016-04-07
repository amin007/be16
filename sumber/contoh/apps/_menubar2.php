  <!-- fixed top navbar -->
  <div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>

      <button type="button" class="btn btn-default btn-back navbar-left pull-left hidden" onclick="history.back()">
        <i class="fa fa-lg fa-chevron-left"></i><span>Back</span>
      </button>
      <!-- menu button to show/ hide the off canvas slider -->
      <button type="button" class="btn btn-default btn-menu navbar-left pull-left offCanvasToggle" data-toggle="offcanvas">
        <i class="fa fa-lg fa-bars"></i><span>Menu</span>
      </button>  

      <a class="navbar-brand no-break-out" title="Customers" href="/">BE16</a>  
      
      <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
          <li class="active">
            <a href="./index.php" data-pjax="#main" data-title="Customers"
              <i class="fa fa-dashboard"></i>
              Dashboard
            </a>          
          </li>
          <li>
            <a href="./company.php" data-pjax="#main" data-title="Companies"
              <i class="fa fa-building-o"></i>
              Companies
            </a>          
          </li>
          <li>
            <a href="./contacts.php" data-pjax="#main" data-title="Contacts"
              <i class="fa fa-users"></i>
              Contacts
            </a>          
          </li>
          <li>
            <a href="./notes.php" data-pjax="#main" data-title="Notes"
              <i class="fa fa-clipboard"></i>
              Notes
            </a>          
          </li>
          <li>
            <a href="./charts.php" data-pjax="#main" data-title="Charts"
              <i class="fa fa-bar-chart-o"></i>
              Charts
            </a>          
          </li>
          <li>
            <a href="./settings.php" data-pjax="#main" data-title="Settings"
              <i class="fa fa-gears"></i>
              Settings
            </a>          
          </li>
        </ul>
      </div>          
    </div>
  </div>   

  <!-- slide in menu (mobile only) -->
  <nav id="offCanvasMenu" class="navmenu offcanvas offcanvas-left">
    <ul class="nav">
      <li class="active">
        <a href="./index.php" data-pjax="#main" data-title="Customers">
          <i class="fa fa-lg fa-dashboard"></i>
          Dashboard
        </a>          
      </li>
      <li>
        <a href="./company.php" data-pjax="#main" data-title="Companies">
          <i class="fa fa-lg fa-building-o"></i>
          Companies
        </a>          
      </li>
      <li>
        <a href="./contacts.php" data-pjax="#main" data-title="Contacts">
          <i class="fa fa-lg fa-users"></i>
          Contacts
        </a>          
      </li>
      <li>
        <a href="./notes.php" data-pjax="#main" data-title="Notes">
          <i class="fa fa-lg fa-clipboard"></i>
          Notes
        </a>          
      </li>
      <li>
        <a href="./charts.php" data-pjax="#main" data-title="Charts">
          <i class="fa fa-lg fa-bar-chart-o"></i>
          Charts
        </a>          
      </li>
      <li>
        <a href="./settings.php" data-pjax="#main" data-title="Settings">
          <i class="fa fa-lg fa-gears"></i>
          Settings
        </a>          
      </li>
    </ul>

    <div style="margin-top:20px; padding-left: 20px; font-size: 12px; color: #777">v1.1.2</div>
  </nav>

  <?php
  /*
  
  	<!-- fixed tabbed footer -->
	<div class="navbar navbar-default navbar-fixed-bottom">
		<div class="container">
			<div class="bootcards-desktop-footer clearfix">
				<p class="pull-left">Bootcards v1.1.2</p>
			</div>
			<div class="btn-group">
				<a href="./index.php" class="btn btn-default active" data-pjax="#main" data-title="Customers">
					<i class="fa fa-2x fa-dashboard"></i>
					Dashboard
				</a>          
				<a href="./company.php" class="btn btn-default" data-pjax="#main" data-title="Companies">
					<i class="fa fa-2x fa-building-o"></i>
					Companies
				</a>          
				<a href="./contacts.php" class="btn btn-default" data-pjax="#main" data-title="Contacts">
					<i class="fa fa-2x fa-users"></i>
					Contacts
				</a>          
				<a href="./notes.php" class="btn btn-default" data-pjax="#main" data-title="Notes">
					<i class="fa fa-2x fa-clipboard"></i>
					Notes
				</a>          
				<a href="./charts.php" class="btn btn-default" data-pjax="#main" data-title="Charts">
					<i class="fa fa-2x fa-bar-chart-o"></i>
					Charts
				</a>          
				<a href="./settings.php" class="btn btn-default" data-pjax="#main" data-title="Settings">
					<i class="fa fa-2x fa-gears"></i>
					Settings
				</a>          
			</div>
		</div>
	</div> 

  */
  ?>

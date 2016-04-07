
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
      <button type="button" class="btn btn-default btn-back pull-left hidden" onclick="history.back()">
        <i class="fa fa-lg fa-chevron-left"></i>
        <span>Back</span>
      </button>
      <!-- menu button to show/ hide the off canvas menu -->
      <button type="button" class="btn btn-default btn-menu pull-left" data-toggle="offcanvas">
        <i class="fa fa-lg fa-bars"></i><span>Menu</span>
      </button>

      <a class="navbar-brand" title="Bootcards Starter" href="/">Bootcards Starter</a>  

      <!--right aligned button-->
      <button type="button" class="btn btn-warning navbar-right hidden-sm">
        <i class="fa fa-lg fa-refresh"></i><span>Refresh</span>
      </button> 

      <!--navbar menu options: shown on desktop only -->
      <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
          <li>
            <a href="#">
              <i class="fa fa-dashboard"></i> Dashboard
            </a>
          </li>
          <li>
            <a href="#">
              <i class="fa fa-building-o"></i> Companies
            </a>
          </li>
          <li class="active">
            <a href="#">
              <i class="fa fa-font"></i> Contacts
            </a>
          </li>
        </ul>
      </div>          
    </div>
  </div>   

  <!-- slide in off canvas menu (mobile only) -->
  <nav class="navmenu offcanvas offcanvas-left">
    <ul class="nav">
      <li>
        <a href="#">
          <i class="fa fa-fw fa-dashboard"></i>Dashboard
        </a>
      </li>
      <li class="active">
        <a href="starter-template.html">
          <i class="fa fa-fw fa-users"></i>Contacts
        </a>
      </li>
      <li>
        <a href="az-picker.html">
          <i class="fa fa-fw fa-font"></i>AZ Picker (Android)
        </a>
      </li>
      <li>
        <a href="double-navbar.html">
          <i class="fa fa-lg fa-bars"></i>Navbar (desktop)
        </a>
      </li>

      <!--option with submenu-->
      <li class="collapse litop4">
        <a href="#otherControls" class="bootcards-parent" data-toggle="collapse" data-parent=".collapse">
          <i class="fa fa-lg fa-fw fa-chevron-circle-right"></i>&nbsp;Settings
        </a>
        <div id="otherControls" class="collapse in">
          <ul class="nav navmenu-nav"><li >
            <a href="#" ><i class="fa fa-lg fa-fw fa-cog"></i>&nbsp;General</a></li>
          <li>
            <a href="#"><i class="fa fa-lg fa-fw fa-user"></i>&nbsp;Account</a>
          </li>
           <li>
            <a href="#"><i class="fa fa-lg fa-fw fa-refresh"></i>&nbsp;Sync</a>
          </li>
          </ul>
        </div>
      </li>

    </ul>

  </nav><!--nav-->
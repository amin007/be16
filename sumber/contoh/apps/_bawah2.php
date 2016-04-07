<!-- Nota kaki -->
  	<!-- fixed tabbed footer -->
	<div class="navbar navbar-default navbar-fixed-bottom">
		<div class="container">
			<div class="bootcards-desktop-footer clearfix">
				<p class="pull-left">BE16 v1.1.2</p>
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


<!-- Load the required JavaScript libraries -->
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script src="http://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>

  <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery.pjax/1.9.2/jquery.pjax.min.js"></script>

  <script src="http://cdnjs.cloudflare.com/ajax/libs/fastclick/1.0.3/fastclick.min.js"></script>

  <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.2/raphael-min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

  <!-- Bootcards JS file -->
  <script src="http://cdnjs.cloudflare.com/ajax/libs/bootcards/1.1.2/js/bootcards.min.js"></script> 
  
  <script src="/bootcards-demo-app/js/bootcards-demo-app.js"></script> 

	<!--modals-->
	<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModal" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content"></div>
		</div>
	</div>
  <div class="modal fade" id="docsModal" tabindex="-1" role="dialog" aria-labelledby="docsModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content"></div>
    </div>
  </div>
  
  <script type="text/javascript">
    //highlight first list group option (if non active yet)
    if ( $('.list-group a.active').length === 0 ) {
      $('.list-group a').first().addClass('active');
    }

    bootcards.init( {
        offCanvasHideOnMainClick : true,
        offCanvasBackdrop : true,
        enableTabletPortraitMode : true,
        disableRubberBanding : true,
        disableBreakoutSelector : 'a.no-break-out'
      });

  </script>

</body>
</html>
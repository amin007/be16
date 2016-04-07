  <!-- Load the required JavaScript libraries -->
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script src="http://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>

  <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery.pjax/1.9.2/jquery.pjax.min.js"></script>

  <script src="http://cdnjs.cloudflare.com/ajax/libs/fastclick/1.0.3/fastclick.min.js"></script>

  <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.2/raphael-min.js"></script>
  <script src="http://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

  <!-- Bootcards JS file -->
  <script src="http://cdnjs.cloudflare.com/ajax/libs/bootcards/1.1.2/js/bootcards.min.js"></script> 
  
  <script src="sumber/js/bootcards-demo-app.js"></script> 

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
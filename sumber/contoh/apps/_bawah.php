
    <!-- Bootstrap & jQuery core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="//code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>

    <!-- Bootcards JS -->
    <script src="../src/js/bootcards.js"></script>

    <!--recommended: FTLabs FastClick library-->
    <script src="//cdnjs.cloudflare.com/ajax/libs/fastclick/1.0.3/fastclick.min.js"></script>

    <script type="text/javascript">

      /*
       * Initialize Bootcards.
       * 
       * Parameters:
       * - offCanvasBackdrop (boolean): show a backdrop when the offcanvas is shown
       * - offCanvasHideOnMainClick (boolean): hide the offcanvas menu on clicking outside the off canvas
       * - enableTabletPortraitMode (boolean): enable single pane mode for tablets in portraitmode
       * - disableRubberBanding (boolean): disable the iOS rubber banding effect
       * - disableBreakoutSelector (string) : for iOS apps that are added to the home screen:
                            jQuery selector to target links for which a fix should be added to not
                            allow those links to break out of fullscreen mode.
       */
       
      bootcards.init( {
        offCanvasBackdrop : true,
        offCanvasHideOnMainClick : true,
        enableTabletPortraitMode : true,
        disableRubberBanding : true,
        disableBreakoutSelector : 'a.no-break-out'
      });

      //enable FastClick
      window.addEventListener('load', function() {
          FastClick.attach(document.body);
      }, false);

      //activate the sub-menu options in the offcanvas menu
      $('.collapse').collapse();

      //theme switcher: only needed for this sample page to set the active CSS
      $('input[name=themeSwitcher]').on('change', function(ev) {
        var theme = $(ev.target).val();
        var themeCSSLoaded = false;

        $.each( document.styleSheets, function(idx, css) {
          var href = css.href;
          if (href.indexOf('bootcards')>-1) {
            if (href.indexOf(theme)>-1) {
              themeCSSLoaded = true;
              css.disabled = false;
            } else {
              css.disabled = true;
            }
          }
        });

        if (!themeCSSLoaded) {
          $("<link/>", {
             rel: "stylesheet",
             type: "text/css",
             href: "http://cdnjs.cloudflare.com/ajax/libs/bootcards/1.1.1/css/bootcards-" + theme + ".min.css"
          }).appendTo("head");
        }
        
      });

    </script>
</body>
</html>
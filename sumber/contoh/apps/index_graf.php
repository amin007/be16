
			<div>
			
				<div class="panel panel-default bootcards-chart">
					
					<div class="panel-heading">
						<h3 class="panel-title">Closed sales by team member - $000s (December)</h3>					
					</div>
			
					<div>
			
						<!--bar chart-->
						<div class="bootcards-chart-canvas" id="chartClosedSales"></div>
			
						<div class="panel-footer">
							<button class="btn btn-default btn-block"
								onClick="toggleChartData(event)">
								<i class="fa fa-table"></i>
								Show Data
							</button>				
						</div>
					</div>
					
					<div class="panel-footer">
						<small class="pull-left">Built with Bootcards - Chart Card</small>
						<a class="btn btn-link btn-xs pull-right"
										href="/snippets/chart"
										data-toggle="modal"
										data-target="#docsModal">
										View Source</a>
					</div>					
			
				</div>		
			
				<!-- Table Card data -->
				<div class="panel panel-default bootcards-table" style="display:none">
					<div class="panel-heading">
						<h3 class="panel-title">Closed sales by team member - $000s (December)</h3>							
					</div>	
					<table class="table table-hover">
						<thead>				
							<tr class="active"><th>Name</th><th class="text-right">Sales value</th></tr>
						</thead>
						<tbody>
							<tr><td>Guy Bardsley</td><td class="text-right">$ 550</td></tr>
							<tr><td>Adam Callahan</td><td class="text-right">$ 1,500</td></tr>
							<tr><td>Arlo Geist</td><td class="text-right">$ 3,750</td></tr>
							<tr><td>Sheila Hutchins</td><td class="text-right">$ 3,500</td></tr>
							<tr><td>Jeanette Quijano</td><td class="text-right">$ 1,250</td></tr>
							<tr><td>Simon Sweet</td><td class="text-right">$ 5,250</td></tr>
							<tr><td><strong>Total</strong></td><td class="text-right"><strong>$ 15,800</strong></td></tr>
						</tbody>
					</table>
					<div class="panel-footer">
						<button class="btn btn-default btn-block" onClick="toggleChartData(event, closedSalesChart)">
							<i class="fa fa-bar-chart-o"></i>
							Show Chart
						</button>				
					</div>
					<div class="panel-footer">
						<small class="pull-left">Built with Bootcards - Table Card</small>
						<a class="btn btn-link btn-xs pull-right"
										href="/snippets/table"
										data-toggle="modal"
										data-target="#docsModal">
										View Source</a>
					</div>													
				</div>
			
			</div>
			
			<script type="text/javascript">
			
			/*
			 * Clear the target DOM element and draw the sample charts
			 * Samples come from the morris.js site at http://www.oesmith.co.uk/morris.js/
			 */
			var closedSalesChart = null;
			
			var drawChartClosedSales = function() {
			
				$("#chartClosedSales").empty();
			
				//create custom Donut function with click event on the segments
				var myDonut = Morris.Donut;
			
				myDonut.prototype.redraw = function() {
			
					var C, cx, cy, i, idx, last, max_value, min, next, seg, total, value, w, _i, _j, _k, _len, _len1, _len2, _ref, _ref1, _ref2, _results;
			      this.raphael.clear();
			      cx = this.el.width() / 2;
			      cy = this.el.height() / 2;
			      w = (Math.min(cx, cy) - 10) / 3;
			      total = 0;
			      _ref = this.values;
			      for (_i = 0, _len = _ref.length; _i < _len; _i++) {
			        value = _ref[_i];
			        total += value;
			      }
			      min = 5 / (2 * w);
			      C = 1.9999 * Math.PI - min * this.data.length;
			      last = 0;
			      idx = 0;
			      this.segments = [];
			      _ref1 = this.values;
			      for (i = _j = 0, _len1 = _ref1.length; _j < _len1; i = ++_j) {
			        value = _ref1[i];
			        next = last + min + C * (value / total);
			        seg = new Morris.DonutSegment(cx, cy, w * 2, w, last, next, this.data[i].color || this.options.colors[idx % this.options.colors.length], this.options.backgroundColor, idx, this.raphael);
			        seg.render();
			        this.segments.push(seg);
			        seg.on('hover', this.select);
			        seg.on('click', this.select);
			        last = next;
			        idx += 1;
			      }
			      this.text1 = this.drawEmptyDonutLabel(cx, cy - 10, this.options.labelColor, 15, 800);
			      this.text2 = this.drawEmptyDonutLabel(cx, cy + 10, this.options.labelColor, 14);
			      max_value = Math.max.apply(Math, this.values);
			      idx = 0;
			      _ref2 = this.values;
			      _results = [];
			      for (_k = 0, _len2 = _ref2.length; _k < _len2; _k++) {
			        value = _ref2[_k];
			        if (value === max_value) {
			          this.select(idx);
			          break;
			        }
			        _results.push(idx += 1);
			      }
			      return _results;
				};
			
				closedSalesChart = myDonut({
				    element: 'chartClosedSales',
				    data: [
				      {label: 'Guy Bardsley', value: 550 },
				      {label: 'Adam Callahan', value: 1500 },
				      {label: 'Arlo Geist', value: 3750 },
				      {label: 'Sheila Hutchins', value: 3500 },
				      {label: 'Jeanette Quijano', value: 1250 },
				      {label: 'Simon Sweet', value: 5250 }
				    ],
				    formatter: function (y, data) { 
				    	//prefixes the values by an $ sign, adds thousands seperators
			
						nStr = y + '';
						x = nStr.split('.');
						x1 = x[0];
						x2 = x.length > 1 ? '.' + x[1] : '';
						var rgx = /(\d+)(\d{3})/;
						while (rgx.test(x1)) {
							x1 = x1.replace(rgx, '$1' + ',' + '$2');
						}
						return '$ ' + x1 + x2;
				    }
				  });
			
			};
			
			//draw the charts when the DOM is ready
			$(document).ready( function() {
				drawChartClosedSales();
			});
			
			//on resize of the page: redraw the charts
			$(window)
				.on('resize', function() {
					window.setTimeout( function() {
						if (closedSalesChart !== null) { closedSalesChart.redraw(); }
					}, 250);
				});
			
			</script>		
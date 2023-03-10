<script src="<?= _backEnd() ?>tinymce/tinymce.min.js"></script>
<!-- start page title -->
<div class="row">
	<div class="col-12">
		<div class="page-title-box">
			<div class="page-title-right">
				<ol class="breadcrumb m-0">

				</ol>
			</div>
			<h4 class="page-title"><?= $title ?></h4>
		</div>
	</div>
</div>
<!-- end page title -->

<div class="row">
	<div class="col-12">

		<div class="row">
			<div class="col-lg-3 col-md-6">
				<div class="card widget-flat">
					<div class="card-body">
						<h5 class="fw-bold mt-0" title="Number of Customers">Anime</h5>
						<h3 class="mb-0"><?= $anime_count ?></h3>
					</div> <!-- end card-body-->
				</div> <!-- end card-->
			</div> <!-- end col-->
			<div class="col-lg-3 col-md-6">
				<div class="card widget-flat">
					<div class="card-body">
						<h5 class="fw-bold mt-0" title="Number of Customers">Site Page</h5>
						<h3 class="mb-0"><?= $pages_count ?></h3>
					</div> <!-- end card-body-->
				</div> <!-- end card-->
			</div> <!-- end col-->
			<div class="col-lg-3 col-md-6">
				<div class="card widget-flat">
					<div class="card-body">
						<h5 class="fw-bold mt-0" title="Number of Customers">Page View</h5>
						<h3 class="mb-0"><?= $visitor_page ?></h3>
					</div> <!-- end card-body-->
				</div> <!-- end card-->
			</div> <!-- end col-->
			<div class="col-lg-3 col-md-6">
				<div class="card widget-flat">
					<div class="card-body">
						<h5 class="fw-bold mt-0" title="Number of Customers">Users</h5>
						<h3 class="mb-0"><?= $users_count ?></h3>
					</div> <!-- end card-body-->
				</div> <!-- end card-->
			</div> <!-- end col-->
		</div> <!-- end row -->

	</div> <!-- end col -->

	<div class="col-12">
		<div class="card card-h-100">
			<div class="card-body">
				<ul class="nav float-end d-none d-lg-flex">
					<li class="nav-item">
						<a class="nav-link text-muted" href="#"><?= date('Y M') ?></a>
					</li>
				</ul>
				<h4 class="header-title mb-3">Page View / Days</h4>

				<div dir="ltr">
					<div id="sessions-overview" class="apex-charts mt-3" data-colors="#0acf97"></div>
				</div>
			</div> <!-- end card-body-->
		</div> <!-- end card-->

	</div> <!-- end col -->

</div>
<!-- end row -->
<script src="<?= _backEnd() ?>js/vendor.min.js"></script>
<script src="<?= _backEnd() ?>js/app.min.js"></script>
<script src="<?= _backEnd() ?>js/vendor/apexcharts.min.js"></script>
<script>
	'use strict';
	! function($) {
		function TodoApp() {
			this.$body = $("body");
			this.charts = [];
		}
		TodoApp.prototype.initCharts = function() {
			window.Apex = {
				chart: {
					parentHeightOffset: 0,
					toolbar: {
						show: false
					}
				},
				grid: {
					padding: {
						left: 0,
						right: 0
					}
				},
				colors: ["#727cf5", "#0acf97", "#fa5c7c", "#ffbc00"]
			};
			var dCurrent = new Date;
			var DEFAULT_TYPE_TEXT_MULTI = function(month, StartDate) {
				var startDate = new Date(month, 1);
				var newNodeLists = [];
				var prize = 0;
				for (; startDate.getMonth() === month && prize < 15;) {
					var date = new Date(startDate);
					newNodeLists.push(date.getDate() + " " + date.toLocaleString("en-US", {
						day: "short",
						timeZone: "Asia/Jakarta"
					}));
					startDate.setDate(startDate.getDate() + 1);
					prize = prize + 1;
				}
				return newNodeLists;
			}(dCurrent.getMonth(), dCurrent.getFullYear());
			var color = ["#727cf5", "#0acf97", "#fa5c7c", "#ffbc00"];
			var colors = $("#sessions-overview").data("colors");
			if (colors) {
				color = colors.split(",");
			}
			var options = {
				chart: {
					height: 300,
					type: "area"
				},
				dataLabels: {
					enabled: false
				},
				stroke: {
					curve: "smooth",
					width: 4
				},
				series: [{
					name: "Page",
					data: [<?= $stats ?>]
				}],
				zoom: {
					enabled: true
				},
				legend: {
					show: false
				},
				colors: color,
				xaxis: {
					type: "string",
					categories: DEFAULT_TYPE_TEXT_MULTI,
					tooltip: {
						enabled: false
					},
					axisBorder: {
						show: false
					},
					labels: {}
				},
				yaxis: {
					labels: {
						formatter: function showTooltip(show) {
							return show + " view";
						},
						offsetX: -15
					}
				},
				fill: {
					type: "gradient",
					gradient: {
						type: "vertical",
						shadeIntensity: 1,
						inverseColors: false,
						opacityFrom: .45,
						opacityTo: .05,
						stops: [45, 100]
					}
				}
			};
			(new ApexCharts(document.querySelector("#sessions-overview"), options)).render();
		};

		TodoApp.prototype.init = function() {
			this.initCharts();
		};
		$.AnalyticsDashboard = new TodoApp;
		$.AnalyticsDashboard.Constructor = TodoApp;
	}(window.jQuery),
	function() {
		window.jQuery.AnalyticsDashboard.init();

	}();
</script>
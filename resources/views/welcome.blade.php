{{-- @php
  dd($reservations);
@endphp --}}

<x-header/>
<body>
	<div class="main-wrapper">
    <div class="page-wrapper">
        <x-admin.navbar/>
        {{-- <x-guest.guest-sidebar /> --}}

			<div class="page-content">

        <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
          <div>
            <h4 class="mb-3 mb-md-0">Welcome to Dashboard</h4>
          </div>
          <div class="d-flex align-items-center flex-wrap text-nowrap">
            <div class="input-group flatpickr wd-200 me-2 mb-2 mb-md-0" id="dashboardDate">
              <span class="input-group-text input-group-addon bg-transparent border-primary" data-toggle><i data-feather="calendar" class="text-primary"></i></span>
              <input type="text" class="form-control bg-transparent border-primary" placeholder="Select date" data-input>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-12 col-xl-12 stretch-card">
            <div class="row flex-grow-1">
              <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline">
                      <h6 class="card-title mb-0">Reservations</h6>
                    </div>
                    <div class="row">
                      <div class="col-6 col-md-12 col-xl-5">
                        <h3 class="mb-2">3,897</h3>
                        <div class="d-flex align-items-baseline">
                          <p class="text-success">
                            <span>+3.3%</span>
                            <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                          </p>
                        </div>
                      </div>
                      <div class="col-6 col-md-12 col-xl-7">
                        <div id="reservationsChart" class="mt-md-3 mt-xl-0"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline">
                      <h6 class="card-title mb-0">Approved Reservations</h6>
                    </div>
                    <div class="row">
                      <div class="col-6 col-md-12 col-xl-5">
                        <h3 class="mb-2">3,897</h3>
                        <div class="d-flex align-items-baseline">
                          <p class="text-success">
                            <span>+3.3%</span>
                            <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                          </p>
                        </div>
                      </div>
                      <div class="col-6 col-md-12 col-xl-7">
                        <div id="approvalChart" class="mt-md-3 mt-xl-0"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
			  <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline">
                      <h6 class="card-title mb-0">Room Reserved</h6>
                    </div>
                    <div class="row">
                      <div class="col-6 col-md-12 col-xl-5">
                        <h3 class="mb-2">35,084</h3>
                        <div class="d-flex align-items-baseline">
                          <p class="text-danger">
                            <span>-2.8%</span>
                            <i data-feather="arrow-down" class="icon-sm mb-1"></i>
                          </p>
                        </div>
                      </div>
                      <div class="col-6 col-md-12 col-xl-7">
                        <div id="ordersChart" class="mt-md-3 mt-xl-0"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline">
                      <h6 class="card-title mb-0">Checked Ins</h6>
                    </div>
                    <div class="row">
                      <div class="col-6 col-md-12 col-xl-5">
                        <h3 class="mb-2">3,897</h3>
                        <div class="d-flex align-items-baseline">
                          <p class="text-success">
                            <span>+3.3%</span>
                            <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                          </p>
                        </div>
                      </div>
                      <div class="col-6 col-md-12 col-xl-7">
                        <div id="checkInChart" class="mt-md-3 mt-xl-0"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline">
                      <h6 class="card-title mb-0">Checked Outs</h6>
                    </div>
                    <div class="row">
                      <div class="col-6 col-md-12 col-xl-5">
                        <h3 class="mb-2">3,897</h3>
                        <div class="d-flex align-items-baseline">
                          <p class="text-success">
                            <span>+3.3%</span>
                            <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                          </p>
                        </div>
                      </div>
                      <div class="col-6 col-md-12 col-xl-7">
                        <div id="checkOutChart" class="mt-md-3 mt-xl-0"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline">
                      <h6 class="card-title mb-0">Payments</h6>
                    </div>
                    <div class="row">
                      <div class="col-6 col-md-12 col-xl-5">
                        <h3 class="mb-2">89.87%</h3>
                        <div class="d-flex align-items-baseline">
                          <p class="text-success">
                            <span>+2.8%</span>
                            <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                          </p>
                        </div>
                      </div>
                      <div class="col-6 col-md-12 col-xl-7">
                        <div id="growthChart" class="mt-md-3 mt-xl-0"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div> <!-- row -->

        <div class="row">
          <div class="col-12 col-xl-12 grid-margin stretch-card">
            <div class="card overflow-hidden">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline mb-4 mb-md-3">
                  <h6 class="card-title mb-0">Revenue</h6>
                </div>
                <div class="row align-items-start">
                  <div class="col-md-7">
                    <p class="text-muted tx-13 mb-3 mb-md-0">Revenue is the income that a business has from its normal business activities, usually from the sale of goods and services to customers.</p>
                  </div>
                  <div class="col-md-5 d-flex justify-content-md-end">
                    <div class="btn-group mb-3 mb-md-0" role="group" aria-label="Basic example">
                      <button type="button" class="btn btn-outline-primary">Today</button>
                      <button type="button" class="btn btn-outline-primary d-none d-md-block">Week</button>
                      <button type="button" class="btn btn-primary">Month</button>
                      <button type="button" class="btn btn-outline-primary">Year</button>
                    </div>
                  </div>
                </div>
                <div id="revenueChart" ></div>
              </div>
            </div>
          </div>
        </div> <!-- row -->

			</div>

			<!-- partial:partials/_footer.html -->
			<x-footer/>
			<!-- partial -->
		
		</div>
	</div>

<script>
    $(document).ready(function() {

    	function reservations () {
			var reservations = {!! json_encode($reservationCounts) !!};
            
			// Extract dates and counts from the reservations object
			var dates = Object.keys(reservations);
    		var counts = Object.values(reservations);

            if ($('#ordersChart').length) {
                var options2 = {
                    chart: {
                        type: "bar",
                        height: 60,
                        sparkline: {
                            enabled: true
                        }
                    },
                    plotOptions: {
                        bar: {
                            borderRadius: 2,
                            columnWidth: "60%"
                        }
                    },
                    colors: ['#7367F0'], // Change to your desired color
                    series: [{
                        name: 'Reservations',
                        data: counts
                    }],
                    xaxis: {
                        type: 'datetime',
                        categories: dates
                    },
                };

			// Render the chart using ApexCharts
			const chart = new ApexCharts(document.querySelector('#reservationsChart'), options2);
			chart.render();
		
			}
		}

		function approvals () {
			var approvals = {!! json_encode($approvalCounts) !!};
            
			// Extract dates and counts from the reservations object
			var dates = Object.keys(approvals);
    		var counts = Object.values(approvals);

            if ($('#approvalChart').length) {
                var options3 = {
                    chart: {
                        type: "bar",
                        height: 60,
                        sparkline: {
                            enabled: true
                        }
                    },
                    plotOptions: {
                        bar: {
                            borderRadius: 2,
                            columnWidth: "60%"
                        }
                    },
                    colors: ['#7367F0'], // Change to your desired color
                    series: [{
                        name: 'Reservations',
                        data: counts
                    }],
                    xaxis: {
                        type: 'datetime',
                        categories: dates
                    },
                };

			// Render the chart using ApexCharts
			const chart = new ApexCharts(document.querySelector('#approvalChart'), options3);
			chart.render();
			}
		}

		function checkIns () {
			var reservations = {!! json_encode($checkInCounts) !!};
            
			// Extract dates and counts from the reservations object
			var dates = Object.keys(reservations);
    		var counts = Object.values(reservations);

            if ($('#ordersChart').length) {
                var options4 = {
                    chart: {
                        type: "bar",
                        height: 60,
                        sparkline: {
                            enabled: true
                        }
                    },
                    plotOptions: {
                        bar: {
                            borderRadius: 2,
                            columnWidth: "60%"
                        }
                    },
                    colors: ['#7367F0'], // Change to your desired color
                    series: [{
                        name: 'Reservations',
                        data: counts
                    }],
                    xaxis: {
                        type: 'datetime',
                        categories: dates
                    },
                };

			// Render the chart using ApexCharts
			const chart = new ApexCharts(document.querySelector('#checkInChart'), options4);
			chart.render();
		
			}
		}

		function checkOuts () {
			var reservations = {!! json_encode($checkOutCounts) !!};
            
			// Extract dates and counts from the reservations object
			var dates = Object.keys(reservations);
    		var counts = Object.values(reservations);

            if ($('#ordersChart').length) {
                var options5 = {
                    chart: {
                        type: "bar",
                        height: 60,
                        sparkline: {
                            enabled: true
                        }
                    },
                    plotOptions: {
                        bar: {
                            borderRadius: 2,
                            columnWidth: "60%"
                        }
                    },
                    colors: ['#7367F0'], // Change to your desired color
                    series: [{
                        name: 'Reservations',
                        data: counts
                    }],
                    xaxis: {
                        type: 'datetime',
                        categories: dates
                    },
                };

			// Render the chart using ApexCharts
			const chart = new ApexCharts(document.querySelector('#checkOutChart'), options5);
			chart.render();
		
			}
		}
		
		reservations();
		approvals();
		checkIns();
		checkOuts();
    })
</script>

{{-- <script> --}}
	{{-- $(document).ready(function() {
		const reservationsPerDay = {};
		for (const reservation of $reservations) {
			const reservationDate = new Date(reservation.request_date).toLocaleDateString();
			reservationsPerDay[reservationDate] = (reservationsPerDay[reservationDate] || 0) + 1;
		}

		// Prepare chart data
		const chartData = [];
		for (const day in reservationsPerDay) {
			chartData.push({
			x: day,
			y: reservationsPerDay[day]
			});
		}
  
	  	// Configure the chart options
		const options = {
			chart: {
			type: 'bar',
			height: 350 // Adjust height as needed
			},
			xaxis: {
			title: 'Date'
			},
			yaxis: {
			title: 'Number of Reservations'
			},
			series: [{
			name: 'Reservations',
			data: chartData
			}]
		};

		// Render the chart
		const chart = new ApexCharts(document.querySelector('#reservationsChart'), options);
		chart.render();
	});
  </script> --}}
  


<x-main-footer/>
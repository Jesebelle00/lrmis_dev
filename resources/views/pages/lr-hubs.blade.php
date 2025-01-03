@extends('layout.layout')
@section('content')
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
	<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
	<div class="row px-3 py-3">
		<div class="col-md-4">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item" role="presentation">
					<button class="tab-button active" id="print-tab" data-bs-toggle="tab" data-bs-target="#print" type="button"
						role="tab" aria-controls="print" aria-selected="true">Print</button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="tab-button" id="non-print-tab" data-bs-toggle="tab" data-bs-target="#non-print" type="button"
						role="tab" aria-controls="non-print" aria-selected="false">Non-Print</button>
				</li>
			</ul>
		</div>
		<div class="tab-content">
			<!-- PRINT TAB -->
			<div class="tab-pane fade show active" id="print" role="tabpanel" aria-labelledby="print-tab">
				<div class="card px-2 py-2">
					<div class="container-fluid py-1">
						<section class="tablecontent">
							<div class="table-responsive">
								<table id="dataTablePrint" class="table table-bordered" style="width:100%">
									<thead>
										<tr>
											<th>ID</th>
											<th>Title</th>
											<th>Type</th>
											<th>Subject Area</th>
											<th>Author</th>
											<th>Publisher</th>
											<th>Volume</th>
											<th>Copyright Year</th>
											<th>Pages</th>
											<th>Quantity</th>
											<th>Source</th>
										</tr>
									</thead>
								</table>
							</div>
						</section>
					</div>
				</div>
			</div>

			<!-- NON-PRINT TAB -->
			<div class="tab-pane fade" id="non-print" role="tabpanel" aria-labelledby="non-print-tab">
				<div class="card px-2 py-2">
					<div class="container-fluid py-1">
						<section class="tablecontent">
							<div class="table-responsive">
								<table id="dataTableNonPrint" class="table table-bordered" style="width:100%">
									<thead>
										<tr>
											<th>ID</th>
											<th>Type</th>
											<th>Subject Area</th>
											<th>Level</th>
											<th>Size/Dimension</th>
											<th>Version</th>
											<th>Link</th>
											<th>Quantity</th>
										</tr>
									</thead>
								</table>
							</div>
						</section>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script>
		$(document).ready(function() {
			// Initialize the Print DataTable immediately
			$('#dataTablePrint').DataTable({
				processing: true,
				serverSide: true,
				ajax: {
					url: '/get-print-lrhubs',
					type: 'POST',
					data: function(d) {
						d._token = '{{ csrf_token() }}';
					}
				},
				columns: [{
						data: 'lr_id'
					},
					{
						data: 'title'
					},
					{
						data: 'type_name'
					},
					{
						data: 'subject_title'
					},
					{
						data: 'grade_level'
					},
					{
						data: 'volume'
					},
					{
						data: 'copyrightyear'
					},
					{
						data: 'pages'
					},
					{
						data: 'qty'
					}
				]
			});

			// Defer initialization of the Non-Print DataTable
			let nonPrintTableInitialized = false;
			$('#non-print-tab').on('shown.bs.tab', function() {
				if (!nonPrintTableInitialized) {
					$('#dataTableNonPrint').DataTable({
						processing: true,
						serverSide: true,
						ajax: {
							url: '/get-nonprint-lrhubs',
							type: 'POST',
							data: function(d) {
								d._token = '{{ csrf_token() }}';
							}
						},
						columns: [{
								data: 'lr_id'
							},
							{
								data: 'type_name'
							},
							{
								data: 'subject_title'
							},
							{
								data: 'grade_level'
							},
							{
								data: 'size'
							},
							{
								data: 'model'
							},
							{
								data: 'url'
							},
							{
								data: 'qty'
							}
						]
					});
					nonPrintTableInitialized = true;
				}
			});
		});
	</script>
@endsection

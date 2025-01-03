@extends('layout.layout')
@section('content')
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
	<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
	<div class="container">
		<div class="container">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item" role="presentation">
					<button class="nav-link active" id="print-tab" data-bs-toggle="tab" data-bs-target="#print" type="button"
						role="tab" aria-controls="print" aria-selected="true">Print</button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link" id="non-print-tab" data-bs-toggle="tab" data-bs-target="#non-print" type="button"
						role="tab" aria-controls="non-print" aria-selected="false">Non-Print</button>
				</li>
			</ul>
		</div>
		<div class="tab-content" id="myTabContent">
			<div class="row">
				<div class="col-12">
					<div class="card my-2; padding-inline: auto;" style="border-radius: 0 10px 10px 10px">
						<!-- Main CONTENT -->
						<div class="container-fluid py-1 mx-0 px-0">
							<div class="row mx-1 mb-3 me-2">
								<div class="col-md-4 g-1 mx-0 px-0">
									<div class="container px-0 mx-1 pe-1">
										<div class="card ">
											<div class="card-header p-0 position-relative ">
												<div class="shadow-dark rounded-2" style="background-color: #0071bd; padding: 5px 5px 3px 5px">
													<h5 class="text-white text-capitalize ps-3">Borrower's Log</h5>
												</div>
											</div>
											<div class="container-fluid overflow-auto mt-3 px-2">
												<table id="borrowersLog" class="table table-hover mt-0 pt-0" width="auto">
													<thead>
														<tr>
															<th style="display:none">ID</th>
															<th>Name</th>
															<th>Position</th>
															<th>Action</th>
														</tr>
													</thead>
													<tbody>
														<td>
														</td>
														</tr>
													</tbody>
												</table>
												<br>
											</div>
										</div>
									</div>
								</div>

								<div class="col-md-8 g-1 mx-0 px-1">
									<div class="container px-0 mx-1 ps-1">
										<div class="card">
											<div class="card-header p-0 position-relative">
												<div class="shadow-dark rounded-2" style="background-color: #0071bd; padding: 5px 5px 3px 5px">
													<h5 class="text-white text-capitalize ps-3">Borrowed LR/s</h5>
												</div>
											</div>
											<div class="container-fluid pt-3">
												<table id="borrowedLR" class="table table-hover" width="auto">
													<thead>
														<tr>
															<th style='display:none'>ID</th>
															<th>Accession</th>
															<th>Date Borrowed</th>
															<th>Date Returned</th>
															<th>Action</th>
														</tr>
													</thead>
													<tbody>
													</tbody>
												</table>
												<br>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<br>
				</div>
			</div>
		</div>
	</div>

	<script>
		$(document).ready(function() {
			// Initialize the Print DataTable immediately
			$('#borrowersLog').DataTable({
				processing: true,
				serverSide: true,
				ajax: {
					url: '/get-borrowers-logs',
					type: 'POST',
					data: function(d) {
						d._token = '{{ csrf_token() }}';
					}
				},
				columns: [{
						data: 'id'
					},
					{
						data: 'name'
					},
					{
						data: 'position'
					}
				]
			});
		});
	</script>
@endsection

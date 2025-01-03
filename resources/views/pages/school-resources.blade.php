@extends('layout.layout')
@section('content')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/datatable.custom.css') }}">
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
    <!-- Boxicons CSS for styling icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/css/animations.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/css/transformations.min.css">

    <!-- Boxicons JS for icon functionalities -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/dist/boxicons.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/dist/boxicons.min.js"></script>

	<div class="container px-3 py-3">
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
                                            <th>Actions</th>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Type</th>
                                            <th>Subject Area</th>
                                            <th>Level</th>
                                            <th>Volume</th>
                                            <th>Copyright Year</th>
                                            <th>Pages</th>
                                            <th>Quantity</th>
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
                                            <th>Actions</th>
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
    <!--Add More Modal -->
    <div class="modal fade" id="addQuantityModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addQuantityModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addQuantityModalLabel">Add Quantity</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addQuantityForm">
                        <div class="mb-3">
                            <label for="itemId" class="form-label">Item ID</label>
                            <input type="text" class="form-control" id="itemId" name="itemId" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="itemTitle" class="form-label">Title</label>
                            <input type="text" class="form-control" id="itemTitle" name="itemTitle" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveQuantity">Save</button>
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
					url: '/get-print-resources',
					type: 'POST',
					data: function(d) {
						d._token = '{{ csrf_token() }}';
					}
				},
				columns: [
                    {
                        data: 'actions',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return `
                                <button class="btn btn-sm edit-btn custom-hover" data-id="${row.lr_id}" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                    <box-icon name="message-square-edit" color="#198754" size="sm"></box-icon>
                                </button>

                                <button class="btn btn-sm delete-btn custom-hover" data-id="${row.lr_id}" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                    <box-icon name="trash" color="#dc3545" size="sm"></box-icon>
                                </button>

                                <button class="btn btn-sm add-more-btn custom-hover" data-id="${row.lr_id}" data-bs-toggle="tooltip" data-bs-placement="top" title="Add More">
                                    <box-icon name="plus-circle" color="#0d6efd" size="sm"></box-icon>
                                </button>

                                <button class="btn btn-sm view-btn custom-hover" data-id="${row.lr_id}" data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                    <box-icon name="show" color="#0dcaf0" size="sm"></box-icon>
                                </button>

                            `;
                        }
                    },
                    {
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
				],
                scrollX: true,
				error: function(xhr, error, code) {
					console.error('DataTables error:', error);
				}
			});

            // Event listeners for the buttons
            // $('#dataTablePrint').on('click', '.edit-btn', function() {
            //     const id = $(this).data('id');
            //     alert(id);
            // });

            // $('#dataTablePrint').on('click', '.delete-btn', function() {
            //     const id = $(this).data('id');
            //     alert(id);
            // });

            $('#dataTablePrint').on('click', '.add-more-btn', function() {
                const id = $(this).data('id');
                const row = $('#dataTablePrint').DataTable().row($(this).parents('tr')).data();
                const title = row.title;

                $('#itemId').val(id);
                $('#itemTitle').val(title);

                $('#addQuantityModal').modal('show');
            });

            $('#dataTablePrint').on('click', '.view-btn', function() {
                const id = $(this).data('id');
                if (id) {
                    window.location.href = `/view-resource/${id}`;
                } else {
                    alert('Invalid ID');
                }
            });


			// Defer initialization of the Non-Print DataTable
			let nonPrintTableInitialized = false;
            $('#non-print-tab').on('shown.bs.tab', function() {
                if (!nonPrintTableInitialized) {
                    $('#dataTableNonPrint').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: {
                            url: '/get-nonprint-resources',
                            type: 'POST',
                            data: function(d) {
                                d._token = '{{ csrf_token() }}';
                            }
                        },
                        columns: [
                            {
                                data: 'actions',
                                orderable: false,
                                searchable: false,
                                render: function(data, type, row) {
                                    return `
                                        <button class="btn btn-sm btn-primary edit-btn" data-id="${row.lr_id}">Edit</button>
                                        <button class="btn btn-sm btn-danger delete-btn" data-id="${row.lr_id}">Delete</button>
                                        <button class="btn btn-sm btn-success add-more-btn" data-id="${row.lr_id}">Add More</button>
                                        <button class="btn btn-sm btn-info view-btn" data-id="${row.lr_id}">View</button>
                                    `;
                                }
                            },
                            { data: 'lr_id' },
                            { data: 'type_name' },
                            { data: 'subject_title' },
                            { data: 'grade_level' },
                            { data: 'size' },
                            { data: 'model' },
                            { data: 'url' },
                            { data: 'qty' }
                        ],
                        scrollX: true,
                        error: function(xhr, error, code) {
                            console.error('DataTables error:', error);
                        }
                    });
                    nonPrintTableInitialized = true;
                }
            });
		});
	</script>
    <style>
        .custom-hover:hover {
            background-color: rgba(0, 0, 0, 0.05); /* Light gray background */
            border-color: #000; /* Darker border color */
            transition: background-color 0.2s, border-color 0.2s; /* Smooth transition */
        }

        .custom-hover:hover box-icon {
            transform: scale(1.2); /* Slightly enlarges the icon */
            transition: transform 0.2s; /* Smooth scaling */
        }
    </style>

@endsection

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

    <style>
        .custom-hover {
            margin: 0;
            padding: 2px 4px; /* Adjust spacing */
        }
        .btn-group .btn {
            margin-right: -1px; /* Remove gap between buttons */
        }
    </style>

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
                                <div class="btn-group" role="group" aria-label="Actions">
                                    <button class="btn btn-sm edit-btn custom-hover" data-id="${row.lr_id}" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                        <svg class='upBtn' xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor' class='w-6 h-6'>
                                            <path stroke-linecap='round' stroke-linejoin='round' d='M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10' />
                                        </svg>
                                    </button>
                                    <button class="btn btn-sm delete-btn custom-hover" data-id="${row.lr_id}" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                        <svg class=' deleteBtn' xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor' class='w-6 h-6'>
                                            <path stroke-linecap='round' stroke-linejoin='round' d='M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0' />
                                        </svg>
                                    </button>
                                    <button class="btn btn-sm add-more-btn custom-hover" data-id="${row.lr_id}" data-bs-toggle="tooltip" data-bs-placement="top" title="Add More">
                                        <svg class='addBtn' xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' strokeWidth={1.5} stroke='currentColor' className='w-6 h-6'>
                                            <path strokeLinecap='round' strokeLinejoin='round' d='M12 4.5v15m7.5-7.5h-15' />
                                        </svg>
                                    </button>
                                    <button class="btn btn-sm view-btn custom-hover" data-id="${row.lr_id}" data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                        <svg class='viewBtn' xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor' class='w-6 h-6' >
                                            <path stroke-linecap='round' stroke-linejoin='round' d='M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z' />
                                            <path stroke-linecap='round' stroke-linejoin='round' d='M15 12a3 3 0 11-6 0 3 3 0 016 0z' />
                                        </svg>
                                    </button>
                                </div>
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

            // $('#dataTablePrint').on('click', '.add-more-btn', function() {
            //     const id = $(this).data('id');
            //     const row = $('#dataTablePrint').DataTable().row($(this).parents('tr')).data();
            //     const title = row.title;

            //     $('#itemId').val(id);
            //     $('#itemTitle').val(title);

            //     $('#addQuantityModal').modal('show');
            // });

            $('#dataTablePrint').on('click', '.view-btn', function() {
                const id = $(this).data('id');
                if (id) {
                    window.location.href = `/view-resource-print/${id}`;
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
                                        <div class="btn-group" role="group" aria-label="Actions">
                                            <button class="btn btn-sm edit-btn custom-hover" data-id="${row.lr_id}" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                                <svg class='upBtn' xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor' class='w-6 h-6'>
                                                    <path stroke-linecap='round' stroke-linejoin='round' d='M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10' />
                                                </svg>
                                            </button>
                                            <button class="btn btn-sm delete-btn custom-hover" data-id="${row.lr_id}" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                                <svg class=' deleteBtn' xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor' class='w-6 h-6'>
                                                    <path stroke-linecap='round' stroke-linejoin='round' d='M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0' />
                                                </svg>
                                            </button>
                                            <button class="btn btn-sm add-more-btn custom-hover" data-id="${row.lr_id}" data-bs-toggle="tooltip" data-bs-placement="top" title="Add More">
                                                <svg class='addBtn' xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' strokeWidth={1.5} stroke='currentColor' className='w-6 h-6'>
                                                    <path strokeLinecap='round' strokeLinejoin='round' d='M12 4.5v15m7.5-7.5h-15' />
                                                </svg>
                                            </button>
                                            <button class="btn btn-sm view-btn custom-hover" data-id="${row.lr_id}" data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                                <svg class='viewBtn' xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor' class='w-6 h-6' >
                                                    <path stroke-linecap='round' stroke-linejoin='round' d='M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z' />
                                                    <path stroke-linecap='round' stroke-linejoin='round' d='M15 12a3 3 0 11-6 0 3 3 0 016 0z' />
                                                </svg>
                                            </button>
                                        </div>
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

            $('#dataTableNonPrint').on('click', '.view-btn', function() {
                const id = $(this).data('id');
                if (id) {
                    window.location.href = `/view-resource-nonprint/${id}`;
                } else {
                    alert('Invalid ID');
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
        .dataTables_wrapper table.dataTable td {
    padding: 2px !important;
}

    </style>

@endsection

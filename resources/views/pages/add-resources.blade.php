@extends('layout.layout')
@section('content')
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<div class="container">
		<!-- Tabs -->
		<ul class="nav nav-tabs" id="myTab" role="tablist">
			<li class="nav-item" role="presentation">
				<a class="nav-link active" id="print-tab" data-bs-toggle="tab" data-bs-target="#print" role="tab"
					aria-controls="print" aria-selected="true">Add Print Material</a>
			</li>
			<li class="nav-item" role="presentation">
				<a class="nav-link" id="non-print-tab" data-bs-toggle="tab" data-bs-target="#non-print" role="tab"
					aria-controls="non-print" aria-selected="false">Add Non-Print Material</a>
			</li>
			<li class="nav-item" role="presentation">
				<a class="nav-link" id="excel-tab" data-bs-toggle="tab" data-bs-target="#excel" role="tab"
					aria-controls="excel" aria-selected="true">Upload Excel Sample</a>
			</li>
		</ul>

		<div class="tab-content" id="myTabContent">

			<!-- PRINT TAB -->
			<div class="tab-pane show active fade mt-4" id="print" role="tabpanel" aria-labelledby="print-tab">
				<div class="card my-4 pt-2">
					<div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
						<div class="shadow-dark border-radius-lg pt-3 pb-2" style="background-color: #0071bd">
							<h5 class="text-white text-capitalize ps-3">Print Resource</h5>
						</div>
					</div>
					<div class="card-body">
						<p style="text-align:left;" class="mb-0 text-dark ps-1 mb-0">
							Add new resource, then click Submit.&nbsp;
							<span style="color:red">*</span> - required fields.
						</p>
						<div class="container pt-2" id="print-content">

							<div class="container mt-4" style="max-width: 1000px;">

								<p id="message" class="col-12" style="display:none;color:red;"></p>

								<form id="add_print" method="post" class="row g-3">
									@csrf
									<div class="col-md-12">
										<label for="search" class="form-label">Title<span class="text-danger">*</span></label>
										<input type="text" class="form-control" id="search" name="search" placeholder="Start typing..."
											required>
									</div>
									<input type="hidden" id="selected-id" name="selectedID">
									<div id="suggestions" class="col-12"></div>
									<div class="col-md-12">
										<label for="print_type" class="form-label">Type<span class="text-danger">*</span></label>
										<select id="print_type" name="print_type" class="form-select" required>
											<option value="" selected disabled>Select Type</option>
										</select>
									</div>
									{{-- <div class="col-md-12">
										<label class="form-label">Subjects<span class="text-danger">*</span></label>
										<div id="temporaryStorage">
											<h6>Selected Subjects:</h6>
											<ul id="subjectList"></ul>
										</div>
										<input type="text" id="subjectInput" name="subject" readonly required />
										<div id="subjects"></div>
									</div> --}}
                                    <div class="col-md-12">
                                        <label for="subject_gradelevel" class="form-label">
                                            Subjects and Grade Levels<span class="text-danger">*</span>
                                        </label>
                                        <div class="container">
                                            <div id="temporaryStorage" style="display: none;">
                                                <h6>Selected Subjects:</h6>
                                                <ul id="subjectList"></ul>
                                            </div>
                                            <input type="hidden" id="subjectInput" name="subject" readonly required />
                                            <div style="max-height: 250px; overflow-y: auto; ">
                                                <table class="table table-bordered compact-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Subject Title</th>
                                                            <!-- Grade Level Columns will be dynamically added here -->
                                                        </tr>
                                                    </thead>
                                                    <tbody id="subjectsTable">
                                                        <!-- Rows will be dynamically populated here -->
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <style>
                                            /* Compact Table Styles */
                                            .compact-table th,
                                            .compact-table td {
                                                padding: 4px !important;
                                                text-align: left;
                                                font-size: 16px;
                                            }

                                            .compact-table th {
                                                white-space: nowrap;
                                                background-color: #f8f9fa;
                                                position: sticky;
                                                top: 0;
                                                z-index: 2;
                                            }

                                            .compact-table td input[type="checkbox"] {
                                                width: 16px;
                                                height: 16px;
                                                margin: 0 auto;
                                            }

                                            .compact-table {
                                                border-collapse: collapse;
                                            }
                                        </style>

                                        <script>
                                            $(document).ready(function () {
                                                var tempStorage = [];

                                                function updateSubjectInput() {
                                                    $('#subjectInput').val(tempStorage.join(','));
                                                }

                                                $.ajax({
                                                    url: '/subjectgradelevels', // Your Laravel route
                                                    method: 'GET',
                                                    success: function (response) {
                                                        const subjects = response.subjects;

                                                        // Define shifted grade levels: K and 1-12
                                                        const gradeLevels = ['K', ...Array.from({ length: 12 }, (_, i) => (i + 1).toString())];

                                                        // Add grade level columns to the table header
                                                        let headerRow = '<th>Subject Title</th>';
                                                        gradeLevels.forEach(grade => {
                                                            headerRow += `<th>${grade}</th>`;
                                                        });
                                                        $('thead tr').html(headerRow);

                                                        // Populate the table rows
                                                        let tableRows = '';
                                                        subjects.forEach(subject => {
                                                            let row = `
                                                                <tr>
                                                                    <td>${subject.SubjectTitle}</td>
                                                            `;

                                                            gradeLevels.forEach((grade, index) => {
                                                                // Map shifted grade levels: move data from 1 to K, 2 to 1, ..., 13 to 12
                                                                const sourceGrade = index === 0 ? '1' : (index + 1).toString();
                                                                const gradeData = subject.GradeLevels[sourceGrade]
                                                                    ? `<input type="checkbox" value="${subject.GradeLevels[sourceGrade]}" />`
                                                                    : '';
                                                                row += `<td>${gradeData}</td>`;
                                                            });

                                                            row += '</tr>';
                                                            tableRows += row;
                                                        });

                                                        $('#subjectsTable').html(tableRows);

                                                        // Subject selection logic
                                                        $('#subjectsTable').on('change', 'input[type="checkbox"]', function () {
                                                            var selectedSubjectValue = $(this).val();
                                                            var selectedSubjectText = $(this).closest('tr').find('td:first').text();

                                                            if (this.checked) {
                                                                if (!tempStorage.includes(selectedSubjectValue)) {
                                                                    tempStorage.push(selectedSubjectValue);
                                                                    $('#subjectList').append('<li>' + selectedSubjectText +
                                                                        ' <button type="button" class="btn btn-sm btn-danger removeSubject" data-value="' +
                                                                        selectedSubjectValue + '">Remove</button></li>');
                                                                    updateSubjectInput();
                                                                } else {
                                                                    alert('This subject is already added.');
                                                                }
                                                            } else {
                                                                tempStorage = tempStorage.filter(function (subjectValue) {
                                                                    return String(subjectValue) !== String(selectedSubjectValue);
                                                                });
                                                                $('#subjectList').find('button[data-value="' + selectedSubjectValue + '"]').parent().remove();
                                                                updateSubjectInput();
                                                            }
                                                        });

                                                        $('#subjectList').on('click', '.removeSubject', function () {
                                                            var subjectValueToRemove = String($(this).data('value'));
                                                            tempStorage = tempStorage.filter(function (subjectValue) {
                                                                return String(subjectValue) !== subjectValueToRemove;
                                                            });
                                                            $('#subjectsTable').find('input[value="' + subjectValueToRemove + '"]').prop('checked', false);
                                                            $(this).parent().remove();
                                                            updateSubjectInput();
                                                        });
                                                    },
                                                    error: function () {
                                                        alert('Failed to fetch data.');
                                                    }
                                                });
                                            });
                                        </script>
                                    </div>


									<div class="col-md-12">
										<label for="author" class="form-label">Author<span class="text-danger">*</span></label>
										<input type="text" class="form-control" id="print_author" name="print_author" placeholder="Author">
										<input type="hidden" id="printAuthorInput" name="selectedAuthors">
										<div id="auth-suggestions" style="max-height: 200px; overflow-y: auto;"></div>
									</div>

									<div id="temporaryAuthorStorage">
										<h6>Selected Authors:</h6>
										<ul id="authorList"></ul>
									</div>
									<input type="text" id="authorIDs" name="authorIDs" readonly required />
									<div class="col-md-6">
										<label for="publisher" class="form-label">Publisher</label>
										<input type="text" class="form-control" id="publisherPrint" name="publisherPrint"
											placeholder="Publisher">
										<input type="hidden" id="pub-selected-id" name="pub-selected-id">
										<div id="pub-suggestions" style="max-height: 200px; overflow-y: auto;" class="col-12"></div>
									</div>

									<div class="col-md-6">
										<label for="volume" class="form-label">Volume</label>
										<input type="text" class="form-control" id="volume" name="volume" placeholder="Volume">
									</div>

									<div class="col-md-6">
										<label for="copyright" class="form-label">Copyright Year</label>
										<input type="number" class="form-control" id="copyright" name="copyright" min="1900" max="3000"
											placeholder="YYYY">
									</div>

									<div class="col-md-6">
										<label for="pages" class="form-label">No. of Pages<span class="text-danger">*</span></label>
										<input type="text" class="form-control" id="pages" name="pages" placeholder="No. of Pages"
											required>
									</div>

									<div class="col-md-6">
										<label for="print_source" class="form-label">Source<span class="text-danger">*</span></label>
										<select id="print_source" name="print_source" class="form-select" required>
											<option value="" selected disabled>Select Source</option>
										</select>
									</div>

									<div class="col-md-6">
										<label for="print_status" class="form-label">Status<span class="text-danger">*</span></label>
										<select id="print_status" name="print_status" class="form-select" required>
											<option value="" selected disabled>Select Status</option>
										</select>
									</div>

									<div class="col-md-6">
										<label for="qty" class="form-label">Quantity<span class="text-danger">*</span></label>
										<input type="number" class="form-control" id="qty" name="qty" min="1" required>
									</div>

									<div class="col-md-6">
										<label for="acqrd" class="form-label">Date Acquired<span class="text-danger">*</span></label>
										<input type="date" class="form-control" id="acqrd" name="acqrd" required>
									</div>

									<div class="col-md-12">
										<label for="remarks" class="form-label">Remarks</label>
										<textarea class="form-control" id="remarks" name="remarks"></textarea>
									</div>

									<div class="col-12 d-flex justify-content-center">
										<button id="add-button" type="submit" class="shadow-dark loginbtn">Add</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<script>
					$(document).ready(function() {
						// Title Search
						$('#search').on('input', function() {
							var query = $(this).val();
							if (query.length > 2) {
								$.ajax({
									url: '/search-titles',
									method: 'GET',
									data: {
										term: query
									},
									success: function(data) {
										if (data.html) {
											$('#suggestions').html(data.html);
										} else {
											$('#suggestions').html(
												'<p>No results found. Add the title first.</p>');
										}
									},
									error: function(xhr, status, error) {
										console.error('An error occurred:', error);
									}
								});
							} else {
								$('#suggestions').empty();
							}
						});

						$(document).on('click', '.suggestion-item', function() {
							var selectedId = $(this).data('id');
							var selectedText = $(this).text();
							$('#search').val(selectedText);
							$('#selected-id').val(selectedId);
							$('#suggestions').empty();
						});

						// Print Types
						$.ajax({
							url: '/print-types',
							method: 'GET',
							dataType: 'json',
							success: function(data) {
								if (data.length > 0) {
									$.each(data, function(index, type) {
										$('#print_type').append(
											$('<option>', {
												value: type.id,
												text: type.type_name
											})
										);
									});
								}
							},
							error: function(xhr, status, error) {
								console.error('Error fetching print types: ' + error);
							}
						});

						// Author Search and Selection
						$('#print_author').on('input', function() {
							var query = $(this).val();
							if (query.length > 2) {
								$.ajax({
									url: '/search-authors',
									method: 'GET',
									data: {
										term: query
									},
									success: function(response) {
										if (response.html.trim()) {
											$('#auth-suggestions').html(response.html);
										} else {
											$('#auth-suggestions').html(
												'<p>No authors found. Add the author first.</p>');
										}
									},
									error: function() {
										$('#auth-suggestions').html(
											'<p>Error fetching suggestions. Please try again later.</p>');
									}
								});
							} else {
								$('#auth-suggestions').empty();
							}
						});

						const selectedAuthors = [];

						const updateAuthorInput = () => {
							$('#authorInput').val(selectedAuthors.join(','));
							$('#authorIDs').val(selectedAuthors.join(','));
						};

						$('#auth-suggestions').on('click', '.auth-suggestion-item', function() {
							const authorId = $(this).data('id');
							const authorName = $(this).text();

							if (authorId && !selectedAuthors.includes(authorId.toString())) {
								selectedAuthors.push(authorId.toString());
								$('#authorList').append(`
                                    <li>
                                        ${authorName}
                                        <button type="button" class="btn btn-sm btn-danger removeAuthor" data-id="${authorId}">
                                            Remove
                                        </button>
                                    </li>
                                `);
								updateAuthorInput();
								$('#print_author').val('');
								$('#auth-suggestions').empty();
							} else {
								alert('This author is already selected or invalid.');
							}
						});

						$('#authorList').on('click', '.removeAuthor', function() {
							const authorId = $(this).data('id');
							const index = selectedAuthors.indexOf(authorId.toString());
							if (index !== -1) {
								selectedAuthors.splice(index, 1);
								$(this).parent().remove();
								updateAuthorInput();
							}
						});

						// Publisher Search
						$('#publisherPrint').on('input', function() {
							var query = $(this).val();
							if (query.length > 2) {
								$.ajax({
									url: '/search-publishers',
									method: 'GET',
									data: {
										term: query
									},
									success: function(response) {
										if (response.html.trim()) {
											$('#pub-suggestions').html(response.html);
											$('#pub-message').hide();
										} else {
											$('#pub-suggestions').empty();
											$('#pub-message').text('Record not found').show();
										}
									},
									error: function() {
										$('#pub-suggestions').html(
											'<p class="text-danger">Error fetching suggestions. Please try again later.</p>'
										);
									}
								});
							} else {
								$('#pub-suggestions').empty();
								$('#pub-message').hide();
							}
						});

						$(document).on('click', '.pub-suggestion-item', function() {
							var selectedId = $(this).data('id');
							var selectedText = $(this).text();
							$('#publisherPrint').val(selectedText);
							$('#pub-selected-id').val(selectedId);
							$('#pub-suggestions').empty();
						});

						// Print Sources
						$.ajax({
							url: '/sources',
							method: 'GET',
							dataType: 'json',
							success: function(data) {
								if (data.length > 0) {
									$.each(data, function(index, source) {
										$('#print_source').append(
											$('<option>', {
												value: source.id,
												text: source.name
											})
										);
									});
								} else {
									$('#print_source').append(
										$('<option>', {
											value: '',
											text: 'No sources available',
											disabled: true
										})
									);
								}
							},
							error: function(xhr, status, error) {
								console.error('Error fetching sources: ' + error);
							}
						});

						// Print Status
						$.ajax({
							url: '/status',
							method: 'GET',
							dataType: 'json',
							success: function(data) {
								if (data.length > 0) {
									$.each(data, function(index, status) {
										$('#print_status').append(
											$('<option>', {
												value: status.id,
												text: status.name
											})
										);
									});
								}
							},
							error: function(xhr, status, error) {
								console.error('Error fetching status: ' + error);
							}
						});

						$('#add_print').on('submit', function(e) {
							e.preventDefault();

							const formData = $(this).serialize();
							console.log(formData);

							$.ajax({
								url: '/add-print-resource',
								method: 'POST',
								data: formData,
								headers: {
									'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
								},
								success: function(response) {
									// Alert the data sent back from the server
									alert('Data Submitted:\n' + JSON.stringify(response.data, null, 2));
								},
								error: function(xhr, status, error) {
									console.error('Error submitting form: ', xhr.responseJSON);
									alert('Error: ' + JSON.stringify(xhr.responseJSON, null, 2));
								},
							});
						});
					});
				</script>
			</div>
			<!-- PRINT TAB END -->

			<!-- NON-PRINT TAB -->
			<div class="tab-pane fade mt-4" id="non-print" role="tabpanel" aria-labelledby="non-print-tab">
				<div class="card my-4 pt-2">
					<div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
						<div class="shadow-dark border-radius-lg pt-3 pb-2" style="background-color: #0071bd">
							<h5 class="text-white text-capitalize ps-3">Non-Print Resource</h5>
						</div>
					</div>
					<div class="card-body">
						<p style="text-align:left;" class="mb-0 text-dark ps-1 mb-0">
							Add new resource, then click Submit.&nbsp;
							<span style="color:red">*</span> - required fields.
						</p>
						<div class="container pt-2" id="non-print-content">
							<div class="container mt-4 mb-2">
								<!-- MODALS -->
								<?php ?>
								<!-- MODALS END-->
							</div>

							<div class="container mt-4" style="max-width: 1000px;">

								<p id="message-nonprint" class="col-12" style="display:none;color:red;"></p>

								<form id="add_nonprint" method="post" class="row g-3">

									<div class="col-md-12">
										<label for="search-nonprint" class="form-label">Title<span class="text-danger">*</span></label>
										<input type="text" class="form-control" id="search-nonprint" name="search-nonprint"
											placeholder="Start typing..." required>
									</div>
									<input type="hidden" id="selected-id-nonprint" name="selected-id-nonprint" required>
									<div id="suggestions-nonprint" class="col-12"></div>

									<div class="col-md-12">
										<label for="non-print_type" class="form-label">Type<span class="text-danger">*</span></label>
										<select id="non-print_type" name="non-print_type" class="form-select" required>
											<option value="" selected disabled>Select Type</option>
										</select>
									</div>

									{{-- <div class="col-md-12">
										<label class="form-label">Subjects<span class="text-danger">*</span></label>
										<div id="temporaryStorage">
											<h6>Selected Subjects:</h6>
											<ul id="subjectList-nonprint"></ul>
										</div>
										<input type="text" id="subjectInput-nonprint" name="subject-nonprint" readonly required />
										<div id="subjects-nonprint" style="padding: 10px;"></div>
									</div> --}}

                                    <div class="col-md-12">
                                        <label for="subject_gradelevel_nonprint" class="form-label">
                                            Subjects and Grade Levels (Non-Print)<span class="text-danger">*</span>
                                        </label>
                                        <div class="container">
                                            <div id="temporaryStorageNonPrint">
                                                <h6>Selected Subjects (Non-Print):</h6>
                                                <ul id="subjectListNonPrint"></ul>
                                            </div>
                                            <input type="text" id="subjectInputNonPrint" name="subjectNonPrint" readonly required />
                                            <div style="max-height: 250px; overflow-y: auto;">
                                                <table class="table table-bordered compact-table-nonprint">
                                                    <thead>
                                                        <tr>
                                                            <th>Subject Title</th>
                                                            <!-- Grade Level Columns will be dynamically added here -->
                                                        </tr>
                                                    </thead>
                                                    <tbody id="subjectsTableNonPrint">
                                                        <!-- Rows will be dynamically populated here -->
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <style>
                                            /* Compact Table Styles */
                                            .compact-table-nonprint th,
                                            .compact-table-nonprint td {
                                                padding: 4px !important;
                                                text-align: left;
                                                font-size: 16px;
                                            }

                                            .compact-table-nonprint th {
                                                white-space: nowrap;
                                                background-color: #f8f9fa;
                                                position: sticky;
                                                top: 0;
                                                z-index: 2;
                                            }

                                            .compact-table-nonprint td input[type="checkbox"] {
                                                width: 16px;
                                                height: 16px;
                                                margin: 0 auto;
                                            }

                                            .compact-table-nonprint {
                                                border-collapse: collapse;
                                            }
                                        </style>

                                        <script>
                                            $(document).ready(function () {
                                                var tempStorageNonPrint = [];

                                                function updateSubjectInputNonPrint() {
                                                    $('#subjectInputNonPrint').val(tempStorageNonPrint.join(','));
                                                }

                                                $.ajax({
                                                    url: '/subjectgradelevels', // Your Laravel route
                                                    method: 'GET',
                                                    success: function (response) {
                                                        const subjects = response.subjects;

                                                        const gradeLevels = ['K', ...Array.from({ length: 12 }, (_, i) => (i + 1).toString())];

                                                        let headerRow = '<th>Subject Title</th>';
                                                        gradeLevels.forEach(grade => {
                                                            headerRow += `<th>${grade}</th>`;
                                                        });
                                                        $('#subjectsTableNonPrint').prev('thead').find('tr').html(headerRow);

                                                        let tableRows = '';
                                                        subjects.forEach(subject => {
                                                            let row = `
                                                                <tr>
                                                                    <td>${subject.SubjectTitle}</td>
                                                            `;

                                                            gradeLevels.forEach((grade, index) => {
                                                                const sourceGrade = index === 0 ? '1' : (index + 1).toString();
                                                                const gradeData = subject.GradeLevels[sourceGrade]
                                                                    ? `<input type="checkbox" class="nonPrintCheckbox" value="${subject.GradeLevels[sourceGrade]}" />`
                                                                    : '';
                                                                row += `<td>${gradeData}</td>`;
                                                            });

                                                            row += '</tr>';
                                                            tableRows += row;
                                                        });

                                                        $('#subjectsTableNonPrint').html(tableRows);

                                                        $('#subjectsTableNonPrint').on('change', 'input[type="checkbox"]', function () {
                                                            var selectedSubjectValue = $(this).val();
                                                            var selectedSubjectText = $(this).closest('tr').find('td:first').text();

                                                            if (this.checked) {
                                                                if (!tempStorageNonPrint.includes(selectedSubjectValue)) {
                                                                    tempStorageNonPrint.push(selectedSubjectValue);
                                                                    $('#subjectListNonPrint').append('<li>' + selectedSubjectText +
                                                                        ' <button type="button" class="btn btn-sm btn-danger removeSubjectNonPrint" data-value="' +
                                                                        selectedSubjectValue + '">Remove</button></li>');
                                                                    updateSubjectInputNonPrint();
                                                                } else {
                                                                    alert('This subject is already added.');
                                                                }
                                                            } else {
                                                                tempStorageNonPrint = tempStorageNonPrint.filter(function (subjectValue) {
                                                                    return String(subjectValue) !== String(selectedSubjectValue);
                                                                });
                                                                $('#subjectListNonPrint').find('button[data-value="' + selectedSubjectValue + '"]').parent().remove();
                                                                updateSubjectInputNonPrint();
                                                            }
                                                        });

                                                        $('#subjectListNonPrint').on('click', '.removeSubjectNonPrint', function () {
                                                            var subjectValueToRemove = String($(this).data('value'));
                                                            tempStorageNonPrint = tempStorageNonPrint.filter(function (subjectValue) {
                                                                return String(subjectValue) !== subjectValueToRemove;
                                                            });
                                                            $('#subjectsTableNonPrint').find('input[value="' + subjectValueToRemove + '"]').prop('checked', false);
                                                            $(this).parent().remove();
                                                            updateSubjectInputNonPrint();
                                                        });
                                                    },
                                                    error: function () {
                                                        alert('Failed to fetch data.');
                                                    }
                                                });
                                            });
                                        </script>
                                    </div>

									<div class="col-md-12">
										<label for="author-nonprint" class="form-label">Author<span class="text-danger">*</span></label>
										<input type="text" class="form-control" id="author-nonprint" name="author-nonprint"
											placeholder="Author">
										<input type="hidden" id="authorInputNonprint" name="selectedAuthorsNonprint">
										<div id="auth-suggestions-nonprint" style="max-height: 200px; overflow-y: auto;"></div>
									</div>

									<div id="temporaryAuthorStorageNonprint">
										<h6>Selected Authors:</h6>
										<ul id="authorListNonprint"></ul>
									</div>
									<input type="text" id="authorIDsNonprint" name="authorIDsNonprint" readonly required />

									<div class="col-md-6">
										<label for="brand" class="form-label">Brand</label>
										<input type="text" class="form-control" id="brand" name="brand" placeholder="Brand">
										<input type="hidden" id="brand-selected-id" name="brand-selected-id">
										<div id="brand-suggestions" class="col-12"></div>
									</div>

									<div class="col-md-6">
										<label for="code" class="form-label">Version Number/Model/Code</label>
										<input type="text" class="form-control" id="code" name="code"
											placeholder="Version Number/Model/Code">
									</div>

									<div class="col-md-6">
										<label for="size" class="form-label">Size/Dimension</label>
										<input type="text" class="form-control" id="size" name="size" placeholder="Size/Dimension">
									</div>

									<div class="col-md-6">
										<label for="link" class="form-label">Link</label>
										<input type="text" class="form-control" id="link" name="link" placeholder="Link" required>
									</div>

									<div class="col-md-6">
										<label for="np_source" class="form-label">Source<span class="text-danger">*</span></label>
										<select id="np_source" name="np_source" class="form-select" required>
											<option value="" selected disabled>Select Source</option>
										</select>
									</div>

									<div class="col-md-6">
										<label for="status-nonprint" class="form-label">Status<span class="text-danger">*</span></label>
										<select id="status-nonprint" name="status-nonprint" class="form-select" required>
											<option value="" selected disabled>Select Status</option>
										</select>
									</div>

									<div class="col-md-6">
										<label for="qty" class="form-label">Quantity<span class="text-danger">*</span></label>
										<input type="number" class="form-control" id="qty" name="qty" min="1" required>
									</div>

									<div class="col-md-6">
										<label for="acqrd" class="form-label">Date Acquired<span class="text-danger">*</span></label>
										<input type="date" class="form-control" id="acqrd" name="acqrd" required>
									</div>

									<div class="col-md-12">
										<label for="remarks" class="form-label">Remarks</label>
										<textarea class="form-control" id="remarks" name="remarks"></textarea>
									</div>

									<div class="col-12 d-flex justify-content-center">
										<button id="add-button" type="submit" class="shadow-dark loginbtn">Add</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<script>
					$(document).ready(function() {
						// Title Search and Selection
						$('#search-nonprint').on('input', function() {
							var query = $(this).val();
							if (query.length > 2) {
								$.ajax({
									url: '/search-titles',
									method: 'GET',
									data: {
										term: query
									},
									success: function(data) {
										if (data.html) {
											$('#suggestions-nonprint').html(data.html);
										} else {
											$('#suggestions-nonprint').html(
												'<p>No results found. Add the title first.</p>');
										}
									},
									error: function(xhr, status, error) {
										console.error('An error occurred:', error);
									}
								});
							} else {
								$('#suggestions-nonprint').empty();
							}
						});

						$(document).on('click', '.suggestion-item', function() {
							var selectedId = $(this).data('id');
							var selectedText = $(this).text();
							$('#search-nonprint').val(selectedText);
							$('#selected-id-nonprint').val(selectedId);
							$('#suggestions-nonprint').empty();
						});

						// Nonprint Types Dropdown
						$.ajax({
							url: '/nonprint-types',
							method: 'GET',
							dataType: 'json',
							success: function(data) {
								if (data.length > 0) {
									$.each(data, function(index, type) {
										$('#non-print_type').append(
											$('<option>', {
												value: type.id,
												text: type.type_name
											})
										);
									});
								}
							},
							error: function(xhr, status, error) {
								console.error('Error fetching print types: ' + error);
							}
						});

						// Subject Grade Level
						$.ajax({
							url: '/subjectgradelevel',
							type: 'GET',
							success: function(response) {
								if (response.subjects) {
									const subjectsContainer = $('#subjects-nonprint');
									subjectsContainer.empty();
									subjectsContainer.css({
										display: 'grid',
										gridTemplateColumns: 'repeat(3, 1fr)',
										gap: '10px',
										maxHeight: '250px',
										overflowY: 'auto',
										border: '1px solid #ccc',
										padding: '2px',
									});
									$.each(response.subjects, function(index, subject) {
										const checkbox = $('<input>', {
											type: 'checkbox',
											id: `subject-nonprint-${subject.subjectgradelevel_id}`,
											name: 'subjects[]',
											value: subject.subjectgradelevel_id
										});
										const label = $('<label>', {
											for: `subject-nonprint-${subject.subjectgradelevel_id}`,
											text: `${subject.subject_title} ${subject.gradelevel_shortcode}`
										});
										const div = $('<div>').append(checkbox, label);
										subjectsContainer.append(div);
									});
								}
							},
							error: function(xhr, status, error) {
								console.error("Error fetching data:", error);
							}
						});

						// Subject Selection Management
						var tempStorageNonprint = [];

						function updateSubjectInputNonprint() {
							$('#subjectInput-nonprint').val(tempStorageNonprint.join(','));
						}

						$('#subjects-nonprint').on('change', 'input[type="checkbox"]', function() {
							var selectedSubjectValue = $(this).val();
							var selectedSubjectText = $(this).siblings('label').text();

							if (this.checked) {
								if (!tempStorageNonprint.includes(selectedSubjectValue)) {
									tempStorageNonprint.push(selectedSubjectValue);
									$('#subjectList-nonprint').append(
										'<li>' +
										selectedSubjectText +
										' <button type="button" class="btn btn-sm btn-danger removeSubject" data-value="' +
										selectedSubjectValue + '">Remove</button></li>'
									);
									updateSubjectInputNonprint();
								} else {
									alert('This subject is already added.');
								}
							} else {
								// Remove from tempStorageNonprint and UI when checkbox is unchecked
								tempStorageNonprint = tempStorageNonprint.filter(function(subjectValue) {
									return String(subjectValue) !== String(selectedSubjectValue);
								});
								$('#subjectList-nonprint').find('button[data-value="' + selectedSubjectValue + '"]')
									.parent().remove();
								updateSubjectInputNonprint();
							}
						});

						$('#subjectList-nonprint').on('click', '.removeSubject', function() {
							var subjectValueToRemove = String($(this).data('value'));
							tempStorageNonprint = tempStorageNonprint.filter(function(subjectValue) {
								return String(subjectValue) !== subjectValueToRemove;
							});
							$('#subjects-nonprint').find('input[value="' + subjectValueToRemove + '"]').prop('checked',
								false); // Uncheck the corresponding checkbox
							$(this).parent().remove();
							updateSubjectInputNonprint();
						});


						// Author Search and Selection
						const selectedNonprintAuthors = [];

						function updateNonprintAuthorInput() {
							$('#authorInputNonprint').val(selectedNonprintAuthors.join(','));
						}

						$('#author-nonprint').on('input', function() {
							var query = $(this).val();
							if (query.length > 2) {
								$.ajax({
									url: '/search-authors',
									method: 'GET',
									data: {
										term: query
									},
									success: function(response) {
										if (response.html.trim()) {
											$('#auth-suggestions-nonprint').html(response.html);
										} else {
											$('#auth-suggestions-nonprint').html(
												'<p>No authors found. Add the author first.</p>');
										}
									},
									error: function() {
										$('#auth-suggestions-nonprint').html(
											'<p>Error fetching suggestions. Please try again later.</p>');
									}
								});
							} else {
								$('#auth-suggestions-nonprint').empty();
							}
						});

						$('#auth-suggestions-nonprint').on('click', '.auth-suggestion-item', function() {
							const authorId = $(this).data('id');
							const authorName = $(this).text();

							if (authorId && !selectedNonprintAuthors.includes(authorId.toString())) {
								selectedNonprintAuthors.push(authorId.toString());
								$('#authorListNonprint').append(`
                                        <li>${authorName}
                                            <button type="button" class="btn btn-sm btn-danger removeAuthorNonprint" data-id="${authorId}">Remove</button>
                                        </li>
                                    `);
								updateNonprintAuthorInput();
								$('#author-nonprint').val('');
								$('#auth-suggestions-nonprint').empty();
							} else {
								alert('This author is already selected or invalid.');
							}
						});

						$('#authorListNonprint').on('click', '.removeAuthorNonprint', function() {
							const authorId = $(this).data('id');
							const index = selectedNonprintAuthors.indexOf(authorId.toString());
							if (index !== -1) {
								selectedNonprintAuthors.splice(index, 1);
								$(this).parent().remove();
								updateNonprintAuthorInput();
							}
						});

						// Brand Search
						$('#brand').on('input', function() {
							var query = $(this).val();
							if (query.length > 2) {
								$.ajax({
									url: '/search-brands',
									method: 'GET',
									data: {
										term: query
									},
									success: function(response) {
										if (response.html.trim()) {
											$('#brand-suggestions').html(response.html);
											$('#brand-message').hide();
										} else {
											$('#brand-suggestions').empty();
											$('#brand-message').text('Record not found').show();
										}
									},
									error: function() {
										$('#brand-suggestions').html(
											'<p class="text-danger">Error fetching suggestions. Please try again later.</p>'
										);
									}
								});
							} else {
								$('#brand-suggestions').empty();
								$('#brand-message').hide();
							}
						});

						$(document).on('click', '.brand-suggestion-item', function() {
							var selectedId = $(this).data('id');
							var selectedText = $(this).text();
							$('#brand').val(selectedText);
							$('#brand-selected-id').val(selectedId);
							$('#brand-suggestions').empty();
						});

						// Sources Dropdown
						$.ajax({
							url: '/sources',
							method: 'GET',
							dataType: 'json',
							success: function(data) {
								if (data.length > 0) {
									$.each(data, function(index, source) {
										$('#np_source').append(
											$('<option>', {
												value: source.id,
												text: source.name
											})
										);
									});
								} else {
									$('#np_source').append(
										$('<option>', {
											value: '',
											text: 'No sources available',
											disabled: true
										})
									);
								}
							},
							error: function(xhr, status, error) {
								console.error('Error fetching sources: ' + error);
							}
						});

						// Status Dropdown
						$.ajax({
							url: '/status',
							method: 'GET',
							dataType: 'json',
							success: function(data) {
								if (data.length > 0) {
									$.each(data, function(index, status) {
										$('#status-nonprint').append(
											$('<option>', {
												value: status.id,
												text: status.name
											})
										);
									});
								}
							},
							error: function(xhr, status, error) {
								console.error('Error fetching status: ' + error);
							}
						});
					});
				</script>

			</div>
			<!-- NON-PRINT TAB END -->
			<!-- ```````````````````````````````````````````````````````````````````````````````````` -->
			<!-- EXCEL FILE UPLOAD -->

			<div class="tab-content" id="myTabContent">
    		<div class="tab-pane show active fade mt-4" id="print" role="tabpanel" aria-labelledby="print-tab">
        		<div class="card my-4 pt-2">
            		<div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                		<div class="shadow-dark border-radius-lg pt-3 pb-2" style="background-color: #0071bd">
                    		<h5 class="text-white text-capitalize ps-3">Upload Learning Resources</h5>
                		</div>
            		</div>
            			<div class="card-body">

						<!-- Download Excel Template -->
                		<p style="text-align:right;" class="mb-3">
							<!-- pathhhhh for excel -->
							<a href="{{asset("assets/EXCEL/SAMPLE_TEMPLATE.xlsx")}}" download class="btn btn-secondary" style="background-color: #FFCD90; color: black;">
                        		Download BLR Excel Template
                    		</a>
                		</p>	
                			

                	<!-- Upload Excel Form -->
					<p style="text-align:left;" class="mb-0 text-dark ps-1 mb-0"> Upload your excel file here, then click Submit. </p>
                	<form id="uploadForm" enctype="multipart/form-data">
                    	<div class="mb-3">    
                        		<!-- <label for="excelFile" class="form-label text-dark"> <span style="color:red">*</span> - required fields</label>  -->  
                        		<input type="file" class="form-control" id="excelFile" name="excelFile" accept=".xls,.xlsx" required>
                        		<div id="fileHelp" class="form-text">Only .xls or .xlsx files are allowed.</div>
                    	</div>

                    	<div class="d-flex justify-content-end">
                        		<button type="submit" class="btn btn-primary">Submit</button>
                    	</div>
                	</form>
            	</div>
        	</div>
    	</div>
		</div>

			<!-- EXCEL FILE UPLOAD END-->
			<!-- ```````````````````````````````````````````````````````````````````````````````````` -->


		</div>

	</div>
	</div>

	<script>
		$(document).ready(function() {
			$('#myTab button[data-bs-toggle="tab"]').on('shown.bs.tab', function(event) {
				console.log(`Active tab: ${event.target.id}`);
			});

			const savedTab = localStorage.getItem("activeTab");
			const defaultTab = "#print";

			if (savedTab) {
				$(`[data-bs-target="${savedTab}"]`).tab('show');
			} else {
				$(`[data-bs-target="${defaultTab}"]`).tab('show');
			}

			$('a[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
				const activeTab = $(e.target).data('bs-target');
				localStorage.setItem("activeTab", activeTab);
			});
		});
	</script>

	<style>
		@media only screen and (max-width: 600px) {
			.scroll-bar {
				border-radius: 20px;
				width: 280px;
				height: 100%;
				overflow-x: scroll;
			}
		}
	</style>
	<style>
		#suggestions,
		#suggestions-nonprint {
			border: 1px solid #ddd;
			max-height: 200px;
			overflow-y: auto;
		}

		.suggestion-item,
		.auth-suggestion-item,
		.pub-suggestion-item,
		.brand-suggestion-item {
			padding: 8px;
			cursor: pointer;
		}

		.suggestion-item:hover,
		.auth-suggestion-item:hover,
		.pub-suggestion-item:hover,
		.brand-suggestion-item:hover {
			background-color: #f0f0f0;
		}

		#message,
		#auth-message,
		#pub-message,
		#brand-message {
			margin-top: 10px;
		}

		#brand-suggestions {
			max-height: 200px;
			overflow-y: auto;
			background-color: #f9f9f9;
		}

        #subjects-gradelevels {
    width: 100%;
    overflow-x: auto;
    position: relative;
}

.table-subjects {
    width: 100%;
    border-collapse: collapse;
    table-layout: fixed;
}

.table-subjects thead {
    display: table;
    width: 100%;
    background-color: #fff;
}

.table-subjects thead th {
    background-color: #fff;
    position: sticky;
    top: 0;
    z-index: 2;
    padding: 2px;
    border: 1px solid #ccc;
    text-align: center;
}

.table-subjects tbody {
    display: block;
    width: 100%;
    height: 300px; /* Set a fixed height for tbody */
    overflow-y: auto;
    table-layout: fixed;
}

.table-subjects tbody tr {
    display: table;
    width: 100%;
    table-layout: fixed;
}

.table-subjects td {
    padding: 2px;
    border: 1px solid #ccc;
    text-align: center;
}

.table-subjects th.subject-title-header,
.table-subjects td.subject-title {
    position: sticky;
    left: 0;
    background-color: #fff;
    z-index: 1;
    text-align: left;
}

.table-subjects tbody::-webkit-scrollbar {
    width: 8px;
}

.table-subjects tbody::-webkit-scrollbar-thumb {
    background-color: #ccc;
    border-radius: 4px;
}

.table-subjects tbody::-webkit-scrollbar-track {
    background-color: #f9f9f9;
}

	</style>
@endsection

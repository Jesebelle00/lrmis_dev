@extends('layout.layout')
@section('content')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="{{ asset('assets/css/datatable.custom.css') }}">
	<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>

    <div class="container">
        <h1>School Profiles</h1>
            @if ($profileService->Level === "1")
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Add Region</button>
            @elseif ($profileService->Level === "2")
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Add SDO</button>
            @elseif ($profileService->Level === "3")
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Add District</button>
            @elseif ($profileService->Level === "4")
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Add School</button>
            @else

            @endif
        <div class="table-responsive">
            <table id="user-profile-table" class="table table-bordered nowrap" style="width: 100%;">
                <thead>
                    <tr>
                        <th>School Name</th>
                        <th>District Name</th>
                        <th>Division Name</th>
                        <th>Region Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    <!-- Add District Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">
                        @switch($profileService->Level)
                            @case("1")
                                Add Region
                                @break
                            @case("2")
                                Add SDO
                                @break
                            @case("3")
                                Add District
                                @break
                            @case("4")
                                Add School
                                @break
                            @default
                                Invalid Level
                        @endswitch
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="action-container">
                        @switch($profileService->Level)
                            @case("1")
                                <!-- Add Region Form -->
                                <form id="addRegionForm" method="POST" action="">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="regionName" class="form-label">Region Name</label>
                                        <input type="text" class="form-control" id="regionName" name="regionName" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Save Region</button>
                                </form>
                                @break

                            @case("2")
                                <!-- Add SDO Form -->
                                <form id="addSdoForm" method="POST" action="">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="sdoName" class="form-label">SDO Name</label>
                                        <input type="text" class="form-control" id="sdoName" name="sdoName" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Save SDO</button>
                                </form>
                                @break

                            @case("3")
                                <!-- Add District Form -->
                                <form id="addDistrictForm" method="POST" action="">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="districtName" class="form-label">District Name</label>
                                        <input type="text" class="form-control" id="districtName" name="districtName" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Save District</button>
                                </form>
                                @break

                            @case("4")
                                <!-- Add School Form -->
                                <form id="addSchoolForm" method="POST" action="">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="schoolName" class="form-label">School Name</label>
                                        <input type="text" class="form-control" id="schoolName" name="schoolName" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Save School</button>
                                </form>
                                @break

                            @default
                                <p>Invalid Level</p>
                        @endswitch
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            $('#user-profile-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('station-profile.data') }}",
                scrollX: true,
                columns: [
                    { data: 'school_name' },
                    { data: 'district_name' },
                    { data: 'division_name' },
                    { data: 'region_name' },
                    {
                        data: 'actions',
                        orderable: false,
                        searchable: false,
                        className: 'text-center'
                    }
                ],
                responsive: false,
                language: {
                    emptyTable: "No data available in the table"
                }
            });
        });

        function editStation(stationId) {
            alert("Edit button clicked for Station ID: " + stationId);

        }

        function deleteStation(stationId) {
            if (confirm("Are you sure you want to delete this station?")) {
                alert("Delete button clicked for Station ID: " + stationId);
            }
        }
    </script>

@endsection


@extends('layout.layout')
@section('content')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="{{ asset('assets/css/datatable.custom.css') }}">
	<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
    <div class="container">
        <h1>User Profiles</h1>
        {{-- <!-- Add User Button -->
        @if ($profileService->Level === "1")
            <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addUserModal">Add Region Account</button>
        @elseif ($profileService->Level === "2")
            <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addUserModal">Add SDO Account</button>
        @elseif ($profileService->Level === "3")
            <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addUserModal">Add District Account</button>
        @elseif ($profileService->Level === "4")
            <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addUserModal">Add School Account</button>
        @else

        @endif --}}

        <div class="table-responsive">
            <table id="user-profile-table" class="table table-bordered nowrap" style="width: 100%;">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>User Type Name</th>
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

    {{-- <!-- Add User Modal -->
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Add User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Add User Form -->
                    <form id="addUserForm">
                        <!-- Form fields based on Level -->
                        @switch($profileService->Level)
                            @case("1")
                                <div class="mb-3">
                                    <label for="region" class="form-label">Region</label>
                                    <input type="text" class="form-control" id="region" name="region" required>
                                </div>
                                @break
                            @case("2")
                                <div class="mb-3">
                                    <label for="sdo" class="form-label">SDO</label>
                                    <input type="text" class="form-control" id="sdo" name="sdo" required>
                                </div>
                                @break
                            @case("3")
                                <div class="mb-3">
                                    <label for="district" class="form-label">District</label>
                                    <input type="text" class="form-control" id="district" name="district" required>
                                </div>
                                @break
                            @case("4")
                                <div class="mb-3">
                                    <label for="school" class="form-label">School</label>
                                    <input type="text" class="form-control" id="school" name="school" required>
                                </div>
                                @break
                            @default
                                <!-- You can add a default case if needed -->
                        @endswitch

                        <button type="submit" class="btn btn-primary">Add User</button>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- Edit User Modal -->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Edit User Form -->
                    <form id="editUserForm">
                        <div class="mb-3">
                            <label for="editUsername" class="form-label">Username</label>
                            <input type="text" class="form-control" id="editUsername" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="editUserType" class="form-label">User Type</label>
                            <input type="text" class="form-control" id="editUserType" name="user_type_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="editSchoolName" class="form-label">School Name</label>
                            <input type="text" class="form-control" id="editSchoolName" name="school_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="editDistrictName" class="form-label">District Name</label>
                            <input type="text" class="form-control" id="editDistrictName" name="district_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="editDivisionName" class="form-label">Division Name</label>
                            <input type="text" class="form-control" id="editDivisionName" name="division_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="editRegionName" class="form-label">Region Name</label>
                            <input type="text" class="form-control" id="editRegionName" name="region_name" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#user-profile-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('user-profile.data') }}",
                scrollX: true,
                columns: [
                    { data: 'username' },
                    { data: 'user_type_name' },
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

        function editUser(stationId) {
            alert("Edit button clicked for Station ID: " + stationId);
        }

        function deleteUser(stationId) {
            alert("Delete button clicked for Station ID: " + stationId);
        }

        function toggleStatus(stationId) {
            alert("Toggle Status button clicked for Station ID: " + stationId);
        }
    </script>

<style>
    table td .btn {
        display: inline-block;
        margin: 0 5px;
    }
</style>

@endsection


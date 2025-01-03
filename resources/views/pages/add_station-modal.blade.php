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
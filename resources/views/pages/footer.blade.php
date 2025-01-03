<script>
    $(document).ready(function() {
        $('#user-profile-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('station-profile.data') }}",
            scrollX: true,
            columns: [
                { data: 'school_name', className: 'text-truncate' },
                { data: 'district_name', className: 'text-truncate' },
                { data: 'division_name', className: 'text-truncate' },
                { data: 'region_name', className: 'text-truncate' },
                {
                    data: 'actions',
                    orderable: false,
                    searchable: false,
                    className: 'text-center'
                }
            ],
            responsive: false,
            lengthMenu: [5, 10, 20, 50, 100],
            pageLength: 5,
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

<!-- Datables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="{{ asset('assets/css/datatable.custom.css') }}">
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">
<script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>

<!-- <script>
    // Function to manage the carousel arrows (toggle appearance and behavior)
    function toggleArrows() {
        document.querySelectorAll('.carousel-control-prev, .carousel-control-next').forEach(function(arrow) {
            // Add the black color class
            arrow.classList.add('icon-black');

            // After 2 seconds, hide the arrow
            setTimeout(function() {
                arrow.classList.remove('icon-black'); // Remove the black color
                arrow.classList.add('icon-hidden');  // Make the arrow disappear
            }, 2000);

            // After 3 seconds (total of 5 seconds), show the arrow again
            setTimeout(function() {
                arrow.classList.remove('icon-hidden'); // Show the arrow again
            }, 5000);
        });
    }

    // Call the toggleArrows function every 10 seconds
    setInterval(toggleArrows, 10000); // 10000ms = 10 seconds
</script> -->
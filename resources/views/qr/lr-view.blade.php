<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bootstrap DataTable</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- DataTables CSS -->
  <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
  <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

  <!-- Font Awesome CDN -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<!-- Custom CSS for styling -->
<!-- Font Awesome CDN -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<!-- Custom CSS for styling -->
<link rel="stylesheet" href="{{ asset('assets/css/qr/style.css') }}">

</head>
<body>
  <div class="container mt-5">
    <h2 class="mb-4">DataTable Example</h2>

    <!-- Button to trigger QR code scanner -->
    <button class="btn btn-success scan-qr-btn" id="scanQrBtn">Scan QR Code</button>

    <!-- The Modal for QR code scanner -->
    <div class="modal" id="qrModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Scan QR Code</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="closeModalBtn"></button>
          </div>
          <div class="modal-body">
            <!-- QR Code Scanner will be shown here -->
            <div id="reader"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" id="close" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>


    <!-- Data Table -->
    <table id="example" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Actions</th>
                    <th>Type</th>
                    <th>Title</th>
                    <th>Subject Area</th>
                    <th>level</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $lr)
                    <tr>
                        <td>
                            <!-- View Button -->
                            <a href="{{ route('lr.show', ['id' => $lr->lr_id]) }}" class="btn btn-primary" title="View Details">
                                <i class="fas fa-eye"></i> View
                            </a>

                            <!-- Print QR Code Button -->
                            <a href="#" id={{$lr->lr_id}} class="btn btn-success printQR" title="Print QR Code">
                                <i class="fas fa-print"></i> Print QR
                            </a>
                        </td>
                        <td>{{ $lr->type_name }}</td>
                        <td>{{ $lr->title }}</td>
                        <td>{{ $lr->subject_title }}</td>
                        <td>{{ $lr->grade_level }}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>

  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <!-- DataTables JS -->
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

  <script>
    // Initialize the DataTable
    $(document).ready(function () {
      $('#example').DataTable();
    });


    // Show QR Code modal when the "Scan QR Code" button is clicked
    document.getElementById("scanQrBtn").addEventListener("click", function() {
      $('#qrModal').modal('show');  // Show the modal
      startQrScanner();
    });

    // Close the modal and stop the QR scanner
    document.getElementById("closeModalBtn").addEventListener("click", function() {
        stopQrScanner();
      $('#qrModal').modal('hide');  // Hide the modal

    });
    document.getElementById("close").addEventListener("click", function() {
        stopQrScanner();
    });

    const html5QrCode = new Html5Qrcode("reader");

    function startQrScanner() {

        const qrCodeSuccessCallback = (decodedText, decodedResult) => {
            /* handle success */
            // Log the decoded text for debugging
            console.log(`Decoded text: ${decodedText}`);

            if (decodedText) {
                // Replace `routeName` with your actual Laravel route name
                const url = `${decodedText}`;

                // Redirect to the generated URL
                window.location.href = url;
            }
        };
        const config = { fps: 10, qrbox: { width: 250, height: 250 } };

        // If you want to prefer back camera
        html5QrCode.start({ facingMode: "environment" }, config, qrCodeSuccessCallback);

    }

    function stopQrScanner(){
        html5QrCode.stop()
            .then(() => {
                console.log("QR Code scanning stopped.");
            })
            .catch((err) => {
                console.error("Error stopping QR Code scanning:", err);
            });
    }

    const printQR = document.querySelectorAll('.printQR');

    // Attach click event listener to each printQR element
    printQR.forEach(item => {
    item.addEventListener('click', async (e) => {
        // Prevent default behavior for anchor tag
        e.preventDefault();

        // Retrieve the id from the data-id attribute
        const lrID = e.target.getAttribute('id');

        if (lrID) {
            try {
                // Send GET request to the server with the id as a query parameter
                const response = await fetch(`/status?id=${lrID}`);

                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }

                // Parse the JSON response
                const data = await response.json();

                // Check if QR code URL exists and use it
                if (data.qr_code_url) {
                    let qrCodeContent = `<img src="${data.qr_code_url}" alt="">`;
                    // Insert the QR code image URL into your HTML (for example)

                    // Create a new window or iframe to isolate the QR codes for printing
                    const printWindow = window.open('', '', 'width=600,height=400');

                    // Write the HTML content to the new window
                    printWindow.document.open();
                    printWindow.document.write('<html><head><title>Print QR Codes</title>');

                    // Add CSS to style the print layout
                    printWindow.document.write('<style>body{font-family: Arial, sans-serif; text-align: center; padding: 20px;}');
                    printWindow.document.write('.qr-grid { display: grid; grid-template-columns: repeat(4, 1fr); grid-gap: 20px; justify-content: center; }');
                    printWindow.document.write('.qr-code { width: 120px; height: 120px; background-color: #f0f0f0; border: 1px solid #ccc; padding: 10px; box-sizing: border-box; }');
                    printWindow.document.write('.qr-code img { width: 100%; height: 100%; object-fit: contain; }');
                    printWindow.document.write('</style>');
                    printWindow.document.write('</head><body>');
                    printWindow.document.write('<h2>QR Codes</h2>');

                    // Create a grid with 24 QR codes (6x4 grid)
                    printWindow.document.write('<div class="qr-grid">');
                    for (let row = 0; row < 6; row++) {  // 6 rows
                        for (let col = 0; col < 4; col++) {  // 4 columns
                            printWindow.document.write('<div class="qr-code">' + qrCodeContent + '</div>');
                        }
                    }
                    printWindow.document.write('</div>');
                    printWindow.document.write('</body></html>');
                    printWindow.document.close();

                    // Wait for the content to load and then trigger the print dialog
                    printWindow.onload = function () {
                        printWindow.print();
                        printWindow.close();
                    };



                } else {
                    console.error('QR code URL not found in the response.');
                }

            } catch (error) {
                console.error('Error fetching status:', error);
            }
        } else {
            console.error('ID not found!');
        }
    });
});



  </script>

<!-- <script src="{{ asset('assets/js/qr/instascan.min.js') }}"></script> -->
<!-- <script src="{{ asset('assets/js/qr/scanner.js') }}"></script> -->


</body>
</html>

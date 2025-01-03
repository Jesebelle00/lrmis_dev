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
  <style>
    /* Position the Scan QR Code button at the top right */
    .scan-qr-btn {
      position: fixed;
      top: 20px;
      right: 20px;
      z-index: 1000;
    }

    /* Modal styling */
    #reader {
      width: 100%;
      height: 400px;
    }
  </style>
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
          <th>ID</th>
          <th>Type</th>
          <th>Title</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($LrList as $lr)
          <tr>
            <td>{{ $lr->id }}</td>
            <td>{{ $lr->typeName->type_name }}</td>
            <td>{{ $lr->title->name }}</td>
            <td>
              <!-- Button with route to 'lr.show' passing $lr->id -->
              <a href="{{ route('lr.show', ['id' => $lr->id]) }}" class="btn btn-primary">View</a>
            </td>
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


  </script>
</body>
</html>

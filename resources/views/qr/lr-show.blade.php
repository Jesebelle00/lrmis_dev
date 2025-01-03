<!-- resources/views/items/show.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item Details</title>
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

    <!-- Custom Styling for Print Button -->
    <style>
        .print-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .print-btn:hover {
            background-color: #0056b3;
        }

        .qr-code-container {
            margin-bottom: 30px;
            text-align: center; /* Center the QR code */
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <div class="row justify-content-center">
            <!-- Card for displaying item data -->
            <div class="col-md-8">
                <div class="card shadow-lg">
                    <div class="row no-gutters">
                        <!-- Image Section -->
                        <div class="col-md-4">
                            <img src="{{ asset('images/naga.png') }}" alt="{{ $lr->typeName->type_name }}" class="img-fluid rounded-start" style="height: 100%; object-fit: cover;">
                        </div>
                        <!-- Item Details Section -->
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{ $lr->title->name }}</h5>
                                <p class="card-text">
                                    <strong>Type:</strong> {{ $lr->typeName->type_name }} <!-- Assuming you have a relationship with the Type model -->
                                </p>

                                <!-- Display QR Code -->
                                <strong>QR Code for this Item:</strong>
                                <div class="qr-code-container">
                                    {!! $qrCode !!} <!-- Display the QR code directly here -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Back Button -->
        <div class="text-center mt-4">
            <a href="{{ route('lr.index') }}" class="btn btn-secondary">Back to Items</a>
        </div>
    </div>
<!-- Print QR Code Button -->
<button class="print-btn no-print" onclick="printQRCode()">Print QR Code</button>

<!-- JavaScript for Print Functionality -->
<script>
    // Function to print QR codes in a 6x4 grid
    function printQRCode() {
        // Get the content of the QR code container
        const qrCodeContent = document.querySelector('.qr-code-container').innerHTML;

        // Create a new window or iframe to isolate the QR codes for printing
        const printWindow = window.open('', '', 'width=600,height=400');

        // Write the HTML content to the new window
        printWindow.document.open();
        printWindow.document.write('<html><head><title>Print QR Codes</title>');
        printWindow.document.write('<style>body{font-family: Arial, sans-serif; text-align: center;}');
        printWindow.document.write('.qr-code {display: inline-block; margin: 10px; width: 120px; height: 120px;}');
        printWindow.document.write('</style>');
        printWindow.document.write('</head><body>');
        printWindow.document.write('<h2>QR Codes</h2>');

        // Add 24 QR codes in a 6x4 grid
        for (let row = 0; row < 6; row++) {  // 6 rows
            for (let col = 0; col < 4; col++) {  // 4 columns
                printWindow.document.write('<div class="qr-code">' + qrCodeContent + '</div>');
            }
            printWindow.document.write('<br style="clear: both;">'); // Line break after each row
        }

        printWindow.document.write('</body></html>');
        printWindow.document.close();

        // Wait for the content to load and then trigger the print dialog
        printWindow.onload = function () {
            printWindow.print();
            printWindow.close();
        };
    }
</script>


</body>
</html>

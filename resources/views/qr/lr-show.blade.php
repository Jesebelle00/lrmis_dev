<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LR Details</title>

    <!-- Font Awesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <!-- Custom CSS for styling -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fa;
            color: #333;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .details-card {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .details-card h3 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #007bff;
        }

        .details-card .row {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }

        .details-card .col {
            flex: 1 1 calc(33.33% - 15px);
            min-width: 250px;
            margin-bottom: 10px;
        }

        .details-card .label {
            font-weight: bold;
            color: #555;
        }

        .details-card .value {
            color: #333;
        }

        .details-card .value span {
            color: #007bff;
        }

        /* QR Code Section */
        .qr-section {
            margin-top: 30px;
            text-align: center;
        }

        .qr-code {
            display: block;
            margin: 0 auto 20px auto; /* Ensures the QR code is centered and gives space below it */
        }

        /* Print Button */
        .print-btn {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
        }

        .print-btn:hover {
            background-color: #218838;
        }

        /* Responsive Layout */
        @media (max-width: 768px) {
            .details-card .col {
                flex: 1 1 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="details-card">
            <h3>LR Details</h3>
            <div class="row">
                <div class="col">
                    <div><span class="label">LR ID:</span> <span class="value">{{ $lr->lr_id }}</span></div>
                    <div><span class="label">Station ID:</span> <span class="value">{{ $lr->station_id }}</span></div>
                    <div><span class="label">District:</span> <span class="value">{{ $lr->district }}</span></div>
                    <div><span class="label">Division:</span> <span class="value">{{ $lr->division }}</span></div>
                    <div><span class="label">Region:</span> <span class="value">{{ $lr->region }}</span></div>
                    <div><span class="label">Shortname:</span> <span class="value">{{ $lr->shortname }}</span></div>
                </div>
                <div class="col">
                    <div><span class="label">Station Name:</span> <span class="value">{{ $lr->station_name }}</span></div>
                    <div><span class="label">Station Type Code:</span> <span class="value">{{ $lr->station_type_code }}</span></div>
                    <div><span class="label">Type Name:</span> <span class="value">{{ $lr->type_name }}</span></div>
                    <div><span class="label">Category:</span> <span class="value">{{ $lr->category }}</span></div>
                    <div><span class="label">Title:</span> <span class="value">{{ $lr->title }}</span></div>
                    <div><span class="label">Type Name Shortcode:</span> <span class="value">{{ $lr->type_name_shortcode }}</span></div>
                </div>
                <div class="col">
                    <div><span class="label">Subject Title:</span> <span class="value">{{ $lr->subject_title }}</span></div>
                    <div><span class="label">Subject Shortcode:</span> <span class="value">{{ $lr->subject_shortcode }}</span></div>
                    <div><span class="label">Grade Level:</span> <span class="value">{{ $lr->grade_level }}</span></div>
                    <div><span class="label">Population:</span> <span class="value">{{ $lr->population }}</span></div>
                    <div><span class="label">Circular Class Name:</span> <span class="value">{{ $lr->circular_class_name }}</span></div>
                    <div><span class="label">Status:</span> <span class="value">{{ $lr->status }}</span></div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div><span class="label">Publisher ID:</span> <span class="value">{{ $lr->publisher_id }}</span></div>
                    <div><span class="label">Volume:</span> <span class="value">{{ $lr->volume }}</span></div>
                    <div><span class="label">Copyright Year:</span> <span class="value">{{ $lr->copyrightyear }}</span></div>
                    <div><span class="label">Pages:</span> <span class="value">{{ $lr->pages }}</span></div>
                </div>
                <div class="col">
                    <div><span class="label">ISBN:</span> <span class="value">{{ $lr->isbn }}</span></div>
                    <div><span class="label">Date Updated:</span> <span class="value">{{ $lr->date_update }}</span></div>
                    <div><span class="label">Updated By:</span> <span class="value">{{ $lr->updated_by }}</span></div>
                </div>
                <div class="col">
                    <div><span class="label">Publisher Name:</span> <span class="value">{{ $lr->publisher_name }}</span></div>
                    <div><span class="label">Source Name:</span> <span class="value">{{ $lr->source_name }}</span></div>
                    <div><span class="label">Source Shortcode:</span> <span class="value">{{ $lr->source_shortcode }}</span></div>
                    <div><span class="label">Quantity:</span> <span class="value">{{ $lr->qty }}</span></div>
                </div>
            </div>

            <!-- QR Code Section -->
            <div class="qr-section">
                <h4>QR Code</h4>
                <!-- QR Code Image (Placeholder for now) -->
                <div id="qrcode" class="qr-code">
                    <!-- {!! $qrCode !!} -->
                    <img src="{!! $qrCode !!}" alt="qr-code">
                </div>

                <!-- Button to print QR code, placed below the QR Code -->
                <button class="print-btn" onclick="printQRCode()">Print QR Code</button>
            </div>
        </div>
    </div>

    <!-- JavaScript for Print Functionality -->
    <script>
    // Function to print QR codes in a 6x4 grid with space between them
    function printQRCode() {
        // Get the content of the QR code container
        const qrCodeContent = document.querySelector('.qr-code').innerHTML;

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
    }
</script>

</body>
</html>

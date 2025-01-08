/*
const generatorTab = document.querySelector('.nav-gene');
const scannerTab = document.querySelector('.nav-scan');
const geneDiv = document.querySelector('.generator');
const scanDiv = document.querySelector('.scanner');


generatorTab.addEventListener('click', () => {
    generatorTab.classList.add('active');
    scannerTab.classList.remove('active');

    geneDiv.style.display = "block";
    scanDiv.style.display = "none";
});



scannerTab.addEventListener('click', () => {
    scannerTab.classList.add('active');
    generatorTab.classList.remove('active');

    scanDiv.style.display = "block";
    geneDiv.style.display = "none"
});


 */

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




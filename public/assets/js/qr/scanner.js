
const scannerDiv = document.querySelector('.scanner');
    const camera    =   scannerDiv.querySelector('h1 .fa-camera');
    const stopCam   =   scannerDiv.querySelector('h1 .fa-circle-stop');
    const form      =   scannerDiv.querySelector('.scanner-form');
        const fileInput =   form.querySelector('input');
        const p         =   form.querySelector('p');
        const img       =   form.querySelector('img');
        const video     =   form.querySelector('video');
        const content   =   form.querySelector('.content');
    const textarea  =   scannerDiv.querySelector('.scanner-details textarea');
    const copyBtn   =   scannerDiv.querySelector('.scanner-details .copy');
    const closeBtn  =   scannerDiv.querySelector('.scanner-details .close');


// Functions
const fetchRequest = async (file) => {
    const formData = new FormData();
    formData.append("file", file);

    // Update the UI text
    p.innerText = "Scanning QR Code...";

    try {
        // Fetch data from GoQR API
        const response = await fetch("http://api.qrserver.com/v1/read-qr-code/", {
            method: "POST",
            body: formData,
        });

        // Check for successful response
        if (!response.ok) {
            throw new Error("Failed to fetch QR code data");
        }

        const result = await response.json();

        // Extract QR code data from the response
        const text = result[0]?.symbol[0]?.data; // Optional chaining to avoid runtime errors

        if (!text) {
            throw new Error("No QR code data found");
        }

        return text; // Return QR code text
    } catch (error) {
        console.error("Error scanning QR code:", error);
        p.innerText = "Error scanning QR code."; // Show error message to user
        return null;
    }
};

// Input file trigger
form.addEventListener("click", () => fileInput.click());

// Scan QR Code image
fileInput.addEventListener("change", async (e) => {
    const file = e.target.files[0];
    if (!file) return;

    // Call fetchRequest and await the result
    const qrText = await fetchRequest(file);

    // Log or display the QR text if available
    if (qrText) {
        console.log("QR Code Data:", qrText);

        // Update UI or take further actions with qrText here
        textarea.innerText = qrText;
    }
});


// Scan QR code with Camera
let scanner;
camera.addEventListener('click', () => {

    scanner = new Instascan.Scanner({video: video});
    Instascan.Camera.getCameras()
    .then(cameras => {
        if(cameras.length > 0){
            scanner.start(camera[0]).then(() => {
                form.classList.add("active-video");
                stopCam.style.display = 'inline-block';
            })
        }else{
            console.log("No cameras found");
        }
    })
    .catch(err => console.error(err))

    scanner.addListener('scan', c => {
        scannerDiv.classList.add('active');
        textarea.innerText = c;

    });
});

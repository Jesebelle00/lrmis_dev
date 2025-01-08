
const generatorDiv = document.querySelector('.generator');
    const generateBtn   =   generatorDiv.querySelector('.generator-form button');
    const qrInput       =   generatorDiv.querySelector('.generator-form input');
    const qrImg         =   generatorDiv.querySelector('.generator-img img');
    const downloadBtn   =   generatorDiv.querySelector('.generator-btn .btn-link');

/* functions */
const fetchImage = (url) => {
    fetch(url).then(res => res.blob()).then(file => {
        let tempFile = URL.createObjectURL(file);
        let file_name = url.split('/').pop().split('.')[0];
        let extension = file.type.split('/')[1];
        /* call download function */
        qrDownload(tempFile, file_name, extension);
    })
    .catch(() => imgURL = '')
}

const qrDownload = (tempFile, file_name, extension) => {
    let a = document.createElement('a');
    a.href = tempFile;
    a.download = `${file_name}.${extension}`;
    document.body.appendChild(a);
    a.click();
    a.remove();
}


let imgURL = '';

generateBtn.addEventListener('click', () => {

    let qrValue = qrInput.value;
    if (!qrValue.trim()) return;

    generateBtn.innerText = "Generating QR Code..."

    imgURL = ` https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=${qrValue}`;

    qrImg.src = imgURL;

    /* after qrcode as image load */
    qrImg.addEventListener('load', () => {
        generateBtn.innerText = "Generate code"
    });

});

downloadBtn.addEventListener('click', () => {
    if (!imgURL) return;
    fetchImage(imgURL);
});



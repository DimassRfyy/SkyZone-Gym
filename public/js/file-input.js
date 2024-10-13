const fileInput = document.getElementById('file-input');
const fileName = document.getElementById('file-name');
const defaultText = "Upload transfer proof";

fileInput.addEventListener('change', function() {
    if (fileInput.files.length > 0) {
        fileName.textContent = fileInput.files[0].name;
        fileName.classList.remove('text-[#BFBFBF]');
    } else {
        fileName.textContent = defaultText;
        fileName.classList.add('text-[#BFBFBF]');
    }
});
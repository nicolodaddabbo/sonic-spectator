const imagePreview = document.getElementById('imagePreview');
const addImageText = document.getElementById('addImageText');
const descriptionInput = document.getElementById('descriptionInput');
const imageInput = document.getElementById('imageInput');

document.getElementById('postImageBox').addEventListener('click', function () {
    document.getElementById('imageInput').click();
});

imageInput.addEventListener('change', function() {
    const selectedFile = this.files[0];
    if (selectedFile) {
        const reader = new FileReader();
        reader.onload = function(e) {
            imagePreview.src = e.target.result;
            imagePreview.style.display = 'block';
            addImageText.style.display = 'none';
        };
        reader.readAsDataURL(selectedFile);
    }
});

document.getElementById('postButton').addEventListener('click', function () {
    
});

document.getElementById('cancelButton').addEventListener('click', function () {
    descriptionInput.value = '';
    imageInput.value = '';
    imagePreview.src = '';
    imagePreview.style.display = 'none';
    addImageText.style.display = 'block';
});
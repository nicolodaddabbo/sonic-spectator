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
    const selectedFile = imageInput.files[0];
    const description = descriptionInput.value;

    if (selectedFile && description) {
        // FormData to construct the data to send to the server
        const formData = new FormData();
        formData.append('description', description);
        formData.append('image', selectedFile);

        // Send the data to the server using fetch
        fetch('/createPost', {
            method: 'POST',
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            if (data.status) {
                // Reset the form
                descriptionInput.value = '';
                imageInput.value = '';
                imagePreview.src = ''; 
                imagePreview.style.display = 'none';
                addImageText.style.display = 'block';

                // Provide success feedback to the user
                showNotification('success', 'Post created successfully!');
            } else {
                // Provide error feedback to the user
                showNotification('error', 'Error creating post');
            }
        })
        .catch(error => {
            console.error('Failed to create post', error);
        });
    }
});

function showNotification(type, message) {
    const notificationContainer = document.getElementById('notification-container');

    const notification = document.createElement('article');
    notification.className = `notification ${type}`;
    notification.textContent = message;

    notificationContainer.appendChild(notification);

    // Remove the notification after 3000 milliseconds
    setTimeout(() => {
        notification.remove();
    }, 3000);
}

document.getElementById('cancelButton').addEventListener('click', function () {
    descriptionInput.value = '';
    imageInput.value = '';
    imagePreview.src = ''; 
    imagePreview.style.display = 'none';
    addImageText.style.display = 'block';
});
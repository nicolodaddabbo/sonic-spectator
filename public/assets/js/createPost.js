const imagePreview = document.getElementById('imagePreview');
const addImageText = document.getElementById('addImageText');
const descriptionInput = document.getElementById('descriptionInput');
const imageInput = document.getElementById('imageInput');
const notificationContainer = document.getElementById('notification-container');
const descriptionTextCounter = document.getElementById('textCounter');
const postImageBox = document.getElementById('postImageBox');
const descriptionTextMaxLength = 255;

function getColorBasedOnPercentage(percentage) {
    // Adjusting the color based on the percentage starting after 50%
    const red = Math.round(255 * Math.max(0, (percentage - 50) / 50));
    return 'rgb(' + red + ', 0, 0)';
}

descriptionInput.addEventListener('input', function () {
    
    const textarea = this;

    // Change textarea height to match wrapping text
    textarea.style.height = (textarea.scrollHeight > textarea.clientHeight) ? (textarea.scrollHeight)+"px" : "60px";

    // Get the current length of the text
    const currentLength = textarea.value.length;
    // Calculate the percentage of characters used
    const percentageUsed = (currentLength / descriptionTextMaxLength) * 100;
    // Change color based on percentage
    const color = getColorBasedOnPercentage(percentageUsed);
    // Update the counter text and color
    descriptionTextCounter.textContent = currentLength + '/' + descriptionTextMaxLength;
    descriptionTextCounter.style.color = color;
    // Trim the text if it exceeds the maximum length
    if (currentLength > descriptionTextMaxLength) {
        textarea.value = textarea.value.substring(0, descriptionTextMaxLength);
        descriptionTextCounter.textContent = descriptionTextMaxLength + '/' + descriptionTextMaxLength;
    }
});

postImageBox.addEventListener('click', function () {
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
                resetForm();

                // Provide success feedback to the user
                showNotification('success', 'Post created successfully!');
            } else {
                // Provide error feedback to the user
                showNotification('error', 'Error creating post');
            }
        })
        .catch(error => {
            console.error('Failed to create post', error);
            showNotification('error', 'Error creating post');
        });
    }else{
        if (!selectedFile) {
            showNotification('error', 'Please upload an image.');
        }
    }
});

document.getElementById('postForm').addEventListener('submit', function (event) {
    event.preventDefault();
});

function showNotification(type, message) {
    const notification = document.createElement('article');
    notification.className = `alert ${type}`;
    notification.textContent = message;

    notificationContainer.appendChild(notification);

    // Remove the notification after 3000 milliseconds
    setTimeout(() => {
        notification.remove();
    }, 3000);
}

document.getElementById('cancelButton').addEventListener('click', function () {
    resetForm();
});

function resetForm() {
    descriptionInput.value = '';
    imageInput.value = '';
    imagePreview.src = ''; 
    imagePreview.style.display = 'none';
    addImageText.style.display = 'block';
    descriptionTextCounter.textContent = '0/' + descriptionTextMaxLength;
}
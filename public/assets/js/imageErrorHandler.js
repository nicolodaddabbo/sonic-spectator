function handleImageError(image, type) {
    image.onerror = null;
    
    switch (type) {
        case 'post':
            image.src = "/assets/system/defaultPost.jpg";
            break;
        case 'profile':
            image.src = "/assets/system/defaultProfile.jpg";
            break;
        default:
            image.src = "/assets/system/default.jpg";
    }
}
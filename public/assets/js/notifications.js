const notificationCounter = document.getElementById('notification-counter');

fetch('/getNewNotificationsCount', {
    method: 'GET'
}).then(response => response.json()
).then(data => {
    if (data.count !== 0) {
        notificationCounter.classList.add('full');
    }
    notificationCounter.innerText = data.count;
}).catch(error => {
    console.debug(error);
});
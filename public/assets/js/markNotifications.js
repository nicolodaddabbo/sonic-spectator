fetch('/markAllAsViewed', {
    method: 'GET'
}).then(response => {
    console.debug(response);
}).catch(error => {
    console.debug(error);
});

document.getElementById('homeTab').addEventListener('click', function () {
    window.location.href = '/';
});
// location == / 
if (window.location.pathname == '/') {
    document.getElementById('homeTab').classList.add('active');
} else if (window.location.pathname == '/search') {
    document.getElementById('searchTab').classList.add('active');
} else if (window.location.pathname == '/post') {
    document.getElementById('postTab').classList.add('active');
} else if (window.location.pathname == '/profile') {
    document.getElementById('profileTab').classList.add('active');
}

document.getElementById('searchTab').addEventListener('click', function () {
    window.location.href = 'search';
});

document.getElementById('postTab').addEventListener('click', function () {
    window.location.href = 'post';
});

document.getElementById('profileTab').addEventListener('click', function () {
    window.location.href = 'profile';
});
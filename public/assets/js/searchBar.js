document.getElementById('clearButton').addEventListener('click', function () {
    document.getElementById('searchInput').value = '';
});

document.getElementById('searchButton').addEventListener('click', function () {
    const searchTerm = document.getElementById('searchInput').value;
    const newUrl = '/search/' + encodeURIComponent(searchTerm);
    window.history.pushState({ path: newUrl }, '', newUrl);
});
<!DOCTYPE html>
<html lang="en">
<?php include_once 'template/head.php'; ?>

<body>
    <?php include_once 'template/search_header.php'; ?>
    <main>
        <section class='search-content'>
            <section class='search-bar'>
                <section class='search-action' id='searchButton'>
                    <img src='assets/icons/search.svg' alt='Search Icon'>
                </section>
                <input type='text' placeholder='Search...' class='search-bar-text' id='searchInput' onkeyup="liveSearch(this.value)">
                <section class='clear-action' id='clearButton'>
                    <img src='assets/icons/clear.svg' alt='Clear Icon'>
                </section>
            </section>
            <section class='search-results' id="searchResults"></section>
        </section>
    </main>
    <?php include_once 'template/footer.php'; ?>
    <script src="assets/js/searchBar.js"></script>
</body>

</html>
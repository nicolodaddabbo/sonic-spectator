<!DOCTYPE html>
<html lang="en">

<?php include_once 'template/head.php'; ?>

<body>
    <?php include_once 'template/search_header.php'; ?>
    <main role="main">
        <section class='search-content'>
            <section class='search-bar' role="search">
                <section class='search-action' id='searchButton' role="button" aria-label="Search">
                    <img src='/assets/icons/search.svg' alt='Search Icon'>
                </section>
                <input type='text' placeholder='Search...' class='search-bar-text' id='searchInput' role="searchbox" aria-label="Search Input">
                <section class='clear-action' id='clearButton' role="button" aria-label="Clear Search">
                    <img src='/assets/icons/clear.svg' alt='Clear Icon'>
                </section>
            </section>
            <section class='search-results' id="searchResults" role="region" aria-live="polite"></section>
        </section>
    </main>
    <?php include_once 'template/footer.php'; ?>
    <script src="/assets/js/searchBar.js"></script>
    <script src="/assets/js/notifications.js"></script>
</body>

</html>
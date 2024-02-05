<!DOCTYPE html>
<html lang='en'>

<?php include_once 'template/head.php'; ?>

<body>
    <?php include_once 'template/search_header.php'; ?>
    <main role='main'>
        <section class='search-content'>
            <section class='search-bar' role='search'>
                <section class='search-action'>
                    <img src='/assets/icons/search.svg' alt='Search Icon'>
                </section>
                <label for='searchInput' class='visually-hidden'>Search Input</label>
                <input type='text' placeholder='Search...' class='search-bar-text' id='searchInput' role='searchbox'>
                <section class='clear-action' id='clearButton' aria-label='Clear Search'>
                    <img src='/assets/icons/clear.svg' alt='Clear Icon'>
                </section>
            </section>
            <section class='search-results' id='searchResults' role='region' aria-live='polite'></section>
            <section class='search-placeholder' id='searchPlaceholder'>
                <img id='searchIcon' src='/assets/icons/search.svg' alt='Search Icon'>
                <img id='searchIconShadow' src='/assets/icons/search.svg' alt='Search Icon Shadow'>
            </section>
        </section>
    </main>
    <?php include_once 'template/footer.php'; ?>
    <script src='/assets/js/searchBar.js'></script>
    <script src='/assets/js/followButtonHandler.js'></script>
    <script src='/assets/js/notifications.js'></script>
    <script src="/assets/js/imageErrorHandler.js"></script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">
<?php include_once 'template/head.php'; ?>

<body>
    <?php include_once 'template/search_header.php'; ?>
    <main>
        <article class='search-content'>
            <section class='search-bar'>
                <section class='search-action' id='searchButton'>
                    <img src='assets/icons/search.svg' alt='Search Icon'>
                </section>
                <input type='text' placeholder='Search...' class='search-bar-text' id='searchInput'>
                <section class='clear-action' id='clearButton'>
                    <img src='assets/icons/clear.svg' alt='Clear Icon'>
                </section>
            </section>
        </article>
    </main>
    <?php include_once 'template/footer.php'; ?>
    <script src="assets/js/searchBar.js"></script>
</body>

</html>
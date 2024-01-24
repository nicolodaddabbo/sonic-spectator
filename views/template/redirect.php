<?php
// Redirect if not logged in
if (!isset($_SESSION['user'])) {
    header('location:login');
}

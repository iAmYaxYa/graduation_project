<?php
include '../includes/Session/Session.php';
require_once '../includes/Config/actions.php';
if (!isset($_SESSION['islogged']) || $_SESSION['islogged'] !== true) {
    redirect('Login.php');
}
// <!-- ========================= Head ========================= -->
include '../includes/Head/Head.php';
// <!-- ======================= Header ========================= -->
include '../includes/Header/Header.php';
// <!-- ======================= Sidebar ======================== -->
include '../includes/Sidebar/Sidebar.php';
?>
<!-- ========================= Main ========================= -->
<div class="main">
    <!-- ============================== Content ============================== -->
    <div class="pt-5 px-4">
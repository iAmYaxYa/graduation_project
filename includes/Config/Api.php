<?php
require_once 'actions.php';

if (isset($_POST['action']) && $_POST['action'] == 'update') {
    Read($_POST['table'], $_POST['id']);
}

if (isset($_POST['action']) && $_POST['action'] == 'updateWithOutID') {
    updateWithOutIDAjax($_POST['table'], $_POST['mark'], $_POST['value1'], $_POST['ID'], $_POST['value2']);
}

if (isset($_POST['action']) && $_POST['action'] == 'delete') {
    Read($_POST['table'], $_POST['id']);
}

if (isset($_POST['action']) && $_POST['action'] == 'select') {
    ReadCustom($_POST['table'], getColumn('teachers', 'Courses', 2), $_POST['column'], $_POST['id']);
}
if (isset($_POST['action']) && $_POST['action'] == 'getlinks') {
    readLinks($_POST['table'], $_POST['id'], 'json');
}
if (isset($_POST['action']) && $_POST['action'] == 'activestatus') {
    $data = [
        'ID' => $_POST['id'],
        'Status' => 1
    ];
    $query = Update($_POST['table'], $data);
    if ($query) {
        echo json_encode($query);
    }
}
if (isset($_POST['action']) && $_POST['action'] == 'inactivestatus') {
    $data = [
        'ID' => $_POST['id'],
        'status' => 0
    ];
    $query = Update($_POST['table'], $data);
    if ($query) {
        echo json_encode($query);
    }
}
if (isset($_POST['action']) && $_POST['action'] == 'selectAllSeats') {
    $unavailableseats = get_target_match_unavailable_seats($_POST['id']);
    $stringseats = implode(',', array_column($unavailableseats, 'seat_no'));
    if ($stringseats !== '') {
        read_available_seats_json($stringseats);
    } else {
        $stringseats = 0;
        read_available_seats_json($stringseats);
    }
}

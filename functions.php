<?php

// Menambah Task baru
function addTask($task) {
    if (!isset($_SESSION['tasks'])) {
        $_SESSION['tasks'] = [];
    }
    $_SESSION['tasks'][] = $task;
}

// Mengupdate Task yang sudah ada
function updateTask($id, $task) {
    $_SESSION['tasks'][$id] = $task;
}

// Menghapus Task berdasarkan ID
function deleteTask($id) {
    unset($_SESSION['tasks'][$id]);
    $_SESSION['tasks'] = array_values($_SESSION['tasks']); // Reindex array
}
?>

<?php
// Fungsi untuk menambah task baru
function addTask($task) {
    if (!isset($_SESSION['tasks'])) {
        $_SESSION['tasks'] = [];
    }
    $task['status'] = 'Belum Selesai'; // Status default saat menambah task
    $_SESSION['tasks'][] = $task;
}

// Fungsi untuk mengupdate task yang sudah ada
function updateTask($id, $task) {
    $_SESSION['tasks'][$id] = $task;
}

// Fungsi untuk menandai task sebagai selesai
function completeTask($id) {
    $_SESSION['tasks'][$id]['status'] = 'Selesai';
}

// Fungsi untuk menghapus task
function deleteTask($id) {
    unset($_SESSION['tasks'][$id]);
    $_SESSION['tasks'] = array_values($_SESSION['tasks']); // Reindex array setelah penghapusan
}
?>

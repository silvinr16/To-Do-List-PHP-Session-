<?php
session_start();
require 'functions.php';

// Menangani aksi selesai atau hapus task
if (isset($_GET['action'])) {
    $id = $_GET['id'];
    
    if ($_GET['action'] == 'complete') {
        completeTask($id);
        $_SESSION['message'] = 'Task telah diselesaikan.';
    } elseif ($_GET['action'] == 'delete') {
        deleteTask($id);
        $_SESSION['message'] = 'Task telah dihapus.';
    }

    // Redirect untuk menghindari refresh resubmission
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi To-Do List</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center mb-4">Aplikasi To-Do List</h1>

        <!-- Notifikasi Bootstrap -->
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <?= $_SESSION['message']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>

        <div class="d-flex justify-content-between mb-3">
            <h3>Daftar Tugas</h3>
            <a href="add_task.php" class="btn btn-primary">Tambah Task Baru</a>
        </div>

        <?php if (isset($_SESSION['tasks']) && count($_SESSION['tasks']) > 0): ?>
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Task</th>
                        <th>Prioritas</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($_SESSION['tasks'] as $id => $task): ?>
                    <tr>
                        <td><?= $id + 1; ?></td>
                        <td><?= htmlspecialchars($task['name']); ?></td>
                        <td>
                            <?php
                            if ($task['priority'] == 'Rendah') {
                                echo '<span class="badge bg-success">Rendah</span>';
                            } elseif ($task['priority'] == 'Sedang') {
                                echo '<span class="badge bg-warning">Sedang</span>';
                            } else {
                                echo '<span class="badge bg-danger">Tinggi</span>';
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            if ($task['status'] == 'Selesai') {
                                echo '<span class="badge bg-primary">Selesai</span>';
                            } else {
                                echo '<span class="badge bg-secondary">Belum Selesai</span>';
                            }
                            ?>
                        </td>
                        <td>
                            <?php if ($task['status'] == 'Belum Selesai'): ?>
                                <a href="index.php?action=complete&id=<?= $id ?>" class="btn btn-sm btn-success">Selesai</a>
                            <?php endif; ?>
                            <a href="edit_task.php?id=<?= $id ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="index.php?action=delete&id=<?= $id ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus task ini?')">Hapus</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-info" role="alert">
                Tidak ada tugas yang tersedia.
            </div>
        <?php endif; ?>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

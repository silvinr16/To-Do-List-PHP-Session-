<?php
session_start();
require 'functions.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center mb-4">To-Do List</h1>
        
        <div class="d-flex justify-content-between mb-3">
            <h3>Daftar Tugas</h3>
            <a href="add_task.php" class="btn btn-primary">Tambah Task Baru</a>
        </div>

        <?php if (isset($_SESSION['tasks']) && count($_SESSION['tasks']) > 0): ?>
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Task</th>
                        <th>Prioritas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($_SESSION['tasks'] as $id => $task): ?>
                    <tr>
                        <td><?= $task['name']; ?></td>
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
                            <a href="edit_task.php?id=<?= $id ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="delete_task.php?id=<?= $id ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin?')">Hapus</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-info" role="alert">
                Tidak ada task untuk ditampilkan.
            </div>
        <?php endif; ?>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

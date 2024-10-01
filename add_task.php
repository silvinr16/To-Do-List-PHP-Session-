<?php
session_start();
require 'functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $task = [
        'name' => htmlspecialchars($_POST['task_name']),
        'priority' => $_POST['priority']
    ];
    addTask($task);
    $_SESSION['message'] = 'Task berhasil ditambahkan.';
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Task</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center mb-4">Tambah Task Baru</h1>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="add_task.php" method="POST">
                    <div class="mb-3">
                        <label for="task_name" class="form-label">Nama Task</label>
                        <input type="text" id="task_name" name="task_name" class="form-control" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="priority" class="form-label">Prioritas</label>
                        <select id="priority" name="priority" class="form-select" required>
                            <option value="Rendah">Rendah</option>
                            <option value="Sedang">Sedang</option>
                            <option value="Tinggi">Tinggi</option>
                        </select>
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        <a href="index.php" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">Tambah Task</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

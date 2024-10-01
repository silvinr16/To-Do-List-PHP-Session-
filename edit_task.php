<?php
session_start();
require 'functions.php';

$id = $_GET['id'];
$task = $_SESSION['tasks'][$id];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $updated_task = [
        'name' => $_POST['task_name'],
        'priority' => $_POST['priority']
    ];
    updateTask($id, $updated_task);
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center mb-4">Edit Task</h1>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="edit_task.php?id=<?= $id ?>" method="POST">
                    <div class="mb-3">
                        <label for="task_name" class="form-label">Nama Task</label>
                        <input type="text" id="task_name" name="task_name" value="<?= $task['name']; ?>" class="form-control" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="priority" class="form-label">Prioritas</label>
                        <select id="priority" name="priority" class="form-select">
                            <option value="Rendah" <?= $task['priority'] == 'Rendah' ? 'selected' : '' ?>>Rendah</option>
                            <option value="Sedang" <?= $task['priority'] == 'Sedang' ? 'selected' : '' ?>>Sedang</option>
                            <option value="Tinggi" <?= $task['priority'] == 'Tinggi' ? 'selected' : '' ?>>Tinggi</option>
                        </select>
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        <a href="index.php" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

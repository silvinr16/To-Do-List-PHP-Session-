<?php
session_start();
require 'functions.php';

// Cek apakah ID ada di URL dan valid
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Cek apakah task dengan ID tersebut ada dalam session
    if (isset($_SESSION['tasks'][$id])) {
        $task = $_SESSION['tasks'][$id];
    } else {
        // Jika task tidak ditemukan, redirect ke halaman utama dengan pesan error
        $_SESSION['message'] = 'Task tidak ditemukan.';
        header('Location: index.php');
        exit;
    }
} else {
    // Jika ID tidak valid, redirect ke halaman utama dengan pesan error
    $_SESSION['message'] = 'ID task tidak valid.';
    header('Location: index.php');
    exit;
}

// Jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validasi input yang diterima dari form
    if (!empty($_POST['task_name']) && !empty($_POST['priority'])) {
        // Update task dengan data yang baru
        $updated_task = [
            'name' => htmlspecialchars($_POST['task_name']),
            'priority' => $_POST['priority'],
            'status' => $task['status']  // Status tidak diubah saat edit
        ];
        updateTask($id, $updated_task);
        $_SESSION['message'] = 'Task berhasil diperbarui.';
        header('Location: index.php');
        exit;
    } else {
        // Jika input tidak valid, tampilkan pesan error
        $_SESSION['message'] = 'Semua field harus diisi.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center mb-4">Edit Task</h1>

        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <?= $_SESSION['message']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="edit_task.php?id=<?= $id ?>" method="POST">
                    <div class="mb-3">
                        <label for="task_name" class="form-label">Nama Task</label>
                        <input type="text" id="task_name" name="task_name" class="form-control" value="<?= htmlspecialchars($task['name']); ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="priority" class="form-label">Prioritas</label>
                        <select id="priority" name="priority" class="form-select" required>
                            <option value="Rendah" <?= $task['priority'] == 'Rendah' ? 'selected' : ''; ?>>Rendah</option>
                            <option value="Sedang" <?= $task['priority'] == 'Sedang' ? 'selected' : ''; ?>>Sedang</option>
                            <option value="Tinggi" <?= $task['priority'] == 'Tinggi' ? 'selected' : ''; ?>>Tinggi</option>
                        </select>
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        <a href="index.php" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-warning">Perbarui Task</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

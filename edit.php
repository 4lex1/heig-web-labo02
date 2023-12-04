<?php
include_once 'repository.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$warrior = getWarriorById($id);

if (!$warrior) {
    echo "Guerrier non trouvé.";
    exit;
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = trim($_POST['first_name']);
    if (empty($first_name)) {
        $errors['first_name'] = "Le champ prénom est requis";
    }

    $last_name = trim($_POST['last_name']);
    if (empty($last_name)) {
        $errors['last_name'] = "Le champ nom de famille est requis";
    }

    $grade = trim($_POST['grade']);
    if (empty($grade)) {
        $errors['grade'] = "Le champ grade est requis";
    }

    $description = trim($_POST['description']);
    if (empty($description)) {
        $errors['description'] = "Le champ description est requis";
    }

    // Si aucune erreur n'est détectée, procédez à la modification du guerrier
    if (empty($errors)) {
        $success = updateWarrior($id, $first_name, $last_name, $grade, $description);
        if ($success) {
            header("Location: /list.php");
            exit();
        } else {
            echo "Erreur lors de la modification du guerrier.";
        }
    }
}
?>

<?php include 'includes/header.php';?>

<h2>Modifier le Guerrier</h2>
<form action="edit.php?id=<?= $id ?>" method="post">
    <div class="form-group">
        <label for="first_name">Prénom :</label>
        <input class="form-control" type="text" id="first_name" name="first_name" value="<?= htmlspecialchars($warrior['first_name']) ?>">
        <?php
        if (isset($errors['first_name'])) {
            echo "<div class='alert alert-danger' data-bs-theme='dark' role='alert'>{$errors['first_name']}</div>";
        }
        ?>
    </div>

    <div class="form-group">
        <label for="last_name">Nom :</label>
        <input class="form-control" type="text" id="last_name" name="last_name" value="<?= htmlspecialchars($warrior['last_name']) ?>">
        <?php
        if (isset($errors['last_name'])) {
            echo "<div class='alert alert-danger' data-bs-theme='dark' role='alert'>{$errors['last_name']}</div>";
        }
        ?>
    </div>

    <div class="form-group">
        <label for="grade">Grade :</label>
        <input class="form-control" type="text" id="grade" name="grade" value="<?= htmlspecialchars($warrior['grade']) ?>">
        <?php
        if (isset($errors['grade'])) {
            echo "<div class='alert alert-danger' data-bs-theme='dark' role='alert'>{$errors['grade']}</div>";
        }
        ?>
    </div>

    <div class="form-group">
        <label for="description">Description :</label>
        <textarea class="form-control" id="description" name="description"><?= htmlspecialchars($warrior['description']) ?></textarea>
        <?php
        if (isset($errors['description'])) {
            echo "<div class='alert alert-danger' data-bs-theme='dark' role='alert'>{$errors['description']}</div>";
        }
        ?>
    </div>

    <input class="btn btn-primary mt-3" data-bs-theme="dark" type="submit" value="Modifier Guerrier">
</form>

<?php include 'includes/footer.php';?>
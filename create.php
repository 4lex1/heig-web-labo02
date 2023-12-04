<?php
include_once 'repository.php';
$first_name = "";
$last_name = "";
$grade = "";
$description = "";
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = trim($_POST['first_name']);
    error_log($first_name);
    if (empty($first_name)){
        $errors['first_name'] = "Le champ prénom est requis";
    }

    $last_name = trim($_POST['last_name']);
    error_log($last_name);
    if (empty($last_name)){
        $errors['last_name'] = "Le champ nom de famille est requis";
    }

    $grade = trim($_POST['grade']);
    error_log($grade);
    if (empty($grade)){
        $errors['grade'] = "Le champ grade est requis";
    }

    $description = trim($_POST['description']);
    error_log($description);
    if (empty($description)){
        $errors['description'] = "Le champ description est requis";
    }

    if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
        $errors['image'] = "Veuillez télécharger une image au format png";
    }

    if (empty($errors)){
        $image_name = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $target_path = 'images/' . $image_name;
        move_uploaded_file($image_tmp, $target_path);

        $success = createWarrior($first_name, $last_name, $grade, $description, $image_name);
        if ($success) {
            header("Location: /list.php");
            exit();
        } else {
            echo "Erreur lors de la création du guerrier.";
        }
    }    
}
?>

<?php include 'includes/header.php';?>

<h2>Créer un Guerrier</h2>
<form action="create.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="first_name">Prénom :</label>
            <input class="form-control" type="text" id="first_name" name="first_name" value="<?= htmlspecialchars($first_name) ?>">
        </div>
        <?php
        if (isset($errors['first_name'])){
            echo "<div class='alert alert-danger' data-bs-theme='dark' role='alert'>{$errors['first_name']}</div>";
        }
        ?>

        <div class="form-group">
            <label for="last_name">Nom :</label>
            <input class="form-control" type="text" id="last_name" name="last_name" value="<?= htmlspecialchars($last_name) ?>">
        </div>
        <?php
        if (isset($errors['last_name'])){
            echo "<div class='alert alert-danger' data-bs-theme='dark' role='alert'>{$errors['last_name']}</div>";
        }
        ?>

        <div class="form-group">
            <label for="grade">Grade :</label>
            <input class="form-control" type="text" id="grade" name="grade" value="<?= htmlspecialchars($grade) ?>">
        </div>
        <?php
        if (isset($errors['grade'])){
            echo "<div class='alert alert-danger' data-bs-theme='dark' role='alert'>{$errors['grade']}</div>";
        }
        ?>

        <div class="form-group">
            <label for="description">Description :</label>
            <textarea class="form-control" id="description" name="description" value="<?= htmlspecialchars($description) ?>"></textarea>
        </div>
        <?php
        if (isset($errors['description'])){
            echo "<div class='alert alert-danger' data-bs-theme='dark' role='alert'>{$errors['description']}</div>";
        }
        ?>
                
        <div class="form-group mt-2">
            <label for="image">Télécharger une image (PNG uniquement) :</label>
            <input type="file" id="image" name="image" accept=".png">
        </div>
        <?php
        if (isset($errors['image'])){
            echo "<div class='alert alert-danger' data-bs-theme='dark' role='alert'>{$errors['image']}</div>";
        }
        ?>

        <input class="btn btn-primary mt-3" data-bs-theme="dark" type="submit" value="Créer Guerrier">
</form>

<?php include 'includes/footer.php';?>
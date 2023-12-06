<?php include 'includes/header.php';?>

<h2>Liste des Warriors</h2>
<div class="alert alert-warning" role="alert" data-bs-theme="dark">
    Vous pouvez éditer ou supprimer les guerriers !
</div>
    <table class="table table-hover table-dark">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Grade</th>
                <th>Description</th>
                <th>Image</th>
                <th>Editer</th>
                <th>Supprimer</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $warriors = getAllWarriors();
            foreach ($warriors as $warrior) {
                echo "<tr>";
                    echo "<td>{$warrior['first_name']} {$warrior['last_name']}</td>";
                    echo "<td>{$warrior['grade']}</td>";
                    echo "<td>{$warrior['description']}</td>";
                    echo "<td><img class='border rounded img-fluid' src='images/{$warrior['image_link']}' alt='Image' style='max-width: 100px; max-height: 100px;'></td>";
                    echo "<td><a href='edit.php?id={$warrior['id']}'>Editer</a></td>";
                    echo "<td><a class='text-danger' data-bs-theme='dark' href='delete.php?id={$warrior['id']}'>Supprimer</a></td>";
                    echo "</tr>";
            }
            ?>
        </tbody>
    </table>

<?php include 'includes/footer.php';?>
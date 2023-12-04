<?php include 'includes/header.php';?>

<h2>Liste des Warriors</h2>
    <table class="table table-hover table-dark">
        <thead>
            <tr>
                <th>ID</th>
                <th>Prénom</th>
                <th>Nom de famille</th>
                <th>Grade</th>
                <th>Description</th>
                <th>Image</th>
            </tr>
        </thead>
        <tbody>
            <?php

            $warriors = getAllWarriors();
            foreach ($warriors as $warrior) {
                echo "<tr>";
                    echo "<td>{$warrior['id']}</td>";
                    echo "<td>{$warrior['first_name']}</td>";
                    echo "<td>{$warrior['last_name']}</td>";
                    echo "<td>{$warrior['grade']}</td>";
                    echo "<td>{$warrior['description']}</td>";
                    echo "<td><img class='border rounded img-fluid' src='images/{$warrior['image_link']}' alt='Image' style='max-width: 100px; max-height: 100px;'></td>";
                    echo "</tr>";
            }
            ?>
        </tbody>
    </table>

<?php include 'includes/footer.php';?>
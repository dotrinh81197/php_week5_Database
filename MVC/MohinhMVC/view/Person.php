<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome <?php print($person->name); ?></title>
</head>

<body>
    <table>
        <tr>
            <th>Title</th>
            <th>Author</th>
            <th>Description</th>
        </tr>
        <tr>
            <?php
            echo "<tr><td>" . $person->name . "</td><td>" . $person->birthday . "</td><td>" . $person->desciption . "</td><tr>";

            ?>
        </tr>
    </table>
    <a href="index.php">
        <h1>Back to list </h1>
    </a>
</body>

</html>
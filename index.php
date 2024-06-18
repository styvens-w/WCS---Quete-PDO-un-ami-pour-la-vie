<?php
require_once '_connect.php';

$pdo = new PDO(DSN, USER, PASS);

$query = "SELECT * FROM friend";
$statement = $pdo->query($query);
$friendsArray = $statement->fetchAll(PDO::FETCH_ASSOC);

foreach($friendsArray as $friend) {
    echo $friend['firstname'] . ' ' . $friend['lastname'] . '<br>';
}


if ($_POST) {
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);

    if (strlen($firstname) <= 45 && strlen($lastname) <= 45) {
        $query = 'INSERT INTO friend (firstname, lastname) VALUES (:firstname, :lastname)';
        $statement = $pdo->prepare($query);

        $statement->bindValue(':firstname', $firstname);
        $statement->bindValue(':lastname', $lastname);

        if($statement->execute()) {
            header('Location: index.php');
        }
    }
}
?>

<form action="" method="post" style="margin-top: 50px; display: flex;flex-direction: column; justify-content: center">
    <label for="firstname">Firstname</label>
    <input type="text" id="firstname" name="firstname" style="margin-bottom: 15px; width: 150px; font-size: 18px" maxlength="45" value="<?= $_POST['firstname'] ?? "" ?>" required>
    <label for="lastname">Lastname</label>
    <input type="text" id="lastname" name="lastname" style="margin-bottom: 15px; width: 150px; font-size: 18px" maxlength="45" value="<?= $_POST['lastname'] ?? "" ?>" required>
    <input type="submit" style="width: 150px">
</form>

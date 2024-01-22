
<?php
class Pizza {
    public $code;
    public $nom;
    public $prix;

    public function __construct($code, $nom, $prix) {
        $this->code = $code;
        $this->nom = $nom;
        $this->prix = $prix;
    }
}

$pizzas = [
    new Pizza("PEP", "Pépéroni", 12.50),
    new Pizza("MAR", "Margherita", 14.00),
    // Ajoutez d'autres pizzas ici
];

// Ajouter une nouvelle pizza
if (isset($_POST['add'])) {
    $pizzas[] = new Pizza($_POST['code'], $_POST['nom'], $_POST['prix']);
}

// Modifier une pizza existante
if (isset($_POST['update'])) {
    foreach ($pizzas as $i => $pizza) {
        if ($pizza->code == $_POST['old_code']) {
            $pizzas[$i] = new Pizza($_POST['code'], $_POST['nom'], $_POST['prix']);
            break;
        }
    }
}

// Supprimer une pizza
if (isset($_POST['delete'])) {
    foreach ($pizzas as $i => $pizza) {
        if ($pizza->code == $_POST['code']) {
            unset($pizzas[$i]);
            break;
        }
    }
}

// Afficher les pizzas
function displayPizzas($pizzas) {
    foreach ($pizzas as $pizza) {
        echo $pizza->code . " -> " . $pizza->nom . " (" . $pizza->prix . " €)<br>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gestion de Pizzeria</title>
</head>
<body>
    <h1>Pizzeria</h1>

    <?php displayPizzas($pizzas); ?>

    <form method="post">
        <h2>Ajouter une Pizza</h2>
        Code: <input type="text" name="code"><br>
        Nom: <input type="text" name="nom"><br>
        Prix: <input type="text" name="prix"><br>
        <input type="submit" name="add" value="Ajouter">
    </form>

    <form method="post">
        <h2>Modifier une Pizza</h2>
        Ancien Code: <input type="text" name="old_code"><br>
        Nouveau Code: <input type="text" name="code"><br>
        Nom: <input type="text" name="nom"><br>
        Prix: <input type="text" name="prix"><br>
        <input type="submit" name="update" value="Modifier">
    </form>

    <form method="post">
        <h2>Supprimer une Pizza</h2>
        Code: <input type="text" name="code"><br>
        <input type="submit" name="delete" value="Supprimer">
    </form>
</body>
</html>

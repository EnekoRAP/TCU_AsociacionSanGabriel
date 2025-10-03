<?php
$info = [
    "Provincia" => "Heredia",
    "Cantón" => "Santa Bárbara",
    "Distrito" => "Jesús",
    "Dirección" => "150 metros al Sur del EBAIS de Birrí",
    "Teléfono" => "8455 5224",
    "Correo" => "arcangelgabri17@outlook.com"
];
?>

<footer>
    <?php foreach ($info as $label => $value): ?>
        <p><strong><?php echo $label; ?>:</strong> <?php echo $value; ?> </p>
    <?php endforeach; ?>
    <span>Copyright &copy;
        Asociación San Gabriel Formación y Cuido de Niños <?php echo date("Y"); ?>
    </span>
</footer>

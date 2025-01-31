<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todos los tatuadores</title>
</head>
<body>
    <?php
        if(isset($tatuadores) && !empty($tatuadores)){
            foreach ($tatuadores as $tatuador) {
                echo "Nombre: " . $tatuador['nombre'] . "<br>";
                echo "Email: " . $tatuador['email'] . "<br>";
                echo "<img src ='" . $tatuador['foto'] . "' / heigh = 100px width = 100px><br>";
                echo "Fecha de alta: " . $tatuador['creado_en'] . "<br>";
                echo "<hr>";
            }
        }else{
            echo "<h1>NO HAY TATUADORES REGISTRADOS </h1>";
        }
    ?>
</body>
</html>
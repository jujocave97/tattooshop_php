<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/citasStyles/styles_citaCorrecta.css">
    <title>AltaCorrecta</title>
</head>

<body>
    <main>
        <h1>ALTA CORRECTA</h1>
        <div>
            <div>
                <p>Fecha : <?= $input_fecha_cita?></p>
                <p>Descripción : <?= $input_descripcion?></p>
                <p>Cliente : <?= $input_cliente?></p>
            </div>
            <div>
                <p>Tatuador : <?= $tatuadorCita->getNombre()?></p>
                <p>Email : <?= $tatuadorCita->getEmail()?></p>
                <img src="<?=$tatuadorCita->getFoto() ?>" alt="FOTO DE <?= $tatuadorCita->getNombre()?>">
            </div>
        </div>
            
    </main>
    

</body>

</html>
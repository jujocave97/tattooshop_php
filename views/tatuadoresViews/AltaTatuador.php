<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/citasStyles/styles_altaCita.css">
    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- FLATPICKR -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <title>Alta Tatuador</title>
</head>
<body>
<main class="body__main">
    <h1>Ingresar Tatuador Nuevo</h1>
        <form class="main__form-plantilla <?= isset($errores) && !empty($errores) ? "main__form-plantilla-error" : "" ?>" action="/tattooshop_php/tatuadores/alta" method="post">
            
            <div class="form-plantilla__container">
                <div class="form-group">
                    <label class="fw-lighter text-lowercase text-white" for="input_nombre">Nombre</label>
                    <input type="text"
                        class="shadow form-control "
                        id="input_nombre" name="input_nombre"
                        aria-describedby="nombre"
                        placeholder="Introduce el nombre">
                    <?php if (!empty($errores) && isset($errores["error_nombre"])): ?><small id="nombreError" class="form-text text-danger fw-bold"><?= $errores["error_nombre"] ?></small><?php endif; ?>
                </div>
                <div class="form-group">
                    <label class="fw-lighter text-lowercase text-white" for="input_email">Email</label>
                    <input type="email"
                        class="shadow form-control "
                        id="input_email"
                        name="input_email"
                        aria-describedby="email"
                        placeholder="Introduce tu email">
                    <?php if (!empty($errores) && isset($errores["error_email"])): ?><small id="emailError" class="form-text text-danger fw-bold"><?= $errores["error_email"] ?></small><?php endif; ?>
                </div>
                <div class="form-group">
                    <label class="fw-lighter text-lowercase text-white" for="input_fecha_cita">Contraseña</label>
                    <input type="password"
                        class="shadow form-control "
                        id="input_password"
                        name="input_password"
                        aria-describedby="password"
                        placeholder="Introduce tu santo y seña">
                    <?php if (!empty($errores) && isset($errores["error_password"])): ?><small id="passwordError" class="form-text text-danger fw-bold"><?= $errores["error_password"] ?></small><?php endif; ?>

                </div>
                <div class="form-group">
                    <label class="fw-lighter text-lowercase text-white" for="input_cliente">Foto</label>
                    <input type="text"
                        class="shadow form-control "
                        id="input_foto"
                        name="input_foto"
                        placeholder="Introduce la URL de tu foto">
                    <?php if (!empty($errores) && isset($errores["error_foto"])): ?><small id="fotoError" class="form-text text-danger fw-bold"><?= $errores["error_foto"] ?></small><?php endif; ?>
                </div>
                <div class="container__btns-form">
                    <button type="submit" class="btn btn-primary btns-form__btn-enviar">Enviar</button>
                    <button type="reset" class="btn btn-danger">Borrar</button>
                </div>
            </div>
        </form>
        <?php if (!empty($errores) && isset($errores["error_db"]) ): ?>
            <p id="bdError" class="text-danger"><?= $errores["error_db"] ?></p>
        <?php endif; ?>
        <?php if (!empty($errores) && isset($errores["error_emailExistente"]) ): ?>
            <p id="bdError" class="text-danger"><?= $errores["error_emailExistente"] ?></p>
        <?php endif; ?>
    </main>
</body>
</html>
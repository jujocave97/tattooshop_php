<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="stylesheet" href="./public/css/loginStyles/styles_login.css">
    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- FLATPICKR -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>
<body>
<main class="body__main">
        <form class="main__form-plantilla <?= isset($errores) && !empty($errores) ? "main__form-plantilla-error" : "" ?>" action="/tattooshop_php/login" method="post">
            <div class="form-plantilla__container">
                <div class="form-group">
                    <label class="fw-lighter text-lowercase" for="input_id">email</label>
                    <input type="text"
                        class="shadow form-control "
                        id="input_email" name="input_email"
                        aria-describedby="email"
                        placeholder="Introduce el email">
                </div>
                <div class="form-group">
                    <label class="fw-lighter text-lowercase" for="input_descripcion">password</label>
                    <input type="text"
                        class="shadow form-control "
                        id="input_password"
                        name="input_password"
                        aria-describedby="password"
                        placeholder="Introduce tu password">
                </div>
                <div class="container__btns-form">
                    <button type="submit" class="btn btn-primary btns-form__btn-enviar">Enviar</button>
                    <button type="reset" class="btn btn-danger">Borrar</button>
                </div>
            </div>
        </form>
        <?php if (!empty($errores) && isset($errores["error_db"])): ?>
            <p id="bdError" class="text-danger"><?= $errores["error_db"] ?></p>
        <?php endif; ?>
    </main>
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="../public/js/datepickerinitialzr.js"></script>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
        <title>Gestión de Productos</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
        <?php 
            include 'functions.php'; 
            if(!isset($_POST["action"])) header('Location:index.php');
        ?>
    </head>
    <body class="text-center">
        <div class="container">
            <br>
            <!-- Header -->
            <div class="row">
                <div class="col-12">
                    <h1><?php echo $_POST["name"]?></h1>
                </div>
            </div>
            <br>
            <!-- Table -->
            <div class="row">
                <div class="col-12">
                    <h3><?php echo $_POST["initials"]?></h3>
                    <h3><?php echo "Código: " . $_POST["id"]?></h3>
                    <h3><?php echo "Familia: " . $_POST["type"]?></h3>
                    <h3><?php echo "Precio de Venta al Público: " . $_POST["retail"] . " €"?></h3>
                    <h5><?php echo "Descripción: " . $_POST["description"]?></h5>
                </div>
            </div>
            <br>
            <!-- Button Edit -->
            <div class="row" style="margin-bottom: 15px;">
                <div class="col-12">
                    <form method="POST" action="form.php">
                        <input name="action" type="hidden" value="edit">
                        <input name='id' type='hidden' value='<?php echo $_POST["id"]?>?>'>
                        <input name='name' type='hidden' value='<?php echo $_POST["name"]?>'>
                        <input name='initials' type='hidden' value='<?php echo $_POST["initials"] ?>'>
                        <input name='description' type='hidden' value='<?php echo $_POST["description"]?>'>
                        <input name='retail' type='hidden' value='<?php echo $_POST["retail"] ?>'>
                        <input name='type' type='hidden' value='<?php echo $_POST["type"]?>'>
                        <div class="d-grid gap-2">
                            <button class="btn btn-warning" type="submit">Editar</button>
                        </div>
                    </form>    
                </div>
            </div>
            <!-- Button Return -->
            <div class="row" style="margin-bottom: 15px;">
                <div class="col-12">
                    <form method="POST" action="index.php">
                        <div class="d-grid gap-2">
                            <button class="btn btn-secondary" type="submit">Volver</button>
                        </div>
                    </form>    
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>
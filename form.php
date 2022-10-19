<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
        <title>Gestión de Productos</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <?php include 'functions.php' ?>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-3"></div>
                <div class="col-6">
                    <br>
                    <h1 class="text-center">Insertar Producto</h1>
                    <br>
                    <!-- Form -->
                    <form method="POST" action="index.php">
                        <div class="mb-3">
                          <label for="name" class="form-label">Nombre del Producto</label>
                             <input type="text" class="form-control" name="name">
                        </div>
                        <div class="mb-3">
                          <label for="initals" class="form-label">Abreviación/Nombre Corto</label>
                          <input type="text" class="form-control" name="initals">
                        </div>
                        <div class="mb-3">
                          <label for="description" class="form-label">Descripción</label>
                          <textarea class="form-control" name="description" min="0" rows="6"></textarea>
                        </div>
                        <div class="mb-3">
                          <label for="retail" class="form-label">Precio de Venta al Público</label>
                          <input type="number" class="form-control" name="retail" min="0">
                        </div>
                        <div class="mb-3">
                          <label for="type">Familia de Artículos</label>
                          <?php showTypesSelect(); ?>
                        </div>
                        <div class="d-grid gap-2">
                            <input name="action" type="hidden" value="insert">
                            <input class="btn btn-primary" type="submit" value="Insertar">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>


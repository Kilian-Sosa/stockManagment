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
            <!-- Header -->
            <div class="row">
                <div class="col-12">
                    <h1 class="text-center">Gestión de Productos</h1>
                </div>
            </div>
            <!-- Table -->
            <div class="row">
                <div class="col-12">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Detalles</th>
                                <th scope="col">Nombre</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php readDB(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Button Insert -->
            <div class="row">
                <div class="col-12">
                    <form method="POST" action="form.php">
                        <input name="action" type="hidden" value="insert">
                        <div class="d-grid gap-2">
                            <button class="btn btn-success" type="submit">Insertar</button>
                        </div>
                    </form>    
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>

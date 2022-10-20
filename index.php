<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
        <title>Gestión de Productos</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <?php include 'functions.php'; ?>
    </head>
    <body class="text-center">
        <div class="container">
            <br>
            <?php 
                if(isset($_GET["action"])){
                    if($_GET["action"] == "insert"){
                        if($_GET["w"] == "true"){?>
                            <div class="alert alert-success" role="alert">Se ha añadido el producto correctamente</div>
                  <?php }else{?>
                            <div class="alert alert-danger" role="alert">Ha habido un problema al añadir el producto</div>
                  <?php }
                    }elseif($_GET["action"] == "edit"){

                    }else{
                        if(!isset($_GET["w"]))
                            checkIfDelWorked($_GET["id"]);
                    }
                }
            ?>
            <!-- Header -->
            <div class="row">
                <div class="col-12">
                    <h1>Gestión de Productos</h1>
                </div>
            </div>
            <br>
            <!-- Button Insert -->
            <div class="row" style="margin-bottom: 15px;">
                <div class="col-12">
                    <form method="POST" action="form.php">
                        <input name="action" type="hidden" value="insert">
                        <div class="d-grid gap-2">
                            <button class="btn btn-success" type="submit">Insertar</button>
                        </div>
                    </form>    
                </div>
            </div>
            <!-- Table -->
            <div class="row">
                <div class="col-12">
                    <table class="table table-striped table-dark">
                        <thead>
                            <tr>
                                <th scope="col">Detalles</th>
                                <th scope="col">Familia</th>
                                <th scope="col">Nombre</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php showProducts(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>
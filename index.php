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
                if(session_status() !== PHP_SESSION_NONE) unset($_SESSION['done']);
                if(isset($_GET["action"])){
                    if($_GET["action"] == "insert"){
                        if($_GET["w"] == "true"){?>
                            <div class="alert alert-success" role="alert">Se ha añadido el producto correctamente</div>
                  <?php }else{?>
                            <div class="alert alert-danger" role="alert">Ha habido un problema al añadir el producto</div>
                  <?php }
                    }elseif($_GET["action"] == "edit"){
                        if(!isset($_GET["w"])){?>
                            <div class="alert alert-success" role="alert">Se ha editado el producto correctamente</div>
                  <?php }else{?>
                                <div class="alert alert-danger" role="alert">Ha habido un problema al editar el producto</div>
                  <?php }
                    }elseif($_GET["action"] == "delete"){
                        if(!isset($_GET["w"]))
                            deleteProduct($_GET["id"]); 
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
                    <form method="POST" action="productForm.php">
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
                                <th scope="col">Detalles</a></th>
                                <?php if(!isset($_GET["order"]) || $_GET["order"] == "ASC"){?>
                                        <th scope="col">▼ <a href="index.php?field=familia&order=DESC">Familia</a></th>
                                        <th scope="col">▼ <a href="index.php?field=nombre&order=DESC">Nombre</a></th>
                                <?php }else{?>    
                                        <th scope="col">▲ <a href="index.php?field=familia&order=ASC">Familia</a></th>
                                        <th scope="col">▲ <a href="index.php?field=nombre&order=ASC">Nombre</a></th>
                                <?php }?>    
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php isset($_GET["order"]) ? showProducts($_GET["field"], $_GET["order"]) : showProducts(null, null); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>
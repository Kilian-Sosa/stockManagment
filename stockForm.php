<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
        <title>Gestión de Stock</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <?php 
            include 'functions.php';
            if(!isset($_POST["idProduct"])) header('Location:index.php');
        ?>
    </head>
    <body>
        <?php
            if(isset($_POST["action"])){ 
                checkIfMoveWorked($_POST["idShop1"], $_POST["idShop2"], $_POST["idProduct"], $_POST["currentUnits"], $_POST["unitsToMove"]);    
            }?>  
        <div class="container">   
            <?php echo $_POST["name"] ?>
            <div class="row">
                <div class="col-2"></div>
                <div class="col-8">
                    <br>
                    <?php echo "<h1 class='text-center'>Gestión de Stock</h1>";?>   
                    <?php echo "<h1 class='text-center'>$_POST[name]</h1>";?>       
                    <br>
                </div>
                <div class="col-2"></div>
            </div>        
            <!-- Table -->
            <div class="row">
                <div class="col-12">
                    <table class="table table-striped table-dark">
                        <thead>
                            <tr>
                                <th scope="col">Tienda</th>
                                <th scope="col">Stock actual</th>
                                <th scope="col">Nueva Tienda</th>
                                <th scope="col">Unidades</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php showStock($_POST["idProduct"]); ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <br>
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
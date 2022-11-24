<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
        <title>Gestión de Stock</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
<?php session_start(); 
    if(isset($_SESSION["validated"])){?>
    <body style="background-color: <?php echo $_SESSION["backgroundColor"];?>; font-family: <?php echo $_SESSION["font"];?>;">
<?php }else{?>
    <body style="background-color: <?php echo "#EFF5F5"; ?>; font-family: <?php echo "Arial";?>;">
<?php }
    
            include 'scripts/functions.php';
            if(!isset($_SESSION["validated"])) include 'scripts/login.php';
            else{
                if(!isset($_POST["idProduct"])) header('Location:index.php');
                if(isset($_POST["action"])){
                    moveStock($_POST["idShop1"], $_POST["idShop2"], $_POST["idProduct"], $_POST["currentUnits"], $_POST["unitsToMove"]);
                    header("Location: " . basename($_SERVER['REQUEST_URI']));
                }    
                ?>  
        <div class="container">  
            <div class="d-flex justify-content-between align-items-center p-3">
                <!-- Log Out -->
                <div class="d-flex align-items-center">
                    <a href="index.php?endSession" class="mx-2 btn btn-sm btn-danger"><i class="bi bi-power"></i></a>
                    <p class="m-0">Cerrar Sesión</p>
                </div>
                <!-- Access to the Perfil Conf -->
                <div class="d-flex align-items-center">
                        <?php if($_SESSION['username'] != ""){?>
                            <p class="m-0 font-monospace"><b><?php echo $_SESSION["username"]?></b></p>
                    <?php }else{?>
                        <p class="m-0 font-monospace"><b><?php echo $_SESSION["validated"]?></b></p>
                    <?php }?>
                    <form method="POST" action="profile.php">
                        <input type="hidden" name="page" value="<?php echo basename($_SERVER['REQUEST_URI']);?>">
                        <?php if(isset($_POST['idProduct'])){?> <input type="hidden" name="idProduct" value="<?php echo $_POST['idProduct']?>"><?php }?>
                        <?php if(isset($_POST['name'])){?> <input type="hidden" name="name" value="<?php echo $_POST['name']?>"><?php }?>
                        <button type="submit" class="mx-2 btn btn-sm btn-secondary"><i class='bi bi-gear-fill'></i></button>
                    </form>
                </div>
            </div> 
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
        <?php }?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>
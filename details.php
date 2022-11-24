<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
        <title>Gestión de Productos</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
<?php session_start(); 
    if(isset($_SESSION["validated"])){?>
    <body class="text-center" style="background-color: <?php echo $_SESSION["backgroundColor"];?>; font-family: <?php echo $_SESSION["font"];?>;">
<?php }else{?>
    <body class="text-center" style="background-color: <?php echo "#EFF5F5"; ?>; font-family: <?php echo "Arial";?>;">
<?php }
            include 'scripts/functions.php'; 
            if(!isset($_SESSION["validated"])) include 'scripts/login.php';
            else{
                if(!isset($_POST["action"])) header('Location:index.php');
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
                        <input type="hidden" name="action" value="<?php echo $_POST['action'];?>">
                        <input type="hidden" name="id" value="<?php echo $_POST['id'];?>">
                        <input type="hidden" name="name" value="<?php echo $_POST['name'];?>">
                        <input type="hidden" name="initials" value="<?php echo $_POST['initials'];?>">
                        <?php if(isset($_POST['description'])){?> <input type="hidden" name="description" value="<?php echo $_POST['description'];?>"><?php }?>
                        <input type="hidden" name="retail" value="<?php echo $_POST['retail'];?>">
                        <input type="hidden" name="type" value="<?php echo $_POST['type'];?>">
                        <button type="submit" class="mx-2 btn btn-sm btn-secondary"><i class='bi bi-gear-fill'></i></button>
                    </form>
                </div>
            </div>
            <!-- Header -->
            <div class="row">
                <div class="col-12">
                    <h1><?php echo $_POST["name"]?></h1>
                </div>
            </div>
            <br>
            <!-- Specifications -->
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
        <?php }?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>
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
    <body style="background-color: <?php echo $_SESSION["backgroundColor"];?>; font-family: <?php echo $_SESSION["font"];?>;">
<?php }else{?>
    <body style="background-color: <?php echo "#EFF5F5"; ?>; font-family: <?php echo "Arial";?>;">
<?php }
            include 'scripts/functions.php';
            if(!isset($_SESSION["validated"])) include 'scripts/login.php';
            else{
                $name = "";
                $id = "";
                $initials = "";
                $description = "";
                $retail = "";
                $type = "";

                if(isset($_POST["action"])){ 
                    if(isset($_POST["name"])){
                        $name = $_POST["name"];
                        $id = $_POST["id"];
                        $initials = $_POST["initials"];
                        $description = $_POST["description"];
                        $retail = $_POST["retail"];
                        $type = $_POST["type"];
                        if($_POST["action"] == "insert")
                            insertProduct($name, $initials, $description, $retail, $type) ? header('Location:index.php?action=insert&w=true') : header('Location:index.php?action=insert&w=false');
                        elseif($_POST["action"] == "edit" && isset($_POST["f"]))
                            updateProduct($id, $name, $initials, $description, $retail, $type) ? header('Location:index.php?action=edit&w=true') : header('Location:index.php?action=edit&w=false'); 
                    }    
                }else{
                    header('Location:index.php');
                }?>   
        <div class="container">
            <div class="d-flex justify-content-between align-items-center p-3">
                <!-- Log Out -->
                <div class="d-flex align-items-center">
                    <a href="index.php?endSession" class="mx-2 btn btn-sm btn-danger"><i class="bi bi-power"></i></a>
                    <p class="m-0">Cerrar Sesión</p>
                </div>
                <!-- Access to the Perfil Conf -->
                <div class="d-flex align-items-center">
                    <p class="m-0 font-monospace"><b><?php echo $_SESSION["validated"]?></b></p>
                    <form method="POST" action="profile.php">
                        <input type="hidden" name="page" value="<?php basename($_SERVER['REQUEST_URI']);?>">
                        <button type="submit" class="mx-2 btn btn-sm btn-secondary"><i class='bi bi-gear-fill'></i></button>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-3"></div>
                <div class="col-6">
                    <?php if($_POST["action"] == "insert")
                            echo '<h1 class="text-center">Insertar Producto</h1>';
                        elseif($_POST["action"] == "edit")
                            echo '<h1 class="text-center">Actualizar Producto</h1>';
                    ?>   
                </div>
                <div class="col-3"></div>
            </div>             
            <br>
                    
            <!-- Form -->
            <div class="row">
                <div class="col-12">
                    <form method="POST" action="form.php">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre del Producto</label>
                            <input type="text" class="form-control" name="name" required value="<?php echo $name;?>">
                        </div>
                        <div class="mb-3">
                            <label for="initials" class="form-label">Abreviación/Nombre Corto</label>
                            <input type="text" class="form-control" name="initials" required value="<?php echo $initials;?>">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Descripción</label>
                            <textarea class="form-control" name="description" min="0" rows="6"><?php echo $description;?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="retail" class="form-label">Precio de Venta al Público (€)</label>
                            <input type="number" class="form-control" name="retail" min="0" required value="<?php echo $retail;?>">
                        </div>
                        <div class="mb-3">
                            <label for="type">Familia de Artículos</label>
                            <?php 
                                if($_POST["action"] == "insert") showTypesSelect();
                                elseif($_POST["action"] == "edit") showATypeSelect($type);
                            ?>
                        </div>
                        <div class="d-grid gap-2">
                            <?php if($_POST["action"] == "insert")
                                    echo '<input name="action" type="hidden" value="insert">
                                          <input class="btn btn-primary" type="submit" value="Insertar">';
                                elseif($_POST["action"] == "edit")
                                    echo '<input name="action" type="hidden" value="edit">
                                          <input name="id" type="hidden" value="' . $id . '">
                                          <input name="f" type="hidden" value="t">
                                          <input class="btn btn-warning" type="submit" value="Editar">';
                            ?>        
                        </div>
                    </form>
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
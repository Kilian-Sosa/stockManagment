<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
        <title>Gestión de Productos</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <?php include 'functions.php';?>
    </head>
    <body>
        <div class="container">
            <?php
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
                            checkIfInsertWorked($name, $initials, $description, $retail, $type);
                        elseif($_POST["action"] == "edit" && isset($_POST["f"]))
                            checkIfUpdateWorked($id, $name, $initials, $description, $retail, $type); 
                    }    
                }else{
                    header('Location:index.php');
                }?>   
            <div class="row">
                <div class="col-3"></div>
                <div class="col-6">
                    <br>
                    <?php if($_POST["action"] == "insert")
                            echo '<h1 class="text-center">Insertar Producto</h1>';
                        elseif($_POST["action"] == "edit")
                            echo '<h1 class="text-center">Actualizar Producto</h1>';
                    ?>        
                    <br>
                    
                    <!-- Form -->
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
                          <?php showTypesSelect($type);?>
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Perfil</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <?php include 'scripts/functions.php';
        ?>
    </head>
<?php session_start(); 
    if(isset($_SESSION["validated"])){?>
    <body style="background-color: <?php echo $_SESSION["backgroundColor"];?>; font-family: <?php echo $_SESSION["font"];?>;">
<?php }else{?>
    <body style="background-color: <?php echo "#EFF5F5"; ?>; font-family: <?php echo "Arial";?>;">
        <?php }
            if(!isset($_SESSION["validated"])) include 'scripts/login.php';
            else{
                $action = array_key_exists('action', $_POST) ? $_POST['action'] : "";
                $id = array_key_exists('id', $_POST) ? $_POST['id'] : "";
                $name = readUserNameFromDB();
                $font = $_SESSION['font'];
                $backgroundColor = $_SESSION['backgroundColor'];
                if(isset($_POST['name'])) {
                    $_SESSION['backgroundColor'] = $_POST['backgroundColor'];
                    $_SESSION['font'] = $_POST['font'];
                    updateUser($_POST['name'], $_POST['backgroundColor'], $_POST['font']);
                    header("Location: " . parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH));
                }
        ?>

        <div class="container">
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
            <div class="row">
                <div class="col-12">
                    <h1 class="font-monospace text-center">Perfil</h1>
                </div>
            </div>
            <div class="row">
                <form method="POST" action="profile.php">
                    <input type="hidden" name="page" value="<?php echo $page; ?>">
                    <?php if ($action != "") { ?>
                    <input type="hidden" name="action" value="<?php echo $action; ?>">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <?php } ?>

                    <div class="mb-3">
                        <label for="nombrecompleto" class="form-label">Nombre y Apellidos</label>
                        <input type='text' class='form-control' name='name' placeholder='Nombre y Apellidos...' value='<?php echo $name?>' maxlength='200' required>
                    </div>
                    <br><hr><br>
                    <div class="col-6 mx-auto">
                        <label for="font" class="form-label">Tipo de letra</label>
                        <select class="form-select" name="font" required>
                            <option value="<?php echo $font; ?>" selected hidden><?php echo $font; ?></option>;
                            <option value="Consolas">Consolas</option>;
                            <option value="Arial">Arial</option>;
                            <option value="Serif">Serif</option>;
                            <option value="Times New Roman">Times New Roman</option>;
                            <option value="Comic Sans MS">Comic Sans MS</option>;
                        </select>
                    </div>
                    <div class="m-5 d-flex justify-content-center">
                        <label for="backgroundColor" class="mx-2 form-label">Color de fondo</label>
                        <div class="col-1">
                            <input type='color' class='p-0 form-control' name='backgroundColor' value='<?php echo $colorfondo?>' required>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="col-4 btn btn-primary">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
        <?php }?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
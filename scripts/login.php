<div id="login" style="text-align: center;">
    <?php 
        if(isset($_POST['user'])){
            global $connection;
            $result = $connection -> query("SELECT * from usuarios WHERE usuario='" . $_POST['user'] . "' AND clave='" . hash('sha256', $_POST['pass']) . "'");
                
            if($result -> rowCount() == 0){
                setWrongLogInCookies(array($_POST['user'], $_POST['pass']));
                header("Location: " . parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH) . "?error=true");
            }else{
                successfulAccess($result -> fetch(PDO::FETCH_OBJ));
                header("Location: " . parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH));
            }    
        }    

        if(!isset($_SESSION["validated"])){
            if(isset($_GET['error'])){?>
                <div class="alert alert-danger" role="alert">Usuario o Contraseña incorrecta</div><?php
            }
            echo "<br><h1>Inicie Sesión para acceder al contenido</h1>";
            if(isset($_COOKIE["successfulAccess"])) echo "Último acceso en este dispositivo: " . $_COOKIE["successfulAccess"];
            echo "<br><br><form method='POST' action='" . parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH) . "'>"?>
                <div class="col-6 mx-auto">
                    <p class="m-0 fs-5">Usuario</p>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                        <input type="text" class="form-control" name="user" placeholder="Nombre de Usuario" required>
                    </div>
                </div>

                <div class="col-6 mx-auto">
                    <p class="m-0 fs-5">Contraseña</p>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                        <input type="password" class="form-control" name="pass" placeholder="Contraseña" required>
                    </div>
                </div>
                <div class="col-6 mx-auto">
                    <div class="form-check" style="text-align: left;">
                        <input class="form-check-input" type="checkbox" name="saveState" value="true" <?php if(isset($_COOKIE["saveState"])) { ?> checked
                            <?php } ?> />
                        <label class="form-check-label" for="">Recuérdame</label>
                    </div>
                </div>
                <input class='btn btn-info' type="submit" value="Iniciar Sesión" style="color: white;"><br>
            </form>
    <?php } ?>    
</div>
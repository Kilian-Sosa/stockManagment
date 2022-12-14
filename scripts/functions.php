<?php
    $connection = connectToDB();
    $connection -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    function connectToDB(){
        $HOST = "localhost";
        $DATABASE = "proyecto";
        $USER = "usuario";
        $PASSWORD = "1234";
        $DSN = "mysql:host=$HOST;dbname=$DATABASE";
        try{
            return new PDO($DSN, $USER, $PASSWORD);
        }catch(Exception $e){?>
            <div class="alert alert-danger" role="alert"><?php echo "Error conectando a la base de datos -> " . $e -> getMessage();?></div>
            <?php die();
        }
    }
    
    function readProductsFromDB(){
        try{
            global $connection;
            return $connection -> query('SELECT * from productos ORDER BY nombre ASC');
        }catch(Exception $e){return false;}
    }
    
    function readTypesFromDB(){
        try{
            global $connection;
            return $connection -> query('SELECT * from familias ORDER BY nombre ASC');
        }catch(Exception $e){return false;}
    }
    
    function readATypeFromDB($type){
        try{
            global $connection;
            $sentence = $connection -> prepare("SELECT * from familias WHERE cod = ?");
            $sentence -> execute([$type]);
            return $sentence;
        }catch(Exception $e){return false;}
    }
    
    function readStockFromDB($id){
        try{
            global $connection;
            $sentence = $connection -> prepare("SELECT * from stocks, tiendas WHERE stocks.tienda = tiendas.id and producto = ? ORDER BY nombre ASC");
            $sentence -> execute([$id]);
            return $sentence;
        }catch(Exception $e){return false;}
    }
    
    function readShopsFromDB(){
        try{
            global $connection;
            return $connection -> query("SELECT * from tiendas ORDER BY nombre ASC");
        }catch(Exception $e){return false;}
    }
    
    function checkIDFromDB($id){
        try{
            global $connection;
            $sentence = $connection -> prepare("SELECT * from productos WHERE id = ?");
            $sentence -> execute([$id]);
            if($sentence -> rowCount() == 0){?> <div class="alert alert-danger" role="alert">No se ha encontrado el ID</div><?php }
            return true;
        }catch(Exception $e){return false;}
    }

    function showProducts(){   
        $records = readProductsFromDB(); 
        while($object = $records -> fetch(PDO::FETCH_OBJ))
            echo "<tr>
                    <td>
                        <!-- Button Details -->
                        <form method='POST' action='details.php'>
                            <input name='action' type='hidden' value='details'>
                            <input name='id' type='hidden' value='" . $object -> id . "'>
                            <input name='name' type='hidden' value='" . $object -> nombre . "'>
                            <input name='initials' type='hidden' value='" . $object -> nombre_corto . "'>
                            <input name='description' type='hidden' value='" . $object -> descripcion . "'>
                            <input name='retail' type='hidden' value='" . $object -> pvp . "'>
                            <input name='type' type='hidden' value='" . $object -> familia . "'>
                            <input class='btn btn-info' type='submit' value='Detalles'>
                        </form> 
                    </td>
                    <td>" . $object -> familia . "</td>
                    <td>" . $object -> nombre . "</td>
                    <td>
                        <!-- Button Stock -->
                        <form method='POST' action='stockForm.php'>
                            <input name='idProduct' type='hidden' value='" . $object -> id . "'>
                            <input name='name' type='hidden' value='" . $object -> nombre . "'>
                            <input class='btn btn-secondary' type='submit' value='Mover Stock'>
                        </form> 
                    </td>
                    <td>
                        <div style='display: flex'>
                            <!-- Button Edit -->
                            <form method='POST' action='productForm.php'>
                                <input name='action' type='hidden' value='edit'>
                                <input name='id' type='hidden' value='" . $object -> id . "'>
                                <input name='name' type='hidden' value='" . $object -> nombre . "'>
                                <input name='initials' type='hidden' value='" . $object -> nombre_corto . "'>
                                <input name='description' type='hidden' value='" . $object -> descripcion . "'>
                                <input name='retail' type='hidden' value='" . $object -> pvp . "'>
                                <input name='type' type='hidden' value='" . $object -> familia . "'>
                                <input class='btn btn-warning' type='submit' value='Actualizar'>
                            </form> 
                            <!-- Button Delete -->
                            <form method='GET' action='index.php' style='margin-left: 10px'>
                                <input name='action' type='hidden' value='delete'>
                                <input name='id' type='hidden' value='" . $object -> id . "'>
                                <input class='btn btn-danger' type='submit' value='Borrar'>
                            </form>   
                        </div>
                    </td>
                </tr>";
    }    

    function showStock($id){   
        $records = readStockFromDB($id); 
        while($object = $records -> fetch(PDO::FETCH_OBJ)){
            echo "<tr>
                    <form method='POST' action='stockForm.php'>
                        <input name='action' type='hidden' value='mvStock'>
                        <td>" . $object -> nombre . "</td>
                        <td>" . $object -> unidades . " unidades</td>";
            echo "<td>"; showShopsSelect($object -> id); echo "</td>";
            echo "<td><input type='number' class='form-control form-control' name='unitsToMove' value='1' min='1' max='" . $object -> unidades . "'></td>
                        <td></td>
                        <td>
                            <div style='display: flex'>
                                <input name='idShop1' type='hidden' value='" . $object -> id . "'>
                                <input name='idProduct' type='hidden' value='" . $object -> producto . "'>
                                <input name='currentUnits' type='hidden' value='" . $object -> unidades . "'>
                                <input name='name' type='hidden' value='" . $_POST["name"] . "'>
                                <input class='btn btn-warning' type='submit' value='Mover Stock'>
                            </div>
                        </td>
                    </form>     
                </tr>";
        }        
    }    
    
    function showTypesSelect(){   
        $records = readTypesFromDB();
        echo "<select name='type' required>
                  <option value=''>--Selecciona--</option>";
        while($object = $records -> fetch(PDO::FETCH_OBJ))
            echo "<option value='" . $object -> cod . "'>" . $object -> nombre . "</option>";
        echo "</select>";
    } 
    
    function showShopsSelect($id){   
        $records = readShopsFromDB();
        echo "<select class='form-select form-select' aria-label='.form-select-lg example' name='idShop2' required>";
        while($object = $records -> fetch(PDO::FETCH_OBJ))
            if($object -> id != $id) echo "<option value='" . $object -> id . "'>" . $object -> nombre . "</option>";
        echo "</select>";
    }

    function showATypeSelect($type){   
        $records = readATypeFromDB($type);
        $object = $records -> fetch(PDO::FETCH_OBJ);
        $records = readTypesFromDB();
        echo "<select name='type' required>
                  <option selected value='$type'>" . $object -> nombre . "</option>";
        while($object = $records -> fetch(PDO::FETCH_OBJ))
            if($object -> cod != $type) echo "<option value='" . $object -> cod . "'>" . $object -> nombre . "</option>";
        echo "</select>";
    }          

    function insertProduct($name, $initials, $description, $retail, $type){
        try{
            global $connection;
            $sentence = $connection -> prepare("INSERT INTO productos(nombre, nombre_corto, descripcion, pvp, familia) VALUES (?, ?, ?, ?, ?);");
            return $sentence -> execute([$name, $initials, $description, $retail, $type]);
        }catch(Exception $e){return false;}
    }

    function updateProduct($id, $name, $initials, $description, $retail, $type){
        if(!checkIDFromDB($id)) return;
        try{
            global $connection;
            $sentence = $connection -> prepare("UPDATE productos SET nombre = ?, nombre_corto = ?, descripcion = ?, pvp = ?, familia = ? WHERE id = ?;");
            return $sentence -> execute([$name, $initials, $description, $retail, $type, $id]);
        }catch(Exception $e){return false;}
    }

    function deleteProduct($id){
        if(!checkIDFromDB($id)) return;
        try{
            global $connection;
            $sentence = $connection -> prepare("DELETE FROM productos WHERE id = ?;");
            $sentence -> execute([$id]);?>

            <div class="alert alert-success" role="alert">Se ha eliminado el producto correctamente</div>
    <?php }catch(Exception $e){?>
            <div class="alert alert-danger" role="alert"><?php echo "Ha habido un problema al eliminar el producto -> " . $e -> getMessage();?></div>
    <?php }
    }

    function getCurrentUnits($idProduct, $idShop){
        global $connection;
        $sentence = $connection -> prepare("SELECT unidades FROM stocks WHERE producto = ? and tienda = ?;");
        $sentence -> execute([$idProduct, $idShop]);
        if($sentence -> rowCount() > 0) return $sentence -> fetch();
        return 0;
    }

    function insertStock($idProduct, $idShop, $units){
        global $connection;
        $sentence = $connection -> prepare("INSERT INTO stocks(producto, tienda, unidades) VALUES (?, ?, ?);");
        $sentence -> execute([$idProduct, $idShop, $units]);
    }

    function updateStock($idProduct, $idShop, $units){
        global $connection;
        $sentence = $connection -> prepare("UPDATE stocks SET unidades = ? WHERE producto = ? and tienda = ?;");
        $sentence -> execute([$units, $idProduct, $idShop]);
    }

    function deleteStock($idProduct, $idShop){
        global $connection;
        $sentence = $connection -> prepare("DELETE FROM stocks WHERE producto = ? and tienda = ?;");
        $sentence -> execute([$idProduct, $idShop]);
    }

    function moveStock($idShop1, $idShop2, $idProduct, $currentUnits, $unitsToMove){
        if(!checkIDFromDB($idProduct)) return;
        try{
            global $connection;
            $connection -> beginTransaction();
            $currentUnits == $unitsToMove ? deleteStock($idProduct, $idShop1) : updateStock($idProduct, $idShop1, ($currentUnits - $unitsToMove));
            $unitsInShop2 = getCurrentUnits($idProduct, $idShop2);
            $unitsInShop2 == 0 ? insertStock($idProduct, $idShop2, $unitsToMove): updateStock($idProduct, $idShop2, ($unitsInShop2[0] + $unitsToMove));
            $connection -> commit();?>

            <div class="alert alert-success" role="alert">Se ha movido el stock correctamente</div>
  <?php }catch(Exception $e){
            $connection -> rollBack();?>
            <div class="alert alert-danger" role="alert"><?php echo "Hubo un error durante la transacci??n -> " . $e -> getMessage();?></div>
  <?php }
    }

    function showProductsPerPageSelect(){
        $records = readTypesFromDB();
        $size = $records -> rowCount();
        echo "<select name='type' required>
                  <option value='5'>Mostrar 5 registros por p??gina</option>";
        for($i = 5; $i < $size; $i += 5)
            echo "<option value='" . $i . "'>Mostrar " . $i ." registros por p??gina</option>";
        echo "<option value='" . $size . "'>Mostrar todos los registros en una p??gina (" . $size . ")</option>"; 
        echo "</select>";
    }

    function setWrongLogInCookies($array){
        setcookie(
            'errorCount',
            isset($_COOKIE['errorCount']) ? ++$_COOKIE['errorCount'] : 1,
            strtotime("+1 year")
          );

        if(isset($_COOKIE["wrongAccess"])){
            $num = sizeof($_COOKIE['wrongAccess']);
            setcookie(
              "wrongAccess[$num]",
              $array[0] . "-" . hash('sha256', $array[1]),
              strtotime("+1 year")
            );
        }else
            setcookie(
              "wrongAccess[0]",
              $array[0] . "-" . hash('sha256', $array[1]),
              strtotime("+1 year")
            );
    }

    function successfulAccess($record){
        $_SESSION["validated"] = $_POST['user'];
        $_SESSION["username"] = $record -> nombrecompleto;
        $_SESSION["email"] = $record -> correo;
        $_SESSION["backgroundColor"] = $record -> colorfondo;
        $_SESSION["font"] = $record -> tipoletra;
        if(isset($_POST["saveState"])) setcookie("saveState", $_POST['user'], strtotime("+1 year"));

        date_default_timezone_set('Europe/London');
        setcookie("successfulAccess", date("d/m H:i"), strtotime("+1 year"));
    }

    function updateUser($name, $email, $backgroundColor, $font){
        try{
            global $connection;
            $sentence = $connection -> prepare("UPDATE usuarios SET nombrecompleto = ?, correo = ?, colorfondo = ?, tipoletra = ? WHERE usuario = ?;");
            $sentence -> execute([$name, $email, $backgroundColor, $font, $_SESSION['validated']]);
        }catch(Exception $e){return false;}
    }
?>
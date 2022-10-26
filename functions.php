<?php
    function connectToDB(){
        $HOST = "localhost";
        $DATABASE = "proyecto";
        $USER = "usuario";
        $PASSWORD = "1234";
        $DSN = "mysql:host=$HOST;dbname=$DATABASE";
        try{
            return new PDO($DSN, $USER, $PASSWORD);
        }catch(Exception $e){
            die("Error: " . $e -> getMessage());
        }
    }
    
    function readProductsFromDB(){
        return connectToDB() -> query('SELECT * from productos ORDER BY nombre ASC');
    }
    
    function readTypesFromDB(){
        return connectToDB() -> query('SELECT * from familias ORDER BY nombre ASC');
    }
    
    function readATypeFromDB($type){
        $sentence = connectToDB() -> prepare("SELECT * from familias WHERE cod = ?");
        $sentence -> execute([$type]);
        return $sentence;
    }
    
    function readStockFromDB($id){
        $sentence = connectToDB() -> prepare("SELECT * from stocks, tiendas WHERE stocks.tienda = tiendas.id and producto = ? ORDER BY nombre ASC");
        $sentence -> execute([$id]);
        return $sentence;
    }
    
    function readShopsFromDB(){
        return connectToDB() -> query("SELECT * from tiendas ORDER BY nombre ASC");
    }
    
    function checkIDFromDB($id){
        $sentence = connectToDB() -> prepare("SELECT * from productos WHERE id = ?");
        $sentence -> execute([$id]);
        return $sentence -> rowCount() > 0;
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
        $sentence = connectToDB() -> prepare("INSERT INTO productos(nombre, nombre_corto, descripcion, pvp, familia) VALUES (?, ?, ?, ?, ?);");
        return $sentence -> execute([$name, $initials, $description, $retail, $type]);
    }

    function updateProduct($id, $name, $initials, $description, $retail, $type){
        $sentence = connectToDB() -> prepare("UPDATE productos SET nombre = ?, nombre_corto = ?, descripcion = ?, pvp = ?, familia = ? WHERE id = ?;");
        return $sentence -> execute([$name, $initials, $description, $retail, $type, $id]);
    }

    function deleteProduct($id){
        $sentence = connectToDB() -> prepare("DELETE FROM productos WHERE id = ?;");
        return $sentence -> execute([$id]);
    }

    function getCurrentUnits($idProduct, $idShop){
        $sentence = connectToDB() -> prepare("SELECT unidades FROM stocks WHERE producto = ? and tienda = ?;");
        $sentence -> execute([$idProduct, $idShop]);
        if($sentence -> rowCount() > 0) return $sentence -> fetch();
        return 0;
    }

    function insertStock($connection, $idProduct, $idShop, $units){
        $sentence = $connection -> prepare("INSERT INTO stocks(producto, tienda, unidades) VALUES (?, ?, ?);");
        $sentence -> execute([$idProduct, $idShop, $units]);
    }

    function updateStock($connection, $idProduct, $idShop, $units){
        $sentence = $connection -> prepare("UPDATE stocks SET unidades = ? WHERE producto = ? and tienda = ?;");
        $sentence -> execute([$units, $idProduct, $idShop]);
    }

    function deleteStock($connection, $idProduct, $idShop){
        $sentence = $connection -> prepare("DELETE FROM stocks WHERE producto = ? and tienda = ?;");
        $sentence -> execute([$idProduct, $idShop]);
    }

    function moveStock($idShop1, $idShop2, $idProduct, $currentUnits, $unitsToMove){
        try{
            $connection = connectToDB();
            $connection -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $connection -> beginTransaction();
            $currentUnits == $unitsToMove ? deleteStock($connection, $idProduct, $idShop1) : updateStock($connection, $idProduct, $idShop1, ($currentUnits - $unitsToMove));
            $unitsInShop2 = getCurrentUnits($idProduct, $idShop2);
            $unitsInShop2 == 0 ? insertStock($connection, $idProduct, $idShop2, $unitsToMove): updateStock($connection, $idProduct, $idShop2, ($unitsInShop2[0] + $unitsToMove));
            $connection -> commit();
        }catch(Exception $e){
            $connection -> rollBack();?>
            <div class="alert alert-danger" role="alert"><?php echo "Hubo un error durante la transacción -> " . $e -> getMessage();?></div>
  <?php }

    }

    function checkIfInsertWorked($name, $initials, $description, $retail, $type){
        if(insertProduct($name, $initials, $description, $retail, $type))
            header('Location:index.php?action=insert&w=true');
        else
            header('Location:index.php?action=insert&w=false'); 
    }

    function checkIfUpdateWorked($id, $name, $initials, $description, $retail, $type){
        if(!checkIDFromDB($id) || updateProduct($id, $name, $initials, $description, $retail, $type))
            header('Location:index.php?action=edit&w=true');
        else
            header('Location:index.php?action=edit&w=false'); 
    }

    function checkIfDelWorked($id){
        if(!checkIDFromDB($id) || deleteProduct($id)){?>
            <div class="alert alert-success" role="alert">Se ha eliminado el producto correctamente</div>
  <?php }else{?>
            <div class="alert alert-danger" role="alert">Ha habido un problema al eliminar el producto</div>
  <?php }
    }

    function checkIfMoveWorked($idShop1, $idShop2, $idProduct, $currentUnits, $unitsToMove){
        if(!checkIDFromDB($idProduct) || moveStock($idShop1, $idShop2, $idProduct, $currentUnits, $unitsToMove)){?>
            <div class="alert alert-success" role="alert">Se ha movido el stock correctamente</div>
  <?php }
    }
?>
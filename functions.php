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

    function showProducts(){   
        $records = readProductsFromDB(); 
        while($object = $records -> fetch(PDO::FETCH_OBJ))
            echo "<tr>
                    <td>
                        <!-- Button Details -->
                        <form method='POST' action='details.php'>
                            <input name='action' type='hidden' value='edit'>
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
                    <td></td>
                    <td>
                        <div style='display: flex'>
                            <!-- Button Edit -->
                            <form method='POST' action='form.php'>
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
    
    function showTypesSelect(){   
        $records = readTypesFromDB();
        echo "<select name='type' required>
                  <option value=''>--Selecciona--</option>";
        while($object = $records -> fetch(PDO::FETCH_OBJ))
            echo "<option value='" . $object -> cod . "'>" . $object -> nombre . "</option>";
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

    function checkIfInsertWorked($name, $initials, $description, $retail, $type){
        if(insertProduct($name, $initials, $description, $retail, $type))
            header('Location:index.php?action=insert&w=true');
        else
            header('Location:index.php?action=insert&w=false'); 
    }

    function checkIfUpdateWorked($id, $name, $initials, $description, $retail, $type){
        if(!updateProduct($id, $name, $initials, $description, $retail, $type))
            header('Location:index.php?action=edit&w=true');
        else
            header('Location:index.php?action=edit&w=false'); 
    }

    function checkIfDelWorked($id){
        if(deleteProduct($id)){?>
            <div class="alert alert-success" role="alert">Se ha eliminado el producto correctamente</div>
  <?php }else{?>
            <div class="alert alert-danger" role="alert">Ha habido un problema al eliminar el producto</div>
  <?php }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
        <title>Gestión de Productos</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.12.1/r-2.3.0/datatables.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <?php include 'scripts/functions.php'; ?>
    </head>
<?php session_start(); 
    if(isset($_SESSION["validated"])){?>
    <body style="background-color: <?php echo $_SESSION["backgroundColor"];?>; font-family: <?php echo $_SESSION["font"];?>;">
<?php }else{?>
    <body style="background-color: <?php echo "#EFF5F5"; ?>; font-family: <?php echo "Arial";?>;">
<?php }?>
        <div class="container">
            <?php 
                if(isset($_GET["endSession"])){ 
                    session_destroy(); 
                    header("Location: " . parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH));
                    setcookie("PHPSESSID", "", time() - 3600, "/");
                    setcookie("saveState", "", time() - 3600);
                }
                if(!empty($_COOKIE["saveState"])) $_SESSION["validated"] = $_COOKIE["saveState"];
                else include 'scripts/login.php'; 

                if(isset($_SESSION["validated"])){
                    if(isset($_GET["action"])){
                        if($_GET["action"] == "insert"){
                            if($_GET["w"] == "true"){?>
                                <div class="alert alert-success" role="alert">Se ha añadido el producto correctamente</div>
                    <?php }else{?>
                                <div class="alert alert-danger" role="alert">Ha habido un problema al añadir el producto</div>
                    <?php }
                        }elseif($_GET["action"] == "edit"){
                            if(!isset($_GET["w"])){?>
                                <div class="alert alert-success" role="alert">Se ha editado el producto correctamente</div>
                    <?php }else{?>
                                <div class="alert alert-danger" role="alert">Ha habido un problema al editar el producto</div>
                    <?php }
                        }elseif($_GET["action"] == "delete")
                            if(!isset($_GET["w"])) deleteProduct($_GET["id"]); 
                    }
                ?>

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
                            <input type="hidden" name="page" value="index.php">
                            <button type="submit" class="mx-2 btn btn-sm btn-secondary"><i class='bi bi-gear-fill'></i></button>
                        </form>
                    </div>
                </div>
                <!-- Header -->
                <div class="row">
                    <div class="col-12">
                        <h1 style="text-align: center;">Gestión de Productos</h1>
                    </div>
                </div>
                <br>
                <!-- Button Insert -->
                <div class="row" style="margin-bottom: 15px;">
                    <div class="col-12">
                        <form method="POST" action="productForm.php">
                            <input name="action" type="hidden" value="insert">
                            <div class="d-grid gap-2">
                                <button class="btn btn-success" type="submit">Insertar</button>
                            </div>
                        </form>    
                    </div>
                </div>
                <!-- Table -->
                <div class="row">
                    <div class="col-12">
                        <table id="table" class="table table-striped table-dark">
                            <thead>
                                <tr>
                                    <th>Detalles</th>
                                    <th>Familia</th>
                                    <th>Nombre</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php showProducts()?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
            <script src="https://code.jquery.com/jquery-3.6.1.slim.min.js" integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA=" crossorigin="anonymous"></script>
            <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.12.1/r-2.3.0/datatables.min.js" defer></script>
            <script>
                $(document).ready(function() {
                    $('#table').DataTable({
                        order: [[2, 'asc']],
                        stateSave: true,
                        "columnDefs": [
                            {"className": "dt-center", "targets": "_all"},
                            {orderable: false, targets: [0, 3, 4]}
                        ],
                        pageLength : 5,
                        language: {
                        search: "Buscar:",
                        lengthMenu: "Mostrando <select class='form-select form-select' aria-label='.form-select-lg example'>" +
                            '<option value="5">5</option>'+
                            '<option value="10">10</option>'+
                            '<option value="15">15</option>'+
                            '<option value="20">20</option>'+
                            '<option value="25">25</option>'+
                            '<option value="-1">Todos</option>'+
                            '</select> productos',
                        info: "Mostrando de _START_ a _END_ de _TOTAL_ productos",
                        infoEmpty: "Mostrando 0 productos",
                        infoFiltered: "(filtrado de _MAX_ productos totales)",
                        zeroRecords: "No hay productos para mostrar",
                        emptyTable: "No hay datos disponibles",
                        paginate: {
                            previous: "<i class='bi bi-arrow-left-short'></i>",
                            next: "<i class='bi bi-arrow-right-short'></i>",
                        },
                        }
                    });
                });
            </script>
        <?php } ?>    
    </body>
</html>
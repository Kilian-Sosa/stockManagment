<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
        <title>Gestión de Productos</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.12.1/r-2.3.0/datatables.min.css" />
        <?php include 'functions.php'; ?>
    </head>
    <body>
        <div class="container">
            <br>
            <?php 
                if(session_status() !== PHP_SESSION_NONE) unset($_SESSION['done']);
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
                    }elseif($_GET["action"] == "delete"){
                        if(!isset($_GET["w"]))
                            deleteProduct($_GET["id"]); 
                    }
                }
            ?>
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
    </body>
</html>
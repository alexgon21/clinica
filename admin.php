<?php
include("validateRoute.php");
include("db.php");
$query = "SELECT * FROM solicitudes WHERE pendiente = true";
$result = $conn->query($query);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Exámenes</title>
     <!-- {{!-- Google fonts Roboto --}} -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <!-- {{!-- Font Awesome CDN --}} -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/solid.css" integrity="sha384-fZFUEa75TqnWs6kJuLABg1hDDArGv1sOKyoqc7RubztZ1lvSU7BS+rc5mwf1Is5a" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/fontawesome.css" integrity="sha384-syoT0d9IcMjfxtHzbJUlNIuL19vD9XQAdOzftC+llPALVSZdxUpVXE0niLOiw/mn" crossorigin="anonymous">
    <!-- {{!-- My Styles --}} -->
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/products.css">
    </body>
</head>

<body>
    <div class="nav_container">
        <nav class="nav" id="menuNormal">
            <div class="container">
                <div class="main_nav_buttons">
                    <div class="menu_icon nav_buttons" id="menu_button">
                        <i class="fas fa-bars"></i>
                        <span class="icon_text">Menu</span>
                    </div>

                </div>
                <div class="nav_buttons options">
                    <a href="admin.php" class="icon_link active building"><i class="fas fa-notes-medical active"></i><span class="icon_text active">Examenes pendientes</span></a>
                    <?php 
                        if($_SESSION['admin']){
                            echo '<a href="complete.php" class="icon_link building"><i class="fas fa-check"></i><span class="icon_text">Examenes completados</span></a>';
                        }
                    ?>
                    
                </div>
                <div class="logout_button nav_buttons">
                    <a href="logout.php" class="icon_link"><i class="fas fa-door-open"></i><span class="icon_text">Salir</span></a>
                </div>
            </div>
        </nav>
        <div class="alternative-menu" id="alternative-menu">
            <a href="admin.php" class="menu_link"><i class="fas fa-notes-medical"></i><span class="icon_text_alternative">Examenes pendientes</span></a>
            <?php 
                if($_SESSION['admin']){?>

                    <a href="complete.php" class="menu_link"><i class="fas fa-check"></i><span class="icon_text_alternative">Examenes completados</span></a>
            <?php } ?>
            <a href="logout.php" class="menu_link"><i class="fas fa-door-open"></i><span class="icon_text_alternative">Salir</span></a>
            
        </div>
    </div>

    <header class="header">
        <div class="container">
            <h2>Exámenes pendientes</h2>
            <?php 
                if($_SESSION['admin']){
                   echo '<a id="addProduct" href="addRequest.php"><i class="fas fa-plus"></i> Agregar solicitud de exámenes</a>';
                }
            ?>

        </div>
    </header>

    <main class="main">

        <div class="container">

            <ul class="products_list">

                <?php
                if ($result->num_rows > 0) {
                    // output data of each row
                    while ($row = $result->fetch_assoc()) { ?>
                        <li class="product" onclick=<?php
                            
                                $idd = $row["idSolicitud"];
                                $location = '"request.php?idSolicitud=' . $idd . '"';
                                echo 'location.href=' . $location ;
                            ?>
                        >

                                <div class="product_edit_iconbox">
                                    <a href="editRequest.php?idSolicitud=<?php echo $row['idSolicitud'] ?>"><i class="product_edit_iconbox_icon fas fa-pen"></i></a>
                                </div>
                        
                        
                            <div class="product_imgbox">
                                <i class="product_imgbox_img fas fa-notes-medical"></i>
                            </div>
                            <div class="product_info">
                                <div class="product_info_titlebox">
                                    <h3 class="product_info_titlebox_title">
                                         
                                        <?php
                                            $name = $row['nombre'] . " " . $row['apellido'];
                                            echo $name;
                                         ?>
                                       
                                    </h3>
                                    <div class="product_info_titlebox_price">
                                        <?php echo $row['examen'] ?>
                                    </div>
                                </div>
                            </div>
                        </li>

                <?php }
                    echo "</ul>";
                } else {
                    echo "</ul>";
                    echo "<h2>No se han encontrado exámenes pendientes</h2>";
                }
                ?>



        </div>

    </main>

    <script src="scripts/adminMenu.js"></script>

</body>

</html>
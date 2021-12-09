<?php 
    include("validateRoute.php"); 
    include("db.php");

    $created = false;
    $error = false;
    $errormsg = "";
    $insert_id = "";

    if(isset($_POST['add'])){
        
        if(
            isset($_POST['nombre']) && 
            isset($_POST['apellido']) &&
            isset($_POST['genero']) && 
            isset($_POST['telefono']) && 
            isset($_POST['correo']) && 
            isset($_POST['examen']) && 
            isset($_POST['nacimiento'])
        ){
            $nombre = $_POST['nombre']; 
            $apellido = $_POST['apellido'];
            $genero = $_POST['genero']; 
            $telefono = $_POST['telefono']; 
            $correo = $_POST['correo']; 
            $examen = $_POST['examen']; 
            $nacimiento = $_POST['nacimiento'];

            $query = "INSERT INTO solicitudes(nombre, apellido, correo, genero, telefono, nacimiento, examen, pendiente, resultados ) VALUES ('$nombre', '$apellido', '$correo','$genero','$telefono','$nacimiento', '$examen', 1, null )";

            $result = $conn->query($query);

            if($result){
                $created = true;
                $insert_id = $conn->insert_id;
            }else{
                if(mysqli_errno($conn) == 1062){
                    $errormsg = "YA EXISTE UNA EMPRESA CON ESE NOMBRE O RIF";
                }else{
                    $errormsg = "HA OCURRIDO UN ERROR INESPERADO" . " " . mysqli_errno($conn);
                }

                $error = true;
            }
        }
    }


?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Añadir Empresa</title>
     <!-- {{!-- Google fonts Roboto --}} -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <!-- {{!-- Font Awesome CDN --}} -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/solid.css" integrity="sha384-fZFUEa75TqnWs6kJuLABg1hDDArGv1sOKyoqc7RubztZ1lvSU7BS+rc5mwf1Is5a" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/fontawesome.css" integrity="sha384-syoT0d9IcMjfxtHzbJUlNIuL19vD9XQAdOzftC+llPALVSZdxUpVXE0niLOiw/mn" crossorigin="anonymous">
    <!-- {{!-- Sweet Alert CDN --}} -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <!-- {{!-- My Styles --}} -->
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/add_product.css">
    <link rel="stylesheet" href="css/msgportal.css">

</body>
</head>

<body>
    <div class="nav_container">
        <nav class="nav" id="menuNormal">
            <div class="container">
                <div class="main_nav_buttons">
                    <div class="menu_icon nav_buttons" id="menu_button">
                        <i class="fas fa-bars" ></i>
                        <span class="icon_text">Menu</span>
                    </div>
                    
                </div>
                <div class="nav_buttons options">
                    <a href="admin.php" class="icon_link active building"><i class="fas fa-notes-medical active"></i><span class="icon_text active">Exámenes Pendientes</span></a>
                    <a href="complete.php" class="icon_link building"><i class="fas fa-check"></i><span class="icon_text">Exámenes completados</span></a>
                </div>
                <div class="logout_button nav_buttons">
                    <a href="logout.php" class="icon_link"><i class="fas fa-door-open"></i><span class="icon_text">Salir</span></a>
                </div>
            </div>
        </nav>
        <div class="alternative-menu" id="alternative-menu">
            <a href="admin.php" class="menu_link"><i class="fas fa-notes-medical"></i><span class="icon_text_alternative">Exámenes pendientes</span></a>
            <a href="complete.php" class="menu_link"><i class="fas fa-check"></i><span class="icon_text_alternative">Exámenes completados</span></a>
            <a href="logout.php" class="menu_link"><i class="fas fa-door-open"></i><span class="icon_text_alternative">Salir</span></a>
        </div>
    </div>

    <header class="header">
        <div class="container">
            <h2>Agregar solicitud de exámen</h2>
        </div>
    </header>

    <main class="main">
        <div class="container">

            <form class="form" method="POST" action="addRequest.php">
               
                <div class="form_section section_form">
                    <div class="form_group">
                        <label for="" class="form_group_label">
                            Nombre
                        </label>
                        <input id="title" type="text" name="nombre" value=""/>
                    </div>
                    <div class="form_group">
                        <label for="" class="form_group_label">
                            Apellido
                        </label>
                        <input id="title" type="text" name="apellido" value=""/>
                    </div>

                    <div class="form_group section_form">
                        <label for="" class="form_group_label">
                            Genero
                        </label>
                        <div class="form_group">
                            <select name="genero" id="riesgo">
                                <option value="Masculino">Masculino</option>
                                <option value="Femenino">Femenino</option>
                            </select>
                        </div>
                    </div>
                    <div class="form_group section_form">
                        <label for="born" class="form_group_label">
                            Fecha De Nacimiento
                        </label>
                        <input id="born" type="date" name="nacimiento" value="" required/>
                    </div>
                    <div class="form_group">
                        <label for="" class="form_group_label">
                            Teléfono
                        </label>
                        <input id="bigPrice" type="number" name="telefono" value=""/>
                    </div>
                    <div class="form_group">
                        <label for="" class="form_group_label">
                            Correo
                        </label>
                        <input id="bigPrice" type="email" name="correo" value=""/>
                    </div>
                    <div class="form_group">
                        <label for="" class="form_group_label">
                            Exámen a realizar
                        </label>
                        <input id="title" type="text" name="examen" value=""/>
                    </div>
                </div>
                
                <div class="button_group form_section">

                    <input type="submit" value="Agregar" class="button button_add" name="add" />
                    <a href="admin.php" class="button button_back">Volver</a>
                </div>
            </form>
        </div>
    </main>

    <?php 
        if($created){ ?>
            <div class="portal">
                <div class="portal_box">
                    <p class="portal_box_title">
                        Solicitud creada exitosamente
                    </p>
                    <a href="admin.php" class="portal_box_btn">Aceptar</a>
                </div>
            </div>
    <?php }else if($error){ ?>

        <div class="portal" id="errorportal">
                <div class="portal_box">
                    <p class="portal_box_title">
                        <?php echo $errormsg ?>
                    </p>
                    <button id="closeportal" class="portal_box_btn">Aceptar</button>
                </div>
            </div>

    <?php } ?>
    

    <script src="scripts/adminMenu.js"></script>
    <script>
        
        let portal = document.getElementById("errorportal");
        let btn = document.getElementById("closeportal").addEventListener('click',()=>{
            portal.classList.toggle("hide");
        });
    </script>
</body>

</html>
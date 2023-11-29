



<?php


//Información del grabador
$nvr_ip = "192.168.100.129";
$nvr_puerto = "14002";

$codigo = $_POST['codigo'];
$hoyYahora = date('Y-m-d H:i:s', strtotime('-1 hour'));
//Información de la conexión
$tiempo = 1;

//Se establece una conexión al NVR mediante TCP
$conexion = fsockopen($nvr_ip, $nvr_puerto, $errno, $errstr, $tiempo);



/*
    $codigo = $_POST['codigo'];
    //$host = '192.168.100.165';
    $host = '127.0.0.1';
    $port = '25003';
    $i = 0;


    $message = $codigo;
        $socket = socket_create(AF_INET, SOCK_STREAM, 0) or die ("No se pudo crear el socket");
        $result = socket_connect($socket, $host, $port) or die ("No se pudo conectar al servidor web");
        socket_write($socket, $message, strlen($message)) or die ("No se pudo enviar los datos al servidor");

        $result = socket_read($socket, 1024) or die("No se puede leer la respuesta del servidor");

        echo $result . "\n";
        socket_close($socket);
 */
        
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NVR Insercion de Texto</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">

    
    <link rel="stylesheet" href="css/all.min.css"> <!-- fontawesome -->
    <!-- <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="css/tailwind.css">
    <link rel="stylesheet" href="css/tooplate-antique-cafe.css">
    
<!--

Tooplate 2126 Antique Cafe

https://www.tooplate.com/view/2126-antique-cafe

-->
</head>
<body>    
    <!-- Intro -->
    <div id="intro" class="parallax-window" data-parallax="scroll" data-image-src="img/logistics.jpg">
      
        
        <div class="container mx-auto px-2 tm-intro-width">
            <div class="sm:pb-60 sm:pt-48 py-20">
                
                
                <div class="bg-black bg-opacity-70 p-10 mb-5">
                    <p class="text-white leading-8 text-sm font-light">
                    <?php    //Se envían los datos al NVR



if (!$conexion) {
    //Si no hay conexión, imprime el error.
    echo "$errstr ($errno)<br />\n";
}else{
    //Se concatenan los datos a imprimir.        \r\n = ENTER

      //Se concatenan los datos a imprimir.        \r\n = ENTER
      $datos = "";
      $datos .= "Fecha: $hoyYahora\r\n";
      $datos .= "Nombre: Rafael Rodriguez\r\n";
      $datos .= "Codigo: $codigo\r\n";
      $datos .= "---------------------------------------\r\n";

      echo "Codigo enviado: ". $codigo;
}




    fwrite($conexion, $datos);

    //Se cierra la conexión TCP con el grabador
    fclose($conexion);

    ?>    
                    
                </div>
                <div class="text-center">
                    <div class="inline-block">
                        <a href="#menu" class="flex justify-center items-center bg-black bg-opacity-70 py-6 px-8 rounded-lg font-semibold tm-text-2xl tm-text-gold hover:text-gray-200 transition">
                            

                        
                            <button onclick="regresarPagina()">Regresar</button>                        
                        </a>
                    </div>                    
                </div>                
            </div>
        </div>        
    </div>

    

    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/parallax.min.js"></script>
    <script src="js/jquery.singlePageNav.min.js"></script>
    <script>

        function regresarPagina() {
            window.history.back();
        }


        function checkAndShowHideMenu() {
            if(window.innerWidth < 768) {
                $('#tm-nav ul').addClass('hidden');                
            } else {
                $('#tm-nav ul').removeClass('hidden');
            }
        }

        $(function(){
            var tmNav = $('#tm-nav');
            tmNav.singlePageNav();

            checkAndShowHideMenu();
            window.addEventListener('resize', checkAndShowHideMenu);

            $('#menu-toggle').click(function(){
                $('#tm-nav ul').toggleClass('hidden');
            });

            $('#tm-nav ul li').click(function(){
                if(window.innerWidth < 768) {
                    $('#tm-nav ul').addClass('hidden');
                }                
            });

            $(document).scroll(function() {
                var distanceFromTop = $(document).scrollTop();

                if(distanceFromTop > 100) {
                    tmNav.addClass('scroll');
                } else {
                    tmNav.removeClass('scroll');
                }
            });
            
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();

                    document.querySelector(this.getAttribute('href')).scrollIntoView({
                        behavior: 'smooth'
                    });
                });
            });
        });
    </script>
</body>
</html>
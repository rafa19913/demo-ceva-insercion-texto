



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

      
    //Se envían los datos al NVR
    fwrite($conexion, $datos);

    //Se cierra la conexión TCP con el grabador
    fclose($conexion);

    echo "OK";
}



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



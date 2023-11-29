<?php

    set_time_limit(0);
    $datos = "";
    $host = '127.0.0.1';
    $port = '25003';
    $socket = socket_create(AF_INET, SOCK_STREAM, getprotobyname('tcp'));
    
    socket_bind($socket, $host, $port) or die ('Error al vincular socket con IP en este cliente');
    echo socket_strerror(socket_last_error());
    socket_listen($socket);

    $i = 0;

    // Horario local

    $nvr_ip = '192.168.100.129';
    $nvr_puerto = '14002';
    $tiempo = 30;
  
    date_default_timezone_set("America/Mexico_City");

    while(true){
        echo "\n";
        $client[++$i] = socket_accept($socket);
        $message = socket_read($client[$i], 1024);
        // $fecha = date("Y/m/d", time());
        // $hora = date("H:i");
        $user = "Admin";
        $hoyYahora = date('Y-m-d H:i:s', strtotime('-1 hour'));
        
                
        //Información de la conexión
        $tiempo = 30;

        //Se establece una conexión al NVR mediante TCP
        $conexion = fsockopen($nvr_ip, $nvr_puerto, $errno, $errstr, $tiempo);

        if (!$conexion) 
        {
            //Si no hay conexión, imprime el error.
            echo "$errstr ($errno)<br />\n";
        } 
        else 
        {
            //Se concatenan los datos a imprimir.        \r\n = ENTER
            $datos .= "Fecha: $hoyYahora\r\n";
            $datos .= "Nombre: $user\r\n";
            $datos .= "Codigo: $message\r\n";
            $datos .= "---------------------------------------\r\n";
            
            
            //Se envían los datos al NVR
            fwrite($conexion, $datos);
            
            


            //Se cierra la conexión TCP con el grabador
            fclose($conexion);

            echo "OK";
            $datos = "";
            $message = "";

            
        }


        $message = "Paquete recibido: ". $message . "\n". "Por el usuario: ". $user. "\n El dia: ".$hoyYahora;
        
        echo $message . "\n";
 
        socket_write($client[$i], $message . "\n\r", 1024);
        socket_close($client[$i]);

    }
    socket_close($socket);
    $datos = "";
?>


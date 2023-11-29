<?php
// Define the server's IP address and port to listen on
$host = "0.0.0.0";  // Use your PC's IP address or "0.0.0.0" to listen on all available interfaces
$port = 25003;  // Choose an available port

// Create a TCP socket
$serverSocket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

if ($serverSocket === false) {
    die("Failed to create socket: " . socket_strerror(socket_last_error()));
}

// Bind the socket to the specified IP address and port
if (!socket_bind($serverSocket, $host, $port)) {
    die("Failed to bind socket: " . socket_strerror(socket_last_error()));
}

// Listen for incoming connections
if (!socket_listen($serverSocket)) {
    die("Failed to listen on socket: " . socket_strerror(socket_last_error()));
}

echo "Server is listening on $host:$port\n";

// Accept incoming connections and receive data
while (true) {
    $clientSocket = socket_accept($serverSocket);
    if ($clientSocket === false) {
        echo "Failed to accept connection: " . socket_strerror(socket_last_error()) . "\n";
        continue;
    }

    // Read data from the client
    $data = socket_read($clientSocket, 1024);

    // Process the received data
    echo "Received: $data\n";

    // Close the client socket
    socket_close($clientSocket);
}

// Close the server socket (this code is unreachable in the example)
socket_close($serverSocket);
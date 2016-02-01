<?php
/*
Demo Websocket: Server Code
---------------------------
    @Author: ANHVNSE02067
    @Website: www.nhatanh.net
    @Email: anhvnse@gmail.com
 */
require "PHP-Websockets/websockets.php";

class Server extends WebSocketServer
{
    private $_connecting = 'Connecting to server..';
    private $_welcome = 'Hello, welcome to echo server!';

    protected function connected($user)
    {
        // Send welcome message to user
        $this->send($user, $this->_welcome);
    }    

    protected function process($user, $message)
    {
        // Upper case user message and send back to user
        $response = 'Upper case -> ' . strtoupper($message);
        $this->send($user, $response);
    }

    protected function closed($user)
    {
        // Alert on server
        echo "User $user->id  closed connection".PHP_EOL;
    }

    public function __destruct()
    {
        echo "Server destroyed!".PHP_EOL;
    }
}


$addr = 'localhost';
$port = '80';

$server = new Server($addr, $port);
$server->run();

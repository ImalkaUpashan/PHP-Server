<?php

namespace PHPServer;

class Server{
    protected $host=null;
    protected $port=null;
    protected $socket=null;


protected function createSocket(){
    $this->socket=socket_create(
        AF_INET,
        SOCK_STREAM,
        0
    );
}

protected function bind(){
    if(!socket_bind($this->socket,$this->host,$this->port)){
        throw new Exeption(
            'Could not bind : ' .
            $this->host . ':' .
            $this->port . '-' . 
            socket_strerror(socket_last_error())
        );
    }
}

public function __construct($host,$port){
    $this->host=$host;
    $this->port=(int)$port;

    $this->createSocket();
    $this->bind();
}


public function listen($callback){

if(!is_callable($callback)){
    throw new\InvalidArgumentException(
        'The given argument should be callable'
    );
    }

    while(1){
        socket_listen($this->socket);

        $client=socket_accept($this->socket);

        if(!$client){
            continue;
        }

        $request=Request::withHeaderString(
            socket_read($cleint,1024)
        );

        $response =(string)$response;

        socket_write($client,$response,strlen($response));

        socket_close($client);
    }

}



}
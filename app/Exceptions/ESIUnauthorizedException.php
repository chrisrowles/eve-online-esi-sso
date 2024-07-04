<?php

namespace App\Exceptions;

use Exception;

class ESIUnauthorizedException extends Exception
{
    /** @var array $data  */
    protected array $data;
    
    /**
     * ESIUnauthorizedException constructor
     * 
     * @param string $message
     * @param int $code
     * @param Exception $previous
     * @param array $data
     */
    public function __construct(string $message, int $code = 0, Exception $previous = null, array $data = [])
    {
        parent::__construct($message, $code, $previous);
        $this->data = $data;
    }
    
    /**
     * Get exception data
     * 
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }
}
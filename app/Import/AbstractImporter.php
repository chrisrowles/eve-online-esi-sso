<?php

namespace Mesa\Import;

use Exception;

abstract class AbstractImporter
{
    /**
     * @param string $type
     * @return mixed
     * @throws Exception
     */
    public function import(string $type)
    {
        $method = strtolower($type);
        if (method_exists($this, $method))
        {
            return $this->{$method}();
        } else {
            throw new Exception($method . ' is not a valid import type.');
        }
    }
}

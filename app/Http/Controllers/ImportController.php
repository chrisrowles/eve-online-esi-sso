<?php

namespace Mesa\Http\Controllers;

use Exception;
use Illuminate\Routing\Controller;
use Illuminate\Http\JsonResponse;

class ImportController extends Controller
{
    /** @var string */
    protected string $namespace = '\\Mesa\\Import\\';

    /**
     * Import various data from ESI.
     *
     * @param string $type
     * @param string $subtype
     * @return JsonResponse
     * @throws Exception
     */
    public function import(string $type, string $subtype): JsonResponse
    {
        $class  = $this->namespace . ucfirst($type);;
        if (!class_exists($class)) {
            throw new Exception("Import class $type not found");
        }

        $method = strtolower($subtype);
        
        if(!method_exists($class, $subtype)) {
            throw new Exception("Import method $subtype does not exist for class $type");
        }

        $instance = new $class();
        $data = $instance->import($method);

        return response()->json($data);
    }
}

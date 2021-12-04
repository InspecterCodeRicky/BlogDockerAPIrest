<?php

abstract class CommonHydrator
{
    function __construct($data = [])
    {
        $this->hydrate($data);
    }

    // hydratation
    private function hydrate(array $data)
    {
        foreach ($data as $key => $value) {
            $method = 'set'.ucfirst($key);
            if(method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }
}
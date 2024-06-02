<?php

namespace LittleGreenMan\StytchPHP\Resources\Concerns;

trait CanBePreparedForStytch
{
    public function getArrayOfNonNullProperties(): array
    {
        $reflectionClass = new \ReflectionClass($this);
        $properties = $reflectionClass->getProperties();
        $nonNullProperties = [];

        foreach ($properties as $property) {
            $property->setAccessible(true); // Make private/protected properties accessible
            $value = $property->getValue($this);

            if ($value !== null) {
                $snakeCaseName = $this->camelToSnake($property->getName());
                $nonNullProperties[$snakeCaseName] = $value;
            }
        }

        return $nonNullProperties;
    }

    private function camelToSnake($input) {
        return strtolower(preg_replace('/[A-Z]/', '_$0', lcfirst($input)));
    }
}

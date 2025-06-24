<?php

namespace QueryOrm\salesforce;

use QueryOrm\Accessors;
use QueryOrm\Model;
use ReflectionException;
use ReflectionObject;
use ReflectionProperty;

class SalesforceModel extends Model
{
    public static function convert($record): self
    {
        if (!is_array($record)) {
            return $record;
        }

        $model = new static();
        foreach ($record as $key => $val) {
            $model->{'set'.ucfirst(str_replace('_', '', $key))}($val);
        }
        return $model;
    }

    /**
     * @throws ReflectionException
     */
    public function __call($name, $arguments)
    {
        if (str_starts_with($name, 'get')) {
            $ref = new ReflectionObject($this);
            foreach ($ref->getProperties(ReflectionProperty::IS_PRIVATE) as $property) {
                $accessors = $property->getAttributes(Accessors::class);
                if (count($accessors) > 0) {
                    /** @var Accessors $accessor */
                    $accessor = $accessors[0]->newInstance();

                    if ($name === $accessor->getter) {
                        return $property->getValue($this);
                    }
                }
            }

            $property = lcfirst(substr($name, 3));

            return $ref->getProperty($property)->getValue($this);
        }

        if (str_starts_with($name, 'set')) {
            $ref = new ReflectionObject($this);
            foreach ($ref->getProperties(ReflectionProperty::IS_PRIVATE) as $property) {
                $accessors = $property->getAttributes(Accessors::class);
                if (count($accessors) > 0) {
                    /** @var Accessors $accessor */
                    $accessor = $accessors[0]->newInstance();

                    if ($name === $accessor->getter) {
                        $property->setValue($this, $arguments[0]);
                        return $this;
                    }
                }
            }

            $property = lcfirst(substr($name, 3));

            $ref->getProperty($property)->setValue($this, $arguments[0]);
            return $this;
        }

        return $this;
    }
}
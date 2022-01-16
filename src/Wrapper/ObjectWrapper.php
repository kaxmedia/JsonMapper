<?php

declare(strict_types=1);

namespace JsonMapper\Wrapper;

use JsonMapper\Exception\TypeError;
use mysql_xdevapi\Exception;

class ObjectWrapper
{
    /** @var object? */
    private $object;
    /** @var class-string? */
    private $className;
    /** @var \ReflectionClass|null */
    private $reflectedObject;

    /** @param object|null $object */
    /** @param class-string|null $className */
    public function __construct($object = null, $className = null)
    {
        if (\is_null($object) && \is_null($className)) {
            throw new Exception(); // @todo nice exception message
        }
        if (! \is_null($object) && ! \is_object($object)) {
            throw TypeError::forArgument(__METHOD__, 'object', $object, 1, '$object');
        }
        if (! \is_null($className) && ! \class_exists($className)) {
            throw new \Exception(); // @todo nice exception message
        }

        $this->object = $object;
        $this->className = $className;
    }

    /** @return object|null */
    public function getObject()
    {
        return $this->object;
    }

    /** @return class-string */
    public function getClassName(): ?string
    {
        return $this->className ;
    }

    public function getReflectedObject(): \ReflectionClass
    {
        if ($this->reflectedObject === null) {
            $objectOrClass = ! \is_null($this->object) ? $this->object : $this->className;
            $this->reflectedObject = new \ReflectionClass($objectOrClass);
        }

        return $this->reflectedObject;
    }

    public function getName(): string
    {
        return $this->getReflectedObject()->getName();
    }
}

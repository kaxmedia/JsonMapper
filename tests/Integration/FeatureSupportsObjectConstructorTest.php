<?php

declare(strict_types=1);

namespace JsonMapper\Tests\Integration;

use JsonMapper\Builders\PropertyMapperBuilder;
use JsonMapper\Handler\FactoryRegistry;
use JsonMapper\JsonMapperBuilder;
use JsonMapper\Tests\Implementation\Php81\BlogPost;
use JsonMapper\Tests\Implementation\Php81\Status;
use JsonMapper\Tests\Implementation\PopoWithConstructor;
use JsonMapper\Tests\Implementation\Wrappers\PopoWithConstructorWrapper;
use PHPUnit\Framework\TestCase;

/**
 * @coversNothing
 */
class FeatureSupportsObjectConstructorTest extends TestCase
{
    public function testItCanMapChildObjectWithConstructorWithSingleScalarValue(): void
    {
        // Arrange
        $registry = new FactoryRegistry();
        $propertyMapperBuilder = PropertyMapperBuilder::new()
            ->withClassFactoryRegistry($registry);
        $mapper = JsonMapperBuilder::new()
            ->withPropertyMapper($propertyMapperBuilder->build())
            ->withDocBlockAnnotationsMiddleware()
            ->withTypedPropertiesMiddleware()
            ->withNamespaceResolverMiddleware()
            ->withObjectConstructorMiddleware($registry)
            ->build();
        $object = new PopoWithConstructorWrapper();
        $json = (object) ['popo' => (object) ['name' => 'John Doe']];

        $mapper->mapObject($json, $object);

        self::assertSame($json->name, $object->getPopo()->getName());
    }
}

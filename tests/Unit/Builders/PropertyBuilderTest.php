<?php

declare(strict_types=1);

namespace JsonMapper\Tests\Unit\Builders;

use JsonMapper\Builders\PropertyBuilder;
use JsonMapper\Enums\Visibility;
use JsonMapper\Tests\Helpers\AssertThatPropertyTrait;
use JsonMapper\ValueObjects\ArrayInformation;
use JsonMapper\ValueObjects\PropertyType;
use PHPUnit\Framework\TestCase;

class PropertyBuilderTest extends TestCase
{
    use AssertThatPropertyTrait;

    /**
     * @covers \JsonMapper\Builders\PropertyBuilder
     */
    public function testCanBuildPropertyWithAllPropertiesSet(): void
    {
        $property = PropertyBuilder::new()
            ->setName('enabled')
            ->addType('boolean', ArrayInformation::notAnArray())
            ->setIsNullable(true)
            ->setVisibility(Visibility::PRIVATE())
            ->build();

        $this->assertThatProperty($property)
            ->hasName('enabled')
            ->hasType('boolean', ArrayInformation::notAnArray())
            ->hasVisibility(Visibility::PRIVATE())
            ->isNullable();
    }

    /**
     * @covers \JsonMapper\Builders\PropertyBuilder
     */
    public function testCanBuildPropertyWithAllPropertiesSetUsingSetTypes(): void
    {
        $property = PropertyBuilder::new()
            ->setName('enabled')
            ->setTypes(
                new PropertyType('string', ArrayInformation::singleDimension()),
                new PropertyType('int', ArrayInformation::notAnArray())
            )
            ->setIsNullable(true)
            ->setVisibility(Visibility::PRIVATE())
            ->build();

        $this->assertThatProperty($property)
            ->hasName('enabled')
            ->hasType('string', ArrayInformation::singleDimension())
            ->hasType('int', ArrayInformation::notAnArray())
            ->hasVisibility(Visibility::PRIVATE())
            ->isNullable();
    }
}

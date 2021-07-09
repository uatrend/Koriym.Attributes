<?php

declare(strict_types=1);

namespace Koriym\Attributes;

use Koriym\Attributes\Annotation\FakeAbstractFoo;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionMethod;
use ReflectionProperty;

final class AttributeReaderAbstractAttributesTest extends TestCase
{
    /** @var AttributeReader */
    private $attributeReader;

    /** @var ReflectionClass<FakeDual> */
    private $reflectionClass;

    /** @var ReflectionMethod */
    private $methodReflection;

    /** @var ReflectionProperty */
    private $propertyReflection;

    protected function setUp(): void
    {
        $this->attributeReader = new AttributeReader();
        $this->reflectionClass = new ReflectionClass(FakeDual::class);
        $this->methodReflection = new ReflectionMethod(FakeDual::class, 'setKey');
        $this->propertyReflection = new ReflectionProperty(FakeDual::class, 'prop');
    }

    public function testClassAttribute(): void
    {
        $classAttribute = $this->attributeReader->getClassAnnotation($this->reflectionClass, FakeAbstractFoo::class);
        $this->assertInstanceOf(FakeAbstractFoo::class, $classAttribute);
    }

    public function testMethodAttribute(): void
    {
        $methodAttribute = $this->attributeReader->getMethodAnnotation(
            $this->methodReflection,
            FakeAbstractFoo::class
        );
        $this->assertInstanceOf(FakeAbstractFoo::class, $methodAttribute);
    }

    public function testPropertyAttribute(): void
    {
        $propertyAttribute = $this->attributeReader->getPropertyAnnotation($this->propertyReflection, FakeAbstractFoo::class);
        $this->assertInstanceOf(FakeAbstractFoo::class, $propertyAttribute);
    }
}

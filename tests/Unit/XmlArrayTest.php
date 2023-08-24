<?php

namespace Tienvx\PactPhpXml\Tests\Unit;

use ReflectionProperty;
use Tienvx\PactPhpXml\XmlArray;
use PHPUnit\Framework\TestCase;
use Tienvx\PactPhpXml\XmlElementData;

class XmlArrayTest extends TestCase
{
    public function testEachLike()
    {
        $options = ['elements' => 5];
        $parent = XmlArray::initiate(XmlElementData::class);
        $child = $parent->eachLike('Child', ['myAttr' => 'attr-value'], $options);
        $stack = $this->getProperty($parent, 'stack');
        $element = end($stack);

        $this->assertSame($parent, $this->getProperty($child, 'parent'));
        $this->assertInstanceOf(XmlElementData::class, $element);
        $this->assertTrue($this->getProperty($element, 'matching'));
        $this->assertSame($options, $this->getProperty($element, 'options'));
    }

    private function getProperty(object $object, string $property): mixed
    {
        $reflection = new ReflectionProperty($object, $property);

        return $reflection->getValue($object);
    }
}
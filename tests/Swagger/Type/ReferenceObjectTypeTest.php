<?php

class ReferenceObjectTypeTest extends PHPUnit_Framework_TestCase
{

	protected $parent;

	protected function setUp()
	{
		$this->parent = $this->getMockForAbstractClass('\SwaggerGen\Swagger\Swagger');
	}

	protected function assertPreConditions()
	{
		$this->assertInstanceOf('\SwaggerGen\Swagger\AbstractObject', $this->parent);
	}

	/**
	 * @covers \SwaggerGen\Swagger\Type\ReferenceObjectType::__construct
	 */
	public function testConstructBothConsumes()
	{
		$this->parent->handleCommand('model', 'blah');
		
		$object = new SwaggerGen\Swagger\Type\ReferenceObjectType($this->parent, 'blah');

		$this->assertInstanceOf('\SwaggerGen\Swagger\Type\ReferenceObjectType', $object);

		$this->assertSame(array(
			'$ref' => '#/definitions/blah',
				), $object->toArray());
	}

}

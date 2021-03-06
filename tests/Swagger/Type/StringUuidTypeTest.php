<?php

class StringUuidTypeTest extends PHPUnit_Framework_TestCase
{

	protected $parent;

	protected function setUp()
	{
		$this->parent = $this->getMockForAbstractClass('\SwaggerGen\Swagger\AbstractObject');
	}

	protected function assertPreConditions()
	{
		$this->assertInstanceOf('\SwaggerGen\Swagger\AbstractObject', $this->parent);
	}

	/**
	 * @covers \SwaggerGen\Swagger\Type\StringUuidType::__construct
	 */
	public function testConstructNotAUuid()
	{
		$this->setExpectedException('\SwaggerGen\Exception', "Not a uuid: 'wrong'");

		$object = new SwaggerGen\Swagger\Type\StringUuidType($this->parent, 'wrong');
	}

	/**
	 * @covers \SwaggerGen\Swagger\Type\StringUuidType::__construct
	 */
	public function testConstructUuid()
	{
		$object = new SwaggerGen\Swagger\Type\StringUuidType($this->parent, 'uuid');

		$this->assertInstanceOf('\SwaggerGen\Swagger\Type\StringUuidType', $object);

		$this->assertSame(array(
			'type' => 'string',
			'format' => 'uuid',
			'pattern' => '^[a-f0-9]{8}-[a-f0-9]{4}-[1-5][a-f0-9]{3}-[89ab][a-f0-9]{3}-[a-f0-9]{12}$',
				), $object->toArray());
	}

	/**
	 * @covers \SwaggerGen\Swagger\Type\StringUuidType::__construct
	 */
	public function testConstructUuidEmptyDefault()
	{
		$this->setExpectedException('\SwaggerGen\Exception', "Unparseable uuid definition: 'uuid='");

		$object = new SwaggerGen\Swagger\Type\StringUuidType($this->parent, 'uuid= ');
	}

	/**
	 * @covers \SwaggerGen\Swagger\Type\StringUuidType::__construct
	 */
	public function testConstructUuidBadDefault()
	{
		$this->setExpectedException('\SwaggerGen\Exception', "Unparseable uuid definition: 'uuid=123'");

		$object = new SwaggerGen\Swagger\Type\StringUuidType($this->parent, 'uuid=123');
	}

	/**
	 * @covers \SwaggerGen\Swagger\Type\StringUuidType::__construct
	 */
	public function testConstructUuidDefault()
	{
		$object = new SwaggerGen\Swagger\Type\StringUuidType($this->parent, 'uuid=123e4567-e89b-12d3-a456-426655440000');

		$this->assertInstanceOf('\SwaggerGen\Swagger\Type\StringUuidType', $object);

		$this->assertSame(array(
			'type' => 'string',
			'format' => 'uuid',			
			'pattern' => '^[a-f0-9]{8}-[a-f0-9]{4}-[1-5][a-f0-9]{3}-[89ab][a-f0-9]{3}-[a-f0-9]{12}$',
			'default' => '123e4567-e89b-12d3-a456-426655440000',
				), $object->toArray());
	}

	/**
	 * @covers \SwaggerGen\Swagger\Type\StringUuidType->handleCommand
	 */
	public function testCommandDefaultNoValue()
	{
		$object = new SwaggerGen\Swagger\Type\StringUuidType($this->parent, 'uuid');

		$this->assertInstanceOf('\SwaggerGen\Swagger\Type\StringUuidType', $object);

		$this->setExpectedException('\SwaggerGen\Exception', "Empty uuid default");
		$object->handleCommand('default', '');
	}
	
	/**
	 * @covers \SwaggerGen\Swagger\Type\StringUuidType->handleCommand
	 */
	public function testCommandDefaultBadValue()
	{
		$object = new SwaggerGen\Swagger\Type\StringUuidType($this->parent, 'uuid');

		$this->assertInstanceOf('\SwaggerGen\Swagger\Type\StringUuidType', $object);

		$this->setExpectedException('\SwaggerGen\Exception', "Invalid uuid default");
		$object->handleCommand('default', 'foobar');
	}

	/**
	 * @covers \SwaggerGen\Swagger\Type\StringUuidType->handleCommand
	 */
	public function testCommandDefault()
	{
		$object = new SwaggerGen\Swagger\Type\StringUuidType($this->parent, 'uuid');

		$this->assertInstanceOf('\SwaggerGen\Swagger\Type\StringUuidType', $object);

		$object->handleCommand('default', '123e4567-e89b-12d3-a456-426655440000');

		$this->assertSame(array(
			'type' => 'string',
			'format' => 'uuid',			
			'pattern' => '^[a-f0-9]{8}-[a-f0-9]{4}-[1-5][a-f0-9]{3}-[89ab][a-f0-9]{3}-[a-f0-9]{12}$',
			'default' => '123e4567-e89b-12d3-a456-426655440000',
				), $object->toArray());
	}

}

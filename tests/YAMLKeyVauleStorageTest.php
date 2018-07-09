<?php
/**
 * Created by PhpStorm.
 * User: anton
 * Date: 09.07.18
 * Time: 10:11
 */

use PHPUnit\Framework\TestCase;
use App\Standart\YAMLKeyValueStorage;
use App\Standart\KeyValueStorageInterface;

class YAMLKeyValueStorageTest extends TestCase
{

    /**
     * @var KeyValueStorageInterface
     */

    private $file;

    public function setUp()
    {
        $this->file = new YAMLKeyValueStorage(__DIR__ . '/../data/data.yaml');
    }

    public function tearDown()
    {
        unlink($this->file->getFileName());
    }

    public function testSet()
    {
        $this->file->set('Anton', '777');

        $this->assertEquals('777', $this->file->get('Anton'));
    }

    public function testGet()
    {
        $this->file->set('Anton', '111');

        $this->assertEquals('111' , $this->file->get('Anton'));
        $this->assertNull($this->file->get('Vasya'));
    }

    public function testHas()
    {
        $this->file->set('anton', '99');

        $this->assertTrue($this->file->has('anton'));
        $this->assertFalse($this->file->has('dkdkd'));
    }

    public function testRemove()
    {
        $this->file->set('anton', '99');
        $this->file->remove('anton');

        $this->assertFalse($this->file->has('anton'));
    }

    public function testClear()
    {
        $this->file->set('anton', '99');
        $this->file->set('anton1', '99');
        $this->file->set('anton2', '99');

        $this->file->clear();

        $this->assertFalse($this->file->has('anton'));
        $this->assertFalse($this->file->has('anton1'));
        $this->assertFalse($this->file->has('anton2'));

    }
}



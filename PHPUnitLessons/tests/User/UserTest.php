<?php
require_once 'vendor/autoload.php';
use PHPUnit\Framework\TestCase;

class SomeClass
{
    public function doSomething()
    {
		return 'bar';
    }
}

class UserTest extends TestCase
{

	private $user;

    // public static function setUpBeforeClass(): void
    // {
    //     $this->user = new \App\User\User('Artem');
    // }

    // public static function tearDownAfterClass(): void
    // {
    //     fwrite(STDOUT, __METHOD__ . "\n");
    // }

	protected function setUp() : void {
         $this->user = new \App\User\User('Artem');
		// $this->user = new \App\User\User();
		// $this->user->setAge(33);
		// if (!extension_loaded('mysqli123')) {
        //     $this->markTestSkipped(
        //       'The MySQLi extension is not available.'
        //     );
        // }
	}

	protected function tearDown() : void {
        // fwrite(STDOUT, __METHOD__ . "\n");
	}

	/**
	 * @test
	 */
	public function age() {
		$this->assertEquals(33, 33);
	}

    /**
     * @covers \App\User\User::getName
     */
    public function testName() {
		$this->assertEquals('Artem', $this->user->getName());
	}

	 /**
     * @group testw
     */
	public function testArrayNotHasKey(): void
    {
        $this->assertArrayNotHasKey('bar_', ['bar' => 'baz'], "key not found");
    }
	// public function testClassHasAttribute(): void
    // {
    //     $this->assertClassHasAttribute('user', 'UserTest');
    // }
	// public function testContains(): void
    // {
    //     $this->assertContains(4, [1, 2, 4]);
    // }

	/**
 * @testWith ["test", 4]
 *           ["longer-string", 13]
 */

	public function testStringContainsString(string $input, int $expectedLength): void
    {
        $this->assertSame($expectedLength, strlen($input));
    }

	 public function testEmpty(): array
    {
        $stack = [];
        $this->assertEmpty($stack);

        return $stack;
    }

    /**
     * @depends testEmpty
     */
    public function testPush(array $stack): array
    {
        array_push($stack, 'foo');
        $this->assertSame('foo', $stack[count($stack)-1]);
        $this->assertNotEmpty($stack);

        return $stack;
    }

    /**
     * @depends testPush
     */
    public function testPop(array $stack): void
    {
        $this->assertSame('foo', array_pop($stack));
        $this->assertEmpty($stack);
    }
	/**
     * @dataProvider additionProvider
     */
    public function testAdd(int $a, int $b, int $expected): void
    {
        $this->assertSame($expected, $a + $b);
    }

    public function additionProvider(): array
    {
        return [
            'adding zeros'  => [0, 0, 0],
            'zero plus one' => [0, 1, 1],
            'one plus zero' => [1, 0, 1],
            'one plus one'  => [1, 1, 2]
        ];
    }
	// public function testException(): void
    // {
    //     $this->expectException(InvalidArgumentException::class);
    // }
	public function testErrorCanBeExpected(): void
    {
        $this->expectError();

        // Optionally test that the message is equal to a string
        $this->expectErrorMessage('foo');

        // Or optionally test that the message matches a regular expression
        $this->expectErrorMessageMatches('/foo/');

        \trigger_error('foo', \E_USER_ERROR);
    }
	public function testWarningCanBeExpected(): void
    {
        $this->expectWarning();

        // Optionally test that the message is equal to a string
        $this->expectWarningMessage('foo');

        // Or optionally test that the message matches a regular expression
        $this->expectWarningMessageMatches('/foo/');

        \trigger_error('foo', \E_USER_WARNING);
    }
	// public function testFileWriting(): void
    // {
    //     $writer = new FileWriter;

    //     $this->assertFalse($writer->write('/is-not-writeable/file', 'stuff'));
    // }
	 public function testExpectBarActualBaz(): void
    {
        $this->expectOutputString('bar');

        print 'bar';
    }
		/**
     * @requires PHP 7.1.20
     */
	public function testEquality(): void
    {
        $this->assertSame(
            [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 2,  3, 4, 5, 6],
            [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 2, 3, 4, 5, 6]
        );
    }
	public function testSomething(): void
    {
        // Optional: Test anything here, if you want.
        $this->assertTrue(true, 'This should already work.');

        // Stop here and mark this test as incomplete.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }
	public function testStub(): void
    {
        // Create a stub for the SomeClass class.
        $stub = $this->createStub(SomeClass::class);

        // Configure the stub.
        $stub->method('doSomething')
             ->willReturn('foo');

        // Calling $stub->doSomething() will now return
        // 'foo'.
        $this->assertSame('foo', $stub->doSomething());
    }
	public function testReturnArgumentStub(): void
    {
        // Create a stub for the SomeClass class.
        $stub = $this->createStub(SomeClass::class);

        // Configure the stub.
        $stub->method('doSomething')
             ->will($this->returnArgument(0));

        // $stub->doSomething('foo') returns 'foo'
        $this->assertSame('foo', $stub->doSomething('foo'));

        // $stub->doSomething('bar') returns 'bar'
        $this->assertSame('bar', $stub->doSomething('bar'));
    }
	public function testReturnValueMapStub(): void
    {
        // Create a stub for the SomeClass class.
        $stub = $this->createStub(SomeClass::class);

        // Create a map of arguments to return values.
        $map = [
            ['a', 'b', 'c', 'd'],
            ['e', 'f', 'g', 'h']
        ];

        // Configure the stub.
        $stub->method('doSomething')
             ->will($this->returnValueMap($map));

        // $stub->doSomething() returns different values depending on
        // the provided arguments.
        $this->assertSame('d', $stub->doSomething('a', 'b', 'c'));
        $this->assertSame('h', $stub->doSomething('e', 'f', 'g'));
    }
	public function testReturnCallbackStub(): void
    {
        // Create a stub for the SomeClass class.
        $stub = $this->createStub(SomeClass::class);

        // Configure the stub.
        $stub->method('doSomething')
             ->will($this->returnCallback('str_rot13'));

        // $stub->doSomething($argument) returns str_rot13($argument)
        $this->assertSame('fbzrguvat', $stub->doSomething('something'));
    }
	 public function testOnConsecutiveCallsStub(): void
    {
        // Create a stub for the SomeClass class.
        $stub = $this->createStub(SomeClass::class);

        // Configure the stub.
        $stub->method('doSomething')
             ->will($this->onConsecutiveCalls(2, 3, 5, 7));

        // $stub->doSomething() returns a different value each time
        $this->assertSame(2, $stub->doSomething());
        $this->assertSame(3, $stub->doSomething());
        $this->assertSame(5, $stub->doSomething());
    }
}


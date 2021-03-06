<?php

/**
 * Generated by PHPUnit_SkeletonGenerator on 2020-10-25 at 00:46:53.
 */
use PHPUnit\Framework\TestCase;

class appTest extends TestCase {

    /**
     * @var app
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(): void {
        require_once '../report.php';
        $this->object = new app();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown(): void {
        
    }

    // test without Customer ID
    public function testGetCustomerIDWithNoArg(): void {
        $this->expectException(Exception::class);
        $this->object->initCustomerId();
    }

    // test with Customer ID passed
    public function testGetCustomerIDWithArg(): void {
        global $argv;
        $argv[1] = 1;
        $this->assertEquals(
                1,
                $this->object->initCustomerId()
        );
    }

    // test with Customer ID passed
    public function testConverter(): void {
        $this->assertEquals(
                true,
                $this->object->loadController('Converter')
        );
        // Create a Converter Instance
        $converter = new \controller\Converter();
        $this->assertInstanceOf(
                \controller\Converter::class,
                $converter
        );

        $this->assertNotNull(
                $converter->callAPi('EUR', 'USD')
        );

        $this->assertEquals(
                null,
                $converter->convert('&1000')
        );
        $this->assertInternalType(
                "float",
                $converter->convert('$1000')
        );
    }

    // impossibile to test cuz the valueConverted will be different each time (if currency change)

    /* public function testPrintReportJson(): void {
      global $argv;
      $argv[1] = 1;
      $this->object->initCustomerId();
      $this->assertEquals(
      '[{"customer":"1","date":"01\/04\/2015","value":"\u00a350.00","valueConverted":54.9863},{"customer":"1","date":"02\/04\/2015","value":"\u00a311.04","valueConverted":12.140975039999999},{"customer":"1","date":"02\/04\/2015","value":"\u20ac1.00","valueConverted":"1.00"},{"customer":"1","date":"03\/04\/2015","value":"$23.05","valueConverted":19.43098865}]',
      $this->object->dispatch('json')
      );
      } */
}

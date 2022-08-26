<?php

use PHPUnit\Framework\TestCase;

class SayHelloArgumentTest extends TestCase
{
   protected $functions;

   protected function setUp(): void
   {
       $this->functions = new functions\Functions();
   }

   /**
    * @dataProvider positiveDataProvider
    */
   public function testPositive($input, $expected)
   {
       $this->assertEquals($expected, $this->functions->sayHelloArgument($input));
   }

   public function positiveDataProvider(): array
   {
       return [
           ["everyone", "Hello everyone"],
           [7, "Hello 7"],
           [1.25, "Hello 1.25"],
           [true, "Hello 1"]
       ];
   }
}

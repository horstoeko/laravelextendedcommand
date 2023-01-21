<?php

namespace horstoeko\laravelextendedcommand\tests\testcases;

use horstoeko\laravelextendedcommand\ExtendedCommand;
use horstoeko\laravelextendedcommand\tests\TestCase;

class OrderDocumentBaseTest extends TestCase
{
    /**
     * @covers \horstoeko\laravelextendedcommand\ExtendedCommand
     */
    public function testClassExists(): void
    {
        $this->assertTrue(class_exists(ExtendedCommand::class));
    }
}

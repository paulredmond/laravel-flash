<?php

namespace Spatie\Flash\Tests;

use Orchestra\Testbench\TestCase;
use Spatie\Flash\Flash;
use Spatie\Flash\Message;

class FlashTest extends TestCase
{
    /** @test */
    public function it_can_set_a_simple_flash_message()
    {
        flash('my message');

        $this->assertEquals('my message', flash()->message);
    }

    /** @test */
    public function it_can_set_a_flash_message_with_a_class()
    {
        flash('my message', 'my-class');

        $this->assertEquals('my message', flash()->message);
        $this->assertEquals('my-class', flash()->class);
    }

    /** @test */
    public function it_can_set_a_flash_message_with_multiple_classes()
    {
        flash('my message', ['my-class', 'another-class']);

        $this->assertEquals('my message', flash()->message);
        $this->assertEquals('my-class another-class', flash()->class);
    }

    /** @test */
    public function the_flash_function_is_macroable()
    {
        Flash::macro('info', function(string $message) {
            return $this->flash(new Message($message, 'my-info-class'));
        });

        flash()->info('my message');

        $this->assertEquals('my message', flash()->message);
        $this->assertEquals('my-info-class', flash()->class);
    }
}

<?php

namespace Aviator\Delegate\Tests;

use Aviator\Delegate\Delegate;
use PHPUnit\Framework\TestCase;

class DelegateTest extends TestCase
{
    protected function getClass()
    {
        return new class {
            protected $members = ['test' => 'value'];

            protected function getDelegate() {
                return new Delegate($this->members, $this->delegateCallback());
            }

            public function delegateCallback () {
                return function ($items, $name) {
                    return array_key_exists($name, $items)
                        ? $items[$name]
                        : null;
                };
            }

            public function __get ($name)
            {
                if ($name === 'member') {
                    return $this->getDelegate();
                }
            }
        };
    }

    /**
     * @test
     */
    public function delegating_magic_get_call ()
    {
        $class = $this->getClass();

        $this->assertSame('value', $class->member->test);
    }

    /**
     * @test
     */
    public function using_static_constructor ()
    {
        $delegator = Delegate::make([], function() {});

        $this->assertInstanceOf(Delegate::class, $delegator);
    }
}

<?php

namespace Aviator\Delegate;

use Closure;

class Delegate
{
    /** @var mixed */
    protected $items;

    /** @var \Closure  */
    protected $callback;

    /**
     * Delegator constructor.
     * @param $items
     * @param \Closure $callback
     */
    public function __construct ($items, Closure $callback)
    {
        $this->items = $items;
        $this->callback = $callback;
    }

    /**
     * Static constructor.
     * @param $items
     * @param \Closure $callback
     * @return \Aviator\Delegate\Delegate
     */
    public static function make ($items, Closure $callback) {
        return new self($items, $callback);
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get ($name)
    {
        return call_user_func($this->callback, $this->items, $name);
    }
}

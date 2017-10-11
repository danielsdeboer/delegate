[![Build Status](https://travis-ci.org/danielsdeboer/delegate.svg?branch=master)](https://travis-ci.org/danielsdeboer/delegate)

## Overview

Delegate is a simple way to make property calls chainable when they otherwise wouldn't be.

### Installation

Via Composer:

```
composer require aviator/delegate
```

### Testing

Via Composer:

```
composer test
```

### Usage

Use a magic `__get` to set up a delegate:

```php
public function __get ($name)
{
    if ($name === 'foo') {
        return $this->getFooDelegate()
    }
}
```

which will return the delegate when `$instance->foo` is called.

Since Delegate accepts anything as its first parameter and a Closure as its second, you can do anything:

```php
private function getFooDelegate ()
{
    return new Delegate($this->someMember, function ($collection, $name) {
        return $collection->get($name);
    }
}
```

This allows you to call `$instance->foo->bar`, which will call your function against `someMember`. 



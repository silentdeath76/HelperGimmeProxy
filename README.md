# HelperGimmeProxy

Use example:
```php
use proxy\AbstractGimmeProxy;

class GimmeProxy extends AbstractGimmeProxy
{
    public function log($message)
    {
        echo sprintf("ERROR: %s\n", $message);
    }
}

(new GimmeProxy(1))->get(); // return json
```

Get one hundred proxy
```php
(new GimmeProxy(1))->get(100);
```

Return object
```php
(new GimmeProxy(1))->get(1, 'object');
```

Return array
```php
(new GimmeProxy(1))->get(1, 'array');
```
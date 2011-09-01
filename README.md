## Phyre for PHP

I've used PHP for a damn long time, and I've loved it. I recently moved over to
JavaScript and started having fun with it. Over the time that I was messing with
JavaScript, I noticed that it seemed much easier to work with than PHP, and
that's because it's object-oriented, whereas PHP is *mainly* procedural. Take a
good look at this PHP excerpt (< 5.4):

```PHP
$foo = split(' ', 'foo bar baz');
$foo = str_replace('b', 'f', $foo[1]);
$foo .= ' from easy';
//$foo = 'far from easy'
```

or in PHP 5.4:

```PHP
$foo = str_replace('b', 'f', split(' ', 'foo bar baz')[1]) . ' from readable';
//$foo = 'far from readable'
```

It's easier in 5.4 with array dereferencing, but it's still not easily readable,
because you have to look inside of the str_replace function to figure out what
it's replacing.

In JS you can simply do this:

```JS
var foo = 'foo bar baz'.split(' ').replace('b', 'f') + ' from hard';
//foo = 'far from hard'
```

I decided to take PHP and try to make it that way. A little more readable. Maybe
eliminate some of the tendencies that PHP has to quickly turn into spaghetti
code. So I made PHP Phyre. Here's that same bit from above, using PHP Phyre:

```PHP
include 'phyre/phyre.php'
use Phyre\variable;

$foo = p('foo bar baz')->split(' ')->replace('b', 'f')->_ . ' better';
//$foo = 'far better'
```

You can also use:

```PHP
include 'phyre/phyre.php'
use Phyre\variable;

$foo = p('foo bar baz')->split(' ')->replace('b', 'f')->cat(' better')->_;
//$foo = 'far better'
```

It seems much more readable, doesn't it?
It's easy to tell that the string `'foo bar baz'` is being `split`, then having
any instance of `b` replaced with `f`, then having `' better'` tacked onto the
end of it.

You might be wondering what the `->_` is for. That's simple. When you use `p()`
on any variable or the likes, it will return a Phyre object. If you want to get
the raw data back out of that, simply use the `_()` method.

**Wait, did you say method? Then how did you use `_`?**
Oh, that's easy. Any method that only requires one argument can be accessed as a
property can be. Like this:

```PHP
echo p('tavegf')->rot13->rev;
//echoes 'string'
```

Notice how I didn't use `->_` there. That's because if it's being accessed as a
string normally would, it will return the raw string data. If it is an integer
or float, it will return that data as a string as well. An array will turn into
a string as well, like this:

```PHP
echo p(array('a', 'b', 'c', 'd', 5));
//echoes 'abcd5';
```

Seems pretty easy, yes?
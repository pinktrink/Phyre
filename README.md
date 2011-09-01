## Phyre for PHP 5.3+

> Please note that I have no plans to support any version of PHP less than 5.3

I've used PHP for a damn long time, and I've loved it. I recently moved over to
JavaScript and started having fun with it. Over the time that I was messing with
JavaScript, I noticed that it seemed much easier to work with than PHP, and
that's because it's object-oriented, whereas PHP is *mainly* procedural. Take a
good look at this PHP excerpt (< 5.4):

```php
$foo = split(' ', 'foo bar baz');
$foo = str_replace('b', 'f', $foo[1]);
$foo .= ' from easy';
//$foo = 'far from easy'
```

or in PHP 5.4:

```php
$foo = str_replace('b', 'f', split(' ', 'foo bar baz')[1]) . ' from readable';
//$foo = 'far from readable'
```

It's easier in 5.4 with array dereferencing, but it's still not easily readable,
because you have to look inside of the str_replace function to figure out what
it's replacing.

In JS you can simply do this:

```javascript
var foo = 'foo bar baz'.split(' ')[1].replace('b', 'f') + ' from hard';
//foo = 'far from hard'
```

I decided to take PHP and try to make it that way. A little more readable. Maybe
eliminate some of the tendencies that PHP has to quickly turn into spaghetti
code. So I made PHP Phyre. Here's that same bit from above, using PHP Phyre:

```php
include 'phyre/phyre.php'
use Phyre\variable;

$foo = p('foo bar baz')->split(' ')->i(1)->replace('b', 'f')->_ . ' better';
//$foo = 'far better'
```

You can also use:

```php
$foo = p('foo bar baz')->split(' ')->i(1)->replace('b', 'f')->cat(' better')->_;
//$foo = 'far better'
```

Or, if you prefer, you can use `->i` as an array:

```php
$for = p('foo bar baz')->split(' ')->i[1]->replace('b', 'f')->cat(' better')->_;
//$foo = 'far better'
```

If you use PHP >= 5.4 you can take advantage of array dereferencing.

```php
$foo = p('foo bar baz')->split(' ')[1]->replace('b', 'f')->cat(' better')->_;
//$foo = 'far better'
```

It seems much more readable, doesn't it?
It's easy to tell that the string `'foo bar baz'` is being `split`, grabbing
index `1` of the resulting array, then having any instance of `b` replaced with
`f`, then having `' better'` tacked onto the end of it.

You might be wondering what the `->_` is for. That's simple. When you use `p()`
on any variable or the likes, it will return a Phyre object. If you want to get
the raw data back out of that, simply use the `_()` method.

**Wait, did you say method? Then how did you use `_`?**

Oh, that's easy. Any method whose procedural counterpart only *requires* one
argument can be accessed as a property can be. Thus, `str_rot13` and `strrev`
which only require one argument, now require no arguments. It's like this:

```php
echo p('tavegf')->rot13->rev;
//echoes 'string'
```

Notice how I didn't use `->_` there. That's because if it's being accessed as a
string normally would, it will return the raw string data. If it is an integer
or float, it will return that data as a string as well. An array will turn into
a string as well, like this:

```php
echo p(array('a', 'b', 'c', 'd', 5));
//echoes 'abcd5'
```

Or, in PHP 5.4, with short array syntax:

```php
echo p(['a', 'b', 'c', 'd', 5]);
//echoes 'abcd5'
```

Seems pretty easy, yes?

**Can I use this in a framework such as CodeIgniter or FuelPHP?**

Definitely! I made this framework to be droppable into anything. The only thing
it will affect is if there is a function somewhere named `p()` that is going to
be declared. At that point you may want to drop the `p()` function in phyre.php.
`p()` is simply an alias of the function `phyre()`, meaining that any instance
of `p( ... )` can be replaced with `phyre( ... )`.

You also may want to watch out for the `r()` function which is an alias for the
`regex()` function.

**Did you say regex?**

Oh yeah, forgot to mention. Phyre also has a `regex` class in it. Instead of
trying to explain it, I'll just jump straight into it:

```php
include 'phyre/phyre.php';
use Phyre/variable;
use Phyre/regex;

$foo = r('/abc?d*e+fg/i');
$foo->match('ABeFg');  //returns true
```

*But wait, there's more!*

```php
$foo = r('/!!|%/');

echo p('hello!!world%hello%universe')->split($foo)->join(' ');
//echoes 'hello world hello universe'
```

Yes. There are a few methods that allow for a regex object to be dropped right
in:

* explode
* split

#### Other fancy things

Strings can still be accessed as arrays, as such:

```php
p('abcdefg')->i[3];  //returns 'd'
```

Closures can be called with ease.

```php
p(function($a){
	echo "hello $a";
})->call('world');
//echoes 'hello world'
```

If you have a list of arguments as an array:

```php
p(function($a, $b)){
	echo "$a $b";
})->apply(array('hello', 'world'));
//echoes 'hello world'
```

Or you can simply call it without arguments:

```php
p(function(){
	echo "hello world";
})->call;
//echoes 'hello world'
```

You can still access your array normally.

```php
$foo = p(array(1, 2, 3, 4, 5));
$foo[2]->_;  //returns 3
```

#### Care enough to donate?

Too bad, I won't accept donations for this. Go buy yourself a good beer, sit
down, enjoy it, and set your code on Phyre.
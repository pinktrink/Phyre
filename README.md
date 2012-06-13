## Phyre for PHP 5.3+

> Please note that I have no plans to support any version of PHP less than 5.3

> Also, please note that this is *entirely beta* at the moment. As time goes on,
I hope that it will only continue to get better and better.

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
include 'phyre/phyre.php';

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

> `->i` takes care of the lack of array dereferencing in 5.3, so that you can
chain your code like crazy.

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

$foo = r('/abc?d*e+fg/i');
$foo->match('ABeFg');  //returns true
```

*But wait, there's more!*

```php
$foo = r('/!!|%/');

echo p('hello!!world%hello%universe')->split($foo)->join(' ')->_;
//echoes 'hello world hello universe'
```

Yes. There are a few methods that allow for a regex object to be dropped right
in:

* explode
* split
* more to come, I'm just lazy at the moment.

Be careful though. You have to drop a regex object into those functions. You
can't simply use:

```php
echo p('hello!!world%hello%universe')->split('/!!|%/')->_;
//echoes array('hello!!world%hello%universe');
```

**This is all nice, but what about processing time?**

Worry not, my friend. This bit:

```php
$x = p(array(1, 2, 3, 4, 5))->flip->flip->flip->i(2)->up->cast(variable::STRING)->cat('foo')->append('12345')->prepend('hi')->substr(3, 3)->cast(variable::ARR)->shift->substr(1)->split->pop->bin2hex->split->join(' ')->cat('ine folks');
$x[12] = ' eat bread';
//In case you're wondering: $x->_; returns '6 fine folks eat bread'
```

Took an average of about 0.00044 seconds on my MacBook Air with a 2.13 GHz Intel
Core 2 Duo, and

```php
$x = p(array(1, 2, 3, 4, 5))->flip()->flip()->flip()->i(2)->up()->cast(variable::STRING)->cat('foo')->append('12345')->prepend('hi')->substr(3, 3)->cast(variable::ARR)->shift()->substr(1)->split()->pop()->bin2hex()->split()->join(' ')->cat('ine folks');
$x[12] = ' eat bread';
```

Takes an average of about 0.00037 seconds.

### Other fancy things

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
})->apply;
//echoes 'hello world'
```

If you store it into a variable, you can call it as you normally would:

```php
$foo = p(function()){
	echo 'hello world';
});
$foo();
//echoes 'hello world'
```

You can still access your array normally.

```php
$foo = p(array(1, 2, 3, 4, 5));
$foo[2]->_;  //returns 3
```

You can still set indices of your array easily:

```php
$foo = p(array(1, 2, 3, 4, 5));
$foo[2] = 9;
unset($foo[3]);
$foo->_;  //returns array(1, 2, 9, 5)
```

You can also replace portions of a string:

```php
$foo = p('abcde');
$foo[2] = 'x';
$foo->_;  //returns 'abxde'
```

That makes injecting data into strings exremely easy:

```php
$foo = p('he wold')->i[1] = 'ello';
$foo[7] = 'or';
$foo->_;  //returns 'hello world'
```

You can also append strings this way:

```php
$foo = p('hello worl')->i[10] = 'd';
$foo->_;  //returns 'hello world'
```

Or append strings using any of these methods:

```php
$foo = p('');
$foo['>'] = 'hel';
$foo['.'] = 'lo ';
$foo['+'] = 'wor';
$foo['>>'] = 'ld';
$foo->_;  //returns 'hello world'
```

You can prepend strings in this way:

```php
$foo = ('world');
$foo['<'] = 'lo ';
$foo['<<'] = 'hel';
$foo->_;  //returns 'hello world'
```

You can remove a character from a string like this:

```php
$foo = p('heello world');
unset($foo[2]);
$foo->_;  //returns 'hello world'
```

Do you just want a part of the string?

```php
$foo = p('abchello worlddef');
$foo['@3,11']->_;  //Same as calling substr($foo->_, 3, 11), returns 'hello world'
```

You can also set multiple variables using a single function call.

```php
list($foo, $bar, $baz) = p('foo', array('b', 'a', 'r'), 3);
$foo->_;  //returns 'foo'
$bar->_;  //returns array('b', 'a', 'r')
$baz->_;  //returns 3
```

I also did a bit with array traversal:

```php
$foo = p(array(1, 2, 3, 4, 5));
$foo('>');  //Same as calling $foo->next;
$foo('>>');  //Same as calling $foo->end;
$foo('.');  //Same as calling $foo->current;
$foo('*');  //Same as calling $foo->key;
$foo('<');  //Same as calling $foo->prev;
$foo('<<');  //Same as calling $foo->reset;
$foo('~');  //Same as calling $foo->each;
```

You can also increment or decrement in this way:

```php
$foo = p(1);
foo('++');  //Same as calling $foo->up(1);
foo('--');  //Same as calling $foo->dn(1);
```

Don't want to lose the variable you currently have, but want to continue
chaining? Easy:

```php
$foo = p('o')->prepend('hell')->assign($bar)->append(' world');
$foo->_;  //returns 'hello world'
$bar->_;  //returns 'hello'
```

### Care enough to donate?

Too bad, I won't accept donations for this. Go buy yourself a good beer, sit
down, enjoy it, and write some awesome code.
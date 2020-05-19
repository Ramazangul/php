<?php
require __DIR__ . '/vendor/autoload.php';
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Illuminate\Container\Container;

$app = new Container();

class Game
{
	
	function __construct()
	{
		# code...
	}
	function greet(){
		echo "Hello there!!!";
	}
}

$app->bind('Game',function(){
	return new Game;
});


$Football  = $app->make('Game');
$Football->greet();

$app->bind('myLogger',function(){
	return new Logger('message');
});

$app->bind('myStreamHandler',function(){
	return new StreamHandler('./my.log', Logger::WARNING);
});
$myLogger  = $app->make('myLogger');


$myLogger->pushHandler($app->make('myStreamHandler'));

// add records to the log
$myLogger->warning('Foo');
$myLogger->error('Bar');










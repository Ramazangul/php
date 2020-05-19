<?php
require __DIR__ . '/vendor/autoload.php';
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Illuminate\Container\Container;
use Illuminate\Foundation;

interface PaymentGateway{
	public function pay($amount);

}
class StripePayment implements PaymentGateway{

	function __construct()
	{
		# code...
	}

	public function pay($amount){
		return $amount.' Payment is made by Stripe Payment Service';
	}

	
}

class PayPalPayment implements PaymentGateway{

	function __construct()
	{
		# code...
	}

	public function pay($amount){
		return $amount.' Payment is made by  PayPalPayment Service';
	}
}

class PaymentService
{
	
	protected $paymentService; 


	function __construct(PaymentGateway $paymentService)
	{
		$this->paymentService = $paymentService;
	}
	public function payment($amount){
		return $this->paymentService->pay($amount);
	}
	
	
}

$app = new Container();


$app->bind('PaymentGateway',StripePayment::class);

$app->bind('PaymentService',PaymentService::class);

$paymentService = $app->make('PaymentService');

echo($paymentService->payment(50));

/*Helper fonksiyonu ile */

app()->bind('PaymentGateway',PayPalPayment::class);
echo (app(PaymentService::class)->payment(100));




$reflFunc = new ReflectionFunction('app');
dd( $reflFunc->getFileName() . ':' . $reflFunc->getStartLine());


<?php 


include $_SERVER['DOCUMENT_ROOT'] . '/php/libs/stripe-php-3.19.0/lib/Error/Base.php'; 
include $_SERVER['DOCUMENT_ROOT'] . '/php/libs/stripe-php-3.19.0/lib/Error/Card.php'; 
include $_SERVER['DOCUMENT_ROOT'] . '/php/libs/stripe-php-3.19.0/lib/JsonSerializable.php'; 
include $_SERVER['DOCUMENT_ROOT'] . '/php/libs/stripe-php-3.19.0/lib/Util/Set.php'; 
include $_SERVER['DOCUMENT_ROOT'] . '/php/libs/stripe-php-3.19.0/lib/StripeObject.php'; 
include $_SERVER['DOCUMENT_ROOT'] . '/php/libs/stripe-php-3.19.0/lib/AttachedObject.php'; 
include $_SERVER['DOCUMENT_ROOT'] . '/php/libs/stripe-php-3.19.0/lib/ApiResource.php'; 
include $_SERVER['DOCUMENT_ROOT'] . '/php/libs/stripe-php-3.19.0/lib/Collection.php'; 
include $_SERVER['DOCUMENT_ROOT'] . '/php/libs/stripe-php-3.19.0/lib/ExternalAccount.php'; 
include $_SERVER['DOCUMENT_ROOT'] . '/php/libs/stripe-php-3.19.0/lib/Card.php'; 
include $_SERVER['DOCUMENT_ROOT'] . '/php/libs/stripe-php-3.19.0/lib/Util/Util.php'; 
include $_SERVER['DOCUMENT_ROOT'] . '/php/libs/stripe-php-3.19.0/lib/Util/RequestOptions.php'; 
include $_SERVER['DOCUMENT_ROOT'] . '/php/libs/stripe-php-3.19.0/lib/HttpClient/ClientInterface.php'; 
include $_SERVER['DOCUMENT_ROOT'] . '/php/libs/stripe-php-3.19.0/lib/HttpClient/CurlClient.php'; 
include $_SERVER['DOCUMENT_ROOT'] . '/php/libs/stripe-php-3.19.0/lib/ApiResponse.php'; 
include $_SERVER['DOCUMENT_ROOT'] . '/php/libs/stripe-php-3.19.0/lib/Error/InvalidRequest.php'; 
include $_SERVER['DOCUMENT_ROOT'] . '/php/libs/stripe-php-3.19.0/lib/ApiRequestor.php'; 
include $_SERVER['DOCUMENT_ROOT'] . '/php/libs/stripe-php-3.19.0/lib/Stripe.php'; 
include $_SERVER['DOCUMENT_ROOT'] . '/php/libs/stripe-php-3.19.0/lib/Charge.php'; 
	
	
	// Set your secret key: remember to change this to your live secret key in production
	// See your keys here https://dashboard.stripe.com/account/apikeys
	
	use Stripe\Stripe;
	use Stripe\Charge;
	use Stripe\Error\InvalidRequest;
	use Stripe\Error\Card;
	
	
function chargeStripe($amount, $description, $token){
	

	$stripe = new Stripe();
	$error=false;
	$stripe::setApiKey("sk_live_kQQpID0F8V4ezVFpOYv56mBb");

	// Get the credit card details submitted by the form
	$token = $token;

	// Create the charge on Stripe's servers - this will charge the user's card
	try {
		$chargobj= new Charge();
	  $charge = $chargobj::create(array(
		"amount" => $amount, // amount in cents, again
		"currency" => "eur",
		"source" => $token,
		"description" => $description
		));
	} catch(Card $e) {
	  // The card has been declined
	  echo "card error";
	  $error=true;
	}
	catch(InvalidRequest $e) {
	  // The card has been declined
	  echo "invalid request:  " . $e->__toString();
	  $error=true;
	}
	if($error==false){
		echo "ok";
	}
}

?>
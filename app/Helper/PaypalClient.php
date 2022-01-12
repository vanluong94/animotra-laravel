<?php 

namespace App\Helper;

use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Core\ProductionEnvironment;
use PayPalCheckoutSdk\Orders\OrdersGetRequest;
use PayPalHttp\IOException;
use PayPalHttp\HttpException;
use PayPalHttp\HttpResponse;
use App\Exceptions\PaypalException;

class PayPalClient
{
    /**
     * Returns PayPal HTTP client instance with environment that has access
     * credentials context. Use this instance to invoke PayPal APIs, provided the
     * credentials have access.
     */
    public static function client()
    {
        return new PayPalHttpClient(self::environment());
    }

    /**
     * Set up and return PayPal PHP SDK environment with PayPal access credentials.
     * This sample uses SandboxEnvironment. In production, use LiveEnvironment.
     */
    public static function environment()
    {
        $clientId     = env('PAYPAL_CLIENT_ID', 0);
        $clientSecret = env('PAYPAL_CLIENT_SECRET', 0);
        $is_sandbox   = env('PAYPAL_SANBOX', 0);

        if( !$clientId || !$clientSecret ){
            throw new PaypalException('[Paypal Error] Missing config');
        }

        if( $is_sandbox ){ 
            return new SandboxEnvironment($clientId, $clientSecret);
        }else{
            return new ProductionEnvironment($clientId, $clientSecret);
        }

    }

    /**
     * @return HttpResponse
     * @throws PaypalException
     */
    public static function getOrder($orderId)
    {
        // 3. Call PayPal to get the transaction details
        $error = null;

        try{

            $client = self::client();
            $response = $client->execute(new OrdersGetRequest($orderId));

        }catch(IOException $e){
            $error = "[IOException] " . $e->getMessage();
        }catch(HttpException $e){
            $resp = json_decode( $e->getMessage(), true );
            $error = "[{$resp['name']}] {$resp['message']}";
        }

        if( $error ){
            throw new PaypalException( $error );
        }

        return $response;
    }

}
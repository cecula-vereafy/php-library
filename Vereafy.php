<?php
/**
 * Vereafy
 * This library is manages all request to Cecula Vereafy services: Initialization,
 * Completion and Resends.
 * 
 * @category  Two-Factor_Authentication
 * @package   Cecula_Vereafy
 * @author    Godwin Noah <godwin.noah@cecula.com>
 * @copyright 2019 Cecula Ltd.
 * @license   MIT https://vereafy.com/license
 * @link      https://vereafy.com
 */
class Vereafy
{
    private $_host = 'https://api.cecula.com';

    private $_apiKey = null;

    // Replace the <api key> string with API Key generated on the cecula developer platform.
    private $_header = [];

    /**
     * Constructor
     */
    public function __construct($apiKey)
    {
        $this->_apiKey = $apiKey;

        $this->_header = [
            "Authorization: Bearer {$this->_apiKey}",
            "Content-Type: application/json",
            "cache-control: no-cache"
        ];
    }

    /**
     * Resend OTP
     * Some times for one reason or another your website or app users may not receive
     * the code as soon as they expect. Use this method to submit their resend
     * retry link to prevent double billing.
     *
     * @param int    $pinRef The pinRef that was generated during init.
     * @param string $mobile The mobile number that initialized the request.
     * 
     * @return object
     */
    public function resend($pinRef, $mobile)
    {
        $payload = [
            'pinRef' => $pinRef,
            'mobile' => $mobile
        ];
        return $this->_makePostRequest('twofactor/resend', $payload);
    }

    /**
     * Complete Verification
     * This method is called when for completion of verification. At this stage the
     * user must have provided the received OTP (token) on your website.
     *
     * @param int $pinRef A reference code for the token
     * @param int $token  Then token that was sent during init
     * 
     * @return object
     */
    public function complete($pinRef, $token)
    {
        $payload = [
            'pinRef' => $pinRef,
            'token' => $token
        ];
        return $this->_makePostRequest('twofactor/complete', $payload);
    }

    /**
     * Initialize Verification
     * This method is the first to be called in any initialization request.
     * It receives a mobile number, sends the mobile number to Vereafy Initialization
     * endpoint, and returns a pinRef which will be used in subsequent calls.
     *
     * @param string $mobile The mobile number to be verified.
     * 
     * @return object
     */
    public function init($mobile)
    {
        $payload = [
            'mobile' => $mobile
        ];
        return $this->_makePostRequest('twofactor/init', $payload);
    }


    /**
     * Get Balance
     * This method can be used for querying Vereafy for account balance. Knowing
     * balances in realtime can help you prevent service outage. A situation where
     * Verification codes do not deliver due to insufficient credit.
     *
     * @return object
     */
    public function getBalance()
    {
        return $this->_makeGetRequest('account/tfabalance');
    }

    /**
     * Make POST Request.
     * This is a private method that handles all http POST connection to Vereafy.
     *
     * @param string $endpoint The endpoint where request should be submitted to.
     * @param array  $payload  An array of data that will be submitted to Vereafy.
     * 
     * @return void
     */
    private function _makePostRequest($endpoint, $payload)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->_host.'/'.$endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->_header);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        $response = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);

        return $error ? $error : json_decode($response);
    }

    /**
     * Make GET Request
     * This is a private method that will handles all HTTP GET Request to Vereafy.
     *
     * @param string $endpoint The URL where request will be sent.
     * 
     * @return object
     */
    private function _makeGetRequest($endpoint)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->_host.'/'.$endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->_header);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        $response = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);

        return $error ? $error : json_decode($response);
    }
}
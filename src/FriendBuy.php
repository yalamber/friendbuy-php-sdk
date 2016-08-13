<?php
/**
 * FriendBuy REST API Client
 *
 * @category Client
 * @package  FriendBuy
 */
namespace FriendBuy;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;

/**
 * REST API Client class.
 *
 * @package FriendBuy
 */
class FriendBuy
{
    /**
     * FriendBuy API Client version
     */
    const VERSION = '1.0';
    
    /**
     * FriendBuy API Client version
     */
    public $baseUrl = 'https://api.friendbuy.com/v1';
    
    /**
     * Http Client
     */
    public $httpClient;

    /**
     * Initialize client.
     * 
     * @param string $accessKey     Access key.
     * @param string $accessKeyPass Access Key Password.
     */
    public function __construct($accessKey, $accessKeyPass, $options = [])
    {
        $options = array_merge([
            'base_uri' => $this->baseUrl,
            'auth' => [$this->accessKeyPass, $this->accessKeyPass],
            'headers' => [
                'Content-Type' => 'application/json'
            ]
        ], $options);
        $this->httpClient = new Client($options);
    }
    /** 
     * Parses Response body
     */
    public function parseResponseBody($body) {
        $parsedResponse = \json_decode($body, true);
        // Test if return a valid JSON.
        if (JSON_ERROR_NONE !== json_last_error()) {
            $message = function_exists('json_last_error_msg') ? json_last_error_msg() : 'Invalid JSON returned';
            throw new \RuntimeException($message);
        }
        return $parsedResponse;
    }

    public function getShares($params = []) {
        $response = $this->httpClient->request('GET', '/shares', $params);
        return $this->parseResponseBody($response->getBody());
    }

    public function CreateShares($body) {
        $response = $this->httpClient->request('POST', '/shares', [body => $body]);
        return $this->parseResponseBody($response->getBody());
    }



}
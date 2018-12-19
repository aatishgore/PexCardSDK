<?php
namespace aatish\Pex\Services;

use GuzzleHttp;
use Exception;
use GuzzleHttp\Exception\ClientException;

Class BaseService {

    public $baseUrl = null;
    private $headers = array();
    private $response = null;
    
    

    public function __construct()
    {
        if(is_null(config('pex.key.API_URL'))){
            throw new Exception('API Url is not set in config/pex');
        }else{
            $this->baseUrl = config('pex.key.API_URL');
        }       
    }

    /**
     * Make Curl Request
     */
    public function makeRequest($url = '',$data = array(),$request = 'GET'){
        $client = $this->getClient();
        try {
            $res = $client->request($request, $url,$data);
        } catch (ClientException $e) {
            throw new Exception($e->getResponse()->getBody(true));
        }
        $this->response = $res;
        
    }

    /**
     * getCurl Repsonse
     * 
     */

    public function getClient(){
        return new GuzzleHttp\Client([
            'base_uri' => $this->baseUrl,
            'debug' => true,
            'headers' => $this->headers,
        ]);
    }
    /**
     * set header values for guzzle
     */

    public function setHeader($headers = array()){
        $this->headers = $headers;
    }

    /**
     * get header values
     */
    public function getHeader(){
        return $this->headers;
    }

    /**
     * get body of response
     */

    public function getBody($json = false){
        if(is_null($this->response))
            throw new Exception('Curl request was not initated');
        if($json)
            return json_decode($this->response->getBody());
        else {
            return $this->response->getBody();
        }
    }
}
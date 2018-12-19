<?php
namespace aatish\Pex\Services;
use aatish\Pex\Services\BaseService;
use Exception;


class PexService extends BaseService
{
    private $access_token = null;
    private $client; 
     
    public function __construct()
    {
        parent::__construct();
        if(is_null(config('pex.key.API_URL'))){
            throw new Exception('Pex API Url is not set in config/pex');
        }else{
            $this->baseUrl = config('pex.key.API_URL');
        }
        $username = config('pex.key.ADMIN_USERNAME');
        $password = config('pex.key.ADMIN_PASSWORD');
        
        if(is_null($username) || is_null($password)){
            throw new Exception('Pex Admin username and password not set in config/pex');
        }

        $client_id = config('pex.key.CLIENT_ID');
        $client_secret = config('pex.key.CLIENT_SECRET');
        if(is_null($client_id) || is_null($client_secret)){
            throw new Exception('Pex Admin CLIENT_ID and CLIENT_SECRET not set in config/pex');
        }

        
    }

    /**
     * set access token
     */
    function setToken($token){
        $this->access_token = $token;
    }

    /**
     * get access token
     */
    function getToken(){
        return $this->access_token;
    }

    function createFormParams($data){
        return [
            'form_params'=>$data
        ];
    } 


    /**
     * Generate user token
     */

    public function generate_user_token() {



        $data = $this->createFormParams([
                'username' => config('pex.key.ADMIN_USERNAME'),
                'password' => config('pex.key.ADMIN_PASSWORD'),
            ]);
        $authString = base64_encode(config('pex.key.CLIENT_ID') . ':' . config('pex.key.CLIENT_SECRET'));
        $url = "Token";
        $headers = array();
        $headers['Content-Type'] = " application/json";
        $headers['Accept'] = "application/json";
        $headers['Authorization'] = "basic " . $authString;
        $this->setHeader($headers) ;

        $this->makeRequest($url, $data,'POST');
        $this->setTokenAfterRequest();
        
    }
    
    /**
     * Renew user token
     */
    public function renew_token () {
        $url = 'Token/Renew';
        $data = array();
        $this->createHeader();
        $this->makeRequest($url, $data,'POST');
        $this->setTokenAfterRequest();
    }

    /**
     * setTokenAfterRequest
     */
    function setTokenAfterRequest(){
        $tokenData = $this->getBody(true);
        if(isset($tokenData->Token)){
            $this->access_token = $tokenData->Token;
        }else{
            throw new Exception('Token Parameter missing');
        }

    }
    /**
     * create token headers
     */

    public function createHeader(){
        if(!is_null($this->access_token)){
            $headers['Authorization'] = "token " . $this->access_token;   
            $this->setHeader($headers);
        }
        else {
            throw new Exception('Token is missing');
        }
    }

    /**
     * Fund Card
     */

    public function FundCard($cardId = null,$amount = null){
        if(is_null($cardId) || is_null($amount)){
            throw new Exception('CardID and Amount is required');
        }

        $url = 'Card/Fund/'.$cardId;
        $data = array();
        $data = $this->createFormParams([
            'Amount' => $amount
            ]
        );
        $this->createHeader();
        $this->makeRequest($url, $data,'POST');
        $response = $this->getBody();

    }









    




}
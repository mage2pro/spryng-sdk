<?php

namespace SpryngPaymentsApiPhp\Controller;

use SpryngPaymentsApiPhp\Helpers\AccountHelper;
use SpryngPaymentsApiPhp\Client;
use SpryngPaymentsApiPhp\Utility\RequestHandler;

class AccountController extends BaseController
{
    const ACCOUNT_URI = "/account";

    public function __construct(Client $api)
    {
        parent::__construct($api);
    }

    public function getAll()
    {
        $http = new RequestHandler();
        $http->setHttpMethod("GET");
        $http->setBaseUrl($this->api->getApiEndpoint());
        $http->setQueryString(static::ACCOUNT_URI);
        $http->addHeader($this->api->getApiKey(), 'X-APIKEY');
        $http->doRequest();

        $response = json_decode($http->getResponse());
        $accounts = array();

        foreach($response as $account)
        {
            $accountObj = AccountHelper::fill($account);
            array_push($accounts, $accountObj);
        }

        return $accounts;
    }
}
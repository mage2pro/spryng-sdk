<?php
namespace SpryngPaymentsApiPhp\Controller;
use GuzzleHttp\Exception\ClientException as E;
use SpryngPaymentsApiPhp\Client;
use SpryngPaymentsApiPhp\Helpers\CustomerHelper as H;
use SpryngPaymentsApiPhp\Object\Customer as lCustomer;
use SpryngPaymentsApiPhp\Utility\RequestHandler;
class CustomerController extends BaseController
{
    const CUSTOMER_URI = "/customer";

    public function __construct(Client $api)
    {
        parent::__construct($api);
    }

	/**
	 * 2017-02-23
	 * @param string $id
	 * @return lCustomer|null
	 */
    public function getById($id) {
        $http = new RequestHandler();
        $http->setHttpMethod("GET");
        $http->setBaseUrl($this->api->getApiEndpoint() . self::CUSTOMER_URI . '/' . $id);
        $http->addHeader($this->api->getApiKey(), 'X-APIKEY');
        /** @var bool $error */
        $error = false;
        try {$http->doRequest();} catch (E $e) {$error = true;}
        return $error || !($json = json_decode($http->getResponse())) ? null : H::fill($json);
    }

    public function create($arguments)
    {
        H::validateNewCustomerArguments($arguments);

        $http = new RequestHandler();
        $http->setHttpMethod("POST");
        $http->setBaseUrl($this->api->getApiEndpoint());
        $http->setQueryString(static::CUSTOMER_URI);
        $http->addHeader($this->api->getApiKey(), 'X-APIKEY');
        $http->setPostParameters($arguments, false);
        try {
            $http->doRequest();
        }
		catch (\Exception $e) {
            var_dump($e->getMessage());
        }
        $response = $http->getResponse();
        $json = json_decode($response);
        $newCustomer = H::fill($json);

        return $newCustomer;
    }
}
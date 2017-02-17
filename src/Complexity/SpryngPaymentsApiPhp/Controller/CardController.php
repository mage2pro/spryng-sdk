<?php
namespace SpryngPaymentsApiPhp\Controller;
use SpryngPaymentsApiPhp\Helpers\CardHelper as H;
use SpryngPaymentsApiPhp\Object\Card;
use SpryngPaymentsApiPhp\SpryngPaymentsException as E;
use SpryngPaymentsApiPhp\Utility\RequestHandler;
class CardController extends BaseController {
    /**
     * @param $arguments
     * @return Card
     * @throws \SpryngPaymentsApiPhp\Exception\CardException
     * @throws \SpryngPaymentsApiPhp\Exception\RequestException
     */
    public function create($arguments) {
        H::validateNewCardArguments($arguments);
        $http = new RequestHandler();
        $http->setHttpMethod("POST");
        $http->setBaseUrl($this->api->getApiEndpoint());
        $http->setQueryString('/card');
        $http->addHeader($this->api->getApiKey(), 'X-APIKEY');
        $http->setPostParameters($arguments, false);
        $http->doRequest();
        $response = $http->getResponse();
        $jsonResponse = json_decode($response);
        $card = H::fillCard($jsonResponse);
        return $card;
    }

	/**
	 * 2017-02-17
     * @param string $id
     * @return Card
     * @throws E
     */
    public function getById($id) {
     	/** @var RequestHandler $req */
        $req = new RequestHandler;
        $req->setHttpMethod('GET');
        $req->setBaseUrl($this->api->getApiEndpoint());
        $req->setQueryString("/card/$id");
        $req->addHeader($this->api->getApiKey(), 'X-APIKEY');
        $req->doRequest();
    	return H::fillCard(json_decode($req->getResponse(), false));
    }
}
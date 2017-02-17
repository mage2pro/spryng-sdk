<?php
namespace SpryngPaymentsApiPhp\Controller;
use SpryngPaymentsApiPhp\Helpers\AccountHelper as H;
use SpryngPaymentsApiPhp\Object\Account;
use SpryngPaymentsApiPhp\SpryngPaymentsException as E;
use SpryngPaymentsApiPhp\Utility\RequestHandler;
class AccountController extends BaseController {
	/**       
	 * 2017-02-15
	 * @return Account[]
	 */
    public function getAll() {return array_map(function(array $a) {return
		H::fill($a)
	;}, $this->res());}

    /**
	 * 2017-02-15
     * @param string $id
     * @return Account
     * @throws E
     */
    public function getById($id) {
    	if (!($res = $this->res($id))) {
			throw new E('Account not found', 202);
		}
    	return H::fill($res[0]);
    }

	/**
	 * 2017-02-15
	 * @param string|null $id [optional]
	 * @return array(array(string => mixed))
	 */
    private function res($id = null) {
    	/** @var RequestHandler $req */
        $req = new RequestHandler;
        $req->setHttpMethod('GET');
        $req->setBaseUrl($this->api->getApiEndpoint());
        $req->setQueryString('/account' . (!$id ? '' : "?_id=$id"));
        $req->addHeader($this->api->getApiKey(), 'X-APIKEY');
        $req->doRequest();
        return json_decode($req->getResponse(), true);
	}
}
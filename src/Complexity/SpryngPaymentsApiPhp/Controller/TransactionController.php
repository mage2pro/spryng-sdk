<?php
namespace SpryngPaymentsApiPhp\Controller;
use SpryngPaymentsApiPhp\Exception\RequestException as RE;
use SpryngPaymentsApiPhp\Exception\TransactionException as TE;
use SpryngPaymentsApiPhp\Helpers\TransactionHelper as H;
use SpryngPaymentsApiPhp\Object\Transaction as T;
use SpryngPaymentsApiPhp\Utility\RequestHandler;
// 2017-02-19
final class TransactionController extends BaseController {
    /**
	 * 2017-02-19
     * @param string $id
     * @return T
     * @throws TE
     */
    public function get($id) {
    	/** @var array(string => mixed) $resultA */
        if (!($resultA = json_decode($this->req("?_id={$id}")->getResponse()))) {
 			throw new TE('Transaction not found', 202);
		}
        return H::fillTransaction($resultA[0]);
    }

    /**
	 * 2017-02-19
     * @return T[]
     */
    public function getAll() {return array_map(function(array $t) {return
		H::fillTransaction($t)
	;}, json_decode($this->req()->getResponse()));}

    /**
	 * 2017-02-19
     * (partly) Refund a transaction
     * @param string $transactionId
     * @param int|null $amount
     * @param string|null $reason
     * @return bool
     * @throws TE|RE
     */
    public function refund($transactionId, $amount = null, $reason = null) {
        $p = ['amount' => $amount ?: $this->get($transactionId)->amount];
        if ($reason != '' && !is_null($reason)) {
            $p['reason'] = $reason;
        }
        /** @var object $res */
        $res = $this->req("/$transactionId/refund", $p)->getResponse();
        return 200 == $res->getResponseCode();
    }

    /**
	 * 2017-02-19
     * @param array(string => string) $p
     * @return T
     * @throws TE|RE
     */
    public function create(array $p) {
        H::validateNewTransactionArguments($p);
        return H::fillTransaction(json_decode($this->req(null, $p)->getResponse()));
    }

	/**
	 * 2017-02-19
	 * @param string|null $suffix [optional]
	 * @param array(string => string) $p [optional]
	 * @return RequestHandler
	 */
    private function req($suffix = null, array $p = []) {
    	/** @var $result $result */
        $result = new RequestHandler;
        $result->setHttpMethod('POST');
        $result->setBaseUrl($this->api->getApiEndpoint());
        $result->setQueryString("/transaction$suffix");
        $result->addHeader($this->api->getApiKey(), 'X-APIKEY');
        if ($p) {
			$result->setPostParameters($p, false);
		}
        $result->doRequest();
        return $result;
	}
}
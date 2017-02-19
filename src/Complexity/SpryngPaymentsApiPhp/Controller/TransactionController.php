<?php
namespace SpryngPaymentsApiPhp\Controller;
use SpryngPaymentsApiPhp\Exception\RequestException as RE;
use SpryngPaymentsApiPhp\Exception\TransactionException as TE;
use SpryngPaymentsApiPhp\Helpers\TransactionHelper as H;
use SpryngPaymentsApiPhp\Object\Transaction as T;
use SpryngPaymentsApiPhp\Utility\RequestHandler as Req;
// 2017-02-19
final class TransactionController extends BaseController {
	/**
	 * 2017-02-19
	 * @return T[]
	 */
	public function all() {return array_map(function(array $t) {return
		H::fillTransaction($t)
	;}, json_decode($this->req(null, [], 'GET')->getResponse()));}

	/**
	 * 2017-02-19
	 * @param string $id
	 * @param int|null $amount [optional]
	 * @return T
	 * @throws TE|RE
	 */
	public function capture($id, $amount = null) {return H::fillTransaction(json_decode(
		$this->req("/$id/capture", ['amount' => $amount ?: $this->get($id)->amount])->getResponse()
	));}

	/**
	 * 2017-02-19
	 * @param array(string => string) $p
	 * @return T
	 * @throws TE|RE
	 */
	public function create(array $p) {return H::fillTransaction(json_decode($this->req(
		null, H::validateCreate($p)
	)->getResponse()));}
	
	/**
	 * 2017-02-19
	 * @param string $id
	 * @return T
	 * @throws TE
	 */
	public function get($id) {
		/** @var array(string => mixed) $resultA */
		if (!($resultA = json_decode($this->req("?_id={$id}", [], 'GET')->getResponse()))) {
			throw new TE('Transaction not found', 202);
		}
		return H::fillTransaction($resultA[0]);
	}

	/**
	 * 2017-02-19
	 * (partly) Refund a transaction
	 * @param string $id
	 * @param int|null $amount [optional]
	 * @param string|null $reason [optional]
	 * @return bool
	 * @throws TE|RE
	 */
	public function refund($id, $amount = null, $reason = null) {
		/** @var object $res */
		$res = $this->req("/$id/refund", df_clean([
			'amount' => $amount ?: $this->get($id)->amount, 'reason' => $reason
		]))->getResponse();
		return 200 == $res->getResponseCode();
	}

	/**
	 * 2017-02-19
	 * @param string|null $suffix [optional]
	 * @param array(string => string) $p [optional]
	 * @param string $method [optional]
	 * @return Req
	 */
	private function req($suffix = null, array $p = [], $method = 'POST') {
		/** @var $result $result */
		$result = new Req;
		$result->setHttpMethod($method);
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
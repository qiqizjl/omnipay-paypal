<?php
/**
 *
 *
 * @author    王锶奇 <wangsiqi2@100tal.com>
 * @time      2019/12/23 2:32 下午
 *
 * @copyright 2019 好未来教育科技集团-考满分事业部
 * @license   http://www.kmf.com license
 */


namespace Omnipay\PaypalV2\Message\Rest;

class FetchTransactionRequest extends AbstractRequest
{

    protected function getHttpMethod()
    {
        return 'GET';
    }
    public function setOrderId($data)
    {
        return $this->setParameter("order_id", $data);
    }

    public function getOrderId()
    {
        return $this->getParameter("order_id");
    }

    public function getData()
    {
        return [];
    }

    public function getEndpoint()
    {
        return parent::getEndpoint() . '/checkout/orders/' . $this->getOrderId();
    }
}
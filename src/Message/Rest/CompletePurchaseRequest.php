<?php
/**
 *
 *
 * @author    王锶奇 <wangsiqi2@100tal.com>
 * @time      2019/12/19 3:24 下午
 *
 * @copyright 2019 好未来教育科技集团-考满分事业部
 * @license   http://www.kmf.com license
 */


namespace Omnipay\PaypalV2\Message\Rest;

class CompletePurchaseRequest extends AbstractRequest
{
    public function getOrderId()
    {
        return $this->getParameter('orderId');
    }

    public function setOrderId($text)
    {
        $this->setParameter("orderId", $text);
        return $this;
    }


    /**
     * Get the raw data array for this message. The format of this varies from gateway to
     * gateway, but will usually be either an associative array, or a SimpleXMLElement.
     *
     * @return mixed
     */
    public function getData()
    {
        $this->validate('orderId');
        return null;
    }

    public function getEndpoint()
    {
        return parent::getEndpoint() . '/checkout/orders/' . $this->getOrderId() . '/capture';
    }
}


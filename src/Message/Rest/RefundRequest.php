<?php
/**
 *
 *
 * @author    王锶奇 <wangsiqi2@100tal.com>
 * @time      2019/12/19 3:50 下午
 *
 * @copyright 2019 好未来教育科技集团-考满分事业部
 * @license   http://www.kmf.com license
 */


namespace Omnipay\PaypalV2\Message\Rest;

class RefundRequest extends AbstractRequest
{


    public function setCaptureId($data)
    {
        return $this->setParameter("capture_id", $data);
    }

    public function getCaptureId()
    {
        return $this->getParameter("capture_id");
    }

    public function getData()
    {
        if ($this->getAmount() > 0) {
            return array (
                'amount'        => array (
                    'currency_code' => $this->getCurrency(),
                    'value'    => $this->getAmount(),
                ),
                "invoice_id"=>$this->getTransactionId(),
                'note_to_payer' => $this->getDescription(),
            );
        } else {
            return new \stdClass();
        }
    }

    public function getEndpoint()
    {
        return parent::getEndpoint() . '/payments/captures/' . $this->getCaptureId() . '/refund';
    }

}
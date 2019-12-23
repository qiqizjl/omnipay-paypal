<?php
/**
 *
 *
 * @author    王锶奇 <wangsiqi2@100tal.com>
 * @time      2019/12/17 5:31 下午
 *
 * @copyright 2019 好未来教育科技集团-考满分事业部
 * @license   http://www.kmf.com license
 */

namespace Omnipay\PaypalV2\Message\Rest;

class PurchaseRequest extends AuthorizeRequest
{

    /**
     * @inheritDoc
     */
    public function getData()
    {
        $data           = parent::getData();
        $data['intent'] = 'CAPTURE';
        return $data;
    }
}
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

class FetchTransactionListRequest extends AbstractRequest
{

    protected function getHttpMethod()
    {
        return 'GET';
    }

    public function setStartDate($data)
    {
        return $this->setParameter("start_date", $data);
    }

    public function getStartDate()
    {
        return $this->getParameter("start_date");
    }

    public function setEndDate($data)
    {
        return $this->setParameter("end_date", $data);
    }

    public function getEndDate()
    {
        return $this->getParameter("end_date");
    }

    public function setFields($data)
    {
        return $this->setParameter("fields", $data);
    }

    public function getFields()
    {
        return $this->getParameter("fields");
    }


    public function getData()
    {
        return [];
    }

    protected function getQuery(): array
    {
        return [
            "start_date" => $this->getStartDate(),
            "end_date"   => $this->getEndDate(),
            "fields"     => $this->getFields(),
        ];
    }

    protected function getEndpoint()
    {
        $base = $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
        return $base . "v1/reporting/transactions?" . http_build_query($this->getQuery());
    }
}
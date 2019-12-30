<?php
/**
 *
 *
 * @author    王锶奇 <wangsiqi2@100tal.com>
 * @time      2019/12/17 4:48 下午
 *
 * @copyright 2019 好未来教育科技集团-考满分事业部
 * @license   http://www.kmf.com license
 */

namespace Omnipay\PaypalV2;

use GuzzleHttp\Psr7\Request;
use Http\Adapter\Guzzle6\Client as GuzzleClient;
use Http\Discovery\HttpClientDiscovery;
use Omnipay\Common\AbstractGateway;
use Omnipay\Common\Http\Client;
use Omnipay\Common\Message\RequestInterface;
use Omnipay\Common\Message\ResponseInterface;
use Omnipay\PaypalV2\Message\Rest\CompletePurchaseRequest;
use Omnipay\PaypalV2\Message\Rest\FetchCaptureRequest;
use Omnipay\PaypalV2\Message\Rest\FetchTransactionRequest;
use Omnipay\PaypalV2\Message\Rest\PurchaseRequest;
use Omnipay\PaypalV2\Message\Rest\RefundRequest;

/**
 * @method RequestInterface authorize(array $options = array ())
 * @method RequestInterface completeAuthorize(array $options = array ())
 * @method RequestInterface capture(array $options = array ())
 * @method RequestInterface void(array $options = array ())
 * @method RequestInterface createCard(array $options = array ())
 * @method RequestInterface updateCard(array $options = array ())
 * @method RequestInterface deleteCard(array $options = array ())
 */
class RestGateway extends AbstractGateway
{

    public function getDefaultParameters()
    {
        return array (
            'clientId' => '',
            'secret'   => '',
            'testMode' => false,
        );
    }

    public function initialize(array $parameters = array ())
    {
        parent::initialize($parameters);
        if (isset($parameters["http_proxy"])) {
            $this->httpClient = $this->getClient($parameters["http_proxy"]);
        }
    }

    protected function getClient($http_proxy)
    {
        $request = HttpClientDiscovery::find();
        if ($request instanceof GuzzleClient) {
            $request = GuzzleClient::createWithConfig([
                "proxy" => $http_proxy,
            ]);
        }
        return new Client($request);
    }


    /**
     * @inheritDoc
     */
    public function getName()
    {
        return 'PayPal REST API V2';
    }

    /**
     * Get OAuth 2.0 client ID for the access token.
     *
     * Get an access token by using the OAuth 2.0 client_credentials
     * token grant type with your clientId:secret as your Basic Auth
     * credentials.
     *
     * @return string
     */
    public function getClientId()
    {
        return $this->getParameter('clientId');
    }

    /**
     * Set OAuth 2.0 client ID for the access token.
     *
     * Get an access token by using the OAuth 2.0 client_credentials
     * token grant type with your clientId:secret as your Basic Auth
     * credentials.
     *
     * @param string $value
     * @return RestGateway provides a fluent interface
     */
    public function setClientId($value)
    {
        return $this->setParameter('clientId', $value);
    }

    /**
     * Get OAuth 2.0 secret for the access token.
     *
     * Get an access token by using the OAuth 2.0 client_credentials
     * token grant type with your clientId:secret as your Basic Auth
     * credentials.
     *
     * @return string
     */
    public function getSecret()
    {
        return $this->getParameter('secret');
    }

    /**
     * Set OAuth 2.0 secret for the access token.
     *
     * Get an access token by using the OAuth 2.0 client_credentials
     * token grant type with your clientId:secret as your Basic Auth
     * credentials.
     *
     * @param string $value
     * @return RestGateway provides a fluent interface
     */
    public function setSecret($value)
    {
        return $this->setParameter('secret', $value);
    }

    /**
     * Get OAuth 2.0 access token.
     *
     * @param bool $createIfNeeded [optional] - If there is not an active token present, should we create one?
     * @return string
     */
    public function getToken($createIfNeeded = true)
    {
        $clientid = $this->getParameter("clientId");
        $secret   = $this->getParameter("secret");
        $this->setParameter("token", base64_encode($clientid . ":" . $secret));
        return base64_encode($clientid . ":" . $secret);
    }


    public function __call($name, $arguments)
    {
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface authorize(array $options = array())
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface completeAuthorize(array $options = array())
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface capture(array $options = array())
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface purchase(array $options = array())
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface completePurchase(array $options = array())
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface refund(array $options = array())
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface void(array $options = array())
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface createCard(array $options = array())
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface updateCard(array $options = array())
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface deleteCard(array $options = array())
    }

    public function createRequest($class, array $parameters)
    {
        $this->getToken();
        return parent::createRequest($class, $parameters);
    }

    public function purchase(array $options): RequestInterface
    {
        return $this->createRequest(PurchaseRequest::class, $options);
    }

    public function completePurchase(array $options): RequestInterface
    {
        return $this->createRequest(CompletePurchaseRequest::class, $options);
    }

    public function refund(array $options): RequestInterface
    {
        return $this->createRequest(RefundRequest::class, $options);
    }

    public function fetchTransaction(array $options): RequestInterface
    {
        return $this->createRequest(FetchTransactionRequest::class, $options);
    }


    public function fetchCapture(array $options): RequestInterface
    {
        return $this->createRequest(FetchCaptureRequest::class, $options);
    }

}


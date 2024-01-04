<?php

namespace Omnipay\Payson\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;

class ApiV1CheckoutResponse extends AbstractResponse implements RedirectResponseInterface
{
    protected $liveEndpoint = 'https://checkout.payson.se/payment/?token=';
    protected $testEndpoint = 'https://test-checkout.payson.se/payment/?token=';

    /**
     * Is the response successful?
     *
     * @return boolean
     */
    public function isSuccessful()
    {
        return false;
    }

    public function isRedirect()
    {
        return true;
    }

    /**
     * Gets the redirect target url.
     *
     * @return string
     */
    public function getRedirectUrl()
    {
        return $this->getEndpoint() . $this->data['TOKEN'];
    }

    /**
     * Get the required redirect method (either GET or POST).
     *
     * @return string
     */
    public function getRedirectMethod()
    {
        return 'GET';
    }

    public function getData()
    {
        return $this->data;
    }

    public function getTransactionReference()
    {
        return $this->data['TOKEN'];
    }

    protected function getEndpoint()
    {
        return $this->request->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
    }
}

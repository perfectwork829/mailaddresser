<?php

namespace Omnipay\Payson\Message;

abstract class ApiV2AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    protected $liveEndpoint = 'https://api.payson.se/2.0/';
    protected $testEndpoint = 'https://test-api.payson.se/2.0/';

    public function getApiKey()
    {
        return $this->getParameter('apiKey');
    }
    public function setApiKey($value)
    {
        return $this->setParameter('apiKey', $value);
    }

    public function getAgentId()
    {
        return $this->getParameter('agentId');
    }

    public function setAgentId($value)
    {
        return $this->setParameter('agentId', $value);
    }

    protected function getEndpoint()
    {
        return $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
    }

    public function getSignature()
    {
        return base64_encode($this->getAgentId() . ':' . $this->getApiKey());
    }
}

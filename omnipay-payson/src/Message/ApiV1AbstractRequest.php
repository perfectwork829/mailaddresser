<?php

namespace Omnipay\Payson\Message;

abstract class ApiV1AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    protected $liveEndpoint = 'https://api.payson.se/1.0/';
    protected $testEndpoint = 'https://test-api.payson.se/1.0/';

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

    public function getReceiverEmail()
    {
        return $this->getParameter('receiverEmail');
    }

    public function setReceiverEmail($value)
    {
        return $this->setParameter('receiverEmail', $value);
    }

    protected function getEndpoint()
    {
        return $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
    }
}

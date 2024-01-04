<?php


namespace Omnipay\Payson\Message;


use Exception;
use Omnipay\Common\Message\ResponseInterface;

class ApiV1CheckoutRequest extends ApiV1AbstractRequest
{
    /**
     * @return mixed
     */
    public function getSenderEmail()
    {
        return $this->getParameter('senderEmail');
    }

    /**
     * @param mixed $senderEmail
     */
    public function setSenderEmail($senderEmail): void
    {
        $this->setParameter('senderEmail', $senderEmail);
    }

    /**
     * @return mixed
     */
    public function getSenderFirstName()
    {
        return $this->getParameter('senderFirstName');
    }

    /**
     * @param mixed $senderFirstName
     */
    public function setSenderFirstName($senderFirstName): void
    {
        $this->setParameter('senderFirstName', $senderFirstName);
    }

    /**
     * @return mixed
     */
    public function getSenderLastName()
    {
        return $this->getParameter('senderLastName');
    }

    /**
     * @param mixed $senderLastName
     */
    public function setSenderLastName($senderLastName): void
    {
        $this->getParameter('senderLastName');
    }

    /**
     * @return mixed
     */
    public function getLocalCode()
    {
        return $this->getParameter('localCode');
    }

    /**
     * @param mixed $localCode
     */
    public function setLocalCode($localCode): void
    {
        $this->setParameter('localCode', $localCode);
    }

    /**
     * @return mixed
     */
    public function getMemo()
    {
        return $this->getParameter('memo');
    }

    /**
     * @param mixed $memo
     */
    public function setMemo($memo): void
    {
        $this->setParameter('memo', $memo);
    }

    public function getGuaranteeOffered()
    {
        return $this->getParameter('guaranteeOffered');
    }

    public function setGuaranteeOffered($value)
    {
        return $this->setParameter('guaranteeOffered', $value);
    }

    public function getData()
    {
        return [
            'returnUrl' => $this->getReturnUrl(),
            'cancelUrl' => $this->getCancelUrl(),
            'ipnNotificationUrl' => $this->getNotifyUrl(),
            'memo' => $this->getMemo(),
            'senderEmail' => $this->getSenderEmail(),
            'senderFirsName' => $this->getSenderFirstName(),
            'senderLastName' => $this->getSenderLastName(),
            'localCode' => $this->getLocalCode(),
            'currencyCode' => $this->getCurrency(),
            'receiverList.receiver(0).email' => $this->getReceiverEmail(),
            'receiverList.receiver(0).amount' => $this->getAmount(),
            'guaranteeOffered' => $this->getGuaranteeOffered()
        ];
    }

    /**
     * Send the request with specified data
     *
     * @param mixed $data The data to send
     * @return ResponseInterface
     * @throws Exception
     */
    public function sendData($data)
    {
        $url = $this->getEndpoint() . 'Pay';
        $response = $this->httpClient->request(
            'POST',
            $url,
            [
                'PAYSON-SECURITY-USERID' => $this->getAgentId(),
                'PAYSON-SECURITY-PASSWORD' => $this->getApiKey(),
                'Content-Type' => 'application/x-www-form-urlencoded',
            ],
            http_build_query($data)
        );

        $body = [];
        parse_str($response->getBody(), $body);

        if ($body['responseEnvelope_ack'] == 'FAILURE') throw new Exception(json_encode($body));

        return $this->createResponse($body);
    }

    protected function createResponse($data)
    {
        return $this->response = new ApiV1CheckoutResponse($this, $data);
    }
}

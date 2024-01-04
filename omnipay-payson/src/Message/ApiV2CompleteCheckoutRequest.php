<?php

namespace Omnipay\Payson\Message;

use Exception;

class ApiV2CompleteCheckoutRequest extends ApiV2AbstractRequest
{
    /**
     * Get the raw data array for this message. The format of this varies from gateway to
     * gateway, but will usually be either an associative array, or a SimpleXMLElement.
     *
     * @return mixed
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        return $this->validate('transactionReference');
    }

    public function sendData($data)
    {
        $url = $this->getEndpoint() . 'Checkouts/' . $this->getTransactionReference();
        $response = $this->httpClient->request(
            'GET',
            $url,
            [
                'Authorization' => 'Basic ' . $this->getSignature(),
                'Content-Type' => 'application/json'
            ]
        );

        $data = json_decode($response->getBody(), true);

        if ($response->getStatusCode() != '200') throw new Exception($response->getBody());

        return $this->createResponse($data);
    }

    protected function createResponse($data)
    {
        return $this->response = new ApiV2CompleteCheckoutResponse($this, $data);
    }
}

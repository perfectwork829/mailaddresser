<?php

namespace Omnipay\Payson\Message;

use Exception;

class ApiV1CompleteCheckoutRequest extends ApiV1AbstractRequest
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
        return [
            'token' => $this->getTransactionReference()
        ];
    }

    public function sendData($data)
    {
        $url = $this->getEndpoint() . 'PaymentDetails';
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
        return $this->response = new ApiV1CompleteCheckoutResponse($this, $data);
    }
}

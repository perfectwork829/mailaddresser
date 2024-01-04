<?php


namespace Omnipay\Payson\Message;


use Exception;
use Omnipay\Common\Message\ResponseInterface;

class ApiV2CheckoutRequest extends ApiV2AbstractRequest
{
    public function getTermsUrl()
    {
        return $this->getParameter('termsUrl');
    }

    public function setTermsUrl($value)
    {
        $this->setParameter('termsUrl', $value);
    }

    public function getCheckoutUrl()
    {
        $protocol = 'http://';
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
            $protocol = 'https://';
        }
        return "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    }

    public function getItems()
    {
        return $this->getParameter('items');
    }

    public function setItems($items)
    {
        return $this->setParameter('items', $items);
    }

    public function getData()
    {
        return [
            'merchant' => [
                'checkoutUri' => $this->getCheckoutUrl(),
                'confirmationUri' => $this->getReturnUrl(),
                'notificationUri' => $this->getNotifyUrl(),
                'termsUri' => $this->getTermsUrl(),
            ],
            'order' => [
                'currency' => $this->getCurrency(),
                'items' => $this->getItems(),
            ],
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
        $url = $this->getEndpoint() . 'Checkouts';
        $response = $this->httpClient->request(
            'POST',
            $url,
            [
                'Authorization' => 'Basic ' . $this->getSignature(),
                'Content-Type' => 'application/json'
            ],
            json_encode($data)
        );

        $data = json_decode($response->getBody(), true);

        if ($response->getStatusCode() != '201') throw new Exception($response->getBody());

        return $this->createResponse($data);
    }

    protected function createResponse($data)
    {
        return $this->response = new ApiV2CheckoutResponse($this, $data);
    }
}

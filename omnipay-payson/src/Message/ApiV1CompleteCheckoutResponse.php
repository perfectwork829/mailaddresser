<?php

namespace Omnipay\Payson\Message;

use Omnipay\Common\Message\AbstractResponse;

class ApiV1CompleteCheckoutResponse extends AbstractResponse
{

    /**
     * Is the response successful?
     *
     * @return boolean
     */
    public function isSuccessful()
    {
        return $this->getData()['status'] == 'COMPLETED';
    }
}

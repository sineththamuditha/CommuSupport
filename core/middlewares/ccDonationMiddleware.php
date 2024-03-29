<?php

namespace app\core\middlewares;

class ccDonationMiddleware extends  Middleware
{
    protected function accessRules(): array
    {
        return [
            'viewCCDonations' => [$this->LOGISTIC],
            'createCCDonation' => [$this->LOGISTIC],
            'acceptCCDonation' => [$this->LOGISTIC],
            'CCDonationPopup' => [$this->LOGISTIC],
            'filterCCDonations' => [$this->LOGISTIC],
        ];
    }
}
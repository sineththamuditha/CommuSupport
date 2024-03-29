<?php

namespace app\core\middlewares;

class requestMiddleware extends Middleware
{

    protected function accessRules(): array
    {
        return [
            'viewRequests' => [$this->ADMIN,$this->CHO,$this->MANAGER,$this->DONOR,$this->DONEE,$this->LOGISTIC],
            'postRequest' => [$this->DONEE],
            'requestPopup' => [$this->ADMIN,$this->CHO,$this->MANAGER,$this->DONOR,$this->DONEE,$this->LOGISTIC],
            'setApproval' => [$this->MANAGER],
            'acceptRequest' => [$this->DONOR,$this->LOGISTIC],
            'filterRequests' => [$this->DONOR,$this->LOGISTIC],
            'filterRequestsAdmin' => [$this->ADMIN],
            'filterOwnRequests' => [$this->DONEE],
            'filterRequestsManager' => [$this->MANAGER],
            'requestPopupManager' => [$this->MANAGER],
            'cancelRequest' => [$this->DONEE],
        ];
    }
}
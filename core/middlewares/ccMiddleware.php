<?php

namespace app\core\middlewares;

class ccMiddleware extends Middleware
{

    protected function accessRules(): array
    {
        return [
            'viewCC' => [$this->ADMIN,$this->CHO]
        ];
    }
}
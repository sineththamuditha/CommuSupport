<?php

namespace app\core\middlewares;

class doneeMiddleware extends Middleware
{

        protected function accessRules(): array
        {
            return [
                'viewDonees' => [$this->MANAGER, $this->ADMIN],
                'getData' => [$this->MANAGER, $this->ADMIN],
                'verifyDonee' => [$this->MANAGER],
                'doneesFilterAdmin' => [$this->ADMIN,],
                'filterDonees' => [$this->MANAGER],
                'doneePopup' => [$this->MANAGER],
                'viewIndividualDonee' => [$this->ADMIN]
            ];

        }

}
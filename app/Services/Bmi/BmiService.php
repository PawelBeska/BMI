<?php

namespace App\Services\Bmi;

use App\Models\Bmi;
use App\Models\User;

class BmiService
{

    /**
     * @var Bmi
     */
    private Bmi $bmi;

    /**
     * BmiService constructor.
     * @param Bmi|null $bmi
     */
    public function __construct(Bmi $bmi = null)
    {
        $this->bmi = $bmi ? $bmi : new Bmi();
    }

    /**
     * @param array $data
     * @param User $user
     */
    public function addToHistory(array $data, User $user)
    {

    }
}

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
     * @return Bmi
     */
    public function addToHistory(array $data, User $user): Bmi
    {

        $this->bmi->height = $data['height'];
        $this->bmi->weight = $data['weight'];
        $this->bmi->male = $data['male'];
        $this->bmi->age = $data['age'];
        $this->bmi->user_id = $user->id;
        $this->bmi->bmi = $data['weight'] / ($data['height'] / 100 * $data['height']);
        $this->bmi->save();
        return $this->bmi;
    }
}

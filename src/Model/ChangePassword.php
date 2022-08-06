<?php

namespace App\Model;

use Symfony\Component\Security\Core\Validator\Constraints as SecurityAssert;
use Symfony\Component\Validator\Constraints as Assert;

class ChangePassword {

    /**
     */
    protected $oldPassword;

    /**
     * @Assert\Length(
     *     min = 6,
     *     minMessage = "Minimum 6 caractères!"
     * )
     */
    protected $password;


    public function getOldPassword() {
        return $this->oldPassword;
    }

    public function setOldPassword($oldPassword) {
        $this->oldPassword = $oldPassword;
        return $this;
    }


    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
        return $this;
    }

}
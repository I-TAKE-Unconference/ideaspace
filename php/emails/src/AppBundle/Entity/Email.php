<?php

namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Email
{
    /**
     * @Assert\NotBlank()
     * @Assert\Email()
     *
     * @var string $userEmail
     */
    protected $userEmail;

    /**
     * @Assert\NotBlank()
     *
     * @var string $emailType
     */
    protected $emailType;

    /**
     * @return string
     */
    public function getUserEmail()
    {
        return $this->userEmail;
    }

    /**
     * @param $userEmail
     * @return $this
     */
    public function setUserEmail($userEmail)
    {
        $this->userEmail = $userEmail;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmailType()
    {
        return $this->emailType;
    }

    /**
     * @param $emailType
     * @return $this
     */
    public function setEmailType($emailType)
    {
        $this->emailType = $emailType;

        return $this;
    }

}
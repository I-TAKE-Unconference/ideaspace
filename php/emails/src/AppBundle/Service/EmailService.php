<?php

namespace AppBundle\Service;

use Symfony\Bundle\TwigBundle\TwigEngine;


class EmailService
{
    protected $emailTemplates;

    /**
     * @var TwigEngine
     */
    protected $templating;

    /**
     * @var \Swift_Mailer
     */
    protected $mailer;

    public function __construct(TwigEngine $templating, \Swift_Mailer $mailer, $emailTemplates)
    {
        $this->templating = $templating;
        $this->mailer = $mailer;
        $this->emailTemplates = $emailTemplates;
    }


    public function getEmailTemplates()
    {
        return array_keys($this->emailTemplates);
    }

    public function sendEmail($userEmail, $emailType)
    {
        if (!isset($this->emailTemplates[$emailType])) {
            throw new \InvalidArgumentException("The email type is not defined!");
        }

        $templateParams = array();

        $message = \Swift_Message::newInstance()
            ->setSubject($this->emailTemplates[$emailType]['subject'])
            ->setFrom($this->emailTemplates[$emailType]['from'])
            ->setTo($userEmail)
            ->setBody(
                $this->templating->render(
                    $this->emailTemplates[$emailType]['template'],
                    $templateParams
                )
            );
        $this->mailer->send($message, $failedRecipients);
        if (count($failedRecipients) > 0) {
            return false;
        }

        return true;
    }
}
<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Email;
use AppBundle\Form\EmailType;
use Symfony\Component\HttpFoundation\Request;

use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcherInterface;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Response;


class EmailController extends FOSRestController
{


    /**
     * Send email to user.
     *
     * @ApiDoc(
     *   resource = true,
     *   input = "AppBundle\Form\EmailType",
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @POST("/user/sendEmail", name="_user_send_email")
     * @View
     *
     * @param Request $request the request object
     *
     * @return array
     */
    public function sendUserEmailAction(Request $request)
    {
        $email = new Email();

        $form = $this->createForm(EmailType::class, $email);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $emailManager = $this->get('email_manager');

            return $emailManager->sendEmail($email->getUserEmail(), $email->getEmailType());
        } else {

            return $this->view($form, 400);
        }
    }

    /**
     *
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @Get("/user/emailsType", name="_user_email_type")
     * @View
     *
     * @return array
     */
    public function getEmailsTypeAction()
    {
        $emailManager = $this->get('email_manager');

        return $emailManager->getEmailTemplates();
    }
}

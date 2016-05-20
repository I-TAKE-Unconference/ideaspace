<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;

use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcherInterface;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\Annotations\Get;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Response;


class DefaultController extends FOSRestController
{


    /**
     * List all stuff.
     *
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @Get("/test", name="_foo")
     * @View
     *
     * @param Request               $request      the request object
     *
     * @return array
     */
    public function getTestAction(Request $request)
    {
        return array("users" => "test2");
    }
}

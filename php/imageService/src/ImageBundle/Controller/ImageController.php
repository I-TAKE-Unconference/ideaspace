<?php

namespace ImageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Filesystem\Exception\IOException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ImageController extends Controller
{
    public function uploadAction(Request $request)
    {
        try{
            $output = $this->get('filehandler')->saveFile();
        } catch (IOException $e)
        {
            return new JsonResponse(['error' => $e->getMessage()], 500);
        } catch (\Exception $e)
        {
            return new JsonResponse(['error' => $e->getMessage()], 422);
        }

        return new JsonResponse(['path' => $this->$output()]);
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: gabiudrescu
 * Date: 20.05.2016
 * Time: 15:39
 */

namespace ImageBundle\Handler;

use Symfony\Component\Filesystem\Filesystem;
use \Symfony\Component\HttpFoundation\Request;

class FileHandler {

    protected $request;

    protected $filesystem;

    protected $serverPath;

    protected $publicPath;

    public function __construct(
        Request $request = null,
        Filesystem $filesystem,
        $serverPath,
        $publicPath
    )
    {
        $this->request = $request;
        $this->filesystem = $filesystem;
        $this->serverPath = $serverPath;
        $this->publicPath = $publicPath;
    }

    /**
     * @throws \Exception
     *
     * @return string return the base64 file from request
     */
    protected function handleRequest()
    {
        if (null === ($file = $this->request->get('file')))
        {
            throw new \Exception("'file' POST Key is not present in request");
        }
        return $file;
    }

    public function saveFile()
    {
        $this->filesystem->dumpFile($this->buildServerPath(), $this->clean($this->handleRequest()));

        return $this->buildPublicPath();
    }

    private function buildServerPath()
    {
        return sprintf('%s%s',
            $this->serverPath,
            $this->buildFileName()
        );
    }

    private $fileName;

    private function buildFileName()
    {
        if (!$this->fileName)
        {
            $this->fileName = uniqid('image_', true).".png";
        }

        return $this->fileName;
    }

    private function buildPublicPath()
    {
        return sprintf('%s%s',
            $this->publicPath,
            $this->buildFileName()
        );
    }

    private function clean($base64)
    {
        $img = str_replace('data:image/png;base64,', '', $base64);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);

        return $data;
    }
}
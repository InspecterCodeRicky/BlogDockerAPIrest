<?php


class ControllerError extends ControllerBigBoss
{

    public function runPageNotFound()
    {
        return $this->MakeView("Error 404", [], "error");
    }

    public function executeNoRouteJSON()
    {
        $this->HTTPResponse->addHeader('HTTP/1.0 404 Not Found');
        return $this->renderJSON([
            'status' => 0,
            'error' => 'Nothing found at this address'
        ]);
    }
}
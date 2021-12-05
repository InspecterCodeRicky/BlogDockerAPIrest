<?php


class ControllerError extends ControllerBigBoss
{

    public function runPageNotFound()
    {
        return $this->MakeView("Error 404", [], "error");
    }

    public function APINotFound()
    {
        return $this->renderJSON([
            'status' => 404,
            'error' => 'KO'
        ]);
    }
}
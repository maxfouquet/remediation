<?php
declare(strict_types=1);

/**
 * ErrorsController
 *
 * Manage errors
 */
class ErrorsController extends ControllerBase
{
    public function show404Action()
    {
        $this->response->setStatusCode(404);
    }

    public function show401Action()
    {
        $this->response->setStatusCode(401);
    }
}
<?php

namespace App\EventListener;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\RouterInterface;
class Redirection404
{
    private $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    public function onKernelException(ExceptionEvent $event)
    {
        // Obtener la excepción
        $exception = $event->getThrowable();

        // Verificar si es un error 404
        if ($exception instanceof NotFoundHttpException) {
            // Crear una respuesta de redirección al home
            $response = new RedirectResponse($this->router->generate('app_culture'));
            $event->setResponse($response);
        }
    }
}
<?php

namespace App\Controller\Api;

use App\Repository\FibonacciRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ApiController
{
    private $fibonacciRepository;

    public function __construct(FibonacciRepository $fibonacciRepository)
    {
        $this->fibonacciRepository = $fibonacciRepository;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function get(Request $request): JsonResponse
    {

        $response = new JsonResponse();
        $response->headers->set('Content-Type', 'application/json');

        try {
            $from = $request->query->get('from-date');
            $to = $request->query->get('to-date');

            if (null === $from
                || null === $to
                || !$this->fibonacciRepository->isStringValidDate($from)
                || !$this->fibonacciRepository->isStringValidDate($to)
            ) {
                throw new \Exception('Incorrect date input param', 400);
            }

            $numbers = $this->fibonacciRepository->numbersBetweenDates($from, $to);

            $response->setContent(\json_encode($numbers));

            return $response;

        } catch (\Exception $exception) {

            $code = (0 !== $exception->getCode() ? $exception->getCode() : 500);

            $response->setStatusCode($code);

            $response->setContent(
                \json_encode([
                    "message" => $exception->getMessage(),
                    "code" => $code,
                ])
            );

            return $response;
        }
    }
}
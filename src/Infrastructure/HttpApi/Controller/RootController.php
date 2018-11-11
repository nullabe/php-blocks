<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Infrastructure\HttpApi\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class RootController
 *
 * @package Nbe\PhpBlocks\Infrastructure\HttpApi\Controller
 */
final class RootController extends Controller
{

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function indexAction(Request $request): JsonResponse
    {
        if ($request->getMethod() !== Request::METHOD_GET) {
            return new JsonResponse([
                'Unauthorize HTTP Method: ' . $request->getMethod()
            ], Response::HTTP_UNAUTHORIZED);
        }

        return new JsonResponse([
            'method' => 'GET',
            'title' => 'PhpBlocks Http API',
            'description' => 'List of endpoints available, and how to use them',
            'data' => [
                'endpoints' => [
                    '/transactions/new' => [
                        'method' => 'POST',
                        'description' => 'Create a new transaction',
                        'params' => [
                            'sender' => 'Sender address',
                            'receiver' => 'Receiver address',
                            'amount' => 'Amount of transaction',
                        ],
                    ],
                    '/mine' => [
                        'method' => 'GET',
                        'description' => 'Mine a new block',
                        'params' => null,
                    ],
                    '/chain' => [
                        'method' => 'GET',
                        'description' => 'Return the full Blockchain',
                        'params' => null,
                    ],
                ],
            ],
        ]);
    }

}

<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Infrastructure\HttpApi\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

final class RootController extends Controller
{
    public function indexAction(Request $request): JsonResponse
    {
        if ($request->getMethod() !== Request::METHOD_GET) {
            return new JsonResponse([
                'Unauthorize HTTP Method: ' . $request->getMethod()
            ], Response::HTTP_UNAUTHORIZED);
        }

        return new JsonResponse([
            'method'      => 'GET',
            'title'       => 'PhpBlocks Http API',
            'description' => 'List of endpoints available, and how to use them',
            'data'        => [
                'endpoints'  => [
                    '/transactions/new' => [
                        'method'             => 'POST',
                        'description'        => 'Create a new transaction',
                        'params'             => [],
                    ],
                    '/mine'             => [
                        'method'             => 'POST',
                        'description'        => 'Mine a new block',
                        'params'             => [],
                    ],
                    '/chain'            => [
                        'method'             => 'GET',
                        'description'        => 'Return the full Blockchain',
                        'params'             => null,
                    ],
                ],
            ],
        ]);
    }
    
}

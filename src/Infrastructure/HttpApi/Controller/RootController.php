<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Infrastructure\HttpApi\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

final class RootController extends Controller
{
    public function indexAction(Request $request): JsonResponse
    {
        return new JsonResponse([
            'method' => 'GET',
            'title'  => 'PhpBlocks Http API',
            'description' => 'List of endpoints available, and how to use them',
            'data'   => [
                'endpoints' => [
                    '',
                    '',
                    '',
                ],
            ],
        ]);
    }
    
}
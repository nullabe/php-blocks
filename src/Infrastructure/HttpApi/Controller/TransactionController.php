<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Infrastructure\HttpApi\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * TransactionController class
 */
final class TransactionController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function postAction(Request $request): JsonResponse
    {
        if ($request->getMethod() !== Request::METHOD_POST) {
            return new JsonResponse([
                'Unauthorize HTTP Method: ' . $request->getMethod()
            ], Response::HTTP_UNAUTHORIZED);
        }

        return new JsonResponse();
    }
    
}

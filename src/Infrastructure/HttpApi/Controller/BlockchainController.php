<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Infrastructure\HttpApi\Controller;

use Nbe\PhpBlocks\Domain\Model\Normalizer\BlockchainNormalizer;
use Nbe\PhpBlocks\Domain\Model\State\BlockchainState;
use Nbe\PhpBlocks\Infrastructure\Storage\File\Formatter\BlockchainJsonFormatter;
use Nbe\PhpBlocks\Infrastructure\Storage\File\Repository\BlockchainFileRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class BlockchainController
 *
 * @package Nbe\PhpBlocks\Infrastructure\HttpApi\Controller
 */
final class BlockchainController extends Controller
{
    public $repository;

    /**
     * BlockchainController constructor.
     * @param BlockchainFileRepository $blockchainFileRepository
     */
    public function __construct(BlockchainFileRepository $blockchainFileRepository)
    {
        $this->repository = $blockchainFileRepository;
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function getAction(Request $request): JsonResponse
    {
        if ($request->getMethod() !== Request::METHOD_GET) {
            return new JsonResponse([
                'Unauthorize HTTP Method: ' . $request->getMethod()
            ], Response::HTTP_UNAUTHORIZED);
        }

        try {
            $blockchain = $this->repository->get();
            $blockchainState = new BlockchainState(BlockchainNormalizer::normalize($blockchain));

            $result = $blockchainState->getState();
        } catch (\Exception $e) {
            $result['error'] = $e->getMessage();
        }

        return new JsonResponse($result);
    }

}

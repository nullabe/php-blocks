<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Infrastructure\HttpApi\Controller;

use Nbe\PhpBlocks\Infrastructure\Storage\File\Repository\BlockchainFileRepository;
use Nbe\PhpBlocks\Infrastructure\Strategy\Storage\StorageStrategy;
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
    /**
     * @var StorageStrategy $storageStrategy
     */
    public $storageStrategy;

    /**
     * @var BlockchainFileRepository $repository
     */
    public $repository;

    /**
     * BlockchainController constructor.
     * @param StorageStrategy $storageStrategy
     * @param BlockchainFileRepository $blockchainFileRepository
     */
    public function __construct(StorageStrategy $storageStrategy, BlockchainFileRepository $blockchainFileRepository)
    {
        $this->storageStrategy = $storageStrategy;
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
            $result = $this->storageStrategy->getBlockchainAndPersistIfNew($this->repository);
        } catch (\Exception $e) {
            $result['error'] = $e->getMessage();
        }

        return new JsonResponse($result);
    }

}

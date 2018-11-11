<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Infrastructure\HttpApi\Controller;

use Nbe\PhpBlocks\Domain\Model\Entity\Transaction;
use Nbe\PhpBlocks\Domain\Model\Factory\TransactionFactory;
use Nbe\PhpBlocks\Infrastructure\Storage\File\Repository\BlockchainFileRepository;
use Nbe\PhpBlocks\Infrastructure\Strategy\Storage\StorageStrategy;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class TransactionController
 *
 * @package Nbe\PhpBlocks\Infrastructure\HttpApi\Controller
 */
final class TransactionController extends Controller
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
    public function postAction(Request $request): JsonResponse
    {
        if ($request->getMethod() !== Request::METHOD_POST) {
            return new JsonResponse([
                'Unauthorize HTTP Method: ' . $request->getMethod()
            ], Response::HTTP_UNAUTHORIZED);
        }

        $params = \json_decode($request->getContent(), TRUE);

        if (key_exists('sender', $params)
            && key_exists('receiver', $params)
            && key_exists('amount', $params)) {

            try {
                $result = $this->storageStrategy->addTransactionToBlockchainAndPersist($this->repository,
                    $this->newTransactionFromParams($params));
            } catch (\Exception $e) {
                $result['error'] = $e->getMessage();
            }

        } else {
            $result['error'] = 'Bad params';
        }

        return new JsonResponse($result);
    }

    /**
     * @param array $params
     * @return Transaction
     */
    private function newTransactionFromParams(array $params): Transaction
    {
        $transactionFactory = new TransactionFactory();

        return $transactionFactory(
            $params['sender'],
            $params['receiver'],
            (float)$params['amount']
        );
    }


}

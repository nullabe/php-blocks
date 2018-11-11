<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Infrastructure\Strategy\Storage;

use Nbe\PhpBlocks\Domain\Model\Entity\Transaction;
use Nbe\PhpBlocks\Domain\Model\Normalizer\BlockchainNormalizer;
use Nbe\PhpBlocks\Domain\Model\Normalizer\TransactionNormalizer;
use Nbe\PhpBlocks\Domain\Model\Repository\Contract\BlockchainRepository;
use Nbe\PhpBlocks\Domain\Model\State\BlockchainState;

/**
 * Class StorageStrategy
 * @package Nbe\PhpBlocks\Infrastructure\Strategy\Storage
 */
class StorageStrategy
{
    /**
     * @param BlockchainRepository $repository
     * @return array
     * @throws \Nbe\PhpBlocks\Domain\Exception\BuildBlockchainStateException
     */
    public function getBlockchainAndPersistIfNew(BlockchainRepository $repository): array
    {
        $blockchain = $repository->get();

        if ($blockchain->isNew()) {
            $repository->persist($blockchain);
        }

        $blockchainState = new BlockchainState(BlockchainNormalizer::normalize($blockchain));

        return $blockchainState->getState();
    }

    /**
     * @param BlockchainRepository $repository
     * @param Transaction $transaction
     * @return array
     */
    public function addTransactionToBlockchainAndPersist(BlockchainRepository $repository, Transaction $transaction): array
    {
        $blockchain = $repository->get();

        $blockchain->appendTransactionToStack($transaction);

        $repository->persist($blockchain);

        return TransactionNormalizer::normalize($transaction);
    }

}
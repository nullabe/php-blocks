<?php
declare(strict_types=1);

namespace Nullabe\PhpBlocks\Domain\Model;

final class Blockchain implements BlockchainInterface
{
    private static $instance;

    private function __construct()
    {

    }

    public static function getInstance(): BlockchainInterface
    {
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    function getChain(): array
    {
        // TODO: Implement getChain() method.
    }

    function getTransactionStack(): array
    {
        // TODO: Implement getTransactionStack() method.
    }

    function getLastBlock(): BlockInterface
    {
        // TODO: Implement getLastBlock() method.
    }

    function addNewBlockToChain(): BlockchainInterface
    {
        // TODO: Implement addNewBlockToChain() method.
    }

    function addNewTransactionToStack(): BlockchainInterface
    {
        // TODO: Implement addNewTransactionToStack() method.
    }

    static function hashBlock(): string
    {
        // TODO: Implement hashBlock() method.
    }

}
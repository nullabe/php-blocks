<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Infrastructure\HttpApi\Controller;

use Nbe\PhpBlocks\Api\BlockchainInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

final class BlockchainController extends Controller implements BlockchainInterface
{
    public function getAction()
    {

    }

}

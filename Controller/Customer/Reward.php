<?php

namespace Piltec\RewardPoints\Controller\Customer;

use Magento\Framework\View\Result\PageFactory;

/**
 * Class Reward render RP account tab
 */
class Reward implements \Magento\Framework\App\ActionInterface
{
    /**
     * @var PageFactory
     */
    protected $pageFactory;

    /**
     * @param PageFactory $pageFactory
     */
    public function __construct(
        PageFactory $pageFactory
    ) {
        $this->pageFactory = $pageFactory;
    }

    public function execute()
    {
        return $this->pageFactory->create();
    }
}
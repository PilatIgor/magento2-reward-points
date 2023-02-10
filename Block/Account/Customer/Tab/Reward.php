<?php

namespace Piltec\RewardPoints\Block\Account\Customer\Tab;

use Exception;
use Magento\Customer\Model\Customer;
use Magento\Customer\Model\SessionFactory;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Piltec\RewardPoints\Model\RewardPoints\PointAmount;

class Reward extends Template
{
    /**
     * @var PointAmount
     */
    protected $pointAmount;

    /**
     * @var SessionFactory
     */
    protected $customerSession;

    /**
     * @var Customer
     */
    protected $customer;

    /**
     * @param Context $context
     * @param SessionFactory $customerSession
     * @param Customer $customer
     * @param PointAmount $pointAmount
     * @param array $data
     */
    public function __construct
    (
        Context $context,
        SessionFactory $customerSession,
        Customer $customer,
        PointAmount $pointAmount,
        array $data = []
    )
    {
        $this->pointAmount = $pointAmount;
        $this->customerSession = $customerSession;
        $this->customer = $customer;
        parent::__construct($context, $data);
    }

    /**
     * Get current point amount for customer by session
     *
     * @return int
     * @throws Exception
     */
    public function getCurrentPointAmount(): int
    {
        $customerId =  $this->customerSession->create()
            ->getCustomer()
            ->getId();
        return $this->pointAmount->getCurrentPointAmount($customerId);
    }
}
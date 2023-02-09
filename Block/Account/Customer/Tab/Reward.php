<?php

namespace Piltec\RewardPoints\Block\Account\Customer\Tab;

use Magento\Customer\Model\Customer;
use Magento\Customer\Model\SessionFactory;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class Reward extends Template
{
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
     * @param array $data
     */
    public function __construct
    (
        Context $context,
        SessionFactory $customerSession,
        Customer $customer,
        array $data = []
    )
    {
        $this->customerSession = $customerSession;
        $this->customer = $customer;
        parent::__construct($context, $data);
    }

    /**
     * Get current point amount for customer by session
     *
     * @return int
     */
    public function getCurrentPointAmount(): int
    {
       $customerId =  $this->customerSession->create()
           ->getCustomer()
           ->getId();
       return $this->customer->load($customerId)->getData('reward_points_amount');
    }
}
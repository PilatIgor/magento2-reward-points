<?php

namespace Piltec\RewardPoints\Block\Account\Customer\Tab;

use Magento\Customer\Model\Customer;
use Magento\Customer\Model\SessionFactory;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Customer\Model\ResourceModel\Customer\CollectionFactory as CustomerFactory;

class Reward extends Template
{
    /**
     * @var CustomerFactory
     */
    protected $customerRepository;

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
     * @param CustomerFactory $customerRepository
     * @param array $data
     */
    public function __construct
    (
        Context $context,
        SessionFactory $customerSession,
        Customer $customer,
        CustomerFactory $customerRepository,
        array $data = []
    )
    {
        $this->customerRepository = $customerRepository;
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

        $customerCollection = $this->customerRepository->create()
            ->addFieldToFilter('entity_id', $customerId);

        $currentPointAmount = $customerCollection->getData();
        return $currentPointAmount[0]['reward_points_amount'];
    }
}
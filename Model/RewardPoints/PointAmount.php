<?php

namespace Piltec\RewardPoints\Model\RewardPoints;

use Exception;
use Magento\Customer\Model\ResourceModel\Customer\CollectionFactory as CustomerFactory;

class PointAmount
{
    /**
     * @var CustomerFactory
     */
    protected $customerFactory;

    /**
     * @param CustomerFactory $customerFactory
     */
    public function __construct(
        CustomerFactory $customerFactory
    ) {
        $this->customerFactory = $customerFactory;
    }

    /**
     * Get current point amount by customer id
     *
     * @param $customerId
     * @return int|string
     * @throws Exception
     */
    public function getCurrentPointAmount($customerId)
    {
        $customerCollection = $this->customerFactory->create()
            ->addFieldToFilter('entity_id', $customerId);
        $currentPointAmount = $customerCollection->getData();
        $currentPointAmount = $currentPointAmount[0]['reward_points_amount'];
        if ($currentPointAmount == NULL) {
            throw new Exception(__('Something went wrong while loading point amount'));
        }
        return $currentPointAmount;
    }
}
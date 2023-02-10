<?php

namespace Piltec\RewardPoints\Block\Adminhtml\Customer\Edit\Tab;

use Magento\Backend\Block\Template\Context;
use Magento\Customer\Model\Customer;
use Magento\Backend\Block\Template;
use Magento\Ui\Component\Layout\Tabs\TabInterface;
use Magento\Customer\Model\ResourceModel\Customer\CollectionFactory as CustomerFactory;

class Reward extends Template implements TabInterface
{
    /**
     * @var CustomerFactory
     */
    protected $customerFactory;

    /**
     * @var Customer
     */
    protected $customer;

    /**
     * @var string
     */
    protected $_template = 'tab/reward_points.phtml';

    /**
     * @param Context $context
     * @param CustomerFactory $customerFactory
     * @param array $data
     */
    public function __construct(
        Context $context,
        Customer $customer,
        CustomerFactory $customerFactory,
        array $data = []
    ) {
        $this->customerFactory = $customerFactory;
        $this->customer = $customer;
        parent::__construct($context, $data);
    }

    /**
     * Get current point amount for user by id
     *
     * @return int
     */
    public function getCurrentPointAmount(): int
    {
        $customerCollection = $this->customerFactory->create()
            ->addFieldToFilter('entity_id', $this->getCustomerId());
        $currentPointAmount = $customerCollection->getData();
        return $currentPointAmount[0]['reward_points_amount'];
    }

    /**
     * @return int
     */
    public function getCustomerId(): int
    {
        return $this->getRequest()->getParam('id');
    }

    /**
     * @return \Magento\Framework\Phrase
     */
    public function getTabLabel()
    {
        return __('Reward Points');
    }

    /**
     * @return \Magento\Framework\Phrase
     */
    public function getTabTitle()
    {
        return __('Reward Points');
    }

    /**
     * @return bool
     */
    public function canShowTab()
    {
        if ($this->getCustomerId()) {
            return true;
        }
        return false;
    }

    /**
     * @return bool
     */
    public function isHidden()
    {
        if ($this->getCustomerId()) {
            return false;
        }
        return true;
    }

    /**
     * Tab class getter
     *
     * @return string
     */
    public function getTabClass()
    {
        return '';
    }

    /**
     * Return URL link to Tab content
     *
     * @return string
     */
    public function getTabUrl()
    {
        return '';
    }

    /**
     * Tab should be loaded trough Ajax call
     *
     * @return bool
     */
    public function isAjaxLoaded()
    {
        return false;
    }
}
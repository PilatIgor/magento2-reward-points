<?php

namespace Piltec\RewardPoints\Block\Adminhtml\Customer\Edit\Tab;

use Magento\Backend\Block\Template\Context;
use Magento\Checkout\Exception;
use Magento\Framework\Registry;
use Magento\Customer\Model\Customer;

class Reward extends \Magento\Backend\Block\Template implements \Magento\Ui\Component\Layout\Tabs\TabInterface
{
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
     * @param Registry $registry
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        Customer $customer,
        array $data = []
    ) {
        $this->customer = $customer;
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }

    /**
     * Get current point amount for user by id
     *
     * @return int
     */
    public function getCurrentPointAmount(): int
    {
        return $this->customer->load($this->getCustomerId())->getData('reward_points_amount');
    }

    /**
     * @return string|null
     */
    public function getCustomerId()
    {
        return $this->_coreRegistry->registry(\Magento\Customer\Controller\RegistryConstants::CURRENT_CUSTOMER_ID);
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
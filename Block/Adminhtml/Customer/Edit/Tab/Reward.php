<?php

namespace Piltec\RewardPoints\Block\Adminhtml\Customer\Edit\Tab;

use Exception;
use Magento\Backend\Block\Template\Context;
use Magento\Customer\Model\Customer;
use Magento\Backend\Block\Template;
use Magento\Ui\Component\Layout\Tabs\TabInterface;
use Piltec\RewardPoints\Model\RewardPoints\PointAmount;

class Reward extends Template implements TabInterface
{
    /**
     * @var PointAmount
     */
    protected $pointAmount;

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
     * @param PointAmount $pointAmount
     * @param array $data
     */
    public function __construct(
        Context $context,
        Customer $customer,
        PointAmount $pointAmount,
        array $data = []
    ) {
        $this->pointAmount = $pointAmount;
        $this->customer = $customer;
        parent::__construct($context, $data);
    }


    /**
     * @return int
     * @throws Exception
     */
    public function getCurrentPointAmount(): int
    {
        return $this->pointAmount->getCurrentPointAmount($this->getCustomerId());
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
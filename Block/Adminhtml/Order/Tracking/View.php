<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace snapcx\shippingtracking\Block\Adminhtml\Order\Tracking;

//use Magento\Shipping\Block\Adminhtml\Order\Tracking\View;

/**
 * Shipment tracking control form
 *
 */
class View extends \snapcx\shippingtracking\Block\Adminhtml\Order\Tracking
{
    /**
     * @var \Magento\Shipping\Model\CarrierFactory
     */
   

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Shipping\Model\Config $shippingConfig
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Shipping\Model\CarrierFactory $carrierFactory
     * @param array $data
     */
/*    public function __construct(
        \Magento\Shipping\Model\CarrierFactory $carrierFactory,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Shipping\Model\Config $shippingConfig,
        \Magento\Framework\Registry $registry,
        array $data = []
    ) {
        
        parent::__construct($carrierFactory, $scopeConfig, $context, $shippingConfig, $registry, $data);
    }
*/
    /**
     * Prepares layout of block
     *
     * @return void
     */
    protected function _prepareLayout()
    {
        $onclick = "submitAndReloadArea($('shipment_tracking_info').parentNode, '" . $this->getSubmitUrl() . "')";
        $this->addChild(
            'save_button',
            'Magento\Backend\Block\Widget\Button',
            ['label' => __('Add'), 'class' => 'save', 'onclick' => $onclick]
        );
    }

    /**
     * Retrieve save url
     *
     * @return string
     */
    public function getSubmitUrl()
    {
        return $this->getUrl('adminhtml/*/addTrack/', ['shipment_id' => $this->getShipment()->getId()]);
    }

    /**
     * Retrieve save button html
     *
     * @return string
     */
    public function getSaveButtonHtml()
    {
        return $this->getChildHtml('save_button');
    }

    /**
     * Retrieve remove url
     *
     * @param \Magento\Sales\Model\Order\Shipment\Track $track
     * @return string
     */
    public function getRemoveUrl($track)
    {
        return $this->getUrl(
            'adminhtml/*/removeTrack/',
            ['shipment_id' => $this->getShipment()->getId(), 'track_id' => $track->getId()]
        );
    }

    /**
     * @param string $code
     * @return \Magento\Framework\Phrase|string|bool
     */
    public function getCarrierTitle($code)
    {
        $carrier = $this->_carrierFactory->create($code);
        if ($carrier) {
            return $carrier->getConfigData('title');
        } else {
            return __('Custom Value');
        }
        return false;
    }
    
    public function getDefaultCarrier()
    {
        
        return  $this->scopeConfig->getValue(
            'shippingtracking/shippingtracking_settings/default_carrier',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
}

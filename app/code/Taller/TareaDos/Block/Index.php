<?php
namespace Taller\TareaDos\Block;
class Index extends \Magento\Framework\View\Element\Template
{
	protected $_postFactory;
	public function __construct(
		\Magento\Framework\View\Element\Template\Context $context
	)
	{
		parent::__construct($context);
	}
	public function getBoolean(){
		return false;
	}
}
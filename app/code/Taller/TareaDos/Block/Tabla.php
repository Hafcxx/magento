<?php
namespace Taller\TareaDos\Block;
use Taller\TareaDos\Model\TarjetaFactory;

class Tabla extends \Magento\Framework\View\Element\Template
{
    protected $tarjetaFactory;
        
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,        
        TarjetaFactory $tarjetaFactory,       
        array $data = []
    )
    {    
        $this->tarjetaFactory = $tarjetaFactory;
        parent::__construct($context, $data);
    }
    
    public function getTarjetasCollection()
    {
        $tarjetaModel = $this->tarjetaFactory->create();
        $collection = $tarjetaModel->getCollection();
        return $collection;
    }
}
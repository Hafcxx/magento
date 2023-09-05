<?php
namespace Taller\TareaUno\Block;
use Taller\TareaUno\Model\ContactoFactory;

class Index extends \Magento\Framework\View\Element\Template
{
    protected $contactoFactory;
        
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,        
        ContactoFactory $contactoFactory,       
        array $data = []
    )
    {    
        $this->contactoFactory = $contactoFactory;
        parent::__construct($context, $data);
    }
    
    public function getContactosCollection()
    {
        $contactoModel = $this->contactoFactory->create();
        $collection = $contactoModel->getCollection();
        return $collection;
    }
}
<?php
namespace Taller\TareaUno\Block\Adminhtml\Edit;

/**
 * Adminhtml blog post edit form
 */
class Form extends \Magento\Backend\Block\Widget\Form\Generic
{

    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig
     * @param \Magento\Store\Model\System\Store $systemStore
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Store\Model\System\Store $systemStore,
        array $data = []
    ) {
        $this->_systemStore = $systemStore;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Init form
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('contacto_form');
    }

    /**
     * Prepare form
     *
     * @return $this
     */
    protected function _prepareForm()
    {

        $form = $this->_formFactory->create(
            ['data' => ['id' => 'edit_form', 'action' => $this->getData('action'), 'method' => 'post']]
        );

        $form->setHtmlIdPrefix('post_');

        $fieldset = $form->addFieldset(
            'base_fieldset',
            ['legend' => __('Datos del Contacto'), 'class' => 'fieldset-wide']
        );

        $fieldset->addField(
            'nombre_completo',
            'text',
            [
             'name' => 'nombre_completo',
             'label' => __('Nombre Completo'),
             'nombre_completo' => __('Nombre Completo'),
             'required' => true
             ]
        );

        $fieldset->addField(
            'correo',
            'text',
            [
            'name' => 'correo',
            'label' => __('Correo'),
            'correo' => __('Correo'),
            'required' => true,
            'class' => 'validate-email'
            ]
        );

        $fieldset->addField(
            'telefono',
            'text',
            [
            'name' => 'telefono',
            'label' => __('Teléfono'),
            'telefono' => __('Teléfono'),
            'required' => true,
            'class' => 'validate-phone'
            ]
        );
    
        $fieldset->addField(
            'funcion',
            'text',
            [
            'name' => 'funcion',
            'label' => __('Función'),
            'funcion' => __('Función'),
            'required' => true
            ]
        );

        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
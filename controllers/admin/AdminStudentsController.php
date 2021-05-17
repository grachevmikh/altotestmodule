<?php
include_once(_PS_MODULE_DIR_ . 'students/classes/StudentsModel.php');

class AdminStudentsController extends ModuleAdminController
{

    public $StudentsModel;

    public function __construct()
    {
        $this->table            = 'students';
        $this->className      = 'StudentsModel';
        $this->module         = 'students';
        $this->lang = true;
        $this->context        = Context::getContext();
        $this->db             = Db::getInstance();
        $this->bootstrap = true;
        parent::__construct();
        $this->fields_list = [
            'id_students' => [
                'title' => '№',
                'width' => 50,
                'type' => 'text',
                'orderby' => true,
                'filter' => true,
                'search' => true
            ],
            'date' => [
                'title' => $this->l('Дата рождения'),
                'width' => 50,
                'type' => 'text',
                'lang' => true,
                'orderby' => true,
                'filter' => false,
                'search' => false
            ],
            'name' => [
                'title' => $this->l('Имя'),
                'width' => 440,
                'type' => 'text',
                'lang' => true,
                'orderby' => true,
                'filter' => true,
                'search' => true
            ],
            'status' => [
                'title' => $this->l('Статус'),
                'width' => '70',
                'align' => 'center',
                'active' => 'status',
                'type' => 'bool',
                'orderby' => true,
                'filter' => true,
                'search' => true
            ],
            'average_score' => [
                'title' => $this->l('Средний балл'),
                'width' => '70',
                'align' => 'center',
                'type' => 'text',
                'orderby' => true,
                'filter' => true,
                'search' => true
            ]
        ];
    }

    public function renderList()
    {
        $this->addRowAction('edit');
        $this->addRowAction('delete');
        return parent::renderList();
    }


    public function renderForm()
    {
        $this->fields_form = array(
            'legend' => array(
                'title' => $this->l('Студент'),
            ),
            'input' => array(
                array(
                    'type' => 'text',
                    'label' => $this->l('Имя'),
                    'name' => 'name',
                    'required' => true,
                    'lang' => true,
                ),
                array(
                    'type' => 'datetime',
                    'label' => $this->l('Дата рождения'),
                    'name' => 'date',
                    'required' => true,
                ),
                array(
                    'type' => 'radio',
                    'label' => $this->l('Статус'),
                    'name' => 'status',
                    'required' => false,
                    'class' => 't',
                    'is_bool' => true,
                    'values' => array(
                        array(
                            'id' => 'active',
                            'value' => 1,
                            'label' => $this->l('Учится')
                        ),
                        array(
                            'id' => 'active',
                            'value' => 0,
                            'label' => $this->l('Отчислен')
                        )
                    ),
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Средний балл'),
                    'name' => 'average_score',
                    'required' => true,
                )
            ),
            'submit' => array(
                'title' => $this->l('Save'),
                'name'	=> Tools::getValue('id_students') ? 'submitUpdate' : 'submitAdd'
            )
        );

        return parent::renderForm();

    }

    public function postProcess()
    {
        parent::postProcess();
    }
}

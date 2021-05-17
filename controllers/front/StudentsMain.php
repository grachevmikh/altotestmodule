<?php
include_once(_PS_MODULE_DIR_ . 'students/classes/StudentsModel.php');

class StudentsStudentsMainModuleFrontController extends ModuleFrontController
{

    public function initContent()
    {
        parent::initContent();

        $this->context->smarty->assign([
            'students' => StudentsModel::getAllStudents($this->context->language->id),
        ]);

        $this->setTemplate('module:students/views/templates/front/students.tpl');
    }
}

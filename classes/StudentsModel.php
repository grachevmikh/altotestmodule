<?php

class StudentsModel extends ObjectModel
{

    public $id;
    public $name;
    public $date;
    public $status;
    public $average_score;

    public static $definition = [
        'table' => 'students',
        'primary' => 'id_students',
        'multilang' => true,
        'fields' => [
            'name' => ['type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isGenericName'],
            'date' => ['type' => self::TYPE_DATE, 'validate' => 'isDate'],
            'status' => ['type' => self::TYPE_INT],
            'average_score' => ['type' => self::TYPE_FLOAT],
        ],
    ];

    public static function getAllStudents()
    {
        $idLang = (int)Context::getContext()->language->id;
        $sql = new DbQuery();
        $sql->select('s.id_students AS id, sl.name AS name, s.date AS date, s.status AS status, s.average_score AS average_score')
            ->from('students', 's')
            ->leftJoin('students_lang', 'sl', 's.id_students = sl.id_students')
            ->where('sl.id_lang = '.$idLang);
        return Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);
    }

    public static function getStudent($id)
    {
        $id = (int)$id;
        $sql = new DbQuery();
        $sql->select('s.id_students AS id, sl.name AS name, s.date AS date, s.status AS status, s.average_score AS average_score')
            ->from('students', 's')
            ->leftJoin('students_lang', 'sl', 's.id_students = sl.id_students')
            ->where('s.id_students = '.$id);
        return Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($sql);
    }

    public static function getBestStudent()
    {
        $idLang = (int)Context::getContext()->language->id;
        $sql = new DbQuery();
        $sql->select('name')
            ->from('students', 's')
            ->leftJoin('students_lang', 'sl', 's.id_students = sl.id_students')
            ->where('sl.id_lang = '.$idLang.' AND s.average_score = (SELECT MAX(average_score) from ' . _DB_PREFIX_ . 'students)');
        return Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($sql);
    }

    public static function getTopScore()
    {
        $sql = new DbQuery();
        $sql->select('average_score')->from('students')->where('average_score = (SELECT MAX(average_score) from ' . _DB_PREFIX_ . 'students)');
        return Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($sql);
    }


}

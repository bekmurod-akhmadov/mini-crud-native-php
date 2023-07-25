<?php
namespace db;

use db\Config;

class Student
{
    const LIMIT = 3;
    public $db;
    public function __construct(){
        $db = new Config();
        $this->db = $db->db;
    }

    function getSortList($tablename , $page, $withoutLimit = false , $sort = 'asc' ,$column_name = 'id'){

        if ($sort == 'asc'){

            $offset = ($page - 1) * LIMIT;
            if ($withoutLimit) {

                $sql = "select * from $tablename order by $column_name asc";
                $state = $this->db->prepare($sql);

            } else {

                $sql = "select * from $tablename order by $column_name asc limit :offset, :limit ";
                $state = $this->db->prepare($sql);
                $state->bindValue(":limit", LIMIT, PDO::PARAM_INT);
                $state->bindValue(":offset", $offset, PDO::PARAM_INT);
            }
            try {

                $state->execute();
                return $state->fetchAll(PDO::FETCH_ASSOC);

            }catch (PDOException $i){
                debug($i->getMessage());
                debug($i->getLine());
                debug($i->getFile());
            }

        }else if($sort == 'desc'){

            $offset = ($page - 1) * LIMIT;
            if ($withoutLimit) {

                $sql = "select * from $tablename order by $column_name desc";
                $state = $this->db->prepare($sql);

            } else {

                $sql = "select * from $tablename order by $column_name desc limit :offset, :limit ";
                $state = $this->db->prepare($sql);
                $state->bindValue(":limit", LIMIT, PDO::PARAM_INT);
                $state->bindValue(":offset", $offset, PDO::PARAM_INT);
            }
            try {
                $state->execute();
                return $state->fetchAll(PDO::FETCH_ASSOC);
            }catch (PDOException $i){
                debug($i->getMessage());
            }

        }
    }

    public function getPagination($tableName){

        $sql = "select * from " . $tableName;
        $state = $this->db->prepare($sql);
        $state->execute();
        $total_rows = $state->rowCount();
        return ceil($total_rows / LIMIT);
    }



}
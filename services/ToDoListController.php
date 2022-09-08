<?php
require_once dirname(__FILE__) . '/DBContext.php';

use App\Util\DBContext;

class ToDoListController
{

    //guardar uan tarea en la lista
    public function save($postdata)
    {
        try {
            DBContext::initialize();
            DBContext::generateSchema();
            $qry = DBContext::getInstance()->prepare(
                'INSERT INTO todolist (name,status) VALUES (?,?)'
            );
            $qry -> execute([
                $postdata->name,
                "active"
            ]);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        return "OK";
    }

    //finalizar una tarea con su ID
    public function finiishTask($postdata)
    {
        try {
            DBContext::initialize();
            DBContext::generateSchema();
            $qry = DBContext::getInstance()->prepare(
                "UPDATE todolist SET status='done' WHERE id=$postdata->id"
            );
            $qry->execute();
            $result = $qry->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        return "OK";
    }

    //obtener la lista de tareas finalizadas
    public function getFinalizedList(){
        try {
            DBContext::initialize();
            DBContext::generateSchema();
            $qry = DBContext::getInstance()->prepare(
                "SELECT * FROM todolist WHERE status = 'done'"
            );
            $qry->execute();
            $result= $qry->fetchAll(PDO::FETCH_OBJ);
        }catch (PDOException $e){
            die($e->getMessage());
        }
        return json_encode($result);
    }

    public function getActiveList(){
        try {
            DBContext::initialize();
            DBContext::generateSchema();
            $qry = DBContext::getInstance()->prepare(
                "SELECT * FROM todolist WHERE status = 'active'"
            );
            $qry->execute();
            $result= $qry->fetchAll(PDO::FETCH_OBJ);
        }catch (PDOException $e){
            die($e->getMessage());
        }
        return json_encode($result);
    }

    public function getAll(){
        try {
            DBContext::initialize();
            DBContext::generateSchema();
            $qry = DBContext::getInstance()->prepare(
                "SELECT * FROM todolist"
            );
            $qry->execute();
            $result= $qry->fetchAll(PDO::FETCH_OBJ);
        }catch (PDOException $e){
            die($e->getMessage());
        }
        return json_encode($result);
    }
}
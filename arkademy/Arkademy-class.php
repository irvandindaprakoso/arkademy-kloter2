<?php

class Arkademy{
    private $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }
    public function view (){
        $result  = $this->pdo->query("SELECT n.id, n.name, w.name as work, c.salary FROM name n, work w, category c WHERE n.id_work=w.id AND n.id_salary=c.id");
            while($rows = $result->fetch(PDO::FETCH_OBJ))
                $data[] = $rows;
            return $data;
    }
    public function selectWork (){
        $result  = $this->pdo->query("SELECT * FROM work");
            while($rows = $result->fetch(PDO::FETCH_OBJ))
                $data[] = $rows;
            return $data;
    }
    public function selectCategory (){
        $result  = $this->pdo->query("SELECT * FROM category");
            while($rows = $result->fetch(PDO::FETCH_OBJ))
                $data[] = $rows;
            return $data;
    }
    public function add($name, $work, $salary) {
        $result = $this->pdo->prepare("INSERT INTO name (
            name,
            id_work,
            id_salary)
            VALUES(
            :name,
            :id_work,
            :id_salary)");        
        $result->bindParam(':name',$name);
        $result->bindParam(':id_work',$work);
        $result->bindParam(':id_salary',$salary);
        $result->execute();
    }
    public function edit ($id){
        $result = $this->pdo->query("SELECT * FROM name WHERE id='$id'");
        $rows = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
    public function delete($id) {
        $result = $this->pdo->prepare("DELETE FROM name WHERE id = ?");
        $result->bindParam(1, $id);
        $result->execute();
    }
    public function update($name, $work, $salary, $id) {
        $result = $this->pdo->prepare("UPDATE name SET  
            name      =:name, 
            id_work   =:id_work,
            id_salary =:id_salary
            WHERE id  =:id"); 
        $result->bindParam(':name', $name);
        $result->bindParam(':id_work', $work);
        $result->bindParam(':id_salary', $salary);
        $result->bindParam(':id', $id);
        
        if($result->execute()){
            return true;
        } else {return false;}
    }
    
}
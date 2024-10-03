<?php 
class Pelanggan {
    private $conn;
    private $table_name = "pelanggan";

    public $id;
    public $name;
    public $email;
    public $phone;


    public function __construct($db){
        $this->conn = $db;
    }

    public function create(){
        $stmt = $this->conn->prepare("INSERT INTO ". $this->table_name ." (name, email, phone) VALUES (:name, :email, :phone)");

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":phone", $this->phone);
        
        if ($stmt->execute()) {
            return true;
        }

        return false;

    }

    public function read(){
        // $query = "SELECT * FROM ". $this->table_name;
        $stmt = $this->conn->prepare("SELECT id, name, email, phone FROM ". $this->table_name);
        $stmt->execute();

        return $stmt;
    }

    public function show($id){
        $stmt = $this->conn->prepare("SELECT id, name, email, phone FROM ". $this->table_name ." WHERE id=:id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        return $stmt;
    }

    public function update(){
        $stmt = $this->conn->prepare("UPDATE ". $this->table_name ." SET name=:name, email=:email, phone=:phone WHERE id=:id");

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":phone", $this->phone);
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function delete(){
        $stmt = $this->conn->prepare("DELETE FROM ". $this->table_name ." WHERE id=:id");
        $stmt->bindParam(":id", $this->id);
        if ($stmt->execute()) {
            return true;
        }   

        return false;
    }
}

?>
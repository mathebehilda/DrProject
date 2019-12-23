<?php
/**
 * Description of database
 *
 * @author Thabiso Mokone
 */
class database {

    public $connection;
    public $db_connection;
    
    //Contructor sets and select a database
    function __construct($server,$db_name) {
        
        $this->connection = mysqli_connect($server, "root");
        $this->db_connection = mysqli_select_db($this->connection, $db_name);
    }

    function select_from_db($table,$fields,$condition){
        #construct the sql statement
        $sql = "SELECT $fields FROM $table";
        
        if(!empty($condition))
            $sql .= " WHERE $condition";
        
        $rs = mysqli_query($this->connection, $sql);
        
        if(@mysqli_num_rows($rs) > 0)
        {
            while($row = mysqli_fetch_assoc($rs)){
                $data[] = $row; 
            }
        }
        else
            return false;
        
        return $data;
    }
    function delete_from_db($table,$condition){
        #construct the sql statement
        $sql = "DELETE FROM $table";
        
        if(!empty($condition))
            $sql .= " WHERE $condition";
        
        $rs = mysqli_query($this->connection, $sql);
        
        if(mysqli_affected_rows() > 0)
            return mysqli_affected_rows();
        
        return false;
    }
    function update_from_db($table,$field_value,$condition){
        #construct the sql statement
        $sql = "UPDATE $table SET ";
        
        $count = 1;
        foreach($field_value as $field=>$value){
            
            if($count == count($field_value))
                $sql .= "'$field' = '$value'";
            else 
                $sql .= "'$field' = '$value', "; 
            
            $count++;
            
        }
        
        if(!empty($condition))
            $sql .= " WHERE $condition";
        
        $rs = mysqli_query($this->connection, $sql);
        
        if(mysqli_num_affected() > 0)
            return mysqli_num_affected();
        
        return false;
    }
    function insert_into_db($table,$fields,$values){
        #construct the sql statement
        $sql = "INSERT INTO $table(";
        
        $count = 1;
        foreach($fields as $field){
            
            if($count == count($fields))
                $sql .= "$field) VALUES(";
            else 
                $sql .= "$field, "; 
            
            $count++;            
        }
        $count = 1;
        foreach($values as $value){
            
            if($count == count($values))
                $sql .= "'$value')";
            else 
                $sql .= "'$value', "; 
            
            $count++;            
        }
        
        $rs = mysqli_query($this->connection, $sql);
        
        if($rs)
            return true;
        
        return false;
    }
    
    
}

?>

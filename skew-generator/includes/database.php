<?php

class Database {

    public $connection;

    function __construct(){

        $this->open_db_connection();

    }

    public function open_db_connection(){

        // $this->connection = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
        $this->connection = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);

        if($this->connection->connect_errno){

            die("Database connection failed: " . $this->connection->connect_error);

        }

    }

    public function query($sql){

        $result = $this->connection->query($sql);
        $this->confirm_query($result);
        return $result;

    }

    private function confirm_query($result){
        if(!$result)
        {
            echo("Query Failed: " . $this->connection->error);
            return false;
        }
    }

    public function escape_string($string){

        $escaped_string = $this->connection->real_escape_string($string);
        return $escaped_string;
    }

    public function the_insert_id(){

        return $this->connection->insert_id;

    }

//    public function insert_query($table, $columns, $values)
//    {
//        if(isset($columns) && isset($values)){
//
//            if(is_array($columns)) {
//                $columns = implode(',', $columns);
//            }
//            if(is_array($values)) {
//                foreach($values as $key => $value){
//                    $values[$key] = "'" . $value . "'";
//                }
//                $values = implode(',', $values);
//            }
//            else{
//                $values = "'" . $values . "'";
//            }
//
//            $sql = "INSERT INTO {$table} ({$columns}) VALUES ({$values})";
//            echo $sql . '<br>';
//
//            $this->query($sql);
//
//        }
//    }

    public function insert_query($table_name, $form_data)
    {
        // retrieve the keys of the array (column titles)
        $fields = array_keys($form_data);

        // build the query
        $sql = "INSERT INTO ".$table_name."
          (`".implode('`,`', $fields)."`)
          VALUES('".implode("','", $form_data)."')";

        // run the query result resource
        echo $sql . '<br>';
        $this->query($sql);
        return mysqli_insert_id($this->connection);
    }


    // again where clause is left optional
    public function update_query($table_name, $form_data, $where_clause='')
    {
        // check for optional where clause
        $whereSQL = '';
        if(!empty($where_clause))
        {
            // check to see if the 'where' keyword exists
            if(substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE')
            {
                // not found, add key word
                $whereSQL = " WHERE ".$where_clause;
            } else
            {
                $whereSQL = " ".trim($where_clause);
            }
        }
        // start the actual SQL statement
        $sql = "UPDATE ".$table_name." SET ";

        // loop and build the column /
        $sets = array();
        foreach($form_data as $column => $value)
        {
            $sets[] = "`".$column."` = '".$value."'";
        }
        $sql .= implode(', ', $sets);

        // append the where statement
        $sql .= $whereSQL;

        // run and return the query result
        echo $sql . '<br>';
        $this->query($sql);
    }

    public function update_add_query($table_name, $form_data, $where_clause=''){
        // check for optional where clause
        $whereSQL = '';
        if(!empty($where_clause))
        {
            // check to see if the 'where' keyword exists
            if(substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE')
            {
                // not found, add key word
                $whereSQL = " WHERE ".$where_clause;
            } else
            {
                $whereSQL = " ".trim($where_clause);
            }
        }
        // start the actual SQL statement
        $sql = "UPDATE ".$table_name." SET ";

        // loop and build the column /
        $sets = array();
        foreach($form_data as $column => $value)
        {
            $sets[] = "`".$column."` = concat(".$column.", ',".$value."')";
        }
        $sql .= implode(', ', $sets);

        // append the where statement
        $sql .= $whereSQL;

        // run and return the query result
        echo $sql . '<br>';
        $this->query($sql);
    }

}

$db = new Database();

?>
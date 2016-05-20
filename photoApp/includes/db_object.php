<?php

    class Db_object{

        public static function find_all(){

            return static::find_by_query("SELECT * FROM " . static::$db_table . " ");

        }

        public static function find_by_id($id){

            $the_result_array = static::find_by_query("SELECT * FROM " . static::$db_table . " WHERE id = $id LIMIT 1");
            return !empty($the_result_array) ? array_shift($the_result_array) : false;

        }

        public static function find_by_query($sql){
            global $db;
            $result_set = $db->query($sql);
            $the_object_array = array();
            while($row = mysqli_fetch_array($result_set)){
                $the_object_array[] = static::init($row);
            }
            return $the_object_array;
        }

        public static function init($the_record){

            $calling_class = get_called_class();

            $the_object = new $calling_class;

//            $the_object->id             = $found_user['id'];
//            $the_object->username       = $found_user['username'];
//            $the_object->password       = $found_user['password'];
//            $the_object->first_name     = $found_user['first_name'];
//            $the_object->last_name      = $found_user['last_name'];

            foreach($the_record as $the_attribute => $value){
                if($the_object->has_the_attribute($the_attribute)){
                    $the_object->$the_attribute = $value;
                }
            }

            return $the_object;

        }

        protected function properties(){

            $properties = array();

            foreach(static::$db_table_fields as $db_field){

                if(property_exists($this, $db_field)){

                    $properties[$db_field] = $this->$db_field;

                }

            }

            return $properties;

        }

        protected function clean_properties(){
            global $db;

            $clean_properties = array();

            foreach($this->properties() as $key => $value){

                $clean_properties[$key] = $db->escape_string($value);

            }

            return $clean_properties;

        }

        public function save(){

            return isset($this->id) ? $this->update() : $this->create();

        }

        public function create(){
            global $db;

            $properties = $this->clean_properties();

            $sql = "INSERT INTO " . static::$db_table . " (" . implode(",", array_keys($properties)) . ")";
            $sql .= " VALUES ('";
            $sql .= implode("','", array_values($properties)) . "')";


            if($db->query($sql)){

                $this->id = $db->the_insert_id();

                return true;
            }else {
                return false;
            };

        }

        public function update(){
            global $db;

            $properties = $this->clean_properties();

            $properties_pairs = array();

            foreach($properties as $key => $val){

                $properties_pairs[] = "{$key}='{$val}'";

            }

            $sql = "UPDATE " . static::$db_table . " SET ";
            $sql .= implode(", ", $properties_pairs);
            $sql .= " WHERE id= " . $db->escape_string($this->id);

            $db->query($sql);

            return (mysqli_affected_rows($db->connection) == 1) ? true : false;

        }

        public function delete(){
            global $db;

            $sql = "DELETE FROM " . static::$db_table;
            $sql .= "WHERE id=" . $db->escape_string($this->id);
            $sql .= " LIMIT 1";

            $db->query($sql);

            return (mysqli_affected_rows($db->connection) == 1) ? true : false;
        }

        public function has_the_attribute($the_attribute){

            $object_properties = get_object_vars($this);
            return array_key_exists($the_attribute, $object_properties);

        }

    }


?>
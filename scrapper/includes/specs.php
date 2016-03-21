<?php

    class Specs {

        public function assign_specs($specs){

            foreach($specs as $key => $value)
            {
                $this->$key = $value;
            }

        }


    }



?>
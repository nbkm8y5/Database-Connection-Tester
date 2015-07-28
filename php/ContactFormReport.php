<?php

/**
 * Contact Form Report Class
 * For querying a report of all comments received from a basic contact form
 * @author Rolando Moreno <developer@rolandomoreno.com>
 * @copyright (c) 2015, rolandomoreno.com
 * @version 1.0
 */
class ContactFormReport {

    private $conn = null;
    private $sql = "CALL TOP_TEN";
    private $result = '';

    public function setConn($conn) {
        $this->conn = $conn;
    }

    /**
     * This queries the database to select all records from contact form table
     */
    public function query() {
        $this->result = mysqli_query($this->conn, $this->sql); //How is this implemented in mysqli
    }

    /**
     * 
     */
    public function getReport() {
        for ($i = 0; $i < mysqli_num_rows($this->result); $i++) {
            $row = mysqli_fetch_assoc($this->result);
            foreach ($row as $x => $x_value) {
                echo $x . " = " . $x_value;
                echo "<br>";
            }
            echo "<br>";
        }
    }

}

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//namespace usedbooks;
//use mysqli;

/**
 * This class establishes connection to database and does error handling
 * @author tacdu
 */
class Database {
    //Define variables
   
    var $host = '';
    var $user = '';
    var $pw = '';
    var $db = '';
    
    var $conn;
    
    //Constructor
    function Database($host,$user,$pw,$db){
        $this->host = $host;
        $this->user = $user;
        $this->pw = $pw;
        $this->db = $db;
    }
    
    //Establish connection
    function connect(){
        $this->conn = new mysqli($this->host,$this->user,$this->pw,$this->db);
        
        if ($this->conn->connect_error){
            die('Connection failed: '.$this->conn->connect_error);
        }
        else{
            return $this->conn;
        }
    }
} //End class definition

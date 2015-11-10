<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of database_handler
 * Class providing generic data access functionality
 * @author Huy
 */
class DatabaseHandler {
    // Hold an instance of the PDO class
    private static $_mHandler;
    
    // Private constructor to prevent direct creation of object
    private function __construct() {
        
    }
    
    // Return an initialized database 
    private static function GetHandler()
    {
        // Create a database connection only if one doesn't already exist
        if (!isset(self::$_mHandler))
        {
            try{
            // Create a new PDO class instance
                self::$_mHandler = 
                        new PDO(PDO_DSN, DB_USERNAME, DB_PASSWORD, 
                                array(PDO::ATTR_PERSISTENT => DB_PERSISTENCY));
                // Configure PDO to throw exception
                self::$_mHandler->setAttribute(PDO::ATTR_ERRMODE,
                                                PDO::ERRMODE_EXCEPTION);
            }
            catch(PDOException $e)
            {
                // Close the database handler and trigger an error
                self::Close();
                trigger_error($e->getMessage(),E_USER_ERROR);
            }    
        }
        // Return the database handler;
        return self::$_mHandler;
    }
    
    // Clear the PDO class instance 
    public static function Close()
    {
        self::$_mHandler = null;
    }
    
    // Wrapper method for PDOStatement::execute() for INSERT DELETE UPDATE
    public static function Execute($sqlQuery, $params = null)
    {
        // Try to execute an SQL query or a stored procedure
        try{
            // Get the database handler
            $database_handler = self::GetHandler();
            
            // Prepare the query for execution
            $statement_handler = $database_handler->prepare($sqlQuery);
            
            //Execute query
            $statement_handler->execute($params);
            
        } 
        // Trigger an error if an exception was thrown when executing the SQL query
        catch (PDOException $ex) {
            // Close the database handler and trigger an error
            self::Close();
            trigger_error($ex->getMessage(),E_USER_ERROR);
        }
    }
    
    // Wrapper method for PDOStatement::fetchAll()
    // PDO::FETCH_ASSOC: returns an array indexed by column name as returned in your result set
    public static function GetAll($sqlQuery, $params = null,
                                    $fetchStyle = PDO::FETCH_ASSOC)
    {
        // Initialize the return value to null
        $result = null;
                
        // Try to execute an SQL query or a stored procedure        
        try
        {
            // Get the database handler
            $database_handler = self::GetHandler();
            
            //Prepare the query for execution
            $statement_handler = $database_handler->prepare($sqlQuery);
            
            //Execute query
            $statement_handler->execute($params);
            
            // Fetch result
            $result = $statement_handler->fetchAll($fetchStyle);
            
        } 
        // Trigger an error if an exception was thrown when executing the SQL query
        catch (Exception $ex) {
            // Close the database handler and trigger an error
            self::Close();
            trigger_error($ex->getMessage(),E_USER_ERROR);
        }
        
        // Return the query results
        return $result;
    }
    
    // Wrapper method for PDOStatement::fetch(). This will be used to get a row of data
    // resulted from a SELECT query
    public static function GetRow($sqlQuery, $params = null,
                                    $fetchStyle = PDO::FETCH_ASSOC)
    {
        // Initialize the return value to null
        $result = null;
                
        // Try to execute an SQL query or a stored procedure        
        try
        {
            // Get the database handler
            $database_handler = self::GetHandler();
            
            //Prepare the query for execution
            $statement_handler = $database_handler->prepare($sqlQuery);
            
            //Execute query
            $statement_handler->execute($params);
            
            // Fetch result
            $result = $statement_handler->fetch($fetchStyle);
            
        } 
        // Trigger an error if an exception was thrown when executing the SQL query
        catch (Exception $ex) {
            // Close the database handler and trigger an error
            self::Close();
            trigger_error($ex->getMessage(),E_USER_ERROR);
        }
        
        // Return the query results
        return $result;
    }
    
    // Return the first coumn value from a row (ex: array[0][0])
    public static function GetOne($sqlQuery, $params = null)
    {
        // Initialize the return value to null
        $result = null;
                
        // Try to execute an SQL query or a stored procedure        
        try
        {
            // Get the database handler
            $database_handler = self::GetHandler();
            
            //Prepare the query for execution
            $statement_handler = $database_handler->prepare($sqlQuery);
            
            //Execute query
            $statement_handler->execute($params);
            
            // Fetch result
            // PDO::FETCH_NUM: returns an array indexed by column number as returned in your result set, starting at column 0.
            $result = $statement_handler->fetch(PDO::FETCH_NUM);
            
            /* Save the first value of the result set (first column of the  first row) 
             * to $result */
            $result = $result[0];
        } 
        // Trigger an error if an exception was thrown when executing the SQL query
        catch (Exception $ex) {
            // Close the database handler and trigger an error
            self::Close();
            trigger_error($ex->getMessage(),E_USER_ERROR);
        }
        
        // Return the query results
        return $result;
    }
}

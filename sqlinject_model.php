<?php
#open our DB connection, returns the $conn object
require_once("connection.php");

#Security Check
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
     // Don't allow the GET method
     die("You cannot call this page directly, noob.");
}

class Customer{
    
    #cust_id is given to build from an exisiting customer otherwise creates a new one in the DB
    public function __construct($cust_id=null){

        if(gettype($cust_id)!="array"){ # build a customer object from database if id given
            $this->build_customer($cust_id);
        
        }else if(gettype($data)=="array"){ # Create a new customer if data array given instead
            $this->new_customer($data);
        }else{  # return error if no data passed 
            return "Error 001: no parameters given";
        }
        
    }
    
    private function build_customer($cust_id){
        #Select the customer info from the DB
        $result = $conn->query("SELECT * FROM Customers WHERE cust_id=$customer_id"); // allows SQL injection 
            
        #Set the data values to be object properties 
        $this->id       = $cust_id; 
        $this->name     = $result->cust_name;
        $this->address  = $result->cust_address;
        $this->city     = $result->cust_city;
        $this->state    = $result->cust_state;
        $this->zip      = $result->cust_zip;
        $this->country  = $result->cust_country;
        $this->contact  = $result->cust_contact;
        $this->email    = $result->cust_email;
        
    }
    
    private function new_customer($data){
        #extract the following values from the $data array: cust_name, cust_address, cust_city, cust_state, cust_zip, cust_country, cust_contact, cust_email
        extract($data);
        
        #this is NOT supposed to validate input for SQL injection
        $result = $conn->query("
            INSERT INTO Customers (cust_name, cust_address, cust_city, cust_state, cust_zip, cust_country, cust_contact, cust_email)
            VALUES ($cust_name, $cust_address, $cust_city, $cust_state, $cust_zip, $cust_country, $cust_contact, $cust_email)
        "); 
        
        #build the customer object with the primary key of the row we just entered
        $cust_returned_id = $conn->query("SELECT @@identity");
        build_customer($cust_returned_id);
    
        // @TODO add return values??
    }
    
    public function update_customer(){
        // @TODO implement updating to the properties, to actually be CRUD
    }
    
    public function delete_customer($cust_id){
        # delete the customer from the database, does not destroy the customer object.
        $result = $conn->query("DELETE FROM Customers WHERE cust_id=$custid");
        return $result;
    }
    
    
}



?>
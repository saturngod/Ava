<?php
/**
 * Database Class
 * @package Ava
 * @since version 1.0
 * @author saturngod
 * @category Library
 */
class Ava_db
{

    private $dbh;
    private $where;
    private $where_array;
    private $limit;
    private $select;
    private $order;
    private $join;
    private $distinct;
    private $groupby;
    private $having;
    private $row_count;
    
    public $err;
    public $sql;
    /**
     * Constructor. Can check the query error with if ($this->db->err) echo $this->db->err[2];
     */
    public function __construct()
    {
        $this->err=false;
        $this->where="";
        $this->where_array=array();
        try {
            //setup database
            $this->dbh = new PDO("mysql:host=".AvaConfig::db_host.";dbname=".AvaConfig::db_name, AvaConfig::db_user, AvaConfig::db_password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES ".AvaConfig::db_encode));
            
            $this->err=false;
        }
        catch(PDOException $e)
        {
            $this->err=$e->getMessage();
        }
    }

    private function clear_variable()
    {
        $this->where="";
        $this->limit="";
        $this->select="";
        $this->order="";
        $this->where_array=array();
        $this->join="";
        $this->distinct="";
        $this->groupby="";
        $this->having="";
    }

    private function generate_sql($debug_sql,$query_array)
    {

        if (sizeof($query_array) > 0) {
            foreach ($query_array as $key => $value) {
                $debug_sql = str_replace($key, $this->dbh->quote($value), $debug_sql);
            }
        }

        $this->sql=$debug_sql;
    }

    private function check_bracket()
    {
        $where = trim($this->where);
        if(substr($where, -1,1)=="(")
        {
            return true;
        }
        return false;
    }
    /**
     * normal query
     * @param  string $sql
     * @return array
     */
    public function query($sql,$query_array="")
    {
        $this->err=false;
        try
        {
            
            //fixed SQL Injection
            $result=$this->dbh->prepare($sql);
            //loop array for replace sql
            if(is_array($query_array)){
                $return=$result->execute($query_array);
                $this->generate_sql($sql,$query_array);
            }
            else {
                $return=$result->execute($this->where_array);
                $this->generate_sql($sql,$this->where_array);
            }

            

            //check error
            if(!$return) {
                $this->err=$result->errorInfo();
            }
            
            if(is_object($result))
            {
                $result->setFetchMode(PDO::FETCH_OBJ);
                $this->clear_variable();
                
                $return =$result->fetchAll();
                $this->row_count=count($return);
                return $return;
            }
            else
            {
                die("Sorry, Your Query have a problem");
            }

        }
        catch(PDOException $e)
        {
            $this->err=$e->getMessage();
        }
    }

    /**
     * Where like in sql
     * @access private
     * @param string  $field
     * @param $value
     * @param string $do
     * @return string
     */
    private function wherelike($field,$value,$do="both")
    {
        $field_value=$field.count($this->where_array);

        if($do=="both")
        {
            $like=$field." like :".$field_value;
            $this->where_array[":".$field_value]="%".$value."%";
        }
        else if($do=="before")
        {
            $like=$field." like :".$field_value;
            $this->where_array[":".$field_value]="%".$value;
        }
        else if($do=="after")
        {
            $like=$field." like :".$field_value;
            $this->where_array[":".$field_value]=$value."%";
        }
        return $like;
    }

    /**
     * where like in sql. Check current where and combie with new
     * @access public
     * @param  $field
     * @param  $value
     * @param string $do
     * @return void
     */
    public function where_like($field,$value,$do="both")
    {
        $like=$this->wherelike($field,$value,$do);

        if($this->where!="")
        {
            if($this->check_bracket())
            {
                $this->where=$this->where." ".$like;
            }
            else {
                $this->where=$this->where." AND ".$like;
            }
        }
        else
        {
            $this->where=$like;
        }
        return $this;
    }

    /**
     * where_or_like
     *
     * @param string $field 
     * @param string $value 
     * @param string $do 
     * @return void
     * @author Htain Lin Shwe
     */
    public function where_or_like($field,$value,$do="both")
    {

        $like=$this->wherelike($field,$value,$do);

        if($this->where!="")
        {
            $this->where=$this->where." OR ".$like;
        }
        else
        {
            $this->where=$like;
        }
        return $this;
    }

    
    /**
     * IS NULL or IS NOT NULL with AND
     *
     * @param string $field 
     * @param string $is_null 
     * @return void
     * @author saturngod
     */
    public function where_null($field,$is_null=true)
    {
        $is_txt=" IS NULL";
        if(!$is_null)
        {
            $is_txt = " IS NOT NULL";
        }
        if($this->where!="")
        {
            if($this->check_bracket())
            {
                $this->where = $this->where." ".$field." ".$is_txt;
            }
            else {
                $this->where = $this->where." AND ".$field." ".$is_txt;
            }
        }
        else {
            $this->where = $field." IS NULL";
        }
        return $this;
    }

    /**
     * IS NULL or IS NOT NULL with OR
     *
     * @param string $field 
     * @param string $is_null 
     * @return void
     * @author saturngod
     */
    public function where_or_null($field,$is_null=true)
    {
        $is_txt=" IS NULL";
        if(!$is)
        {
            $is_txt = " IS NOT NULL";
        }
        if($this->where!="")
        {
            $this->where = $this->where." OR ".$field." ".$is_txt;
        }
        else {
            $this->where = $field." IS NULL";
        }
        return $this;
    }

    private function get_operator($field) {
        
        $field=trim($field);
        $lastword=substr($field,-2);
        
        $operator="";

        $lastword=trim($lastword);

        if($lastword=="!=" || $lastword==">=" || $lastword=="<=") {
        
            $operator=$lastword;
        }
        else {
            $last_word=substr($field,-1);

            $lastword=trim($lastword);
            if($lastword=="=" || $lastword==">" || $lastword=="<") {
                $operator=$lastword;
            }
        }

        return $operator;
            
    }

    /**
     * where with and
     *
     * @param string $field 
     * @param string $value 
     * @return void
     * @author saturngod
     */
    public function where($field,$value)
    {

        $operator=$this->get_operator($field);



        $field=substr($field,0,strlen($field)-strlen($operator));
        $field=trim($field);
        if($operator=="") $operator="=";

        $field=trim($field);
        $field_value=$field.count($this->where_array);
        if($field!="")
        {
            $this->where_array[":".$field_value]=$value;
        }

        if($this->where!="")
        {
            if($this->check_bracket())
            {
                $this->where=$this->where." ".$field." ".$operator." :".$field_value;
            }
            else {
                $this->where=$this->where." AND ".$field." ".$operator." :".$field_value;
            }
        }
        else
        {
            $this->where=' '.$field." ".$operator." :".$field_value;
            
        }

        return $this;
    }

    /**
     * normal where with condition or
     *
     * @param string $field 
     * @param string $value 
     * @return this
     * @author saturngod
     */
    public function where_or($field,$value)
    {
        $operator=$this->get_operator($field);

        $field=substr($field,0,strlen($field)-strlen($operator));
        $field=trim($field);
        
        if($operator=="") $operator="=";

        if($field!="")
        {
            $field_value=$field.count($this->where_array);

            $this->where_array[":".$field_value]=$value;
        }
        
        if($this->where!="")
        {
            $this->where=$this->where." OR ".$field." ".$operator." :".$field_value;
         
        }
        else {
            $operator=$this->get_operator($field);
            if($operator=="") $operator="=";
            $this->where=' '.$field." ".$operator." :".$field_value;
        }
        return $this;
    }

    /**
     * Order function
     *
     * @param string $field
     * @param string $type  (ASC, DESC)
     * @return void
     * @author saturngod
     */
    public function order($orders)
    {
        $this->order="ORDER BY ";
        foreach($orders as $key=>$order )
        {
            $this->order.="`".$key."` ";
            $this->order.=$order;
            $this->order.=" , ";
        }
        $this->order=substr($this->order,0,-2);
        return $this;
    }
    
    /**
     * LIMIT in query
     *
     * @param string $total 
     * @param string $start 
     * @return $this
     */
     
    public function limit($total='',$start=0)
    {
        $this->limit="limit ".$start.",".$total;
        return $this;
    }

    /**
     * SELECT query
     *
     * @param string $select 
     * @return $this
     */
    public function select($select)
    {
        $this->select=$select;
        return $this;
    }
    
    public function distinct($select)
    {
        $this->distinct= "DISTINCT ($select)";
        return $this;
    }
    /**
     * get result from table
     *
     * @author saturngod
     * @param string $table
     * @return array $this->query($sql)
     */
    public function get($table)
    {

        if($this->select!="")
        {
            if($this->distinct!="")
            {
                $sql="SELECT ".$this->distinct.",".$this->select." FROM ".$table;
            }
            else {
                $sql="SELECT ".$this->select." FROM ".$table;
            }
        }
        else
        {
            if($this->distinct!="")
            {
                $sql="SELECT ".$this->distinct." FROM ".$table;   
            }
            else {
                $sql="SELECT * FROM ".$table;   
            }

        }

        $sql=$sql." ".$this->join;

        if($this->where!="")
        {
            $sql=$sql." WHERE ".$this->where;
        }

        $sql=$sql." ".$this->groupby. " ".$this->having;
        
        if($this->order!="")
        {
            $sql=$sql." ".$this->order;
        }
        if($this->limit!="")
        {
            $sql=$sql." ".$this->limit;
        }
        
        
        $this->err=false;
        return $this->query($sql);

    }

    /**
     * insert into database
     * @param  $data
     * @param  string $table
     * @return int $count
     */
    public function insert($table,$data)
    {
        $i=0;
        $this->err=false;
        $field_value="";
        $field="";
        foreach($data as $key => $value)
        {
            $this->where_array[":".$key."Insert"]=$value;
            //(animal_type, animal_name) VALUES ('kiwi', 'troy')
            if($i==0)
            {
                $field="`".$key."`";
                $field_value=":".$key."Insert";
            }
            else
            {
                $field=$field.",`".$key."` ";
                $field_value=$field_value.",:".$key."Insert ";
            }
            $i++;
        }
        //"INSERT INTO animals(animal_type, animal_name) VALUES ('kiwi', 'troy')"
        $sql="INSERT INTO ".$table." (".$field.") VALUES (".$field_value.")";
        
        try
        {
            $result=$this->dbh->prepare($sql);
           //loop array for replace sql
            $count=$result->execute($this->where_array);
            
            $this->generate_sql($sql,$this->where_array);

            $this->clear_variable();
            
            if(!$count) {
               $this->err=$result->errorInfo();
            }
            
            return $count;
        }
        catch(PDOException $e)
        {
            die($e->getMessage());
        }
    }

    /**
     * update database
     * @param  $data
     * @param  $table
     * @return int
     */
    public function update($table,$data)
    {
        //$dbh->exec("UPDATE animals SET animal_name='bruce' WHERE animal_name='troy'");
        $i=0;
        $this->err=false;
        $update_value="";
        foreach($data as $key => $value)
        {
            $this->where_array[":".$key."Update"]=$value;
            //(animal_type, animal_name) VALUES ('kiwi', 'troy')
            if($i==0)
            {
                $update_value=$key."=:".$key."Update";
            }
            else
            {
                $update_value=$update_value." , ".$key."=:".$key."Update";
            }
                        $i++;
        }

        if($this->where=="")
        {
            $sql="UPDATE ".$table." SET ".$update_value;
        }
        else
        {
            $sql="UPDATE ".$table." SET ".$update_value." WHERE ".$this->where;
        }

        try {
            $result=$this->dbh->prepare($sql);

           //loop array for replace sql
            $count=$result->execute($this->where_array);

            $this->generate_sql($sql,$this->where_array);

            $this->clear_variable();

            if(!$count) {
                $this->err=$result->errorInfo();
            }
            return $count;
        }
        catch(PDOException $e)
        {
            die($e->getMessage());
        }
    }

    /**
     * delete from database
     * @param  $table
     * @return int
     */
    public function delete($table)
    {
        $this->err=false;
        $sql="DELETE FROM ".$table." WHERE ";
        $sql=$sql.$this->where;
        $result=$this->dbh->prepare($sql);
       //loop array for replace sql
       
        $count=$result->execute($this->where_array);

        if(!$count) {
            $this->err=$result->errorInfo();
        }
        $this->generate_sql($sql,$this->where_array);

        $this->clear_variable();
        
        return $count;

    }

    /**
     * join tables
     *
     * @param string $command 
     * @param string $condition 
     * @param string $type 
     * @return $this
     */
    function join($command,$condition,$type="JOIN")
    {
        //LEFT JOIN comments ON comments.id = blogs.id
        if(strtoupper($type)!="JOIN")
        {
            $type = strtoupper($type). " JOIN";
        }

        $join = $type." ".$command. " ON ".$condition;
        $this->join=$this->join." ".$join;
        return $this;
    }

    /**
     * group by function
     *
     * @param string $groupby 
     * @return $this
     */
    function group_by($groupby)
    {
        $this->groupby="GROUP BY ".$groupby;
        return $this;
    }
    
    /**
     * HAVING in mysql
     *
     * @param string $having 
     * @return $tis
     */
    function having($having)
    {
        $this->having = "HAVING($having)";
        return $this;
    }
    
    /**
     * total row count
     *
     * @return void
     * @author saturngod
     */
    function count()
    {
        return $this->row_count;        
    }

    /**
     * ( start
     *
     * @return void
     * @author saturngod
     */
    function bracket_open($separator="")
    {
        if($this->where!="")
        {
            $this->where = $this->where . " ".$separator. " (";
        }
        else {
            $this->where = $separator." (";
        }
    }

    /**
     * ) end
     *
     * @return void
     * @author saturngod
     */
    function bracket_close($separator="")
    {
        if($this->where!="")
        {
            $this->where = $this->where . " ".$separator. " )";
        }
        else {
            $this->where = $separator. " )";
        }
    }
}

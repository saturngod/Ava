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
	private $limit;
	private $select;
	private $order;
	public $err;

	public function __construct()
	{
		$this->err=false;
		$this->where="";
		try {
   	 		$this->dbh = new PDO("mysql:host=".AvaConfig::db_host.";dbname=".AvaConfig::db_name, AvaConfig::db_user, AvaConfig::db_password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
   	 		$this->dbh->query("SET NAMES UTF8");
   	 		$this->err=false;
	    }
		catch(PDOException $e)
    	{
		    $this->err=$e->getMessage();
	    }
	}

	public function query($sql)
	{

		$this->err=false;
		try
		{
			$this->dbh->query("SET NAMES UTF8");
			$result=$this->dbh->query($sql);
            if(is_object($result))
            {
                $result->setFetchMode(PDO::FETCH_OBJ);
                $this->where="";
                $this->limit="";
                $this->select="";
                $this->order="";
                return $result->fetchAll();
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

	private function wherelike($field,$value,$do="both")
	{
		if($do=="both")
		{
			$like=$field." like '%".$value."%'";
		}
		else if($do=="before")
		{
			$like=$field." like '%".$value."'";
		}
		else if($do=="after")
		{
			$like=$field." like '".$value."%'";
		}
		return $like;
	}
	public function where_like($field,$value,$do="both")
	{

		$like=$this->wherelike($field,$value,$do);

		if($this->where!="")
		{
			$this->where=$this->where." AND ".$like;
		}
		else
		{
			$this->where=$like;
		}
	}

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
	}


	public function where($field,$value)
	{
		if($this->where!="")
		{
			$this->where=$this->where.' AND `'.$field."` = '".$value."'";
		}
		else
		{
			$this->where=' `'.$field."` = '".$value."'";
		}
	}

	public function where_or($field,$value)
	{
		if($this->where!="")
		{
			$this->where=$this->where.' OR `'.$field."` = '".$value."'";
		}
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
	}
	public function limit($total='',$start=0)
	{
		$this->limit="limit ".$start.",".$total;
	}

	public function select($select)
	{
		$this->select=$select;
	}
	/**
	 * get
	 *
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
			$sql="SELECT ".$this->select." FROM ".$table;
		}
		else
		{
			$sql="SELECT * FROM ".$table;

		}

		if($this->where!="")
		{
			$sql=$sql." WHERE ".$this->where;
		}

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

	public function insert($data,$table)
	{
		$i=0;

		foreach($data as $key => $value)
		{
			//(animal_type, animal_name) VALUES ('kiwi', 'troy')
			if($i==0)
			{
				$field="`".$key."`";
				$field_value="'".mysql_escape_string($value)."'";
			}
			else
			{
				$field=$field.",`".$key."` ";
				$field_value=$field_value.",'".mysql_escape_string($value)."' ";
			}
			$i++;
		}
		//"INSERT INTO animals(animal_type, animal_name) VALUES ('kiwi', 'troy')"
		$sql="INSERT INTO ".$table." (".$field.") VALUES (".$field_value.")";

		$count=$this->dbh->exec($sql);
		$this->where="";
		return $count;
	}

	public function update($data,$table)
	{
		//$dbh->exec("UPDATE animals SET animal_name='bruce' WHERE animal_name='troy'");
		$i=0;
		foreach($data as $key => $value)
		{
			//(animal_type, animal_name) VALUES ('kiwi', 'troy')
			if($i==0)
			{
				$update_value=$key."='".mysql_escape_string($value)."'";
			}
			else
			{
				$update_value=$update_value." , ".$key."='".mysql_escape_string($value)."'";
			}
                        $i++;
		}
		//"INSERT INTO animals(animal_type, animal_name) VALUES ('kiwi', 'troy')"
		if($this->where=="")
		{
			$sql="UPDATE ".$table." SET ".$update_value;
		}
		else
		{
			$sql="UPDATE ".$table." SET ".$update_value." WHERE ".$this->where;
		}
		
		$count=$this->dbh->exec($sql);
		$this->where="";
		return $count;

	}

	public function delete($table)
	{
		//DELETE FROM `dictionary`.`user` WHERE `user`.`usrid` = 5
		$sql="DELETE FROM ".$table." WHERE ";
		$sql=$sql.$this->where;
		$count=$this->dbh->exec($sql);
		$this->where="";
		return $count;

	}


}
?>
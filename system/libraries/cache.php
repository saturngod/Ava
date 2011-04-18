<?php
/**
 * Cache Class. Can't cache resource type
 * @package Ava
 * @since version 1.0
 * @author saturngod
 * @category Library
 */

class Ava_cache {
    private $cache_path;

    /**
     * constructor
     */
    function __construct()
    {
        $this->cache_path=SITE_PATH."/cache/";
    }

    /**
     * @param  $key string
     * @param  $value
     * @param  $ttl seconds
     * @return void
     */
    function store($key,$value,$ttl=false)
    {
        $file=fopen($this->getFile($key),'w');

        if(!$file) throw new Exception('Could not write to cache');

        //Serializing with TTL
        if($ttl!=false)
        {
            $save_data=serialize(array(time()+$ttl,$value));
        }
        else
        {
            //without expire
            $save_data=serialize(array(false,$value));
        }

        if(fwrite($file,$save_data)===false) {
            throw new Exception("Could not write to cache");
        }

        fclose($file);
    }

    /**
     * get file from cache path
     * @param  $key string
     * @return string
     */
    private function getFile($key)
    {
        return $this->cache_path.md5($key);
    }

    /**
     * check exist cache or not
     * @param  $key string
     * @return bool
     */
    function exist($key)
    {
        $file=$this->getFile($key);

        //check cache exist or readable
        if(!file_exists($file) || !is_readable($file)) {
            return false;
        }
        return true;
    }

    /**
     * get the cache data
     * @param  $key string
     * @return bool
     */
    function fetch($key)
    {

        $file=$this->getFile($key);
        //check cache exist or readable
        if(!file_exists($file) || !is_readable($file)) {
            return false;
        }

        $data=file_get_contents($file);
        $data=@unserialize($data);

        if(!$data)
        {
            //can't unserialize , delete file
            unlink($file);
            return false;
        }

        //checking expire
        if($data[0]!=false && time() > $data[0])
        {
            //unlinking
            unlink($file);
            return false;
        }
        
    }

    /**
     * delete cache file
     * @param  $key
     * @return bool
     */
    function delete($key)
    {
        $file=$this->getFile($key);
        if(!file_exists($file) || !is_readable($file)) {
            return false;
        }
        unlink($file);
    }
}

?>

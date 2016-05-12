<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * 
 */
class Predis {

    /**
     * @var Redis redis对象实例
     */
    protected $_redis;
    protected $redis_conf = array(
        'default' => array(
            'hostname' => '127.0.0.1',
            'port' => '10000',
            'weight' => '1',
    ));

    /**
     * 读取配置文件redis.php并初始化设置
     * 
     */
    public function __construct($cate = 'default') {
        $CI = & get_instance();

        if ($CI->config->load('redis', TRUE, TRUE)) {
            if (is_array($CI->config->config['redis'])) {
                foreach ($CI->config->config['redis'] as $name => $conf) {
                    $this->redis_conf[$name] = $conf;
                }
            }
        }
        $this->_redis = new Redis();
        if (empty($this->redis_conf[$cate])) {
            $config = $this->redis_conf['default'];
        } else {
            $config = $this->redis_conf[$cate];
        }
        try{
            $this->_redis->connect($config['hostname'],$config['port']);
        } catch (Exception $ex) {
            echo 'redis is down,can not be connected';
        }
        
//        $this->_redis->setOption(Redis::OPT_SERIALIZER, Redis::SERIALIZER_IGBINARY);
    }
    
    function __call($name, $arguments) {
//        return call_user_func_array(array($this->_redis,$name),$arguments);
        try {
            return call_user_func_array(array($this->_redis,$name),$arguments);
        } catch (Exception $ex) {
            return 0;
        }
    }
    
    function __destruct() {
        try{
            $this->_redis->close();
        } catch (Exception $ex) {
//            echo 'Redis server went away';
        }
        
    }

}



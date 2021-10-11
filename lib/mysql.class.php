<?php
    // create by evil
    // mysql的配置文件


    abstract class aDB {
    
        /**
         * 查询多行数据
         */
        abstract public function getAll($sql);
    
        /**
         * 单行数据
         */
        abstract public function getRow($sql);
    
        /**
         * 查询单个数据 如 count(*)
         */
        abstract public function getOne($sql);
    
        /**
         * 执行删除/修改/更新的SQL操作
         */
        abstract public function Exec($sql);
    
        /**
         * 返回上一条insert语句产生的主键值
         */
        abstract public function lastId();
    
        /**
         * 返回上一条语句影响的行数
         */
        abstract public function affectRows();
    }
    
    class MySql extends aDB {
        //加载配置文件
        public $link;
        public function __construct(){
            $config=require 'config.php';
            $this->link=new mysqli($config['host'],$config['user'],$config['password'],$config['database']);
        }
        //查询多行
        public function getAll($sql){
            $res=$this->link->query($sql);
            $data=array();
            while ($row=$res->fetch_assoc()) {
                $data[]=$row;
            }
            return $data;
        }
        //查询单行
        public function getOne($sql)
        {
            $res=$this->link->query($sql);
            $data=$res->fetch_assoc()[0];
            return $data;
        }
        //查询一列
        public function getRow($sql){
           
            $res=$this->link->query($sql);
            $data=$res->fetch_assoc();
            return $data;
        }
        //数据库操作
        public function Exec($sql){
            $this->link->query($sql);
        }
        //影响id
        public function lastId(){
            return $this->link->insert_id;
        }
        //影响行数
        public function affectRows(){
            return $this->link->affected_rows;
        }
    }



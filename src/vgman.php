#!/usr/bin/env php
<?php

class VGman {
    const VAGRANT_D_PATH = '/.vagrant.d/data/machine-index/index';
    protected $args = [];
    protected $boxes = [];
    public function __construct($args){
        if(count($args) >= 2){
            $this->args = array_slice($args,1);
            $this->loadVagrantD();
        }else {
            die('No command supplied'.PHP_EOL);
        }
    }

    private function loadVagrantD(){
        $boxes = json_decode(file_get_contents(getenv("HOME").self::VAGRANT_D_PATH),true)['machines'];
        $result = [];
        foreach($boxes as $box){
            $result[] = [
                'name' => ucfirst(preg_replace('/^.+.\//','',$box['vagrantfile_path'])),
                'vagrantfile_path' => $box['vagrantfile_path'],
                'state' => $box['state']
            ];
        }
        $this->boxes = $result;
    }

    public function exec(){
        $method = $this->args[0];
        $params = array_slice($this->args,1);
        if (method_exists($this, $method)){
            echo $this->$method($params) . PHP_EOL;
        } else {
            die('Invalid command: '. $this->args[0].PHP_EOL);
        }
    }

    public function ls($params = []){
        $index = 1;
        $result = '';
        foreach($this->boxes as $box){
            $result .= $index . '. '
            . $box["name"]
            . ": ". $box["state"] . PHP_EOL;
            $index ++;
        }
        return $result;
    }

    public function cd($params = []){

        foreach($this->boxes as $box){
            if(strtolower($box['name']) === strtolower($params[0])){
                return "cd ".$box["vagrantfile_path"];
            }
        }
        die('Not a valid box name');
    }

    public function u($params = []){
        $result = $this->cd($params);
        $result .= ' && vagrant up';
        $result .= ' && cd -';
        return $result;
    }

    public function s($params = []){
        $result = $this->cd($params);
        $result .= ' && vagrant suspend';
        $result .= ' && cd -';
        return $result;
    }

    public function ssh($params = []){
        $result = $this->cd($params);
        $result .= ' && vagrant ssh';
        return $result;
    }

}

$vman = new VGman($argv);

$vman->exec();

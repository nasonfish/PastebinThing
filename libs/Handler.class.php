<?php

class Handler {

    public $languages = array(
        'c'=>'C', 'shell'=>'Shell', 'java'=>'Java', 'd'=>'D',
        'coffeescript'=>'CoffeeScript', 'generic'=>'Generic',
        'scheme'=>'Scheme', 'javascript'=>'JavaScript',
        'r'=>'R', 'haskell'=>'haskell', 'python'=>'Python', 'html'=>'HTML',
        'smalltalk'=>'SmallTalk', 'csharp'=>'C#', 'go'=>'Go', 'php'=>'PHP',
        'ruby'=>'Ruby', 'lua'=>'Lua', 'css'=>'CSS', 'terminal'=>'Terminal',
        'none'=>'Text'
    );

    public $predis;

    function __construct(){
        require 'Predis/Autoloader.php';
        Predis\Autoloader::register();
        $predis = new Predis\Client(array('port'=>6383));
        $this->predis = $predis;
    }

    public function getLanguages_html(){
        $ret = '';
        foreach($this->languages as $val => $language){
            $ret .= '<option value="'.$val.'">' . $language . '</option>';
        }
        return $ret;
    }

    public function generateHash(){
        for($i = 0; $i < 20; $i++){
            $random = substr(md5(rand()), 0, 7);
            $cmd = new Predis\Command\KeyExists;
            $cmd->setRawArguments(array('paste:' . $random));
            if($this->predis->executeCommand($cmd)){
                continue;
            }
            return $random;
        }
        return time(); // this should never match itself
    }

    public function save($syntax, $text){
        $hash = $this->generateHash();
        $save = new Predis\Command\StringSet;
        $save->setRawArguments(array('paste:' . $hash, $text));
        $this->predis->executeCommand($save);
        $save->setRawArguments(array('paste:' . $hash . ':syntax', $syntax));
        $this->predis->executeCommand($save);
        return $hash;
    }

    public function get($hash){
        $ret = array(
            'text'=>htmlspecialchars($this->getText($hash)),
            'syntax'=>$this->getSyntax($hash)
        );
        return $ret;
    }

    public function getText($hash){
        $get = new Predis\Command\StringGet;
        $get->setRawArguments(array('paste:' . $hash));
        return $this->predis->executeCommand($get);
    }

    public function getSyntax($hash){
        $get = new Predis\Command\StringGet;
        $get->setRawArguments(array('paste:' . $hash . ':syntax'));
        return $this->predis->executeCommand($get);
    }
}

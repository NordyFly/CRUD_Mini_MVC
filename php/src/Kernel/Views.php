<?php
namespace Nordy\Php\Kernel;

use Nordy\Php\Configuration\Config;

class Views {
    private string $html;
    private string $head;
    

    public function setHtml(string $html):self
    {
        $this->html = Config::VIEWS.$html;
        return $this;
    }

    public function render(array $vars, ?string $html=null)
    {
        if ($html !== null) {
            $this->html = $html;
        }        
        extract($vars);
        include(dirname(__FILE__)."/../".$this->html);
    }
    
}
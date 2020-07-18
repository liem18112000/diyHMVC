<?php

namespace Framework\Core\Middleware;

class htmlXSS{

    static public function purify($content, $mode = null){
        return htmlspecialchars($content, $mode);
    }
}
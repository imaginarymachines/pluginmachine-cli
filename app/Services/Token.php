<?php

namespace App\Services;


/**
 * Auth token abstraction
 */
class Token {

    protected string $token;

    /**
     * Set token.
     * @param string $token
     * @return Token
     */
    public function set(string $token):Token{
        $this->token = $token;
        return $this;
    }

    /**
     * Get token.
     * @return string
     */
    public function get():string{
        if( ! isset($this->token)){
            $this->token = config('plugin_machine.api.key');
        }
        return $this->token;
    }
}

<?php

/**
 * ======================================================================
 * LICENSE: This file is subject to the terms and conditions defined in *
 * file 'license.txt', which is part of this source code package.       *
 * ======================================================================
 */

/**
 * AAM core policy token evaluator
 * 
 * @package AAM
 * @author Vasyl Martyniuk <vasyl@vasyltech.com>
 * @since AAM v5.8.2
 */
final class AAM_Core_Policy_Token {
    
    /**
     * Literal map token's type to the executable method that returns actual value
     * 
     * @var array
     * 
     * @access protected
     * @static 
     */
    protected static $map = array(
        'USER'     => 'AAM_Core_Policy_Token::getUserValue',
        'DATETIME' => 'AAM_Core_Policy_Token::getDateTimeValue',
        'GET'      => 'AAM_Core_Request::get',
        'POST'     => 'AAM_Core_Request::post',
        'COOKIE'   => 'AAM_Core_Request::cookie'
    );
    
    /**
     * Evaluate collection of tokens and replace them with values
     * 
     * @param string $part   String with tokens
     * @param array  $tokens Extracted token
     * 
     * @return string
     * 
     * @access public
     * @static
     */
    public static function evaluate($part, array $tokens) {
        foreach($tokens as $token) {
            $part = str_replace(
                $token, 
                self::getValue(preg_replace('/^\$\{([^}]+)\}$/', '${1}', $token)), 
                $part
            );
        }
        
        return $part;
    }
    
    /**
     * Get token value
     * 
     * @param string $token
     * @param mixed  $value
     * 
     * @return mixed
     * 
     * @access protected
     * @static
     */
    protected static function getValue($token, $value = null) {
        $parts = explode('.', $token);
        
        if (isset(self::$map[$parts[0]])) {
            $value = call_user_func(self::$map[$parts[0]], $parts[1], $value);
        } elseif ($parts[0] === 'CALLBACK' && is_callable($parts[1])) {
            $value = call_user_func($parts[1], $value);
        }
        
        return $value;
    }
    
    /**
     * Get USER's value
     * 
     * @param string $prop
     * 
     * @return mixed
     * 
     * @access protected
     * @static
     */
    protected static function getUserValue($prop) {
        $user = AAM::api()->getUser();
        
        switch(strtolower($prop)) {
            case 'ip':
            case 'ipaddress':
                $value = AAM_Core_Request::server('REMOTE_ADDR');
                break;
            
            case 'authenticated':
                $value = $user->isVisitor() ? false : true;
                break;
            
            default:
                $value = $user->{$prop};
                break;
        }
        
        return $value;
    }
    
    /**
     * Get current datetime value
     * 
     * @param string $prop
     * 
     * @return string
     * 
     * @access protected
     * @static
     */
    protected static function getDateTimeValue($prop) {
        return date($prop);
    }
    
}
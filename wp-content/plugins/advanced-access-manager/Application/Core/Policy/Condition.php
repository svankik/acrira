<?php

/**
 * ======================================================================
 * LICENSE: This file is subject to the terms and conditions defined in *
 * file 'license.txt', which is part of this source code package.       *
 * ======================================================================
 */

/**
 * AAM core policy condition evaluator
 * 
 * @package AAM
 * @author Vasyl Martyniuk <vasyl@vasyltech.com>
 * @since AAM v5.8.2
 */
final class AAM_Core_Policy_Condition {
    
    /**
     * Single instance of itself
     * 
     * @var AAM_Core_Policy_Condition
     * 
     * @access protected
     * @static 
     */
    protected static $instance = null;
    
    /**
     * Map between condition type and method that evaluates the
     * group of conditions
     * 
     * @var array
     * 
     * @access protected
     */
    protected $map = array(
        'between'         => 'evaluateBetweenConditions',
        'equals'          => 'evaluateEqualsConditions',
        'notequals'       => 'evaluateNotEqualsConditions',
        'greater'         => 'evaluateGreaterConditions',
        'less'            => 'evaluateLessConditions',
        'greaterorequals' => 'evaluateGreaterOrEqualsConditions',
        'lessorequals'    => 'evaluateLessOrEqualsConditions',
        'in'              => 'evaluateInConditions',
        'notin'           => 'evaluateNotInConditions',
        'like'            => 'evaluateLikeConditions',
        'notlike'         => 'evaluateNotLikeConditions',
        'regex'           => 'evaluateRegexConditions'
    );
    
    /**
     * Constructor
     * 
     * @return void
     * 
     * @access protected
     */
    protected function __construct() {}
    
    /**
     * Evaluate the group of conditions based on type
     * 
     * @param array $conditions
     * 
     * @return boolean
     * 
     * @access public
     */
    public function evaluate($conditions) {
        $result = true;
        
        foreach($conditions as $type => $conditions) {
            $type = strtolower($type);
            
            if (isset($this->map[$type])) {
                $callback = array($this, $this->map[$type]);
                $result   = $result && call_user_func($callback, $conditions);
            } else {
                $result = false;
            }
        }
        
        return $result;
    }
    
    /**
     * Evaluate group of BETWEEN conditions
     * 
     * @param array $conditions
     * 
     * @return boolean
     * 
     * @access protected
     */
    protected function evaluateBetweenConditions($conditions) {
        $result = false;
        
        foreach($this->prepareConditions($conditions) as $left => $right) {
            foreach((array)$right as $subset) {
                $min = (is_array($subset) ? array_shift($subset) : $subset);
                $max = (is_array($subset) ? end($subset) : $subset);

                $result = $result || ($left >= $min && $left <= $max);
            }
        }
        
        return $result;
    }
    
    /**
     * Evaluate group of EQUALS conditions
     * 
     * The values have to be identical
     * 
     * @param array $conditions
     * 
     * @return boolean
     * 
     * @access protected
     */
    protected function evaluateEqualsConditions($conditions) {
        $result = false;
        
        foreach($this->prepareConditions($conditions) as $left => $right) {
            $result = $result || ($left === $right);
        }
        
        return $result;
    }
    
    /**
     * Evaluate group of NOT EQUALs conditions
     * 
     * @param array $conditions
     * 
     * @return boolean
     * 
     * @access protected
     */
    protected function evaluateNotEqualsConditions($conditions) {
        return !$this->evaluateEqualsConditions($conditions);
    }
    
    /**
     * Evaluate group of GREATER THEN conditions
     * 
     * @param array $conditions
     * 
     * @return boolean
     * 
     * @access protected
     */
    protected function evaluateGreaterConditions($conditions) {
        $result = false;
        
        foreach($this->prepareConditions($conditions) as $left => $right) {
            $result = $result || ($left > $right);
        }
        
        return $result;
    }
    
    /**
     * Evaluate group of LESS THEN conditions
     * 
     * @param array $conditions
     * 
     * @return boolean
     * 
     * @access protected
     */
    protected function evaluateLessConditions($conditions) {
        $result = false;
        
        foreach($this->prepareConditions($conditions) as $left => $right) {
            $result = $result || ($left < $right);
        }
        
        return $result;
    }
    
    /**
     * Evaluate group of GREATER OR EQUALS THEN conditions
     * 
     * @param array $conditions
     * 
     * @return boolean
     * 
     * @access protected
     */
    protected function evaluateGreaterOrEqualsConditions($conditions) {
        $result = false;
        
        foreach($this->prepareConditions($conditions) as $left => $right) {
            $result = $result || ($left >= $right);
        }
        
        return $result;
    }
    
    /**
     * Evaluate group of LESS OR EQUALS THEN conditions
     * 
     * @param array $conditions
     * 
     * @return boolean
     * 
     * @access protected
     */
    protected function evaluateLessOrEqualsConditions($conditions) {
        $result = false;
        
        foreach($this->prepareConditions($conditions) as $left => $right) {
            $result = $result || ($left <= $right);
        }
        
        return $result;
    }
    
    /**
     * Evaluate group of IN conditions
     * 
     * @param array $conditions
     * 
     * @return boolean
     * 
     * @access protected
     */
    protected function evaluateInConditions($conditions) {
        $result = false;
        
        foreach($this->prepareConditions($conditions) as $left => $right) {
            $result = $result || in_array($left, (array) $right, true);
        }
        
        return $result;
    }
    
    /**
     * Evaluate group of NOT IN conditions
     * 
     * @param array $conditions
     * 
     * @return boolean
     * 
     * @access protected
     */
    protected function evaluateNotInConditions($conditions) {
        return !$this->evaluateInConditions($conditions);
    }
    
    /**
     * Evaluate group of LIKE conditions
     * 
     * @param array $conditions
     * 
     * @return boolean
     * 
     * @access protected
     */
    protected function evaluateLikeConditions($conditions) {
        $result = false;
        
        foreach($this->prepareConditions($conditions) as $left => $right) {
            foreach((array)$right as $el) {
                $sub    = str_replace('\*', '.*', preg_quote($el));
                $result = $result || preg_match('@^' . $sub . '$@', $left);
            }
        }
        
        return $result;
    }
    
    /**
     * Evaluate group of NOT LIKE conditions
     * 
     * @param array $conditions
     * 
     * @return boolean
     * 
     * @access protected
     */
    protected function evaluateNotLikeConditions($conditions) {
        return !$this->evaluateLikeConditions($conditions);
    }
    
    /**
     * Evaluate group of REGEX conditions
     * 
     * @param array $conditions
     * 
     * @return boolean
     * 
     * @access protected
     */
    protected function evaluateRegexConditions($conditions) {
        $result = false;
        
        foreach($this->prepareConditions($conditions) as $left => $right) {
            $result = $result || preg_match($right, $left);
        }
        
        return $result;
    }
    
    /**
     * Prepare conditions by replacing all defined tokens
     * 
     * @param array $conditions
     * 
     * @return array
     * 
     * @access protected
     */
    protected function prepareConditions($conditions) {
        $result = array();
        
        if (is_array($conditions)) {
            foreach($conditions as $left => $right) {
                $left  = $this->parseExpression($left);
                $right = $this->parseExpression($right);
                
                if ($left !== false) { // Do not include any failed conditions
                    $result[$left] = $right;
                }
            }
        }
        
        return $result;
    }
    
    /**
     * Parse condition and try to replace all defined tokens
     * 
     * @param mixed $exp Part of the condition (either left or right)
     * 
     * @return mixed Prepared part of the condition or false on failure
     * 
     * @access protected
     */
    protected function parseExpression($exp) {
        if (is_scalar($exp)) {
            if (preg_match_all('/(\$\{[^}]+\})/', $exp, $match)) {
                $exp = AAM_Core_Policy_Token::evaluate($exp, $match[1]);
            }
            // If there is type scaling, perform it too
            if (preg_match('/^\(\*(string|ip|int|boolean|bool)\)(.*)/i', $exp, $scale)) {
                $exp = str_replace(
                    "(*{$scale[1]}", '', $this->scaleValue($scale[2], $scale[1])
                );
            }
        } elseif (is_array($exp) || is_object($exp)) {
            foreach($exp as &$value) {
                $value = $this->parseExpression($value);
            }
        } else {
            $exp = false;
        }
        
        return $exp;
    }
    
    /**
     * Scale value to specific type
     * 
     * @param mixed  $value
     * @param string $type
     * 
     * @return mixed
     * 
     * @access protected
     */
    protected function scaleValue($value, $type) {
        switch(strtolower($type)) {
            case 'string':
                $value = (string)$value;
                break;
            
            case 'ip':
                $value = inet_pton($value);
                break;
            
            case 'int':
                $value = (int)$value;
                break;
            
            case 'boolean':
            case 'bool':
                $value = (bool)$value;
                break;
        }
        
        return $value;
    }
    
    /**
     * Get single instance of itself
     * 
     * @return AAM_Core_Policy_Condition
     * 
     * @access public
     * @static
     */
    public static function getInstance() {
        if (is_null(self::$instance)) {
            self::$instance = new self;
        }
        
        return self::$instance;
    }
    
}
<?php namespace App\Http\Statemachine;

class IllegalStateTransitionException extends \LogicException
{
    protected $results;
    
    
    public function __construct($results)
    {
            parent::__construct($results);

            $this->results = $results;
    }
    
    public function getResults()
    {
        return $this->results;
    }
}
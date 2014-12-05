<?php

class Does
{
    protected $class;

    public function __construct($class)
    {
        $this->class = $class;
    }


    /**
     * Asks if a class exists 
     *
     * @throws Exception
     * @access public
     * @return Does
    */

    public function exist()
    {
        if (!class_exists($this->class)) {
           throw new Exception("Class $this->class does not exist");
        }

        return $this;
    }


    /**
     * Asks if a class implements a given interface 
     *
     * @param mixed $interface
     * @access public
     * @return Does
    */

    public function implement($interface) 
    {
        if (!in_array($interface, class_implements($this->class))) {
            throw new Exception("Class $this->class does not implement interface $interface");
        }

        return $this;
    }



    /**
     * Asks if a class extends a specifc class or any classes at all
     *
     * @param mixed $parent string|null
     * @access public
     * @return Does
    */

    public function extend($parent = null) 
    {
        if (!$parent) {
            $this->haveParents();
        } else {
            $this->haveParent($parent);
        }

        return $this;
    }



    /**
     * Asks if a class is a child of another class
     *
     * @param string $trait
     * @access public
     * @return Does
    */

    public function useTrait($trait)
    {
        if (!in_array($trait, class_uses($this->class))) {
            throw new Exception("Class $this->class does not use trait $trait");
        }

        return $this;
    }


    
    /**
     * Checks if a class has any parents at all 
     *
     * @throws Exception
     * @access protected
     * @return void
    */

    public function haveParents()
    {
        if (empty(class_parents($this->class))) {
            throw new Exception("Class $this->class does not extend any parents");
        }
    }



    /**
     * Checks if a class has a specific parent
     *
     * @param string $parent
     * @throws Exception
     * @access protected
     * @return void
    */

    public function haveParent($parent)
    {
        if (!in_array($parent, class_parents($this->class))) {
            throw new Exception("Class $this->class is not a child of $parent");
        }
    }
}


interface Thing
{
    public function what();
}

class Some implements Thing
{
    public function what()
    {
        die('ok');
    }
}

$class = 'Some';

(new Does($class))
    ->exist()
    ->implement('Thing')
    ->extend('What');

$Instance = new $class;
$Instance->what();

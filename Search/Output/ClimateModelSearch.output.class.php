<?php

/**
 * 
 *
 * @author Adam Fakes (James Cook University)
 */
class ClimateModelSearchOutput extends Output
{


    public function __construct() {
        parent::__construct();
        $this->Name(__CLASS__);

    }

    public function __destruct() {
        parent::__destruct();

    }

    private function search()
    {
        $result = $this->Source();
        $result  instanceof ClimateModelSearch;
        return  $result;
    }


    public function Title()
    {
        return configuration::ApplicationName()."::Species Search";
    }


    public function Head()
    {
        $result = $this->descriptionsOutput()->Head();
        return $result;

    }

    public function Content()
    {
        $o = $this->descriptionsOutput();
        $o->NameTemplate('<a href="{Value}">{Value}</a>');
        return $o->Content();
    }

    public function PreProcess()
    {
        $this->descriptions($this->search()->Subsets());
        $this->descriptionsOutput(OutputFactory::Find($this->descriptions()));
    }

    


    private function descriptions() {
        if (func_num_args() == 0)
        {
            $result = $this->getProperty();
            $result instanceof Descriptions;
            return $result;
        }

        $result = $this->setProperty(func_get_arg(0));
        $result instanceof Descriptions;
        return $result;

    }

    private function descriptionsOutput() {
        if (func_num_args() == 0)
        {
            $result = $this->getProperty();
            $result instanceof DescriptionsOutput;
            return $result;
        }

        $result = $this->setProperty(func_get_arg(0));
        $result instanceof DescriptionsOutput;
        return $result;

    }



}


?>

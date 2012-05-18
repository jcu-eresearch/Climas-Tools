<?php
/**
 *
 * 
 *  
 */

class ContextLayerMapableBackgroundLayers extends Object implements iAction {

    public function __construct() {
        parent::__construct();
        $this->Name(__CLASS__);
    }


    public function __destruct() {
        parent::__destruct();
    }

    /**
     *
     * @return type
     */
    public function Execute()
    {

        $result = array();
        $result["ContextLayerAustralianRiverBasins"] = FinderFactory::SimpleActionName("ContextLayerAustralianRiverBasins");
        $result["ContextLayerAustralianStates"] = FinderFactory::SimpleActionName("ContextLayerAustralianStates");
        
        return $result;
    }

    /**
     * @property
     * @return type
     */
    public function Description() {
        if (func_num_args() == 0)
        return $this->getProperty();
        return $this->setProperty(func_get_arg(0));
    }

}



?>


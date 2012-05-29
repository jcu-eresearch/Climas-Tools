<?php
class ToolsData extends Object {

    //put your code here

    private $toolsDB = null;

    public function __construct($connect = false) {
        parent::__construct();

        if ($connect) $this->connect ();
        
    }


    public function connect()
    {
        $this->toolsDB = new database( ToolsDataConfiguration::Database(),
                                    ToolsDataConfiguration::Server(),
                                    ToolsDataConfiguration::Username(),
                                    ToolsDataConfiguration::Password());

    }

    public function __destruct() {

        if (!is_null($this->toolsDB))
        {
            $this->toolsDB->disconnect();
            unset($this->toolsDB);
        }

        parent::__destruct();
    }


    private function a() {
        if (func_num_args() == 0)
            return $this->getProperty();
        return $this->setProperty(func_get_arg(0));

    }


    /*
     * Set the value of this Property in constructor
     * via $this->setPropertyByName("ReadOnlyProperty", "SomeValue")
     *
     */

    public function ReadOnlyProperty() {
        return $this->getProperty();
    }


    /**
     * File list that will; give us the source of [scenario]_[gcm]_[year]
     *
     * http://www.ipcc-data.org/ar4/
     * http://www.ipcc-data.org/ar4/gcm_data.html
     *
     * @return type
     */
    public static function ClimateModels()
    {
        // /www/eresearch/source/gcm.csv

        $d = Descriptions::fromFile("/www/eresearch/source/gcm.csv");
        return $d;
    }

    public static function EmissionScenarios()
    {
        $result = array_util::Trim(file("/data/dmf/TDH/scenario.txt"));
        return $result;

    }

    public static function Times()
    {
        $result = array_util::Trim(file("/data/dmf/TDH/year.txt"));
        return $result;

    }



}


?>

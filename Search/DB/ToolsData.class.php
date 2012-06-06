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

        $d = Descriptions::fromFile(configuration::Descriptions_ClimateModels());
        return $d;
    }

    public static function EmissionScenarios()
    {
        $d = Descriptions::fromFile(configuration::Descriptions_EmissionScenarios());
        return $d;
    }

    public static function Times()
    {
        $d = Descriptions::fromFile(configuration::Descriptions_Years());
        return $d;
    }

// /data/dmf/TDH/maxent_model


    /**
     * Lookinto the data folder and see what folders are thyere - this will be computed species available for direct delivery
     * 
     * @return type 
     */
    public static function ComputedSpecies()
    {

        $folderNames = file::folder_folders(ToolsDataConfiguration::ModelledSpeciesFolder(), configuration::osPathDelimiter(), true);

        $descs = new Descriptions();

        foreach ($folderNames as $key => $folder)
        {
            $desc = self::DescriptionForSpecies($key);
            $desc->Filename($folder);
            $descs->Add($desc);
        }

        return $descs;

    }


    public static function DescriptionForSpecies($speciesName)
    {
        $desc = new Description();
        $desc->DataName($speciesName);
        $desc->Description($speciesName);
        $desc->MoreInformation("SHort data from ALA");
        $desc->URI(ToolsDataConfiguration::ALAFullTextSearch().urlencode($desc->DataName()) );

        return $desc;
    }





}


?>

<?php
class M_product extends CI_Model {
	
	private $_table_name = 'Products';

    function __construct()
    {
        parent::__construct();

        $this->load->model("m_reference_table");
    }

    public function get_schema()
    {
        $schema = array(
            "Department_Idn" => array(
                "dataType" => "integer",
                "default" => 0
            ),
            "WorksheetMaster_Idn" => array(
                "dataType" => "integer", 
                "default" => 0
            ),
            "WorksheetCategory_Idn" => array(
                "dataType" => "integer", 
                "default" => 0
            ),
            "Manufacturer_Idn" => array(
                "dataType" => "integer", 
                "default" => 0
            ),
            "Rank" => array(
                "dataType" => "integer", 
                "default" => 0
            ),
            "Name" => array(
                "dataType" => "string", 
                "default" => ""
            ),
            "ProductSize_Idn" => array(
                "dataType" => "integer", 
                "default" => 0
            ),
            "PipeType_Idn" => array(
                "dataType" => "integer", 
                "default" => 0
            ),
            "ScheduleType_Idn" => array(
                "dataType" => "integer", 
                "default" => 0
            ),
            "Fitting_Idn" => array(
                "dataType" => "integer", 
                "default" => 0
            ),
            "ActiveFlag" => array(
                "dataType" => "boolean", 
                "default" => 1
            ),
            "MaterialUnitPrice" => array(
                "dataType" => "float", 
                "default" => 0
            ),
            "FieldUnitPrice" => array(
                "dataType" => "float", 
                "default" => 0
            ),
            "ShopUnitPrice" => array(
                "dataType" => "float", 
                "default" => 0
            ),
            "EngineerUnitPrice" => array(
                "dataType" => "float", 
                "default" => 0
            ),
            "Description" => array(
                "dataType" => "string", 
                "default" => ""
            ),
            "FECI_Id" => array(
                "dataType" => "string", 
                "default" => ""
            ),
            "ManufacturerPart_Id" => array(
                "dataType" => "string", 
                "default" => ""
            ),
            "DefaultQuantity" => array(
                "dataType" => "float", 
                "default" => 0
            ),
            "GroovedFittingType_Idn" => array(
                "dataType" => "integer", 
                "default" => 0
            ),
            "ThreadedFittingType_Idn" => array(
                "dataType" => "integer", 
                "default" => 0
            ),
            "HangerType_Idn" => array(
                "dataType" => "integer", 
                "default" => 0
            ),
            "HangerSubType_Idn" => array(
                "dataType" => "integer", 
                "default" => 0
            ),
            "SubcontractCategory_Idn" => array(
                "dataType" => "integer", 
                "default" => 0
            ),
            "ApplyToAdjustmentFactorsFlag" => array(
                "dataType" => "boolean", 
                "default" => 1
            ),
            "ApplyToContingencyFlag" => array(
                "dataType" => "boolean", 
                "default" => 1
            ),
            "DomesticFlag" => array(
                "dataType" => "boolean", 
                "default" => 1
            ),
            "LoadFlag" => array(
                "dataType" => "boolean", 
                "default" => 1
            ),
            "AutoLoadFlag" => array(
                "dataType" => "boolean", 
                "default" => 0
            ),
            "RFP" => array(
                "dataType" => "boolean", 
                "default" => 1
            ),
            "ResponseType" => array(
                "dataType" => "string", 
                "default" => "Q"
            ),
            "GradeType_Idn" => array(
                "dataType" => "integer", 
                "default" => 0
            ),
            "PressureType_Idn" => array(
                "dataType" => "integer", 
                "default" => 0
            ),
            "SeamlessFlag" => array(
                "dataType" => "boolean", 
                "default" => 0
            ),
            "FMJobFlag" => array(
                "dataType" => "boolean", 
                "default" => 0
            ),
            "RecommendedBoxes" => array(
                "dataType" => "integer", 
                "default" => 0
            ),
            "RecommendedWireFootage" => array(
                "dataType" => "integer", 
                "default" => 0
            ),
            "CoverageType_Idn" => array(
                "dataType" => "integer", 
                "default" => 0
            ),
            "HeadType_Idn" => array(
                "dataType" => "integer", 
                "default" => 0
            ),
            "FinishType_Idn" => array(
                "dataType" => "integer", 
                "default" => 0
            ),
            "Outlet_Idn" => array(
                "dataType" => "integer", 
                "default" => 0
            ),
            "RiserType_Idn" => array(
                "dataType" => "integer", 
                "default" => 0
            ),
            "BackFlowType_Idn" => array(
                "dataType" => "integer", 
                "default" => 0
            ),
            "ControlValve_Idn" => array(
                "dataType" => "integer", 
                "default" => 0
            ),
            "CheckValve_Idn" => array(
                "dataType" => "integer", 
                "default" => 0
            ),
            "FDCType_Idn" => array(
                "dataType" => "integer", 
                "default" => 0
            ),
            "BellType_Idn" => array(
                "dataType" => "integer", 
                "default" => 0
            ),
            "TappingTee_Idn" => array(
                "dataType" => "integer", 
                "default" => 0
            ),
            "UndergroundValve_Idn" => array(
                "default" => 0,
                "dataType" => "integer", 
            ),
            "LiftDuration_Idn" => array(
                "dataType" => "integer", 
                "default" => 0
            ),
            "TrimPackageFlag" => array(
                "dataType" => "boolean", 
                "default" => 0
            ),
            "ListedFlag" => array(
                "dataType" => "boolean", 
                "default" => 0
            ),
            "BoxWireLength" => array(
                "dataType" => "integer", 
                "default" => 0
            ),
            "IsFirePump" => array(
                "dataType" => "boolean", 
                "default" => 0
            ),
            "FirePumpType_Idn" => array(
                "dataType" => "integer", 
                "default" => 0
            ),
            "FirePumpAttribute_Idn" => array(
                "dataType" => "integer", 
                "default" => 0
            ),
            "IsDieselFuel" => array(
                "dataType" => "boolean", 
                "default" => 0
            ),
            "IsSolution" => array(
                "dataType" => "boolean", 
                "default" => 0
            ),
            "Position_Idn" => array(
                "dataType" => "integer", 
                "default" => 0
            ),
        );

        return $schema;
    }

    /*
	 * Summary of get_product
     * 
     * Get product from Products table by Product_Idn, including foreign key id/name values
     * 
	 * @param mixed $product_idn
	 * @return array
	 */
	public function get_product($product_idn, $get_children = true, $get_dropdown_data = true)
	{
        $product = array();
        $products = array();
        $metadata = array();
        $dropdown_data = array();

        if (isset($product_idn) && $product_idn > 0)
        {

        $products = $this->m_reference_table->get_where('Products', array('Product_Idn' => $product_idn));
            
            if (!empty($products)) 
            {
                $product = $products[0];
            }
        }
        else 
        {
            $product = $this->set_defaults();
        }

        if (!empty($product))
        {
            if ($get_dropdown_data)
            {
                $dropdown_data = $this->get_dropdown_data($product);
            }

            if ($get_children)
            {
                $product['Children'] = $this->get_children($product_idn);
            }

            $metadata = $this->get_metadata($product);
        }

        return array_merge($product, $metadata, $dropdown_data);

    }

    public function get_dropdown_data($product = array())
    {
        //Departments
        $product['Departments'] = $this->m_reference_table->get_fields('jpr_Department', "*", "DepartmentId <> 3");

        //WorksheetMasters
        if (isset($product['Department_Idn']))
        {
            $product['WorksheetMasters'] = $this->m_reference_table->get_idns_names("WorksheetMasters", "WorksheetMaster_Idn", array("Department_Idn" => $product['Department_Idn']), true, 'Name');
        }

        if (isset($product['WorksheetMaster_Idn']))
        {
            //WorksheetCategories
            $product['WorksheetCategories'] = $this->m_reference_table->get_idns_names("v_WorksheetMasterCategories", "WorksheetCategory_Idn", array("WorksheetMaster_Idn" => $product['WorksheetMaster_Idn']), true, 'Name');
        }

        //Manufacturers
        $product['Manufacturers'] = $this->m_reference_table->get_idns_names("Manufacturers", "Manufacturer_Idn", array(), true, 'Name');

        //Product Sizes
        $product['ProductSizes'] = $this->m_reference_table->get_idns_names("ProductSizes", "ProductSize_Idn", array(), true, 'Rank');

        //Schedule Types
        $product['ScheduleTypes'] = $this->m_reference_table->get_idns_names("ScheduleTypes", "ScheduleType_Idn", array(), true, 'Name');

        //Pipe Types
        $product['PipeTypes'] = $this->m_reference_table->get_idns_names("PipeTypes", "PipeType_Idn", array(), true, 'Name');

        //Grooved Fitting Types
        $product['GroovedFittingTypes'] = $this->m_reference_table->get_idns_names("GroovedFittingTypes", "GroovedFittingType_Idn", array(), true, 'Name');

        //Threaded Fitting Types
        $product['ThreadedFittingTypes'] = $this->m_reference_table->get_idns_names("ThreadedFittingTypes", "ThreadedFittingType_Idn", array(), true, 'Name');

        //Hanger Types
        $product['HangerTypes'] = $this->m_reference_table->get_idns_names("HangerTypes", "HangerType_Idn", array(), true, 'Name');

        //Filter by Hanger Type
        //Hanger Sub Types
        $product['HangerSubTypes'] = $this->m_reference_table->get_idns_names("HangerSubTypes", "HangerSubType_Idn", array(), true, 'Name');

        //Grade Types
        $product['GradeTypes'] = $this->m_reference_table->get_idns_names("GradeTypes", "GradeType_Idn", array(), true, 'Name');

        //Pressure Types
        $product['PressureTypes'] = $this->m_reference_table->get_idns_names("PressureTypes", "PressureType_Idn", array(), true, 'Name');

        //Coverage Types
        $product['CoverageTypes'] = $this->m_reference_table->get_idns_names("CoverageTypes", "CoverageType_Idn", array(), true, 'Name');

        //Head Types
        $product['HeadTypes'] = $this->m_reference_table->get_idns_names("HeadTypes", "HeadType_Idn", array(), true, 'Name');

        //Finish Types
        $product['FinishTypes'] = $this->m_reference_table->get_idns_names("FinishTypes", "FinishType_Idn", array(), true, 'Name');

        //Outlets
        $product['Outlets'] = $this->m_reference_table->get_idns_names("Outlets", "Outlet_Idn", array(), true, 'Name');

        //Riser Types
        $product['RiserTypes'] = $this->m_reference_table->get_idns_names("RiserTypes", "RiserType_Idn", array(), true, 'Name');

        //Backflow Types
        $product['BackflowTypes'] = $this->m_reference_table->get_idns_names("BackflowTypes", "BackflowType_Idn", array(), true, 'Name');

        //Control Valves
        $product['ControlValves'] = $this->m_reference_table->get_idns_names("ControlValves", "ControlValve_Idn", array(), true, 'Name');

        //Check Valve
        $product['CheckValves'] = $this->m_reference_table->get_idns_names("CheckValves", "CheckValve_Idn", array(), true, 'Name');

        //FDC Types
        $product['FDCTypes'] = $this->m_reference_table->get_idns_names("FDCTypes", "FdcType_Idn", array(), true, 'Name');

        //Bell Types
        $product['BellTypes'] = $this->m_reference_table->get_idns_names("BellTypes", "BellType_Idn", array(), true, 'Name');

        //Tapping Tees
        $product['TappingTees'] = $this->m_reference_table->get_idns_names("TappingTees", "TappingTee_Idn", array(), true, 'Name');

        //Underground Valves
        $product['UndergroundValves'] = $this->m_reference_table->get_idns_names("UndergroundValves", "UndergroundValve_Idn", array(), true, 'Name');

        //Lift Durations
        $product['LiftDurations'] = $this->m_reference_table->get_idns_names("LiftDurations", "LiftDuration_Idn", array(), true, 'Name');

        //Fire Pump Types
        $product['FirePumpTypes'] = $this->m_reference_table->get_idns_names("FirePumpTypes", "FirePumpType_Idn", array(), true, 'Name');

        //Fire Pump Attributes
        $product['FirePumpAttributes'] = $this->m_reference_table->get_idns_names("FirePumpAttributes", "FirePumpAttribute_Idn", array(), true, 'Name');

        //Positions
        $product['Positions'] = $this->m_reference_table->get_idns_names("Positions", "Position_Idn", array(), true, 'Name');

        //Subcontract categories (uses WorksheetColumns table)
        $product['SubcontractCategories'] = $this->m_reference_table->get_idns_names("WorksheetColumns", "WorksheetColumn_Idn", array(), true, 'Name');
        
        if (isset($product['WorksheetCategory_Idn']))
        {
            //Filter by Worksheet Category
            //Fittings
            $fittings_where = array("WorksheetCategory_Idn" => $product['WorksheetCategory_Idn']);
            $product['Fittings'] = $this->m_reference_table->get_idns_names("Fittings", "Fitting_Idn", $fittings_where, true, 'Name');
        }
        
        return $product;
    }

    public function set_defaults()
    {
        $product = array();

        $schema = $this->get_schema();

        foreach ($schema as $field_name => $metadata)
        {
            //If post field matches schema field
            $product[$field_name] = $metadata['default'];
        }

        $product['Product_Idn'] = "";
        $product['IsMainComponent'] = 0;

        return $product;
    }

    public function get_children($product_idn)
    {
        $children = array();
        $product_relations = array();
        $child = array();

    $product_relations = $this->m_reference_table->get_where('ProductRelationships', array('Parent_Idn' => $product_idn));

        foreach($product_relations as $product_relationship)
        {
            //Get child product
            $child = $this->m_reference_table->get_where('Products', array('Product_Idn' => $product_relationship['Child_Idn']))[0];

            $child['Quantity']=$product_relationship['Quantity'];
            
            //Add metadata
            $metadata = $this->get_metadata($child);

            //Merge product with metadata and add to children array
            $children[] = array_merge($child, $metadata);
        }

        return $children;
    }

    public function get_search_results($parent_idn, $children, $search_criteria, $add_metadata = true)
    {
        $results = array();
        $products = array();
        $where = array("ActiveFlag" => 1, "Product_Idn <>" => $parent_idn);
        $metadata = array();
        $children_idns = array();

        //Put children_idns into array, so we can exlcude children from the search results
        foreach($children as $child)
        {
            $children_idns[] = $child['Product_Idn'];
        }

        //Build where statement
        if (isset($search_criteria['WorksheetMaster_Idn']) && (int) $search_criteria['WorksheetMaster_Idn'] != 0)
        {
            $where['WorksheetMaster_Idn'] = $search_criteria['WorksheetMaster_Idn'];
        }

        if (isset($search_criteria['WorksheetCategory_Idn']) && (int) $search_criteria['WorksheetCategory_Idn'] != 0)
        {
            $where['WorksheetCategory_Idn'] = $search_criteria['WorksheetCategory_Idn'];
        }
 
        $this->db
            ->select('*')
            ->from("Products")
            ->where($where);
            
        if (!empty($children_idns))
        {
            $this->db->where_not_in("Product_Idn", $children_idns);;
        }

        $query = $this->db->get();
            
        if ($query == false)
        {
            write_feci_log(array("Message" => "SQL Error ".$this->db->last_query(), "Script" => get_caller_info()));
        }
        else
        {
            if ($query->num_rows() > 0)
            {
                foreach ($query->result_array() as $row)
                {
                    $products[] = $row;
                }
            }
        }

        //Add metadata
        if ($add_metadata)
        {
            foreach($products as $product)
            {
                $metadata = $this->get_metadata($product);
                $results[] = array_merge($product, $metadata);
            }
        }

        return $results;
    }

    public function get_metadata($product)
    {
        $metadata = array();

        $metadata['Department'] = $this->m_reference_table->get_field("jpr_Department", "Description", array("DepartmentId" => $product['Department_Idn']));

        $metadata['WorksheetMaster'] = $this->m_reference_table->get_field("WorksheetMasters", "Name", array("WorksheetMaster_Idn" => $product['WorksheetMaster_Idn']));

        $metadata['WorksheetCategory'] = $this->m_reference_table->get_field("WorksheetCategories", "Name", array("WorksheetCategory_Idn" => $product['WorksheetCategory_Idn']));

        $metadata['Manufacturer'] = $this->m_reference_table->get_field("Manufacturers", "Name", array("Manufacturer_Idn" => $product['Manufacturer_Idn']));

        return $metadata;
    }
}
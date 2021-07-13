
<?php
// No direct access.
defined('_JEXEC') or die();
JTable::addIncludePath(JPATH_ADMINISTRATOR . '/components/com_abook/tables');


class AbookApiResourceBooks extends ApiResource
{ 
    public function get(){
        $table =  JTable::getInstance("Book", "AbookTable", array());
        $input = JFactory::getApplication()->input;
        $db = $table->getDbo();
        $query = $db->getQuery(true);
        $query->select("*");
        $query->from($table->getTableName());
       foreach ($table->getFields() as $field){
            $type = $field->Type;
            $name = $field->Field;
            $frominput = null;
            
            if (strstr($type, "int(")){
                //https://docs.joomla.org/Secure_coding_guidelines Secure integers and the rest of numeric values
                $frominput = (int) $input->getInt($name);
                if ($frominput){
                    $query->where($db->quoteName($name )  .  ' = ' . $db->quote($frominput));
                }
            }
            else if (strstr($type, "varchar(")){
                $frominput = $input->getString($name);
                if ($frominput){
                    $query->where($db->quoteName($name )  .  ' LIKE ' . $db->quote($frominput));
                }
            }
        }
       $db->setQuery($query);
       $results = $db->loadObjectList();
       if (!$results){
            ApiError::raiseError(12001, "not found", 'APINotFoundException');
       }
       $this->plugin->setResponse($results);
    }
}
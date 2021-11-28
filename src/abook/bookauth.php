
<?php
// No direct access.
defined('_JEXEC') or die();
JTable::addIncludePath(JPATH_ADMINISTRATOR . '/components/com_abook/tables');

class AbookApiResourceBookAuth extends ApiResource
{ 
    public function put(){
        $table =  JTable::getInstance("Auth", "AbookTable", array());
        //no idea how to make joomla do this
        $data = json_decode(file_get_contents("php://input"),true);
        $json = $data['data'];
        if ($json['id'] != 0){
            $table->load($json['id']);
        }
        $table->save($json);
        $this->plugin->setResponse($json);   
    }
}
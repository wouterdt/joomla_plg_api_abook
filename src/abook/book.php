
<?php
// No direct access.
defined('_JEXEC') or die();
JTable::addIncludePath(JPATH_ADMINISTRATOR . '/components/com_abook/tables');

class AbookApiResourceBook extends ApiResource
{ 
    public function put(){
        $table =  JTable::getInstance("Book", "AbookTable", array());
        $input = JFactory::getApplication()->input;
        $json = $input->json->get("data", array(), 'array');
        if ($json->id != 0){
            $table->load($id);
        }
         /*$array = [
            "title" => "bar",
            "parent_id" => "2",
            "extension" => "com_abook",
            "published" => "1",
            "created_user_id" => "11"

        ];*/
        $table->save($json);
        $this->plugin->setResponse($json);         
    }
}

<?php
use Joomla\CMS\Factory;
// No direct access.
defined('_JEXEC') or die();
JTable::addIncludePath(JPATH_ADMINISTRATOR . '/components/com_abook/tables');

class AbookApiResourceCategory extends ApiResource
{ 
    public function put(){
        $table =  JTable::getInstance("Category", "AbookTable", array());
        //no idea how to make joomla do this
        $data = json_decode(file_get_contents("php://input"),true);
        $json = $data['data'];
         /*/$array = [
            "title" => "bar",
            "parent_id" => "90",
            "extension" => "com_abook",
            "published" => "1",
            "created_user_id" => "11"

        ];*/
        if ($json['id'] != 0){
            $table->load($id);
        }
        $table->setLocation($json['parent_id'], 'last-child');
        $table->save($json);
        $table->rebuild();
        $table->rebuildPath();
        $this->plugin->setResponse($json);   
    }
}
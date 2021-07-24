
<?php
use Joomla\CMS\Factory;
// No direct access.
defined('_JEXEC') or die();
JTable::addIncludePath(JPATH_ADMINISTRATOR . '/components/com_abook/tables');

class AbookApiResourceAuthor extends ApiResource
{ 
    public function put(){
        $table =  JTable::getInstance("Author", "AbookTable", array());
        //no idea how to make joomla do this
        $data = json_decode(file_get_contents("php://input"),true);
        $json = $data['data'];
        if ($json['id'] != 0){
            $table->load($id);
        }
        $table->save($json);
        $this->plugin->setResponse($table->getPrimaryKey());
    }
}
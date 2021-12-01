
<?php
// No direct access.
defined('_JEXEC') or die();
JTable::addIncludePath(JPATH_ADMINISTRATOR . '/components/com_abook/tables');

class AbookApiResourceBook extends ApiResource
{ 
    public function put(){
        $table =  JTable::getInstance("Book", "AbookTable", array());
        $data = json_decode(file_get_contents("php://input"),true);
        $json = $data['data'];

        
    
        /*if (isset($json["id"])){
            $table->load($json["id"]);
        }*/

        $result = $table->save($json);
        //check the record


        if ($result == true){
            
            $id = $table->id;
            $json['authorlist'];
            //ADD AUTHORS
            //this is easier todo :/ for me, i dont know enough about joomla
            $db = JFactory::getDbo();
            
            $query = $db->getQuery(true);
            $conditions = array(
                $db->quoteName('idbook') . ' = ' . $id  ,
            );
            //delete the currently configured authors if any
            $query->delete($db->quoteName('#__abbookauth'));
            $query->where($conditions);

            $db->setQuery($query);
            $result = $db->execute();

            //add the provided authors 
            $ordercounter = 0;
            foreach($json['authorlist'] as &$value ){
                $query2 = $db->getQuery(true);
                $columns = array('idbook', 'idauth', 'ordering');
                $values = array($id,$value,$ordercounter);
                $query2
                    ->insert($db->quoteName('#__abbookauth'))
                    ->columns($db->quoteName($columns))
                    ->values(implode(',', $values));
                $db->setQuery($query2);
                $db->execute();
                $ordercounter++;


            }

            foreach($json['taglist'] as &$value ){
                $query2 = $db->getQuery(true);
                $columns = array('idbook', 'idtag');
                $values = array($id,$value);
                $query2
                    ->insert($db->quoteName('#__abbooktag'))
                    ->columns($db->quoteName($columns))
                    ->values(implode(',', $values));
                $db->setQuery($query2);
                $db->execute();
                $ordercounter++;


            }


            $this->plugin->setResponse($result);
        }
        else{
            $this->plugin->setResponse($table->getError());

        }
    }
}
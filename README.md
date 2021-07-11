WORK IN PROGRESS
# Plugin to query Alexandria Book Library
Joomla plugin for com_api, allowing REST access to alexandriabooklibrary 
# Install
- Install com_api from techjoomla
- install the plugin
# Usage
Refer to the postman example in example
- GET categories: gets the categories from db by supplying the db fields from table abcategories as http GET arguments
- PUT category puts a new category in the tree as the last-child of the parent_id, requires authentication and the com api auth token generated and set as a bearer toekn

#  References
https://techjoomla.com/rest-api-for-joomla
https://docs.techjoomla.com/joomla-rest-api/com-api-plugin-development/


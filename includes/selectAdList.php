<?php
 
//LDAP Bind paramters, need to be a normal AD User account.
$ldap_password = 'Br0@dc@st';
$ldap_username = 'producao\administrator';
$ldap_connection = ldap_connect("producao.redemassa.com.br");
 
if (FALSE === $ldap_connection){
    // Uh-oh, something is wrong...
	echo 'Unable to connect to the ldap server';
}
 
// We have to set this option for the version of Active Directory we are using.
ldap_set_option($ldap_connection, LDAP_OPT_PROTOCOL_VERSION, 3) or die('Unable to set LDAP protocol version');
ldap_set_option($ldap_connection, LDAP_OPT_REFERRALS, 0); // We need this for doing an LDAP search.
 
if (TRUE === ldap_bind($ldap_connection, $ldap_username, $ldap_password)){
 
	//Your domains DN to query
    $ldap_base_dn = 'DC=producao,DC=redemassa,DC=com,DC=br';
	
	//Get standard users and contacts
    $search_filter = '(|(objectCategory=person)(objectCategory=contact))';
	
	//Connect to LDAP
	$result = ldap_search($ldap_connection, $ldap_base_dn, $search_filter);
	
    if (FALSE !== $result){
		$entries = ldap_get_entries($ldap_connection, $result);
		
		// Uncomment the below if you want to write all entries to debug somethingthing 
		//var_dump($entries);
		
		
 
?>
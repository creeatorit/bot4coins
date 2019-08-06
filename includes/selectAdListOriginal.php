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
		
		//Create a table to display the output 
		echo '<h2>Usuarios do AD Grupo Massa</h2></br>';
		echo '<table border = "1"><tr bgcolor="#cccccc"><td>Usuario</td><td>Ultimo Nome</td><td>Primeiro Name</td><td>Empresa</td><td>Departamento</td><td>Office Phone</td><td>Fax</td><td>Mobile</td><td>DDI</td><td>E-Mail Address</td><td>Home Phone</td></tr>';
		
		//For each account returned by the search
		for ($x=0; $x<$entries['count']; $x++){
			
			//
			//Retrieve values from Active Directory
			//
			
			//Windows Usernaame
			$LDAP_samaccountname = "";
			
			if (!empty($entries[$x]['samaccountname'][0])) {
				$LDAP_samaccountname = $entries[$x]['samaccountname'][0];
				if ($LDAP_samaccountname == "NULL"){
					$LDAP_samaccountname= "";
				}
			} else {
				//#There is no samaccountname s0 assume this is an AD contact record so generate a unique username
				
				$LDAP_uSNCreated = $entries[$x]['usncreated'][0];
				$LDAP_samaccountname= "CONTACT_" . $LDAP_uSNCreated;
			}
			
			//Last Name
			$LDAP_LastName = "";
			
			if (!empty($entries[$x]['sn'][0])) {
				$LDAP_LastName = $entries[$x]['sn'][0];
				if ($LDAP_LastName == "NULL"){
					$LDAP_LastName = "";
				}
			}
			
			//First Name
			$LDAP_FirstName = "";
			
			if (!empty($entries[$x]['givenname'][0])) {
				$LDAP_FirstName = $entries[$x]['givenname'][0];
				if ($LDAP_FirstName == "NULL"){
					$LDAP_FirstName = "";
				}
			}
			
			//Company
			$LDAP_CompanyName = "";
			
			if (!empty($entries[$x]['company'][0])) {
				$LDAP_CompanyName = $entries[$x]['company'][0];
				if ($LDAP_CompanyName == "NULL"){
					$LDAP_CompanyName = "";
				}
			}
			
			//Department
			$LDAP_Department = "";
			
			if (!empty($entries[$x]['department'][0])) {
				$LDAP_Department = $entries[$x]['department'][0];
				if ($LDAP_Department == "NULL"){
					$LDAP_Department = "";
				}
			}
			
			//Job Title
			$LDAP_JobTitle = "";
			
			if (!empty($entries[$x]['title'][0])) {
				$LDAP_JobTitle = $entries[$x]['title'][0];
				if ($LDAP_JobTitle == "NULL"){
					$LDAP_JobTitle = "";
				}
			}
			
			//IPPhone
			$LDAP_OfficePhone = "";
			
			if (!empty($entries[$x]['ipphone'][0])) {
				$LDAP_OfficePhone = $entries[$x]['ipphone'][0];
				if ($LDAP_OfficePhone == "NULL"){
					$LDAP_OfficePhone = "";
				}
			}
			
			//FAX Number
			$LDAP_OfficeFax = "";
			
			if (!empty($entries[$x]['facsimiletelephonenumber'][0])) {
				$LDAP_OfficeFax = $entries[$x]['facsimiletelephonenumber'][0];
				if ($LDAP_OfficeFax == "NULL"){
					$LDAP_OfficeFax = "";
				}
			}
			
			//Mobile Number
			$LDAP_CellPhone = "";
			
			if (!empty($entries[$x]['mobile'][0])) {
				$LDAP_CellPhone = $entries[$x]['mobile'][0];
				if ($LDAP_CellPhone == "NULL"){
					$LDAP_CellPhone = "";
				}
			}
			
			//Telephone Number
			$LDAP_DDI = "";
			
			if (!empty($entries[$x]['telephonenumber'][0])) {
				$LDAP_DDI = $entries[$x]['telephonenumber'][0];
				if ($LDAP_DDI == "NULL"){
					$LDAP_DDI = "";
				}
			}
			
			//Email address
			$LDAP_InternetAddress = "";
			
			if (!empty($entries[$x]['mail'][0])) {
				$LDAP_InternetAddress = $entries[$x]['mail'][0];	
				if ($LDAP_InternetAddress == "NULL"){
					$LDAP_InternetAddress = "";
				}
			}
			
			//Home phone
			$LDAP_HomePhone = "";
			
			if (!empty($entries[$x]['homephone'][0])) {
				$LDAP_HomePhone = $entries[$x]['homephone'][0];
				if ($LDAP_HomePhone == "NULL"){
					$LDAP_HomePhone = "";
				}
			}
			
			echo "<tr><td><strong>" . $LDAP_samaccountname ."</strong></td><td>" .$LDAP_LastName."</td><td>".$LDAP_FirstName."</td><td>".$LDAP_CompanyName."</td><td>".$LDAP_Department."</td><td>".$LDAP_OfficePhone."</td><td>".$LDAP_OfficeFax."</td><td>".$LDAP_CellPhone."</td><td>".$LDAP_DDI."</td><td>".$LDAP_InternetAddress."</td><td>".$LDAP_HomePhone."</td></tr>";
 
			
		} //END for loop
	} //END FALSE !== $result
	
	ldap_unbind($ldap_connection); // Clean up after ourselves.
	echo("</table>"); //close the table
 
} //END ldap_bind
 
?>
<?php

 
//LDAP Bind paramters, need to be a normal AD User account.
$ldap_password = 'Br0@dc@st';
$ldap_username = 'producao\administrator';
$$ds = ldap_connect("producao.redemassa.com.br");
 
if (FALSE === $$ds){
    // Uh-oh, something is wrong...
	echo 'Unable to connect to the ldap server';
}
 
// We have to set this option for the version of Active Directory we are using.
ldap_set_option($ldap_c$dsonnection, LDAP_OPT_PROTOCOL_VERSION, 3) or die('Unable to set LDAP protocol version');
ldap_set_option($$ds, LDAP_OPT_REFERRALS, 0); // We need this for doing an LDAP search.
 
if (TRUE === ldap_bind($$ds, $ldap_username, $ldap_password)){
 
	//Your domains DN to query
    $ldap_base_dn = 'DC=producao,DC=redemassa,DC=com,DC=br';
    
    
$AD_server = "10.17.4.20"; 

	
     $ldaprecord['objectclass'][0] = "inetorgperson";
     $ldaprecord['objectclass'][1] = "posixaccount";
     $ldaprecord['objectclass'][2] = "top";
     $ldaprecord['cn'] = 'netbeans';
     $ldaprecord['givenname'] = 'netbeans1';
     $ldaprecord['sn'] = 'netbeans2';
     $ldaprecord['mail'] = 'emai@gmail.com';
     $ldaprecord['mobile'] = '+91 1234567890';
     $ldaprecord['uid'] = 'nb';
     $ldaprecord['displayname'] = 'netbeans';
     $ldaprecord['uidnumber'] = '1005';
     $ldaprecord['gidnumber'] = '501';
     $ldaprecord['userpassword'] = "{crypt}123456";
     $ldaprecord['gecos'] = 'netbeans';
     $ldaprecord['loginshell'] = '/bin/sh';
     $ldaprecord['homedirectory'] = '/home/users/nb'; 
     $ldaprecord['shadowexpire'] = '-1';
     $ldaprecord['shadowflag'] = '0'; 
     $ldaprecord['shadowwarning'] = '7'; 
     $ldaprecord['shadowmin'] = '8'; 
     $ldaprecord['shadowmax'] = '999999';
     $ldaprecord['shadowlastchange'] = '10877';
     $ldaprecord['postalcode'] = '31000';
     $ldaprecord['l'] = 'toulouse';
     $ldaprecord['o'] = 'example';
     $ldaprecord['homephone'] = '+33 (0)40 35963258';
     $ldaprecord['title'] = 'system administrator'; 
     $ldaprecord['postaladdress'] = '';
     $ldaprecord['initials'] = 'jd';
     
		
		

		
		
		
// $ldaprecord["cn"] = "testuser";
// $ldaprecord["givenname"] = "Test";
// $ldaprecord["sn"] = "User";
// $ldaprecord["sAMAccountName"] = "testuser";
// $ldaprecord['userPrincipalName'] = "testuser@rndsw.com";
// $ldaprecord["objectClass"] = "user";
// $ldaprecord["displayname"] = "Test User";
// $ldaprecord["userPassword"] = "Password01";
// $ldaprecord["userAccountControl"] = "544";
 $base_dn = "DC=producao,DC=redemassa,DC=com,DC=br";
    $r = ldap_add($ds, $base_dn, $ldaprecord);
   if ($r)
   {
   echo 'Success';
   }
   else
   {
   echo ldap_errno($ds) ;
   }
} else {
    echo "cannot connect to LDAP server at $AD_server.";
}
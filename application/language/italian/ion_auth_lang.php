<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Ion Auth Lang - Italian
*
* Author: Salvo Cortesiano
* 		  salvocortesiano@netshadows.it
*         @netshadows.it
*
* Language file: "ion_auth_lang.php"
*
* Location: http://www.netshadows.it/forum/
*
* Created:  07.19.2016
*
* Description:  Italian language file for Ion Auth messages and errors
*
*/

// Account Creation
$lang['account_creation_successful']            = 'Account creato con successo';
$lang['account_creation_unsuccessful']          = 'Impossibile creare l’account';
$lang['account_creation_duplicate_email']       = 'E-mail già in uso o non valida';
$lang['account_creation_duplicate_identity']    = 'Identità già in uso o non valida';
$lang['account_creation_missing_default_group'] = 'Il Gruppo di default non è impostato';
$lang['account_creation_invalid_default_group'] = 'Il nome del Gruppo predefinito non è valido';


// Password
$lang['password_change_successful']          = 'Password cambiata con successo';
$lang['password_change_unsuccessful']        = 'Impossibile cambiare la Password';
$lang['forgot_password_successful']          = 'Cambio Password e-mail inviata';
$lang['forgot_password_unsuccessful']        = 'Impossibile reimpostare la Password';

// Activation
$lang['activate_successful']                 = 'Account Attivato';
$lang['activate_unsuccessful']               = 'Impossibile attivare l’account';
$lang['deactivate_successful']               = 'Account Disattivato';
$lang['deactivate_unsuccessful']             = 'Impossibile Disattivare l’account';
$lang['activation_email_successful']         = 'Attivazione e-mail inviata';
$lang['activation_email_unsuccessful']       = 'Non è stato possibile inviare l’e-mail di attivazione';

// Login / Logout
$lang['login_successful']                    = 'Accesso effettuato con successo';
$lang['login_unsuccessful']                  = 'Accesso Errato';
$lang['login_unsuccessful_not_active']       = 'L’account non è attivo';
$lang['login_timeout']                       = 'Temporaneamente bloccato. Riprovare più tardi.';
$lang['logout_successful']                   = 'Disconnesso con successo';

// Account Changes
$lang['update_successful']                   = 'Informazioni account aggiornate con successo';
$lang['update_unsuccessful']                 = 'Inpossibile aggiornare le informazioni dell’account';
$lang['delete_successful']                   = 'Utente Cancellato';
$lang['delete_unsuccessful']                 = 'Impossibile cancellare l’utente';

// Groups
$lang['group_creation_successful']           = 'Gruppo creato con successo';
$lang['group_already_exists']                = 'Nome gruppo già preso';
$lang['group_update_successful']             = 'Dettagli Gruppo aggiornati';
$lang['group_delete_successful']             = 'Gruppo cancellato';
$lang['group_delete_unsuccessful']           = 'Impossibile eliminare il gruppo';
$lang['group_delete_notallowed']             = 'Non puoi eliminare il Gruppo Amministratori';
$lang['group_name_required']                 = 'Nome del gruppo è un campo obbligatorio';
$lang['group_name_admin_not_alter']          = 'Il nome del Gruppo Amministratori non può essere modificato';

// Activation Email
$lang['email_activation_subject']            = 'Attivazione dell’account';
$lang['email_activate_heading']              = 'Attiva account per %s';
$lang['email_activate_subheading']           = 'Sei pregato di fare clic su questo link per %s.';
$lang['email_activate_link']                 = 'Attiva il tuo account';

// Forgot Password Email
$lang['email_forgotten_password_subject']    = 'Verifica password dimenticata';
$lang['email_forgot_password_heading']       = 'Reimpostazione password per %s';
$lang['email_forgot_password_subheading']    = 'Sei pregato di fare clic su questo link per %s.';
$lang['email_forgot_password_link']          = 'Reimposta la tua password';

// New Password Email
$lang['email_new_password_subject']          = 'Nuova Password';
$lang['email_new_password_heading']          = 'Nuova Password per %s';
$lang['email_new_password_subheading']       = 'La password è stata ripristinata per: %s';

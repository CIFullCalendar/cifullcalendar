<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Auth Lang - Italian
*
* Author: Salvo Cortesiano
* 		  salvocortesiano@netshadows.it
*         @netshadows.it
*
* Language file: "auth_lang.php"
*
* Location: http://www.netshadows.it/forum/
*
* Created:  07.19.2016
*
* Description:  Italian language file for Ion Auth example views
*
*/

// Errors
$lang['error_csrf'] = 'Questo post non ha superato il controllo di sicurezza.';

// Login
$lang['login_heading']         = 'Accesso';
$lang['login_subheading']      = 'Effettua il login con la tua e-mail/username e password qui sotto.';
$lang['login_identity_label']  = 'Email/Username:';
$lang['login_password_label']  = 'Password:';
$lang['login_remember_label']  = 'Ricordami:';
$lang['login_submit_btn']      = 'Accedi';
$lang['login_forgot_password'] = 'Hai dimenticato la password?';

// Index
$lang['index_heading']           = 'Utenti';
$lang['index_subheading']        = 'Di seguito l’elenco degli utenti.';
$lang['index_fname_th']          = 'Nome';
$lang['index_lname_th']          = 'Cognome';
$lang['index_email_th']          = 'Email';
$lang['index_groups_th']         = 'Gruppo';
$lang['index_status_th']         = 'Stato';
$lang['index_action_th']         = 'Azione';
$lang['index_active_link']       = 'Attivo';
$lang['index_inactive_link']     = 'Inattivo';
$lang['index_create_user_link']  = 'Crea nuovo utente';
$lang['index_create_group_link'] = 'Crea nuovo gruppo';

// Deactivate User
$lang['deactivate_heading']                  = 'Disattiva Utente';
$lang['deactivate_subheading']               = 'Sei sicuro di voler disattivare l’utente \'%s\'';
$lang['deactivate_confirm_y_label']          = 'Si:';
$lang['deactivate_confirm_n_label']          = 'No:';
$lang['deactivate_submit_btn']               = 'Esegui';
$lang['deactivate_validation_confirm_label'] = 'conferma';
$lang['deactivate_validation_user_id_label'] = 'ID utente';

// Create User
$lang['create_user_heading']                           = 'Crea Utente';
$lang['create_user_subheading']                        = 'Sei pregato di inserire le informazioni dell’utente di seguito:';
$lang['create_user_fname_label']                       = 'Nome:';
$lang['create_user_lname_label']                       = 'Cognome:';
$lang['create_user_company_label']                     = 'Nome della Società:';
$lang['create_user_identity_label']                    = 'Identità:';
$lang['create_user_email_label']                       = 'Email:';
$lang['create_user_phone_label']                       = 'Telefono:';
$lang['create_user_password_label']                    = 'Password:';
$lang['create_user_password_confirm_label']            = 'Conferma Password:';
$lang['create_user_submit_btn']                        = 'Crea Utente';
$lang['create_user_validation_fname_label']            = 'Nome';
$lang['create_user_validation_lname_label']            = 'Cognome';
$lang['create_user_validation_identity_label']         = 'Identità';
$lang['create_user_validation_email_label']            = 'Indirizzo Email';
$lang['create_user_validation_phone_label']            = 'Telefono';
$lang['create_user_validation_company_label']          = 'Nome della Società';
$lang['create_user_validation_password_label']         = 'Password';
$lang['create_user_validation_password_confirm_label'] = 'Conferma Password';

// Edit User
$lang['edit_user_heading']                           = 'Modifica Utente';
$lang['edit_user_subheading']                        = 'Sei pregato di inserire le informazioni dell’utente da modificare di seguito.';
$lang['edit_user_fname_label']                       = 'Nome:';
$lang['edit_user_lname_label']                       = 'Cognome:';
$lang['edit_user_company_label']                     = 'Nome della Società:';
$lang['edit_user_email_label']                       = 'Email:';
$lang['edit_user_phone_label']                       = 'Telefono:';
$lang['edit_user_password_label']                    = 'Password: (soltanto se modifichi anche la password)';
$lang['edit_user_password_confirm_label']            = 'Conferma Password: (soltanto se modifichi anche la password)';
$lang['edit_user_groups_heading']                    = 'Membro del Gruppo';
$lang['edit_user_submit_btn']                        = 'Salva Utente';
$lang['edit_user_validation_fname_label']            = 'Nome';
$lang['edit_user_validation_lname_label']            = 'Cognome';
$lang['edit_user_validation_email_label']            = 'Indirizzo Email';
$lang['edit_user_validation_phone_label']            = 'Telefono';
$lang['edit_user_validation_company_label']          = 'Nome della Società';
$lang['edit_user_validation_groups_label']           = 'Gruppo';
$lang['edit_user_validation_password_label']         = 'Password';
$lang['edit_user_validation_password_confirm_label'] = 'Conferma Password';

// Create Group
$lang['create_group_title']                  = 'Crea Gruppo';
$lang['create_group_heading']                = 'Creazione Nuovo Gruppo';
$lang['create_group_subheading']             = 'Sei pregato di inserire le informazioni del Gruppo di seguito:';
$lang['create_group_name_label']             = 'Nome Gruppo:';
$lang['create_group_desc_label']             = 'Descrizione:';
$lang['create_group_submit_btn']             = 'Crea Gruppo';
$lang['create_group_validation_name_label']  = 'Nome Gruppo';
$lang['create_group_validation_desc_label']  = 'Descrizione';

// Edit Group
$lang['edit_group_title']                  = 'Modifica Gruppo';
$lang['edit_group_saved']                  = 'Salva Gruppo';
$lang['edit_group_heading']                = 'Modifica Gruppo';
$lang['edit_group_subheading']             = 'Sei pregato di inserire le informazioni del Gruppo di seguito:';
$lang['edit_group_name_label']             = 'Nome Gruppo:';
$lang['edit_group_desc_label']             = 'Descrizione:';
$lang['edit_group_submit_btn']             = 'Salva Gruppo';
$lang['edit_group_validation_name_label']  = 'Nome Gruppo';
$lang['edit_group_validation_desc_label']  = 'Descrizione';

// Change Password
$lang['change_password_heading']                               = 'Cambia Password';
$lang['change_password_old_password_label']                    = 'Vecchia Password:';
$lang['change_password_new_password_label']                    = 'Nuova Password (deve contenere almeno %s caratteri):';
$lang['change_password_new_password_confirm_label']            = 'Conferma Nuova Password:';
$lang['change_password_submit_btn']                            = 'Cambia';
$lang['change_password_validation_old_password_label']         = 'Vecchia Password';
$lang['change_password_validation_new_password_label']         = 'Nuova Password';
$lang['change_password_validation_new_password_confirm_label'] = 'Conferma Nuova Password';

// Forgot Password
$lang['forgot_password_heading']                 = 'Ha dimenticato la password';
$lang['forgot_password_subheading']              = 'Per faore inserisci il tuo %s in modo che possiamo inviarti una e-mail per reimpostare la Password.';
$lang['forgot_password_email_label']             = '%s:';
$lang['forgot_password_submit_btn']              = 'Invia';
$lang['forgot_password_validation_email_label']  = 'Indirizzo Email';
$lang['forgot_password_identity_label'] 		 = 'Identità';
$lang['forgot_password_email_identity_label']    = 'Email';
$lang['forgot_password_email_not_found']         = 'Nessun indirizzo e-mail nel data-base.';

// Reset Password
$lang['reset_password_heading']                               = 'Cambia Password';
$lang['reset_password_new_password_label']                    = 'Nuova Password (deve contenere almeno %s caratteri):';
$lang['reset_password_new_password_confirm_label']            = 'Conferma Nuova Password:';
$lang['reset_password_submit_btn']                            = 'Cambia';
$lang['reset_password_validation_new_password_label']         = 'Nuova Password';
$lang['reset_password_validation_new_password_confirm_label'] = 'Conferma Nuova Password';

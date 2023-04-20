<?php
/**
 * Plugin Name:     Ultimate Member - Additional Email Recipients
 * Description:     Extension to Ultimate Member for additional CC: and BCC: to UM Notification Emails and replacement address for User email. Additional CC: email addresses depending on meta field values.
 * Version:         2.1.0
 * Requires PHP:    7.4
 * Author:          Miss Veronica
 * License:         GPL v2 or later
 * License URI:     https://www.gnu.org/licenses/gpl-2.0.html
 * Author URI:      https://github.com/MissVeronica
 * Text Domain:     ultimate-member
 * Domain Path:     /languages
 * UM version:      2.3.2
 */

if ( ! defined( 'ABSPATH' ) ) exit; 
if ( ! class_exists( 'UM' ) ) return;


class UM_Additional_Email_Recipients {

    public $template = '';
    public $registration_user_id = '';
    public $email_options = array( '_custom_cc'  => 'cc: ', 
                                   '_custom_bcc' => 'Bcc: ' );

    function __construct() {

        add_filter( 'wp_mail',                                array( $this, 'my_um_add_email_recipients' ), 10, 1 );
        add_action( 'um_before_email_notification_sending',   array( $this, 'my_um_add_email_recipients_setup' ), 10, 3 );
        add_filter( 'um_admin_settings_email_section_fields', array( $this, 'um_admin_settings_email_section_email_recipients' ), 10, 2 );
        add_action( 'um_registration_set_extra_data',         array( $this, 'um_registration_set_extra_data_email_recipients' ), 10, 2 );        
    }

    public function my_um_add_email_recipients( $args ) {

        if ( ! empty( $this->template ) && ! empty( $this->registration_user_id )) {

            $custom_meta_key = trim( sanitize_text_field( UM()->options()->get( $this->template . '_custom_meta_key' )));
            $custom_email = '';

            if ( ! empty( $custom_meta_key )) {

                um_fetch_user( $this->registration_user_id );
                $form_field_value = um_user( $custom_meta_key );

                if ( ! empty( $form_field_value )) {

                    $custom_meta_key_emails = array_map( 'trim', explode( "\n", UM()->options()->get( $this->template . '_custom_meta_key_emails' )));

                    if ( is_array( $custom_meta_key_emails )) {

                        foreach( $custom_meta_key_emails as $custom_meta_key_email ) {
                            $field_email_pair = array_map( 'trim', explode( ':', $custom_meta_key_email ));

                            if( $field_email_pair[0] == $form_field_value ) {

                                if ( ! empty( $field_email_pair[1] )) {
                                    $custom_email = $field_email_pair[1];
                                }
                                break;
                            }
                        }
                    }
                }
            }

            foreach( $this->email_options as $option => $carbon_copy ) {

                $emails = trim( UM()->options()->get( $this->template . $option ));

                if ( $option == '_custom_cc' ) {
                    if ( ! empty( $emails )) {
                        $emails .= ',';
                    }
                    $emails .= $custom_email;
                }

                if ( ! empty( $emails )) {

                    $emails = array_map( 'trim', explode( ',', $emails ));
                    foreach( $emails as $email ) {

                        $email = filter_var( sanitize_email( $email ), FILTER_VALIDATE_EMAIL );
                        if ( ! empty( $email )) {

                            if ( is_array( $args['headers'] )) {
                                $args['headers'][] = $carbon_copy . $email;

                            } else {

                                $args['headers'] .= $carbon_copy . $email . "\r\n";
                            }
                        }
                    }
                }
            }

            $replace_email = trim( UM()->options()->get( $this->template . '_custom_replace_email' ));
            if ( ! empty( $replace_email )) {

                $replace_email = filter_var( sanitize_email( $replace_email ), FILTER_VALIDATE_EMAIL );
                if ( ! empty( $replace_email )) {
                    $args['to'] = $replace_email;
                }
            }
        }

        return $args;
    }

    public function um_admin_settings_email_section_email_recipients( $section_fields, $email_key ) {

        $section_fields[] = array(
                    'id'            => $email_key . '_custom_cc',
                    'type'          => 'text',
                    'label'         => __( 'Additional Email Recipients - cc:', 'ultimate-member' ),
                    'conditional'   => array( $email_key . '_on', '=', 1 ),
                    'tooltip'       => __( 'Comma separated e-mail adresses', 'ultimate-member' )
                );

        $section_fields[] = array(
                    'id'            => $email_key . '_custom_bcc',
                    'type'          => 'text',
                    'label'         => __( 'Additional Email Recipients - Bcc:', 'ultimate-member' ),
                    'conditional'   => array( $email_key . '_on', '=', 1 ),
                    'tooltip'       => __( 'Comma separated e-mail adresses', 'ultimate-member' )
                );

        $section_fields[] = array(
                    'id'            => $email_key . '_custom_replace_email',
                    'type'          => 'text',
                    'label'         => __( 'Additional Email Recipients - Replacement UM User email address', 'ultimate-member' ),
                    'conditional'   => array( $email_key . '_on', '=', 1 ),
                    'tooltip'       => __( 'Replacement e-mail address instead of UM User email', 'ultimate-member' )
                );

        $section_fields[] = array(
                    'id'            => $email_key . '_custom_meta_key',
                    'type'          => 'text',
                    'size'          => 'small',
                    'label'         => __( 'Additional Email Recipients - Meta Key for Field additional cc: email', 'ultimate-member' ),
                    'conditional'   => array( $email_key . '_on', '=', 1 ),
                    'tooltip'       => __( 'Enter the meta_key name for Form field value dependent for an additional cc: email', 'ultimate-member' )
                );

        $section_fields[] = array(
                    'id'            => $email_key . '_custom_meta_key_emails',
                    'type'          => 'textarea',
                    'size'          => 'medium',
                    'label'         => __( 'Additional Email Recipients - Form Field value : Email address', 'ultimate-member' ),
                    'conditional'   => array( $email_key . '_on', '=', 1 ),
                    'tooltip'       => __( 'Enter the relation for Form field values for an additional cc: email address colon separated and one pair per line', 'ultimate-member' )
                );

        return $section_fields;
    }

    public function my_um_add_email_recipients_setup( $email, $template, $args ) {

        if ( ! empty( $email ) && ! empty( $template ) ) {

            $this->template = $template;
        }
    }

    public function um_registration_set_extra_data_email_recipients( $user_id, $args ) {

        $this->registration_user_id = $user_id;
    }

}

new UM_Additional_Email_Recipients();


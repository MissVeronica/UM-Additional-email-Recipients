<?php


add_filter( 'wp_mail', 'my_um_add_email_recipients', 10, 1 );

function my_um_add_email_recipients( $args ) {

    $template = get_transient( "my_um_email_recipients_template_" . $args['to'] );
    if( !empty( $template )) {
        delete_transient( "my_um_email_recipients_template_" . $args['to'] );

        $email_options = array( '_custom_cc' => 'cc: ', '_custom_bcc' => 'Bcc: ' );        
        foreach( $email_options as $option => $carbon_copy ) {

            $emails = UM()->options()->get( $template . $option );            
            if( !empty( $emails )) {
                
                $emails = explode( ',', $emails );                
                foreach( $emails as $email ) {
                    
                    $email = filter_var( sanitize_email( $email ), FILTER_VALIDATE_EMAIL );                    
                    if( !empty( $email )) {
                        
                        if( is_array( $args['headers'] )) {
                            $args['headers'][] = $carbon_copy . $email;
                        } else {
                            $args['headers'] .= $carbon_copy . $email . "\r\n";
                        }
                    }
                }
            }
        }
    }

    return $args;
}

add_filter( 'um_admin_settings_email_section_fields', 'um_admin_settings_email_section_fields_custom', 10, 2 );

function um_admin_settings_email_section_fields_custom( $section_fields, $email_key ) {

    $section_fields[] = array(
            'id'            => $email_key . '_custom_cc',
            'type'          => 'text',
            'label'         => __( 'Additional recipients cc:', 'ultimate-member' ),
            'conditional'   => array( $email_key . '_on', '=', 1 ),
            'tooltip'       => __( 'Comma separated e-mail adresses', 'ultimate-member' )
            );

    $section_fields[] = array(
            'id'            => $email_key . '_custom_bcc',
            'type'          => 'text',
            'label'         => __( 'Additional recipients Bcc:', 'ultimate-member' ),
            'conditional'   => array( $email_key . '_on', '=', 1 ),
            'tooltip'       => __( 'Comma separated e-mail adresses', 'ultimate-member' )
            );

    return $section_fields;
}

add_action( 'um_before_email_notification_sending', 'my_um_add_email_recipients_setup', 10, 3 );

function my_um_add_email_recipients_setup( $email, $template, $args ) {

    if( !empty( $email ) && !empty( $template ) ) {
        set_transient( "my_um_email_recipients_template_" . $email, $template, 60 );
    }
}

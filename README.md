# UM Additional email Recipients
Extension to Ultimate Member for additional CC: and BCC: to UM Notification Emails and replacement address for User email. Additional CC: email addresses depending on a meta field value. Addition of cc: or Bcc: email to all Users with selected Roles.

## UM Settings - All settings at each UM Settings -> Email -> Email template
1. Additional Email Recipients - cc: - Comma separated e-mail adresses
2. Additional Email Recipients - Bcc: - Comma separated e-mail adresses
3. Additional Email Recipients - Extra UM User email address - Extra e-mail address meta_key to be used instead of UM User email
4. Additional Email Recipients - Send to both Extra and UM User email address - Click to send to both Extra e-mail and UM User email address
5. Additional Email Recipients - Meta Key for Field additional cc: email - Enter the meta_key name for Form field value dependent for an additional cc: email
6. Additional Email Recipients - Form Field value : Email address - Enter the relation for Form field values for an additional cc: email address colon separated and one pair per line
7. Additional Email Recipients - Users with Roles - Select the Role names for additional cc: or Bcc: emails.
8. Additional Email Recipients - Users with Roles Bcc: - Click to send to Users with selected Roles as Bcc: email, unclick for cc: email

## Functions for all active UM Notification emails
1. Settings number 1 and 2 for adding cc: and Bcc: emails.
2. Settings number 3 and 4 to replace the default UM user email with meta_key user_email and if emails should be sent to the extra email or both adresses.
3. Settings number 5 and 6 to select a User meta key field value to use for selecting one email address list from additional list of CC: email adresses where field value and email addresses are : separated and one list per line. Email list must be comma separated like value:email1@address.com,email2@address.com

## Mail tests
1. Tested with standard WP Mail and SMTP via the "Post SMTP Mailer/Email Log" Plugin:
2. https://wordpress.org/plugins/post-smtp/

## Updates
1. Version 1.2.0 Replacement of User email with a default e-mail address added in UM Email Settings for each notification email.
2. Version 2.0.0 Addition of a meta_key field value to select additional CC: email adresses.
3. Version 2.1.0 Bug fixing
4. Version 2.2.0 Bug fixing
5. Version 2.3.0 Addition of chackbox for usage of "Extra UM User email address"
6. Version 3.0.0 Addition of cc: or Bcc: email to all Users with a selected Role.
7. Version 3.1.0 Addition of cc: or Bcc: email to all Users with selected Roles.
8. Version 3.2.0 Updated for UM 2.8.3

## Installation
1. Install by downloading the plugin ZIP file and install as a new Plugin, which you upload in WordPress -> Plugins -> Add New -> Upload Plugin.
2. Activate the Plugin: Ultimate Member - Additional Email Recipients

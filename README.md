# UM Additional email Recipients
Extension to Ultimate Member for additional CC: and BCC: to UM Notification Emails and replacement address for User email. 

Additional CC: email addresses depending on a meta field value. Addition of cc: or Bcc: email to all Users with selected Roles. 

Admin addressed emails can also get a Reply to address to the User. 

Account page user updated email address may get an email also to the old address.

## UM Settings - All settings at each UM Settings -> Email -> Email template
1. Additional Email Recipients - cc: - Comma separated e-mail adresses
2. Additional Email Recipients - Bcc: - Comma separated e-mail adresses
3. Additional Email Recipients - Extra UM User email address - Extra email address meta_key to be used instead of UM User email
4. Additional Email Recipients - Send to both Extra and UM User email address - Click to send to both Extra email and UM User email address
5. Additional Email Recipients - Meta Key for Field additional cc: email - Enter the meta_key name for Form field value dependent for an additional cc: email
6. Additional Email Recipients - Form Field value : Email address - Enter the relation for Form field values for an additional cc: email address colon separated and one pair per line
7. Additional Email Recipients - Users with Roles - Select the Role names for additional cc: or Bcc: emails.
8. Additional Email Recipients - Users with Roles Bcc: - Click to send to Users with selected Roles as Bcc: email, unclick for cc: email
9. Additional Email Recipients - Account page User's email address update - Click to also send email to the User's old email address when email is changed at the Account page.
10. Additional Email Recipients - Add an email "Reply to" address - Click to add the User's email address and user_login name as the "Reply to" address

## Functions for all active UM Notification emails
1. Settings number 1 and 2 for adding cc: and Bcc: emails.
2. Settings number 3 and 4 to replace the default UM user email with meta_key user_email and if emails should be sent to the extra email or both adresses.
3. Settings number 5 and 6 to select a User meta key field value to use for selecting one email address list from additional list of CC: email adresses where field value and email addresses are : separated and one list per line. Email list must be comma separated like value:email1@address.com,email2@address.com
4. Settings number 9 only for the "changedaccount_email" template "Account Updated Email"
5. Settings number 10 for all Notication emails addressed to Admin except the "Security: Suspicious Account Activity" email.

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
9. Version 3.3.0 Addition of the UM Settings number 9 and 10.
10. Version 3.3.1 Code improvements
11. Version 3.3.2 Code improvements

## Installation
1. Install by downloading the plugin ZIP file and install as a new Plugin, which you upload in WordPress -> Plugins -> Add New -> Upload Plugin.
2. Activate the Plugin: Ultimate Member - Additional Email Recipients

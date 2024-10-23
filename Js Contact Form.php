<?php
/*
Plugin Name: Just Simple Contact Form
Plugin URI: https://cxrana.wordpress.com/
Description: A Multi-Step, Lightweight, Complete WordPress Contact Plugin with Customizable Labels, Email Setup, Placeholders, and Styling. Supports attachments, Custom CSS, and more—all from the dashboard.
Version: 1.2
Author: Anowar Hossain Rana
Author URI: https://cxrana.wordpress.com/
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

// Prevent direct access to the file
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
// Include the multi-step settings file
require_once plugin_dir_path(__FILE__) . 'js-contact-form-multistep-settings.php';


// Add a settings menu for the plugin and the multi-step settings
function js_contact_form_settings_menu() {
    // Add the parent menu
    add_menu_page(
        'Just Simple Contact Form', // Page title
        'Just Simple Contact Form', // Menu title
        'manage_options', // Capability
        'js-contact-form', // Menu slug
        'js_contact_form_settings_page', // Function to display the main settings page
        'dashicons-email', // Icon (you can change this to any WordPress dashicon)
        90 // Position in the menu
    );

    // Add the multi-step settings page as a submenu under the parent
    add_submenu_page(
        'js-contact-form', // Parent slug
        'Multi-Step Settings', // Page title
        'Multi-Step Settings', // Menu title
        'manage_options', // Capability
        'js-contact-form-multistep', // Menu slug
        'js_contact_form_multistep_settings_page' // Function to display the multi-step settings page
    );
}
add_action('admin_menu', 'js_contact_form_settings_menu');


// Create the settings page content
function js_contact_form_settings_page() {
    ?>
    <div class="wrap">
        <h1>JS Contact Form Settings</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('js_contact_form_settings_group');
            do_settings_sections('js-contact-form');
            submit_button();
            ?>
        </form>
   <!-- Developer Credit Section -->
     <div class="shorts">
    use the code in any page </br> [contact_form]
	</div>
        <div class="ecmt-credit">
            <div class="ecmt-credit-bar"></div>
            <h2 class="ecmt-subheading">Developer Credit</h2>
            <div class="wp-ecmt-social-icons">
                Contact with the developer via WhatsApp -
                <a href="https://wa.me/+8801811355151" class="social-icon whatsapp-icon"><i class="dashicons dashicons-whatsapp"></i></a>
                <a href="https://facebook.com/cxrana" class="social-icon facebook-icon"><i class="dashicons dashicons-facebook-alt"></i></a>
                <a href="https://www.linkedin.com/in/ahrana/" class="social-icon linkedin-icon"><i class="dashicons dashicons-linkedin"></i></a>
                <a href="https://cxrana.wordpress.com/" class="social-icon wordpress-icon"><i class="dashicons dashicons-wordpress"></i></a>
            </div>
            <!-- Developer Logo -->
            <div class="ecmt-developer-logo">
                <a href="https://cxrana.wordpress.com/">
                    <img src="<?php echo plugin_dir_url(__FILE__) . 'learn-with-rana.png'; ?>" alt="Learn with Rana">
                </a>
            </div>
        </div>

        <style>
		
		.shorts {
    background-color: #f5f5f5; /* Light gray background to resemble code blocks */
    padding: 20px;
    border-left: 5px solid #0073aa; /* Blue border to highlight the block */
    font-family: "Courier New", Courier, monospace; /* Monospace font to resemble code */
    font-size: 16px;
    color: #333; /* Dark text color */
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Slight shadow for a subtle elevation effect */
}

.shorts code {
    background-color: #eee; /* Light background for inline code */
    padding: 3px 5px;
    border-radius: 3px;
    font-size: 14px;
    color: #d6336c; /* Red color for the shortcode text */
}

.shorts br {
    display: block;
    margin-bottom: 10px; /* Adds spacing after line breaks */
}

		
	.form-table td p {
    margin-top: 4px;
    margin-bottom: 0;
    width: 150px;
			}

	.input.large-text,textarea.large-text {
		width: 60%;
			}
		.wrap {
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 8px;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    margin-bottom: 40px;
			}
            .wp-ecmt-social-icons {
                margin-top: 30px;
                display: flex;
                align-items: center;
            }

            .wp-ecmt-social-icons .social-icon {
                font-size: 24px;
                margin-right: 15px;
                transition: color 0.3s, transform 0.3s;
                text-decoration: none; /* Remove underline */
            }

            .wp-ecmt-social-icons .social-icon:hover {
                transform: scale(1.2);
            }

            .whatsapp-icon {
                color: #25D366;
            }

            .facebook-icon {
                color: #4267B2;
            }

            .linkedin-icon {
                color: #0A66C2;
            }

            .wordpress-icon {
                color: #21759B;
            }

            .whatsapp-icon:hover {
                color: #128C7E;
            }

            .facebook-icon:hover {
                color: #3B5998;
            }

            .linkedin-icon:hover {
                color: #0A43A6;
            }

            .wordpress-icon:hover {
                color: #1E7C8C;
            }

            .ecmt-credit {
                margin-top: 40px;
                padding: 10px;
                background-color: #f1f1f1;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                position: relative;
            }

            .ecmt-credit-bar {
                height: 5px;
                background: linear-gradient(90deg, #25D366, #4267B2, #0A66C2, #21759B);
                border-radius: 5px;
                margin-bottom: 15px;
            }

            .ecmt-heading {
                font-size: 24px;
                margin-bottom: 20px;
            }

            .ecmt-subheading {
                font-size: 20px;
                margin-top: 40px;
                margin-bottom: 20px;
            }

            .ecmt-form {
                background-color: #f9f9f9;
                padding: 20px;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            .ecmt-table th {
                width: 250px;
            }

            .ecmt-select, .ecmt-file-input, .ecmt-input {
                width: 100%;
            }

            .ecmt-button {
                background-color: #0073aa;
                border-color: #0073aa;
                color: #fff;
            }

            .ecmt-button:hover {
                background-color: #006799;
                border-color: #006799;
            }

            .ecmt-success-message {
                margin-top: 20px;
                padding: 10px;
                background-color: #dff0d8;
                border-left: 4px solid #d0e9c6;
            }

            .ecmt-warning-message {
                margin-top: 20px;
                padding: 10px;
                background-color: #fff3cd;
                border-left: 4px solid #ffeeba;
            }

            .ecmt-developer-logo {
                position: absolute;
                top: 20px;
                right: 20px;
                width: 100px; /* Adjust the width */
                height: 100px; /* Adjust the height */
                overflow: hidden;
            }

            .ecmt-developer-logo img {
                width: 100%;
                height: auto;
            }
        </style>
    </div>
    <?php
}

// Register settings and fields
function js_contact_form_register_settings() {
    register_setting('js_contact_form_settings_group', 'js_contact_form_email');
    register_setting('js_contact_form_settings_group', 'js_contact_form_css');
    register_setting('js_contact_form_settings_group', 'js_contact_form_labels');
    register_setting('js_contact_form_settings_group', 'js_contact_form_header');
    register_setting('js_contact_form_settings_group', 'js_contact_form_footer');
    register_setting('js_contact_form_settings_group', 'js_contact_form_show_placeholders');

    add_settings_section(
        'js_contact_form_main_section',
        'Contact Form Settings',
        null,
        'js-contact-form'
    );

    add_settings_field(
        'js_contact_form_email',
        'Contact Form Email',
        'js_contact_form_email_field',
        'js-contact-form',
        'js_contact_form_main_section'
    );

    add_settings_field(
        'js_contact_form_css',
        'Custom CSS',
        'js_contact_form_css_field',
        'js-contact-form',
        'js_contact_form_main_section'
    );

    add_settings_field(
        'js_contact_form_labels',
        'Form Field Labels',
        'js_contact_form_labels_field',
        'js-contact-form',
        'js_contact_form_main_section'
    );

    add_settings_field(
        'js_contact_form_header',
        'Email Header',
        'js_contact_form_header_field',
        'js-contact-form',
        'js_contact_form_main_section'
    );

    add_settings_field(
        'js_contact_form_footer',
        'Email Footer',
        'js_contact_form_footer_field',
        'js-contact-form',
        'js_contact_form_main_section'
    );

    add_settings_field(
        'js_contact_form_show_placeholders',
        'Show Form Placeholders',
        'js_contact_form_show_placeholders_field',
        'js-contact-form',
        'js_contact_form_main_section'
    );
}
add_action('admin_init', 'js_contact_form_register_settings');

// Settings field callbacks
function js_contact_form_email_field() {
    $email = get_option('js_contact_form_email', 'yourname@mail.com');
    echo '<input type="email" name="js_contact_form_email" value="' . esc_attr($email) . '" class="regular-text">';
}

function js_contact_form_css_field() {
    $default_css = '
        /* Contact Form Container */
		
        #cform {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #18bd9d;
            border-radius: 8px;
            background-color: #f9f9f9;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        /* Success Message */
        #cform p.success {
            color: #28a745;
            font-size: 16px;
            margin-bottom: 20px;
        }
        
        /* Form Elements */
        #cform form {
            display: flex;
            flex-direction: column;
        }
        
        /* Form Field */
        #cform input[type="text"],
        #cform textarea,
        #cform input[type="file"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            box-sizing: border-box;
        }
        
        #cform textarea {
            resize: vertical;
        }
        
        /* Labels */
        #cform label {
            font-size: 16px;
            color: #333;
            margin-bottom: 5px;
            display: block;
        }
        
        /* Submit Button */
        #cform input[type="submit"] {
            background-color: #0073aa;
            color: #fff;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 10px;
        }
        
        #cform input[type="submit"]:hover {
            background-color: #005177;
        }
        
        /* File Input */
        #cform input[type="file"] {
            padding: 0;
        }
        
        /* Error Messages */
        #cform .error {
            color: #dc3545;
            font-size: 14px;
            margin-top: -10px;
            margin-bottom: 10px;
        }
        
        /* Additional Styles */
        .contact-form {
            margin-top: 20px;
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            #cform {
                padding: 15px;
            }
            
            #cform input[type="text"],
            #cform textarea {
                font-size: 14px;
            }
    
            #cform input[type="submit"] {
                font-size: 14px;
                padding: 10px 18px;
            }
        }
    ';
    $css = get_option('js_contact_form_css', $default_css);
    echo '<textarea name="js_contact_form_css" rows="10" cols="50" class="large-text code">' . esc_textarea($css) . '</textarea>';
}

function js_contact_form_labels_field() {
    $labels = get_option('js_contact_form_labels', [
        'author' => 'Your Name *',
        'email' => 'Email *',
        'subject' => 'Subject *',
        'message' => 'Message *',
        'attachment' => 'File/Photos'
    ]);
    ?>
    <p><label for="author_label">Name Label:</label>
    <input type="text" id="author_label" name="js_contact_form_labels[author]" value="<?php echo esc_attr($labels['author']); ?>" class="regular-text"></p>
    <p><label for="email_label">Email Label:</label>
    <input type="text" id="email_label" name="js_contact_form_labels[email]" value="<?php echo esc_attr($labels['email']); ?>" class="regular-text"></p>
    <p><label for="subject_label">Subject Label:</label>
    <input type="text" id="subject_label" name="js_contact_form_labels[subject]" value="<?php echo esc_attr($labels['subject']); ?>" class="regular-text"></p>
    <p><label for="message_label">Message Label:</label>
    <input type="text" id="message_label" name="js_contact_form_labels[message]" value="<?php echo esc_attr($labels['message']); ?>" class="regular-text"></p>
    <p><label for="attachment_label">Attachment Label:</label>
    <input type="text" id="attachment_label" name="js_contact_form_labels[attachment]" value="<?php echo esc_attr($labels['attachment']); ?>" class="regular-text"></p>
    <?php
}

function js_contact_form_header_field() {
    $header = get_option('js_contact_form_header', '');
    wp_editor($header, 'js_contact_form_header', array(
        'textarea_name' => 'js_contact_form_header',
        'media_buttons' => false, // Set to true if you want media buttons
        'textarea_rows' => 5,
        'teeny' => true, // Use the minimal editor toolbar
        'quicktags' => false, // Disable quicktags if not needed
    ));
}

function js_contact_form_footer_field() {
    $footer = get_option('js_contact_form_footer', '');
    wp_editor($footer, 'js_contact_form_footer', array(
        'textarea_name' => 'js_contact_form_footer',
        'media_buttons' => false, // Set to true if you want media buttons
        'textarea_rows' => 5,
        'teeny' => true, // Use the minimal editor toolbar
        'quicktags' => false, // Disable quicktags if not needed
    ));
}



function js_contact_form_show_placeholders_field() {
    $show_placeholders = get_option('js_contact_form_show_placeholders', 'yes');
    ?>
    <fieldset>
        <label for="show_placeholders_yes">
            <input type="radio" id="show_placeholders_yes" name="js_contact_form_show_placeholders" value="yes" <?php checked($show_placeholders, 'yes'); ?>>
            Yes
        </label>
        <label for="show_placeholders_no">
            <input type="radio" id="show_placeholders_no" name="js_contact_form_show_placeholders" value="no" <?php checked($show_placeholders, 'no'); ?>>
            No
        </label>
    </fieldset>
    <?php
}

// Shortcode to display the contact form
function contact_form_markup() {
    $labels = get_option('js_contact_form_labels', [
        'author' => 'Your Name *',
        'email' => 'Email *',
        'subject' => 'Subject *',
        'message' => 'Message *',
        'attachment' => 'File/Photos'
    ]);

    $show_placeholders = get_option('js_contact_form_show_placeholders', 'yes') === 'yes';

    $form_action = get_permalink();
    $author_default = isset($_COOKIE['comment_author_'.COOKIEHASH]) ? $_COOKIE['comment_author_'.COOKIEHASH] : '';
	$email_default = isset($_COOKIE['comment_author_email_'.COOKIEHASH]) ? $_COOKIE['comment_author_email_'.COOKIEHASH] : '';


   $contact_form_success = '';
if (isset($_SESSION['contact_form_success'])) {
    $contact_form_success = '<p style="color: green">Thank you for Your Messages.</p>';
    unset($_SESSION['contact_form_success']);
}

    $markup = '<div id="cform">';
    $markup .= $contact_form_success;
    $markup .= '<form onsubmit="return validateForm(this);" action="' . esc_url($form_action) . '" method="post" enctype="multipart/form-data">';
    
    // Author field
    $markup .= '<p><input type="text" name="author" id="author" value="' . esc_attr($author_default) . '" size="22"';
    if ($show_placeholders) $markup .= ' placeholder="Enter your name"';
    $markup .= ' /><label for="author">' . esc_html($labels['author']) . '</label></p>';
    
    // Email field
    $markup .= '<p><input type="text" name="email" id="email" value="' . esc_attr($email_default) . '" size="22"';
    if ($show_placeholders) $markup .= ' placeholder="Enter your email"';
    $markup .= ' /><label for="email">' . esc_html($labels['email']) . '</label></p>';
    
    // Subject field
    $markup .= '<p><input type="text" name="subject" id="subject" value="" size="22"';
    if ($show_placeholders) $markup .= ' placeholder="Enter subject"';
    $markup .= ' /><label for="subject">' . esc_html($labels['subject']) . '</label></p>';
    
    // Message field
    $markup .= '<div id="message"><p><textarea name="message" id="message" cols="70%" rows="10"';
    if ($show_placeholders) $markup .= ' placeholder="Enter your message"';
    $markup .= '></textarea></p></div>';
    
    // Attachment field
    $markup .= '<p><label for="attachment">' . esc_html($labels['attachment']) . '</label>';
    $markup .= '<input type="file" name="attachment" id="attachment" /></p>';
    
    // Submit button
    $markup .= '<div id="send"><input name="send" type="submit" id="send" value="Send" /></div>';
    $markup .= '<input type="hidden" name="contact_form_submitted" value="1">';
    $markup .= '</form></div>';

    return $markup;
}
add_shortcode('contact_form', 'contact_form_markup');


// Process Contact Form
function contact_form_process() {
    session_start();

    if (!isset($_POST['contact_form_submitted'])) return;

    $author = (isset($_POST['author'])) ? trim(strip_tags($_POST['author'])) : null;
    $email = (isset($_POST['email'])) ? trim(strip_tags($_POST['email'])) : null;
    $subject = (isset($_POST['subject'])) ? trim(strip_tags($_POST['subject'])) : null;
    $message = (isset($_POST['message'])) ? trim(strip_tags($_POST['message'])) : null;

    if ($author == '') wp_die('Error 1: Write your Name please.');
    if (!is_email($email)) wp_die('Error 2: Type your Email address please.');
    if ($subject == '') wp_die('Error 3: Write a Subject First.');

    $email_content = '<html><body>';
$email_content .= '<div style="margin-bottom: 20px;">' . nl2br(get_option('js_contact_form_header')) . '</div>';
$email_content .= '<div style="margin-bottom: 20px;">' . nl2br($message) . '</div>';
$email_content .= '<div style="margin-top: 20px;">' . nl2br(get_option('js_contact_form_footer')) . '</div>';
$email_content .= '</body></html>';


    $to = get_option('js_contact_form_email', 'yourname@mail.com');
    $headers = array('Content-Type: text/html; charset=UTF-8', 'From: ' . $author . ' <' . $email . '>');
    
    // Process attachment if available
    $attachments = array();
    if (!empty($_FILES['attachment']['tmp_name'])) {
        if ($_FILES['attachment']['error'] == 0 && is_uploaded_file($_FILES['attachment']['tmp_name'])) {
            $attachments[] = $_FILES['attachment']['tmp_name'];
        } else {
            wp_die('Error: Something went wrong with the file upload. Please try again later.');
        }
    }

    // Use wp_mail to send email
    $mail_sent = wp_mail($to, $subject, $email_content, $headers, $attachments);

    if (!$mail_sent) {
        wp_die('Error: Mail Sending Failed. Please check the destination email address and try again.');
    }

    $_SESSION['contact_form_success'] = 1;
    wp_redirect(get_permalink());
    exit;
}

add_action('init', 'contact_form_process');

// Enqueue Stylesheet
function safely_add_stylesheet() {
    wp_enqueue_style('contact-form-style', plugins_url('style.css', __FILE__));
}
add_action('wp_enqueue_scripts', 'safely_add_stylesheet');

// Apply Custom CSS from Settings
function add_customizer_styles() {
    $custom_css = get_option('js_contact_form_css', '');
    if ($custom_css) {
        wp_add_inline_style('contact-form-style', $custom_css);
    }
}
add_action('wp_enqueue_scripts', 'add_customizer_styles');

// JavaScript for Form Validation
function contact_form_js() { ?>
<script type="text/javascript">
function validateForm(form) {
    var errors = '';
    var regexpEmail = /\w{1,}[@][\w\-]{1,}([.]([\w\-]{1,})){1,3}$/;
    if (!form.author.value) errors += "Error 1: Please write your name.\n";
    if (!regexpEmail.test(form.email.value)) errors += "Error 2: Please enter a valid email address.\n";
    if (!form.subject.value) errors += "Error 3: Please enter a subject.\n";

    if (errors != '') {
        alert(errors);
        return false;
    }

    return true;
}
</script>
<?php }
add_action('wp_head', 'contact_form_js');
?>

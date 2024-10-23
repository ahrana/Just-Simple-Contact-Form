<?php
// Prevent direct access
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// js-contact-form-multistep-settings.php
// 
// Create the multi-step settings page content
function js_contact_form_multistep_settings_page() {
    ?>
   <div class="wrap" style="max-width: 1200px; margin: 0 auto; padding: 20px; background-color: #f9f9f9; border: 1px solid #ddd; border-radius: 10px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); width: 100%;">
        <h1 style="font-size: 2em; margin-bottom: 20px; color: #333;">JS Contact Form Multi-Step Settings</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('js_contact_form_multistep_settings_group');
            do_settings_sections('js-contact-form-multistep');
            submit_button();
            ?>
        </form>
        
        <h2 style="font-size: 1.5em; margin: 20px 0 10px; color: #0073aa;">Shortcode</h2>
        <p style="font-size: 1em; margin-bottom: 15px; color: #555;">Use the following shortcode to display the multi-step contact form on any page or post:</p>
        <textarea id="shortcode" rows="1" readonly style="width: 100%; padding: 10px; font-size: 16px; border: 1px solid #ccc; border-radius: 5px; resize: none; box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);">
[js_contact_form_multistep]
        </textarea>
        <button id="copy-button" style="background-color: #0073aa; color: white; padding: 10px 15px; border: none; border-radius: 5px; cursor: pointer; transition: background-color 0.3s, transform 0.2s; margin-top: 10px;">Copy Shortcode</button>
    </div>

    <script>
        document.getElementById('copy-button').addEventListener('click', function() {
            const shortcodeTextarea = document.getElementById('shortcode');
            shortcodeTextarea.select();
            document.execCommand('copy');
            alert('Shortcode copied to clipboard!');
        });
    </script>

		
    </div>
    <?php
}

// Register multi-step settings and fields
function js_contact_form_multistep_register_settings() {
    register_setting('js_contact_form_multistep_settings_group', 'js_contact_form_admin_email');

    add_settings_section(
        'js_contact_form_multistep_main_section',
        'Multi-Step Form Settings',
        null,
        'js-contact-form-multistep'
    );

    // Admin email field
    add_settings_field(
        'js_contact_form_admin_email',
        'Admin Email Address',
        'js_contact_form_admin_email_field',
        'js-contact-form-multistep',
        'js_contact_form_multistep_main_section'
    );
}
add_action('admin_init', 'js_contact_form_multistep_register_settings');

// Settings field callbacks
function js_contact_form_admin_email_field() {
    $admin_email = get_option('js_contact_form_admin_email', get_option('admin_email'));
    echo '<input type="email" name="js_contact_form_admin_email" value="' . esc_attr($admin_email) . '" class="regular-text">';
}

// Enqueue styles and scripts for the front end
function js_contact_form_multistep_enqueue_scripts() {
   // Inline CSS
$css = "
    #multi-step-form {
        max-width: 600px; /* Increased max-width for more space */
        margin: auto;
        padding: 20px;
        background-color: #ffffff; /* Changed background for better contrast */
        border: 1px solid #ddd;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .form-step {
        display: none;
    }
	
	

    .form-step-active {
        display: block;
    }

    h2 {
        font-size: 1.75em; /* Increased font size for better visibility */
        margin-bottom: 15px;
        color: #333;
        text-align: center; /* Centered heading */
    }

    input[type='text'],
    input[type='email'],
    textarea {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ddd;
        border-radius: 5px;
        transition: border-color 0.3s;
        box-sizing: border-box; /* Ensures padding is included in width */
    }

    input[type='text']:focus,
    input[type='email']:focus,
    textarea:focus {
        border-color: #0073aa; /* Highlight border color on focus */
        outline: none; /* Remove default outline */
    }

    button {
        margin-top: 15px;
        padding: 10px 15px;
        background-color: #0073aa;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s, transform 0.2s;
        width: 100%; /* Full-width buttons for better responsiveness */
        font-size: 1em; /* Increased button font size */
    }

    button:hover {
        background-color: #005177;
        transform: scale(1.05);
    }
/* CSS for Checkmarks */
.input-container {
    position: relative; /* Positioning context for the checkmark */
    margin-bottom: 20px; /* Space between fields */
}

.checkmark {
    position: absolute;
    top: 50%;
    right: 10px; /* Adjust position as necessary */
    transform: translateY(-50%);
    display: none; /* Initially hidden */
    color: #4caf50; /* Green color for the checkmark */
    font-size: 1.2em; /* Size of the checkmark */
}


    .success {
        margin: 15px 0;
        padding: 10px;
        background-color: #e0ffef;
        border: 1px solid #4caf50;
        border-radius: 5px;
        color: #4caf50;
        display: none;
        text-align: center; /* Centered success message */
    }

    /* Responsive Styles */
    @media (max-width: 768px) {
        #multi-step-form {
            padding: 15px; /* Adjust padding for smaller screens */
        }

        h2 {
            font-size: 1.5em; /* Decreased font size on smaller screens */
        }

        button {
            font-size: 0.9em; /* Adjusted button font size for smaller screens */
        }
    }

    @media (max-width: 480px) {
        #multi-step-form {
            max-width: 90%; /* Allow more width on small devices */
        }
    }
";

    wp_add_inline_style('wp-block-library', $css); // Add CSS to the block library

    // Add jQuery for navigation between steps
    wp_enqueue_script('jquery');
}
add_action('wp_enqueue_scripts', 'js_contact_form_multistep_enqueue_scripts');

// Shortcode for multi-step form
function js_contact_form_multistep_shortcode() {
    ob_start();

    // Display the multi-step form
    ?>
    <form id="multi-step-form" method="post">
    <div class="form-step form-step-active">
        <h2>Your Name</h2>
        <div class="input-container">
            <input type="text" name="name" placeholder="Your Name" required>
            <span class="checkmark" id="name-checkmark">&#10003;</span> <!-- Checkmark symbol -->
        </div>
        <button type="button" class="btn-next">Next</button>
    </div>
    <div class="form-step">
        <h2>Your Email</h2>
        <div class="input-container">
            <input type="email" name="admin_email" placeholder="Your Email" required>
            <span class="checkmark" id="email-checkmark">&#10003;</span> <!-- Checkmark symbol -->
        </div>
        <button type="button" class="btn-prev">Previous</button>
        <button type="button" class="btn-next">Next</button>
    </div>
    <div class="form-step">
        <h2>Your Phone</h2>
        <div class="input-container">
            <input type="text" name="phone" placeholder="Your Phone" required>
            <span class="checkmark" id="phone-checkmark">&#10003;</span> <!-- Checkmark symbol -->
        </div>
        <button type="button" class="btn-prev">Previous</button>
        <button type="button" class="btn-next">Next</button>
    </div>
    <div class="form-step">
        <h2>Your Message</h2>
        <div class="input-container">
            <textarea name="message" placeholder="Your Message" required></textarea>
            <span class="checkmark" id="message-checkmark">&#10003;</span> <!-- Checkmark symbol -->
        </div>
        <button type="button" class="btn-prev">Previous</button>
        <button type="submit">Send Message</button>
    </div>
    <div class="success">Thank you for your message!</div>
</form>


    <script>
    jQuery(document).ready(function($) {
        const formSteps = $('.form-step');
        let currentStep = 0;

        function showStep(step) {
            formSteps.removeClass('form-step-active');
            formSteps.eq(step).addClass('form-step-active');
        }

        function validateStep(step) {
            const inputs = formSteps.eq(step).find('input, textarea');
            let valid = true;
            inputs.each(function() {
                if ($(this).prop('required') && !$(this).val()) {
                    valid = false;
                    $(this).css('border-color', 'red'); // Highlight empty fields
                } else {
                    $(this).css('border-color', '#ddd'); // Reset border color
                }
            });

            // Additional validation for email field on the second step
            if (step === 1) { // Email step
                const emailInput = $('input[name="admin_email"]');
                const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailPattern.test(emailInput.val().trim())) {
                    valid = false;
                    emailInput.css('border-color', 'red'); // Highlight email field in red if invalid
                    $('#email-checkmark').show().css('color', 'red'); // Show red checkmark for invalid email
                } else {
                    $('#email-checkmark').show().css('color', 'green'); // Show green checkmark for valid email
                }
            }

            return valid;
        }

        $('.btn-next').on('click', function() {
            if (validateStep(currentStep)) {
                currentStep++;
                if (currentStep < formSteps.length) {
                    showStep(currentStep);
                }
            }
        });

        $('.btn-prev').on('click', function() {
            currentStep--;
            if (currentStep >= 0) {
                showStep(currentStep);
            }
        });

        // Handle form submission
        $('#multi-step-form').on('submit', function(e) {
            e.preventDefault(); // Prevent default form submission
            if (validateStep(currentStep)) {
                const formData = $(this).serialize(); // Serialize form data
                $.post('<?php echo admin_url('admin-ajax.php'); ?>', formData + '&action=send_contact_email', function(response) {
                    if (response.success) {
                        $('.success').show(); // Show success message
                        $('#multi-step-form')[0].reset(); // Reset the form
                        currentStep = 0; // Reset step to the first
                        showStep(currentStep); // Show first step
                    }
                });
            }
        });

        // Initialize the first step
        showStep(currentStep);

        // Checkmarks functionality
        const inputs = [
            { input: $('input[name="name"]'), checkmark: $('#name-checkmark') },
            { input: $('input[name="admin_email"]'), checkmark: $('#email-checkmark') },
            { input: $('input[name="phone"]'), checkmark: $('#phone-checkmark') },
            { input: $('textarea[name="message"]'), checkmark: $('#message-checkmark') }
        ];

        // Add event listeners to show/hide checkmarks based on input
        inputs.forEach(item => {
            item.input.on("input", function() {
                if (item.input.val().trim() !== "") {
                    if (item.input.attr('name') === 'admin_email') {
                        // Validate email format
                        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                        if (emailPattern.test(item.input.val().trim())) {
                            item.checkmark.show().css('color', 'green'); // Show green checkmark for valid email
                        } else {
                            item.checkmark.show().css('color', 'red'); // Show red checkmark for invalid email
                        }
                    } else {
                        item.checkmark.show().css('color', 'green'); // Show green checkmark for other fields
                    }
                } else {
                    item.checkmark.hide(); // Hide checkmark if input is empty
                }
            });
        });
    });
</script>

    <?php

    return ob_get_clean();
}
add_shortcode('js_contact_form_multistep', 'js_contact_form_multistep_shortcode');

// Handle AJAX request to send the email
function send_contact_email() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Collect and sanitize form data
        $name = sanitize_text_field($_POST['name']);
        $admin_email = sanitize_email($_POST['admin_email']);
        $phone = sanitize_text_field($_POST['phone']);
        
        // Replace this line to get the website name
        $subject = sanitize_text_field(get_bloginfo('name')); // Get website name
        $message = sanitize_textarea_field($_POST['message']);

        // Prepare email
        $to = get_option('js_contact_form_admin_email', get_option('admin_email'));
        $headers = array('Content-Type: text/html; charset=UTF-8');
        $body = "<strong>Name:</strong> $name<br>
                 <strong>Email:</strong> $admin_email<br>
                 <strong>Phone:</strong> $phone<br>
                 <strong>Message:</strong><br>$message";

        // Send email
        $sent = wp_mail($to, $subject, $body, $headers);
        
        // Respond with success status
        if ($sent) {
            wp_send_json_success();
        } else {
            wp_send_json_error();
        }
    }
}

add_action('wp_ajax_send_contact_email', 'send_contact_email');
add_action('wp_ajax_nopriv_send_contact_email', 'send_contact_email');

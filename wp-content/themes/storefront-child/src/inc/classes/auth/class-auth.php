<?php
namespace Omnis\src\inc\classes\auth;

class Auth {
    private static $instance = null;

    public static function get_instance() {
        if (self::$instance === null) {
            self::$instance = new self();
            self::$instance->setup_hooks();
        }
        return self::$instance;
    }

    private function setup_hooks() {
        add_action('wp_enqueue_scripts', [$this, 'deenqueue_scripts'], 99);
        add_action('template_redirect', [$this, 'redirect_to_login']);
        add_action('init', [$this, 'customer_registration_form_handler']);
    }

    public function redirect_to_login() {
        if (is_user_logged_in()) {
            if (is_page('login') || is_page('lost-password') || is_page('registration') || is_page('customer-registration')) {
                wp_redirect(home_url());
                exit;
            }
        } else {
            if (!is_page('login') && !is_page('lost-password') && !is_page('registration') && !is_page('customer-registration')) {
                wp_redirect(home_url('/login'));
                exit;
            }
        }
    }

    public function deenqueue_scripts() {
        if ( is_page('login') || is_page('customer-registration') ) {
            wp_dequeue_style('storefront-style-parent'); 
            wp_dequeue_style('storefront-style');
            wp_deregister_style('storefront-style');
        }
    }

    public function customer_registration_form_handler() {
        if (isset($_POST['register'])) {
            // Перевірка Nonce
            if (!isset($_POST['user_registration_nonce']) || !wp_verify_nonce($_POST['user_registration_nonce'], 'user_registration')) {
                wc_add_notice(__('Invalid nonce', 'swap'), 'error');
                return;
            }
    
            $username = sanitize_text_field($_POST['username']);
            $email = sanitize_email($_POST['email']);
            $dob = sanitize_text_field($_POST['dob']);
            $styles = isset($_POST['styles']) ? array_map('sanitize_text_field', $_POST['styles']) : [];
            $profile_picture = isset($_FILES['profile_photo']) ? $_FILES['profile_photo'] : null;
            $password = wp_generate_password();
    
            if (empty($username) || empty($email)) {
                wc_add_notice(__('Please fill all required fields.', 'swap'), 'error');
                return;
            }
    
            if (!is_email($email)) {
                wc_add_notice(__('Invalid email address.', 'swap'), 'error');
                return;
            }
    
            if (empty($dob)) {
                wc_add_notice(__('Invalid birthday.', 'swap'), 'error');
                return;
            }
    
            if (username_exists($username) || email_exists($email)) {
                wc_add_notice(__('Username or email already exists.', 'swap'), 'error');
                return;
            }
    
            $user_id = wp_create_user($username, $password, $email);
            if (is_wp_error($user_id)) {
                wc_add_notice($user_id->get_error_message(), 'error');
                return;
            }

            update_user_meta($user_id, 'dob', $dob);
            update_user_meta($user_id, 'styles', $styles);
            
            /*
            if ($profile_picture && !empty($profile_picture['name'])) {
                require_once ABSPATH . 'wp-admin/includes/file.php';
                
                $file_type = wp_check_filetype($profile_picture['name']);
                $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
                if (!in_array($file_type['ext'], $allowed_types)) {
                    return new WP_Error('invalid_photo', __('Profile photo must be an image file (jpg, jpeg, png, gif).', 'omnis_base'));
                }
    
                $uploaded_file = wp_handle_upload($profile_picture, ['test_form' => false]);
                if (isset($uploaded_file['url'])) {
                    update_user_meta($user_id, 'profile_picture', esc_url($uploaded_file['url']));
                } else {
                    return new WP_Error('photo_upload_failed', __('Failed to upload profile picture.', 'omnis_base'));
                }
            }
            */
    
            $user = new WP_User($user_id);
            $user->set_role('customer');
    
            $credentials = [
                'user_login'    => $username,
                'user_password' => $password,
                'remember'      => true,
            ];
            $auth = wp_signon($credentials, is_ssl());
            if (is_wp_error($auth)) {
                wc_add_notice($auth->get_error_message(), 'error');
                return;
            }
    
            wc_add_notice(__('Registration successful!', 'swap'), 'success');
            wp_redirect(home_url('/my-account/'));
            exit;
        }
    
    }

}

Auth::get_instance();
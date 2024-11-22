<?php

namespace Omnis\src\inc\classes\auth;

class Password_Control
{
    private static $instance;

    public function __construct()
    {
        $this->setup_ajax_handlers();
    }

    public static function get_instance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function setup_ajax_handlers()
    {
        $this->wp_ajax_action('reset_password');
    }


    public function wp_ajax_action($action)
    {
        add_action('wp_ajax_' . $action, [$this, $action]);
        add_action('wp_ajax_nopriv_' . $action, [$this, $action]);
    }

    public function reset_password()
    {
        $security = sanitize_text_field($_POST['custom-lost-password-nonce']);
        $user_login = sanitize_text_field($_POST['user_login'] ?? "");

        if (!wp_verify_nonce($security, 'lost_password') || !$user_login) {
            wp_send_json_error('Invalid nonce or empty filters.');
        }

        $user = get_user_by('login', $user_login) ?: get_user_by('email', $user_login);

        if (!$user) {
            wp_send_json_error('No user found with that username or email.');
        }

        $reset_key = get_password_reset_key($user);

        if (is_wp_error($reset_key)) {
            wp_send_json_error('Error generating password reset key.');
        }

        $reset_url = add_query_arg(
            array(
                'key' => $reset_key,
                'login' => rawurlencode($user->user_login),
            ),
            wp_login_url()
        );


        $subject = 'Password Reset Request';
        $message = 'You requested a password reset. Click the link below to reset your password:';
        $message .= "\n\n" . $reset_url;

        // Send the email
        $to = $user->user_email;
        $headers = array('Content-Type: text/html; charset=UTF-8');
        $mail_sent = wp_mail($to, $subject, $message, $headers);

        // Check if the email was sent
        if ($mail_sent) {
            wp_send_json_success('Password reset link has been sent to your email.');
        } else {
            wp_send_json_error('There was an error sending the reset email. Please try again.');
        }
    }
}

Password_Control::get_instance();

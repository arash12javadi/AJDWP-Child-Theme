<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Quick login shortcode display for non-logged-in users and non-user-profile pages
if (!is_user_logged_in() && !is_page('user-profile')) {
    echo do_shortcode('[quick_login_right_bottom]');
}

do_action('ajdwp_theme_before_footer');
?>

<footer class="bg-dark text-center text-white mt-5">
    <!-- Social Media Links -->
    <div class="font-weight-bold h5 pb-2 pt-3">
        <?php
        $social_links = [
            'facebook' => ['icon' => 'fa-facebook-f', 'color' => '#3b5998'],
            'twitter' => ['icon' => 'fa-twitter', 'color' => '#55acee'],
            'google' => ['icon' => 'fa-google', 'color' => '#dd4b39'],
            'instagram' => ['icon' => 'fa-instagram', 'color' => '#ac2bac'],
            'linkedin' => ['icon' => 'fa-linkedin', 'color' => '#0082ca'],
            'youtube' => ['icon' => 'fa-youtube', 'color' => '#c4302b'],
            'GitHub' => ['icon' => 'fa-github', 'color' => '#2dba4e'],
            'StackOverFlow' => ['icon' => 'fa-stack-overflow', 'color' => '#F48024'],
            'whatsapp' => ['icon' => 'fa-whatsapp', 'color' => '#25D366'],
            'other' => ['icon' => 'fa-link', 'color' => 'gold']
        ];

        foreach ($social_links as $key => $data) {
            $url = get_user_meta(1, "user_{$key}", true);
            if ($url) {
                echo '<a href="' . esc_url($url) . '" target="_blank" class="mx-3">';
                echo '<i class="fa-brands ' . esc_attr($data['icon']) . ' fa-2x" style="color: ' . esc_attr($data['color']) . ';"></i>';
                echo '</a>';
            }
        }
        ?>
    </div>

    <!-- Footer Widgets -->
    <div class="footer_widget_1 d-flex align-items-center align-self-center">
        <?php
        dynamic_sidebar('AJDWP-footer-widget-1');
        do_action('AJDWP_theme_footer_widget');
        ?>
    </div>

    <!-- Copyright Section -->
    <div class="text-center py-3" style="background-color: rgba(0, 0, 0, 0.2);">
        Developed by AJDWP
        <svg width="24" height="24" viewBox="0 0 24 24" xmlns="https://www.w3.org/2000/svg">
            <path d="M3.087 1.01c-.742.093-.96.561-1.05 1.23a5.742 5.742 0 0 0-.032.946l.02.394.047.69c0 .435.358 1.924.584 2.495l.07.156c.077.148.17.27.278.376l.058.05.114-.15c-.517.653-.806 1.388-.776 2.306.032 1.023.536 1.724 1.413 2.386l.561.41.102.079.02.156.062.62c.06.51.142.83.338 1.246.085.18.187.354.306.521.242.34.546.588.895.735l.183.067c.303.096.605.11.896.065l.155-.032.081.215.32 1.016c.134.428.253.774.391 1.124.359.907 1.105 1.573 2.097 2.067.759.377 1.501.587 2.026.678l.121.021.123-.008.259-.027c.42-.058.79-.18 1.156-.36l.202-.109.05.363c.022.168.04.283.068.396.073.3.166.511.439.718.37.28 4.108 1.05 4.932 1.142.536.06.944-.204 1.205-.603a2.35 2.35 0 0 0 .238-.49l.214-.604.053-.121.254-.024c.324-.026.466-.046.679-.132.47-.19.78-.623.76-1.15l-.051-.554a6.731 6.731 0 0 0-.048-.384c-.106-.682-.305-1.185-.792-1.53-1.33-.941-1.498-1.364-.785-2.239.294-.36.342-.842.126-1.249-.125-.237-.277-.374-.504-.53l-.35-.228c-.037-.025-.05-.027-.05.008l.01.082c-.221-1.459-.15-2.455.138-3.453l.07-.23c.045-.142.201-.594.219-.649.092-.278.149-.49.182-.713.23-1.557-.812-2.264-4.183-3.756-1.153-.51-2.07-.445-3.044.084l-.403.239c-.258.157-.521.321-.487.3-.666.403-1.206.604-1.972.666-1.138.093-1.764-.236-2.256-.943l-.053-.082-.148-.252-.376-.661.045-.457a6.09 6.09 0 0 0 .007-.105c.041-.654-.03-1.133-.405-1.56-.469-.533-1.076-.525-1.645-.256-.185.088-.3.157-.549.331l-.375.266-.254.169-.108-.086a4.534 4.534 0 0 1-.145-.128l-.386-.365a6.036 6.036 0 0 0-.152-.136l-.069-.059c-.364-.3-.663-.457-1.12-.399zm1.903 9.262.024.018c-.439-.33-.606-.564-.615-.851-.013-.401.101-.692.345-1l.098-.117.235-.26c.263-.292.385-.47.434-.815a1.16 1.16 0 0 0-.444-1.09 1.417 1.417 0 0 0-.353-.204l-.259-.097-.082-.283a14.465 14.465 0 0 1-.297-1.26l-.024-.403.15.09c.3.167.608.253.952.228l.165-.02c.268-.043.507-.146.788-.318l.13-.084-.001.05c-.009.342.03.595.246.878l.257.468c.121.217.265.465.382.645l.056.084c.881 1.267 2.177 1.948 4.06 1.794a5.965 5.965 0 0 0 2.573-.788l.27-.158a33.8 33.8 0 0 1 .811-.494c.449-.244.716-.263 1.28-.013l.686.31c1.695.785 2.342 1.235 2.329 1.324-.01.068-.032.155-.07.28l-.258.764c-.436 1.361-.567 2.706-.28 4.595l.034.17c.096.38.304.656.613.909l.033.025-.054.102c-.827 1.608-.087 2.983 1.748 4.282l-.028-.017c-.028-.013-.034.004-.03.045l.025.149-.155.033c-.358.086-.659.242-.916.53-.208.235-.341.485-.473.833l-.108.303-1.11-.215-1.08-.222-.967-.215-.033-.238-.014-.092c-.133-.805-.335-1.318-.92-1.64a1.431 1.431 0 0 0-.478-.164c-.367-.056-.677.028-1.006.2l-.143.08c-.146.084-.333.197-.369.217l-.16.083a1.713 1.713 0 0 1-.47.15l-.058.006-.197-.048a5.982 5.982 0 0 1-1.151-.424c-.59-.294-.982-.644-1.128-1.01-.07-.18-.136-.36-.204-.56l-.193-.607c-.071-.23-.19-.617-.234-.748-.389-1.17-.812-1.779-1.781-1.837l-.324-.019-.274.172-.097.033c-.003.001-.004.002-.002.003l-.044-.055a1.364 1.364 0 0 1-.125-.212c-.1-.211-.14-.397-.182-.821l-.046-.479a2.96 2.96 0 0 0-.112-.562 1.625 1.625 0 0 0-.443-.698l-.114-.1c-.285-.236-.87-.658-.818-.615z" fill="#FFF" fill-rule="evenodd" />
        </svg>
        <a class="text-white" href="https://arashjavadi.com/" target="_blank"> ArashJavadi.com</a>
    </div>
</footer>

<?php
wp_footer();
do_action('ajdwp_theme_after_footer');
?>

</body>

</html>
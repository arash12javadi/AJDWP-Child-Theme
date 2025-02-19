<?php
if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
    <?php do_action('Hide_menu_items'); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <?php do_action('ajdwp_theme_before_header'); ?>

    <header>

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark //fixed-top">

            <div class="container-fluid">

                <!-- ------------AVATAR UNDER 992px------------ -->

                <?php do_action('AJDWP_avatar_sm'); ?>

                <!-- ------------LOGO------------ -->

                <div class="AJDWP_logo">
                    <?php the_custom_logo(); ?>
                </div>

                <!-- ------------Toggle Button------------ -->

                <button class="navbar-toggler" type="button"
                    data-bs-toggle="collapse" data-bs-target="#mynavbar"
                    aria-controls="mynavbar"
                    aria-expanded="false"
                    aria-label="Toggle Navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- --------------------------- N A V B A R --------------------------- -->

                <div class="collapse navbar-collapse" id="mynavbar">

                    <?php do_action('AJDWP_primary_navigation');    ?>

                    <div class="search_and_minicart d-flex justify-content-between align-items-center">

                        <?php //dynamic_sidebar('AJDWP-header-sidebar'); 
                        ?>

                        <!-- ------------MINI CART Red--------------- -->

                        <?php do_action('AJDWP_minicart_red'); ?>

                        <!-- ------------MINI CART_2 Blue--------------- -->

                        <?php do_action('AJDWP_minicart_blue'); ?>

                        <!-- ------------SEARCH MODAL--------------- -->

                        <?php do_action('AJDWP_search_modal'); ?>

                        <!-- ------------AJDWP_search_form--------------- -->
                        <?php do_action('AJDWP_search_form'); ?>

                    </div>

                </div>

                <!-- ------------ AVATAR LARGE SCREEN------------ -->

                <?php do_action('AJDWP_avatar'); ?>

            </div>

        </nav>

    </header>
    <?php do_action('ajdwp_theme_after_header'); ?>
<?php
if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Template part for displaying page content.
 */

do_action('AJDWP_content_page_top');

include dirname(__FILE__, 2) . '/Like_follow/likeFollowCounters.php';

$options = get_option('AJDWP_theme_options'); // Loaded once for performance
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post-items shadow rounded mb-3'); ?>>

    <!-- Row: Date & Author -->
    <?php if (!is_page()) : ?>
        <div class="row p-4 border-bottom">
            <div class="post-date-author text-start text-uppercase">
                <?php if (!empty($options['post_publish_date'])) : ?>
                    <span class="span-postdate">Post Date: </span>
                    <span class="post-date">
                        <a href="<?php echo esc_url(get_month_link(get_post_time('Y'), get_post_time('m'))); ?>">
                            <span><?php echo esc_html(get_the_date('j')); ?>/</span><?php echo esc_html(get_the_date("M/Y")); ?>
                        </a>
                    </span>
                    &nbsp;&nbsp;||&nbsp;&nbsp;
                <?php endif; ?>

                <span class="span-writtenby">Written By: </span>
                <span class="post-author">
                    <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
                        <?php echo esc_html(get_the_author()); ?>
                    </a>
                </span>
            </div>
        </div>
    <?php endif; ?>

    <!-- Row: Thumbnail & Content -->
    <div class="row p-4 d-flex align-items-center">
        <?php if (has_post_thumbnail()) : ?>
            <div class="post-thumbnail <?php echo (is_single() || is_page()) ? 'col-lg-12 py-3' : 'col-lg-3'; ?>">
                <?php if (!is_page()) : ?>
                    <div class="featured-image d-flex align-items-center justify-content-center">
                        <a href="<?php echo esc_url(get_permalink()); ?>" class="post-hover">
                            <?php the_post_thumbnail(is_single() ? 'medium_large' : 'thumbnail'); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <div class="post-content-excerpt <?php echo (is_single() || is_page()) ? 'col-lg-12' : (has_post_thumbnail() ? 'col-lg-9' : 'col-lg-12'); ?>">

            <!-- Ensuring Page Title Loads -->
            <?php if (is_single() || is_page()) : ?>
                <?php if (!empty($options['show_page_title'])) : ?>
                    <h1 class="text-uppercase h1 AJDWP_page_title"><?php echo esc_html(get_the_title()); ?></h1>
                <?php endif; ?>

                <div class="post-content text-justify">
                    <?php the_content(); ?>
                </div>

            <?php elseif (!is_single()) : ?>
                <div class="text-uppercase h2">
                    <a href="<?php echo esc_url(get_permalink()); ?>"><?php the_title(); ?></a>
                </div>

                <div class="post-excerpt text-justify">
                    <?php the_excerpt(); ?>
                </div>
            <?php endif; ?>

        </div>
    </div>

    <!-- Row: Like, Follow, Views & Social Media -->
    <div class="row border-top py-4 d-flex align-items-center">
        <div class="col-8 justify-content-start d-inline-flex">
            <?php if (!is_page()) : ?>
                <div class="like_buttons d-flex justify-content-start align-items-center">
                    <?php if (is_user_logged_in()) : ?>
                        <?php do_action('AJDWP_like_follow_social'); ?>
                    <?php else : ?>
                        <?php echo "Total likes: " . esc_html($totalLikes); ?>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <?php if (!is_page()) : ?>
                <div class="d-flex align-items-center p-1 mx-4 border border-1 rounded d-inline-flex position-relative <?php echo !empty($follow_exsists) ? 'border-primary' : ''; ?>" style="width:max-content;">
                    <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
                        <div class="g-0 d-flex justify-content-start align-items-center">
                            <div class="">
                                <?php
                                $like_follow_custom_avatar_url = get_user_meta(get_the_author_meta('ID'), 'custom_avatar_url', true);
                                if (!empty($like_follow_custom_avatar_url)) {
                                    echo '<img src="' . esc_url($like_follow_custom_avatar_url) . '" alt="Avatar" class="img-fluid rounded" style="width:50px; height:50px;">';
                                } else {
                                    echo get_avatar(get_the_author_meta('ID'), 50, null, null, ['class' => 'img-fluid rounded']);
                                }
                                ?>
                            </div>
                            <div class="px-2 <?php echo !empty($follow_exsists) ? 'text-primary' : ''; ?>">
                                <span><?php echo esc_html(get_userdata(get_the_author_meta('ID'))->display_name); ?></span>
                            </div>
                            <div class="post_page_author_total_follow position-absolute top-0 start-100 translate-middle badge rounded-pill <?php echo !empty($follow_exsists) ? 'bg-primary' : 'bg-secondary'; ?>">
                                <?php echo esc_html($totalfollow); ?>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endif; ?>

            <?php if (is_page() && !empty($options['page_publish_date'])) : ?>
                <div class="col-8">
                    <div class="post-date-author text-start text-uppercase">
                        <span class="span-postdate">Created Date: </span>
                        <span class="post-date">
                            <a href="<?php echo esc_url(get_month_link(get_post_time('Y'), get_post_time('m'))); ?>">
                                <span><?php echo esc_html(get_the_date('j ')); ?></span><?php echo esc_html(get_the_date('M, Y')); ?>
                            </a>
                        </span>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <?php if (!empty($options['post_views'])) : ?>
            <div class="col-4 text-end AJDWP-theme-view-counter">
                <?php echo esc_html(getPostViews(get_the_ID())); ?>
            </div>
        <?php endif; ?>
    </div>

</article>

<?php do_action('AJDWP_content_page_bottom'); ?>
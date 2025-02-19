<?php
if (! defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}
get_header(); ?>
<div class="content mt-5">
	<div class="container">
		<div class="row">
			<div class="col-lg-3 AJDWP-side-bar rounded shadow pt-4 pb-4 mb-5 mb-lg-0">
				<div class="sticky-top">
					<?php dynamic_sidebar('AJDWP-blog-sidebar'); ?>
				</div>
			</div>
			<div class="col-lg-9 ">
				<section id="post-section" class="post-section">
					<div class="container-fluid">
						<div class="row">
							<header class="page-header mb-4">
								<h1 class="page-title"><?php the_archive_title(); ?></h1>
								<?php the_archive_description('<div class="taxonomy-description">', '</div>'); ?>
							</header>
							<?php if (have_posts()): ?>
								<?php while (have_posts()) : the_post();
									get_template_part('theme_addons/content/content', 'page');
								endwhile; ?>
								<div class="d-flex align-items-center justify-content-center">
									<?php
									// Previous/next page navigation.
									the_posts_pagination(array(
										'prev_text'          => '<i class="fa fa-angle-double-left"></i>',
										'next_text'          => '<i class="fa fa-angle-double-right"></i>',
									)); ?>
								</div>
							<?php else: ?>
								<?php get_template_part('theme_addons/content/content', 'none'); ?>
							<?php endif; ?>
						</div>
					</div>
				</section>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>
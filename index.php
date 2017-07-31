<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package understrap
 */

get_header();

$container   = get_theme_mod( 'understrap_container_type' );
$sidebar_pos = get_theme_mod( 'understrap_sidebar_position' );
?>

<?php if ( is_front_page() && is_home() ) : ?>
	<?php get_template_part( 'global-templates/hero', 'none' ); ?>
<?php endif; ?>

<div class="wrapper" id="wrapper-index">

	<div id="content" tabindex="-1">

		

			<div class="content-area" id="primary">

				<main class="site-main" id="main">
					
					<div class="section" id="hero">
						<div class="logo-container">
							<h1 class="logo">Salvage Mission 9</h1>
						</div>
					</div>

					<div class="section" id="about">
						<p>After the collapse of society, a deranged salvager and his apprentice become obsessed with battling a psych-warfare drone leftover from the old world.</p>
					</div>

					<div class="section" id="trailer">
						<div class="video-container">
							<iframe src="https://player.vimeo.com/video/226845128" width="640" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
						</div>
					</div>

					<div class="section" id="support">
						<div>
							<p>Salvage Mission 9 is an independent sci-fi film being produced by Stephen DeLorme and Patrick Logan. We are beginning principal photography soon and will embark on a crowd-sourcing campaign before entering post-production.</p>

							<p>If you're interested in this film, please support us by following us on your preferred social channel or purchasing some of our merch.</p>

							<ul class="icon-list">
								<li><a href="https://facebook.com/salvagemission9" target="_blank"><span class="fa fa-facebook-square"></span>Facebook</a></li>
								<li><a href="https://www.instagram.com/salvagemission9/" target="_blank"><span class="fa fa-instagram"></span>Instagram</a></li>
							</ul>
						</div> 
					</div>

					

					<div class="section" id="shop">
						<div class="row">
							<?php
							$args = array(
							    'post_type' => 'product',
							    'stock' => 1,
							    'posts_per_page' => 4,
							    'orderby' =>'date',
							    'order' => 'DESC' 
							);
							 
							$loop = new WP_Query( $args );
							while ( $loop->have_posts() ) : $loop->the_post(); 
							global $product; ?>
							
							<div class="col-md-4 product"> 
							<a id="id-<?php the_id(); ?>" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
							 
							<?php if (has_post_thumbnail( $loop->post->ID )) 
							        echo get_the_post_thumbnail($loop->post->ID, 'shop_catalog'); 
							      else echo '<img src="'.woocommerce_placeholder_img_src().'" alt="product placeholder Image" width="65px" height="115px" />'; ?>
							<h3><?php the_title(); ?></h3>
							 
							<span class="price"><?php echo $product->get_price_html(); ?></span>
							</a>
							 
							<?php woocommerce_template_loop_add_to_cart( $loop->post, $product ); 
							?>
							 
							</div>
							<?php endwhile; ?>
							<?php wp_reset_query(); ?>
						</div>
					</div>

					<div class="section" id="blog">

						<h2 id="blog-title">From the Production Team</h2>

						<?php if ( have_posts() ) : ?>

							<?php /* Start the Loop */ ?>

							<div class="row">
							<?php while ( have_posts() ) : the_post(); ?>
								
								<?php

								/*
								 * Include the Post-Format-specific template for the content.
								 * If you want to override this in a child theme, then include a file
								 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
								 */
								get_template_part( 'loop-templates/content', get_post_format() );
								?>

							<?php endwhile; ?>
							</div>

						<?php else : ?>

							<?php get_template_part( 'loop-templates/content', 'none' ); ?>

						<?php endif; ?>

					</div>

				</main><!-- #main -->

				<!-- The pagination component -->
				<?php understrap_pagination(); ?>

			</div><!-- #primary -->

	</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>

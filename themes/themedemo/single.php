<?php get_header(); ?>
<div class="row">
 	<div class="col-sm-9 main-content">
 		<div class="row" id="neo">

       		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
       			<?php postview_set(get_the_ID()); ?>
	 			<?php get_template_part( 'content', get_post_format() ); ?>
	 			<?php get_template_part( 'author-bio' ); ?>
				<?php //comments_template(); ?>
	        <?php endwhile; ?>
	        <?php else : ?>
	 			<?php get_template_part( 'content', 'none' ); ?>
	        <?php endif; ?>
        </div>
    </div>
        <div class="col-sm-3 sidebar">
 						<?php get_sidebar(); ?>
        </div>
 
</div>
<?php get_footer(); ?>
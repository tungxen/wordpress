<?php get_header(); ?>
<div class="row">
 	<div class="col-sm-9 main-content">
 		<div class="row flex" id="neo">

       		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<div class="col-md-4 col-sm-6  flex">
	 			<?php get_template_part( 'content', get_post_format() ); ?>
				</div>
	        <?php endwhile; ?>	
	        <?php tungxen_pagination(); ?>
	        <?php else : ?>
	 			<?php get_template_part( 'content', 'none' ); ?>
	        <?php endif; ?>
        </div>
    </div>
        <div class="col-sm-3 sidebar ">
 						<?php get_sidebar(); ?>
        </div>
 
</div>
 
<?php get_footer(); ?>
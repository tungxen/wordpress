<?php get_header(); ?>
<div class="content">
<div class="row">
    <div class="col-sm-9 main-content">
        <div class="archive-title">
                <h2>
                        <?php
                                if ( is_tag() ) :
                                        printf( __('Posts Tagged: %1$s','thachpham'), single_tag_title( '', false ) );
                                elseif ( is_category() ) :
                                        printf( __('Posts Categorized: %1$s','thachpham'), single_cat_title( '', false ) );
                                elseif ( is_day() ) :
                                        printf( __('Daily Archives: %1$s','thachpham'), the_time('l, F j, Y') );
                                elseif ( is_month() ) :
                                        printf( __('Monthly Archives: %1$s','thachpham'), the_time('F Y') );
                                elseif ( is_year() ) :
                                        printf( __('Yearly Archives: %1$s','thachpham'), the_time('Y') );
                                endif;
                        ?>
                </h2>
    </div>
        <div class="row" id="neo">

            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <div class="col-md-4 col-sm-6">
                    <div class="well">
                <?php get_template_part( 'content', get_post_format() ); ?>
                    </div>
                </div>
            <?php endwhile; ?>  
            <?php tungxen_pagination(); ?>
            <?php else : ?>
                <?php get_template_part( 'content', 'none' ); ?>
            <?php endif; ?>
        </div>

        <?php if ( is_tag() || is_category() ) : ?>
                <div class="archive-description">
                        <?php echo term_description(); ?>
                </div>
        <?php endif; ?>
    </div>
        <div class="col-sm-3 sidebar">
                        <?php get_sidebar(); ?>
        </div>
 
</div>



 
</div>
 
<?php get_footer(); ?>
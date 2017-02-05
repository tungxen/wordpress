<article class="well" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="entry-thumbnail">
 			<?php tungxen_thumbnail( 'thumbnail' ); ?>
        </div>
        <header class="entry-header">
 			<?php tungxen_entry_header(); ?>
 			<?php tungxen_entry_meta() ?>
        </header>
        <div class="entry-content">
 			<?php tungxen_entry_content(); ?>
			<?php ( is_single() ? tungxen_entry_tag() : '' ); ?>
        </div>
</article>
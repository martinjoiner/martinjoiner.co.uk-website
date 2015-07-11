<?php get_header(); ?>
<div id="content-body">

	<?php if (function_exists('wp_snap')) { echo wp_snap(); } ?>

	<?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<p id="breadcrumbs">','</p>'); } ?>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div <?php 
		if (function_exists("post_class")) 
			post_class(); 
		else 
			print 'class="post"'; 
		?> id="post-<?php the_ID(); ?>">

		
		<?php if ($lw_post_author == "Main page" || $lw_post_author == "Both") : ?>
		<div class="about_author clear">
			<span class="alignleft"><?php echo get_avatar( get_the_author_id(), '20' );   ?></span>
			<div class="alignleft" style="width:470px;"><h4><?php _e('Posted by','lightword'); ?> <a href="<?php the_author_url(); ?> "><?php the_author(); ?></a></h4><?php // the_author_description(); if(!get_the_author_description()) _e('No description. Please complete your profile.','lightword'); ?></div>
			<div class="clear"></div>
		</div>
		<?php endif; ?>


		<div class="postContent">

			<?php lw_simple_date(); ?>

			<h2 class="postTitle"><a title="<?php the_title(); ?>" href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>

			<?php the_content(''); ?>

			<?php if(function_exists('wp_print')) { print_link(); } ?>
			<?php wp_link_pages('before=<div class="nav_link">'.__('PAGES','lightword').': &after=</div>&next_or_number=number&pagelink=<span class="page_number">%</span>'); ?>

			<div class="cat_tags clear">
				<span class="category">
					<?php _e('Filed under:','lightword'); 
					echo " ";
					the_category(', ');
					?>
				</span>
				
				<?php
				if( get_the_tags() ){ 
					echo '<span class="tags">';
					_e('Tagged as:','lightword'); 
					echo " "; 
					the_tags('','',''); 
					echo '</span>';
				} 
				?>
				
				<span class="continue">
					<?php 
					$pos = strpos($post->post_content, '<!--more-->'); 
					if($pos==''){ 
						?><a class="nr_comm_spot" href="<?php the_permalink(); ?>#comments">
							<?php 
							if(fb_get_comment_type_count('comment')==1) 
								_e('1 Comment','lightword'); 
							elseif('open' != $post->comment_status) 
								_e('Comments Off','lightword'); 
							elseif(fb_get_comment_type_count('comment') == 0) 
								_e('No Comments','lightword'); 
							else 
								echo fb_get_comment_type_count('comment')." ".__('Comments','lightword'); 
						?></a>
						<?php 
					}else{ 
						?><a title="<?php _e('Read more about','lightword'); ?> <?php the_title(); ?>" href="<?php the_permalink() ?>#more-<?php echo $id; ?>"><?php _e('Continue reading','lightword'); ?></a><?php 
					} ?>
				</span>
				<div class="clear"></div>
			</div>
				<div class="cat_tags_close"></div>
			</div>

			<?php comments_template(); ?>

		</div>

	<?php endwhile; else: ?>

		<h2><?php _e('Not Found','lightword'); ?></h2>
		<p><?php  _e("Sorry, but you are looking for something that isn't here.","lightword"); ?></p>

	<?php endif; ?>

	<div class="newer_older">
		<span class="newer">&nbsp;<?php previous_posts_link(__('&laquo; Newer Entries','lightword')) ?></span>
		<span class="older">&nbsp;<?php next_posts_link(__('Older Entries &raquo;','lightword')) ?></span>
	</div><!-- /.newer_older -->

</div><!-- /#content-body -->

<?php get_footer(); ?>
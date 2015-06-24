<?php get_header(); ?>

<div id="content">

	<div class="term-lower">
		<ul class="clearfix">
<?php query_posts ( $query_string . '&posts_per_page=-1&orderby=meta_value_num id&order=ASC&meta_key=result_num' ); ?>
<?php if(have_posts()): while(have_posts()): the_post(); ?>
<?php if ( $post->post_parent == 0 ): ?>
			<li class="term-item">
				<?php
					if ( post_custom ( 'result_img01_thumbnail' ) ):
						$result_img = wp_get_attachment_image_src ( post_custom ( 'result_img01_thumbnail' ), 'thumbnail' );
						$result_img_src = $result_img[0];
					elseif ( post_custom ( 'result_img01' ) ):
						$result_img = wp_get_attachment_image_src ( post_custom ( 'result_img01' ), 'thumbnail' );
						$result_img_src = $result_img[0];
					else:
						$result_img_src = '/common/img/common/nophoto_thumb.jpg';
					endif;
				?>
				<div class="photo"><a href="<?php the_permalink(); ?>"><img src="<?php echo $result_img_src; ?>" width="200" height="150" alt="<?php the_title(); ?>" /></a></div>
				<div class="title">
					<?php $result_num = post_custom('result_num'); ?>
					<?php if ( $result_num ) echo sprintf ( '<span class="num">%02d.</span>', $result_num ); ?>
					<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
				</div>
			</li>
<?php endif; ?>
<?php endwhile; endif; ?>
		</ul>
	</div>

</div>

<?php get_footer(); ?>

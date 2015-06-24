<?php get_header(); ?>
<?php
	if ( is_post_type_archive( 'works' ) ):
		$post_type = 'works';
		$taxonomy = 'works_cat';
	elseif ( is_post_type_archive( 'goods' ) ):
		$post_type = 'goods';
		$taxonomy = 'goods_cat';
	elseif ( is_post_type_archive( 'products' ) ):
		$post_type = 'products';
		$taxonomy = 'products_cat';
	endif;
?>
<div id="content">

	<div class="terms">

<?php $tax_cats = get_terms ( $taxonomy, 'hide_empty=0&orderby=order&order=ASC' ); ?>
<?php foreach ( $tax_cats as $tax_cat ): ?>

		<div class="term term-<?php echo $tax_cat->term_id; ?> clearfix">
			<div class="head">
				<h3><?php echo $tax_cat->name; ?></h3>
				<p class="sub"><?php echo $tax_cat->slug; ?></p>
			</div>
			<div class="content">
				<ul class="clearfix">
<?php
	$tax_posts = get_posts (
		array(
			'post_type' => $post_type,
			'taxonomy' => $taxonomy,
			'term' => $tax_cat->slug,
			'numberposts' => 3,
			'orderby' => 'meta_value_num id',
			'order' => 'ASC',
			'meta_key' => 'result_num'
		)
	);
?>
<?php foreach ( $tax_posts as $tax_post ): ?>
<?php if ( $tax_post->post_parent == 0 ): ?>
					<li class="term-item">
						<?php
							if ( get_post_meta ( $tax_post->ID, 'result_img01_thumbnail' ) ):
								$result_img = wp_get_attachment_image_src ( get_post_meta ( $tax_post->ID, 'result_img01_thumbnail', ture ), 'thumbnail' );
								$result_img_src = $result_img[0];
							elseif ( get_post_meta ( $tax_post->ID, 'result_img01' ) ):
								$result_img = wp_get_attachment_image_src ( get_post_meta ( $tax_post->ID, 'result_img01', ture ), 'thumbnail' );
								$result_img_src = $result_img[0];
							else:
								$result_img_src = '/common/img/common/nophoto_thumb.jpg';
							endif;
						?>
						<div class="photo"><a href="<?php echo get_permalink ( $tax_post->ID ); ?>"><img src="<?php echo $result_img_src; ?>" width="200" height="112" alt="<?php echo get_the_title ( $tax_post->ID ); ?>" /></a></div>
						<div class="title">
							<?php $result_num = get_post_meta ( $tax_post->ID, 'result_num', true ); ?>
							<?php if ( $result_num ) echo sprintf ( '<span class="num">%02d.</span>', $result_num ); ?>
							<h4><a href="<?php echo get_permalink ( $tax_post->ID ); ?>"><?php echo get_the_title ( $tax_post->ID ); ?></a></h4>
						</div>
					</li>
<?php endif; ?>
<?php endforeach; ?>
				</ul>
			</div>
			<?php if ( $tax_posts ): ?><p class="more"><a href="<?php echo get_term_link ( intval ( $tax_cat->term_id ), $taxonomy ); ?>">&raquo;一覧</a></p><?php endif; ?>
		</div>

<?php endforeach; ?>

	</div>

</div>

<?php get_footer(); ?>

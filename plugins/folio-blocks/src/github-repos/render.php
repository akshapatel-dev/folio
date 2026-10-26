<?php
/**
 * Server-side output for the GitHub Repositories block.
 *
 * Available variables: $attributes, $content, $block.
 */

$username   = isset( $attributes['username'] ) ? $attributes['username'] : '';
$count      = isset( $attributes['count'] ) ? max( 1, absint( $attributes['count'] ) ) : 6;
$sort_by    = ( isset( $attributes['sortBy'] ) && 'stars' === $attributes['sortBy'] ) ? 'stars' : 'updated';
$hide_forks = ! isset( $attributes['hideForks'] ) || $attributes['hideForks'];

$repos = folio_blocks_get_github_repos( $username );

if ( is_wp_error( $repos ) ) {
	// Visitors see nothing; editors see why.
	if ( current_user_can( 'edit_posts' ) ) {
		?>
		<div <?php echo get_block_wrapper_attributes( array( 'class' => 'folio-repos' ) ); ?>>
			<p class="folio-repos__notice"><?php echo esc_html( $repos->get_error_message() ); ?></p>
		</div>
		<?php
	}
	return;
}

if ( $hide_forks ) {
	$repos = array_filter( $repos, fn( $repo ) => empty( $repo['is_fork'] ) );
}

if ( 'stars' === $sort_by ) {
	usort( $repos, fn( $a, $b ) => $b['stars'] <=> $a['stars'] );
} else {
	usort( $repos, fn( $a, $b ) => strcmp( $b['updated_at'], $a['updated_at'] ) );
}

$repos = array_slice( array_values( $repos ), 0, $count );
?>
<div <?php echo get_block_wrapper_attributes( array( 'class' => 'folio-repos' ) ); ?>>
	<?php if ( empty( $repos ) ) : ?>
		<p class="folio-repos__notice"><?php esc_html_e( 'No public repositories to show yet.', 'folio-blocks' ); ?></p>
	<?php else : ?>
		<ul class="folio-repos__grid">
			<?php foreach ( $repos as $repo ) : ?>
				<li class="folio-repo">
					<h3 class="folio-repo__name">
						<a href="<?php echo esc_url( $repo['url'] ); ?>" target="_blank" rel="noopener noreferrer">
							<?php echo esc_html( $repo['name'] ); ?>
						</a>
					</h3>
					<p class="folio-repo__desc">
						<?php echo esc_html( $repo['description'] ? $repo['description'] : __( 'No description yet.', 'folio-blocks' ) ); ?>
					</p>
					<p class="folio-repo__meta">
						<?php if ( $repo['language'] ) : ?>
							<span><?php echo esc_html( $repo['language'] ); ?></span>
						<?php endif; ?>
						<span>&#9733; <?php echo esc_html( number_format_i18n( $repo['stars'] ) ); ?></span>
						<span>
							<?php
							echo esc_html(
								wp_date( get_option( 'date_format' ), strtotime( $repo['updated_at'] ) )
							);
							?>
						</span>
					</p>
				</li>
			<?php endforeach; ?>
		</ul>
	<?php endif; ?>
</div>
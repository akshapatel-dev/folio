<?php
/**
 * GitHub API helper for the GitHub Repositories block.
 */

defined( 'ABSPATH' ) || exit;

/**
 * Get a user's public repositories from the GitHub REST API.
 *
 * @param string $username GitHub username.
 * @return array|WP_Error  List of repositories, or an error.
 */
function folio_blocks_get_github_repos( $username ) {
	$username = trim( sanitize_text_field( $username ) );

	// GitHub usernames: letters, numbers and single hyphens, up to 39 characters.
	if ( ! preg_match( '/^[a-z\d](?:[a-z\d]|-(?=[a-z\d])){0,38}$/i', $username ) ) {
		return new WP_Error( 'folio_invalid_user', __( 'Enter a valid GitHub username.', 'folio-blocks' ) );
	}

	$key = strtolower( $username );

	// 1. Return cached data if we have it.
	$cached = get_transient( 'folio_gh_repos_' . $key );
	if ( false !== $cached ) {
		return $cached;
	}

	// 2. If the API failed recently, do not hammer it again.
	$failed = get_transient( 'folio_gh_error_' . $key );
	if ( false !== $failed ) {
		return new WP_Error( 'folio_api_unavailable', $failed );
	}

	// 3. Call the API.
	$headers = array(
		'Accept'     => 'application/vnd.github+json',
		'User-Agent' => 'Folio-Blocks-Plugin',
	);

	// Optional token (higher rate limit). Define it in wp-config.php, never in Git.
	if ( defined( 'FOLIO_GITHUB_TOKEN' ) && FOLIO_GITHUB_TOKEN ) {
		$headers['Authorization'] = 'Bearer ' . FOLIO_GITHUB_TOKEN;
	}

	$response = wp_remote_get(
		'https://api.github.com/users/' . rawurlencode( $username ) . '/repos?per_page=100&sort=updated',
		array(
			'timeout' => 10,
			'headers' => $headers,
		)
	);

	if ( is_wp_error( $response ) ) {
		$message = __( 'Could not reach GitHub. Please try again later.', 'folio-blocks' );
		set_transient( 'folio_gh_error_' . $key, $message, 5 * MINUTE_IN_SECONDS );
		return new WP_Error( 'folio_api_unavailable', $message );
	}

	$code = wp_remote_retrieve_response_code( $response );

	if ( 200 !== $code ) {
		if ( 404 === $code ) {
			$message = __( 'GitHub user not found.', 'folio-blocks' );
		} elseif ( 403 === $code || 429 === $code ) {
			$message = __( 'GitHub rate limit reached. Try again later.', 'folio-blocks' );
		} else {
			$message = __( 'GitHub returned an unexpected response.', 'folio-blocks' );
		}
		set_transient( 'folio_gh_error_' . $key, $message, 5 * MINUTE_IN_SECONDS );
		return new WP_Error( 'folio_api_error', $message );
	}

	$data = json_decode( wp_remote_retrieve_body( $response ), true );
	if ( ! is_array( $data ) ) {
		return new WP_Error( 'folio_bad_json', __( 'Could not read the GitHub response.', 'folio-blocks' ) );
	}

	// 4. Keep only the fields we use, then cache for one hour.
	$repos = array();
	foreach ( $data as $repo ) {
		$repos[] = array(
			'name'        => $repo['name'] ?? '',
			'url'         => $repo['html_url'] ?? '',
			'description' => $repo['description'] ?? '',
			'language'    => $repo['language'] ?? '',
			'stars'       => (int) ( $repo['stargazers_count'] ?? 0 ),
			'forks'       => (int) ( $repo['forks_count'] ?? 0 ),
			'is_fork'     => ! empty( $repo['fork'] ),
			'updated_at'  => $repo['updated_at'] ?? '',
		);
	}

	set_transient( 'folio_gh_repos_' . $key, $repos, HOUR_IN_SECONDS );

	return $repos;
}
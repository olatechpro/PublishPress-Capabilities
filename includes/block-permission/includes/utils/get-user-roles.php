<?php
/**
 * Helper function for retrieving all editable user roles.
 *
 * @package block-permission
 * @since   1.0.0
 */

namespace BlockPermission\Utils;

/**
 * Retrieves all editable user roles on the website
 *
 * @since 1.0.0
 *
 * @return array User $user_roles
 */
function get_user_roles() {

	// Initialize the roles array with the default Public role.
	$roles = array(
		array(
			'name'  => 'public',
			'title' => __( 'Public (Logged-out Users)', 'capsman-enhanced' ),
			'type'  => 'public',
		),
	);

	if ( ! function_exists( 'get_editable_roles' ) ) {
		return $roles;
	}

	$role_types = array(
		'administrator' => 'core',
		'editor'        => 'core',
		'author'        => 'core',
		'contributor'   => 'core',
		'subscriber'    => 'core',
	);

	foreach ( get_editable_roles() as $role_slug => $role_atts ) {
		$atts = array(
			'name'  => $role_slug,
			'title' => $role_atts['name'],
		);

		if ( array_key_exists( $role_slug, $role_types ) ) {
			$atts['type'] = $role_types[ $role_slug ];
		} else {
			$atts['type'] = 'custom';
		}

		$roles[] = $atts;
	}

	return $roles;
}

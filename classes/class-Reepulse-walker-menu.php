<?php
/**
 * Nav Menu API: Walker_Nav_Menu class
 *
 * @package WordPress
 * @subpackage Nav_Menus
 * @since 4.6.0
 */

/**
 * Core class used to implement an HTML list of nav menu items.
 *
 * @since 3.0.0
 *
 * @see Walker
 */
class Mokime_Walker_Nav_Menu extends Walker {

	/**
	 * Traverse elements to create list from elements.
	 *
	 * Display one element if the element doesn't have any children otherwise,
	 * display the element and its children. Will only traverse up to the max
	 * depth and no ignore elements under that depth. It is possible to set the
	 * max depth to include all depths, see walk() method.
	 *
	 * This method should not be called directly, use the walk() method instead.
	 *
	 * @param object $element Data object.
	 * @param array $children_elements List of elements to continue traversing (passed by reference).
	 * @param int $max_depth Max depth to traverse.
	 * @param int $depth Depth of current element.
	 * @param array $args An array of arguments.
	 * @param string $output Used to append additional content (passed by reference).
	 *
	 * @since 2.5.0
	 *
	 */
	public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
		if ( ! $element ) {
			return;
		}

		$id_field = $this->db_fields['id'];
		$id       = $element->$id_field;

		//display this element
		if ( $children_elements ) {
			$this->has_children = ! empty( $children_elements[ $id ] );
		}

		if ( isset( $args[0] ) && is_array( $args[0] ) ) {
			$args[0]['has_children'] = $this->has_children; // Back-compat.
		}

		$this->start_el( $output, $element, $depth, ...array_values( $args ) );

		// descend only when the depth is right and there are childrens for this element
		if ( $children_elements && ( $max_depth == 0 || $max_depth > $depth + 1 ) && isset( $children_elements[ $id ] ) ) {

			foreach ( $children_elements[ $id ] as $child ) {

				if ( ! isset( $newlevel ) ) {
					$newlevel = true;
					//start the child delimiter
					$this->start_lvl( $output, $depth, ...array_values( $args ) );
				}
				$this->display_element( $child, $children_elements, $max_depth, $depth + 1, $args, $output );
			}
			unset( $children_elements[ $id ] );
		}

		if ( isset( $newlevel ) && $newlevel ) {
			//end the child delimiter
			$this->end_lvl( $output, $depth, ...array_values( $args ) );
		}

		//end this element
		$this->end_el( $output, $element, $depth, ...array_values( $args ) );
	}

	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$output .= '';
	}

	public function end_lvl( &$output, $depth = 0, $args = array() ) {
		$output .= '';
	}

	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

		if ($this->hasChildren($item)) {
			$output .= $this->startDropdownButton($item);
		} else {
			$output .= $this->getLinkButton($item);
		}
	}

	public function end_el(&$output, $item, $depth = 0, $args = array()) {

		if ( $args->walker->has_children || $this->hasChildren( $item ) ) {
			$output .= $this->endDropdownButton( $item );
		} else {
			$output .= '';
		}
	}

	public function hasChildren($item) {

		if (in_array("menu-item-has-children", $item->classes)) {
			return true;
		}

		return false;
	}

	public function getLinkButton($item) {
		$url         = $item->url ?? '';
		$classes     = empty( $item->classes ) ? array() : (array) $item->classes;
		$class_names = '';

		if ( in_array( 'current-menu-item', $classes ) ) {
			$class_names .= 'is-active has-text-weight-bold';
		}

		$button = sprintf( "<a href='%s' class='navbar-item %s'>%s</a>", $url, $class_names, $item->title );

		return $button;
	}

	public function startDropdownButton($item ) {
		$url         = $item->url ? $item->url : '';
		$classes     = empty( $item->classes ) ? array() : (array) $item->classes;
		$class_names = '';

		if ( in_array( 'current-menu-item', $classes ) ) {
			$class_names .= 'is-active has-text-weight-bold';
		}

		$button = sprintf( "<a href='%s' class='navbar-link %s is-white'>%s</a>", $url, $class_names, $item->title );

		$dropdown = sprintf( "<div class='navbar-item has-dropdown is-hoverable'>%s", $button);

		$dropdown .= "<div class='navbar-dropdown is-boxed'>";
		return $dropdown;
	}

	public function endDropdownButton($item) {
		return "</div></div>";
	}

}


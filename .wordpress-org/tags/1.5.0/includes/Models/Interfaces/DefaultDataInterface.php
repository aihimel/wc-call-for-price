<?php
namespace WCPress\WCP\Models\Interfaces;

/**
 * Default interface for any data provider
 *
 * @since 1.4.4
 */
interface DefaultDataInterface {
	public function get_default_data(): array;
}

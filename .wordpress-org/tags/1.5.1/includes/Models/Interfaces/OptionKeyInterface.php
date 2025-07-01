<?php
namespace WCPress\WCP\Models\Interfaces;

/**
 * Option key interface to get option key
 *
 * @since 1.4.3
 */
interface OptionKeyInterface {
	public function get_option_key(): string;
}
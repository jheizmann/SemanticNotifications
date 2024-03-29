<?php
/*
 * Copyright (C) Vulcan Inc.
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program.If not, see <http://www.gnu.org/licenses/>.
 *
 */

/**
 * @file
 * @ingroup SemanticNotifications_Storage
 *
 * This file provides the access to the database tables that are
 * used by the semantic notification extension.
 *
 * @author Thomas Schweitzer
 *
 */

global $sgagIP;
require_once $sgagIP . '/includes/SGA_DBHelper.php';


/**
 * This class encapsulates all methods that care about the database tables of
 * the semantic notification extension. It is a singleton that contains an instance
 * of the actual database access object e.g. the Mediawiki SQL database.
 *
 */
class SNStorage {

	//--- Private fields---

	private static $mInstance; // SNStorage: the only instance of this singleton
	private static $mDatabase; // The actual database object

	//--- Constructor ---

	/**
	 * Constructor.
	 * Creates the object that handles the concrete database access.
	 *
	 */
	private function __construct() {
		global $sngIP;
		if (self::$mDatabase == NULL) {
			 
			require_once("$sngIP/storage/SN_StorageSQL.php");
			self::$mDatabase = new SNStorageSQL();

		}

	}

	//--- Public methods ---

	/**
	 * Returns the single instance of this class.
	 *
	 * @return NSStorage
	 * 		The single instance of this class.
	 */
	public static function getInstance() {
		if (!isset(self::$mInstance)) {
			$c = __CLASS__;
			self::$mInstance = new $c;
		}

		return self::$mInstance;
	}

	/**
	 * Returns the actual database.
	 *
	 * @return object
	 * 		The object to access the database.
	 */
	public static function getDatabase() {
		self::getInstance(); // Make sure, singleton is initialized
		return self::$mDatabase;
	}

}
?>

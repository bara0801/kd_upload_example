<?php

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */
/* * *************************************************************
 * Extension Manager/Repository config file for ext: "kd_upload_example"
 *
 * Manual updates:
 * Only the data in the array - anything else is removed by next write.
 * "version" and "dependencies" must not be touched!
 * ************************************************************* */

$EM_CONF[$_EXTKEY] = array(
		'title' => 'Upload Example Extension',
		'description' => 'Example how to use Helhum/UploadExample',
		'category' => 'misc',
		'author' => 'Kevin Ditscheid',
		'author_email' => 'ditscheid@engine-productions.de',
		'author_company' => 'engine-productions GmbH',
		'state' => 'alpha',
		'internal' => '',
		'uploadfolder' => '0',
		'createDirs' => '',
		'clearCacheOnLoad' => 0,
		'version' => '0.0.1',
		'constraints' => array(
				'depends' => array(
						'typo3' => '7.6',
						'upload_example' => '0.0.2'
				),
				'conflicts' => array(
				),
				'suggests' => array(
				),
		),
);

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

namespace KevinDitscheid\KdUploadExample\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\Repository;
use TYPO3\CMS\Extbase\Object\ObjectManagerInterface;
use Helhum\UploadExample\Domain\Model\FileReference;

/**
 * Description of FileReferenceRepository
 *
 * @author Kevin Ditscheid <ditscheid@engine-productions.de>
 */
class FileReferenceRepository extends Repository {

	/**
	 * Constructs a new FileReferenceRepository
	 *
	 * @param ObjectManagerInterface $objectManager The object manager
	 *
	 * @return self
	 */
	public function __construct (ObjectManagerInterface $objectManager) {
		parent::__construct($objectManager);
		// we gonna trick the repository to process other object types then the expected one
		$this->objectType = FileReference::class;
	}

}

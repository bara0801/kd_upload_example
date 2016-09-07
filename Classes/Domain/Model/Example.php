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

namespace KevinDitscheid\KdUploadExample\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;

/**
 * Model of Example
 *
 * @author Kevin Ditscheid <ditscheid@engine-productions.de>
 */
class Example extends AbstractEntity {

	/**
	 * The name of the example object
	 *
	 * @var string
	 */
	protected $name;

	/**
	 * The images of the example object
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
	 * @cascade remove
	 */
	protected $images;

	/**
	 * Get the name
	 *
	 * @return string
	 */
	public function getName () {
		return $this->name;
	}

	/**
	 * Get the images
	 *
	 * @return ObjectStorage
	 */
	public function getImages () {
		return $this->images;
	}

	/**
	 * Set the name
	 *
	 * @param string $name The name to set
	 *
	 * @return void
	 */
	public function setName ($name) {
		$this->name = $name;
	}

	/**
	 * Set the images
	 *
	 * @param ObjectStorage $images The images to set
	 *
	 * @return void
	 */
	public function setImages ($images) {
		$this->images = $images;
	}

	/**
	 * Add an image to the images
	 *
	 * @param FileReference $image The image to add
	 *
	 * @return void
	 */
	public function addImage (FileReference $image) {
		$this->images->attach($image);
	}

	/**
	 * Remove an image from the images
	 *
	 * @param FileReference $image The image to remove
	 *
	 * @return void
	 */
	public function removeImage (FileReference $image) {
		$this->images->detach($image);
	}

}

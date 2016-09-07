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

namespace KevinDitscheid\KdUploadExample\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use KevinDitscheid\KdUploadExample\Domain\Repository\ExampleRepository;
use KevinDitscheid\KdUploadExample\Domain\Model\Example;
use Helhum\UploadExample\Property\TypeConverter\ObjectStorageConverter;
use Helhum\UploadExample\Property\TypeConverter\UploadedFileReferenceConverter;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use KevinDitscheid\KdUploadExample\Domain\Repository\FileReferenceRepository;

/**
 * ExampleController
 *
 * @author Kevin Ditscheid <ditscheid@engine-productions.de>
 */
class ExampleController extends ActionController {

	/**
	 * The example repository
	 *
	 * @var ExampleRepository
	 */
	protected $exampleRepository;

	/**
	 * Inject the example repository
	 *
	 * @param ExampleRepository $exampleRepository The example repository to inject
	 *
	 * @return void
	 */
	public function injectExampleRepository (ExampleRepository $exampleRepository) {
		$this->exampleRepository = $exampleRepository;
	}

	/**
	 * The FileReferenceRepository
	 *
	 * @var FileReferenceRepository
	 */
	protected $fileReferenceRepository;

	/**
	 * Inject the resource factory
	 *
	 * @param FileReferenceRepository $fileReferenceRepository The FileReferenceRepository to inject
	 *
	 * @return void
	 */
	public function injectFileReferenceRepository (FileReferenceRepository $fileReferenceRepository) {
		$this->fileReferenceRepository = $fileReferenceRepository;
	}

	/**
	 * List examples action
	 *
	 * @return void
	 */
	public function listAction () {
		$examples = $this->exampleRepository->findAll();
		$this->view->assign('examples', $examples);
	}

	/**
	 * Show an example action
	 *
	 * @param Example $example The example to show
	 *
	 * @return void
	 */
	public function showAction (Example $example) {
		$this->view->assign('example', $example);
	}

	/**
	 * Edit an example action
	 *
	 * @param Example $example The example to edit
	 *
	 * @return void
	 */
	public function editAction (Example $example) {
		$this->view->assign('example', $example);
	}

	/**
	 * Initialize the update action
	 *
	 * @return void
	 */
	public function initializeUpdateAction () {
		$this->buildMultipleUploadPropertymappingConfiguration('imagesToAdd');
	}

	/**
	 * Update an example action
	 *
	 * @param Example $example The example to update
	 * @param ObjectStorage $imagesToAdd Collection of images to add
	 * @param array $imagesToRemove Collection of images to remove
	 *
	 * @return void
	 */
	public function updateAction (Example $example, ObjectStorage $imagesToAdd = NULL, array $imagesToRemove = NULL) {
		// get the images from the model
		$images = $example->getImages();
		if ( $imagesToRemove !== NULL ) {
			// we gonna remove the file references this way,
			// so the database records will be marked with "deleted = 1"
			// and not simply lose their 'uid_foreign', 'tablenames' and 'fieldname'
			foreach ( $images as $image ) {
				if ( in_array($image->getUid(), $imagesToRemove) ) {
					$this->fileReferenceRepository->remove($image);
				}
			}
		}
		if (
			$imagesToAdd !== NULL &&
			$imagesToAdd->count() > 0
		) {
			// we are going to add all file references that has been submitted
			$images->addAll($imagesToAdd);
		}
		// set the processed images to the model
		$example->setImages($images);
		$this->exampleRepository->update($example);
		$this->redirect('list');
	}

	/**
	 * New example action
	 *
	 * @param Example $example The new example to show
	 *
	 * @return void
	 */
	public function newAction (Example $example = NULL) {
		$this->view->assign('example', $example);
	}

	/**
	 * Initialize the create action
	 *
	 * @return void
	 */
	public function initializeCreateAction () {
		$this->buildMultipleUploadPropertymappingConfiguration('imagesToAdd');
	}

	/**
	 * Create an example action
	 *
	 * @param Example $example The example to create
	 * @param ObjectStorage $imagesToAdd Collection of images to add
	 *
	 * @return void
	 */
	public function createAction (Example $example, ObjectStorage $imagesToAdd = NULL) {
		if (
			$imagesToAdd !== NULL &&
			$imagesToAdd->count() > 0
		) {
			// we are going to add all file references that has been submitted
			$example->setImages($imagesToAdd);
		}
		$this->exampleRepository->add($example);
		$this->redirect('list');
	}

	/**
	 * Delete an example action
	 *
	 * @param Example $example The example to delete
	 *
	 * @return void
	 */
	public function deleteAction (Example $example) {
		$this->exampleRepository->remove($example);
		$this->redirect('list');
	}

	/**
	 * Build the upload property mapping configuration for the given argumentName
	 *
	 * @param string $argumentName The argument name to build the configuration for
	 * @param string $uploadFolder The identifier of the upload folder, 1:user_upload/ by default
	 * @param string $extensions File extensions to allow, defaults to $GLOBALS['TYPO3_CONF_VARS']['SYS']['mediafile_ext']
	 *
	 * @return void
	 */
	public function buildMultipleUploadPropertymappingConfiguration ($argumentName, $uploadFolder = '1:user_upload/',
		$extensions = NULL) {
		if ( $this->arguments->hasArgument($argumentName) ) {
			// get the property mapping configuration object
			$propertyMappingConfiguration = $this->arguments->getArgument($argumentName)->getPropertyMappingConfiguration();
			// create instances of the needed converters
			$objectStorageConverter = $this->objectManager->get(ObjectStorageConverter::class);
			$uploadTypeConverter = $this->objectManager->get(UploadedFileReferenceConverter::class);
			// just to be clear, set the ObjectStorageConverter to the "root"
			$propertyMappingConfiguration->setTypeConverter($objectStorageConverter);
			// select all sub properties, aka files, of the file storage argument
			$fileProperties = $propertyMappingConfiguration->forProperty('*');
			// set the converter and its options
			$fileProperties->setTypeConverter($uploadTypeConverter);
			$fileProperties->setTypeConverterOptions(UploadedFileReferenceConverter::class,
				[
					UploadedFileReferenceConverter::CONFIGURATION_ALLOWED_FILE_EXTENSIONS => $extensions !== NULL ? $extensions : $GLOBALS['TYPO3_CONF_VARS']['SYS']['mediafile_ext'],
					UploadedFileReferenceConverter::CONFIGURATION_UPLOAD_FOLDER => $uploadFolder
				]
			);
		}
	}

}

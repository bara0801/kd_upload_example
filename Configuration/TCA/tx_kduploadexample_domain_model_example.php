<?php

return array(
		'ctrl' => array(
				'title' => 'Example',
				'label' => 'name',
				'tstamp' => 'tstamp',
				'crdate' => 'crdate',
				'cruser_id' => 'cruser_id',
				'dividers2tabs' => TRUE,
				'versioningWS' => 2,
				'versioning_followPages' => TRUE,
				'origUid' => 't3_origuid',
				'languageField' => 'sys_language_uid',
				'transOrigPointerField' => 'l10n_parent',
				'transOrigDiffSourceField' => 'l10n_diffsource',
				'delete' => 'deleted',
				'enablecolumns' => array(
						'disabled' => 'hidden',
						'starttime' => 'starttime',
						'endtime' => 'endtime',
				),
				'searchFields' => 'name'
		),
		'interface' => array(
				'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, name, images',
		),
		'types' => array(
				'1' => array( 'showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, name, images,--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,starttime, endtime' ),
		),
		'palettes' => array(
				'1' => array( 'showitem' => '' ),
		),
		'columns' => array(
				'sys_language_uid' => array(
						'exclude' => 1,
						'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
						'config' => array(
								'type' => 'select',
								'foreign_table' => 'sys_language',
								'foreign_table_where' => 'ORDER BY sys_language.title',
								'items' => array(
										array( 'LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages', -1 ),
										array( 'LLL:EXT:lang/locallang_general.xlf:LGL.default_value', 0 )
								),
						),
				),
				'l10n_parent' => array(
						'displayCond' => 'FIELD:sys_language_uid:>:0',
						'exclude' => 1,
						'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
						'config' => array(
								'type' => 'select',
								'items' => array(
										array( '', 0 ),
								),
								'foreign_table' => 'tx_uploadexample_domain_model_example',
								'foreign_table_where' => 'AND tx_uploadexample_domain_model_example.pid=###CURRENT_PID### AND tx_uploadexample_domain_model_example.sys_language_uid IN (-1,0)',
						),
				),
				'l10n_diffsource' => array(
						'config' => array(
								'type' => 'passthrough',
						),
				),
				't3ver_label' => array(
						'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
						'config' => array(
								'type' => 'input',
								'size' => 30,
								'max' => 255,
						)
				),
				'hidden' => array(
						'exclude' => 1,
						'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
						'config' => array(
								'type' => 'check',
						),
				),
				'starttime' => array(
						'exclude' => 1,
						'l10n_mode' => 'mergeIfNotBlank',
						'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
						'config' => array(
								'type' => 'input',
								'size' => 13,
								'max' => 20,
								'eval' => 'datetime',
								'checkbox' => 0,
								'default' => 0,
						),
				),
				'endtime' => array(
						'exclude' => 1,
						'l10n_mode' => 'mergeIfNotBlank',
						'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
						'config' => array(
								'type' => 'input',
								'size' => 13,
								'max' => 20,
								'eval' => 'datetime',
								'checkbox' => 0,
								'default' => 0,
						),
				),
				'name' => array(
						'exclude' => 0,
						'label' => 'Name',
						'config' => array(
								'type' => 'input',
								'max' => 20,
								'size' => 30,
								'eval' => 'trim,required'
						),
				),
				'images' => array(
						'exclude' => 0,
						'label' => 'Images',
						'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig('images',
							array(
								'appearance' => array(
										'createNewRelationLinkTitle' => 'LLL:EXT:cms/locallang_ttc.xlf:images.addFileReference'
								),
								// custom configuration for displaying fields in the overlay/reference table
								// to use the imageoverlayPalette instead of the basicoverlayPalette
								'foreign_match_fields' => array(
										'fieldname' => 'images',
										'tablenames' => 'tx_kduploadexample_domain_model_example',
										'table_local' => 'sys_file',
								),
								'foreign_types' => array(
										'0' => array(
												'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
										),
										\TYPO3\CMS\Core\Resource\File::FILETYPE_TEXT => array(
												'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
										),
										\TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => array(
												'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
										),
										\TYPO3\CMS\Core\Resource\File::FILETYPE_AUDIO => array(
												'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
										),
										\TYPO3\CMS\Core\Resource\File::FILETYPE_VIDEO => array(
												'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
										),
										\TYPO3\CMS\Core\Resource\File::FILETYPE_APPLICATION => array(
												'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
										)
								)
							), $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'])
				)
		)
);

<?php

$ll = 'LLL:EXT:fbgproject/Resources/Private/Language/locallang_db.xlf:';

return [
    'ctrl' => [
        'title' => $ll . 'project',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'versioningWS' => true,
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'searchFields' => 'title,teaser,description',
        'iconfile' => 'EXT:fbgproject/Resources/Public/Icons/project.png'
    ],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, path_segment, teaser, description, students, studentsfreetext, lecturers, lecturersfreetext, category, degreecourse, semester, date, copartner, copartnerlink, thumbimage, topimage, media, lightboxstyle',
    ],
    'types' => [
        '1' => ['showitem' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, path_segment, teaser, description, students, studentsfreetext, lecturers, lecturersfreetext, category, degreecourse, semester, date, copartner, copartnerlink, thumbimage, topimage, media, lightboxstyle, --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access, starttime, endtime'],
    ],
    'columns' => [
        'sys_language_uid' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'special' => 'languages',
                'items' => [
                    [
                        'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.allLanguages',
                        -1,
                        'flags-multiple'
                    ]
                ],
                'default' => 0,
            ],
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'default' => 0,
                'items' => [
                    ['', 0],
                ],
                'foreign_table' => 'tx_fbgproject_domain_model_project',
                'foreign_table_where' => 'AND {#tx_fbgproject_domain_model_project}.{#pid}=###CURRENT_PID### AND {#tx_fbgproject_domain_model_project}.{#sys_language_uid} IN (-1,0)',
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        't3ver_label' => [
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.versionLabel',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
            ],
        ],
        'hidden' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.visible',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'items' => [
                    [
                        0 => '',
                        1 => '',
                        'invertStateDisplay' => true
                    ]
                ],
            ],
        ],
        'starttime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.starttime',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime,int',
                'default' => 0,
                'behaviour' => [
                    'allowLanguageSynchronization' => true
                ]
            ],
        ],
        'endtime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.endtime',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime,int',
                'default' => 0,
                'range' => [
                    'upper' => mktime(0, 0, 0, 1, 1, 2038)
                ],
                'behaviour' => [
                    'allowLanguageSynchronization' => true
                ]
            ],
        ],
        
        'title' => [
            'exclude' => true,
            'label' => $ll . 'title',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required'
            ],
        ],
        
 		'path_segment' => [
            'exclude' => true,
            'label' => $ll . 'slug',
            'config' => [
                'type' => 'slug',
                'size' => 50,
                'generatorOptions' => [
                    'fields' => ['title'],
		              'replacements' => [
		                  	'/' => '-',
		                  	'.' => '',
		                  	'®' => '',
		                  	',' => '',
		         			'|' => '',
		         			' ' => '-',
		              ],
                ],
                'fallbackCharacter' => '-',
                'default' => ''
            ]
        ],  
        
        'teaser' => [
            'exclude' => true,
            'label' => $ll . 'teaser',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 3,
                'eval' => 'trim'
            ]
        ],
        'description' => [
            'exclude' => true,
            'label' => $ll . 'description',
            'config' => [
                'type' => 'text',
                'enableRichtext' => true,
                'richtextConfiguration' => 'default',
                'fieldControl' => [
                    'fullScreenRichtext' => [
                        'disabled' => false,
                    ],
                ],
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
            ],
            
        ],
        
        'students' => [
            'exclude' => true,
            'label' => $ll . 'students',
            'config' => [
		        'type' => 'select',
		        'renderType' => 'selectMultipleSideBySide',
		        'foreign_table' => 'fe_users',
                'foreign_table_where' => (isset($GLOBALS['TYPO3_CONF_VARS']['EXTENSIONS']['fbgproject']['userGroupStudentsUid'])) ? ' AND fe_users.usergroup LIKE "%' . (int)$GLOBALS['TYPO3_CONF_VARS']['EXTENSIONS']['fbgproject']['userGroupStudentsUid'] . '%" ORDER BY fe_users.name' : ' ORDER BY fe_users.name',
                'MM' => 'tx_fbgproject_domain_model_students_mm',
                'size' => 5,
                'minitems' => 0,
                'maxitems' => 10,
                'enableMultiSelectFilterTextfield' => TRUE,
		    ],
        ],
        
        'studentsfreetext' => [
            'exclude' => true,
            'label' => $ll . 'studentsfreetext',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
		
        'lecturers' => [
            'exclude' => true,
            'label' => $ll . 'lecturers',
            'config' => [
		        'type' => 'select',
		        'renderType' => 'selectMultipleSideBySide',
		        'foreign_table' => 'fe_users',
                'foreign_table_where' => (isset($GLOBALS['TYPO3_CONF_VARS']['EXTENSIONS']['fbgproject']['userGroupLecturesUid'])) ? ' AND fe_users.usergroup LIKE "%' . (int)$GLOBALS['TYPO3_CONF_VARS']['EXTENSIONS']['fbgproject']['userGroupLecturesUid'] . '%" ORDER BY fe_users.name' : ' ORDER BY fe_users.name',
                'MM' => 'tx_fbgproject_domain_model_lecturers_mm',
                'size' => 5,
                'minitems' => 0,
                'maxitems' => 10,
                'enableMultiSelectFilterTextfield' => TRUE,
		    ],
        ],
        
        'lecturersfreetext' => [
            'exclude' => true,
            'label' => $ll . 'lecturersfreetext',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        
        'degreecourse' => [
            'exclude' => true,
            'label' => $ll . 'degreecourse',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_fbgproject_domain_model_degreecourse',
                'items' => [
                    [
                        0 => $ll .'select',
                    ]
                ],
                'default' => 0,
                'minitems' => 1,
                'maxitems' => 1,
                'eval' => 'required'
            ],

        ],
		
        'semester' => [
            'exclude' => true,
            'label' => $ll . 'semester',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_fbgproject_domain_model_semester',
                'foreign_table_where' => 'AND 1=1 ORDER BY title DESC',
                'items' => [
                    [
                        0 => $ll .'select',0,
                    ]
                ],
                'default' => 0,
                'minitems' => 0,
                'maxitems' => 1,
            ],

        ],
        'category' => [
            'exclude' => true,
            'label' => $ll . 'category',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_fbgproject_domain_model_category',
                'items' => [
                    [
                        0 => $ll .'select',0,
                    ]
                ],
                'default' => 0,
                'minitems' => 0,
                'maxitems' => 1,
            ],

        ],
        'date' => [
            'exclude' => true,
            'label' => $ll . 'date',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'copartner' => [
            'exclude' => true,
            'label' => $ll . 'copartner',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'copartnerlink' => [
            'exclude' => true,
            'label' => $ll . 'copartnerlink',
            'config' => [
	            'type' => 'input',
	            'renderType' => 'inputLink',
            ],
        ],

        'thumbimage' => [
            'exclude' => true,
            'label' => $ll . 'thumbimage',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                'thumb',
                [
                    'appearance' => [
                        'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:images.addFileReference'
                    ],
                    'overrideChildTca' => [
                        'types' => [
                            '0' => [
                                'showitem' => '
                                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                                --palette--;;filePalette'
                            ],
                            \TYPO3\CMS\Core\Resource\File::FILETYPE_TEXT => [
                                'showitem' => '
                                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                                --palette--;;filePalette'
                            ],
                            \TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
                                'showitem' => '
                                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                                --palette--;;filePalette'
                            ]
                        ],
                    ],
                    'foreign_match_fields' => [
                        'fieldname' => 'thumb',
                        'tablenames' => 'tx_fbgproject_domain_model_project',
                        'table_local' => 'sys_file',
                    ],
                    'maxitems' => 1
                ],
                'jpg,jpeg,tif,tiff,tga,png'
            ),
            
        ],
	
        'topimage' => [
            'exclude' => true,
            'label' => $ll . 'topimage',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                'topimage',
                [
                    'appearance' => [
                        'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:images.addFileReference'
                    ],
                    'overrideChildTca' => [
                        'types' => [
                            '0' => [
                                'showitem' => '
                                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                                --palette--;;filePalette'
                            ],
                            \TYPO3\CMS\Core\Resource\File::FILETYPE_TEXT => [
                                'showitem' => '
                                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                                --palette--;;filePalette'
                            ],
                            \TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
                                'showitem' => '
                                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                                --palette--;;filePalette'
                            ]
                        ],
                    ],
                    'foreign_match_fields' => [
                        'fieldname' => 'topimage',
                        'tablenames' => 'tx_fbgproject_domain_model_project',
                        'table_local' => 'sys_file',
                    ],
                    'maxitems' => 1
                ],
                'jpg,jpeg,tif,tiff,tga,png,vimeo,youtube'
            ),
            
        ],
        
        'media' => [
            'exclude' => 0,
            'label' => $ll . 'media',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                'media',
                [
                    'behaviour' => [
                        'allowLanguageSynchronization' => true,
                    ],
                    'appearance' => [
                        'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:images.addFileReference',
                        'showPossibleLocalizationRecords' => true,
                        'showRemovedLocalizationRecords' => true,
                        'showAllLocalizationLink' => true,
                        'showSynchronizationLink' => true
                    ],
                    'foreign_match_fields' => [
                        'fieldname' => 'media',
                        'tablenames' => 'tx_fbgproject_domain_model_project',
                        'table_local' => 'sys_file',
                    ],
                    // custom configuration for displaying fields in the overlay/reference table
                    // to use the newsPalette and imageoverlayPalette instead of the basicoverlayPalette
                    'overrideChildTca' => [
                        'types' => [
                            \TYPO3\CMS\Core\Resource\File::FILETYPE_UNKNOWN => [
                                'showitem' => '
                                    --palette--;LLL:EXT:core/Resources/Private/Language/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;newsPalette,
                                    --palette--;;imageoverlayPalette,
                                    --palette--;;filePalette'
                            ],
                            \TYPO3\CMS\Core\Resource\File::FILETYPE_TEXT => [
                                'showitem' => '
                                    --palette--;LLL:EXT:core/Resources/Private/Language/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;newsPalette,
                                    --palette--;;imageoverlayPalette,
                                    --palette--;;filePalette'
                            ],
                            \TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
                                'showitem' => '
                                    --palette--;LLL:EXT:core/Resources/Private/Language/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;newsPalette,
                                    --palette--;;imageoverlayPalette,
                                    --palette--;;filePalette'
                            ],
                            \TYPO3\CMS\Core\Resource\File::FILETYPE_AUDIO => [
                                'showitem' => '
                                    --palette--;LLL:EXT:core/Resources/Private/Language/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;newsPalette,
                                    --palette--;;audioOverlayPalette,
                                    --palette--;;filePalette'
                            ],
                            \TYPO3\CMS\Core\Resource\File::FILETYPE_VIDEO => [
                                'showitem' => '
                                    --palette--;LLL:EXT:core/Resources/Private/Language/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;newsPalette,
                                    --palette--;;videoOverlayPalette,
                                    --palette--;;filePalette'
                            ],
                            \TYPO3\CMS\Core\Resource\File::FILETYPE_APPLICATION => [
                                'showitem' => '
                                    --palette--;LLL:EXT:core/Resources/Private/Language/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;newsPalette,
                                    --palette--;;imageoverlayPalette,
                                    --palette--;;filePalette'
                            ]
                        ],
                    ],
                    'maxitems' => 10
                ],
                $GLOBALS['TYPO3_CONF_VARS']['SYS']['mediafile_ext']
                )
        ],

       'lightboxstyle' => [
           'exclude' => true,
           'label' => 'LLL:EXT:t3up_image/Resources/Private/Language/locallang_backend.xlf:lightboxstyle',
           'config' => [
               'type' => 'select',
               'renderType' => 'selectSingle',
               'items' => [
                   ['LLL:EXT:t3up_image/Resources/Private/Language/locallang_backend.xlf:lightboxstyle0', 0],
                   ['LLL:EXT:t3up_image/Resources/Private/Language/locallang_backend.xlf:lightboxstyle1', 'a'],
                   ['LLL:EXT:t3up_image/Resources/Private/Language/locallang_backend.xlf:lightboxstyle2', 'b'],
                   ['LLL:EXT:t3up_image/Resources/Private/Language/locallang_backend.xlf:lightboxstyle3', 'c'],
                   ['LLL:EXT:t3up_image/Resources/Private/Language/locallang_backend.xlf:lightboxstyle4', 'd'],
                   ['LLL:EXT:t3up_image/Resources/Private/Language/locallang_backend.xlf:lightboxstyle5', 'e'],
                   ],
                'default' => 'b',
           ]
       ],

    ],
];

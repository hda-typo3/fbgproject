CREATE TABLE tx_fbgproject_domain_model_project (
	title varchar(255) DEFAULT '' NOT NULL,
	teaser text,
	description text,
	students int(11) unsigned DEFAULT '0' NOT NULL,
	studentsfreetext varchar(255) DEFAULT '' NOT NULL,
    lecturers int(11) unsigned DEFAULT '0' NOT NULL,
	lecturersfreetext varchar(255) DEFAULT '' NOT NULL,
	degreecourse int(11) DEFAULT '0' NOT NULL,
	date varchar(255) DEFAULT '' NOT NULL,
	copartner varchar(255) DEFAULT '' NOT NULL,
	copartnerlink varchar(255) DEFAULT '' NOT NULL,
	topimage int(11) unsigned NOT NULL default '0',
	media int(11) unsigned DEFAULT '0' NOT NULL,
	thumbimage int(11) unsigned DEFAULT '0' NOT NULL,
	semester int(11) unsigned DEFAULT '0',
	category int(11) unsigned DEFAULT '0',
	lightboxstyle varchar(11) DEFAULT '' NOT NULL,	
	path_segment varchar(2048),
);

CREATE TABLE tx_fbgproject_domain_model_students_mm (
	uid_local int(11) unsigned DEFAULT '0' NOT NULL,
	uid_foreign int(11) unsigned DEFAULT '0' NOT NULL,
	sorting int(11) unsigned DEFAULT '0' NOT NULL,
	sorting_foreign int(11) unsigned DEFAULT '0' NOT NULL,

	PRIMARY KEY (uid_local,uid_foreign),
	KEY uid_local (uid_local),
	KEY uid_foreign (uid_foreign)
);

CREATE TABLE tx_fbgproject_domain_model_lecturers_mm (
	uid_local int(11) unsigned DEFAULT '0' NOT NULL,
	uid_foreign int(11) unsigned DEFAULT '0' NOT NULL,
	sorting int(11) unsigned DEFAULT '0' NOT NULL,
	sorting_foreign int(11) unsigned DEFAULT '0' NOT NULL,

	PRIMARY KEY (uid_local,uid_foreign),
	KEY uid_local (uid_local),
	KEY uid_foreign (uid_foreign)
);


CREATE TABLE tx_fbgproject_domain_model_semester (
	title varchar(255) NOT NULL DEFAULT ''
);

CREATE TABLE tx_fbgproject_domain_model_category (
	title varchar(255) NOT NULL DEFAULT ''
);

CREATE TABLE tx_fbgproject_domain_model_degreecourse (
	title varchar(255) DEFAULT '' NOT NULL
);

CREATE TABLE tx_fbgproject_domain_model_project (
	categories int(11) unsigned DEFAULT '0' NOT NULL
);



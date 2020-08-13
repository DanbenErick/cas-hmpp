CREATE TABLE roles (
    id int NOT NULL AUTO_INCREMENT,
    name_rol varchar(30) NOT NULL,
    CONSTRAINT PK_Roles PRIMARY KEY (id)
);

CREATE TABLE users (
    id int NOT NULL AUTO_INCREMENT,
    name varchar(30) NOT NULL,
    user varchar(30) NOT NULL,
    password varchar(255),
    id_rol int NOT NULL,
    accepted tinyint NOT NULL,
    CONSTRAINT PK_Users PRIMARY KEY (id),
    CONSTRAINT UC_User UNIQUE (user),
    CONSTRAINT FK_Users_Rol FOREIGN KEY (id_rol) REFERENCES Roles(id)
);

CREATE TABLE permissions (
    id int NOT NULL AUTO_INCREMENT,
    name_permission varchar(30) NOT NULL,
    id_permission int NOT NULL,
    id_rol int NOT NULL,
    CONSTRAINT PK_Permissions PRIMARY KEY (id),
    CONSTRAINT FK_Roles FOREIGN KEY (id_rol) REFERENCES Roles(id)
);
CREATE TABLE announcements (
    id int NOT NULL AUTO_INCREMENT,
    denomination varchar(40),
    f_publication Date NOT NULL,
    f_cv_start Date NOT NULL,
    f_cv_end Date NOT NULL,
    f_eval_cv_start Date,
    f_eval_cv_end Date NOT NULL,
    f_publication_accepted Date NOT NULL,
    f_interview_start Date NOT NULL,
    f_interview_end Date NOT NULL,
    f_publication_end Date NOT NULL,
    f_start_work Date NOT NULL,
    id_creator int NOT NULL,
    f_creation Date NOT NULL,
    f_last_edition Date NOT NULL,
    quantity_edition int NOT NULL,
    state boolean NOT NULL,
    visible boolean NOT NULL,
    CONSTRAINT PK_Announcements PRIMARY KEY (id),
    CONSTRAINT FK_Announcement_Users FOREIGN KEY (id_creator) REFERENCES Users(id)
);

CREATE TABLE documents (
    id int NOT NULL AUTO_INCREMENT,
    cod_document varchar(30) NOT NULL,
    name_document varchar(50) NOT NULL,
    path_document varchar(100) NOT NULL,
    id_creator int NOT NULL,
    id_denomination int NOT NULL,
    CONSTRAINT PK_Documents PRIMARY KEY (id),
    CONSTRAINT FK_Documents_Users FOREIGN KEY (id_creator) REFERENCES Users(id),
    CONSTRAINT FK_Documents_Announcement FOREIGN KEY (id_denomination) REFERENCES Announcements(id)
);
CREATE TABLE workplaces (
    id int NOT NULL AUTO_INCREMENT,
    cod_workplace varchar(30) NOT NULL,
    work_position varchar(50) NOT NULL,
    id_denomination int NOT NULL,
    id_creator int NOT NULL,
    CONSTRAINT PK_Workplaces PRIMARY KEY (id),
    CONSTRAINT FK_Workplaces_Announcement FOREIGN KEY (id_denomination) REFERENCES Announcements(id),
    CONSTRAINT FK_Workplaces_Users FOREIGN KEY (id_creator) REFERENCES Users(id)
);

CREATE TABLE applicants (
    id int NOT NULL AUTO_INCREMENT,
    name varchar(40) NOT NULL,
    lastname varchar(40) NOT NULL,
    dni varchar(8) NOT NULL,
    phone varchar(9) NOT NULL,
    path varchar(100) NOT NULL,
    datetime Date NOT NULL,
    id_workplace int NOT NULL,
    id_denomination int NOT NULL,
    accepted int NOT NULL,
    CONSTRAINT PK_Applicants PRIMARY KEy (id),
    CONSTRAINT FK_Applicants_Announcement FOREIGN KEY (id_denomination) REFERENCES Announcements(id),
    CONSTRAINT FK_Applicants_Workplace FOREIGN KEY (id_workplace) REFERENCES Workplaces(id)
);


-- Insercion de datos

insert into roles (name_rol) values ('Sistema'), ('Supervisor');

-- Permisos de Usuarios

insert into permissions (name_permission, id_permission, id_rol) values
("CRUD CONVOCATORY", 1, 1),
("CRUD WORKPLACE", 2, 1),
("CRUD DOCUMENT", 3, 1),
("CRUD APPLICANTS", 4, 2);

-- Usuario de Prueba announcements

INSERT into users (name, user, password, id_rol) values
('admin', 'admin', '$2y$10$bLRiOKAFGwgQRKPVYGBPMOmqH53/BzKTkjbQs1kc5k.n14C8P0pKO', 1),
('super','super','$2y$10$bLRiOKAFGwgQRKPVYGBPMOmqH53/BzKTkjbQs1kc5k.n14C8P0pKO',2)

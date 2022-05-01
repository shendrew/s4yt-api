CREATE TABLE users (
    id int PRIMARY KEY,
    name varchar(50) NOT NULL,
    email varchar(50) NOT NULL UNIQUE,
    password varchar(50) NOT NULL,
    education_id int NOT NULL,
    grade_id int,
    school varchar(50),
    FOREIGN KEY (education_id) REFERENCES educations(id)
    FOREIGN KEY (grade_id) REFERENCES grades(id),
);

CREATE TABLE educations {
    id int PRIMARY KEY,
    name varchar(50) NOT NULL
}

CREATE TABLE grades {
    id int PRIMARY KEY,
    name varchar(50) NOT NULL
}

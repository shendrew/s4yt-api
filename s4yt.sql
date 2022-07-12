CREATE TABLE users {
    id int PRIMARY KEY,
    name varchar(50) NOT NULL,
    email varchar(50) NOT NULL UNIQUE,
    password varchar(50) NOT NULL,

    referred_by int NULLABLE,
    referral_code varchar(50) NOT NULL UNIQUE,
    FOREIGN KEY (referred_by) REFERENCES users(id),

    coins int,

    userable_id int unsigned,
    userable_type varchar(50) unsigned
};

CREATE TABLE players {
    id int PRIMARY KEY,
    education_id int NOT NULL,
    grade_id int,
    school varchar(50),
    FOREIGN KEY (education_id) REFERENCES educations(id),
    FOREIGN KEY (grade_id) REFERENCES grades(id),

    country varchar(50),
    state varchar(3),
    city_id int,
}

CREATE TABLE educations {
    id int PRIMARY KEY,
    name varchar(50) NOT NULL
}

CREATE TABLE grades {
    id int PRIMARY KEY,
    name varchar(50) NOT NULL
}

CREATE TABLE coins {
    id int PRIMARY KEY,
    available tinyint DEFAULT 1,
    user_id int NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
}

CREATE TABLE versions {
    id int PRIMARY KEY,
    year int NOT NULL,
    month int NOT NULL
}

CREATE TABLE version_users {
    id int PRIMARY KEY,
    user_id int NOT NULL,
    version_id int NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (version_id) REFERENCES versions(id)
}

CREATE TABLE sponsors {
    id int PRIMARY KEY,
    name varchar(50) NOT NULL,
    sponsorable_id int unsigned,
    sponsorable_type varchar(50) unsigned
}

CREATE TABLE business_sponsors {
    id int PRIMARY KEY,
    question text(50)
}

CREATE TABLE raffle_sponsors {
    id int PRIMARY KEY,
}

CREATE TABLE partner_sponsors {
    id int PRIMARY KEY,
}

CREATE TABLE raffle_items {
    id int PRIMARY KEY,
    name varchar(50) NOT NULL,
    description text(50),
    stock int,
    version_user_id int,
    FOREIGN KEY (version_user_id) REFERENCES version_users(id)
}

CREATE TABLE users (
  id INT NOT NULL,
  name VARCHAR(100) NOT NULL,
  password VARCHAR(100) NOT NULL,
  created_at DATETIME NOT NULL,
  updated_at DATETIME NOT NULL,
  deleted_at DATETIME NOT NULL,
  PRIMARY KEY (id)
);


CREATE TABLE todos (
  id INT NOT NULL,
  user_id INT NOT NULL,
  title VARCHAR(100) NOT NULL,
  details TEXT,
  status INT NOT NULL,
  created_at DATETIME NOT NULL,
  updated_at DATETIME NOT NULL,
  deleted_at DATETIME NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (user_id) REFERENCES users(id)
  ON UPDATE CASCADE
  ON DELETE CASCADE
);

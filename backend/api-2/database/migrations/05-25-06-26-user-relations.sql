USE clockwise;

ALTER TABLE users
ADD CONSTRAINT fk_users_role_id
FOREIGN KEY (role_id)
REFERENCES user_roles(role_id)
ON UPDATE CASCADE
ON DELETE RESTRICT;

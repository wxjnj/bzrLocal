CREATE TABLE client (id BIGINT AUTO_INCREMENT, name VARCHAR(255), subdomain VARCHAR(50), UNIQUE INDEX subdomain_index_idx (subdomain), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE page (id BIGINT AUTO_INCREMENT, title VARCHAR(255), slug VARCHAR(255), content LONGTEXT, client_id BIGINT, UNIQUE INDEX slug_index_idx (slug, client_id), INDEX client_id_idx (client_id), PRIMARY KEY(id)) ENGINE = INNODB;
ALTER TABLE page ADD CONSTRAINT page_client_id_client_id FOREIGN KEY (client_id) REFERENCES client(id) ON DELETE CASCADE;

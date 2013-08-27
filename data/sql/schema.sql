CREATE TABLE activity (id BIGINT AUTO_INCREMENT, token VARCHAR(255) NOT NULL UNIQUE, title VARCHAR(255) NOT NULL, content LONGTEXT, weight BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE advertising (id BIGINT AUTO_INCREMENT, title VARCHAR(255) NOT NULL, picture VARCHAR(255) NOT NULL, url TEXT, content LONGTEXT, type VARCHAR(255) DEFAULT '1', PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE ans (id BIGINT AUTO_INCREMENT, token VARCHAR(255) NOT NULL UNIQUE, content TEXT, attachment VARCHAR(255), attachment_name VARCHAR(255), attachment_size BIGINT, need_id BIGINT, user_id BIGINT, is_true TINYINT(1) DEFAULT '0', created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX user_id_idx (user_id), INDEX need_id_idx (need_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE apply (id BIGINT AUTO_INCREMENT, company VARCHAR(255), contacter VARCHAR(255), address VARCHAR(255), tel VARCHAR(255), content TEXT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE category (id BIGINT AUTO_INCREMENT, token VARCHAR(255) NOT NULL UNIQUE, name VARCHAR(100) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE classes (id BIGINT AUTO_INCREMENT, token VARCHAR(255) NOT NULL UNIQUE, name VARCHAR(50) NOT NULL, description TEXT, user_id BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE classes_student (classes_id BIGINT, user_id BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(classes_id, user_id)) ENGINE = INNODB;
CREATE TABLE download_records (id BIGINT AUTO_INCREMENT, file_id BIGINT, user_id BIGINT, price BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX user_id_idx (user_id), INDEX file_id_idx (file_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE expert (id BIGINT AUTO_INCREMENT, token VARCHAR(255) NOT NULL UNIQUE, name VARCHAR(50) NOT NULL, job VARCHAR(255), sub_description TEXT, direction TEXT, description LONGTEXT, picture VARCHAR(255), weight BIGINT, type VARCHAR(255) DEFAULT '1', user_id BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX user_id_idx (user_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE file (id BIGINT AUTO_INCREMENT, token VARCHAR(255) NOT NULL UNIQUE, title VARCHAR(255) NOT NULL, sub_description TEXT, keywords VARCHAR(255), category_id BIGINT, user_id BIGINT, price VARCHAR(255) DEFAULT '1', is_security TINYINT(1) DEFAULT '0', attachment VARCHAR(255) NOT NULL, attachment_name VARCHAR(255), attachment_size BIGINT, read_num BIGINT, picture VARCHAR(255), is_rank TINYINT(1) DEFAULT '0', created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX user_id_idx (user_id), INDEX category_id_idx (category_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE images (id BIGINT AUTO_INCREMENT, title VARCHAR(255) NOT NULL, picture VARCHAR(255) NOT NULL, url TEXT, content LONGTEXT, weight BIGINT, type VARCHAR(255) DEFAULT '1', PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE job (id BIGINT AUTO_INCREMENT, token VARCHAR(255) NOT NULL UNIQUE, title VARCHAR(255) NOT NULL, content LONGTEXT, attachment VARCHAR(255), attachment_name VARCHAR(255), work_id BIGINT, user_id BIGINT, weight BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX user_id_idx (user_id), INDEX work_id_idx (work_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE link (id BIGINT AUTO_INCREMENT, title VARCHAR(255) NOT NULL, url TEXT NOT NULL, weight BIGINT, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE need (id BIGINT AUTO_INCREMENT, token VARCHAR(255) NOT NULL UNIQUE, title VARCHAR(255) NOT NULL, description TEXT, price BIGINT, user_id BIGINT, is_finish TINYINT(1) DEFAULT '0', created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX user_id_idx (user_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE notice (id BIGINT AUTO_INCREMENT, token VARCHAR(255) NOT NULL UNIQUE, title VARCHAR(255) NOT NULL, content LONGTEXT, weight BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE question (id BIGINT AUTO_INCREMENT, token VARCHAR(255) NOT NULL UNIQUE, title VARCHAR(255) NOT NULL, content LONGTEXT, expert_id BIGINT, user_id BIGINT, answer_content LONGTEXT, is_finish TINYINT(1) DEFAULT '0', created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX user_id_idx (user_id), INDEX expert_id_idx (expert_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE share (id BIGINT AUTO_INCREMENT, token VARCHAR(255) NOT NULL UNIQUE, title VARCHAR(255) NOT NULL, picture VARCHAR(255), sub_description TEXT, content LONGTEXT, weight BIGINT, user_id BIGINT, is_rank TINYINT(1) DEFAULT '0', created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX user_id_idx (user_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE success_case (id BIGINT AUTO_INCREMENT, token VARCHAR(255) NOT NULL UNIQUE, title VARCHAR(255) NOT NULL, url TEXT, content LONGTEXT, weight BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE topic (id BIGINT AUTO_INCREMENT, token VARCHAR(255) NOT NULL UNIQUE, title VARCHAR(255) NOT NULL, url TEXT, content LONGTEXT, weight BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE video (id BIGINT AUTO_INCREMENT, token VARCHAR(255) NOT NULL UNIQUE, title VARCHAR(255) NOT NULL, experter VARCHAR(50), sub_description TEXT, attachment VARCHAR(255), attachment_name VARCHAR(255), url VARCHAR(255) NOT NULL, url_name VARCHAR(255), thumbnailspath VARCHAR(255), weight BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE work (id BIGINT AUTO_INCREMENT, token VARCHAR(255) NOT NULL UNIQUE, title VARCHAR(255) NOT NULL, picture VARCHAR(255), sub_description TEXT, end_time DATETIME, video VARCHAR(255), video_name VARCHAR(255), video_url TEXT, weight BIGINT, classes_id BIGINT, user_id BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX user_id_idx (user_id), INDEX classes_id_idx (classes_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_forgot_password (id BIGINT AUTO_INCREMENT, user_id BIGINT NOT NULL, unique_key VARCHAR(255), expires_at DATETIME NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX user_id_idx (user_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_group (id BIGINT AUTO_INCREMENT, name VARCHAR(255) UNIQUE, description TEXT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_group_permission (group_id BIGINT, permission_id BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(group_id, permission_id)) ENGINE = INNODB;
CREATE TABLE sf_guard_permission (id BIGINT AUTO_INCREMENT, name VARCHAR(255) UNIQUE, description TEXT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_remember_key (id BIGINT AUTO_INCREMENT, user_id BIGINT, remember_key VARCHAR(32), ip_address VARCHAR(50), created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX user_id_idx (user_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_user (id BIGINT AUTO_INCREMENT, first_name VARCHAR(255), last_name VARCHAR(255), real_name VARCHAR(255), nick_name VARCHAR(255), email_address VARCHAR(255) NOT NULL UNIQUE, username VARCHAR(128) NOT NULL UNIQUE, algorithm VARCHAR(128) DEFAULT 'sha1' NOT NULL, salt VARCHAR(128), password VARCHAR(128), is_active TINYINT(1) DEFAULT '1', is_super_admin TINYINT(1) DEFAULT '0', last_login DATETIME, last_ip VARCHAR(255), customstatus VARCHAR(255), idiograph VARCHAR(255), introduce VARCHAR(255), sex VARCHAR(255) DEFAULT '0', birthday DATETIME, phone VARCHAR(20), adress VARCHAR(250), qq VARCHAR(125), card VARCHAR(125), role_manager_bbs_id BIGINT, rank BIGINT DEFAULT 0, experience BIGINT DEFAULT 0, display_type VARCHAR(255) DEFAULT '0', head_portrait VARCHAR(255), questions VARCHAR(255) DEFAULT '0', answer VARCHAR(255), token VARCHAR(255), classes_id BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX is_active_idx_idx (is_active), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_user_group (user_id BIGINT, group_id BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(user_id, group_id)) ENGINE = INNODB;
CREATE TABLE sf_guard_user_permission (user_id BIGINT, permission_id BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(user_id, permission_id)) ENGINE = INNODB;
ALTER TABLE ans ADD CONSTRAINT ans_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id);
ALTER TABLE ans ADD CONSTRAINT ans_need_id_need_id FOREIGN KEY (need_id) REFERENCES need(id);
ALTER TABLE classes_student ADD CONSTRAINT classes_student_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE classes_student ADD CONSTRAINT classes_student_classes_id_classes_id FOREIGN KEY (classes_id) REFERENCES classes(id) ON DELETE CASCADE;
ALTER TABLE download_records ADD CONSTRAINT download_records_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id);
ALTER TABLE download_records ADD CONSTRAINT download_records_file_id_file_id FOREIGN KEY (file_id) REFERENCES file(id);
ALTER TABLE expert ADD CONSTRAINT expert_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id);
ALTER TABLE file ADD CONSTRAINT file_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id);
ALTER TABLE file ADD CONSTRAINT file_category_id_category_id FOREIGN KEY (category_id) REFERENCES category(id);
ALTER TABLE job ADD CONSTRAINT job_work_id_work_id FOREIGN KEY (work_id) REFERENCES work(id);
ALTER TABLE job ADD CONSTRAINT job_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id);
ALTER TABLE need ADD CONSTRAINT need_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id);
ALTER TABLE question ADD CONSTRAINT question_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id);
ALTER TABLE question ADD CONSTRAINT question_expert_id_expert_id FOREIGN KEY (expert_id) REFERENCES expert(id);
ALTER TABLE share ADD CONSTRAINT share_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id);
ALTER TABLE work ADD CONSTRAINT work_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id);
ALTER TABLE work ADD CONSTRAINT work_classes_id_classes_id FOREIGN KEY (classes_id) REFERENCES classes(id);
ALTER TABLE sf_guard_forgot_password ADD CONSTRAINT sf_guard_forgot_password_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_group_permission ADD CONSTRAINT sf_guard_group_permission_permission_id_sf_guard_permission_id FOREIGN KEY (permission_id) REFERENCES sf_guard_permission(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_group_permission ADD CONSTRAINT sf_guard_group_permission_group_id_sf_guard_group_id FOREIGN KEY (group_id) REFERENCES sf_guard_group(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_remember_key ADD CONSTRAINT sf_guard_remember_key_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_group ADD CONSTRAINT sf_guard_user_group_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_group ADD CONSTRAINT sf_guard_user_group_group_id_sf_guard_group_id FOREIGN KEY (group_id) REFERENCES sf_guard_group(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_permission ADD CONSTRAINT sf_guard_user_permission_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_permission ADD CONSTRAINT sf_guard_user_permission_permission_id_sf_guard_permission_id FOREIGN KEY (permission_id) REFERENCES sf_guard_permission(id) ON DELETE CASCADE;
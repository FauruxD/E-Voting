CREATE DATABASE IF NOT EXISTS evoting_bem
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE evoting_bem;

CREATE TABLE users (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    npm VARCHAR(30) NOT NULL UNIQUE,
    name VARCHAR(255) NOT NULL,
    faculty VARCHAR(255) NULL,
    major VARCHAR(255) NULL,
    pin VARCHAR(255) NOT NULL,
    role ENUM('voter', 'admin') NOT NULL DEFAULT 'voter',
    has_voted BOOLEAN NOT NULL DEFAULT FALSE,
    is_active BOOLEAN NOT NULL DEFAULT TRUE,
    remember_token VARCHAR(100) NULL,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,
    INDEX idx_users_role (role),
    INDEX idx_users_has_voted (has_voted),
    INDEX idx_users_is_active (is_active)
);

CREATE TABLE settings (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    app_name VARCHAR(255) NOT NULL DEFAULT 'BEM E-Voting',
    election_title VARCHAR(255) NOT NULL DEFAULT 'Pemilihan Umum BEM 2026',
    voting_status ENUM('open', 'closed') NOT NULL DEFAULT 'closed',
    result_visibility BOOLEAN NOT NULL DEFAULT FALSE,
    voting_start DATETIME NULL,
    voting_end DATETIME NULL,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL
);

CREATE TABLE candidates (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    serial_number INT NOT NULL UNIQUE,
    chairman_name VARCHAR(255) NOT NULL,
    vice_name VARCHAR(255) NOT NULL,
    faculty VARCHAR(255) NULL,
    major VARCHAR(255) NULL,
    batch VARCHAR(50) NULL,
    vision TEXT NOT NULL,
    mission LONGTEXT NOT NULL,
    work_programs JSON NULL,
    photo VARCHAR(255) NULL,
    status ENUM('verified', 'pending') NOT NULL DEFAULT 'pending',
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,
    INDEX idx_candidates_status (status),
    INDEX idx_candidates_serial_number (serial_number)
);

CREATE TABLE votes (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NOT NULL UNIQUE,
    candidate_id BIGINT UNSIGNED NOT NULL,
    voted_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,
    CONSTRAINT fk_votes_user_id FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    CONSTRAINT fk_votes_candidate_id FOREIGN KEY (candidate_id) REFERENCES candidates(id) ON DELETE CASCADE,
    INDEX idx_votes_candidate_id (candidate_id),
    INDEX idx_votes_voted_at (voted_at)
);

CREATE TABLE audit_logs (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NULL,
    action VARCHAR(255) NOT NULL,
    ip_address VARCHAR(45) NULL,
    user_agent TEXT NULL,
    metadata JSON NULL,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,
    CONSTRAINT fk_audit_logs_user_id FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL,
    INDEX idx_audit_logs_user_id (user_id),
    INDEX idx_audit_logs_action (action),
    INDEX idx_audit_logs_created_at (created_at)
);

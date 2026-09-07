-- Performance indexes for existing Himrishtey installations.
--
-- These are additive only: no records or existing columns are modified. They
-- support the dashboard/profile activity counters and wallet lookup paths.
-- Check whether an index already exists before running a statement on another
-- environment (the local DDEV `db` database already has these indexes).

ALTER TABLE profile_viewed
    ADD INDEX idx_profile_viewed_member_id_id (member_id, id);

ALTER TABLE profile_like
    ADD INDEX idx_profile_like_user_id_profile_id (user_id, like_profile_id),
    ADD INDEX idx_profile_like_profile_id_id (like_profile_id, id);

ALTER TABLE viewed_contacts
    ADD INDEX idx_viewed_contacts_member_id_id (member_id, id);

ALTER TABLE short_listed
    ADD INDEX idx_short_listed_member_id_profile_id (member_id, profile_id);

ALTER TABLE member_wallet
    ADD INDEX idx_member_wallet_member_id_created_at (member_id, created_at);

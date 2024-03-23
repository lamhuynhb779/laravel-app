explain SELECT * FROM laraveldb.posts as p where p.user_id = 8 and p.status = 1; -- IDX_USER_ID

explain SELECT * FROM laraveldb.posts as p where p.status = 1 and p.user_id = 8; -- IDX_USER_ID

explain SELECT * FROM laraveldb.posts as p where p.user_id = 8 or p.status = 1; -- NONE

explain SELECT * FROM laraveldb.posts as p where p.user_id = 8 and p.title = 'Magnam est qui ab rerum sit.'; -- IDX_USER_ID

explain SELECT * FROM laraveldb.posts as p where p.title = 'Magnam est qui ab rerum sit.' and p.content = 'dd'; -- NONE

explain SELECT * FROM laraveldb.posts as p where p.status = 0; -- IDX_STATUS

explain SELECT * FROM laraveldb.posts as p where p.title = 'Magnam est qui ab rerum sit.'; -- NONE

show indexes FROM laraveldb.posts;
-- IDX_USER_ID (user_id, status, title)
-- IDX_STATUS (status)

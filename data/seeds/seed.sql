INSERT INTO users(id, name, password)
 VALUES
  (1, "taro", "yamada"),
  (2, "jiro", "tanaka"),
  (3, "saburo", "morita");


INSERT INTO todos(id, user_id, title, details, status)
 VALUES
  (1, 1, "taroのタスク", "taroのタスク詳細", 1),
  (2, 1, "taroの未完了タスク", "taroの未完了タスク詳細", 0),
  (3, 2, "jiroのタスク", "jiroのタスク詳細", 1),
  (4, 2, "jiroの未完了タスク", "jiroの未完了タスク詳細", 0),
  (5, 3, "saburoのタスク", "saburoのタスク詳細", 1),
  (6, 3, "saburoの未完了タスク", "saburoの未完了タスク詳細", 0);

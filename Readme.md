#お手軽LAMP環境構築
PHP + Nginx + MySQL

#ファイル置き場
appディレクトリ配下に置いてください。

```
# Dockerのコンテナの起動
docker-compose up -d
docker-compose up -d --build

# コンテナIDの確認
docker ps

# mysqlコマンドでMySqlにログイン[方法1]
docker exec -it [コンテナID] mysql -u [ユーザー] -p
# mysqlコマンドでMySqlにログイン[方法2]
docker exec -it [コンテナID] /bin/bash
mysql -u [ユーザー] -p


# DBの選択
show databases;
use [DB名];

# MySQLにデータ挿入
```




----------------------------------------------------------------
▼TODOリスト
----------------------------------------------------------------
さて、次ですが、
TODOリストを素のPHPで実装しようと思いますがよろしいですか？
FWでよく使用されるMVCモデルを意識したファイル構成にしているので、
今後、フレームワークを使用される際も、理解が深まるかなと思います。
欲しい機能としては、
一覧画面
詳細
新規登録
編集
削除
ログイン機能
ユーザー登録画面
ユーザー編集画面
ですね。
一覧画面に、テーブルでTODOリストを表示させ、
タイトルをクリックすると詳細画面に遷移
詳細画面で編集ボタンがあり、押下すると、編集画面に遷移
一覧画面には新規作成ボタンを用意して、押下すると、新規作成画面に遷移
一覧画面の各TODOリストの左端には削除ボタンを用意し、
クリックすると削除できる
というような画面を想定しています。
イメージ湧きますかね？
もし問題なければ、まずはテーブル設計から始めていきたいと思います
todosテーブル
id
user_id
title
...
のように必要なテーブル構成を書いてみてください。
せっかくですので、ER図の作成をしてみましょうか。ブラウザで簡単にER図が書ける
https://ondras.zarovi.cz/sql/demo/?keyword=defaulthttp://www.kaasan.info/archives/3733
ER図の作り方【簡易版】
https://qiita.com/ykwp21/items/fac0e257317cea32d2d1
ER図を一度でも書いた経験があるのと、ないのとでは、全く違ってくると思いますので、
こちら、簡単に書いてみてください＾＾
ER図を作成できましたら、XMLでエクスポートできると思いますので
そちらをこちらに貼ってみてください。テーブル定義のレビューから始めます。
合わせて、docker でPHPの開発環境のご用意もお願いします。
docker をインストールしていない場合は、インストールしていただき、
docker-compose の設定ファイルは私が用意したので
よろしかったら使ってみてください＾＾
youtube で簡単に動画作成しているので、よろしければ参考にしてください
https://www.youtube.com/watch?v=oJnOMjLders&t=71s






----------------------------------------------------------------
▼テーブル設計
----------------------------------------------------------------
考えてみました！ご確認お願いします！
<?xml version="1.0" encoding="utf-8" ?>
<!-- SQL XML created by WWW SQL Designer, https://github.com/ondras/wwwsqldesigner/ -->
<!-- Active URL: https://ondras.zarovi.cz/sql/demo/?keyword=defaulthttp://www.kaasan.info/archives/3733 -->
<sql>
<datatypes db="mysql">
	<group label="Numeric" color="rgb(238,238,170)">
		<type label="Integer" length="0" sql="INTEGER" quote=""/>
	 	<type label="TINYINT" length="0" sql="TINYINT" quote=""/>
	 	<type label="SMALLINT" length="0" sql="SMALLINT" quote=""/>
	 	<type label="MEDIUMINT" length="0" sql="MEDIUMINT" quote=""/>
	 	<type label="INT" length="0" sql="INT" quote=""/>
		<type label="BIGINT" length="0" sql="BIGINT" quote=""/>
		<type label="Decimal" length="1" sql="DECIMAL" re="DEC" quote=""/>
		<type label="Single precision" length="0" sql="FLOAT" quote=""/>
		<type label="Double precision" length="0" sql="DOUBLE" re="DOUBLE" quote=""/>
	</group>

	<group label="Character" color="rgb(255,200,200)">
		<type label="Char" length="1" sql="CHAR" quote="'"/>
		<type label="Varchar" length="1" sql="VARCHAR" quote="'"/>
		<type label="Text" length="0" sql="MEDIUMTEXT" re="TEXT" quote="'"/>
		<type label="Binary" length="1" sql="BINARY" quote="'"/>
		<type label="Varbinary" length="1" sql="VARBINARY" quote="'"/>
		<type label="BLOB" length="0" sql="BLOB" re="BLOB" quote="'"/>
	</group>

	<group label="Date &amp; Time" color="rgb(200,255,200)">
		<type label="Date" length="0" sql="DATE" quote="'"/>
		<type label="Time" length="0" sql="TIME" quote="'"/>
		<type label="Datetime" length="0" sql="DATETIME" quote="'"/>
		<type label="Year" length="0" sql="YEAR" quote=""/>
		<type label="Timestamp" length="0" sql="TIMESTAMP" quote="'"/>
	</group>
	
	<group label="Miscellaneous" color="rgb(200,200,255)">
		<type label="ENUM" length="1" sql="ENUM" quote=""/>
		<type label="SET" length="1" sql="SET" quote=""/>
		<type label="Bit" length="0" sql="bit" quote=""/>
	</group>
</datatypes><table x="10" y="10" name="user">
<row name="id" null="1" autoincrement="1">
<datatype>INTEGER</datatype>
<default>NULL</default></row>
<row name="user" null="1" autoincrement="0">
<datatype>VARCHAR</datatype>
<default>NULL</default></row>
<row name="password" null="1" autoincrement="0">
<datatype>VARCHAR</datatype>
<default>NULL</default></row>
<key type="PRIMARY" name="">
<part>id</part>
</key>
</table>
<table x="222" y="10" name="todo">
<row name="id" null="1" autoincrement="1">
<datatype>INTEGER</datatype>
<default>NULL</default></row>
<row name="id_user" null="1" autoincrement="0">
<datatype>INTEGER</datatype>
<default>NULL</default><relation table="user" row="id" />
</row>
<row name="title" null="1" autoincrement="0">
<datatype>VARCHAR</datatype>
<default>NULL</default></row>
<row name="details" null="1" autoincrement="0">
<datatype>MEDIUMTEXT</datatype>
<default>NULL</default></row>
<key type="PRIMARY" name="">
<part>id</part>
</key>
</table>
</sql>


マイケル
  22:30
ER図作成していただけましたね！
まずテーブル名ですが、複数形で宣言してみましょう
userではなく、usersといたしましょう。
LaravelのようなFWを使用する際に、
自動でモデルクラスの複数形をテーブル名と認識してくれるような機能があるので
テーブル名を複数形で宣言することを習慣化しておくといいと思います。
id_user カラムですが、user_idというカラム名の方が一般的と思います
このカラムとusers テーブルのidカラムがひもつくことで、どのユーザーのTODOなのか判別できます
それぞれのテーブルに
created_at, updated_at, deleted_at カラムを追加してみましょう
型はdatetime型にします
datetime型のカラム名を~_at で統一することで、
カラム名を見ただけでカラムの型を推測することができるようになります。
レコードを削除する時にdeleted_atに削除した日付を保存してあげることで、
もしdeleted_atに値があれば、そのレコードは削除されたものとしてみなすことができます
これを論理削除といいます
一方、レコードごと削除することを物理削除といいます
物理削除だと、もし運用中に何か問題があった場合、レコードを削除してしまっているので
調査が困難になります。
なので、なるべく論理削除する設計にすることが多いです。
userテーブルのuser カラムですが、用途がカラム名から不明なので
ここはユーザー名を意味するnameというカラムにしましょう
型はvarcharでOKです
varcharは代入された文字列分だけメモリを確保します。
文字数はnameに使用する文字数分だけリミットをつけましょう
TODOのステータスを管理するためのstatusというカラムを追加しましょう
これはint(１桁）で管理してみましょうか
0: 未完了 1: 完了
のように管理できそうですかね
全てのカラムがNULL許可になっていますが、もう一度精査してみてください
このあたり修正してみてください＾＾


陽- よう
  09:31
ご丁寧にありがとうございます。
修正しました。ご確認お願いいたします。
<?xml version="1.0" encoding="utf-8" ?>
<!-- SQL XML created by WWW SQL Designer, https://github.com/ondras/wwwsqldesigner/ -->
<!-- Active URL: https://ondras.zarovi.cz/sql/demo/?keyword=defaulthttp://www.kaasan.info/archives/3733 -->
<sql>
<datatypes db="mysql">
	<group label="Numeric" color="rgb(238,238,170)">
		<type label="Integer" length="0" sql="INTEGER" quote=""/>
	 	<type label="TINYINT" length="0" sql="TINYINT" quote=""/>
	 	<type label="SMALLINT" length="0" sql="SMALLINT" quote=""/>
	 	<type label="MEDIUMINT" length="0" sql="MEDIUMINT" quote=""/>
	 	<type label="INT" length="0" sql="INT" quote=""/>
		<type label="BIGINT" length="0" sql="BIGINT" quote=""/>
		<type label="Decimal" length="1" sql="DECIMAL" re="DEC" quote=""/>
		<type label="Single precision" length="0" sql="FLOAT" quote=""/>
		<type label="Double precision" length="0" sql="DOUBLE" re="DOUBLE" quote=""/>
	</group>

	<group label="Character" color="rgb(255,200,200)">
		<type label="Char" length="1" sql="CHAR" quote="'"/>
		<type label="Varchar" length="1" sql="VARCHAR" quote="'"/>
		<type label="Text" length="0" sql="MEDIUMTEXT" re="TEXT" quote="'"/>
		<type label="Binary" length="1" sql="BINARY" quote="'"/>
		<type label="Varbinary" length="1" sql="VARBINARY" quote="'"/>
		<type label="BLOB" length="0" sql="BLOB" re="BLOB" quote="'"/>
	</group>

	<group label="Date &amp; Time" color="rgb(200,255,200)">
		<type label="Date" length="0" sql="DATE" quote="'"/>
		<type label="Time" length="0" sql="TIME" quote="'"/>
		<type label="Datetime" length="0" sql="DATETIME" quote="'"/>
		<type label="Year" length="0" sql="YEAR" quote=""/>
		<type label="Timestamp" length="0" sql="TIMESTAMP" quote="'"/>
	</group>
	
	<group label="Miscellaneous" color="rgb(200,200,255)">
		<type label="ENUM" length="1" sql="ENUM" quote=""/>
		<type label="SET" length="1" sql="SET" quote=""/>
		<type label="Bit" length="0" sql="bit" quote=""/>
	</group>
</datatypes><table x="10" y="10" name="users">
<row name="id" null="0" autoincrement="1">
<datatype>INTEGER</datatype>
<default>NULL</default></row>
<row name="name" null="0" autoincrement="0">
<datatype>VARCHAR(100)</datatype>
<default>'NULL'</default></row>
<row name="password" null="0" autoincrement="0">
<datatype>VARCHAR(100)</datatype>
<default>'NULL'</default></row>
<row name="created_at" null="0" autoincrement="0">
<datatype>DATETIME</datatype>
<default>'NULL'</default></row>
<row name="updated_at" null="0" autoincrement="0">
<datatype>DATETIME</datatype>
<default>'NULL'</default></row>
<row name="deleted_at" null="0" autoincrement="0">
<datatype>DATETIME</datatype>
<default>'NULL'</default></row>
<key type="PRIMARY" name="">
<part>id</part>
</key>
</table>
<table x="222" y="10" name="todos">
<row name="id" null="1" autoincrement="1">
<datatype>INTEGER</datatype>
<default>NULL</default></row>
<row name="user_id" null="0" autoincrement="0">
<datatype>INTEGER</datatype>
<default>NULL</default><relation table="users" row="id" />
</row>
<row name="title" null="0" autoincrement="0">
<datatype>VARCHAR</datatype>
<default>'NULL'</default></row>
<row name="details" null="1" autoincrement="0">
<datatype>MEDIUMTEXT</datatype>
<default>NULL</default></row>
<row name="status" null="0" autoincrement="0">
<datatype>INT</datatype>
<default>NULL</default></row>
<row name="created_at" null="0" autoincrement="0">
<datatype>DATETIME</datatype>
<default>'NULL'</default></row>
<row name="updated_at" null="0" autoincrement="0">
<datatype>DATETIME</datatype>
<default>'NULL'</default></row>
<row name="deleted_at" null="0" autoincrement="0">
<datatype>DATETIME</datatype>
<default>'NULL'</default></row>
<key type="PRIMARY" name="">
<part>id</part>
</key>
</table>
</sql>






----------------------------------------------------------------
▼テーブル作成
----------------------------------------------------------------
ER図修正していただけましたね！
OKです！問題ありません
さて、これでテーブル定義は問題ないと思うので
次は実際にDBにテーブルを作成してみましょう
dockerで環境を構築していただき、
MySQL上にDBを作成し、テーブルを作成してみましょう
youtube で簡単に動画作成しているので、よろしければ参考にしてください
https://www.youtube.com/watch?v=oJnOMjLders&t=71s
ご自身が作成したテーブル定義通りにcreate tableのクエリを作成し、
そのクエリを実行して、テーブルを作成してみてください。
実行したクエリも確認するので、
テーブルが作成できましたら、実行したクエリもこちらに貼ってみてください
ちょっと難しいかもですが、もしハマりそうならお気軽にご質問ください＾＾


ありがとうございます。
docker環境構築について質問させてください。
作り方としては、docker内に
・PHP
・MySQL
のサーバーを立てて、docker内で、
MySQLのテーブルを作成するという認識でよろしいでしょうか？


マイケル
  13:12
docker-compose.yml を用意したので、
https://github.com/ProWebEngineer/docker-lemp
このリポジトリをForkしていただき、
ローカルPCにdockerデスクトップをインストールしていただくと、docker-composeが一緒にインストールされるので
フォークしたリポジトリをgit clone して
docker-compose.yml のDB設定を修正し
docker-compose up -d 
でコンテナを起動できると思います
これだけで、PHPの開発環境は用意できるので
コンテナを起動した状態で
docker exec コマンドでDBコンテナに入って
mysqlコマンドでMySqlにログインできることをまず確認してみてください！ （編集済み） 
DockerDocker
Home - Docker
Learn how Atomist will help Docker meet the challenge of securing secure software supply chains for development teams.
Written by
James Ratliff
Time to read
23 minutes
5月11日
https://www.docker.com/

ProWebEngineer/docker-lemp
Stars
5
Language
Dockerfile
投稿したメンバー: GitHub


陽- よう
  09:49
ありがとうございます。ログインできました！
DBテーブルを作成してみます！
:+1:
1





----------------------------------------------------------------
▼質問
作ってみたのですが、アドバイスお願いしたいです！
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
  ON DELETE SET NULL
);
上記で実行すると、todosの方を作ろうとしたときに、
ERROR 1215 (HY000): Cannot add foreign key constraint
というエラーが発生します。
こちらを試してみたのですが、ダメでした。
https://isgs-lab.com/424/




▼回答
すみません、遅くなりました。
クエリのシンタックスは問題なさそうですね！
試しに自分のローカルでも実行して、エラー内容を確認してみました。
https://taupe.site/entry/cannot-add-foreign-key-constraint/
この記事を参考に
root ユーザーでmysqlにログインして
SHOW ENGINE INNODB STATUS\G
を入力すると、直近の外部キーのエラーが確認できました。
------------------------
LATEST FOREIGN KEY ERROR
------------------------
2022-10-09 12:42:08 0x7f149c4e4700 Error in foreign key constraint of table common/todos:
FOREIGN KEY (user_id) REFERENCES users(id)   ON UPDATE CASCADE   ON DELETE SET NULL ):
You have defined a SET NULL condition though some of the
columns are defined as NOT NULL.
そうすると、
NOT NULLに設定しているカラムに対して、親レコードを削除した時にNULLをセットしようとしていて
エラーが発生しているようです。
  FOREIGN KEY (user_id) REFERENCES users(id)
  ON UPDATE CASCADE
  ON DELETE SET NULL
);
ここでクエリを見返してみると
 ON DELETE SET NULL
ここで削除した時にNULLをセットしようとしていてエラーがでてそうです。
https://www.guri2o1667.work/entry/2020/10/27/%E3%80%90MySQL%E3%80%91%E5%A4%96%E9%83%A8%E3%82%AD%E3%83%BC%E5%88%B6%E7%B4%84%EF%BC%88ForeignKey%E5%88%B6%E7%B4%84%EF%BC%89%E3%81%AEon_delete%E8%A8%AD%E5%AE%9A%E3%81%AB%E3%81%A4%E3%81%84%E3%81%A6
ここは親レコードが削除された時は子レコードも削除するような挙動がよさそうですかね
参考にクエリを修正してみてください＾＾








----------------------------------------------------------------
▼ダミーデータインサート【課題】
----------------------------------------------------------------
テーブルが作成できましたら、
次はダミーデータをインサートしてみましょう
todos, usersテーブルにテストデータをインサートしてみてください
また、今回からgithubでプロジェクトを管理していきましょう
githubにリポジトリを作成していただき、pushしてみてください
また作成したクエリはSQLファイルを作成し、git管理しておきましょう
data/migratesというディレクトリを作成して、この配下にmigrate.sqlというファイルを作成
実行したcreate table のクエリを記載しておきましょう
また、data/seedsというディレクトリを作成して、この配下にseed.sql というファイルを作成
このファイルに、ダミーデータとして実行するinsert文を記載してみましょう
ここまでできたら、
まずはPHPでダミーデータを取得して、ブラウザに表示するところまでやってみたいです！
トライしてみてください＾＾


お疲れ様です。アドバイスお願いします。
下記のように作ったのですが、ブラウン表示の際に下記エラーが発生します。
Fatal error: Uncaught PDOException: SQLSTATE[HY000] [2002] No such file or directory in /var/www/html/app/index.php:16 Stack trace: #0 /var/www/html/app/index.php(16): PDO->__construct('mysql:dbname=to...', 'root', 'root', Array) #1 {main} thrown in /var/www/html/app/index.php on line 16
どのように対応したらよろしいでしょうか？
https://github.com/shenbaoblog/todo_php/blob/main/app/index.php

index.php
<!DOCTYPE html>
html lang="en"
head
  meta charset="UTF-8"
  meta http-equiv="X-UA-Compatible" content="IE=edge"
もっと表示する
<https://github.com/shenbaoblog/todo_php|shenbaoblog/todo_php>shenbaoblog/todo_php | 投稿したメンバー: GitHub
New


マイケル
  18:57
git cloneして動作確認してみますと、
エラーメッセージの内容が違うようでした。
Fatal error: Uncaught PDOException: SQLSTATE[HY000] [2002] Connection refused in /var/www/html/app/index.php:16 Stack trace: #0 /var/www/html/app/index.php(16): PDO->__construct('mysql:dbname=to...', 'yohei', 'yj558055', Array) #1 {main} thrown in /var/www/html/app/index.php on line 16
DBの接続に失敗してそうです。
$dsn = 'mysql:dbname=todo;host=127.0.0.1;port=3306;charset=utf8mb4';
mysqlのhostに設定されている値を修正する必要がありそうです。
ここに設定する値はmysqlのhostを設定する必要があるのですが、
dockerの場合は、docker-compose.ymlに設定されているサービス名を記載してあげればOKです！
今回はmysqlですかね
$dsn = 'mysql:dbname=todo;host=mysql;port=3306;charset=utf8mb4';
こちらで試してみてください＾＾


ありがとうございます。
ブラウザにデータ表示させるまではできました。
ご確認ください。
https://gyazo.com/9264ed198653ad348d2e02b335479dc1

GyazoGyazo (90 kB)
https://gyazo.com/9264ed198653ad348d2e02b335479dc1



陽- よう
  09:54
その上で、いくつか質問させてください。
【質問1】
今回、docker-compose.ymlファイルにて、
MYSQL_DATABASE: todo
としています。こちらなのですが、途中で、
db_todo に変更するために、
MYSQL_DATABASE: db_todo
 として、docker-lempを削除して、もう一度
docker-compose build
docker-compose up -d
をしたのですが、
db_todoは、作成されずtodo のままでした。
一度、docker-compose buildをしてしまった場合、db_todoをdocker-compose経由で作成することはできないのでしょうか？
【質問2】
現在、DB内に日本語情報を入力すると、消えてしまいます。
文字コードをutf8に変更する設定を行ったのですが、それでもだめなようです。
どのようにしたら、日本語を入力できるでしょうか？ （編集済み） 
New


マイケル
  14:01
【質問1】
docker-compose でDBのデータに永続性を持たせているので
再度、コンテナを作ってもDBが変更されないのですね
ボリュームの設定はdocker-compose.yml の
volumes:
  mysql-data:
ここでやってます
この記事が参考になると思いますが
https://qiita.com/Ikumi/items/b319a12d7e2c9f7b904d
docker volume list
と入力すると、
現在ローカルPCに作られているボリューム一覧が表示されると思います
この中の任意のボリュームを削除してあげて、
再度、コンテナを起動するとDBが初期化されると思います
docker volume rm todo_php_mysql-data
こちら試してみてください＾＾
MySQLの日本語化は、また別途ご返信します！

マイケル
  13:59
git pull してコンテナをビルドし直してみますと、
コンテナがビルドできなくなっていたので
docker/mysql/Dockerfile に問題ありそうです
FROM ubuntu:latest
RUN touch test
RUN echo 'hello world' > test

#使うDockerイメージ  
FROM mysql:5.7
FROMはベースとなるイメージなので、一つを指定することが一般的と思います
mysql イメージのOSはdebian のようなので、ubuntuのOSを最初に指定しており、不具合起きてそうです

FROM mysql:5.7-debian

RUN apt-get update \
    && apt-get install -y locales \
    && sed -i -e 's/# \(ja_JP.UTF-8\)/\1/' /etc/locale.gen \
    && locale-gen \
    && update-locale LANG=ja_JP.UTF-8 \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*
ENV LC_ALL ja_JP.UTF-8
この内容で更新してみると、どうでしょうか？
docker-compose は問題内容に見えます







----------------------------------------------------------------
▼リファクタ
----------------------------------------------------------------

日本語入力できたのですね！よかったです＾＾
utf8mb4 に変換したいのは、絵文字を保存したいからなのかなと思いますが、
character_set_database がutf8mb4なので問題ないかなと思うのと、
実務では、絵文字をそのままDBに保存することは少なく、
保存時にマークダウンなどに変換して、文字列として保存することもあります。
参考)
https://feeld-uni.com/?p=2154
そうすると、絵文字は![img]~のような文字列でDBに保存されるようなイメージです。
今回は、取り急ぎ、今のDB設定のままいきましょうか。
さて、リファクタリングしていきます。
app/index.php
ですが、views/todoというディレクトリを作成して、
index.php はこの配下に移動させましょうか
<body>
  <?php
現在、phpタグはbodyタグの中に書かれていますが
PHP の処理は、ファイルの冒頭に書くようにしましょうか
<?php 
//PHP処理

?>
<!DOCTYPE html>
<html lang="en">
htmlタグのlanがen になっているのでja にしておきましょう。
$dsn = 'mysql:dbname=db_todo;host=mysql;port=3306;charset=utf8';
$username = 'yohei';
$password = 'yj558055';
$driver_options = [ PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ];
このあたりのDB接続情報は、configに書くようにしてみましょうか。
接続情報を書いてみましょう
app/config/db_connect.php のようなファイルを用意して
この中に接続情報を書いてみましょう
配列を返すようにすればOKです
イメージとしては
return array(
    "dsn" => "",
    "username" => "",
    "username" => ""
);
このような感じですかね
TODOリストは
foreach ($todos as $todo) {
    echo "{$todo['id']},{$todo['user_id']},{$todo['title']},{$todo['details']},{$todo['status']},{$todo['created_at']},{$todo['updated_at']},{$todo['updated_at']},{$todo['deleted_at']}<br />";
}
echoで出力するのではなく、
liタグで表示するようにしてみましょうか
<ul>
    <?php foreach(//条件):?>
        <li>//TODOのタイトル</li>
    <?php endforeach;?>
</ul>
このような感じになるかなと思います。
このあたり、修正してみてください＾＾


マイケル
  22:09
いい感じですね！
configのところですが、
function dbConnectInfo ($dns, $username, $password, $driver_options) {

  return array(
      "dsn" => "mysql:dbname=db_todo;host=mysql;port=3306;charset=utf8",
      "username" => "yohei",
      "password" => "yj558055",
      "driver_options" => [ PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ],
  );
}
関数を定義せずとも
return array(
      "dsn" => "mysql:dbname=db_todo;host=mysql;port=3306;charset=utf8",
      "username" => "yohei",
      "password" => "yj558055",
      "driver_options" => [ PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ],
  );
  
これだけdb_connect.php に記載すれば
$config = require_once('config/db_connect.php');
のように書けば、配列を取得できるかなと思います。
また、
$dsn = 'mysql:dbname=db_todo;host=mysql;port=3306;charset=utf8';
  $username = 'yohei';
  $password = 'yj558055';
  $driver_options = [ PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ];
  
これらの変数は、configから値を取得して処理を書いてみてください。








----------------------------------------------------------------
▼コントローラー作成
----------------------------------------------------------------
続いて、コントローラーを作成してみましょうか
app/controllersというディレクトリを作成して、
この配下にTodoController.phpを作成
このファイルにTodoControllerを宣言
このクラスにindexメソッドを宣言して、
この中に
try {
    $pdo = new PDO($dsn, $username, $password, $driver_options);
  } catch (PDOException $e){
    print('Connection failed:'.$e->getMessage());
    die();
  }


  $sql = 'SELECT * FROM users';
  if($prepare = $pdo->prepare($sql)) {
    $prepare->execute();
    $users = $prepare->fetchAll(PDO::FETCH_ASSOC);
  }
  
  $sql = 'SELECT * FROM todos';
  if($prepare = $pdo->prepare($sql)) {
    $prepare->execute();
    $todos = $prepare->fetchAll(PDO::FETCH_ASSOC);
  }
このあたりの処理を移行させましょう
view 側はコントローラーのindexメソッドを呼ぶことで
データを取得するようにしてみたいです
このあたり修正してみてください＾＾



----------------------------------------------------------------
▼return　について
----------------------------------------------------------------
陽- よう
  09:53
ありがとうございます。1点質問させてください。
return array(
      "dsn" => "mysql:dbname=db_todo;host=mysql;port=3306;charset=utf8",
      "username" => "yohei",
      "password" => "yj558055",
      "driver_options" => [ PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ],
  );
こちらは、どうしてreturnが必要なのでしょうか？
$config = require_once('config/db_connect.php');
すると、下記記述になる認識なのですが、変数にreturnすることは、できないと思うのですが、実際に記述してみると、問題なく動いている理由がわかりません。
$config = return array(
  "dsn" => "mysql:dbname=db_todo;host=mysql;port=3306;charset=utf8",
  "username" => "yohei",
  "password" => "yj558055",
  "driver_options" => [ PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ],
);
New


マイケル
  09:30
これはPHP の仕様なので、公式を見てみましょう
https://www.php.net/manual/ja/function.return.php
関数内で呼び出されると、return文は即座に その関数の実行を停止し、引数を関数の値として返します。
これは今までやってきた関数内の処理ですね
グローバルスコープで呼び出されると、現在実行中のスクリプトが終了 します。もしそのスクリプトが include もしくは require されたものである場合、制御は呼び出し元 のファイルに戻ります。また、そのスクリプトが include されたものである場合は、returnに与えられた引数 の値は include の戻り値となります。
と記載ありますので、requireなどで読み込まれた場合は、
returnの引数の値を読み込み元に返す仕様になってます
この書き方は、FWでもよく使用されている書き方なので、
ぜひ抑えてみてください＾＾



----------------------------------------------------------------
▼docker　document root について
----------------------------------------------------------------
陽- よう
  09:32
また、もう1点質問させてください。
今回、/appディレクトリが、ドキュメントルートになっていますが、これは、どこdocker-compose.ymlの
    depends_on: # 追加
      - app
の部分の記述で、/appと/var/www/html/appを紐付けているのでしょうか？
ドキュメントルート自体は、/docker/web/default.conf内の
server {
    listen 80;

    root  /var/www/html/app;
で設定しているのだと思っています。
ご回答よろしくお願いいたします。
New


マイケル
  23:18
すみません、遅くなりました。
ドキュメントルートは、
ご察しの通り、/docker/web/default.conf
で設定しています
このコンフィグは、nginxの設定ファイルになります。
root  /var/www/html/app;
index index.php index.html index.htm;
このように記載することで、ドキュメントルートは/var/www/html/app配下を参照
URLにファイル名を指定しない場合は、自動で
index index.php index.html index.htm;
これらのファイルを参照しにいくような設定になっています。
なので、/var/www/html/app/index.php のようなファイルを作成すれば
localhost:8000
にアクセスすれば、ファイル名をURLに指定せずとも表示されると思います。
docker-compose.yml のdepends_onに関しては
自分もよくわかっていないのですが、コンテナ同志の依存を管理するものではなく、
サービスの起動順番を制御するもののようです。
https://qiita.com/haruyan_hopemucci/items/344f1e2fb95ed452bdb2
dockerのネットワーク周りは結構難しくて、自分も勉強中ですが、
普段使いする上ではここまで詳しくしる必要はないのかなと思うので
余裕がありましたら、調べてみてください＾＾




----------------------------------------------------------------
▼controller修正
----------------------------------------------------------------
さて、コントローラーを作成していただきましたね！
https://github.com/shenbaoblog/todo_php/blob/main/app/controllers/TodoController.php
ここは関数ではなく、TodoControllerクラスを宣言して、
このクラスにindexメソッドを宣言してみましょう
try {
    $pdo = new PDO($dsn, $username, $password, $driver_options);
} catch (PDOException $e) {
    print('Connection failed:' . $e->getMessage());
    die();
}
try-catch で囲むのは素晴らしいと思うのですが、
せっかく例外処理を書くのであれば、SQLの実行まで例外処理で囲みたいです。
try {
    $pdo = new PDO($dsn, $username, $password, $driver_options);
  
    $sql = 'SELECT * FROM users';
    if ($prepare = $pdo->prepare($sql)) {
        $prepare->execute();
        $users = $prepare->fetchAll(PDO::FETCH_ASSOC);
    }

    $sql = 'SELECT * FROM todos';
    if ($prepare = $pdo->prepare($sql)) {
        $prepare->execute();
        $todos = $prepare->fetchAll(PDO::FETCH_ASSOC);
    }
  } catch (PDOException $e) {
    print('Connection failed:' . $e->getMessage());
    die();
  }
インデックスですが、半角スペース２のようなので、４つにしてみましょう。
function index($dsn, $username, $password, $driver_options) {
引数でDB接続情報を渡すのではなく、
このコントローラー内でDB接続情報を取得するようにしてみましょうか。
TODO一覧ページでユーザーリストは取得する必要ないと思うので不要です。
$sql = 'SELECT * FROM todos';
これですと、全ユーザーの全てのTODOリストを取得してしまうので、
ログインユーザーのTODoリストのみ取得するような処理にしてみたいです。
今はuser_id = 1　のような決めうちでいいので
where句で対象ユーザーのTODOリストのみ返すような処理にしてみてください。
このあたり、修正してみてください＾＾
TodoController.php
<?php


function index($dsn, $username, $password, $driver_options) {
  try {
    $pdo = new PDO($dsn, $username, $password, $driver_options);
  } catch (PDOException $e) {
    print('Connection failed:' . $e->getMessage());
    die();
  }


  $sql = 'SELECT * FROM users';
  if ($prepare = $pdo->prepare($sql)) {
    $prepare->execute();
    $users = $prepare->fetchAll(PDO::FETCH_ASSOC);
  }

  $sql = 'SELECT * FROM todos';
  if ($prepare = $pdo->prepare($sql)) {
    $prepare->execute();
    $todos = $prepare->fetchAll(PDO::FETCH_ASSOC);
  }

  return [
    'users' => $users,
    'todos' => $todos;
}
アドバイスありがとうございます。修正いたしました。
引数でDB接続情報を渡すのではなく、
このコントローラー内でDB接続情報を取得するようにしてみましょうか。
DB接続の部分、アドバイスいただけますでしょうか？
https://github.com/shenbaoblog/todo_php （編集済み） 

shenbaoblog/todo_php
Language
PHP
Last updated
a month ago
投稿したメンバー: GitHub


陽- よう
  22:53
エラー分になります。
Fatal error: Uncaught Error: Access to undeclared static property: TodoController::$config in /var/www/html/app/controllers/TodoController.php:25 Stack trace: #0 /var/www/html/app/index.php(4): TodoController::index() #1 {main} thrown in /var/www/html/app/controllers/TodoController.php on line 25


マイケル
  13:54
エラーが発生しているソースがおそらくpushされていないように思いますが、
ひとまず、indexメソッドの中でrequire_once してみましょうか
イメージとしては、
public function index($dsn, $username, $password, $driver_options)
{
    $config = require_once(//コンフィグファイル);
    try {
        $pdo = new PDO($config を使って);
        
このような感じですかね



----------------------------------------------------------------
▼model作成
----------------------------------------------------------------
エラーが解消されましたら、次は、モデルファイルを作成してみたいです。
DBのやりとりを行う処理は、このモデルに集約したいです。
app配下にmodelsというディレクトリを作成して、
Todo.phpというファイルを作成
そのファイルにTodoクラスを宣言し、
getAll のようなメソッドを用意して、
TODOリストを全て取得処理にしてみましょう
$sql = 'SELECT * FROM todos';
if ($prepare = $pdo->prepare($sql)) {
    $prepare->execute();
    $todos = $prepare->fetchAll(PDO::FETCH_ASSOC);
}
このあたりの処理をモデルに移行させるイメージですね
ユーザーの取得はUser.php を作成し、
同様にモデルクラスを宣言してみてください。
このあたり、トライしてみてください＾＾


----------------------------------------------------------------
▼controller修正
----------------------------------------------------------------
モデルクラスを宣言していただきましたね＾＾
コントローラーのindexメソッドの処理のイメージは、
public function index()
{
    $user_id = 1; //ログインユーザーのIDを取得したいが、今は固定
    $user = User::findById($user_id);
    $todos = Todo::getAll($user_id);

    return [
        'user' => $user,
        'todos' => $todos,
    ];
}
このような感じで書いてみたいです。
DBのconfigやPDOクラスの宣言はDBの操作だと思うので
モデルクラスで宣言してみたいです。
コントローラーに書く処理は短いほどいいとされています。
indexメソッドの処理がこのようになるように、モデルの処理を修正してみましょうか。
トライしてみてください＾＾


アドバイスありがとうございます。
修正してみました。ただ、
        $users = User::findById($user_id);
        $todos = Todo::getAll($user_id);
のように2回、モデルを呼び出すとエラーとなります。
Connection failed:invalid data source name
モデル側に$pdo = null;を入れてみたのですが、うまくいきません。
アドバイスいただけますでしょうか？
https://github.com/shenbaoblog/todo_php （編集済み） 

shenbaoblog/todo_php
Language
PHP
Last updated
a month ago
投稿したメンバー: GitHub


マイケル
  14:44
エラーは全文を記載いただけると調査しやすいので、次回から全文貼っていただけますと幸いです。
Connection failedとあるので、
おそらくDB接続でエラーがでているように思います。
$config = require_once('/var/www/html/app/config/db_connect.php');
この$configがうまく取得できているか
var_dumpなどで確認してみてください。
おそらく初回読み込み時のUserクラスの中ではうまく取得できていると思いますが
2回目に読み込まれるTodoクラスの中では、すでに読み込まれているので
うまく$configが取得できていないと思います。
うまくUserクラスも、Todoクラスでも$configを取得できるようにしたいです。
BaseModelのような親クラスを宣言し、全てのモデルクラスは
このクラスを継承し、$configを取得するようなメソッドが必要ですかね
ちょっと工夫がいるかなと思いますが
参考に調査してみてください＾＾


陽- よう
  09:47
ありがとうございます！今回の場合、出たエラー文が、
Connection failed:invalid data source name
のみでしたので、そちらを添付させていただきました！
また、アドバイスをもとに修正してみました！ご確認お願いいたします！
https://github.com/shenbaoblog/todo_php

shenbaoblog/todo_php
Language
PHP
Last updated
2 months ago
投稿したメンバー: GitHub
09:49
▼補足
BaseModelクラスを、下記のようにするかで、少し悩みました。
$pdo->prepare等もエラー検知に含めたほうが良いと思ったので、下記の形にはしませんでした。
考え方として、あっていますでしょうか？
class BaseModel
{
    public function getDBConfig()
    {
        $config = require('/var/www/html/app/config/db_connect.php');
        try {
            $pdo = new PDO($config['dsn'], $config['username'], $config['password'], $config['driver_options']);
        } catch (PDOException $e) {
            print('Connection failed:' . $e->getMessage());
            die();
        }
        return $pdo;
    }
}
（編集済み）


マイケル
  23:05
すみません、大変遅くなりました。
いい感じですね＾＾
$config = BaseModel::getDBConfig();
せっかく継承しているので、
self::getDBConfig();
のようにかけそうですかね？
public function getDBConfig()
{
    return require('/var/www/html/app/config/db_connect.php');;
}
;; になっているようなので、;に修正しておきましょう。
もしrequire_onceで処理を書くなら、
今の処理だと、２回目にファイルを読み込んだ時に返り値がtrueになると思うので
$config = require_once('./config.php');
class BaseModel {
    public static function get_config() {
        global $config;
        return  $config;
    }
}
このように書く必要があるかなと思います。
$pdo->prepare等もエラー検知に含めたほうが良いと思ったので、下記の形にはしませんでした。
エラー検知というよりは、getDBConfigというメソッドの中では
コンフィグ取得のみ、処理を書いた方がいいので
PDOクラスをnewする必要はないかなと思います。
　
PDOクラスのインスタンスを取得するためのメソッドは用意した方が
よりベターと思うので
getPDOのようなメソッドを用意して、PDOクラスのインスタンスを返す処理を実装してみましょうか。
そうすれば
public function getAll($user_id)
{
    try {
        $pdo = self::getPDO();
        //省略
のようにかけそうですかね？
トライしてみてください＾＾
index.phpですが、
他のページも実装していくので
views/todo/index.phpにしてみてください。
 <!-- ユーザーリスト -->
    <h2>ユーザーリスト</h2>
    <?php
    echo "id,name,password,created_at,updated_at,deleted_at<br />";
    foreach ($sql['users'] as $user) {
        echo "<li>{$user['id']},{$user['name']},{$user['password']},{$user['created_at']},{$user['updated_at']},{$user['updated_at']},{$user['deleted_at']}</li>";
    }
    ?>
これは不要なので削除してみましょうか。
ページのヘッダーに、ログインしているユーザー名を表示してみましょうか。
今はuser_id=1で決めうちでいいので、
Userクラスから取得したユーザー名を一覧ページに表示してみてください。
ひとまず一覧ページは実装できましたので、
次は詳細ページも作成して行きましょう。
views/todo/show.php
というファイルを作成して、コントローラーには、showというメソッドを宣言
todo_idをGETパラメータにして
それに紐つくTODOの詳細ページを表示してみたいです。
こちらもトライしてみてください＾＾


陽- よう
  09:32
質問させてください。
どうして、以下の形だと返り値がtrueになるのでしょうか？
<?php

class BaseModel
{
    public function getDBConfig()
    {
        return require('/var/www/html/app/config/db_connect.php');;
    }
}
New


マイケル
  13:32
以下の形だと返り値がtrueになるのでしょうか？
これもPHPの仕様になりますが、
require_once を使用する場合、
一度読み込んファイルは再読み込みをしない関数なので
public function getDBConfig()
{
    return require_once('/var/www/html/app/config/db_connect.php');
}
この書き方だと、初回はうまく読み込みますが、
２回目以降にgetDBConfigをコールした場合は、ファイルを読み込まず、
trueを返すような動きになってます。
なので、何度も読み込まないような工夫が処理に必要になります。
requireを使用する場合は、毎回読み込む関数なので
うまく動くかと思います。
return require('/var/www/html/app/config/db_connect.php');
よろしければ参考にしてください＾＾


陽- よう
  09:09
丁寧にありがとうございます。
require_onceは、2度目以降は、trueになる！
覚えておきます！


陽- よう
  09:09
丁寧にありがとうございます。
require_onceは、2度目以降は、trueになる！
覚えておきます！


陽- よう
  09:51
修正しました！ご確認お願いします！
https://github.com/shenbaoblog/todo_php
また、
views/todoディレクトリに移動させても、ページ表示させるには、
.htaccess等で、リダイレクトをかけるということでしょうか？


すみません、大変遅くなりました。
views/todoディレクトリに移動させても、ページ表示させるには、.htaccess等で、リダイレクトをかけるということでしょうか？
ひとまずドキュメントルートは変更しなくてOKです！
もし変更される場合は、nginxのドキュメントルートをviews配下にしてあげれば
上手く表示されると思いますが、
今の状態であれば、
localhost:8000/views/todos/index.php
のようなURLで表示できるかなと思います。
詳細ページも同様に実装できましたね！

public function show()
{
    $user_id = 1;
    $todo_id = 2;

    $users = User::findById($user_id);
    $todo = Todo::getByID($todo_id);

todo_idは動的にしましょうか。
GETパラメータにtodo_idを付与して、表示するTODOを動的にしてみましょう
localhost:8000/views/todos/index.php?todo_id=1
のようなURLになりそうですかね。
また、存在しないTODOのIDならば、エラーページに遷移させてみたいです。
views/error/404.phpのようなファイルを作成、
もし存在しないtodo_idならこのページに遷移させるような処理にしてみましょう。
このあたりトライしてみてください＾＾


いい感じですね！
function __construct() {
    // $user_id = 1;
    $user_id = $this->user_id;
$user_id を宣言されておりますが、コンストラクタ内で特に使用されていないので
この処理は不要ですかね
$todos = Todo::getAll($user_id);
プロパティにuser_id を定義しているのであれば、
わざわざ$user_id を宣言する必要はなく
$todos = Todo::getAll($this->user_id);
のように書いてあげればOKです
showメソッドですが
if(!$todo_id) {
    header('Location: /error/404.php');
    exit;
}
todo_id がない場合に404エラーページに遷移されておりますが、
エラーコードとしては400が正しいと思うので
400.phpというエラーページを別に用意して
そこに遷移するようにしてみましょうか
400はBad Rquest なので、リクエストパラメータに不備があるエラーになります。
$todo = Todo::getByID($todo_id);
todo_id に紐つくtodoがない場合は、404.php に遷移させたいです。
$todo = Todo::getByID($todo_id);
if(!$todo) {
    header('Location: /error/404.php');
    exit;
}
このような処理になりそうですが、
この処理をモデルに書いてみましょうか
モデルにfindOr404 というメソッドを用意して
もし取得できない場合は、メソッド内で404にリダイレクトするような処理にしてみましょうか
そうすれば、コントローラーは
$todo = Todo::findOr404($todo_id);
と書くだけでよくなりますね。
なるべくコントローラーの記述量を減らすのがベストプラクティスです。
こちらトライしてみてください＾＾


いい感じですね！コントローラーがスッキリしてきました
public function show()
{
    // $user_id = 1;
    // var_dump($this->current_user);
    $user_id = $this->current_user['id'];

    // クエリパラメータから$todo_idを取得
    if(isset($_GET['todo_id'])) {
        $todo_id = $_GET['todo_id'];
    }
    if(!$todo_id) {
        header('Location: /error/400.php');
        exit;
    }

    $user = User::findById($user_id);
    $todo = Todo::findOr404($todo_id);

// $user_id = 1;
// var_dump($this->current_user);
不要なコメントは削除しておきましょう
$user = User::findById($user_id);
この処理ですが、コンストラクターで
function __construct() {
    $this->current_user = ServiceAuth::getCurrentUser();
}
ログインユーザーを取得する処理を実装しているので、
index, showメソッドそれぞれに書く必要はなさそうです。
public function show()
{
    // クエリパラメータから$todo_idを取得
    if(isset($_GET['todo_id'])) {
        $todo_id = $_GET['todo_id'];
    }
    if(!$todo_id) {
        header('Location: /error/400.php');
        exit;
    }
    $todo = Todo::findOr404($todo_id);

    return [
        'user' => $this->current_user,
        'todo' => $todo,
    ];
}
こんな感じでかけそうですかね
indexメソッドもリファクタリングお願いします。
class ServiceAuth {
    function getCurrentUser() {
        $user_id = 1;
        return User::findById($user_id);
    }
}
getCurrentUser内で、もしユーザーが取得できない場合は
ログインページに遷移するような処理を実装しておきたいです。
views/auth/login.php
のようなファイルを作成しておいて、
もし$user が取得できない場合は、このログインページにリダイレクトする処理を実装しておきましょうか。
さて、これで一覧ページと、詳細ページができましたね！
次は新規作成ページを実装してみたいです。
TodoControllerにnew, storeというメソッドを用意して
viewsにはtodos配下にnew.php を用意しておきましょう。
newメソッドはリクエストメソッドがGETの時に実行される
storeメソッドはリクエストメソッドがPOSTの時に実行される
ような実装にしてみたいです。
新規作成のフォームを実装していただき、
submitボタンを押下してTODOリストが登録できるようにしたいです。
こちらトライしてみてください＾＾

陽- よう
  09:53
途中まで作成してみました！
アドバイスお願いします。
new.phpにて、登録ボタンを押したあとに、
store();を実行してDBに登録するまでの書き方がわかりません。
アドバイスよろしくお願いいたします。
https://github.com/shenbaoblog/todo_php （編集済み） 

shenbaoblog/todo_php
Language
PHP
Last updated
3 months ago
投稿したメンバー: GitHub


マイケル
  21:34
new.phpにて、登録ボタンを押したあとに、
store();を実行してDBに登録するまでの書き方がわかりません。
 submitボタンを押下すると、リクエストメソッドはPOSTになるので
リクエストメソッドによって、呼び出すコントローラーのメソッドを条件分岐する必要があるのかなと思います。
イメージとしては
$controller = new TodoController();
// GETなら
$result = $controller->new();
// POSTなら
$result = $controller->store();
のような感じですかね？
参考に修正してみてください＾＾


陽- よう
  09:54
アドバイスありがとうございます！
変更してみました。
続けて質問させてください。
https://github.com/shenbaoblog/todo_php
現在、DBへの新規TODO登録がうまく行かない状態です。
app/models/Todo.phpの67行目~79行目のどこかに間違いがあると考えているのですが、原因がわからないです。
お手数おかけしますが、アドバイスのほどよろしくお願いいたします。
var_dump($prepare);
var_dump($params);
をすると、
object(PDOStatement)#2 (1) { ["queryString"]=> string(94) "INSERT INTO todos(user_id, title, details, status) VALUES(:user_id, :title, :details, :status)" }
array(4) { [":user_id"]=> int(1) [":title"]=> string(0) "" [":details"]=> string(0) "" [":status"]=> int(0) }
と表示されます。 （編集済み） 

shenbaoblog/todo_php
Language
PHP
Last updated
3 months ago
投稿したメンバー: GitHub


マイケル
  08:45
すみません、大変遅くなりました。
INSERTができないとのことですが、特にエラーは発生していないですかね？
 try {
    $pdo = self::getPDO();

    $sql = "INSERT INTO todos(title, details) VALUES(:title, :details)";
    if ($prepare = $pdo->prepare($sql)) {
        $params = array(':title' => $title, ':details' => $details);
        $prepare->execute($params);
    }
} catch (PDOException $e) {
    print('Connection failed' . $e->getMessage());
    die();
}
例外処理を実装されているので、
もしDB処理に失敗している場合は、 catchの中の処理が動いていると思います。
var_dumpなどでデバッグしてみてください。
続いて確認するところは、保存している値の確認です
array(4) { [":user_id"]=> int(1) [":title"]=> string(0) "" [":details"]=> string(0) "" [":status"]=> int(0) }
titleが空文字なのが気になります。
titleはnot nullにしていると思うので、空文字を保存しようとしてエラーになっているようにも思います、
他にもnot nullなカラムはないかも確認してみてください。
また、user_idは、usersテーブルの外部キーなので、
このidに該当するレコードがusersテーブルに存在しているかも確認してみましょう。
CREATE TABLE todos ( id INT NOT NULL, user_id INT NOT NULL, title VARCHAR(100) NOT NULL, details TEXT, status INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME NOT NULL, PRIMARY KEY (id), FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE SET NULL ); 
外部キーの制約をかけているので、もしusersテーブルにレコードがない場合は、保存されないと思います。
まずはこのあたり確認してみてください＾＾


陽- よう
  09:56
ありがとうございます。
以下、確認したことになります。
INSERTができないとのことですが、特にエラーは発生していないですかね？
エラーは、発生していません。
titleが空文字なのが気になります。
titleはnot nullにしていると思うので、空文字を保存しようとしてエラーになっているようにも思います、
他にもnot nullなカラムはないかも確認してみてください。
titleに文字列を入力しても依然として、登録されません。
object(PDOStatement)#2 (1) { ["queryString"]=> string(94) "INSERT INTO todos(user_id, title, details, status) VALUES(:user_id, :title, :details, :status)" }
array(4) { [":user_id"]=> int(1) [":title"]=> string(9) "テスト" [":details"]=> string(6) "詳細" [":status"]=> int(0) }
NOT NULL 成約は、下記の形です。
idは、PRIMARY KEYにしているいので、自動連番になると認識しています。
created_at、updated_atも自動付与の認識です。
なので、user_id、title、statusの2つをデータとして送れば良いと考えています。
CREATE TABLE todos (
  id INT NOT NULL,
  user_id INT NOT NULL,
  title VARCHAR(100) NOT NULL,
  details TEXT,
  status INT NOT NULL,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  deleted_at DATETIME,
  PRIMARY KEY (id),
  FOREIGN KEY (user_id) REFERENCES users(id)
  ON UPDATE CASCADE
  ON DELETE CASCADE
);
また、user_idは、usersテーブルの外部キーなので、
このidに該当するレコードがusersテーブルに存在しているかも確認してみましょう。
userテーブルにid:1は、存在しています。
https://gyazo.com/aa3df924e9c5bee8ff965774f7d99976
このため、
user_id、title、statusの3つをDBに送れていれば登録できると認識しています。
自分なりに見てみてるのですが、やはりわからないです。。。
    // タスクの新規登録
    public function registration() {
        $user_id = intval($_POST['user_id']);
        $title = $_POST['title'];
        $details = $_POST['details'];
        $status = intval($_POST['status']);

        try {
            $pdo = self::getPDO();

            // $sql = "SELECT * FROM todos WHERE id = $todo_id";

            $sql = "INSERT INTO todos(user_id, title, details, status) VALUES(:user_id, :title, :details, :status)";
            if ($prepare = $pdo->prepare($sql)) {
                var_dump($prepare);
                echo "<br>";
                $params = array(
                    ':user_id' => $user_id,
                    ':title' => $title,
                    ':details' => $details,
                    ':status' => $status
                );

                var_dump($params);
                $prepare->execute($params);
            }
        } catch (PDOException $e) {
            print('Connection failed' . $e->getMessage());
            die();
        }
    }
（編集済み）
New


マイケル
  21:38
すみません、大変遅くなりました。
動作確認して見ました。
pushされていないかもしれませんが
そうすると、新規作成ページでsubmitボタンを押した後の遷移先は、
http://localhost:8000/config/controllers/TodoController.php
のようです。
ソースをみて見ますと、
<form method="POST" action="/config/controllers/TodoController.php">
となっていたので、
ここは同じviewファイルに遷移する必要があると思います。
で、
views/todo/new.php の冒頭の処理を修正する必要がある思います。
イメージとしては、
include('/var/www/html/app/controllers/TodoController.php');

$controller = new TodoController();
// もしリクエストメソッドがGETなら
$sql = $controller->new();
// もしリクエストメソッドがPOSTなら
$sql = $controller->store();
な感じになりそうですかね
さて、保存できない件ですが、
PDOStatementクラスから実行したクエリを取得することができるので確認して見ましょう
$result = $prepare->execute($params);
var_dump($result);
var_dump($prepare->debugDumpParams());
こんな感じでクエリを取得できると思うので、
取得したクエリを実行してみます
mysql> INSERT INTO todos(title, details, user_id, created_at, updated_at, status) VALUES('asdfas', 'asdfas', '1' , '2022/12/1 00:00:00', '2022/12/1 00:00:00', '0');
ERROR 1364 (HY000): Field 'id' doesn't have a default value
そうすると、idカラムにデフォルトバリューがないとでます
テーブル定義を確認してみると、
mysql> desc todos;
+------------+--------------+------+-----+-------------------+-----------------------------+
| Field      | Type         | Null | Key | Default           | Extra                       |
+------------+--------------+------+-----+-------------------+-----------------------------+
| id         | int(11)      | NO   | PRI | NULL              |                             |
| user_id    | int(11)      | NO   | MUL | NULL              |                             |
| title      | varchar(100) | NO   |     | NULL              |                             |
| details    | text         | YES  |     | NULL              |                             |
| status     | int(11)      | NO   |     | NULL              |                             |
| created_at | datetime     | NO   |     | CURRENT_TIMESTAMP |                             |
| updated_at | datetime     | NO   |     | CURRENT_TIMESTAMP | on update CURRENT_TIMESTAMP |
| deleted_at | datetime     | YES  |     | NULL              |                             |
+------------+--------------+------+-----+-------------------+-----------------------------+
8 rows in set (0.00 sec)

mysql>
idカラムがautoincrement が設定されていないため、
自動でIDが付与されず、保存できないのかなと思います。
確認してみてください＾＾




----------------------------------------------------------------
▼バリデーション処理の実装
----------------------------------------------------------------
解決されましたね！OKです！
新規作成ができるようになりましたので、
次はバリデーション処理を実装してみましょう。
app/validationsディレクトリを作成し、
TodoValidation.php を作成
TodoValidationクラスを宣言して、
このクラスを使用してPOSTパラメータに対してバリデーションチェックを実装してみましょう。
public function registration() {
    $user_id = $_POST['user_id'];
    $title = $_POST['title'];
    $details = $_POST['details'];
    $status = $_POST['status'];
現状、モデルのメソッド内でPOST値を取得しておりますが、
POST値はコントローラー内で取得するようにいたしましょう。
storeメソッドのイメージとしては
public function store() {
    $user_id = $_POST['user_id'];
    $title = $_POST['title'];
    $details = $_POST['details'];
    $status = $_POST['status'];

    $validation = TodoValidation(//POST値を配列で渡す);
    //もしバリデーションがNGなら
        //新規作成ページに遷移　エラーメッセージを表示させたい

    $valide_data = $validation->getValidData();
    Todo::registration($valide_data);

}
のような感じですかね。
保存する値は、バリデーションクラスから取得し、モデルのメソッドの引数で渡しましょう。
値は同じですが、このような処理にすることで保存する値が正常値であることを
担保することができます。
このあたり、参考に修正してみてください＾＾



マイケル
  13:20
すみません、大変遅くなりました。
バリデーションを実装していただきましたね！
$validation = new TodoValidation($todo_data);
//もしバリデーションがNGなら
if(!$validation->validation()) {
    //新規作成ページに遷移　エラーメッセージを表示させたい
    $error = $validation->getErrorMsg();
}

$valide_data = $validation->getValidData();
Todo::registration($valide_data);
これですと、バリデーションがNGの場合もregistrationメソッドの処理が動いてしまいそうなので、
if(!$validation->validation()) {
    //新規作成ページに遷移　エラーメッセージを表示させたい
    $error = $validation->getErrorMsg();

    //このタイミングで遷移処理
}
NGの時点でその先の処理は実行させないような処理が必要かなと思います。
遷移先は、newメソッドが実行されるはずです。
newメソッド内でエラーメッセージを取得し、
もし存在すれば、エラーメッセージを表示させるような動きにしたいです
エラーメッセージは、GETパラメータで渡すのではなく、
セッション管理にしてみましょう。
https://codelikes.com/php-session/
このあたりの記事を参考にセッションを実装してみてください。
エラーメッセージは、newメソッド内で取得
取得したらセッションはクリアするようにしましょうか。
そうすることで、
リロードするとエラーメッセージは表示されなくなると思います。
これをフラッシュメッセージといいます（一度しか表示されないメッセージ）
これが実装できましたら、他のページにも汎用できるように
フラッシュメッセージのセット、クリアをサービスクラスに移行したいですね。
こちらトライしてみてください＾＾


いい感じですね！
//もしバリデーションがNGなら
if(!$validation->validation()) {
	//新規作成ページに遷移　エラーメッセージを表示させたい
	$errors = $validation->getErrorMsg();
	$_SESSION["error"] = $errors;
	
バリデーションがNGの時に、セッションにエラーメッセージは保存できていると思います。
NGの際はnewメソッドがGETでコールされると思いますので、
イメージとしては
 public function new () {
	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		//セッションからエラーメッセージを取得

		// セッション削除
        unset($_SESSION["error"]);

		// GET送信されたリクエストパラメータです
		return [
			'user' => $this->current_user,
		];
のような感じになりそうですかね
セッションキーがerrorになっていますが、複数のエラーメッセージを格納する想定と思うので
ここはerrorsにしておきましょうか。
セッションについて、理解を深めておきましょうか。
セッションに値を使用することで、
保存した値をリクエストのパラメータに渡すことなく、使用することができます。
今回でいえば、エラーメッセージを新規作成ページに遷移した時にGETパラメータに渡すことなく使用することができます。
セッションを理解するには、クッキーというものを理解する必要があるのですが
セッションはWebサーバー側で保存
クッキーはブラウザに保存する値になります。
セッションに値を保存すると、セッションIDというものが発行され、
このセッションIDがブラウザのクッキーに保存されます。PHPSESSID　という値で保存されていると思うので
ブラウザの検証ツールを開き、アプリケーション、クッキーを確認してみてください。
Webサーバーは、ブラウザから送信されるこのセッションIDを元に、どのユーザーか判別し、
リクエストごとにセッションを取得することができます。
このあたり、下記の記事などが参考になると思うので、理解を深めてみてください＾＾
https://qiita.com/Fell/items/f64a32dc1f243a12462e
https://www.webdesignleaves.com/pr/php/php_basic_07.php
GETリロードする方法。リロードした際もPOSTしてしまっている気がしてます。
リクエストごとの条件分岐は問題なさそうに見えますので、
var_dumpで、リクエストメソッドがGETとして取得できているか確認してみてください。
このあたり確認してみてください＾＾




陽- よう
  15:04
アドバイスありがとうございます。
リロードした際にリクエストメソッドをGETメソッドに変更する部分がうまく行かないのですが、
アドバイスお願いできますでしょうか？
https://github.com/shenbaoblog/todo_php （編集済み） 

shenbaoblog/todo_php
Language
PHP
Last updated
5 months ago
投稿したメンバー: GitHub


マイケル
  23:02
すみません、大変遅くなりました。
// フラッシュメッセージが存在する場合
if (is_array($_SESSION["flash_messages"]) && !empty($_SESSION["flash_messages"])) {
    header('Location: http://localhost:8000/views/todo/new.php');
}
var_dump($_SERVER['REQUEST_METHOD']);
このリダイレクト処理は必要でしょうか？
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // セッションからエラーメッセージを取得

    // セッション削除
    unset($_SESSION["flash_messages"]);

    // GET送信されたリクエストパラメータです
    return [
        'user' => $this->current_user,
    ];
} 
ここの処理ですが、イメージとしては
$errors = array();
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // もしエラーメッセージがあれば
        //セッションからエラーメッセージを取得
        $errors = $_SESSION["flash_messages"]

    // セッション削除
    unset($_SESSION["flash_messages"]);

    return [
        'user' => $this->current_user,
        'errors' => $errors,
    ];
}
のような感じになるのかなと思います。
view側ではエラーメッセージを配列で取得して
ループしてエラーメッセージを表示すればいいですかね
 <!-- エラー表示 -->
<?php if(!empty($_SESSION["flash_messages"])): ?>
    <?php foreach ($_SESSION["flash_messages"] as $error): ?>
        <p><?php echo $error; ?></p>
    <?php endforeach; ?>
<?php endif; ?>
ここはセッションではなく、コントローラーから取得するエラーメッセージ用の変数をループしましょうか。
pタグで出力よりは、liタグでエラーメッセージをリスト表示する方が自然と思います。
エラーメッセージを赤文字にするようなスタイルをCSSで実装するとわかりやすいかなと思います。
ちなみにセッションキーですが、　flash_messagesだとエラー系のメッセージに限らず
正常系のメッセージも保存するようなニュアンスのように思うので
errorsのようなエラー系のメッセージを意味するキーの方がいいかなと思います。
せっかくなので
もし保存に失敗してnewにリダイレクトした際は
入力した内容をそのまま入力欄に保持した状態にしたいです。
入力した内容はGETパラメータとして付与するか
こちらもセッションに保持でもOKです。
エラーメッセージが表示できるようになりましたら、こちらもトライしてみてください。
このあたり参考に修正してみてください＾＾


陽- よう
  09:30
アドバイスありがとうございます。
ずっとできないでいる部分が、
「登録」ボタンクリック→ブラウザ更新
をした際に、GETメソッドにすることです。
 現状だと、
「登録」ボタンクリック（POST）→ブラウザ更新（POST）
の状態になってしまい、フラッシュメッセージになりません。
※フォームデータも再送信されてしまうようです。
こちらのリダイレクトをかけている理由もブラウザ更新した際に、
GETメソッドに変更する方法がないかと思案したものになります。
https://havelog.aho.mu/develop/others/e172-http-request-trans.html
アドバイスいただけないでしょうか？
// フラッシュメッセージが存在する場合
if (is_array($_SESSION["flash_messages"]) && !empty($_SESSION["flash_messages"])) {
    header('Location: http://localhost:8000/views/todo/new.php');
}
var_dump($_SERVER['REQUEST_METHOD']);
（編集済み）


陽- よう
  09:36
あ、こちら試してみます。
https://office-obata.com/report/memorandum/post-3550/

ホームページ制作　オフィスオバタホームページ制作　オフィスオバタ
PHPブラウザ更新（F5）で二重送信・重複送信される現象を防止する | ホームページ制作　オフィスオバタ
ブラウザには「更新ボタン」「F5ボタン」で画面を更新する機能があります。これはこれで大事な機能なのですが、フォームの送信ボタンを押した後に、更新すると、今ほど送信した内容が、未入...
2020年1月7日


陽- よう
  09:40
質問させてください。
やはり、フラッシュメッセージの実装ができない状態でいます。
ブラウザ更新時にエラーメッセージが表示されてしまっています。
フラッシュメッセージの実装は、上記リンクを実装する理解であってますでしょうか？ （編集済み） 





陽- よう
  09:48
少しだけ進んだかもしれないです。
ブラウザ更新時にエラーメッセージが表示されなくなりました。
ただ、現状ですと、「登録」ボタンを２回押した場合でも、エラーメッセージが表示されない状態です。
もう少し、いじってみますが、アドバイスいただけますでしょうか？
https://github.com/shenbaoblog/todo_php

shenbaoblog/todo_php
Language
PHP
Last updated
6 months ago
投稿したメンバー: GitHub


マイケル
  22:52
すみません、大変遅くなりました。
「登録」ボタンクリック→ブラウザ更新
をした際に、GETメソッドにすることです。
 現状だと、
「登録」ボタンクリック（POST）→ブラウザ更新（POST）
このあたりの挙動を整理したいのですが、
登録ボタンを押下すると、
リクエストメソッド POST でnew.phpにアクセスされるはずですよね
POSTでアクセスされても、コントローラーのnewメソッドがコールされますね
下記処理は不要と思います
 // フラッシュメッセージが存在する場合
if (is_array($_SESSION['errors']) && !empty($_SESSION['errors'])) {
    header('Location: http://localhost:8000/views/todo/new.php');
}
headerのリダイレクト処理は、POSTの処理の中に書いてあげる必要がありそうですかね
if(!$validation->validation()) {
    //新規作成ページに遷移　エラーメッセージを表示させたい
    $_SESSION['errors'] = $validation->getErrorMsg();
    header('Location: http://localhost:8000/views/todo/new.php');
    exit()
ポイントはheaderの後ろにexitを書いてあげる必要があります。
https://qiita.com/karur4n/items/c398b83e70e4479984b4
これを書いてあげることで、エラーメッセージが表示されるようになると思います。
試してみてください＾＾
QiitaQiita
header() でリダイレクトさせるあとはだいたい exit() しよう - Qiita
header() 関数を用いて、リダイレクト処理を行うことはよくあります。
<?php
header('Location: /');
exit();
で、例えば以下のように、ユーザ認証を行って、妥当であれば、メールを送信... (50 kB)
https://qiita.com/karur4n/items/c398b83e70e4479984b4



陽- よう
  09:28
僕の方でも整理させていただきます。
フラッシュメッセージとは、最初の1回だけエラーメッセージを表示させるものだと認識しています。
僕の中では、バリデーションエラーがあった際に
A①：登録ボタンを押下時にエラーメッセージ表示される
A②：次にブラウザ更新した際に、エラーメッセージが表示されなくなる。
が目的の挙動と認識しています。
そして、現状　上記の①②については、達成できています。
更に、
B①：登録ボタンを押下時にエラーメッセージ表示される
B②：続けて、登録ボタンを押下時にエラーメッセージ表示される
とするべきと認識しています。
しかし、現状、B②の際にエラーメッセージ表示が消えてしまいます。
B②でもエラーメッセージが表示されるような実装にするのが正しい認識であってますでしょうか？
【理想】エラーが有る場合の挙動
①登録ボタン押下　　　　→　エラーメッセージ表示
②続けて登録ボタン押下　→　エラーメッセージ表示
③続けてブラウザ更新　　→　エラーメッセージ非表示
【現在】エラーが有る場合の挙動
①登録ボタン押下　　　　→　エラーメッセージ表示
②続けて登録ボタン押下　→　エラーメッセージ非表示
③続けてブラウザ更新　　→　エラーメッセージ非表示 （編集済み） 
New


マイケル
  13:39
しかし、現状、B②の際にエラーメッセージ表示が消えてしまいます。
B②でもエラーメッセージが表示されるような実装にするのが正しい認識であってますでしょうか？
続けて、登録ボタンを押した場合も
入力値が不正の場合は、エラーと表示させるのが期待値と思います。
自分の環境で動かしてみたのですが、
うまく動いているように見えます。（少しコード修正しています。）
2回目は表示されないですか？
バリデーションの箇所は下記のように修正しています。
$validation = new TodoValidation($todo_data);
            //もしバリデーションがNGなら
            if(!$validation->validation()) {
                //新規作成ページに遷移　エラーメッセージを表示させたい
                $_SESSION['errors'] = $validation->getErrorMsg();
                $errors = $_SESSION['errors'];
                $_SESSION['errors'] = $errors;
                header('Location: http://localhost:8000/views/todo/new.php');
                exit();

                // return [
                //     'user' => $this->current_user,
                //     'errors' => $errors,
                // ];
            }

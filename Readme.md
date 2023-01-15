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
    $this->current_user = ServiceAuth::get_current_user();
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
    function get_current_user() {
        $user_id = 1;
        return User::findById($user_id);
    }
}
get_current_user内で、もしユーザーが取得できない場合は
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

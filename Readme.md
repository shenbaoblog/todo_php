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

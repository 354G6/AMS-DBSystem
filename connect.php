<?
// Using PDO_MySQL (connecting from App Engine)
$db = new pdo('mysql:unix_socket=/cloudsql/ams-cmpt354g6-2015spring:test'),
  'root',  // username
  ''       // password
);

// Using mysqli (connecting from App Engine)
$sql = new mysqli(
  null, // host
  'root', // username
  '',     // password
  '', // database name
  null,
  '/cloudsql/ams-cmpt354g6-2015spring:test'
  );

// Using MySQL API (connecting from APp Engine)
$conn = mysql_connect(':/cloudsql/ams-cmpt354g6-2015spring:test',
  'root', // username
  ''      // password
  );

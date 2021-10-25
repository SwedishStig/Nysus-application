/*This is simple program to initializa a database for Larson's code example.

This code requires a host name, username and password for an available mySQL Server.
It then creates a database called nysus_app on said database.

This code was written by Larson Long.
*/

const { Server } = require('http')
var mysql = require('mysql');

var con = mysql.createConnection({
  host: "localhost",
  user: "username",
  password: "password"
});

con.connect(function(err) {
    if (err) throw err;
    console.log("Connected!");
    con.query("CREATE DATABASE nysus_app", function (err, result) {
      if (err) throw err;
      console.log("Database created");
    });
    con.end();
  });
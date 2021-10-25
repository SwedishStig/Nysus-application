/*
This program populates the mySQL database for Larson's code example.

This code requires a host name, username and password for an available mySQL Server.
It then populates the existing mySQL database with two tables: parents and children.

This code was written by Larson Long.
*/

var mysql = require('mysql');

//host, username and password
let h = "localhost";
let u = "username";
let p = "password";

//create array of parent table info
const parents =[
  ["cooling_system", "001"],
  ["drivetrain", "010"],
  ["suspension", "011"]
];

//create array of child table info
const children =[
  ["water_pump", "001", "metal"],
  ["shocks", "011", "rubber"],
  ["head", "010", "metal"],
  ["springs", "011", "metal"],
  ["hoses", "001", "rubber"],
  ["block", "010", "metal"]
];

// //connect ot mysql
// var con = mysql.createConnection({
//   host: h,
//   user: u,
//   password: p
// });


// con.connect(function(err) {
//     if (err) throw err;
//     console.log("Connected!");
//     //check if database is already made(?)

//     //if not create database 
//     con.query("CREATE DATABASE nysus_app", function (err, result) {
//       if (err) throw err;
//       console.log("Database created");
//     });
//     con.end();
// });

var con2 = mysql.createConnection({
        host: h,
        user: u,
        password: p,
        database: "nysus_app"
});

con2.connect(function(err) {
    if (err) throw err;
    console.log("Connected!");

    //create parent table
    var sql = "CREATE TABLE parent (title VARCHAR(255), ID VARCHAR(255))";
    con2.query(sql, function (err, result) {
      if (err) throw err;
      console.log("Parent table created");
    });
    //populate parent table
      sql = "INSERT INTO parent (title, ID) VALUES ?";
      con2.query(sql, [parents], function (err, result) {
          if (err) throw err;
          console.log("Parent table populated");
    });

    //create child table
    sql = "CREATE TABLE child (title VARCHAR(255), ID VARCHAR(255), attr VARCHAR(255))";
    con2.query(sql, function (err, result) {
      if (err) throw err;
      console.log("Child table created");
    });

    //populate child table
    sql = "INSERT INTO child (title, ID, attr) VALUES ?";
    con2.query(sql, [children], function (err, result) {
        if (err) throw err;
        console.log("Child table populated");
    });
    con2.end();
});



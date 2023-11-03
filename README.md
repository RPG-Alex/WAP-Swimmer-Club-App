<a name="readme-top"></a>

# Swimmer Club App
<div align="center">
    <img src="swim-club-logo.png" alt="Logo" width="100" height="100">
</div>

<details>
    <summary>Contents</summary>
     <ol>
        <li>
            <a href="#introduction">Introduction</a>
        </li>
        <li>
            <a href="#features">Features</a>
        </li>
        <li>
            <a href="#running-locally">Running Locally</a>
        </li>
    </ol>
</details>


## Introduction

A bespoke prototype application for tracking swim meets and swimmer stats for a swim club, using PHP and MySQL

## Features
- [x] A Normalized SQL Database
- [x] Fully Functional Web Application
	- [x] Complete CRUD Operations for:
		- [x] Complete login system with:
			- [x] Password one way hashing
			- [x] User profile and info linked to login account
			- [x] Account persistence between views/pages
		- [x] Connecting parents to swimmers
		- [x] Tracking swim meets
		- [x] Tracking swimmer performance/stats
	- [x] Standard Server Side Security Measures:
		- [x] Password hashing
		- [x] Userid verification
		- [x] Prepared statements for database security
		- [x] Use of Regex for form entry verification (server side)
	- [x] Seperation of roles:
		- [x] Swimmers
		- [x] Coaches/admin
		- [x] Parents
	- [x] Tracking races and practices		
	- [x] Object Oriented Programming Standards
	- [x] Seperation of concern through use of Model - View - Controller
	- [x] Login Security
	- [x] Database:
		- [x] Normalized

## Running Locally

In order to run this application please:
- Refer to the ROOT/controller/base.php file and update all fields as needed:
        - db user name
        - db user password
        - db name
        - any other details that are changed
The application requires:
- MySql/MariaDB/SQL database
- An Http Server (e.g. Apache)
- PHP

Get swimming!
<p align="center">[<a href="#readme-top">RETURN TO TOP</a>]</p>

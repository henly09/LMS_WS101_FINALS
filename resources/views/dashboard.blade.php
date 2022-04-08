<!DOCTYPE html>
<html lang="en">
<link rel="shortcut icon" href="{{ asset('Image/libraryicon.ico') }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DASHBOARD (LMS) </title>
</head>
<center>
<nav class="navbar navbar-inverse">

    <div class="header">
     <img class="logo" src="{{ asset('Image/logo.png') }}"/>   
      <a style="margin-right: 25%; text-decoration: none;" class="navbar-brand" href="{{ route('dashboard')}}">LIBRARY MANAGEMENT SYSTEM</a>
      <div class="dropdown">
      <button class="dropbtn">Account Logged: {{ $name }}</button>
      <div class="dropdown-content">
      <a href="{{ route('displaychangepass') }}">Change Password</a>
      </div>
      </div>
    </div>

    <ul class="nav navbar-nav">
      <a class='nav' href="{{ route('dashboard')}}">DASHBOARD</a>
      <a class='nav' href="{{ route('books')}}">BOOKS</a>
      <a class='nav' href="{{ route('borrower')}}">BORROWERS</a>
      <a class='nav' href="{{ route('notreturnedbooks')}}">NOT RETURNED BOOKS</a>
      <a class='nav' href="{{ route('borrow')}}">ISSUE BOOK BORROW</a>
      <a class='nav' href="{{ route('transactionhistory')}}">TRANSACTION HISTORY</a>
      <a class='navlogout' href="{{ route('logout')}}">LOGOUT</a>
    </ul>
</nav>
</center>
<body data-aos="fade-down" data-aos-delay="300" style='background-color: #56f0ba' class="body">  
  <center>
    <h1 class="mainname"> DASHBOARD </h1>
    @if(!empty($message))
      <h2 class='logged2'> Message: <br> {{ $message }} </h2> 
      @endif
      <div class="flex-container">
        <div class="card">
        <h1> No. of <br> Admin Accounts </h1>
        <h1> {{ $acccount }} </h1>
        </div>
        <div class="card">
        <h1> No. of <br> Available Books </h1>
        <h1> {{ $bookcount }} </h1>
        </div>
        <div class="card">
        <h1> No. of Active <br> Borrower Accounts </h1>
        <h1> {{ $borrowercount }} </h1>
        </div>
      </div> 
      
      <div class="flex-container">
        <div class="card">
        <h1> No. of <br> All Transactions </h1>
        <h1> {{ $historycount }} </h1>
        </div>
        <div class="card">
        <h1> No. of <br> Borrowed Books </h1>
        <h1> {{ $transactioncount }} </h1>
        </div>
        <div class="card">
        <h1> No. of Not <br> Returned Books </h1>
        <h1> {{ $notreturnedcount }} </h1>
        </div>
      </div>
<footer>
  <p>Created By: John Henly A. Montera<br>
  <a href="https://henly09.github.io/MyPortfolio/" target="_blank">Montera™ 2022</a></p>
</footer>  
</center>
</body>
</html>
<style>

  /* Style The Dropdown Button */
.dropbtn {
   background-color: #70f72d;
   padding: 10px;
   margin-top: -7px;
   border-radius: 10px 10px 0px 0px;
   border: 2px solid black;
   font-family: 'Arial';
   font-weight: bold;
   color: black;
   font-size: 20px;
}

/* The container <div> - needed to position the dropdown content */
.dropdown {
  position: relative;
  display: inline-block;
}

/* Dropdown Content (Hidden by Default) */
.dropdown-content {
  display: none;
  position: absolute;
  background-color: #70f72d;
  min-width: 235px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
  font-family: 'Arial';
   font-weight: bold;
   color: black;
   font-size: 16px;
   border-radius: 0px 0px 10px 10px;
   border: 2px solid black;
}

/* Links inside the dropdown */
.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

/* Change color of dropdown links on hover */
.dropdown-content a:hover {
  background-color: red;
  border-radius: 0px 0px 10px 10px;
  color:white;
  transition: 0.3s;
}

/* Show the dropdown menu on hover */
.dropdown:hover .dropdown-content {
  display: block;
  transition: 0.3s;
}

/* Change the background color of the dropdown button when the dropdown content is shown */
.dropdown:hover .dropbtn {
  background-color: #3e8e41;
  transition: 0.3s;
}

.logged2{
  font-family: 'Arial';
  font-weight: bold;
  color: black;
  position: absolute;
  font-size: 16px;
  right: 65%;
  top: 195px;
  padding: 5px;
  border-radius: 10px;
  border: 2px solid black;
  background-color: #70f72d;
}

.logo{
  height: 80px;
  width: 80px;
  margin-right: 15px;
  margin-top: -20px;
}

footer{
  margin-top:12%;
  background-color: #348c4c;
  padding: 15px 0px 15px 0px;
  border-radius: 5px;
}

center{
  margin-top: 5px;
}

footer > p{
  font-family: 'Arial';
  font-weight: bold;
  color: black;
  padding-bottom:5px;
}

footer > a{
  font-family: 'Arial';
  font-weight: bold;
  color: black;
  padding-top:5px;
}


.mainname{
  font-family: 'Arial';
  font-weight: bold;
  color: black;
  margin-top: 50px;
  font-size: 40px;
}

.header{
  display: flex; 
  justify-content: center; 
  padding-top: 30px;
}

a.nav{
  padding:10px;
  font-size:18px;
  font-family: 'Arial';
  font-weight: bold;
  color: black;
  transition: 0.3s;
  border-radius:5px;
  text-decoration: none;
}

a.nav:hover{
  padding:10px;
  font-size:18px;
  font-family: 'Arial';
  font-weight: bold;
  color: white;
  background-color:black;
  transition: 0.3s;
}

a.navlogout{
  padding:10px;
  font-size:18px;
  font-family: 'Arial';
  font-weight: bold;
  color: black;
  transition: 0.3s;
  border-radius:5px;
  text-decoration: none;
}

a.navlogout:hover{
  padding:10px;
  font-size:18px;
  font-family: 'Arial';
  font-weight: bold;
  color: white;
  background-color:red;
  transition: 0.3s;
}

ul.nav{
  background-color: #70f72d;
  padding: 15px;
  border-radius: 10px;
  border: 2px solid black;
}

a.navbar-brand{
  font-size:35px;
  font-family: 'Arial';
  font-weight: bold;
  color: black;
}

div.navbar-header{
  flex-direction: row;
}

.card > h1{
  font-family: 'Arial';
  font-weight: bold;
  color: black;
  text-shadow: 2px 2px gray;
}

.flex-container {
  display: inline-flex;
}

.flex-container > div {
  background-color:#328f49;
  margin: 10px;
  padding: 20px;
  font-size: 12px;
  border-radius: 10px;
  border: 2px solid black;
}

div.card {
    flex-direction: column;
}

.header > h3{
  font-family: 'Arial';
  font-weight: bold;
  color: black;
}

</style>


<!DOCTYPE html>
<html>
<head>
<style>
#container{width:90%;margin:auto;}
#content{width:100%;margin:auto;}

body{
    background: black;
}

h1{
text-align:center;
font-size:30px;
font-family: Courier New;
color: red;
}

input[type=text]{
width:60%;
font-size:16px;
padding:12px 20px;
margin:8px 0;
border: 1px solid #ccc;
border-radius:4px;
box-sizing: border-box;
box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.1);
}

input[type=submit]{
width:25%;
font-size:16px;
padding:12px 20px;
margin:8px 0;
border: 1px solid #ccc;
border-radius:4px;
box-sizing: border-box;
box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.1);
color:#fff;
opacity:0.75;
background-color:rgb(205,0,205);

}

input[type=submit]:hover{
background-color:rgb(255,0,255);
}
div.color{
    color: #0b6623;
}
</style>
</head>
<body>

<div id="container">
<div id="content">
<br><br><br><br>
<br><br><br><br>
<h1>WEBSITE CRAWLER</h1>

<div class="form">
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <input type="text" id="name" name="name" autofocus placeholder="masukan website">
  <input type="submit" value="submit">
</form> 
</div>

<?php

function extract_title($data){
$start = "<title";
$end = "</title>";
$b = strpos($data,$start);
$a = strpos($data,$end,$b);
$length = $a - $b+10;
$title_temp = substr($data,$b,$length);

$start = ">";
$end = "</title>";
$b = strpos($title_temp,$start);
$a = strpos($title_temp,$end,$b);
$length = $a - $b+7;
$title = substr($title_temp,$b+1,$length);

return $title;
}

function extract_description($data){
$description = "";
foreach(preg_split("/[<>]+/",$data) as $line){
$description_txt = "/" . "description" . "/i";
$content = "/" . "content=" . "/i";
if(preg_match($description_txt,$line)&&preg_match($content,$line)){
$start = "content=";
$end = '"';
$b = strpos($line,$start);
$a = strpos($line,$end,$b+9);
$length = $a - $b-9;
$sub_line = substr($line,$b+9,$length);

$sub_line_txt = "/" . $sub_line . "/i";
if(!(preg_match($sub_line_txt,$description))){ 
$description .= $sub_line . " ";
}
}
}
return $description;
}

if($_SERVER["REQUEST_METHOD"] == "POST"){

$address = $_POST["name"];

$html = file_get_contents($address);

echo "<br><br>";

$title = extract_title($html);
$description = extract_description($html);

$txt = file_get_contents('data.txt');

$title = substr($title,0,200);
$description = substr($description,0,400);

echo "<div class='txt'>";
$txt .= "\n" . "<a style='text-decoration: none; color: black;' href='" .  $address . "'><b class='txt'>".$title."</b></a><br>" . "<a href='" . $address . "'><i>" . $address . "</i></a>" . "<br>" . $description;

file_put_contents('data.txt',$txt);

}
?>
</div>
</div>
</body>
</html>

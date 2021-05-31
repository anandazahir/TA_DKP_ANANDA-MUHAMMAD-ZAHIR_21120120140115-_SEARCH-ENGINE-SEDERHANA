<head>
    <link rel="stylesheet" href="style5.css">
    <script src="https://kit.fontawesome.com/8ce534b040.js" crossorigin="anonymous"></script>
</head>
<form  autocomplete="off" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" name="input">
        <div class="search-box">
            <input type="text" name="input" class="search-txt" autofocus placeholder="Type to search"/>
            <a class="search-btn">
                <i class="fas fa-search"></i>
            </a>
    </div>
</form>
<footer>©2021|zahir</footer>
<div class="wrapper">
<?php
class  test
{
    public function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }
      
    public function highlight($line,$search_keyword){
      
      $number_of_words = str_word_count($search_keyword);
      $words = str_word_count($search_keyword,1);
      
      if($number_of_words==1){
      $line = str_replace(" " . $words[0] . " ", " <mark>" . $words[0] . "</mark> ",$line);
      }
      return $line;
      }
}
$kelas = new test();
if($_SERVER["REQUEST_METHOD"] == "POST"){

$search_keyword = $kelas->test_input($_POST["input"]);

echo "<br><br>";

$txt = file_get_contents("data.txt");

$keyword = "/" . $search_keyword . "/i";
$keyword_with_space = "/" . " " . $search_keyword . " " . "/i";
$keyword_in_start_title = "/" . "<b>" . $search_keyword . "" . "/i";

foreach(preg_split("/((\r?\n)|(\r\n?))/",$txt) as $line){
if(preg_match($keyword_in_start_title,$line)){
if(!($search_keyword=="")){
echo "<div class='item'>";
$line = $kelas->highlight($line,$search_keyword);
echo $line;
echo "</div>";
}
}
}

foreach(preg_split("/((\r?\n)|(\r\n?))/",$txt) as $line){
if(preg_match($keyword_with_space,$line)&&!(preg_match($keyword_in_start_title,$line))){
if(!($search_keyword=="")){
echo "<div class='item'>";
$line = $kelas->highlight($line,$search_keyword);
echo $line;
echo "</div>";
}
}
}

foreach(preg_split("/((\r?\n)|(\r\n?))/",$txt) as $line){
if(preg_match($keyword,$line)&&!(preg_match($keyword_with_space,$line))&&!(preg_match($keyword_in_start_title,$line))){
if(!($search_keyword=="")){
echo "<div class='item'>";
$line = $kelas->highlight($line,$search_keyword);
echo $line;
echo "</div>";
}
}
}


}
echo "</div>";
?>



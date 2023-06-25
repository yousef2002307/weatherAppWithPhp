<?php
$vals = '';
if($_SERVER['REQUEST_METHOD'] === "POST"){
require __DIR__ . '/vendor/autoload.php'; 
$client = new GuzzleHttp\Client; 
$city = $_POST['city'];
try {
    //code...

$response = $client->request("GET", "https://api.weatherapi.com/v1/current.json?key=918c9c8b9155426395592947232506&q=${city}",['body' => "foo"], [
    "headers" => [
      
        "User-Agent" => "yousef2002307"
    ]
]);
$responsecode = $response->getStatusCode(). "\n";
if($responsecode == 200){
$array = json_decode( $response->getBody(),true);
$loc = $array['location']['country'];
$degree = $array['current']['temp_c'];
$img = $array['current']['condition']['icon'];
$vals = "<div>
<ul style='list-style:none'>
<li>country : $loc</li>
<li>degree : $degree</li>
<li><img src='$img'/></li>
</ul>
</div>";
}else{
    $vals = "somethinge weong happen";
}
} catch (\Throwable $th) {
    $vals = "wrong city try to entr agian";
}

}
?>
<div style="width: 400px;
    background-color: #ddd;
    padding: 20px;
    margin: 40px auto;
    text-align: center;">
    <h2>weather app</h2>
<form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
    <input value="<?php echo  isset($_POST['city']) ? $_POST['city'] : "" ?>" type="text" name="city" placeholder='enter the city'/>
    <input type='submit'/>
</form>
<?php echo $vals?>
</div>
<?
include_once("../connect.php");

$cn=new connect();
$cn->connectdb();
$sql = $cn->selectdb("SELECT `country`,`service`, `gm500`, `kg1` , `kg1.5`, `kg2`, `kg2.5` , `kg3`, `kg3.5` , `kg4` , `kg4.5` , `kg5`, `kg5.5`, `kg6`, `kg7-10`, `kg11-16`, `kg17-20`, `kg21-30`, `kg31-50`,
 `kg51-70`, `kg100p` , `days` FROM tbl_rate");

//$columnHeader = '';  
$columnHeader = "Country" . "\t" . "Service" . "\t" . "500 gm" . "\t" . "1 KG" . "\t" . "1.5 KG" . "\t" . "2 KG" . "\t" . "2.5 KG" . "\t" . "3 KG" . "\t" . "3.5 KG" . "\t" . "4 KG" . "\t" . "4.5 KG" . "\t" . "5 KG" . "\t" . "5.5 KG" . "\t" . "6 KG" . "\t" . "7-10 KG" . "\t" . "11-16 KG" . "\t" . "17-20 KG" . "\t" . "21-30 KG" . "\t" . "31-50 KG" . "\t" . "51-70 KG" . "\t" . "100+ KG" . "\t" . "Working Day" . "\n";  
  
$setData = '';  
 
while ($rec = mysqli_fetch_row($sql)) {  
    $rowData = '';  
    foreach ($rec as $value) {  
        $value = '"' . $value . '"' . "\t";  
        $rowData .= $value;  
    }  
    $setData .= trim($rowData) . "\n";  
}  
  
  
header("Content-type: application/octet-stream");  
header("Content-Disposition: attachment; filename=Rate.xls");  
header("Pragma: no-cache");  
header("Expires: 0");  
  
echo  $columnHeader.$setData . "\n";
?>
<?php
//brandon treu, batreu@dmacc.edu, 900704435, 2/27//2022

//1) Create a function that will accept a timestamp and format it into mm/dd/yyyy format.
function dateTimeStamp(){
    $dateToday = date("m / d / Y");
    echo $dateToday;
}
echo ("1: Today's date: "); dateTimeStamp();// call function to test



//2). Create a function that will accept a timestamp and format it into dd/mm/yyyy format to use when working with international dates.
function dateInternational(){
    $dateToday = date("d / m / Y");
    echo $dateToday;
}
echo "<br>";// to move this to the next row and make it easier to read
echo("2: Today's international date: "); dateInternational();//call the international date function to test

/*3). Create a function that will accept a string input.  It will do the following things to the string:
		- Display the number of characters in the string
		- Trim any leading or trailing whitespace
		- Display the string as all lowercase characters
		- Will display whether or not the string contains "DMACC" either upper or lowercase  */


function stringID() {
    $DMACCstring = "DMACC: Des Moines Area Community College";
    echo $DMACCstring;//show what the value of my sting variable is
    echo "<br>";// to move this to the next row and make it easier to read
    echo ('The String Length is:  '); echo strlen($DMACCstring);// show the length of the string value
    echo "<br>";// to move this to the next row and make it easier to read
    echo ('Displayed with trimmed leading or trailing white space :  ');
    echo trim($DMACCstring,"");//this trims the trailing of leading white space, it looks like this is done automatically from my tests
    echo "<br>";// to move this to the next row and make it easier to read
    echo ('Displayed in all lower case text : '); echo strtolower($DMACCstring);//switches to all lower case
    echo "<br>";// to move this to the next row and make it easier to read
    $DMACCstringContains = strpos($DMACCstring,"DMACC");//searches my string var for the letters of 'DMACC'
    if ($DMACCstringContains == ""){
        echo "it doesn't contain the word 'DMACC'";
    }else{
        echo "Contains the word 'DMACC'";
    }
    echo "<br>";


}
echo "<br>";// to move this to the next row and make it easier to read
echo("3: String Id");//title of third question
echo "<br>";// to move this to the next row and make it easier to read
stringID();// call the function to test


//4). Create a function that will accept a number and display it as a formatted phone number.   Use 1234567890 for your testing.
echo "<br>";// to move this to the next row and make it easier to read
echo("4: Phone Number");

// Looking for '1234567890'
$testPhoneNumber = 1234567890;
$testString = strval($testPhoneNumber);
echo $testString;

function phoneNumber($phone){
    $areaCode = substr($phone, 0, 3);
    $nextThree = substr($phone, 3, 3);
    $lastFour = substr($phone, 6, 4);

    $numberFormat = '('.$areaCode.') '.$nextThree.'-'.$lastFour;
    echo "$numberFormat";
}
echo "<br>";// to move this to the next row and make it easier to read
phoneNumber($testString);// call function



//5). Create a function that will accept a number and display it as US currency with a dollar sign.  Use 123456 for your testing
echo "<br>";// to move this to the next row and make it easier to read
echo("5: Formatting Currency");

$currencyNumber = 123456;
function moneyFormater ($currency){
    $formattedMoney = '$' . $currency . '.00';

    echo $formattedMoney;
}

moneyFormater($currencyNumber);// call function

?>
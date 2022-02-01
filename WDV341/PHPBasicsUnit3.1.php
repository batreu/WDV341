<head>
<meta charset ="UTF-8">
<title>PHP Basics Unit 3 - 1</title>
</head>
<?php /** declaring all php variables in the same spot**/
$studentName = "Brandon Treu";
$assignmentName = "PHP Basics";
$number1 = 1;
$number2 = 2;
$total = $number1 + $number2;

/**Mitch helped me with this array, it may look very similar to his**/
$phparray = array('PHP','HTML','Javascript');

/**Output the assignment name in the h1 tag**/
echo "<h1>".$assignmentName."</h1>";


?>
<body>
<h2>
    <?php /** this is the output for the "my name" variable **/
    echo $studentName
    ?>
</h2><!-- this is output for the number variables-->
<p>Number 1 is : <?php echo $number1 ?></p>
<p>Number 2 is : <?php echo $number2 ?></p>
<p>Total is equal to : <?php echo $total ?></p>


<p>
    <?php  /**This output the php array variable**/
    foreach ($phparray as $value) {
        echo "$value <br>";
    }
    ?>
</p>


<p id="arrayoutput"><br></p>
<script> /** Js array to output the same info I could not understand how to pass variable from php to JS **/
    const jsarray = ["PHP", "HTML", "Javascript"];
    document.getElementById("arrayoutput").innerHTML = jsarray;
</script>

</body>

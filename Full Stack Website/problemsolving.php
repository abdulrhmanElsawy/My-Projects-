<?php
    session_start();
    include 'init.php';
?>






<h1 style="text-align:center;">Problem Solving</h1>
<div class="problems">
    <div class="difficulty">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Difficulty <i class="caret"></i></a>
        <ul class="dropdown-menu">
            <li><a href="?diffi=800">800</a></li>
            <li><a href="?diffi=900">900</a></li>
            <li><a href="?diffi=1000">1000</a></li>
            <li><a href="?diffi=1100">1100</a></li>
            <li><a href="?diffi=1200">1200</a></li>

        </ul>

    </div>

    <?php
    if (!isset($_GET['diffi'])) {
        $problems = getAllFrom("*", "problems", "WHERE difficulty=800", "", "id");
        foreach ($problems as $problem) {
            ?>




    <div class="container">
        <div class="row">
            <div class="problem">
                <p><?php echo $problem['description'] ?>
                </p>
                <h1>Input</h1>
                <p><?php echo $problem['inputdescription'] ?></p>
                <h1>Output</h1>
                <p><?php echo $problem['outputdescription'] ?>

                </p>
                <h1>Example</h1>
                <div class="input">
                    <h1>input</h1>
                    <pre>
<?php echo $problem['inputexample'] ?>

    </pre>
                </div>
                <div class="output">
                    <h1>output</h1>
                    <pre>
<?php echo $problem['outputexample'] ?>
    </pre>
                </div>


            </div>
        </div>
        <div class="answer">
            <h2 class="solutions">solutions <i class="caret"></i></h2>

            <div class="solution">
                <pre>
<?php echo $problem['solutions'] ?>

</pre>
            </div>
        </div>

    </div>

    <?php
        }
    }  ?>


    <?php if(isset($_GET["diffi"]) && $_GET["diffi"] == "800"){

    $problems = getAllFrom("*", "problems", "WHERE difficulty=800", "", "id");
        foreach ($problems as $problem) {
            ?>


    <div class="container">
        <div class="row">
            <div class="problem">
                <p><?php echo $problem['description'] ?>
                </p>
                <h1>Input</h1>
                <p><?php echo $problem['inputdescription'] ?></p>
                <h1>Output</h1>
                <p><?php echo $problem['outputdescription'] ?>

                </p>
                <h1>Example</h1>
                <div class="input">
                    <h1>input</h1>
                    <pre>
<?php echo $problem['inputexample'] ?>

    </pre>
                </div>
                <div class="output">
                    <h1>output</h1>
                    <pre>
<?php echo $problem['outputexample'] ?>
    </pre>
                </div>


            </div>
        </div>

        div class="answer">
        <h2 class="solutions">solutions <i class="caret"></i></h2>

        <div class="solution">
            <pre>
<?php echo $problem['solutions'] ?>

</pre>
        </div>
    </div>

</div>

<?php
        }
    }  ?>

<?php if(isset($_GET["diffi"]) && $_GET["diffi"] == "900"){

$problems = getAllFrom("*", "problems", "WHERE difficulty=900", "", "id");
    foreach ($problems as $problem) {
        ?>


<div class="container">
    <div class="row">
        <div class="problem">
            <p><?php echo $problem['description'] ?>
            </p>
            <h1>Input</h1>
            <p><?php echo $problem['inputdescription'] ?></p>
            <h1>Output</h1>
            <p><?php echo $problem['outputdescription'] ?>

            </p>
            <h1>Example</h1>
            <div class="input">
                <h1>input</h1>
                <pre>
<?php echo $problem['inputexample'] ?>

</pre>
            </div>
            <div class="output">
                <h1>output</h1>
                <pre>
<?php echo $problem['outputexample'] ?>
</pre>
            </div>


        </div>
    </div>

    div class="answer">
    <h2 class="solutions">solutions <i class="caret"></i></h2>

    <div class="solution">
        <pre>
<?php echo $problem['solutions'] ?>

</pre>
    </div>
</div>

</div>

<?php
    }
}  ?>


<?php if(isset($_GET["diffi"]) && $_GET["diffi"] == "1000"){

$problems = getAllFrom("*", "problems", "WHERE difficulty=1000", "", "id");
    foreach ($problems as $problem) {
        ?>


<div class="container">
    <div class="row">
        <div class="problem">
            <p><?php echo $problem['description'] ?>
            </p>
            <h1>Input</h1>
            <p><?php echo $problem['inputdescription'] ?></p>
            <h1>Output</h1>
            <p><?php echo $problem['outputdescription'] ?>

            </p>
            <h1>Example</h1>
            <div class="input">
                <h1>input</h1>
                <pre>
<?php echo $problem['inputexample'] ?>

</pre>
            </div>
            <div class="output">
                <h1>output</h1>
                <pre>
<?php echo $problem['outputexample'] ?>
</pre>
            </div>


        </div>
    </div>

    div class="answer">
    <h2 class="solutions">solutions <i class="caret"></i></h2>

    <div class="solution">
        <pre>
<?php echo $problem['solutions'] ?>

</pre>
    </div>
</div>

</div>

<?php
    }
}  ?>


<?php if(isset($_GET["diffi"]) && $_GET["diffi"] == "1100"){

$problems = getAllFrom("*", "problems", "WHERE difficulty=1100", "", "id");
    foreach ($problems as $problem) {
        ?>


<div class="container">
    <div class="row">
        <div class="problem">
            <p><?php echo $problem['description'] ?>
            </p>
            <h1>Input</h1>
            <p><?php echo $problem['inputdescription'] ?></p>
            <h1>Output</h1>
            <p><?php echo $problem['outputdescription'] ?>

            </p>
            <h1>Example</h1>
            <div class="input">
                <h1>input</h1>
                <pre>
<?php echo $problem['inputexample'] ?>

</pre>
            </div>
            <div class="output">
                <h1>output</h1>
                <pre>
<?php echo $problem['outputexample'] ?>
</pre>
            </div>


        </div>
    </div>

    div class="answer">
    <h2 class="solutions">solutions <i class="caret"></i></h2>

    <div class="solution">
        <pre>
<?php echo $problem['solutions'] ?>

</pre>
    </div>
</div>

</div>

<?php
    }
}  ?>


<?php if(isset($_GET["diffi"]) && $_GET["diffi"] == "1200"){

$problems = getAllFrom("*", "problems", "WHERE difficulty=1200", "", "id");
    foreach ($problems as $problem) {
        ?>


<div class="container">
    <div class="row">
        <div class="problem">
            <p><?php echo $problem['description'] ?>
            </p>
            <h1>Input</h1>
            <p><?php echo $problem['inputdescription'] ?></p>
            <h1>Output</h1>
            <p><?php echo $problem['outputdescription'] ?>

            </p>
            <h1>Example</h1>
            <div class="input">
                <h1>input</h1>
                <pre>
<?php echo $problem['inputexample'] ?>

</pre>
            </div>
            <div class="output">
                <h1>output</h1>
                <pre>
<?php echo $problem['outputexample'] ?>
</pre>
            </div>


        </div>
    </div>
    div class="answer">
    <h2 class="solutions">solutions <i class="caret"></i></h2>

    <div class="solution">
        <pre>
<?php echo $problem['solutions'] ?>

</pre>
    </div>
</div>

</div>

<?php
    }
}  ?>










<?php include  $tpl ."footer.php"; ?>
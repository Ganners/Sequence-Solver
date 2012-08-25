<!doctype HTML>
<html>
    <head>
        <title>Sequence Solver</title>
    </head>
    <style type="text/css">
        body {
            width: 100%;
            margin: 0;
            padding: 0;
            font-family: Helvetica, Arial, Tahoma, sans-serif;
        }
        p {
            margin: 10px;
        }
        ul.form {
            list-style-type: none;
            margin: 10px;
            padding: 0;
            width: auto;
            position: relative;
            display: inline-block;
        }
        ul.form li {
            margin: 5px 0;
            width: auto;
            position: relative;
        }
        ul.form li input {
            
        }
        ul.form li button {
            float: right;
        }
        p.working-out {
            text-align: center;
            width: 370px;
            margin: 20px 10px;
            background: #eee;
            border-radius: 3px;
            box-shadow: 0 0 5px #777;
            padding: 10px;
        }
    </style>
    <body>
        <div id="container">
        <?php
            require_once("loader.php");
            if(isset($_GET['sequence'])) {
                $Nth_Term = new Math\Nth_Term($_GET['sequence']);
                ?>
                    <p>The next number in the sequence is: <?php echo $Nth_Term->getNextTerm(); ?></p>

                    <p>The difference table and working out for this is as follows:</p>

                    <p class="working-out">
                        <?php echo nl2br($Nth_Term->getFormula()); ?>
                    </p>
                <?php
            }
        ?>
            <form method="get">
                <ul class="form">
                    <li>
                        <label for="sequence">Sequence (comma separated):</label>
                        <input type="text" placeholder="e.g. 1, 2, 3, 4" name="sequence" id="sequence" value="<?php echo isset($_GET['sequence']) ? $_GET['sequence'] : NULL; ?>" />
                    </li>
                    <li>
                        <button>Submit</button>
                    </li>
                </ul>
            </form>
        </div>
    </body>
</html>
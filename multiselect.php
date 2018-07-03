<?php require_once('config.php') ?>
<?php 
    function getStateList() {
        global $conn;
        $sql = "SELECT * FROM states";
        $result = mysqli_query($conn, $sql);
        $states = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $states;
    }

    function getCitiesByStateId($stateId){
        global $conn;
        $sql = "SELECT * FROM cities where state_id='$stateId'";
        $result = mysqli_query($conn, $sql);
        $cityList = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $cityList;
    }
?>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="static/css/fSelect.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>Document</title>
</head>
<body class="text-center">
    <h1>Multi select Example</h1>

    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <select class="test form-control" multiple="multiple">
                    <?php foreach($stateList = getStateList() as $state): ?>
                        <optgroup label="<?= $state['name'] ?>">
                            <?php foreach($cityList = getCitiesByStateId($state['id']) as $city): ?>
                                <option value="<?= $city['id'] ?>"> <?= $city['name'] ?> </option>
                            <?php endforeach; ?>
                        </optgroup>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-3">
            </div>
        </div>
    </div>
    <script src="static/js/fSelect.js"></script>
    <script>
        (function($) {
            $(function() {
                $('.test').fSelect();
            });
        })(jQuery);
    </script>
</body>
</html>
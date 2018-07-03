<?php require_once('config.php') ?>
<?php 
    function getStateList() {
        global $conn;
        $sql = "SELECT * FROM states ORDER BY name";
        $result = mysqli_query($conn, $sql);
        $states = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $states;
    }

    function getCitiesByStateId($stateId){
        global $conn;
        $sql = "SELECT * FROM cities where state_id='$stateId' ORDER BY name";
        $result = mysqli_query($conn, $sql);
        $cityList = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $cityList;
    }
?>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- Include the plugin's CSS and JS: -->
    <script type="text/javascript" src="static/js/bootstrap-multiselect.js"></script>
    <link rel="stylesheet" href="static/css/bootstrap-multiselect.css" type="text/css"/>


    <title>Document</title>
</head>
<body class="text-center">
    <h1>Multi select Example</h1>

    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <select id="citySelect" multiple="multiple">
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
    <script>
        (function($) {
            $(function() {
                $('#citySelect').multiselect({
                    showSearch: true,
                    buttonWidth: '300px',
                    maxHeight: 400,
                    nonSelectedText: 'Filter by City ',
                    enableCaseInsensitiveFiltering: true,
                    enableClickableOptGroups: true,
                    enableCollapsibleOptGroups: true,
                    enableFiltering: true,
                    includeSelectAllOption: true,
                    onChange: function(element, checked) {
                        var cities = [];
                        $('#citySelect option:selected').map(
                            function(a, item){
                                cities.push(item.value);
                            });
                        console.log(cities);
                    }
                });
            });
        })(jQuery);
    </script>
</body>
</html>
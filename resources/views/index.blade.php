<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Bootstrap -->
        <!-- Latest compiled and minified CSS -->
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.css" integrity="sha256-I/m6FhcACNYmRoqn1xUnizh6S7jOJsTq+aiJ6BtE2LE=" crossorigin="anonymous" />
        <link href="{{URL('')}}/public/css/style.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    Is this holiday?
                </div>
                <form id="dateForm">
                    <p>Enter a date to find out</p>

                    <div class="row">
                        <div class="col-md-offset-3 col-md-6">
                            <div class="form-group">
                                <div class="input-group date">
                                    <input id="datepicker" type="text" class="form-control" placeholder="dd-mm-yyyy">
                                    <div class="input-group-addon" >
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--<div class="row">--}}
                        {{--<button type="submit" class="btn btn-primary">Submit</button>--}}
                    {{--</div>--}}
                </form>
                <p id="result"></p>
            </div>
        </div>
    </body>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.js" integrity="sha256-7Ls/OujunW6k7kudzvNDAt82EKc/TPTfyKxIE5YkBzg=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {
            $('.input-group.date').datepicker({
                format: "yyyy-mm-dd",
                todayHighlight: true,
                autoclose: true,
                startDate:"2018-01-01",
                endDate:"2018-12-31"
            });

            $('.input-group.date').datepicker().on('changeDate',function(){
                var datelist = $('.input-group.date').datepicker('getFormattedDate');
                $("#result").html("Fetching Data . . .");
                $.get( "api/getEvent/"+datelist, function(data) {
                    if(data.isHoliday)
                    {
                        $("#result").html("IS A HOLIDAY ! <br>"+"It's "+data.message);
                    }
                    else
                    {
                        $("#result").html(data.message);
                    }
                })
                .fail(function() {
                    alert( "Unknown error occured" );
                });
            });
        });
    </script>
</html>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="60">
    <title>Bluesmart - Teacher Attendance</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>
    <div class="container-fluid" style="font-size:11px; margin-top:20px;">
        <div class="row">
            <div class="col border-right">
                @php
                    $i=0;
                    $yes = 0;
                    $no = 0;
                @endphp
                @foreach ($list as $item)
                    {{$item['name']}}  <span class="badge badge-{{$item['attendance']=="No"?"danger":"success"}}">{{$item['attendance']}}</span><hr style="margin: 2px;">
                    @php
                        if($item['attendance']=="No"){
                            $no++;
                        }
                        else{
                            $yes++;
                        }
                        $i++;
                        if($i%25==0){
                            echo '</div><div class="col border-right">';
                        }
                    @endphp
                @endforeach
            </div>
        </div>
        <div class="row" style="background-color: #333; color:white; font-size:12px; padding:2px;">
            <div class="col">
                Yes = {{$yes}} / No = {{$no}}
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>


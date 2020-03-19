<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Trains!</title>
    <!-- Would normally self host -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/skeleton/2.0.4/skeleton.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/skeleton/2.0.4/skeleton.min.css">
</head>
<body>
    <div class="container">
        <h1>Trains!</h1>
        <p>Add and update items via CSV upload. Delete using the links in the last column.</p>

        @if ($errors && (count($errors) > 0))
            <div class="error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li style="color:#640000">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if($notes)
        <div class="notes">
            <h4>{{$notes}}</h4>
        </div>
        @endif

        <div id="form" class="section">
            <form id="uploader" action="/" enctype="multipart/form-data" method="POST">
                <input type="file" name="csv_upload" id="csv-upload" accept="text/csv">
                <input type="submit" value="Upload CSV">
            </form>
        </div>
        <div id="results" class="section">
            <table class="u-full-width">
                    <thead>
                    <tr>
                        <td><a href="/sort/id">ID</a></td>
                        <td><a href="/sort/train_line">Train Line</a></td>
                        <td><a href="/sort/route_name">Route Name</a></td>
                        <td><a href="/sort/run_number">Run Number</a></td>
                        <td><a href="/sort/operator_id">Operator ID</a></td>
                        <td></td>
                    </tr>
                    </thead>
                @if ($data)
                    <tbody>
                    @foreach($data as $key=>$value)
                        <tr>
                            @foreach($value as $key=>$column)
                            <td>{{ $column }}</td>
                            @endforeach
                            @if($value['id'])
                            <td><a href="/remove/{{$value['id']}}">Delete</a></td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                @endif
            </table>

        </div>
    </div>
</body>
</html>
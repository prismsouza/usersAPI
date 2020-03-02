<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=devide-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Import csv file</title>
</head>

<body>
    <form action="{{url('/api/upload')}}" method="post" enctype="multipart/form-data">
        

        <div class="form-group">
            <label for="upload-file">Chose a CSV file to Upload</label><br>
            <input type="file" name="upload-file" class="form-control"><br><br>
        </div>
        <input class="btn btn-sucess" type="submit" value="Upload File" name="submit">
        <br><br>
        <a href="{{ url('/sample/militares10.csv')}}" > Download Sample</a>
    </form>
</body>
</html>

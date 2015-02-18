<!DOCTYPE html>
<html>
<head>
    <title>DVD Search</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
</head>
<body>

<div class="container">

    <h1>DVD Search</h1>

    <form action="/dvds" method="get">
        <div class="form-group">
            <label>Title</label>
            <input type="text" name="title">
        </div>

        <div class="form-group">
            <label>Genre</label>
            <select class="form-control" name="genre_id">
                <option value="0">
                    All
                </option>
                <?php foreach($genres as $genre) : ?>
                    <option value="<?php echo $genre->id ?>">
                        <?php echo $genre->genre_name ?>
                    </option>
                <?php endforeach ?>
            </select>
        </div>

        <div class="form-group">
            <label>Rating</label>
            <select class="form-control" name="rating_id">
                <option value="0">
                    All
                </option>
                <?php foreach($ratings as $rating) : ?>
                    <option value="<?php echo $rating->id ?>">
                        <?php echo $rating->rating_name ?>
                    </option>
                <?php endforeach ?>
            </select>
        </div>

        <button type="submit" class="btn btn-default">Submit</button>
    </form>

</div>

</body>
</html>
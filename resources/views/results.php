<!DOCTYPE html>
<html>
<head>
    <title>Results</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
</head>
<body>

<div class="container">

    <div class="row">
        <div class="col-md-2"><h1>Results</h1></div>
        <div class="col-md-1">
            <a class="btn btn-default" href="/dvds/search" role="button">Back to Search</a>
        </div>
    </div>

    <?php if ($title && ctype_alnum($title)) : ?>
        <div class="alert alert-info" role="alert">
            You searched for movies with the title '<?php echo $title ?>'.
        </div>
    <?php endif; ?>

    <?php if ($genre_id && $genre_id != '0' && is_numeric($genre_id)) : ?>
        <div class="alert alert-info" role="alert">
            <?php foreach($genres as $genre) : ?>
                <?php if ($genre->id == $genre_id) : ?>
                    You searched for movies in the <?php echo $genre->genre_name ?> genre.
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if ($rating_id && $rating_id != '0' && is_numeric($rating_id)) : ?>
        <div class="alert alert-info" role="alert">
            <?php foreach($ratings as $rating) : ?>
                <?php if ($rating->id == $rating_id) : ?>
                    You searched for movies with a <?php echo $rating->rating_name ?> rating.
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Title</th>
                <th>Rating</th>
                <th>Genre</th>
                <th>Label</th>
                <th>Sound</th>
                <th>Format</th>
                <th>Release Date</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($dvds as $dvd) : ?>
            <tr>
                <td><?php echo $dvd->title ?></td>
                <td><?php echo $dvd->rating_name ?></td>
                <td><?php echo $dvd->genre_name ?></td>
                <td><?php echo $dvd->label_name ?></td>
                <td><?php echo $dvd->sound_name ?></td>
                <td><?php echo $dvd->format_name ?></td>
                <td><?php echo $dvd->formatted_date ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

</div>

</body>
</html>